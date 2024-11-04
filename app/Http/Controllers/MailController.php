<?php

namespace App\Http\Controllers;

use App\Mail\CongratMail;
use App\Mail\CouponBalanceMail;
use App\Mail\CouponPuchaseMail;
use App\Mail\ExpirationDateMail;
use App\Mail\SettlementDetailsMail;
use App\Mail\TempPasswordMail;
use App\Mail\WelcomeMail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class MailController extends BaseController
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

    //확인 코드를 메일로 전송
    public function sendAuthCode(Request $request) {
        $email  = $request->get('email');
        $verificationCode = mt_rand(100000, 999999);
        Mail::to($email)->send(new VerificationCodeMail($verificationCode));

        return \Response::json([
            'msg' => 'ok',
            'code' =>  $verificationCode
        ]);
    }

    //가입 축하 메일 전송
    public function sendCongratJoin(Request $request) {
        $email  = $request->get('email');
        Mail::to($email)->send(new CongratMail());

        return \Response::json([
            'msg' => 'ok'
        ]);
    }

    //임시 비밀번호 메일 전송
    public function sendTempPassword(Request $request) {
        $email  = $request->get('email');
        $temp_password = '';
        Mail::to($email)->send(new TempPasswordMail($temp_password));

        return \Response::json([
            'msg' => 'ok'
        ]);
    }

    //쿠폰 구매 메일
    public function sendCouponPuchase(Request $request) {
        $email  = $request->get('email');
        $coupon_name  = $request->get('coupon_name');
        $amount_given  = $request->get('amount_given');
        $max_trade_price  = $request->get('max_trade_price');
        $date_due  = $request->get('date_due');
        $price_buy  = $request->get('price_buy');
        $date_buy  = $request->get('date_buy');
        $data = [
            'coupon_name' => $coupon_name,
            'amount_given' => $amount_given,
            'max_trade_price' => $max_trade_price,
            'date_due' => $date_due,
            'price_buy' => $price_buy,
            'date_buy' => $date_buy
        ];
        Mail::to($email)->send(new CouponPuchaseMail($data));
        return \Response::json([
            'msg' => 'ok'
        ]);
    }

    //임시 비밀번호 메일 전송
    public function sendExpirationDate(Request $request) {
        $email  = $request->get('email');
        $date_due  = $request->get('date_due');

        Mail::to($email)->send(new ExpirationDateMail($date_due));

        return \Response::json([
            'msg' => 'ok'
        ]);
    }

    //쿠폰 사용완료 메일 전송
    public function sendCouponBalance(Request $request) {
        $email  = $request->get('email');
        Mail::to($email)->send(new CouponBalanceMail());

        return \Response::json([
            'msg' => 'ok'
        ]);
    }

    //에이전트 축하 메일 전송
    public function sendAgentWelcome(Request $request) {
        $email  = $request->get('email');
        Mail::to($email)->send(new WelcomeMail());

        return \Response::json([
            'msg' => 'ok'
        ]);
    }

    //월간 결산 내역 메일
    public function sendSettlementDetails(Request $request) {
        $email  = $request->get('email');
        $date  = $request->get('date');
        $total_friends  = $request->get('total_friends');
        $total_points  = $request->get('total_points');
        $my_profit  = $request->get('my_profit');
        $deduction  = $request->get('deduction');
        $agent_frient_rev  = $request->get('agent_frient_rev');
        $final_profit  = $request->get('final_profit');

        $data = [
            'date' => $date,
            'total_friends' => $total_friends,
            'total_points' => $total_points,
            'my_profit' => $my_profit,
            'deduction' => $deduction,
            'agent_frient_rev' => $agent_frient_rev,
            'final_profit' => $final_profit
        ];
        Mail::to($email)->send(new SettlementDetailsMail($data));
        return \Response::json([
            'msg' => 'ok'
        ]);
    }
}
