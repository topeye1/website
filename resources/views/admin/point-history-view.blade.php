@extends('layouts.master_admin')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="row mt-3 ml-3 mr-3 mb-md-3">
                <div class="input-group col-3 form-inline navbar-search">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="{{ __('userpage.search') }}" id="search_text">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="search_btn">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                        <tr>
                            <th width="10%">{{ __('userpage.paid_date') }}</th>
                            <th width="10%">{{ __('userpage.user_number') }}</th>
                            <th width="15%">{{ __('userpage.id') }}</th>
                            <th width="10%">{{ __('userpage.name') }}</th>
                            <th width="10%">
                                <div class="row">
                                    <div class="col-10">{{ __('userpage.points_pay') }}</div>
                                    <div class="col-2 d-flex align-items-center">
                                        <i class="fa fa-caret-down point-down" aria-hidden="true" style="display: none; cursor: pointer;"></i>
                                        <i class="fa fa-caret-up point-up" aria-hidden="true" style="display: block; cursor: pointer;"></i>
                                    </div>
                                </div>
                            </th>
                            <th width="10%">
                                <div class="row">
                                    <div class="col-10">{{ __('userpage.point_payer') }}</div>
                                    <div class="col-2 d-flex align-items-center">
                                        <i class="fa fa-caret-down payer-down" aria-hidden="true" style="display: none; cursor: pointer;"></i>
                                        <i class="fa fa-caret-up payer-up" aria-hidden="true" style="display: block; cursor: pointer;"></i>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbody_data_list">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.page-navigation')
        @include('modals.log-modal')
    </div>
@endsection
@section('js')
    <script>
        let pstart = 1;
        let search_val = '';
        let sort_field = 'create_date';
        let sort_direction = 'DESC';

        $(document).ready(function () {
            showTableList();
            $('.point-down').click(function(){
                $('.point-down').css('display', 'none');
                $('.point-up').css('display', 'block');
                $('.payer-down').css('display', 'none');
                $('.payer-up').css('display', 'block');
                sort_field = 'paid_point';
                sort_direction = 'ASC';
                showTableList();
            });
            $('.point-up').click(function(){
                $('.point-down').css('display', 'block');
                $('.point-up').css('display', 'none');
                $('.payer-down').css('display', 'none');
                $('.payer-up').css('display', 'block');
                sort_field = 'paid_point';
                sort_direction = 'DESC';
                showTableList();
            });
            $('.payer-down').click(function(){
                $('.point-down').css('display', 'none');
                $('.point-up').css('display', 'block');
                $('.payer-down').css('display', 'none');
                $('.payer-up').css('display', 'block');
                sort_field = 'payer_name';
                sort_direction = 'ASC';
                showTableList();
            });
            $('.payer-up').click(function(){
                $('.point-down').css('display', 'none');
                $('.point-up').css('display', 'block');
                $('.payer-down').css('display', 'block');
                $('.payer-up').css('display', 'none');
                sort_field = 'payer_name';
                sort_direction = 'DESC';
                showTableList();
            });

            $('#btn_add_user').click(function(){
                $('#addUserModal').modal('show');
            });

            $('#search_btn').click(function(){
                search_val = $('#search_text').val().replace(/ /g, '');
                showTableList();
            });

        });


        function showTableList() {
            $.ajax({
                url: '/admin.pointHistory',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    pstart: pstart,
                    search_val:search_val,
                    sort_field: sort_field,
                    sort_direction: sort_direction
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

                            tags += '<tr>';
                            tags += '<td>' + list.create_date + '</td>';
                            tags += '<td>' + list.user_num + '</td>';
                            tags += '<td>' + list.id + '</td>';
                            tags += '<td>' + list.name + '</td>';
                            tags += '<td>' + list.paid_point + '</td>';
                            tags += '<td>' + list.payer_name + '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_data_list').html(tags);

                        setTablePageNavigation(totalpage, pstart);

                        $('input[id^="checkbox_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[1];
                            let checked = $('#'+oid);
                            checkActive(num, checked[0].checked);
                        });

                        $('td[id^="log_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[1];
                            showLogHistory(num);
                        });

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
