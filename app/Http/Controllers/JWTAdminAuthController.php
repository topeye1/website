<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTAdminAuthController extends BaseController
{
    //
    public function __construct(){
       // $this->middleware('jwt.verify', ['except'=>['login', 'register']]);
    }

    /**
     * get a JWT via given credentials.
     * @endpointe /apiw/login
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $user_id = $request->post('user_phone');
        $user_pwd = $request->post('user_pwd');
        $md5pwd = $this->encrypt($user_pwd); // after using...
        $validator = Validator::make(
            ['id'=>$user_id,             'password'=>$user_pwd],
            ['id' =>'required|between:3,30','password' =>'required|string|min:8',]
        );

        if($validator->fails()){
            return response()->json([
                'msg'=>'err',
                'cont'=>$validator->errors(),
            ]);
        }

        try {
            if(!$token = auth('admin')->attempt($validator->validated())){
                return response()->json(['msg'=>'Unauthorized user login attempt']);
            }
        } catch (JWTException $e) {
            return response()->json([
                'msg' => 'err',
                'cont' => $e->getMessage(),
            ]);
        }
        return $this->createNewToken($token);
    }

    /**
     *  @endpointe /apiw/admin/profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(){
        return response()->json(auth('admin')->user());
    }

    /**
     * @endpointe /apiw/admin/logout
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        auth()->guard('admin')->logout();
        return response()->json(['msg'=>'ok', 'cont'=>'Successfully logged out']);
    }

    /**
     * Refresh a token
     * @endpointe /apiw/admin/refresh
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(){
        return $this->createNewToken(auth('admin')->refresh());
    }


    public function createNewToken($token){
        //auth()->guard('admin')->factory()->setTTL(60*60*12);
        return \Response::json([
            'msg'=>'ok',
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth('admin')->factory()->getTTL()
        ]);
    }

    /*
     *@endpointe /apiw/admin/get_user
     * */
    public function get_user(Request $request)
    {
        $this->validate($request,[
            'token' => 'required'
        ]);
        try {
            $user = auth('admin')->authenticate($request->token);
            if($user){
                date_default_timezone_set('Asia/Shanghai');
                $updated_at = @date("Y-m-d H:i:s", time());

                session()->forget('user');
                session()->forget('user_id');
                session()->forget('user_phone');
                session()->forget('user_name');
                session()->forget('pages');
                session()->forget('locale');

                session()->put('user', 'admin');
                session()->put('user_id', $user->id);
                session()->put('user_phone', $user->phone);
                session()->put('user_name', $user->name);

                $permission = (int) $user->permission;
                $user_level = (int) $user->level;

                if ($permission == 0 && $user_level < 7) {
                    return response()->json([
                        'msg' => 'err',
                        'cont' => 'You do not have access.',
                    ]);
                }

                $sql = "SELECT show_count, show_language FROM tbl_web_setting ";
                $setting_row = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
                if (count($setting_row) > 0) {
                    session()->put('pages', $setting_row->show_count);
                    session()->put('locale', $setting_row->show_language);
                } else {
                    session()->put('pages', '10');
                    session()->put('locale', 'ko');
                }

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
