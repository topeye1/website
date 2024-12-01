<?php

namespace App\Http\Controllers;

use Auth;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Redis;
use mysql_xdevapi\Exception;
use GuzzleHttp\Client;
use phpseclib3\Net\SSH2;
use phpseclib3\Crypt\PublicKeyLoader;

class UserSettingController extends BaseController
{
    public function __construct(Request $request)
    {
//        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(view()->exists($id)){
            return view($id);
        }
        else
        {
            return view('404');
        }
    }

    public function indexNav($page, $tab){
        if(view()->exists($page)){
            return view($page, ['tab' => $tab]);
        }
        else
        {
            return view('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //api key 정보 얻기
    public function getApiKeys(Request $request) {
        $user_num = $request->session()->get('user_num');
        $market = $request->post('market');
        $rows = DB::table('tbl_api_key')->where([['user_num', $user_num], ['market', $market]])->orderBy('create_date', 'desc')->get();

        return \Response::json([
            'msg' => 'ok',
            'lists' => $rows
        ]);
    }

    //api key 추가하기
    public function setInputApiKey(Request $request) {
        $user_num = $request->session()->get('user_num');
        $api_key = $request->post('api_key');
        $secret_key = $request->post('secret_key');
        $market = $request->post('market');
        $key_name = $request->post('key_name');
        date_default_timezone_set('Asia/Shanghai');
        $create_date = date("Y-m-d H:i:s", time());

        DB::table('tbl_api_key')
            ->insert(
                [
                    'user_num' => $user_num,
                    'market' => $market,
                    'key_name' => $key_name,
                    'api_key' => $api_key,
                    'secret_key' => $secret_key,
                    'create_date' => $create_date
                ]
            );
        return \Response::json([
            'msg' => 'ok'
        ]);
    }

    //api key 삭제하기
    public function deleteApiKey(Request $request) {
        $kid = $request->post('kid');

        $success = DB::table('tbl_api_key')->where('kid', $kid)->delete();
        if ($success) {
            return \Response::json([
                'msg' => 'ok'
            ]);
        } else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }

    //api key 수정하기
    public function setEditApiKey(Request $request) {
        $kid = $request->post('kid');
        $api_key = $request->post('api_key');
        $secret_key = $request->post('secret_key');
        date_default_timezone_set('Asia/Shanghai');
        $create_date = date("Y-m-d H:i:s", time());

        $success = DB::table('tbl_api_key')->where('kid', $kid)
            ->update(
                [
                    'api_key' => $api_key,
                    'secret_key' => $secret_key,
                    'create_date' => $create_date,
                ]
            );

        if ($success) {
            return \Response::json([
                'msg' => 'ok'
            ]);
        } else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }

    //거래 설정 정보 얻기
    public function getTradeSettings(Request $request) {
        $user_num = $request->session()->get('user_num');
        $user_level = $request->session()->get('user_level');
        $market = $request->post('market');
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());

        $sql = "SELECT trade_money_id AS tid, leverage_id AS lid, profit_range_id AS prid, liquidation_range_id AS lrid ";
        $sql .= "FROM tbl_trade_setting ";
        $sql .= "WHERE user_num = ".$user_num." AND market='".$market."'";
        $u_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $sql = "SELECT fid, value, level ";
        $sql .= "FROM fix_trade_money ";
        $sql .= "WHERE level <= ".$user_level." ";
        $sql .= "ORDER BY fid ASC";
        $t_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $l_rows = DB::table('fix_leverage')->orderBy('fid', 'asc')->get();
        $pr_rows = DB::table('fix_profit_range')->orderBy('fid', 'asc')->get();
        $lr_rows = DB::table('fix_liquidation_range')->orderBy('fid', 'asc')->get();

        $sql = "SELECT amount FROM tbl_market_amount WHERE user_num = ".$user_num." AND market='".$market."' AND date='".$today."'";
        $mrow = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $amount = 0;
        if (count($mrow) > 0) {
            $amount = $mrow[0]->amount;
        }

        return \Response::json([
            'msg' => 'ok',
            'u_datas' => $u_rows[0],
            't_datas' => $t_rows,
            'l_datas' => $l_rows,
            'pr_datas' => $pr_rows,
            'lr_datas' => $lr_rows,
            'amount' => $amount
        ]);
    }

    //현재 실행중인 심볼 얻기
    public function getLivedSymbol(Request $request) {
        $user_num = $request->session()->get('user_num');
        $market = $request->post('market');
        $sql = "SELECT coin_num FROM tbl_live_coins WHERE market = '".$market."' AND user_num=".$user_num.' AND is_run=1';
        $lrow = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        return \Response::json([
            'msg' => 'ok',
            'lists' => $lrow
        ]);
    }

    //Live 상태 0으로 만들기
    public function updateLiveSettings(Request $request) {
        $user_num = $request->session()->get('user_num');
        $market = $request->post('market');
        $symbol_num = $request->post('symbol_num');

        $success = DB::table('tbl_live_coins')->where([['user_num', $user_num], ['market', $market], ['coin_num', $symbol_num]])
            ->update(
                [
                    'is_run' => 0
                ]
            );

        if ($success) {
            return \Response::json([
                'msg' => 'ok',
            ]);
        } else {
            return \Response::json([
                'msg' => 'err',
            ]);
        }
    }

    //거래 설정 정보 수정
    public function updateTradeSettings(Request $request) {
        $user_num = $request->session()->get('user_num');
        $market = $request->post('market');
        $t_id = $request->post('t_id');
        $l_id = $request->post('l_id');
        $pr_id = $request->post('pr_id');
        $lr_id = $request->post('lr_id');
        date_default_timezone_set('Asia/Shanghai');
        $update_date = date("Y-m-d H:i:s", time());

        $success = DB::table('tbl_trade_setting')->where([['user_num', $user_num], ['market', $market]])
            ->update(
                [
                    'trade_money_id' => $t_id,
                    'leverage_id' => $l_id,
                    'profit_range_id' => $pr_id,
                    'liquidation_range_id' => $lr_id,
                    'update_date' => $update_date
                ]
            );

        if ($success) {
            return \Response::json([
                'msg' => 'ok',
            ]);
        } else {
            return \Response::json([
                'msg' => 'err',
            ]);
        }
    }


    //실행중인 코인 리스트
    public function getRunningCoinList(Request $request) {
        $user_num = $request->session()->get('user_num');
        $market = $request->session()->get('market');
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());

        $sql = "SELECT b.value AS max_amount, c.value AS leverage, d.value AS profit_range, e.value AS liquidation_range ";
        $sql .= "FROM tbl_trade_setting AS a ";
        $sql .= "LEFT JOIN fix_trade_money AS b ON b.fid = a.trade_money_id ";
        $sql .= "LEFT JOIN fix_leverage AS c ON c.fid = a.leverage_id ";
        $sql .= "LEFT JOIN fix_profit_range AS d ON d.fid = a.profit_range_id ";
        $sql .= "LEFT JOIN fix_liquidation_range AS e ON e.fid = a.liquidation_range_id ";
        $sql .= "WHERE a.user_num = ".$user_num." AND a.market='".$market."'";
        $brow = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $sql = "SELECT amount FROM tbl_market_amount WHERE user_num = ".$user_num." AND market='".$market."' AND date='".$today."'";
        $mrow = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $amount = 0;
        if (count($mrow) > 0) {
            $amount = $mrow[0]->amount;
        }

        $sql = "SELECT coin_id, coin_name, status, ";
        $sql .= "IFNULL((SELECT is_run FROM tbl_live_coins WHERE coin_num = coin_id AND user_num=".$user_num." AND market='".$market."'), 0) AS bRun, ";
        $sql .= "IFNULL((SELECT hold_status FROM tbl_live_coins WHERE coin_num = coin_id AND user_num=".$user_num." AND market='".$market."'), 0) AS hold ";
        $sql .= "FROM fix_coins ";
        $sql .= "WHERE market = '".$market."' ";
        $sql .= "ORDER BY coin_name ASC";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        return \Response::json([
            'msg' => 'ok',
            'coin_lists' => $rows,
            'max_amount' => $brow[0]->max_amount,
            'leverage' => $brow[0]->leverage,
            'profit_range' => $brow[0]->profit_range,
            'liquidation_range' => $brow[0]->liquidation_range,
            'amount' => $amount
        ]);
    }

    // call python
    private function sendStartOrder($user_num, $market, $symbol){
        $publicKey = getenv("PUBLIC_KEY");
        $data = '-n '.$user_num.' ';
        $data .= '-m '.$market.' ';
        $data .= '-s '.$symbol.' ';

        $s_row = DB::table('tbl_server')->where('server_name', 'maker')->get()->first();
        $sip = $s_row->server_ip;

        try {
            // SSH 연결 설정
            $ssh = new SSH2($sip);
            $privateKey = PublicKeyLoader::load(file_get_contents($publicKey));
            if (!$ssh->login('ubuntu', $privateKey)) {
                exit('Login Failed');
            }

            // 원격 서버에서 파이썬 파일 실행
            $result = $ssh->exec('python3 /home/ubuntu/dev/maker ' . $data);

            echo $result;
        } catch (\Exception $e) {

        }

        //$response = $client->request('GET', 'http://'.$sip.'/var/maker/balance.py');

        //echo $response->getBody()->getContents();
    }

    private function sendStopOrder($user_num, $market, $symbol){
        $publicKey = getenv("PUBLIC_KEY");
        $data = '-n '.$user_num.' ';
        $data .= '-m '.$market.' ';
        $data .= '-s '.$symbol;

        $s_row = DB::table('tbl_server')->where('server_name', 'maker')->get()->first();
        $sip = $s_row->server_ip;

        try {
            // SSH 연결 설정
            $ssh = new SSH2($sip);
            $privateKey = PublicKeyLoader::load(file_get_contents($publicKey));
            if (!$ssh->login('ubuntu', $privateKey)) {
                exit('Login Failed');
            }
            // 원격 서버에서 파이썬 파일 실행
            $result = $ssh->exec('python3 /home/ubuntu/dev/maker/stop.py ' . $data);

            return $result;
        } catch (\Exception $e) {

        }
    }

    private function setCoinLiveStatus($market, $bet_limit, $coin_name) {
        $sip = getenv("REDIS_HOST");
        $spw = getenv("REDIS_PASSWORD");

        $redis = Redis::connection();
        $redis->connect($sip, 6379);
        $redis->auth($spw);

        $key = strtoupper($market).'_'.strtoupper($coin_name);
        $price = $redis->get($key);
        if ($price == null || $price == '')
            return -1;
        $param_row = DB::table('fix_params')->where('pname', 'm12')->get()->first();
        $volume = 0;
        $min_volume = 0;
        if ($param_row) {
            $volume = (float)$bet_limit * (float)$param_row->pvalue;
        }
        $coin_row = DB::table('fix_coins')->where([['coin_name', $coin_name], ['market', $market]])->get()->first();
        if ($coin_row) {
            $min_volume = (float)$price * $coin_row->min_volume ;
        }

        if ($min_volume != 0) {
            if ($volume >= $min_volume) {
                return 0;
            } else {
                return $min_volume;
            }
        }

        return -1;
    }

    //코인실행 상태 설정
    public function setRunningStatus(Request $request) {
        $user_num = $request->session()->get('user_num');
        $coin_num = $request->post('coin_num');
        $symbol = $request->post('symbol');
        $is_run = $request->post('is_run');
        $bet_limit = $request->post('trade_money');
        $leverage = $request->post('leverage');
        $profit_range = $request->post('profit_range');
        $liquidation_range = $request->post('liquidation_range');
        $market = $request->post('market');

        if ($is_run == 1) {
            $coin_row = DB::table('fix_coins')->where([['coin_id', $coin_num], ['market', $market]])->get()->first();
            $limit = $this->setCoinLiveStatus($market, $bet_limit, $coin_row->coin_name);

            if ($limit == 0) {
                $key_id = 0;
                $key_rows = DB::table('tbl_api_key')
                    ->where([['user_num', $user_num], ['market', $market]])->orderBy('create_date', 'desc')->get();
                if ($key_rows) {
                    for ($i = 0; $i < count($key_rows); $i++) {
                        $key = $key_rows[$i];
                        $key_id = $key->kid;
                        $sql = "SELECT COUNT(kid) as keyCnt FROM tbl_live_coins WHERE user_num=" . $user_num . " AND kid = " . $key_id . " AND is_run=1";
                        $keys = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
                        if ($keys[0]->keyCnt >= 5) {
                            $key_id = 0;
                        } else {
                            break;
                        }
                    }
                    if ($key_id == 0) {
                        return \Response::json([
                            'msg' => 'exceed'
                        ]);
                    }
                } else {
                    return \Response::json([
                        'msg' => 'err'
                    ]);
                }

                $rows = DB::table('tbl_live_coins')
                    ->where([['user_num', $user_num], ['coin_num', $coin_num]])->get();

                if (count($rows) > 0) {
                    DB::table('tbl_live_coins')->where([['user_num', $user_num], ['coin_num', $coin_num], ['market', $market]])
                        ->update(
                            [
                                'bet_limit' => $bet_limit,
                                'rate_rev' => $profit_range,
                                'leverage' => $leverage,
                                'rate_liq' => $liquidation_range,
                                'is_run' => $is_run,
                                'kid' => $key_id,
                                'hold_status' => 0,
                            ]
                        );
                } else {
                    DB::table('tbl_live_coins')
                        ->insert(
                            [
                                'user_num' => $user_num,
                                'coin_num' => $coin_num,
                                'bet_limit' => $bet_limit,
                                'rate_rev' => $profit_range,
                                'leverage' => $leverage,
                                'rate_liq' => $liquidation_range,
                                'is_run' => $is_run,
                                'market' => $market,
                                'kid' => $key_id,
                            ]
                        );
                }
                //$this->sendStartOrder($user_num, $market, $symbol);
                return \Response::json([
                    'msg' => 'ok'
                ]);
            } else if ($limit == -1) {
                return \Response::json([
                    'msg' => 'nocoin'
                ]);
            } else {
                return \Response::json([
                    'msg' => 'cnt',
                    'limit' => round($limit)
                ]);
            }

        } else {
            //$this->sendStopOrder($user_num, $market, $symbol);
            //포지션 상태가 아닌 주문 삭제
            DB::table('tbl_trade_order')->where([['user_num', $user_num], ['coin_num', $coin_num], ['market', $market], ['make_price', '0'], ['profit_money', '0'], ['pos_date', ''], ['make_date', '']])->delete();
            //실행 상태 표기를 정지 상태로 하기
            $success = DB::table('tbl_live_coins')->where([['user_num', $user_num], ['coin_num', $coin_num], ['market', $market]])
                ->update(
                    [
                        'is_run' => $is_run
                    ]
                );
            if ($success) {
                return \Response::json([
                    'msg' => 'ok'
                ]);
            }
        }
    }


    //유저 설정 정보 얻기
    public function getUserInfo(Request $request) {
        $user_num = $request->session()->get('user_num');
        $rows = DB::table('tbl_user_info')->where('num', $user_num)->get()->first();
        if ($rows) {
            $my_phone = $rows->phone;
            return \Response::json([
                'msg' => 'ok',
                'my_phone' => $my_phone
            ]);
        }
        return \Response::json([
            'msg' => 'err'
        ]);
    }

    //유저 전화번호 변경
    public function setChangePhoneNumber(Request $request) {
        $user_num = $request->session()->get('user_num');
        $new_phone = $request->post('new_phone');

        $rows = DB::table('tbl_user_info')->where('phone', $new_phone)->get()->first();
        if ($rows) {
            return \Response::json([
                'msg' => 'err'
            ]);
        } else {
            $success = DB::table('tbl_user_info')->where('num', $user_num)
                ->update(
                    [
                        'phone' => $new_phone
                    ]
                );
            if ($success) {
                return \Response::json([
                    'msg' => 'ok'
                ]);
            }
        }
    }

    //유저 비밀번호 변경
    public function setChangePassword(Request $request) {
        $user_num = $request->session()->get('user_num');
        $current_password = $request->post('current_password');
        $new_password = $request->post('new_password');

        $rows = DB::table('tbl_user_info')->where('num', $user_num)->get()->first();
        if ($rows) {
            if (Hash::check($current_password, $rows->password)) {
                $success = DB::table('tbl_user_info')->where('num', $user_num)
                    ->update(
                        [
                            'password' => Hash::make($new_password)
                        ]
                    );
                if ($success) {
                    return \Response::json([
                        'msg' => 'ok'
                    ]);
                }
            } else {
                return \Response::json([
                    'msg' => 'err'
                ]);
            }
        } else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }


}
