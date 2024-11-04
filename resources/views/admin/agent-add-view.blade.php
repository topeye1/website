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
                        <th width="15%">{{ __('userpage.phone') }}</th>
                        <th width="10%">{{ __('userpage.name') }}</th>
                        <th width="10%">{{ __('userpage.level') }}</th>
                        <th width="10%">{{ __('userpage.days_signup') }}</th>
                        <th width="10%">{{ __('userpage.upper_agent') }}</th>
                        <th width="10%">{{ __('userpage.add') }}</th>
                    </tr>
                    </thead>
                    <tbody id="tbody_data_list">


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.page-navigation')
    @include('modals.agent-fee-rate-modal')
</div>
@endsection
@section('js')
<script>
    let pstart = 1;
    let search_val = '';

    $(document).ready(function () {
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
            url: '/admin.agentAddableList',
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

                    let tags = '';
                    for (let i = 0; i < lists.length; i++) {
                        let list = lists[i];
                        let agent_num = list.agent_num;
                        if (parseInt(agent_num) === 0) {
                            agent_num = "";
                        }
                        let agentable = list.agentable;

                        tags += '<tr>';
                        tags += '<td>' + list.num + '</td>';
                        tags += '<td>' + list.phone + '</td>';
                        tags += '<td>' + list.name + '</td>';
                        tags += '<td>' + list.level + '</td>';
                        tags += '<td>' + list.create_date + '</td>';
                        tags += '<td>' + agent_num + '</td>';
                        tags += '<td>';
                        if (parseInt(agentable) == 1) {
                            tags += '<div class="btn btn-success m-1 pt-1 pb-1" style="background-color: #cbcbcb; border-color: #cbcbcb; color: #7b7a7a; cursor: auto;">{{ __('userpage.agent_add') }}</div>';
                        } else {
                            tags += '<div id="add-agent_'+list.num+'" class="btn btn-success m-1 pt-1 pb-1" style="background-color: #fff; border-color: #cbcbcb; color: #7b7a7a">{{ __('userpage.agent_add') }}</div>';
                        }
                        tags += '</td>';
                        tags += '</tr>';
                    }
                    $('#tbody_data_list').html(tags);

                    setTablePageNavigation(totalpage, pstart);

                    $('div[id^="add-agent_"]').click(function(){
                        let oid=$(this).attr("id");
                        let num = oid.split('_')[1];
                        setAgentFeeRateInfo(num);
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
