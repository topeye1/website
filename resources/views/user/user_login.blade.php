@extends('layouts.master_login')
@section('content')
<div class="col-xl-5 col-lg-6 col-md-4">
    <div class="dropdown mb-4 my-dropdown mt-4">
        <button class="btn btn-primary lang-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('userpage.language') }}
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton" style="">
            <a class="dropdown-item" href="{{ route('lang.switch', 'ko') }}">한국어</a>
            <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a>
            <a class="dropdown-item" href="{{ route('lang.switch', 'zh-CN') }}">中文</a>
            <a class="dropdown-item" href="{{ route('lang.switch', 'ja') }}">日语</a>
        </div>
    </div>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center mb-3">
                            <img src="{{URL::asset('assets/img/brand/logo.png')}}" class="header-brand-img" alt="">
                        </div>
                        <div class="col col-login mx-auto mb-4">
                            <div class="text-center">
                                <span>{{ __('userpage.loginpage_des1') }}</span>
                            </div>
                            <div class="text-center">
                                <span>{{ __('userpage.loginpage_des2') }}</span>
                            </div>
                        </div>
                        <form class="user">
                            <div class="row mb-4">
                                <!--// comment - binance 2024-06-21
                                <div class="col-md-6 d-flex flex-row">
                                    <input type="radio" name="loginbrand" id="loginbrand_bin" value="one" checked />
                                    <img src="/assets/img/brand/binance_logo.png">
                                </div>
                                -->
                                <div class="col-md-10 d-flex" style="justify-content: center">
                                    <!--// comment - binance 2024-06-21
                                    <input type="radio" name="loginbrand" id="loginbrand_htx" value="two" />
                                    -->
                                    <img src="/assets/img/brand/htx_logo.png">
                                </div>
                                <div class="col-md-2 d-flex" style="align-items: center;">
                                    <img id="login_help" src="/assets/img/pngs/help.png" style="width: 20px; height: 20px; cursor: pointer;">
                                </div>
                            </div>
                            <div class="form-group my-form mb-0">
                                {{ __('userpage.id') }}
                            </div>
                            <div class="form-group mb-1 mt-1">
                                <input type="email" class="form-control form-control-user my-input" name="user_id" id="user_id" placeholder="{{ __('userpage.id_help') }}">
                            </div>
                            <div class="form-group my-form mb-4">
                                {{ __('userpage.id_des') }}
                            </div>

                            <div class="form-group my-form mb-0">
                                {{ __('userpage.password') }}
                            </div>
                            <div class="form-group mb-1 mt-1">
                                <input type="password" class="form-control form-control-user my-input" name="user_pwd" id="user_pwd" placeholder="{{ __('userpage.password') }}">
                            </div>
                            <div class="form-group my-form mb-5">
                                {{ __('userpage.password_des') }}
                            </div>
                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Remember
                                        Me</label>
                                </div>
                            </div> -->
                            <div id="button_login" class="btn btn-primary btn-user btn-block">{{ __('userpage.login') }}</div>

                        </form>
                        <hr>
                        <div class="text-center link-btn mb-3">
                            <a class="small" href="{{ url('/user.findPasswordView') }}">{{ __('userpage.find_pwd') }}</a>
                        </div>
                        <div class="text-center link-btn">
                            <a class="small" href="{{ url('/user.signupCorporateView') }}">{{ __('userpage.signup2') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('tooltip.login-help')
@endsection
@section('js')
    <script>
        let market = 'htx';
        $(document).ready(function () {
            $('#button_login').click(function () {
                let userid = $('#user_id').val().replace(/ /g, '');
                let password = $('#user_pwd').val().replace(/ /g, '');
                if(userid === ""){
                    return;
                }
                if(password === "") {
                    return;
                }

                $.ajax({
                    url:'user.userLogin',
                    data: {
                        user_id: userid,
                        user_pwd: password,
                    },
                    type: 'POST',
                    cache: false,
                    dataType : 'json',
                    success: function (data, textStatus, jqXHR) {
                        if (data.msg === "ok") {
                            let access_token = data.access_token;
                            let token_type = data.token_type;
                            let expires_in = data.expires_in;
                            window.localStorage.authToken = access_token;
                            $.ajax({
                                url:'user.get_user',
                                headers: {'Authorization': `Bearer ${access_token}`},
                                data: {
                                    'token': `${access_token}`,
                                    market: market
                                },
                                type: 'POST',
                                success: function (data) {
                                    if (data.msg !== "ok")
                                    {
                                        alert(data.cont);
                                    }
                                    else{
                                        window.location.href = '{{ url('/user.user-revenue-view/user-page/revenue') }}';
                                    }
                                }, error: function (jqXHR, errdata, errorThrown) {
                                    console.log(jqXHR['responseText'] ?? errdata);
                                }
                            });
                        }
                        else if (data.msg === 'nonuser') {
                            const message = '아이디가 존재하지 않습니다';
                            alert(message);
                        } else if (data.msg === 'nonpwd') {
                            const message = '비밀번호 오류';
                            alert(message);
                        }
                        else if (data.msg === 'err') {
                            let errdata = data.cont;
                            if(Array.isArray(errdata)){
                                let phone = errdata['user_phone'];
                                let pwd = errdata['user_pwd'];
                                console.log("err >>>", phone ? phone[0] : pwd ? pwd[0] : ' error can not know err ');
                                alert(phone ? phone[0] : pwd ? pwd[0] : ' error can not know err ');
                            }
                            else{
                                alert(errdata);
                            }
                        }
                        else{
                            let errdata = data.msg;
                            if(Array.isArray(errdata)){
                                let phone = errdata['user_phone'];
                                let pwd = errdata['user_pwd'];
                                console.log("err >>>", phone ? phone[0] : pwd ? pwd[0] : ' error can not know err ');
                                alert(phone ? phone[0] : pwd ? pwd[0] : ' error can not know err ');
                            }
                            else{
                                alert(errdata);
                            }

                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(jqXHR['responseText'] ?? errdata);
                    }
                });
            });

            // comment - binance 2024-06-21
            $('input[id^="loginbrand_"]').click(function(){
                let oid=$(this).attr("id");
                market = oid.split('_')[1];
            });

            $('#login_help').mouseover( function () {
                $('.login_help_tooltip').css('display', 'block');
            });
            $('#login_help').mouseout( function () {
                $('.login_help_tooltip').css('display', 'none');
            });

            let help_img = $('#login_help');
            let offset = help_img.offset();
            let tooltip_left = offset.left + 50;
            let tooltip_top = offset.top - 30;
            $('.login_help_tooltip').css({left:tooltip_left, top:tooltip_top}).fadeIn();
            $('.login_help_tooltip').css('display', 'none');
        });
    </script>
@endsection
