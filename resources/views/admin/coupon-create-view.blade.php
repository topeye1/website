@extends('layouts.master_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="col-sm-3 "></div>
            <div class="card notice-card">
                <div class="card-header d-flex justify-content-center notice-card-header">
                    <ul class="nav nav-underline" style="font-size: 16px">
                        <li class="nav-item">
                            <a class="nav-link active" data-set="manage" href="#">{{ __('userpage.coupon_manager') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-set="create" href="#">{{ __('userpage.coupon_create') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="container form-group notice-card-body-manage justify-content-center" style="border-top: 0; width: 80%; margin: 0 auto;">
                    <div class="row " id="coupon-card-layout">


                    </div>
                </div>

                <div class="card-body form-group notice-card-body-create" style="width: 40%; margin: 0 auto; display: none;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">{{ __('userpage.coupon_name') }}</div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="coupon_name" placeholder="" value="Test Coupon">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">{{ __('userpage.coupon_level') }}</div>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="coupon_level" placeholder="" value="0">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">{{ __('userpage.coupon_price') }}</div>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="coupon_price" placeholder="" value="0">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">{{ __('userpage.amount_given') }}</div>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="amount_given" placeholder="" value="0">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">{{ __('userpage.coin_count') }}</div>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="coin_count" placeholder="" value="0">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">{{ __('userpage.description') }}</div>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" id="coupon_description">Test Coupon Description</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center">
                                {{ __('userpage.put_store') }}
                            </div>
                            <div class="col-md-8">
                                <input type="checkbox" class="form-control active-checked" id="coupon_shop">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-center card-notice-add-btn">
                    <div id="create_coupon_button" class="btn btn-success mt-1" style="width: 150px; margin-right: 30px;">
                        {{ __('userpage.coupon_create') }}
                    </div>
                </div>

            </div>
            <div class="col-sm-3 "></div>
        </div>
    </div>

    @include('modals.notice-result-modal')
    @include('modals.edit-coupon-modal')

@endsection
@section('js')

    <script>
        let setv = 'all';

        $(document).ready(function () {
            shwoTab('manage');
            $('.notice-card-header .nav-link').click(function(){
                setv = $(this).attr('data-set');

                $('.notice-card-header .nav-link').attr('class','nav-link');
                $(this).attr('class','nav-link active');

                shwoTab(setv);
            });

            $('#create_coupon_button').click(function () {
                let coupon_name = $('#coupon_name').val();
                let coupon_level = $('#coupon_level').val();
                let coupon_price = $('#coupon_price').val();
                let amount_given = $('#amount_given').val();
                let coin_count = $('#coin_count').val();
                let coupon_description = $('#coupon_description').val();
                let coupon_shop = $('#coupon_shop').prop('checked');

                if(coupon_name === ''){
                    $('#coupon_name').val('Coupon Name');
                }
                if(coupon_level === ''){
                    $('#coupon_level').val('0');
                }
                if(coupon_price === ''){
                    $('#coupon_price').val('0');
                }
                if(amount_given === ''){
                    $('#amount_given').val('0');
                }
                if(coin_count === ''){
                    $('#coin_count').val('0');
                }

                let form_data = new FormData();
                form_data.append('coupon_name', coupon_name);
                form_data.append('coupon_level', coupon_level);
                form_data.append('coupon_price', coupon_price);
                form_data.append('amount_given', amount_given);
                form_data.append('coin_count', coin_count);
                form_data.append('coupon_description', coupon_description);
                form_data.append('coupon_shop', coupon_shop);

                $.ajax({
                    url: '/admin.createCoupon',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            $('#ResultMessageModal').modal('show');
                            $('#result_modal_title').css({'display':'block','margin-top':'10px', 'color':'#0BC334'}).text('{{ __('userpage.success_create_coupon') }}');
                            setTimeout(function () {
                                $('#notice_title').val('');
                                $('#notice_content').val('');
                                $('#ResultMessageModal').modal('hide');
                                window.location.href = "{{ url('/admin.coupon-create-view/create-coupon') }}";
                            },2000);
                        }else{
                            $('#ResultMessageModal').modal('show');
                            $('#result_modal_title').css({'display':'block','margin-top':'10px', 'color':'#d41b11'}).text('{{ __('userpage.failed_create_coupon') }}');
                            setTimeout(function () {
                                $('#ResultMessageModal').modal('hide');
                            },2000);
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                    }
                });

            });
        });
        function shwoTab(tab) {
            if(tab === 'create'){
                $('.notice-card .notice-card-body-create').css({'display':'block'});
                $('.notice-card .notice-card-body-manage').css({'display':'none'});
                $('#create_coupon_button').css({'display':'inline-block'});
            }
            else{
                $('.notice-card .notice-card-body-create').css({'display':'none'});
                $('.notice-card .notice-card-body-manage').css({'display':'block'});
                $('#create_coupon_button').css({'display':'none'});
                getCouponList();
            }
        }

        function showErrorModal(txt) {
            $('#showErrorModal').modal('show');
            $('#error_modal_title').css({'display':'block','margin-top':'10px', 'color':'#d41b11'}).text(txt);
            setTimeout(function () {
                $('#showErrorModal').modal('hide');
            },1000);
        }

        function getCouponList() {
            $.ajax({
                url: '/admin.couponList',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        showCouponCard(data.lists)
                    }
                    else {
                        $('#coupon-card-layout').html('');
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

        function showCouponCard(cards) {
            $('#coupon-card-layout').html('');
            let tag = '';
            let div_item = '<div class="d-flex flex-row justify-content-center coupon-card-column">';

            for (let i = 0; i < cards.length; i++) {
                let card = cards[i];
                let card_data = JSON.stringify(card);
                let card_num = card.coupon_num;
                let name = card.coupon_name;
                let level = card.coupon_level;
                let price = card.coupon_price;
                let valid = card.coupon_valid;
                let given = card.amount_given;
                let coins = card.coin_count;
                let desc = card.description;
                let card_color = '#767F88';
                if (parseInt(level) === 1) {
                    card_color = '#767F88';
                } else if (parseInt(level) === 2) {
                    card_color = '#FFAA04';
                } else if (parseInt(level) === 3) {
                    card_color = '#F4519F';
                } else if (parseInt(level) === 4) {
                    card_color = '#13AE89';
                } else if (parseInt(level) === 5) {
                    card_color = '#F84747';
                } else if (parseInt(level) === 6) {
                    card_color = '#0098D9';
                } else if (parseInt(level) >= 7) {
                    card_color = '#9A62F7';
                }

                tag += '<div class="card shadow m-3 d-flex">';
                tag += '<div class="card-header py-3 d-flex flex-row align-items-center justify-content-center" style="background-color: '+card_color+'">';
                tag += '<h6 class="m-0 font-weight-bold card-header-title" id="card_coupon_name" style="color: white;">' + name + '</h6>';
                tag += '</div>';
                tag += '<div class="card-body coupon-card">';
                tag += div_item;
                tag += '<span class="mb-2" id="card_coupon_level">Lv.'+level+'</span>';
                tag += '</div>';
                tag += div_item;
                tag += '<span class="mb-2" id="card_coupon_valid">{{ __('userpage.validity') }} : '+valid+'({{ __('userpage.days') }})</span>';
                tag += '</div>';
                tag += div_item;
                tag += '<span class="mb-2" id="card_amount_given">{{ __('userpage.amount_given') }} : '+given+'</span>';
                tag += '</div>';
                tag += div_item;
                tag += '<span class="mb-2" id="card_coin_count">{{ __('userpage.coin_count') }} : '+coins+'</span>';
                tag += '</div>';
                tag += div_item;
                tag += '<span class="mb-2" id="card_description">'+desc+'</span>';
                tag += '</div>';
                tag += '<hr class="sidebar-divider">';
                tag += div_item;
                tag += '<span class="m-0" id="card_coupon_price">{{ __('userpage.sale_price') }} : '+price+'</span>';
                tag += '</div>';
                tag += '<div class="text-center">';
                tag += '<div id="delete-coupon-btn_'+card_num+'" class="btn btn-success mt-3 mr-5" style="background-color: #e1e1e1; border-color: #cbcbcb; color: #000">';
                tag += '{{ __('userpage.delete') }}';
                tag += '</div>';
                tag += '<div id="edit-coupon-btn_'+card_num+'" class="btn btn-success mt-3" data-set=\''+card_data+'\' style="background-color: #077709; border-color: #055f07; color: #fff">';
                tag += '{{ __('userpage.edit') }}';
                tag += '</div>';
                tag += '</div>';
                tag += '</div>';
                tag += '</div>';
            }

            $('#coupon-card-layout').html(tag);

            $('div[id^="edit-coupon-btn_"]').click(function(){
                let data = $(this).attr("data-set");
                setEditCouponInfo(data);
            });
            $('div[id^="delete-coupon-btn_"]').click(function(){
                let oid=$(this).attr("id");
                let card_num = oid.split('_')[1];
                $.ajax({
                    url: '/admin.deleteCoupon',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    data: {
                        coupon_num: card_num
                    },
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            getCouponList();
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                    }
                });
            });

        }

    </script>
@endsection
