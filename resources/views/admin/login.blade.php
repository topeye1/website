@extends('layouts.master_login')
@section('content')
<div class="col-xl-10 col-lg-12 col-md-9">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image">

                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ __('userpage.admin_login') }}</h1>
                        </div>
                        <form class="user">
                        <div class="form-group my-form mb-0">
                                {{ __('userpage.id') }}
                            </div>
                            <div class="form-group mb-1 mt-1">
                                <input type="email" class="form-control form-control-user my-input" name="input_id" id="input_id" placeholder="{{ __('userpage.id_help') }}">
                            </div>
                            <div class="form-group my-form mb-4">
                                {{ __('userpage.id_des') }}
                            </div>

                            <div class="form-group my-form mb-0">
                                {{ __('userpage.password') }}
                            </div>
                            <div class="form-group mb-1 mt-1">
                                <input type="password" class="form-control form-control-user my-input" name="input_pass" id="input_pass" placeholder="{{ __('userpage.password') }}">
                            </div>
                            <div class="form-group my-form mb-5">
                                {{ __('userpage.password_des') }}
                            </div>

                            <div id="button_login" class="btn btn-primary btn-user btn-block">{{ __('userpage.login') }}</div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            history.pushState(null, null, location.href);
            window.onpopstate = function(event) {
                history.go(1);
            };


            $('#button_login').click(function () {
                let userid = $('#input_id').val().replace(/ /g, '');
                let password = $('#input_pass').val().replace(/ /g, '');
                if(userid === ""){
                    return;
                }
                if(password === "") {
                    return;
                }

                $.ajax({
                    url:'/admin.adminLogin',
                    data: {
                        user_phone: userid,
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
                                url:'admin.get_user',
                                headers: {'Authorization': `Bearer ${access_token}`},
                                data: {
                                    'token': `${access_token}`
                                },
                                type: 'POST',
                                success: function (data) {
                                    if (data.msg === "ok") {
                                        window.location.href = "{{ url('/admin.dashboard-view/dashboard') }}";
                                    } else {
                                        alert(data.cont);
                                    }
                                }, error: function (jqXHR, errdata, errorThrown) {
                                    console.log(jqXHR['responseText'] ?? errdata);
                                }
                            });
                        }
                        else if (data.msg === 'nonuser') {
                            const message = "{{ __('userpage.error_id') }}";
                            alert(message);
                        } else if (data.msg === 'nonpwd') {
                            const message = "{{ __('userpage.error_pwd') }}";
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

        });
    </script>
@endsection
