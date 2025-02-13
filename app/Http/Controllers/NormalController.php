<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Dotenv\Validator;
use mysql_xdevapi\Exception;

class NormalController extends BaseController
{
    public function __construct(Request $request) {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

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

    //사용현황 리스트
    public function getUsageStatusList(Request $request) {
        $search_val = $request->post('search_val');
        $pstart = $request->post('pstart');
        $pages = $request->session()->get('pages');
        $start_from = ($pstart-1) * $pages;

        $sql = "SELECT a.num, a.phone, a.name, a.level, ";
        $sql .= "COUNT(b.coin_num) AS live_cnt, b.market, c.amount ";
        $sql .= "FROM tbl_user_info AS a ";
        $sql .= "LEFT JOIN tbl_live_coins AS b ON b.user_num = a.num ";
        $sql .= "LEFT JOIN tbl_market_amount AS c ON c.user_num = a.num ";
        $sql .= "WHERE b.is_run = 1 ";
        $sql .= "AND c.market = b.market ";
        if(!is_null($search_val))
            $sql .= ' AND (b.name like "%'.$search_val.'%" OR b.phone like "%'.$search_val.'%") ';
        $sql .= "GROUP BY b.user_num, b.market ";
        $sql .= "ORDER BY a.num ASC ";
        $lim_sql = $sql."LIMIT ".$start_from.", ".$pages;
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($lim_sql));
        $total_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));

        $total = count($total_rows);
        $total_page = ceil($total / $pages);

        return \Response::json([
            'msg' => 'ok',
            'total'    =>  $total,
            'pstart'    =>  $pstart,
            'totalpage'    =>  $total_page,
            'lists' => $rows,
        ]);
    }

    //서버 상태
    public function getServerStatus(Request $request) {
        $sql = "SELECT * FROM tbl_server ";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $web_cpu_using = 0;
        $web_ram_using = 0;
        $web_ram_size = 0;
        $w2_cpu_using = 0;
        $w2_ram_using = 0;
        $w2_ram_size = 0;
        $m_cpu_using = 0;
        $m_ram_using = 0;
        $m_ram_size = 0;

        if ($rows) {
            for ($i = 0; $i < count($rows); $i++) {
                $row = $rows[$i];
                $s_name = $row->server_name;
                if (strcmp($s_name, 'watcher1') == 0) {
                    $web_cpu_using = $row->cpu_rate;
                    $web_ram_using = $row->ram_rate;
                    $web_ram_size = $row->ram_size;
                }
                if (strcmp($s_name, 'watcher2') == 0) {
                    $w2_cpu_using = $row->cpu_rate;
                    $w2_ram_using = $row->ram_rate;
                    $w2_ram_size = $row->ram_size;
                }
                if (strcmp($s_name, 'maker') == 0) {
                    $m_cpu_using = $row->cpu_rate;
                    $m_ram_using = $row->ram_rate;
                    $m_ram_size = $row->ram_size;
                }
            }
        }
        return \Response::json([
            'msg' => 'ok',
            'web_cpu_using' => $web_cpu_using,
            'web_ram_using' => $web_ram_using,
            'web_ram_size' => $web_ram_size,

            'w2_cpu_using' => $w2_cpu_using,
            'w2_ram_using' => $w2_ram_using,
            'w2_ram_size' => $w2_ram_size,

            'm_cpu_using' => $m_cpu_using,
            'm_ram_using' => $m_ram_using,
            'm_ram_size' => $m_ram_size,
        ]);
    }

    //공지보낼 유저 리스트
    public function getNoticeUserList(Request  $request) {
        $search_val = $request->post('search_val');
        $start = $request->post('start');
        $count = $request->session()->get('pages');
        $start_from = ($start-1) * $count;

        $sql = "SELECT num, phone, name FROM tbl_user_info ";
        $sql .= " WHERE permission = 0 ";

        if(!is_null($search_val)) {
            $sql .= " AND (name like '%" . $search_val . "%' OR ";
            $sql .= " phone like '%" . $search_val . "%') ";
        }
        $lim_sql = $sql.' ORDER BY num ASC LIMIT '.$start_from.', '.$count;

        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($lim_sql));
        $total_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $total = count($total_rows);
        $total_page = ceil($total / $count);

        if($rows != null){
            return \Response::json([
                'msg' => 'ok',
                'total' => $total,
                'start' => $start,
                'totalpage' => $total_page,
                'lists' => $rows
            ]);
        }
        exit();
    }

    //전체 공지 리스트
    public function getNoticeAllList(Request  $request) {
        $start  = $request->post('start');
        $count    = $request->session()->get('pages');
        $start_from = ($start-1) * $count;

        $sql = "SELECT create_date, msg_title, msg_content, msg_type, sender AS msg_sender, ";
        $sql .= "IF (target > 0, (SELECT tbl_user_info.name FROM tbl_user_info WHERE num = target), '') AS msg_target ";
        $sql .= "FROM tbl_notice ";
        $sql .= "ORDER BY msg_id DESC ";

        $lim_sql = $sql.' LIMIT '.$start_from.', '.$count;

        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($lim_sql));
        $total_rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        $total = count($total_rows);
        $total_page = ceil($total / $count);

        if($rows != null){
            return \Response::json([
                'msg' => 'ok',
                'total' => $total,
                'start' => $start,
                'totalpage' => $total_page,
                'lists' => $rows
            ]);
        }
        exit();
    }

    //공지 보내기
    public function sendNoticeToTarget(Request $request){
        $msg_type = $request->post('msg_type');
        $msg_title = $request->post('msg_title');
        $msg_content = $request->post('msg_content');
        $target = $request->post('target') ?? 0;
        date_default_timezone_set('Asia/Shanghai');
        $create_date = date("Y-m-d H:i:s", time());
        $sender = $request->session()->get('user_name');

        try {
            $success = DB::table('tbl_notice')
                ->insert(
                    [
                        'msg_title' => $msg_title, // 공지제목
                        'msg_content' => $msg_content, // 공지내용
                        'msg_type' => $msg_type, // 공지타입   all/agent/persion
                        'sender' => $sender,
                        'target' => $target, // 공지를 받을 유저/회사  '1, 2, 3' :: 앞으로 모든 회사나 개인이 아니고 선택하여 보내야 할때 필요
                        'create_date' => $create_date // 공지 창조 일자
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
        }catch(Exception $e) {
            return \Response::json([
                'msg' => $e->getMessage()
            ]);
        }
    }

    //사용 권한 리스트
    public function getUsingPermissionList(Request $request) {
        $search_val = $request->post('search_val');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;

        $sql = "SELECT permission, num, phone, name, level ";
        $sql .= "FROM tbl_user_info ";
        $sql .= "WHERE level = 8 ";

        if(!is_null($search_val))
            $sql .= ' AND (name like "%'.$search_val.'%" OR phone like "%'.$search_val.'%") ';
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

    //퍼미션 설정
    public function setUsingPermission(Request $request) {
        $permission = $request->post('permission');
        $user_num = $request->post('user_num');
        $success = DB::table('tbl_user_info')->where('num', $user_num)
            ->update(
                [
                    'permission' => $permission
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

    //쿠폰 생성하기
    public function createCouponCard(Request $request) {
        $coupon_name = $request->post('coupon_name');
        $coupon_level = $request->post('coupon_level');
        $coupon_price = $request->post('coupon_price');
        $amount_given = $request->post('amount_given');
        $coin_count = $request->post('coin_count');
        $coupon_description = $request->post('coupon_description');
        $coupon_shop = $request->post('coupon_shop');
        $coupon_valid = 60;
        date_default_timezone_set('Asia/Shanghai');
        $create_date = date("Y-m-d H:i:s", time());

        /*$cdate = date("Y-m-d", time());
        date_default_timezone_set('Asia/Shanghai');
        $coupon_last_date =  date("Y-m-d", strtotime($cdate." +".$coupon_valid." day"));*/

        try {
            $success = DB::table('tbl_coupon')
                ->insert(
                    [
                        'coupon_name' => $coupon_name,
                        'coupon_level' => $coupon_level,
                        'coupon_price' => $coupon_price,
                        'coupon_valid' => $coupon_valid,
                        'amount_given' => $amount_given,
                        'coin_count' => $coin_count,
                        'description' => $coupon_description,
                        'show' => $coupon_shop,
                        'create_date' => $create_date
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
        }catch(Exception $e) {
            return \Response::json([
                'msg' => $e->getMessage()
            ]);
        }
    }

    //쿠폰 리스트
    public function getCouponListView(Request $request) {
        $sql = "SELECT * FROM tbl_coupon ORDER BY create_date ASC";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        return \Response::json([
            'msg' => 'ok',
            'lists' => $rows,
        ]);
    }
    //쿠폰 삭제
    public function deleteCouponCard(Request $request) {
        $coupon_num = $request->post('coupon_num');
        $success = DB::table('tbl_coupon')->where('coupon_num', $coupon_num)->delete();
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
    //쿠폰 수정
    public function editCouponCard(Request $request) {
        $coupon_num = $request->post('coupon_num');
        $coupon_name = $request->post('coupon_name');
        $coupon_level = $request->post('coupon_level');
        $coupon_valid = $request->post('coupon_valid');
        $coupon_price = $request->post('coupon_price');
        $amount_given = $request->post('amount_given');
        $coin_count = $request->post('coin_count');
        $description = $request->post('description');
        $show = (int)$request->post('show');

        $success = DB::table('tbl_coupon')->where('coupon_num', $coupon_num)
            ->update(
                [
                    'coupon_name' => $coupon_name,
                    'coupon_level' => $coupon_level,
                    'coupon_valid' => $coupon_valid,
                    'coupon_price' => $coupon_price,
                    'amount_given' => $amount_given,
                    'coin_count' => $coin_count,
                    'description' => $description,
                    'show' => $show
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

    //유저별 포인트 리스트
    public function getUserPointList(Request $request) {
        $sort_field = $request->post('sort_field');
        $sort_direction = $request->post('sort_direction');
        $search_val = $request->post('search_val');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;

        $sql = "SELECT num, id, name, point ";
        $sql .= "FROM tbl_user_info ";
        $sql .= "WHERE 1 ";

        if(!is_null($search_val))
            $sql .= ' AND (name like "%'.$search_val.'%" OR id like "%'.$search_val.'%") ';
        $lim_sql = $sql.' ORDER BY '.$sort_field.' '.$sort_direction.' LIMIT '.$start_from.', '.$count;

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

    //포인트 지급
    public function setUserPayingPoints(Request $request) {
        $user_num = $request->post('user_num');
        $point = $request->post('point');
        $payer_name = $request->session()->get('user_name');
        date_default_timezone_set('Asia/Shanghai');
        $create_date = date("Y-m-d H:i:s", time());

        $row = DB::table('tbl_user_info')->where('num', $user_num)->get()->first();
        $user_point = (int)$point + $row->point;
        $success = DB::table('tbl_user_info')->where('num', $user_num)
            ->update(
                [
                    'point' => $user_point
                ]
            );
        if ($success) {
            DB::table('tbl_point_history')
                ->insert(
                    [
                        'user_num' => $user_num,
                        'paid_point' => $point,
                        'payer_name' => $payer_name,
                        'create_date' => $create_date
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

    //포인트 지급 내역
    public function getPaidPointsHistory(Request $request) {
        $sort_field = $request->post('sort_field');
        $sort_direction = $request->post('sort_direction');
        $search_val = $request->post('search_val');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;

        $sql = "SELECT a.create_date AS create_date, a.user_num, b.id, b.name, a.paid_point AS paid_point, a.payer_name AS payer_name ";
        $sql .= "FROM tbl_point_history AS a ";
        $sql .= "LEFT JOIN tbl_user_info AS b ON a.user_num = b.num ";
        $sql .= "WHERE 1 ";

        if(!is_null($search_val))
            $sql .= ' AND (b.name like "%'.$search_val.'%" OR b.id like "%'.$search_val.'%") ';
        $lim_sql = $sql.' ORDER BY '.$sort_field.' '.$sort_direction.' LIMIT '.$start_from.', '.$count;

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

    //파라미터 정보 얻기
    public function getParameterInfo(Request $request) {
        $sql = "SELECT * FROM fix_params WHERE enabled=1 ORDER BY pid ASC";
        $rows = DB::connection($this->ddukddak_db)->select(DB::connection($this->ddukddak_db)->raw($sql));
        return \Response::json([
            'msg' => 'ok',
            'lists' => $rows,
        ]);
    }

    //파라미터 정보 수정
    public function editParameterInfo(Request $request) {
        $datas = $request->post('datas');
        $jdatas = json_decode($datas, TRUE);
        if ($jdatas) {
            for ($i = 0; $i < count($jdatas); $i++) {
                $val = $jdatas[$i];
                $pname = $val['p1'];
                if ($pname == 'w7') {
                    continue;
                }
                $pvalue = $val['p2'];
                $success = DB::table('fix_params')->where('pname', $pname)
                    ->update(
                        [
                            'pvalue' => $pvalue
                        ]
                    );
            }

        } else{
            return \Response::json([
                'msg' => 'err'
            ]);
        }
        return \Response::json([
            'msg' => 'ok'
        ]);
    }

    //이메일 정보 확인
    public function checkEmailInfo(Request $request) {
        $rows = DB::table('fix_email')->get();
        return \Response::json([
            'msg' => 'ok',
            'mail_lists' => $rows
        ]);
    }

    //이메일 파일 업로드
    public function uploadHtmlFile(Request $request){
        $index  = $request->post('index');
        $file_name  = $request->post('file_name');
        $uploadfile_html = $request->file('uploadfile_html');
        date_default_timezone_set('Asia/Shanghai');
        $create_date = date("Y-m-d H:i:s", time());

        $url = $_SERVER[ "HTTP_HOST" ];
        if($uploadfile_html != null && $uploadfile_html != ''){
            //$new_name = 'terms.'.$uploadfile_html->getClientOriginalExtension();
            $uploadfile_html->move(public_path('/html/'), $file_name);
        }
        $url .= '/html/'.$file_name;

        $success = DB::table('fix_email')->where('eid', $index)
            ->update(
                [
                    'file_name' => $file_name,
                    'path' => $url,
                    'upload_date' => $create_date
                ]
            );
        if ($success) {
            return \Response::json([
                'msg' => 'ok'
            ]);
        }
        return \Response::json([
            'msg' => 'err'
        ]);
    }

    //html 파일 보기
    public function showHtmlFile(Request $request) {
        $index  = $request->post('index');
        $row = DB::table('fix_email')->where('eid', $index)->get()->first();
        if ($row) {
            $url = '';
            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
                $url = 'https://'.$row->path;
            } else {
                $url = 'http://'.$row->path;
            }
            return \Response::json([
                'msg' => 'ok',
                'file_name' => $row->file_name,
                'file_path' => $url
            ]);
        } else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }

    //입금주소 추가
    public function saveAddress(Request $request) {
        $address  = $request->post('address');
        $row = DB::table('fix_payment_address')->get()->first();
        if ($row) {
            $success = DB::table('fix_payment_address')
                ->update(
                    [
                        'address_link' => $address
                    ]
                );
            if ($success) {
                return \Response::json([
                    'msg' => 'ok',
                    'address' => $address
                ]);
            }
        } else {
            DB::table('fix_payment_address')
                ->insert(
                    [
                        'address_link' => $address
                    ]
                );
            return \Response::json([
                'msg' => 'ok',
                'address' => $address
            ]);
        }

    }

    //입금주소 읽기
    public function readAddress(Request $request) {
        $row = DB::table('fix_payment_address')->get()->first();
        if ($row) {
            return \Response::json([
                'msg' => 'ok',
                'address' => $row->address_link
            ]);
        } else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }

    //브로커 아이디 추가
    public function saveBrokerID(Request $request) {
        $brokerID  = $request->post('brokerID');
        $row = DB::table('fix_broker_id')->get()->first();
        if ($row) {
            $success = DB::table('fix_broker_id')
                ->update(
                    [
                        'brokerID' => $brokerID
                    ]
                );
            if ($success) {
                return \Response::json([
                    'msg' => 'ok',
                    'brokerID' => $brokerID
                ]);
            }
        } else {
            DB::table('fix_broker_id')
                ->insert(
                    [
                        'brokerID' => $brokerID
                    ]
                );
            return \Response::json([
                'msg' => 'ok',
                'brokerID' => $brokerID
            ]);
        }

    }

    //브로커 아이디 읽기
    public function readBrokerID(Request $request) {
        $row = DB::table('fix_broker_id')->get()->first();
        if ($row) {
            return \Response::json([
                'msg' => 'ok',
                'brokerID' => $row->brokerID
            ]);
        } else {
            return \Response::json([
                'msg' => 'err'
            ]);
        }
    }
}
