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
                            <th width="7%">{{ __('userpage.permission') }}</th>
                            <th width="15%">{{ __('userpage.user_number') }}</th>
                            <th width="15%">{{ __('userpage.phone') }}</th>
                            <th width="10%">{{ __('userpage.name') }}</th>
                            <th width="10%">{{ __('userpage.level') }}</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_data_list">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.page-navigation')
        @include('modals.permission-modal')
    </div>
@endsection
@section('js')
    <script>
        let pstart = 1;
        let search_val = '';

        $(document).ready(function () {
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
                url: '/admin.permissionList',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    pstart: pstart,
                    search_val:search_val
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
                            let permission = list.permission;
                            let permission_text = "";
                            if (parseInt(permission) === 0) {
                                permission = 5;
                            }

                            if (parseInt(permission) === 1) {
                                permission_text = "{{ __('userpage.general_manager') }}";
                            }
                            else if (parseInt(permission) === 2) {
                                permission_text = "{{ __('userpage.manager') }}";
                            }
                            else if (parseInt(permission) === 3) {
                                permission_text = "{{ __('userpage.agent_manager') }}";
                            }
                            else if (parseInt(permission) === 4) {
                                permission_text = "{{ __('userpage.revenue_manager') }}";
                            }
                            else if (parseInt(permission) === 5) {
                                permission_text = "{{ __('userpage.investor') }}";
                            }

                            tags += '<tr>';
                            tags += '<td class="touch-td" id="permission_'+list.num+'" data-set="'+permission+'">'+permission_text+'</td>';
                            tags += '<td>' + list.num + '</td>';
                            tags += '<td>' + list.phone + '</td>';
                            tags += '<td>' + list.name + '</td>';
                            tags += '<td>' + list.level + '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_data_list').html(tags);

                        setTablePageNavigation(totalpage, pstart);

                        $('td[id^="permission_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[1];
                            let permission = $(this).attr("data-set");
                            setAssignPermissions(num, permission);
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
