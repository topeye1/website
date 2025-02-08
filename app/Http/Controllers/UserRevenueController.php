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

class UserRevenueController extends BaseController
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

    //월 수익 정보
    public function getDefaultRevenueInfo(Request $request) {
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        $date_idx = (int)$request->post('date_idx');
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());

        $row = DB::table('tbl_user_info')->where('id', 'liveacc')->get()->first();
        $user_num = $row->num;

        // 현재 일의 수익
        $sql = "SELECT SUM(profit_money) as d_profit ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        $sql .= "AND SUBSTRING(make_date, 1, 10)='".$today."' ";
        $sql .= "AND profit_money != 'OK' ";
        $sql .= "GROUP BY SUBSTRING(make_date, 1, 10) ";
        $d_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $day_profit = 0;
        if (count($d_rows) > 0) {
            $d_row = $d_rows[0];
            $day_profit = round($d_row->d_profit, 3);
        }
        // 현재 보유금액
        $sql = "SELECT amount FROM tbl_market_amount WHERE user_num = ".$user_num." AND market='".$market."' AND date='".$today."'";
        $amount_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $current_amount = 0;
        if (count($amount_rows) > 0) {
            $current_amount = $amount_rows[0]->amount;
        }

        //월 수익, 년 수익
        $comp_date = $search_date;
        $data_split = explode("-", $today);
        if ($date_idx == 1) {
            $day1 = $search_date."-".$data_split[2];
        } else {
            $day1 = $search_date."-".$data_split[1]."-".$data_split[2];
            $comp_date = $search_date."-".$data_split[1];
        }
        $day2 = @date('Y-m-d', strtotime($day1."-1 year"));

        $sql = "SELECT profit_money, hold_money, ";
        $sql .= "SUBSTRING(make_date, 1, 7) as m_date ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        $sql .= "AND SUBSTRING(make_date, 1, 7)>='" . $day2 . "' ";
        $sql .= "AND SUBSTRING(make_date, 1, 7)<='" . $day1 . "' ";
        $sql .= "AND profit_money != 'OK' ";
        $sql .= "ORDER BY make_date DESC ";
        $m_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $m_total_profit = 0;
        $m_sum_rate = 0;
        $m_cnt = 0;
        $y_sum_rate = 0;
        $month_profit = 0;
        $month_rate = 0;
        $year_rate = 0;
        $pre_hold_money = $current_amount;
        if (count($m_rows) > 0) {
            for ($i = 0; $i < count($m_rows); $i++) {
                $row = $m_rows[$i];
                $m_date = $row->m_date;
                $profit_money = round($row->profit_money, 6);
                $hold_money = round($row->hold_money, 6);
                if ($hold_money == 0)
                    $hold_money = $pre_hold_money;
                else{
                    $pre_hold_money = $hold_money;
                }
                $d_rate = ($profit_money / $hold_money) * 100;
                if (strcmp($comp_date, $m_date) == 0) {
                    $m_total_profit += $row->profit_money;
                    $m_sum_rate += $d_rate;
                    $m_cnt++;
                }
                $y_sum_rate += $d_rate;
            }
            $month_profit = round($m_total_profit, 3);
            $month_rate = round($m_sum_rate, 3);
            $year_rate = round($y_sum_rate, 3);
        }
        return \Response::json([
            'msg' => 'ok',
            'day_profit' => $day_profit,
            'current_amount' => $current_amount,
            'month_profit' => $month_profit,
            'month_rate' => $month_rate,
            'year_rate' => $year_rate,
        ]);
    }
    public function getRevenueInfo(Request $request) {
        $user_num = $request->session()->get('user_num');
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        $date_idx = (int)$request->post('date_idx');
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());

        // 현재 일의 수익
        $sql = "SELECT SUM(profit_money) as d_profit ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        $sql .= "AND SUBSTRING(make_date, 1, 10)='".$today."' ";
        $sql .= "AND profit_money != 'OK' ";
        $sql .= "GROUP BY SUBSTRING(make_date, 1, 10) ";
        $d_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $day_profit = 0;
        if (count($d_rows) > 0) {
            $d_row = $d_rows[0];
            $day_profit = round($d_row->d_profit, 3);
        }
        // 현재 보유금액
        $sql = "SELECT amount FROM tbl_market_amount WHERE user_num = ".$user_num." AND market='".$market."' AND date='".$today."'";
        $amount_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $current_amount = 0;
        if (count($amount_rows) > 0) {
            $current_amount = $amount_rows[0]->amount;
        }

        //월 수익, 년 수익
        $comp_date = $search_date;
        $data_split = explode("-", $today);
        if ($date_idx == 1) {
            $day1 = $search_date."-".$data_split[2];
        } else {
            $day1 = $search_date."-".$data_split[1]."-".$data_split[2];
            $comp_date = $search_date."-".$data_split[1];
        }
        $day2 = @date('Y-m-d', strtotime($day1."-1 year"));

        $sql = "SELECT profit_money, hold_money, ";
        $sql .= "SUBSTRING(make_date, 1, 7) as m_date ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        $sql .= "AND SUBSTRING(make_date, 1, 7)>='" . $day2 . "' ";
        $sql .= "AND SUBSTRING(make_date, 1, 7)<='" . $day1 . "' ";
        $sql .= "AND profit_money != 'OK' ";
        $sql .= "ORDER BY make_date DESC ";
        $m_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $m_total_profit = 0;
        $m_sum_rate = 0;
        $m_cnt = 0;
        $y_sum_rate = 0;
        $month_profit = 0;
        $month_rate = 0;
        $year_rate = 0;
        $pre_hold_money = $current_amount;
        if (count($m_rows) > 0) {
            for ($i = 0; $i < count($m_rows); $i++) {
                $row = $m_rows[$i];
                $m_date = $row->m_date;
                $profit_money = round($row->profit_money, 6);
                $hold_money = round($row->hold_money, 6);
                if ($hold_money == 0)
                    $hold_money = $pre_hold_money;
                else{
                    $pre_hold_money = $hold_money;
                }
                $d_rate = ($profit_money / $hold_money) * 100;
                if (strcmp($comp_date, $m_date) == 0) {
                    $m_total_profit += $row->profit_money;
                    $m_sum_rate += $d_rate;
                    $m_cnt++;
                }
                $y_sum_rate += $d_rate;
            }
            $month_profit = round($m_total_profit, 3);
            $month_rate = round($m_sum_rate, 3);
            $year_rate = round($y_sum_rate, 3);
        }
        return \Response::json([
            'msg' => 'ok',
            'day_profit' => $day_profit,
            'current_amount' => $current_amount,
            'month_profit' => $month_profit,
            'month_rate' => $month_rate,
            'year_rate' => $year_rate,
        ]);
    }

    //코인별 수익 상태 리스트
    public function getDefaultCoinRevenueList(Request $request) {
        $pstart = $request->post('pstart');
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        $date_idx = (int)$request->post('date_idx');
        $pages = $request->post('pages');
        $start_from = ($pstart-1) * $pages;
        $row = DB::table('tbl_user_info')->where('id', 'liveacc')->get()->first();
        $user_num = $row->num;

        $sql = "SELECT symbol, hold_money, SUM(profit_money) as t_profit, bet_limit ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        if ($date_idx == 1) {
            $sql .= "AND SUBSTRING(make_date, 1, 7)='" . $search_date . "' ";
        } else {
            $sql .= "AND SUBSTRING(make_date, 1, 4)='" . $search_date . "' ";
        }
        $sql .= "AND profit_money != 'OK' ";
        $sql .= "GROUP BY symbol ";
        $sql .= "ORDER BY symbol, make_date DESC ";
        $lim_sql = $sql."LIMIT ".$start_from.", ".$pages;
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($lim_sql));
        $total_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $total = count($total_rows);
        $total_page = ceil($total / $pages);
        $pre_hold_money = 0;

        $symbol_list = array();
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $symbol = $row->symbol;
            $bet_limit = $row->bet_limit;
            $hold_money = $row->hold_money;
            if ($hold_money == 0)
                $hold_money = $pre_hold_money;
            else{
                $pre_hold_money = $hold_money;
            }
            $profit_money = $row->t_profit;

            $data = array(
                'symbol' => $symbol,
                'bet_limit' => $bet_limit,
                'amount' => round($hold_money, 3),
                'profit' => round($profit_money, 5)
            );

            array_push($symbol_list, $data);
        }

        return \Response::json([
            'msg' => 'ok',
            'total'    =>  $total,
            'pstart'    =>  $pstart,
            'totalpage'    =>  $total_page,
            'symbol_list' => $symbol_list,
        ]);

    }
    public function getCoinRevenueList(Request $request) {
        $user_num = $request->session()->get('user_num');
        $pstart = $request->post('pstart');
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        $date_idx = (int)$request->post('date_idx');
        $pages = $request->post('pages');
        $start_from = ($pstart-1) * $pages;

        $sql = "SELECT symbol, hold_money, SUM(profit_money) as t_profit, bet_limit ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        if ($date_idx == 1) {
            $sql .= "AND SUBSTRING(make_date, 1, 7)='" . $search_date . "' ";
        } else {
            $sql .= "AND SUBSTRING(make_date, 1, 4)='" . $search_date . "' ";
        }
        $sql .= "AND profit_money != 'OK' ";
        $sql .= "GROUP BY symbol ";
        $sql .= "ORDER BY symbol, make_date DESC ";
        $lim_sql = $sql."LIMIT ".$start_from.", ".$pages;
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($lim_sql));
        $total_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $total = count($total_rows);
        $total_page = ceil($total / $pages);
        $pre_hold_money = 0;

        $symbol_list = array();
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $symbol = $row->symbol;
            $bet_limit = $row->bet_limit;
            $hold_money = $row->hold_money;
            if ($hold_money == 0)
                $hold_money = $pre_hold_money;
            else{
                $pre_hold_money = $hold_money;
            }
            $profit_money = $row->t_profit;

            $data = array(
                'symbol' => $symbol,
                'bet_limit' => $bet_limit,
                'amount' => round($hold_money, 3),
                'profit' => round($profit_money, 5)
            );

            array_push($symbol_list, $data);
        }

        return \Response::json([
            'msg' => 'ok',
            'total'    =>  $total,
            'pstart'    =>  $pstart,
            'totalpage'    =>  $total_page,
            'symbol_list' => $symbol_list,
        ]);

    }

    //나의 수익 상태 리스트
    public function getDefaultMyRevenueList(Request $request) {
        $lang = 'en';
        $pstart = $request->post('mpstart');
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        $date_idx = (int)$request->post('date_idx');
        $pages = $request->post('pages');
        $start_from = ($pstart-1) * $pages;
        $row = DB::table('tbl_user_info')->where('id', 'liveacc')->get()->first();
        $user_num = $row->num;

        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());

        // admin page 에서 설정한 앱 수수료
        $param_row = DB::table('fix_params')->where('pname', 'm11')->get()->first();
        $app_pro = $param_row->pvalue;

        $c_date = $search_date;
        if ($date_idx == 1) {
            $c_date = $search_date."-01";
        }

        $sql = "SELECT hold_money, profit_money, fee_money, ";
        $sql .= "coupon, SUBSTRING(make_date, 1, 10) AS m_date ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        $sql .= "AND profit_money != 'OK' ";
        $sql .= "AND SUBSTRING(make_date, 1, 10) !='" . $today . "' ";
        if ($date_idx == 1) {
            $sql .= "AND SUBSTRING(make_date, 1, 7)='" . $search_date . "' ";
        } else {
            $sql .= "AND SUBSTRING(make_date, 1, 4)='" . $search_date . "' ";
        }
        $sql .= "ORDER BY make_date DESC ";
        //$lim_sql = $sql."LIMIT ".$start_from.", ".$pages;
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $tmp_date = '';
        $coupon = 0;
        $d_amount = 0;
        $d_profit = 0;
        $sum_rate = 0;
        $d_fee = 0;
        $d_real = 0;
        $cnt = 0;
        $d_date = '';
        $total = 0;
        $total_page = 0;
        $datas = array();
        $amount_list = array();
        $revenue_list = array();
        $pre_hold_money = 0;
        if (count($rows) > 0) {
            for ($i = 0; $i <= count($rows); $i++) {
                if ($i < count($rows)) {
                    $row = $rows[$i];
                    $date = $row->m_date;
                    if ($date_idx != 1) {
                        $split_date = explode("-", $row->m_date);
                        $date = $split_date[0]."-".$split_date[1];
                    }
                    $hold_money = $row->hold_money;
                    if ($hold_money == 0)
                        $hold_money = $pre_hold_money;
                    else{
                        $pre_hold_money = $hold_money;
                    }
                    $profit_money = $row->profit_money;
                    $rate = ($profit_money / $hold_money) * 100;
                    if (strcmp($date, $tmp_date) == 0) {
                        $sum_rate += $rate;
                        $d_profit += $profit_money;
                    } else {
                        if ($i != 0) {
                            $d_rate = $sum_rate;
                            $d_fee = $d_profit * (int)$app_pro / 100;
                            $d_real = $d_profit - abs($d_fee);
                            $list_data = array(
                                'date' => $d_date,
                                'amount' => round($d_amount, 3),
                                'profit' => round($d_profit, 5),
                                'rate' => round($d_rate, 3),
                                'fee' => round($d_fee, 5),
                                'real' => round($d_real, 5),
                                'coupon' => $coupon
                            );
                            array_push($datas, $list_data);
                            $cnt = 0;
                        }
                        $d_date = $date;
                        $coupon = $row->coupon;
                        $d_amount = $hold_money;
                        $d_profit = $profit_money;
                        $sum_rate = $rate;
                        $sql = "SELECT user_num, market, amount, date ";
                        $sql .= "FROM tbl_market_amount ";
                        $sql .= "WHERE user_num = ".$user_num." ";
                        $sql .= "AND market='".$market."' ";
                        $sql .= "AND date = '".$d_date."' ";
                        $amount_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
                        if ($amount_rows != null && count($amount_rows) > 0) {
                            $d_amount = $amount_rows[0]->amount;
                        }
                    }
                    $cnt++;
                    $tmp_date = $date;
                } else {
                    $d_rate = round($sum_rate, 5);
                    $d_fee = $d_profit * (int)$app_pro / 100;
                    $d_real = $d_profit - abs($d_fee);
                    $list_data = array(
                        'date' => $d_date,
                        'amount' => round($d_amount, 3),
                        'profit' => round($d_profit, 5),
                        'rate' => round($d_rate, 3),
                        'fee' => round($d_fee, 5),
                        'real' => round($d_real, 5),
                        'coupon' => $coupon
                    );
                    array_push($datas, $list_data);
                }

            }

            $total = count($datas);
            $total_page = ceil($total / $pages);
            $revenue_list = array_slice($datas, $start_from, $pages);
        }
        $assetDatas = array();
        $roiDatas = array();
        $profitDatas = array();
        $live_coins = array();

        if ($date_idx == 1) {
            $day_count = date('t', strtotime($c_date));
            for ($i = 1; $i <= $day_count; $i++) {
                $amount = 0;
                $coins = 0;
                $profit = 0;
                $rate = 0;
                for ($j = 0; $j < count($datas); $j++) {
                    $data = $datas[$j];
                    $date = explode('-', $data['date']);
                    $day = $date[2];
                    if ($i == (int)$day) {
                        $amount = $data['amount'];
                        $profit = $data['profit'];
                        $rate = $data['rate'];

                        $sql = "SELECT COUNT(symbol) as symbolCnt, make_date ";
                        $sql .= "FROM tbl_trade_order ";
                        $sql .= "WHERE user_num = ".$user_num." ";
                        $sql .= "AND market='".$market."' ";
                        $sql .= "AND SUBSTRING(make_date, 1, 10)='" . $data['date'] . "' ";
                        $sql .= "GROUP BY symbol ";
                        $sql .= "ORDER BY make_date DESC ";
                        $symbol_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
                        if ($symbol_rows) {
                            $coins = count($symbol_rows);
                        }

                        break;
                    }
                }
                array_push($assetDatas, $amount);
                array_push($live_coins, $coins);
                array_push($roiDatas, $rate);
                array_push($profitDatas, $profit);
            }
        } else {
            $day_count = 12;
            for ($i = 1; $i <= $day_count; $i++) {
                $amount = 0;
                $coins = 0;
                $profit = 0;
                $rate = 0;
                $temp_amount = 0;
                for ($j = 0; $j < count($datas); $j++) {
                    $data = $datas[$j];
                    $date = explode('-', $data['date']);
                    $year = $date[0];
                    $month = $date[1];
                    if ((int)$search_date == (int)$year && $i == (int)$month) {
                        if ($amount <= $temp_amount) {
                            $amount = $data['amount'];
                        }
                        $profit += $data['profit'];
                        $rate += $data['rate'];

                        $sql = "SELECT COUNT(symbol) as symbolCnt, make_date ";
                        $sql .= "FROM tbl_trade_order ";
                        $sql .= "WHERE user_num = ".$user_num." ";
                        $sql .= "AND market='".$market."' ";
                        $sql .= "AND SUBSTRING(make_date, 1, 7)='" . $data['date'] . "' ";
                        $sql .= "GROUP BY symbol ";
                        $sql .= "ORDER BY make_date DESC ";
                        $symbol_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
                        if ($symbol_rows) {
                            $coins = count($symbol_rows);
                        }
                        $temp_amount = $data['amount'];
                        break;
                    }
                }
                array_push($assetDatas, $amount);
                array_push($live_coins, $coins);
                array_push($roiDatas, $rate);
                array_push($profitDatas, $profit);
            }
        }

        return \Response::json([
            'msg' => 'ok',
            'total'    =>  $total,
            'pstart'    =>  $pstart,
            'totalpage'    =>  $total_page,
            'revenue_list' => $revenue_list,
            'assetDatas' => $assetDatas,
            'liveCoins' => $live_coins,
            'roiDatas' => $roiDatas,
            'profitDatas' => $profitDatas,
            'lang' => $lang
        ]);
    }
    public function getMyRevenueList(Request $request) {
        $user_num = $request->session()->get('user_num');
        $lang = $request->session()->get('locale');
        $pstart = $request->post('mpstart');
        $search_date = $request->post('search_date');
        $market = $request->post('market');
        $date_idx = (int)$request->post('date_idx');
        $pages = $request->post('pages');
        $start_from = ($pstart-1) * $pages;

        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());

        // admin page 에서 설정한 앱 수수료
        $param_row = DB::table('fix_params')->where('pname', 'm11')->get()->first();
        $app_pro = $param_row->pvalue;

        $c_date = $search_date;
        if ($date_idx == 1) {
            $c_date = $search_date."-01";
        }

        $sql = "SELECT hold_money, profit_money, fee_money, ";
        $sql .= "coupon, SUBSTRING(make_date, 1, 10) AS m_date ";
        $sql .= "FROM tbl_trade_order ";
        $sql .= "WHERE user_num = ".$user_num." ";
        $sql .= "AND market='".$market."' ";
        $sql .= "AND profit_money != 'OK' ";
        $sql .= "AND SUBSTRING(make_date, 1, 10) !='" . $today . "' ";
        if ($date_idx == 1) {
            $sql .= "AND SUBSTRING(make_date, 1, 7)='" . $search_date . "' ";
        } else {
            $sql .= "AND SUBSTRING(make_date, 1, 4)='" . $search_date . "' ";
        }
        $sql .= "ORDER BY make_date DESC ";
        //$lim_sql = $sql."LIMIT ".$start_from.", ".$pages;
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $tmp_date = '';
        $coupon = 0;
        $d_amount = 0;
        $d_profit = 0;
        $sum_rate = 0;
        $d_fee = 0;
        $d_real = 0;
        $cnt = 0;
        $d_date = '';
        $total = 0;
        $total_page = 0;
        $datas = array();
        $amount_list = array();
        $revenue_list = array();
        $pre_hold_money = 0;
        if (count($rows) > 0) {
            for ($i = 0; $i <= count($rows); $i++) {
                if ($i < count($rows)) {
                    $row = $rows[$i];
                    $date = $row->m_date;
                    if ($date_idx != 1) {
                        $split_date = explode("-", $row->m_date);
                        $date = $split_date[0]."-".$split_date[1];
                    }
                    $hold_money = $row->hold_money;
                    if ($hold_money == 0)
                        $hold_money = $pre_hold_money;
                    else{
                        $pre_hold_money = $hold_money;
                    }
                    $profit_money = $row->profit_money;
                    $rate = ($profit_money / $hold_money) * 100;
                    if (strcmp($date, $tmp_date) == 0) {
                        $sum_rate += $rate;
                        $d_profit += $profit_money;
                    } else {
                        if ($i != 0) {
                            $d_rate = $sum_rate;
                            $d_fee = $d_profit * (int)$app_pro / 100;
                            $d_real = $d_profit - abs($d_fee);
                            $list_data = array(
                                'date' => $d_date,
                                'amount' => round($d_amount, 3),
                                'profit' => round($d_profit, 5),
                                'rate' => round($d_rate, 3),
                                'fee' => round($d_fee, 5),
                                'real' => round($d_real, 5),
                                'coupon' => $coupon
                            );
                            array_push($datas, $list_data);
                            $cnt = 0;
                        }
                        $d_date = $date;
                        $coupon = $row->coupon;
                        $d_amount = $hold_money;
                        $d_profit = $profit_money;
                        $sum_rate = $rate;
                        $sql = "SELECT user_num, market, amount, date ";
                        $sql .= "FROM tbl_market_amount ";
                        $sql .= "WHERE user_num = ".$user_num." ";
                        $sql .= "AND market='".$market."' ";
                        $sql .= "AND date = '".$d_date."' ";
                        $amount_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
                        if ($amount_rows != null && count($amount_rows) > 0) {
                            $d_amount = $amount_rows[0]->amount;
                        }
                    }
                    $cnt++;
                    $tmp_date = $date;
                } else {
                    $d_rate = round($sum_rate, 5);
                    $d_fee = $d_profit * (int)$app_pro / 100;
                    $d_real = $d_profit - abs($d_fee);
                    $list_data = array(
                        'date' => $d_date,
                        'amount' => round($d_amount, 3),
                        'profit' => round($d_profit, 5),
                        'rate' => round($d_rate, 3),
                        'fee' => round($d_fee, 5),
                        'real' => round($d_real, 5),
                        'coupon' => $coupon
                    );
                    array_push($datas, $list_data);
                }

            }

            $total = count($datas);
            $total_page = ceil($total / $pages);
            $revenue_list = array_slice($datas, $start_from, $pages);
        }
        $assetDatas = array();
        $roiDatas = array();
        $profitDatas = array();
        $live_coins = array();

        if ($date_idx == 1) {
            $day_count = date('t', strtotime($c_date));
            for ($i = 1; $i <= $day_count; $i++) {
                $amount = 0;
                $coins = 0;
                $profit = 0;
                $rate = 0;
                for ($j = 0; $j < count($datas); $j++) {
                    $data = $datas[$j];
                    $date = explode('-', $data['date']);
                    $day = $date[2];
                    if ($i == (int)$day) {
                        $amount = $data['amount'];
                        $profit = $data['profit'];
                        $rate = $data['rate'];

                        $sql = "SELECT COUNT(symbol) as symbolCnt, make_date ";
                        $sql .= "FROM tbl_trade_order ";
                        $sql .= "WHERE user_num = ".$user_num." ";
                        $sql .= "AND market='".$market."' ";
                        $sql .= "AND SUBSTRING(make_date, 1, 10)='" . $data['date'] . "' ";
                        $sql .= "GROUP BY symbol ";
                        $sql .= "ORDER BY make_date DESC ";
                        $symbol_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
                        if ($symbol_rows) {
                            $coins = count($symbol_rows);
                        }

                        break;
                    }
                }
                array_push($assetDatas, $amount);
                array_push($live_coins, $coins);
                array_push($roiDatas, $rate);
                array_push($profitDatas, $profit);
            }
        } else {
            $day_count = 12;
            for ($i = 1; $i <= $day_count; $i++) {
                $amount = 0;
                $coins = 0;
                $profit = 0;
                $rate = 0;
                $temp_amount = 0;
                for ($j = 0; $j < count($datas); $j++) {
                    $data = $datas[$j];
                    $date = explode('-', $data['date']);
                    $year = $date[0];
                    $month = $date[1];
                    if ((int)$search_date == (int)$year && $i == (int)$month) {
                        if ($amount <= $temp_amount) {
                            $amount = $data['amount'];
                        }
                        $profit += $data['profit'];
                        $rate += $data['rate'];

                        $sql = "SELECT COUNT(symbol) as symbolCnt, make_date ";
                        $sql .= "FROM tbl_trade_order ";
                        $sql .= "WHERE user_num = ".$user_num." ";
                        $sql .= "AND market='".$market."' ";
                        $sql .= "AND SUBSTRING(make_date, 1, 7)='" . $data['date'] . "' ";
                        $sql .= "GROUP BY symbol ";
                        $sql .= "ORDER BY make_date DESC ";
                        $symbol_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
                        if ($symbol_rows) {
                            $coins = count($symbol_rows);
                        }
                        $temp_amount = $data['amount'];
                        break;
                    }
                }
                array_push($assetDatas, $amount);
                array_push($live_coins, $coins);
                array_push($roiDatas, $rate);
                array_push($profitDatas, $profit);
            }
        }

        return \Response::json([
            'msg' => 'ok',
            'total'    =>  $total,
            'pstart'    =>  $pstart,
            'totalpage'    =>  $total_page,
            'revenue_list' => $revenue_list,
            'assetDatas' => $assetDatas,
            'liveCoins' => $live_coins,
            'roiDatas' => $roiDatas,
            'profitDatas' => $profitDatas,
            'lang' => $lang
        ]);
    }

}
