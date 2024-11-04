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

class UserFriendController extends BaseController
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

    //친구 수익상태 리스트
    public function getFriendProfitList(Request $request) {
        $user_num = $request->session()->get('user_num');
        $pstart = $request->post('pstart');
        $search_date = $request->post('search_date');
        $pages = $request->post('pages');


    }

    //친구 친구 할인율 설정
    public function setFriendDiscount(Request $request) {
        $user_num = $request->session()->get('user_num');
        $friend_num = (int)$request->post('friend_num');
        $discount_rate = $request->post('discount_rate');

        $sql = "SELECT * FROM tbl_user_friend ";
        $sql .= "WHERE user_num = ".$user_num;
        if ($friend_num != 0) {
            $sql .= " AND friend_num = ".$friend_num;
        }
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $success = 0;
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $success = DB::table('tbl_user_friend')->where([['user_num', $user_num], ['friend_num', $row->friend_num]])
                ->update(
                    [
                        'friend_fee' => $discount_rate
                    ]
                );
            $success = DB::table('tbl_user_info')->where([['agent_num', $user_num], ['num', $row->friend_num]])
                ->update(
                    [
                        'agent_fee' => $discount_rate
                    ]
                );
        }
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

    //친구 정산 리스트
    public function getSettlementList(Request $request) {
        $user_num = $request->session()->get('user_num');
        $pstart = $request->post('pstart');
        $search_date = $request->post('search_date');
        $pages = $request->post('pages');

        $sql = "SELECT * FROM tbl_profit_friend ";
        $sql .= "WHERE user_num = ".$user_num;
        $sql .= " AND create_date LIKE '".$search_date."%'";
        $sql .= " ORDER BY create_date DESC ";
        $lim_sql = $sql.'LIMIT '.$pstart.', '.$pages;
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($lim_sql));
        $total_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $total = count($total_rows);
        $total_page = ceil($total / $pages);
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

    //친구 포인트 리스트
    public function getPointsList(Request $request) {
        $user_num = $request->session()->get('user_num');
        $pstart = $request->post('pstart');
        $search_date = $request->post('search_date');
        $pages = $request->post('pages');


    }

}
