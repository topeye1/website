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
                            <th width="7%">{{ __('userpage.user_number') }}</th>
                            <th width="15%">{{ __('userpage.id') }}</th>
                            <th width="10%">{{ __('userpage.name') }}</th>
                            <th width="10%">
                                <div class="row">
                                    <div class="col-10">{{ __('userpage.hold_points') }}</div>
                                    <div class="col-2 d-flex align-items-center">
                                        <i class="fa fa-caret-down point-down" aria-hidden="true" style="display: none; cursor: pointer;"></i>
                                        <i class="fa fa-caret-up point-up" aria-hidden="true" style="display: block; cursor: pointer;"></i>
                                    </div>
                                </div>
                            </th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody id="tbody_data_list">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.page-navigation')
        @include('modals.point-paying-modal')
        @include('modals.point-paying-confirm-modal')
    </div>
@endsection
@section('js')
    <script>
        let pstart = 1;
        let search_val = '';
        let sort_field = 'create_date';
        let sort_direction = 'DESC';

        $(document).ready(function () {
            $('.point-down').click(function(){
                $('.point-down').css('display', 'none');
                $('.point-up').css('display', 'block');
                sort_field = 'point';
                sort_direction = 'ASC';
                showTableList();
            });
            $('.point-up').click(function(){
                $('.point-down').css('display', 'block');
                $('.point-up').css('display', 'none');
                sort_field = 'point';
                sort_direction = 'DESC';
                showTableList();
            });
            showTableList();
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
                url: '/admin.pointList',
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

                        let tags = '';
                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];

                            tags += '<tr>';
                            tags += '<td>' + list.num + '</td>';
                            tags += '<td>' + list.id + '</td>';
                            tags += '<td>' + list.name + '</td>';
                            tags += '<td>' + list.point + '</td>';
                            tags += '<td>';
                            tags += '<div id="point-paying_'+list.num+'" data-set="'+list.name+'" class="btn btn-success m-1 pt-1 pb-1" style="background-color: #e3a90d; border-color: #c5920a; color: #fff;">{{ __('userpage.paying') }}</div>';
                            tags += '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_data_list').html(tags);

                        setTablePageNavigation(totalpage, pstart);

                        $('div[id^="point-paying_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[1];
                            let name = $(this).attr("data-set");
                            showPointPayingModal(num, name);
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
