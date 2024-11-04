@extends('layouts.master_login')
@section('content')
<div class="col-xl-5 col-lg-6 col-md-4">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-3">{{ __('userpage.find_pwd') }}</h1>
                        </div>
                        <form class="user">
                            <div class="row mb-4">

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

                            <div id="button_login" class="btn btn-primary btn-user btn-block">{{ __('userpage.confirm') }}</div>

                            <div class="text-center link-btn mt-4">
                                <a class="small" href="user.user_login">{{ __('userpage.go_login') }}</a>
                            </div>

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



        });
    </script>
@endsection
