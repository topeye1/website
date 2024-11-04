<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


Route::get('user', function () { return redirect('user.user_login');});
Route::post('user.register', 'JWTUserAuthController@register');
Route::post('user.userLogin', 'JWTUserAuthController@login');

Route::post('user.revenuetInfoDefaul', 'UserRevenueController@getDefaultRevenueInfo'); //월 수익 정보
Route::post('user.coinRevenueDefault', 'UserRevenueController@getDefaultCoinRevenueList'); //코인별 수익 상태 리스트
Route::post('user.revenueListDefault', 'UserRevenueController@getDefaultMyRevenueList'); //나의 수익 상태 리스트
Route::post('user.myInfoDefault', 'UserController@getDefaultMyInfo'); //나의 정보 얻기
Route::post('user.liveTradingListDefault', 'UserTradingController@getDefaultLiveTradingList'); //거래주문 체결, 청산 정보 리스트
Route::post('user.currentOrderListDefault', 'UserTradingController@getDefaultCurrentOrderList'); //거래주문 현재 미체결된 주문과 체결된 주문 리스트

Route::group([
    'middleware' => 'jwt.verify'
], function() {
    /***
     * admin part
     */
    Route::post('user.get_user', 'JWTUserAuthController@get_user');

    Route::post('user.myInfo', 'UserController@getMyInfo'); //나의 정보 얻기
    Route::post('user.setMarket', 'UserController@setMarket'); //market 설정

    Route::post('user.couponsInfo', 'UserController@getCouponsInfo'); //쿠폰 리스트 정보
    Route::post('user.couponsHistory', 'UserController@getCouponsHistory'); //쿠폰 구매 내역
    Route::post('user.selectedCardInfo', 'UserController@getSelectedCardInfo'); //선택된 쿠폰 정보 얻기
    Route::post('user.holdPoint', 'UserController@getUserHoldPoint'); //유저가 보유한 포인트

    Route::post('user.keyList', 'UserSettingController@getApiKeys'); //api key 리스트 얻기
    Route::post('user.inputKey', 'UserSettingController@setInputApiKey'); //api key 추가하기
    Route::post('user.deleteKey', 'UserSettingController@deleteApiKey'); //api key 삭제하기
    Route::post('user.editKey', 'UserSettingController@setEditApiKey'); //api key 수정하기
    Route::post('user.tradeSetting', 'UserSettingController@getTradeSettings'); //거래 설정 정보 얻기
    Route::post('user.getLivedSymbol', 'UserSettingController@getLivedSymbol'); //현재 실행중인 심볼 얻기
    Route::post('user.updateLive', 'UserSettingController@updateLiveSettings'); //Live 상태 0으로 만들기
    Route::post('user.updateSetting', 'UserSettingController@updateTradeSettings'); //거래 설정 정보 수정
    Route::post('user.runningCoins', 'UserSettingController@getRunningCoinList'); //실행중인 코인 리스트
    Route::post('user.setRunning', 'UserSettingController@setRunningStatus'); //코인 실행상태 설정
    Route::post('user.getUserInfo', 'UserSettingController@getUserInfo'); //유저 설정 정보 얻기
    Route::post('user.changePhone', 'UserSettingController@setChangePhoneNumber'); //유저 전화번호 변경
    Route::post('user.changePassword', 'UserSettingController@setChangePassword'); //유저 비밀번호 변경

    Route::post('user.friendProfitList', 'UserFriendController@getFriendProfitList'); //친구 수익 상태 리스트
    Route::post('user.friendDiscount', 'UserFriendController@setFriendDiscount'); //친구 할인율 설정
    Route::post('user.settlementList', 'UserFriendController@getSettlementList'); //친구 정산 리스트
    Route::post('user.pointsList', 'UserFriendController@getPointsList'); //친구 포인트 리스트

    Route::post('user.revenueInfo', 'UserRevenueController@getRevenueInfo'); //월 수익 정보
    Route::post('user.coinRevenue', 'UserRevenueController@getCoinRevenueList'); //코인별 수익 상태 리스트
    Route::post('user.revenueList', 'UserRevenueController@getMyRevenueList'); //나의 수익 상태 리스트

    Route::post('user.liveTradingList', 'UserTradingController@getLiveTradingList'); //거래주문 체결, 청산 정보 리스트
    Route::post('user.currentOrderList', 'UserTradingController@getCurrentOrderList'); //거래주문 현재 미체결된 주문과 체결된 주문 리스트

});


Route::view('user.login', 'user.user_login');
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($user_agent, 'iPhone') !== false || strpos($user_agent, 'Android') !== false) {
    Route::view('user.findPasswordView', 'user_mobile.find-password-view');
    Route::view('user.signupCorporateView', 'user_mobile.signup-corporate-view');
} else {
    Route::view('user.findPasswordView', 'user.find-password-view');
    Route::view('user.signupCorporateView', 'user.signup-corporate-view');
}

Route::get('/{page}/card-num/{tab}', 'UserController@indexNav');
Route::get('/{page}/user-page/{tab}', 'UserController@indexNav');
