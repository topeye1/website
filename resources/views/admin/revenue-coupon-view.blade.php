@extends('layouts.master_admin')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="row mt-3 ml-3 mr-3 mb-md-3">
                <div class="input-group col-12">
                    <div class="row w-100 align-items-center">
                        <div class="col-md-5 align-items-center">
                            @include('layouts.date-radio-view')
                        </div>
                        <div class="col-md-3 pb-md-0 pb-sm-2">
                            @include('layouts.date-picker-view')
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                        <tr>
                            <th width="7%">{{ __('userpage.coupon_number') }}</th>
                            <th width="10%">{{ __('userpage.coupon_name') }}</th>
                            <th width="7%">{{ __('userpage.coupon_level') }}</th>
                            <th width="7%">{{ __('userpage.coin_count') }}</th>
                            <th width="12%">{{ __('userpage.amount_given') }}</th>
                            <th width="12%">{{ __('userpage.sale_price') }}</th>
                            <th width="10%">{{ __('userpage.sale_count') }}</th>
                            <th width="15%">{{ __('userpage.total_sale_money') }}</th>
                            <th width="7%">{{ __('userpage.method') }}</th>
                            <th width="7%">{{ __('userpage.deposit_count') }}</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_data_list">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.page-navigation')
        @include('modals.add-user-modal')
    </div>
@endsection
@section('js')
    <script>
        let pstart = 1;
        let search_val = '';
        let radio_idx = 1;
        let filter_date = '';
        let selected_date = '';

        function getCurrentDate(today, idx, val) {
            let date;
            if (parseInt(idx) === 1) {
                date = new Date(today.setDate(today.getDate() + val));
            }
            if (parseInt(idx) === 2) {
                date = new Date(today.setMonth(today.getMonth() + val))
            }
            if (parseInt(idx) === 3) {
                date = new Date(today.setFullYear(today.getFullYear() + val))
            }
            return date;
        }
        function setDatepicker(idx, date) {
            if (parseInt(idx) === 1) {
                $( "#input_datepicker_1" ).datepicker( "setDate", date );
                selected_date = $('#input_datepicker_1').datepicker('getDate');
                filter_date = $('#input_datepicker_1').val();
            } else if (parseInt(idx) === 2) {
                $( "#input_datepicker_2" ).datepicker( "setDate", date );
                selected_date = $('#input_datepicker_2').datepicker('getDate');
                filter_date = $('#input_datepicker_2').val();
            } else {
                $( "#input_datepicker_3" ).datepicker( "setDate", date );
                selected_date = $('#input_datepicker_3').datepicker('getDate');
                filter_date = $('#input_datepicker_3').val();
            }
        }

        $(document).ready(function () {
            let today = new Date();
            setDatepicker(radio_idx, getCurrentDate(today, radio_idx, 0));
            $('input[id^="seldate_"]').click(function(){
                let oid=$(this).attr("id");
                radio_idx = oid.split('_')[1];

                $('input[id^="input_datepicker_"]').css("display","none");
                $('input[id^="input_datepicker_"]').val();

                $('input[id^="input_datepicker_'+radio_idx+'"]').css("display","block");

                setDatepicker(radio_idx, getCurrentDate(today, radio_idx, 0));
                showTableList();
            });
            $('#input_datepicker_1').change(function(){
                pstart = 1;
                filter_date = $('#input_datepicker_1').val();
                selected_date = new Date(filter_date);
                showTableList();
            });
            $('#input_datepicker_2').change(function(){
                pstart = 1;
                let now_date = new Date();
                let day = '-' + ( (now_date.getDate()) < 9 ? "0" + (now_date.getDate()) : (now_date.getDate()));
                filter_date = $('#input_datepicker_2').val();
                selected_date = new Date(filter_date + day);
                showTableList();
            });
            $('#input_datepicker_3').change(function(){
                pstart = 1;
                let now_date = new Date();
                let month = '-' + ( (now_date.getMonth()+1) < 9 ? "0" + (now_date.getMonth()+1) : (now_date.getMonth()+1) );
                let day = '-' + ( (now_date.getDate()) < 9 ? "0" + (now_date.getDate()) : (now_date.getDate()));
                filter_date = $('#input_datepicker_3').val();
                selected_date = new Date(filter_date + month + day);
                showTableList();
            });
            $('#direction-left').click(function(){
                setDatepicker(radio_idx, getCurrentDate(selected_date, radio_idx, -1));
                showTableList();
            });
            $('#direction-right').click(function(){
                setDatepicker(radio_idx, getCurrentDate(selected_date, radio_idx, 1));
                showTableList();
            });

            showTableList();

        });


        function showTableList() {
            $.ajax({
                url: '/admin.couponRevenueCoupon',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    pstart: pstart,
                    search_date:filter_date
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#tbody_data_list').html('');

                        let lists = data.lists;
                        pstart = parseInt(data.pstart);
                        let totalpage = parseInt(data.totalpage);
                        let names = '';

                        let tags = '';
                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let active_checked = '';
                            let login_date = list.login_date;
                            if (login_date === null) {
                                login_date = "";
                            }

                            tags += '<tr>';
                            tags += '<td>' + list.num + '</td>';
                            tags += '<td id="table_user_'+list.num+'">' + list.id + '</td>';
                            tags += '<td>' + list.phone + '</td>';
                            tags += '<td>' + list.name + '</td>';
                            tags += '<td></td>';
                            tags += '<td></td>';
                            tags += '<td>' + list.level + '</td>';
                            tags += '<td>' + list.my_fee + '</td>';
                            tags += '<td>' + list.create_date + '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_data_list').html(tags);

                        setTablePageNavigation(totalpage, pstart);

                        $('td[id^="table_user_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[2];
                            showLogHistory(num);
                        });

                        setTopViewValue(
                            '{{ __('userpage.total_sale_money') }}',
                            '',
                            '{{ __('userpage.today') }}',
                            '0',
                            '{{ __('userpage.this_month') }}',
                            '0'
                        );
                    }
                    else {
                        $('#page_nav_container').html('');
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

    </script>

@endsection
