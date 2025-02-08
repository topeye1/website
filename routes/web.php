<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['ko', 'en', 'zh-CN', 'ja'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

/////// server /////////////////////////////////////////////////////////////
/*
Route::get('/', function () {
    if(Str::startsWith($_SERVER['HTTP_HOST'],'bin.hycry.top')){
        return view('admin.login');
    }
    else{
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'iPhone') !== false || strpos($user_agent, 'Android') !== false) {
            return view('user_mobile.user_login');
        } else {
            return view('user.user_login');
        }
    }
});
*/
//////////////////////////////////////////////////////////////////////////////

Route::get('/', function () {
   if(Str::startsWith($_SERVER['HTTP_HOST'],'dd.local.com')){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'iPhone') !== false || strpos($user_agent, 'Android') !== false) {
            return view('user_mobile.user_login');
        } else {
            return view('user.user_login');
        }
    }
    else{
        return view('admin.login');
	}
});

//-----------------------------------------------------
// Admin part with adminsession
//-----------------------------------------------------

Route::middleware('adminsession')->group(function(){
    Route::get('admin.dashboard', function () {
        return view('admin.dashborad-view');
    });

    Route::group([
        'middleware' => 'jwt.verify',
    ], function() {
        Route::post('admin.logout', 'JWTAdminAuthController@logout');
        Route::post('admin.refresh', 'JWTAdminAuthController@refresh');
        Route::get('admin.profile', 'JWTAdminAuthController@profile');

    });
}); // end adminsession

//-----------------------------------------------------
// Admin part without adminsession
//-----------------------------------------------------


Route::get('admin', function () { return redirect('admin.login');});
Route::get('admin.logout', 'AdminController@logout');
Route::post('admin.adminLogin', 'JWTAdminAuthController@login');

Route::get('admin.pages10', function () {
    session(['pages' => '10']);
    return redirect()->back();
});
Route::get('admin.pages20', function () {
    session(['pages' => '20']);
    return redirect()->back();
});
Route::get('admin.pages50', function () {
    session(['pages' => '50']);
    return redirect()->back();
});


Route::group([
    'middleware' => 'jwt.verify'
], function() {
    /***
     * admin part
     */
    Route::post('admin.get_user', 'JWTAdminAuthController@get_user');

    Route::post('admin.getDashboardInfo', 'AdminController@getDashboardInfo');

    Route::post('admin.allUserList', 'AdminController@getAllUserList'); //유저 리스트
    Route::post('admin.getWebSetting', 'AdminController@getWebPageSetting');
    Route::post('admin.addNewUser', 'AdminController@addNewUserInfo'); //유저 추가
    Route::post('admin.checkActived', 'AdminController@checkUserActived'); //active 체크
    Route::post('admin.setEditUser', 'AdminController@setEditUserInfo'); //유저 편집
    Route::post('admin.deleteUser', 'AdminController@setDeleteUserInfo'); //유저 삭제
    Route::post('admin.getHistory', 'AdminController@getEditHistoryInfo'); //유저 로그 보기

    Route::post('admin.userRevenue', 'AdminController@getUserRevenueList'); //유저 수익
    Route::post('admin.couponRevenueCoupon', 'AdminController@getCouponRevenueCouponList'); //쿠폰수익-쿠폰별
    Route::post('admin.couponRevenueUser', 'AdminController@getCouponRevenueUserList'); //쿠폰수익-유저별

    Route::post('admin.agentList', 'AdminAgentController@getAgentUserList'); //에이전트 리스트
    Route::post('admin.agentRevenue', 'AdminAgentController@getAgentRevenueList'); //에이전트 수익
    Route::post('admin.agentReqPoint', 'AdminAgentController@getAgentRequestPointPayment'); //정산요청 리스트(포인트 결제요청)
    Route::post('admin.agentReqComp', 'AdminAgentController@getAgentRequestComplete'); //정산완료
    Route::post('admin.agentAddableList', 'AdminAgentController@getAgentAddableList'); //에이전트로 추가할 유저 리스트
    Route::post('admin.addAgent', 'AdminAgentController@setAddedAgent'); //에이전트 추가

    Route::post('admin.usageStatus', 'NormalController@getUsageStatusList'); //사용현황
    Route::post('admin.serverStatus', 'NormalController@getServerStatus'); //서버상태

    Route::post('admin.noticeUser', 'NormalController@getNoticeUserList'); //공지보낼 유저 리스트
    Route::post('admin.noticeList', 'NormalController@getNoticeAllList'); //공지 리스트
    Route::post('admin.noticeSend', 'NormalController@sendNoticeToTarget'); //공지 보내기

    Route::post('admin.createCoupon', 'NormalController@createCouponCard'); //쿠폰 추가
    Route::post('admin.couponList', 'NormalController@getCouponListView'); //쿠폰 리스트
    Route::post('admin.deleteCoupon', 'NormalController@deleteCouponCard'); //쿠폰 삭제
    Route::post('admin.editCoupon', 'NormalController@editCouponCard'); //쿠폰 수정

    Route::post('admin.permissionList', 'NormalController@getUsingPermissionList'); //유저별 권한 리스트
    Route::post('admin.setPermisssion', 'NormalController@setUsingPermission'); //권한 설정

    Route::post('admin.pointList', 'NormalController@getUserPointList'); //유저별 포인트 리스트
    Route::post('admin.payingPoints', 'NormalController@setUserPayingPoints'); //포인트 지급
    Route::post('admin.pointHistory', 'NormalController@getPaidPointsHistory'); //포인트 내역

    Route::post('admin.paramInfo', 'NormalController@getParameterInfo'); //파라미터 정보 얻기
    Route::post('admin.editParam', 'NormalController@editParameterInfo'); //파라미터 정보 수정

    Route::post('admin.checkEmail', 'NormalController@checkEmailInfo'); //이메일 정보 확인
    Route::post('admin.htmlFile', 'NormalController@uploadHtmlFile'); //html파일 업로드
    Route::post('admin.showHtml', 'NormalController@showHtmlFile'); //html파일 보기

    Route::post('admin.saveAddress', 'NormalController@saveAddress'); //입금주소 추가
    Route::post('admin.readAddress', 'NormalController@readAddress'); //입금주소 읽기

    Route::post('admin.saveBrokerID', 'NormalController@saveBrokerID'); //브로커 아이디 추가
    Route::post('admin.readBrokerID', 'NormalController@readBrokerID'); //브로커 아이디 읽기

});
/********************************************************************************************************************/

//send Mail part
Route::get('admin.authCodeMail', 'MailController@sendAuthCode'); // 회원가입 확인 코드 메일로 전송
Route::get('admin.congratMail', 'MailController@sendCongratJoin'); // 가입 축하 메일 전송
Route::get('admin.tempPasswordMail', 'MailController@sendTempPassword'); // 임시 비밀번호 메일 전송
Route::get('admin.couponMail', 'MailController@sendCouponPuchase'); // 쿠폰 구매 메일 전송
Route::get('admin.expirationMail', 'MailController@sendExpirationDate'); // 쿠폰 유효기간 메일 전송
Route::get('admin.balanceMail', 'MailController@sendCouponBalance'); // 쿠폰 사용완료 메일 전송
Route::get('admin.welcomeMail', 'MailController@sendAgentWelcome'); // 에이전트 축하 메일 전송
Route::get('admin.settlementMail', 'MailController@sendSettlementDetails'); // 월간 결산 내역 메일 전송


include ('user.php');
//Route::get('/{page}', 'AdminController@index'); // don't call this part for mobile.php route
Route::get('/{page}/{nav}', 'AdminController@indexNav'); // don't call this part for mobile.php route
// Route::get('/{page}', 'AdminController@index')->where('page', '!(^[mobile.]?)');

Route::get('/wallet', function () {
   return view('user_mobile.wallet');
});
