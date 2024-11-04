<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Client;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTUserAuthController extends BaseController
{
    //
    public function __construct(){
        //$this->middleware('auth:mobile', ['except'=>['login', 'register']]);
    }

    /**
     * Register4 a user.
     *  * @endpointe /api/auth/register
     * @return \Illuminate\Http\JsonResponse
     */
    //유저 회원가입
    public function register(Request  $request){
        $user_id = $request->post('user_id');
        $user_pwd = $request->post('user_pwd');

        $credentials['user_id'] = $user_id;
        $credentials['password'] = $user_pwd;

        date_default_timezone_set('Asia/Shanghai');
        $create_date = date("Y-m-d H:i:s", time());

        $validator = Validator::make($credentials, [
            'user_id' =>'required|between:6,30',
            'password' =>'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'=>'err',
                'cont'=>$validator->errors(),
            ]);
            exit();
        }

        $user_name = $request->post('user_name');
        $user_phone = $request->post('user_phone');

        $new_user = [
            'name' => $user_name,
            'id' => $user_id,
            'password' => Hash::make($user_pwd),
            'phone' => $user_phone,
            'create_date' => $create_date
        ];

        try {
            $cnt = Client::where('id', $user_id)->doesntExist();
            if (!$cnt) { // exist
                return \Response::json([
                    'msg' => 'du'
                ]);

                exit();
            }

            $table_info = 'tbl_user_info';
            $success = DB::table($table_info)->insert($new_user);
            $success = DB::table('tbl_trade_setting')
                ->insert(
                    [
                        'user_num' => $user_name,
                        'market' => 'htx',
                        'update_date' => $create_date
                    ]
                );
            $success = DB::table('tbl_trade_setting')
                ->insert(
                    [
                        'user_num' => $user_name,
                        'market' => 'bin',
                        'update_date' => $create_date
                    ]
                );
            if ($success) {
                return \Response::json([
                    'msg' => 'ok',
                    'cont' => 'created user',
                ]);
            } else {
                return \Response::json([
                    'msg' => 'err',
                    'cont' => 'user is not created'
                ]);
            }
        } catch(\Exception $e) {
            return \Response::json([
                'msg' => 'err',
                'cont'=>$e->getMessage(),
            ]);
        }
    }

    /**
     * get a JWT via given credentials.
     * @endpointe /api/user/login
     * @return \Illuminate\Http\JsonResponse
     */
    //로그인 토큰 얻기
    public function login(Request $request){
        $user_id = $request->post('user_id');
        $user_pwd = $request->post('user_pwd');
        $md5pwd = $this->encrypt($user_pwd);
        $validator = Validator::make(
            ['id'=>$user_id,             'password'=>$user_pwd],
            ['id' =>'required|between:6,30','password' =>'required|string|min:8',]
        );

        if($validator->fails()){
            return response()->json([
                'msg'=>'err',
                'cont'=>$validator->errors(),
            ]);
            exit();
        }

        if(!$token = auth('user')->attempt($validator->validated())){
            return response()->json(['msg'=>'Unauthorized user login attempt']);
            exit();
        }

        return $this->createNewToken($token);
    }


    /**
     * get the authenticated user.
     *  @endpointe /api/auth/profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(){
        return response()->json(auth('user')->client());
    }

    /**
     * log the user out (Invalidate the token)
     * @endpointe /api/auth/logout
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        auth('user')->logout();
        return response()->json(['msg'=>'Successfully logged out']);
    }


    /**
     * Refresh a token
     * @endpointe /api/auth/refresh
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(){
        return $this->createNewToken(auth('user')->refresh());
    }


    /**
    * @param sring $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNewToken($token){
        return response()->json([
            'msg'=>'ok',
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth('user')->factory()->getTTL() * 60 * 24
        ]);
    }

    //토큰으로 로그인하기
    public function get_user(Request $request)
    {
        $market = $request->post('market');
        $token = $request->header('authorization');
        $token = str_replace('Bearer ', '', $token);

        /*$this->validate($request,[
            'token' => 'required'
        ]);*/
        try {
            $user = auth('user')->authenticate($token);
            if($user){
                date_default_timezone_set('Asia/Shanghai');
                $updated_at = @date("Y-m-d H:i:s", time());

                session()->forget('user');
                session()->forget('user_num');
                session()->forget('user_id');
                session()->forget('user_name');
                session()->forget('user_level');
                session()->forget('market');

                session()->put('user', 'user');
                session()->put('user_num', $user->num);
                session()->put('user_id', $user->id);
                session()->put('user_name', $user->name);
                session()->put('user_level', $user->level);
                session()->put('market', $market);

                $success = DB::table('tbl_user_info')->where('id', $user->id)
                    ->update(
                        [
                            'login_date' => $updated_at,
                            'actived' => 1
                        ]
                    );
                return response()->json([
                    'msg' => 'ok'
                ]);
            }
            else{
                return response()->json([
                    'msg' => 'err',
                    'cont' => 'non user with authenticate',
                ]);
            }

        }
        catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['msg' => 'err','cont' => 'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['msg' => 'err', 'cont' => 'Token is Expired']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['msg' => 'err', 'cont' => 'Token is Blacklisted']);
            }
            else if ($e instanceof JWTException){
                return response()->json(['msg' => 'err', 'cont' => $e->getMessage()]);
            }
            else {
                return response()->json(['msg' => 'err', 'cont' => 'we can not about this error']);
            }
        }

        return response()->json(['msg' => 'err', 'cont' => 'can not error']);
    }

}
