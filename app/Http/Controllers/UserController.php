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

class UserController extends BaseController
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

    //나의 정보 얻기
    public function getDefaultMyInfo(Request $request) {
        $market = 'htx';
        $row = DB::table('tbl_user_info')->where('id', 'liveacc')->get()->first();
        $my_id = $row->id;
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());

        return \Response::json([
            'msg' => 'ok',
            'my_coupon' => $row->coupon,
            'my_fee' => $row->my_fee,
            'my_points' => $row->point,
            'market' => $market,
            'my_level' => $row->level,
            'my_id' => $my_id,
            'my_name' => $row->name,
            'today' => $today
        ]);
    }
    public function getMyInfo(Request $request) {
        $market = $request->session()->get('market');
        $user_num = $request->session()->get('user_num');
        $my_id = $request->session()->get('user_id');
        $my_level = $request->session()->get('user_level');
        $row = DB::table('tbl_user_info')->where('num', $user_num)->get()->first();
        date_default_timezone_set('Asia/Shanghai');
        $today = @date("Y-m-d", time());

        return \Response::json([
            'msg' => 'ok',
            'my_coupon' => $row->coupon,
            'my_fee' => $row->my_fee,
            'my_points' => $row->point,
            'market' => $market,
            'my_level' => $row->level,
            'my_id' => $my_id,
            'my_name' => $row->name,
            'today' => $today
        ]);
    }
    //market 설정
    public function setMarket(Request $request) {
        $market = $request->post('market');
        session()->forget('market');
        session()->put('market', $market);

        return \Response::json([
            'msg' => 'ok',
            'market' => $market,
        ]);
    }

    //쿠폰 리스트 정보
    public function getCouponsInfo(Request $request) {
        $user_num = $request->session()->get('user_num');
        $market = $request->post('market');

        $sql = "SELECT b.value AS max_amount ";
        $sql .= "FROM tbl_trade_setting AS a ";
        $sql .= "LEFT JOIN fix_trade_money AS b ON b.fid = a.trade_money_id ";
        $sql .= "WHERE a.user_num = ".$user_num." AND a.market='".$market."'";
        $brow = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $sql = "SELECT * FROM tbl_coupon ORDER BY create_date ASC";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        return \Response::json([
            'msg' => 'ok',
            'max_amount' => $brow[0]->max_amount,
            'lists' => $rows,
        ]);
    }

    //쿠폰 구매 내역
    public function getCouponsHistory(Request $request) {
        $user_num = $request->session()->get('user_num');
        $pstart = $request->post('pstart');
        $count = $request->post('pages');
        $start_from = ($pstart-1) * $count;

        $sql = "SELECT a.date_buy, a.price_buy, b.coupon_name, a.level, a.amount_used, a.date_due, a.status, a.amount_given ";
        $sql .= "FROM tbl_coupon_user AS a ";
        $sql .= "LEFT JOIN tbl_coupon AS b ON b.coupon_num = a.coupon_num ";
        $sql .= "WHERE a.user_num = ".$user_num;
        $lim_sql = $sql.' ORDER BY a.date_buy DESC LIMIT '.$start_from.', '.$count;
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($lim_sql));
        $total_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $total = count($total_rows);
        $total_page = ceil($total / $count);
        if($rows == null){
            return \Response::json([
                'msg' => 'err'
            ]);
        }
        else{
            return \Response::json([
                'msg' => 'ok',
                'total'    =>  $total,
                'pstart'    =>  $pstart,
                'totalpage'    =>  $total_page,
                'lists' => $rows,
            ]);
        }
    }

    //선택된 쿠폰 정보 얻기
    public function getSelectedCardInfo(Request $request) {
        $market = $request->session()->get('market');
        $user_num = $request->session()->get('user_num');
        $card_num = $request->post('card_num');
        $srow = DB::table('tbl_coupon')->where('coupon_num', $card_num)->get()->first();

        $sql = "SELECT a.coupon AS coupon, c.value AS max_amount ";
        $sql .= "FROM tbl_user_info AS a ";
        $sql .= "LEFT JOIN tbl_trade_setting AS b ON b.user_num = a.num ";
        $sql .= "LEFT JOIN fix_trade_money AS c ON c.fid = b.trade_money_id ";
        $sql .= "WHERE a.num = ".$user_num." AND b.market='".$market."'";
        $brow = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $row = DB::table('fix_payment_address')->get()->first();

        return \Response::json([
            'msg' => 'ok',
            'usdt_address' => $row->address_link,
            'my_coupon' => $brow[0]->coupon,
            'max_amount' => $brow[0]->max_amount,
            'lists' => $srow,
            'market' => $market,
        ]);
    }

    //유저가 보유한 포인트
    public function getUserHoldPoint(Request $request) {
        $user_num = $request->session()->get('user_num');
        $rows = DB::table('tbl_user_info')->where('num', $user_num)->get()->first();

        return \Response::json([
            'msg' => 'ok',
            'point' => $rows->point
        ]);
    }

}
