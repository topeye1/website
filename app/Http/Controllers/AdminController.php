<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Dotenv\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

//use phpseclib3\Crypt\PublicKeyLoader;

class AdminController extends BaseController
{
    protected $tb_admin_info='tb_admin_info';
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
    public function indexNav($page, $nav){
        if(view()->exists($page)){
            return view($page, ['nav' => $nav]);
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

    public function logout()
    {
        $user_phone = session('user_phone',null);
        if(!is_null($user_phone))
            DB::table('tbl_user_info')->where('phone', $user_phone)->update(['actived' => 0]);

        session()->forget('user');
        session()->forget('user_id');
        session()->forget('user_phone');
        session()->forget('user_name');
        session()->forget('pages');
        session()->forget('locale');

        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 3600); // 만료 시간을 이전으로 설정
                setcookie($name, '', time() - 3600, '/'); // 경로 설정
            }
        }

        return redirect('/');
    }

    public function registerNewPassword(Request $request){
        $user_phone = $request->post('user_phone');
        $new_pwd = $request->post('new_pwd');
        $enc_password = Hash::make($new_pwd);

        $success = DB::table($this->tb_admin_info)->where('user_phone', $user_phone)
            ->update(
                [
                    'password' => $enc_password
                ]
            );

        if ($success) {
            return \Response::json([
                'msg' => 'ok'
            ]);
        }
        else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }

    public function dashborad(Request $request){
        return \Response::json([
            'msg' => 'ok',
            'lists' => [],
        ]);
    }

    /***** auth part  *****/
    //대시보드 정보
    public function getDashboardInfo(Request $request){
        date_default_timezone_set('Asia/Shanghai');
        $now_date = date("Y-m-d", time());

        //총유저수
        $sql = "SELECT COUNT(id) AS cnt FROM tbl_user_info ";
        $sql .= " WHERE permission = 0";
        $total_users = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        //액티브 유저수
        $live_sql = "SELECT COUNT(is_run) as liveCnt, user_num FROM tbl_live_coins WHERE is_run=1 ";
        $live_sql .= "GROUP BY user_num ";
        $live_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($live_sql));
        if ($live_rows) {
            for ($i = 0; $i < count($live_rows); $i++) {
                $live_row = $live_rows[$i];
                if ((int)$live_row->liveCnt > 0) {
                    DB::table('tbl_user_info')->where('num', $live_row->user_num)
                        ->update(
                            [
                                'enabled' => 1
                            ]
                        );
                }
            }
        }
        $sql = "SELECT COUNT(id) AS cnt FROM tbl_user_info ";
        $sql .= " WHERE permission = 0 AND enabled = 1";
        $actived_users = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        //에이전트
        $sql = "SELECT COUNT(id) AS cnt FROM tbl_user_info ";
        $sql .= " WHERE permission = 0 AND level >= 6";
        $agent_users = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        //포인트 결제 요청

        //일 사용 유저수
        $sql = "SELECT COUNT(id) AS cnt FROM tbl_user_info ";
        $sql .= " WHERE permission = 0 AND SUBSTRING(create_date, 1, 10) = '".$now_date."'";
        $new_users = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));


        return \Response::json([
            'msg' => 'ok',
            'total_users' => $total_users[0]->cnt,
            'actived_users' => $actived_users[0]->cnt,
            'agent_users' => $agent_users[0]->cnt,
            'new_users' => $new_users[0]->cnt,
            'req_point' => '0'
        ]);
    }


    public function getWebPageSetting(Request $request)
    {
        $show_language = $request->session()->get('locale');
        $show_count = $request->session()->get('pages');

        $success = DB::table('tbl_web_setting')
            ->update(
                [
                    'show_language' => $show_language,
                    'show_count' => $show_count
                ]
            );

        return \Response::json([
            'msg' => 'ok',
            'show_language' => $show_language,
            'show_count' => $show_count
        ]);
    }

    //유저 리스트
    public function getAllUserList(Request $request)
    {
        $search_val = $request->post('search_val');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;


        $sql = "SELECT num, id, phone, name, actived, level, my_fee, SUBSTRING(create_date, 1, 10) as create_date, SUBSTRING(login_date, 1, 10) as login_date ";
        $sql .= "FROM tbl_user_info ";
        $sql .= "WHERE permission = 0 ";

        if(!is_null($search_val))
            $sql .= ' AND (id like "%'.$search_val.'%" OR name like "%'.$search_val.'%" OR phone like "%'.$search_val.'%") ';
        $lim_sql = $sql.' ORDER BY create_date DESC LIMIT '.$start_from.', '.$count;

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

    // 유저 추가하기
    public function addNewUserInfo(Request $request) {
        $user_id = $request->post('user_id');
        $user_pwd = $request->post('user_pwd');
        $user_name = $request->post('user_name');
        $user_phone = $request->post('user_phone');
        $user_level = $request->post('user_level');
        $user_fee = $request->post('user_fee');
        $user_active = $request->post('user_active');
        $active = 0;
        if ($user_active)
            $active = 1;
        date_default_timezone_set('Asia/Shanghai');
        $create_date = date("Y-m-d H:i:s", time());

        $cnt = DB::table('tbl_user_info')->where('id', $user_id)->doesntExist();
        if (!$cnt){ // exist
            return \Response::json([
                'msg' => 'du'
            ]);

            exit();
        }
        $success = DB::table('tbl_user_info')
            ->insert(
                [
                    'name' => $user_name,
                    'id' => $user_id,
                    'password' => Hash::make($user_pwd),
                    'phone' => $user_phone,
                    'actived' => $active,
                    'level' => $user_level,
                    'my_fee' => $user_fee,
                    'create_date' => $create_date
                ]
            );
        $u_row = DB::table('tbl_user_info')->where('id', $user_id)->get()->first();
        $success = DB::table('tbl_trade_setting')
            ->insert(
                [
                    'user_num' => $u_row->num,
                    'market' => 'htx',
                    'update_date' => $create_date
                ]
            );
        $success = DB::table('tbl_trade_setting')
            ->insert(
                [
                    'user_num' => $u_row->num,
                    'market' => 'bin',
                    'update_date' => $create_date
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

    //액티브 상태
    public function checkUserActived(Request $request) {
        $num = $request->post('num');
        $checked = $request->post('checked');
        date_default_timezone_set('Asia/Shanghai');
        $log_date = date("Y-m-d H:i:s", time());
        $active = 0;
        if ($checked)
            $active = 1;
        $admin_id = $request->session()->get('user_id');
        $success = DB::table('tbl_user_info')->where('num', $num)
            ->update(
                [
                    'actived' => $active
                ]
            );

        if ($success) {
            DB::table('tbl_user_log')
                ->insert(
                    [
                        'user_num' => $num,
                        'edit_field' => 'Active',
                        'edit_val' => $active,
                        'edit_admin' => $admin_id,
                        'log_date' => $log_date
                    ]
                );
            return \Response::json([
                'msg' => 'ok'
            ]);
        } else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }

    //유저 정보 수정하기
    public function setEditUserInfo(Request $request) {
        $admin_id = $request->session()->get('user_id');
        $user_num = (int)$request->post('user_num');
        $user_id = $request->post('user_id');
        $user_pwd = $request->post('user_pwd');
        $user_name = $request->post('user_name');
        $user_phone = $request->post('user_phone');
        $user_level = (int)$request->post('user_level');
        $user_fee = (int)$request->post('user_fee');
        $user_active = (int)$request->post('user_active');

        date_default_timezone_set('Asia/Shanghai');
        $update_date = date("Y-m-d H:i:s", time());

        $row = DB::table('tbl_user_info')->where('num', $user_num)->get();

        $success = DB::table('tbl_user_info')->where('num', $user_num)
            ->update(
                [
                    'name' => $user_name,
                    'id' => $user_id,
                    'password' => Hash::make($user_pwd),
                    'phone' => $user_phone,
                    'actived' => $user_active,
                    'level' => $user_level,
                    'my_fee' => $user_fee,
                    'update_date' => $update_date
                ]
            );
        if ($success) {
            $edit_fields = array();
            $edit_values = array();
            if ($row[0]->id !== $user_id) {
                array_push($edit_fields, 'id');
                array_push($edit_values, $user_id);
            }
            if ($row[0]->name !== $user_name) {
                array_push($edit_fields, 'name');
                array_push($edit_values, $user_name);
            }
            if ($row[0]->phone !== $user_phone) {
                array_push($edit_fields, 'phone');
                array_push($edit_values, $user_phone);
            }
            if ($row[0]->actived !== $user_active) {
                array_push($edit_fields, 'actived');
                array_push($edit_values, $user_active);
            }
            if ($row[0]->level !== $user_level) {
                array_push($edit_fields, 'level');
                array_push($edit_values, $user_level);
            }
            if ($row[0]->my_fee !== $user_fee) {
                array_push($edit_fields, 'my_fee');
                array_push($edit_values, $user_fee);
            }
            for ($i = 0; $i < count($edit_fields); $i++) {
                DB::table('tbl_user_log')
                    ->insert(
                        [
                            'user_num' => $user_num,
                            'edit_field' => $edit_fields[$i],
                            'edit_val' => $edit_values[$i],
                            'edit_admin' => $admin_id
                        ]
                    );
            }
            return \Response::json([
                'msg' => 'ok'
            ]);
        } else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }

    //유저 삭제
    public function setDeleteUserInfo(Request $request)
    {
        $num = $request->post('num');
        $success = DB::table('tbl_user_info')->where('num', $num)->delete();
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

    //수정내역 보기
    public function getEditHistoryInfo(Request $request)
    {
        $user_num = $request->post('user_num');

        $sql = "SELECT log_date, edit_admin, edit_field, edit_val ";
        $sql .= "FROM tbl_user_log ";
        $sql .= "WHERE user_num=".$user_num;

        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        if($rows == null){
            return \Response::json([
                'msg' => 'err'
            ]);
        }
        else{
            return \Response::json([
                'msg' => 'ok',
                'lists' => $rows,
            ]);
        }
    }

    //유저 수익 보기
    public function getUserRevenueList(Request $request)
    {
        $pages = $request->session()->get('pages');
        $search_val = $request->post('search_val');
        $search_date = $request->post('search_date');
        $pstart = $request->post('pstart');
        $date_idx = $request->post('date_idx');
        $start_from = ($pstart-1) * $pages;

        $sql = "SELECT a.user_num, a.hold_money, SUM(a.profit_money) as profit, ";
        $sql .= "SUM(a.fee_money) AS fee, SUM(a.coupon) AS coupon, ";
        $sql .= "a.make_date, b.id, b.phone, b.name ";
        $sql .= "FROM tbl_trade_order AS a ";
        $sql .= "LEFT JOIN tbl_user_info AS b ON b.num = a.user_num ";
        $sql .= "WHERE 1 ";
        if ($date_idx == 1) {
            $sql .= "AND SUBSTRING(a.make_date, 1, 10)='" . $search_date . "' ";
        }
        else if ($date_idx == 2) {
            $sql .= "AND SUBSTRING(a.make_date, 1, 7)='" . $search_date . "' ";
        } else {
            $sql .= "AND SUBSTRING(a.make_date, 1, 4)='" . $search_date . "' ";
        }
        $sql .= "AND a.profit_money != 'OK' ";
        if(!is_null($search_val))
            $sql .= ' AND (b.id like "%'.$search_val.'%" OR b.name like "%'.$search_val.'%" OR b.phone like "%'.$search_val.'%") ';
        $sql .= "GROUP BY a.user_num ";
        $sql .= "ORDER BY a.user_num, a.make_date ASC ";
        $lim_sql = $sql."LIMIT ".$start_from.", ".$pages;
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($lim_sql));
        $total_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $total = count($total_rows);
        $total_page = ceil($total / $pages);

        $lists = array();
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $hold_money = $row->hold_money;
            $profit = $row->profit;
            $fee = abs($row->fee);
            $profit_rate = ((float)$profit / (float)$hold_money) * 100;
            $fee_rate = ((float)$fee / (float)$hold_money) * 100;
            $real_profit = (float)$profit - (float)$fee;

            $data = array(
                'user_num' => $row->user_num,
                'user_id' => $row->id,
                'user_phone' => $row->phone,
                'user_name' => $row->name,
                'amount' => round($hold_money, 3),
                'profit' => round($profit, 5),
                'profit_rate' => round($profit_rate, 5),
                'fee_rate' => round($fee_rate, 5),
                'fee' => round($fee, 5),
                'real_profit' => round($real_profit, 5),
                'coupon' => round($row->coupon, 5)
            );

            array_push($lists, $data);
        }

        return \Response::json([
            'msg' => 'ok',
            'total'    =>  $total,
            'pstart'    =>  $pstart,
            'totalpage'    =>  $total_page,
            'lists' => $lists,
        ]);
    }

    //쿠폰수익-쿠폰별 보기
    public function getCouponRevenueCouponList(Request $request)
    {
        $search_date = $request->post('search_date');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;
    }

    //쿠폰수익-유저별 보기
    public function getCouponRevenueUserList(Request $request)
    {
        $search_date = $request->post('search_date');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;
    }

} // area of class
