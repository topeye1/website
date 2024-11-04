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

class AdminAgentController extends BaseController
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

    //에이전트 리스트 보기
    public function getAgentUserList(Request $request)
    {
        $search_val = $request->post('search_val');
        $search_date = $request->post('search_date');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;
    }

    //에이전트 수익 보기
    public function getAgentRevenueList(Request $request)
    {
        $search_val = $request->post('search_val');
        $search_date = $request->post('search_date');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;
    }

    //정산요청 보기
    public function getAgentRequestPointPayment(Request $request)
    {
        $search_val = $request->post('search_val');
        $search_date = $request->post('search_date');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;
    }

    //정산완료 보기
    public function getAgentRequestComplete(Request $request)
    {
        $search_val = $request->post('search_val');
        $search_date = $request->post('search_date');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;
    }

    //에이전트로 추가할 유저 리스트 보기
    public function getAgentAddableList(Request $request)
    {
        $search_val = $request->post('search_val');
        $pstart = $request->post('pstart');
        $count = $request->session()->get('pages');
        $start_from = ($pstart-1) * $count;

        $sql = "SELECT num, phone, name, level, SUBSTRING(create_date, 1, 10) as create_date, agent_num, agentable ";
        $sql .= "FROM tbl_user_info ";
        $sql .= "WHERE 1 ";

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

    //에이전트로 추가
    public function setAddedAgent(Request $request)
    {
        $fee_rate = $request->post('fee_rate');
        $user_num = $request->post('user_num');
        $success = DB::table('tbl_user_info')->where('num', $user_num)
            ->update(
                [
                    'my_fee' => $fee_rate,
                    'agentable' => 1
                ]
            );

        return \Response::json([
            'msg' => 'ok'
        ]);
    }


} // area of class
