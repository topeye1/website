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
use function Sodium\compare;

class UserTradingController extends BaseController
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

    //거래주문 체결, 청산 정보 리스트
    public function getDefaultLiveTradingList(Request $request) {
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());
        $beforeDay = date("Y-m-d", strtotime($today." -1 day"));
        $row = DB::table('tbl_user_info')->where('id', 'liveacc')->get()->first();
        $user_num = $row->num;

        $sql = "SELECT ";
        $sql .= "user_num, coin_num, profit_money, fee_money, ";
        $sql .= "side, symbol, market, leverage, order_money, ";
        $sql .= "order_price, make_money, make_price, live_status, order_position, ";
        $sql .= "tp_price, sl_price, bet_limit, rate_rev, make_date ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        if (strcmp($search_date, $today) == 0) {
            $sql .= "AND (SUBSTRING(make_date, 1, 10)='".$search_date."' ";
            $sql .= "OR (SUBSTRING(order_date, 1, 10)='".$search_date."' AND make_money='0') ";
            $sql .= "OR (SUBSTRING(order_date, 1, 10)='".$beforeDay."' AND live_status>0 AND make_money='0') ";
            $sql .= "OR make_date='' ";
            $sql .= "OR live_status > 1) ";
        } else {
            $sql .= "AND SUBSTRING(make_date, 1, 10)='".$search_date."' ";
        }
        $sql .= "ORDER BY symbol, order_date";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $tmp_symbol = '';
        $tmp_running = -1;
        $live_arr = array();
        $stop_arr = array();
        $sub_arr = array();
        $live_symbols = array();
        $live_leverage = array();
        $live_limit = array();
        $live_running = array();
        $stop_symbols = array();
        $stop_leverage = array();
        $stop_limit = array();
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $symbol = $row->symbol;
            $running = $row->live_status;
            $leverage = $row->leverage;
            $limit = $row->bet_limit;
            $make_date = $row->make_date;
            if (strcasecmp($symbol, $tmp_symbol) == 0) {
                array_push($sub_arr, $row);
                $tmp_running = $running;
            } else {
                if ($i == 0) {
                    $tmp_running = $running;
                }
                $tmp_symbol = $symbol;
                if (count($sub_arr) > 0) {
                    if ($tmp_running != 0) {
                        array_push($live_arr, $sub_arr);
                    } else {
                        array_push($stop_arr, $sub_arr);
                    }
                }
                $tmp_running = $running;
                if ($tmp_running != 0) {
                    array_push($live_symbols, $symbol);
                    array_push($live_leverage, $leverage);
                    array_push($live_limit, $limit);
                } else {
                    array_push($stop_symbols, $symbol);
                    array_push($stop_leverage, $leverage);
                    array_push($stop_limit, $limit);
                }
                if ($running > 0) {
                    array_push($live_running, $running);
                }
                $sub_arr = array();
                array_push($sub_arr, $row);
            }
        }
        if (count($sub_arr) > 0) {
            if ($tmp_running != 0) {
                array_push($live_arr, $sub_arr);
                array_push($live_running, $running);
            } else {
                array_push($stop_arr, $sub_arr);
            }
        }
        $hold_status = array();
        for ($i = 0; $i < count($live_symbols); $i++) {
            $symbol = $live_symbols[$i];
            $sql = "SELECT a.coin_id, a.coin_name, b.user_num, b.hold_status ";
            $sql .= "FROM fix_coins AS a ";
            $sql .= "LEFT JOIN tbl_live_coins AS b ON b.coin_num=a.coin_id ";
            $sql .= "WHERE b.user_num = ".$user_num." AND a.market = '".$market."' AND a.coin_name = '".$symbol."' ";
            $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
            $hold = 0;
            if (count($rows) > 0)
                $hold = $rows[0]->hold_status;
            array_push($hold_status, $hold);
        }


        return \Response::json([
            'msg' => 'ok',
            'live_lists' => $live_arr,
            'stop_lists' => $stop_arr,
            'live_symbols' => $live_symbols,
            'stop_symbols' => $stop_symbols,
            'live_leverage' => $live_leverage,
            'live_limit' => $live_limit,
            'stop_leverage' => $stop_leverage,
            'stop_limit' => $stop_limit,
            'live_running' => $live_running,
            'hold_status' => $hold_status
        ]);
    }
    public function getLiveTradingList(Request $request) {
        $user_num = $request->session()->get('user_num');
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());
        $beforeDay = date("Y-m-d", strtotime($today." -1 day"));

        $sql = "SELECT ";
        $sql .= "user_num, coin_num, profit_money, fee_money, ";
        $sql .= "side, symbol, market, leverage, order_money, ";
        $sql .= "order_price, make_money, make_price, live_status, order_position, ";
        $sql .= "tp_price, sl_price, bet_limit, rate_rev, make_date ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        if (strcmp($search_date, $today) == 0) {
            $sql .= "AND (SUBSTRING(make_date, 1, 10)='".$search_date."' ";
            $sql .= "OR (SUBSTRING(order_date, 1, 10)='".$search_date."' AND make_money='0') ";
            $sql .= "OR (SUBSTRING(order_date, 1, 10)='".$beforeDay."' AND live_status>0 AND make_money='0') ";
            $sql .= "OR make_date='' ";
            $sql .= "OR live_status > 1) ";
        } else {
            $sql .= "AND SUBSTRING(make_date, 1, 10)='".$search_date."' ";
        }
        $sql .= "ORDER BY symbol, order_date";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $tmp_symbol = '';
        $tmp_running = -1;
        $live_arr = array();
        $stop_arr = array();
        $sub_arr = array();
        $live_symbols = array();
        $live_leverage = array();
        $live_limit = array();
        $live_running = array();
        $stop_symbols = array();
        $stop_leverage = array();
        $stop_limit = array();
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $symbol = $row->symbol;
            $running = $row->live_status;
            $leverage = $row->leverage;
            $limit = $row->bet_limit;
            $make_date = $row->make_date;
            if (strcasecmp($symbol, $tmp_symbol) == 0) {
                array_push($sub_arr, $row);
                $tmp_running = $running;
            } else {
                if ($i == 0) {
                    $tmp_running = $running;
                }
                $tmp_symbol = $symbol;
                if (count($sub_arr) > 0) {
                    if ($tmp_running != 0) {
                        array_push($live_arr, $sub_arr);
                    } else {
                        array_push($stop_arr, $sub_arr);
                    }
                }
                $tmp_running = $running;
                if ($tmp_running != 0) {
                    array_push($live_symbols, $symbol);
                    array_push($live_leverage, $leverage);
                    array_push($live_limit, $limit);
                } else {
                    array_push($stop_symbols, $symbol);
                    array_push($stop_leverage, $leverage);
                    array_push($stop_limit, $limit);
                }
                if ($running > 0) {
                    array_push($live_running, $running);
                }
                $sub_arr = array();
                array_push($sub_arr, $row);
            }
        }
        if (count($sub_arr) > 0) {
            if ($tmp_running != 0) {
                array_push($live_arr, $sub_arr);
                array_push($live_running, $running);
            } else {
                array_push($stop_arr, $sub_arr);
            }
        }
        $hold_status = array();
        for ($i = 0; $i < count($live_symbols); $i++) {
            $symbol = $live_symbols[$i];
            $sql = "SELECT a.coin_id, a.coin_name, b.user_num, b.hold_status ";
            $sql .= "FROM fix_coins AS a ";
            $sql .= "LEFT JOIN tbl_live_coins AS b ON b.coin_num=a.coin_id ";
            $sql .= "WHERE b.user_num = ".$user_num." AND a.market = '".$market."' AND a.coin_name = '".$symbol."' ";
            $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
            $hold = 0;
            if (count($rows) > 0)
                $hold = $rows[0]->hold_status;
            array_push($hold_status, $hold);
        }


        return \Response::json([
            'msg' => 'ok',
            'live_lists' => $live_arr,
            'stop_lists' => $stop_arr,
            'live_symbols' => $live_symbols,
            'stop_symbols' => $stop_symbols,
            'live_leverage' => $live_leverage,
            'live_limit' => $live_limit,
            'stop_leverage' => $stop_leverage,
            'stop_limit' => $stop_limit,
            'live_running' => $live_running,
            'hold_status' => $hold_status
        ]);
    }

    //거래주문 현재 미체결된 주문과 체결된 주문 리스트
    public function getDefaultCurrentOrderList(Request $request) {
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        $symbol = $request->post('symbol');
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());
        $beforeDay = date("Y-m-d", strtotime($today." -1 day"));
        $price = $this->getPrice($market, $symbol);
        $row = DB::table('tbl_user_info')->where('id', 'liveacc')->get()->first();
        $user_num = $row->num;

        $sql = "SELECT ";
        $sql .= "user_num, coin_num, profit_money, fee_money, ";
        $sql .= "side, symbol, market, leverage, order_money, ";
        $sql .= "order_price, make_money, make_price, live_status, order_position, ";
        $sql .= "tp_price, sl_price ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num=".$user_num." AND symbol='".$symbol."' ";
        $sql .= "AND market='".$market."' ";
        $sql .= "AND make_money='0' ";
        if (strcmp($search_date, $today) == 0) {
            $sql .= "AND (SUBSTRING(order_date, 1, 10)='".$search_date."' ";
            $sql .= "OR SUBSTRING(order_date, 1, 10)='".$beforeDay."' ";
            $sql .= "OR make_date='') ";
        } else {
            $sql .= "AND SUBSTRING(order_date, 1, 10)='".$search_date."' ";
        }
        $sql .= "ORDER BY coin_num, order_date DESC";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        return \Response::json([
            'msg' => 'ok',
            'lists' => $rows,
            'c_price' => $price
        ]);
    }
    public function getCurrentOrderList(Request $request) {
        $user_num = $request->session()->get('user_num');
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        $symbol = $request->post('symbol');
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());
        $beforeDay = date("Y-m-d", strtotime($today." -1 day"));
        $price = $this->getPrice($market, $symbol);

        $sql = "SELECT ";
        $sql .= "user_num, coin_num, profit_money, fee_money, ";
        $sql .= "side, symbol, market, leverage, order_money, ";
        $sql .= "order_price, make_money, make_price, live_status, order_position, ";
        $sql .= "tp_price, sl_price ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num=".$user_num." AND symbol='".$symbol."' ";
        $sql .= "AND market='".$market."' ";
        $sql .= "AND make_money='0' ";
        if (strcmp($search_date, $today) == 0) {
            $sql .= "AND (SUBSTRING(order_date, 1, 10)='".$search_date."' ";
            $sql .= "OR SUBSTRING(order_date, 1, 10)='".$beforeDay."' ";
            $sql .= "OR make_date='') ";
        } else {
            $sql .= "AND SUBSTRING(order_date, 1, 10)='".$search_date."' ";
        }
        $sql .= "ORDER BY coin_num, order_date DESC";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        return \Response::json([
            'msg' => 'ok',
            'lists' => $rows,
            'c_price' => $price
        ]);
    }
    private function getPrice($market, $symbol)
    {
        $sip = getenv("REDIS_HOST");
        $spw = getenv("REDIS_PASSWORD");

        $redis = Redis::connection();
        $redis->connect($sip, 6379);
        $redis->auth($spw);

        $key = strtoupper($market) . '_' . strtoupper($symbol);
        $price = $redis->get($key);
        if ($price == null || $price == '')
            return 0;
        return $price;
    }
}
