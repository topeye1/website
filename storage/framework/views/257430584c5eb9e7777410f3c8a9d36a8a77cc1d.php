<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="col-sm-3 "></div>
            <div class="card notice-card">
                <div class="card-header d-flex justify-content-center notice-card-header">
                    <ul class="nav nav-underline" style="font-size: 16px">
                        <li class="nav-item">
                            <a class="nav-link active" data-set="all" href="#"><?php echo e(__('userpage.notice_all')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-set="agent" href="#"><?php echo e(__('userpage.notice_agent')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-set="persion" href="#"><?php echo e(__('userpage.notice_personal')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-set="details" href="#"><?php echo e(__('userpage.notice_details')); ?></a>
                        </li>
                    </ul>
                </div>

                <div class="card-body form-group" id="table_user_list" style="display:none; width: 50%; margin: 0 auto">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 pb-md-0 pb-sm-2">
                                        <input type="text" id="search_text" class="form-control" placeholder="<?php echo e(__('userpage.search')); ?>">
                                    </div>
                                    <div class="col-md-2 pb-md-0 pb-sm-2 text-right">
                                        <span class="col-auto pl-2">
                                            <button id="search_btn" class="btn btn-primary" type="button"><i class="fe fe-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 pr-0 pl-0">
                                <div class="e-table">
                                    <div class="table-responsive table-lg">
                                        <table class="table table-bordered mb-0 text-center">
                                            <thead>
                                            <tr>
                                                <th style="width: 20%" ><?php echo e(__('userpage.user_number')); ?></th>
                                                <th style="width: 40%" ><?php echo e(__('userpage.phone')); ?></th>
                                                <th style="width: 40%" ><?php echo e(__('userpage.name')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody_user_list">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php echo $__env->make('layouts.page-navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="card-body form-group notice-card-body-send" style="width: 50%; margin: 0 auto">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2"><?php echo e(__('userpage.notice_title')); ?></div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="notice_title" placeholder="" value="">
                                <div class="col" id="error_title" style="display: none; font-size: 0.75rem"></div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2"><?php echo e(__('userpage.notice_content')); ?></div>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="6" id="notice_content"></textarea>
                                <div class="col" id="error_content" style="display: none; font-size: 0.75rem"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body form-group notice-card-body-details" style="display: none; border-top: 0; width: 80%; margin: 0 auto">
                    <div class="e-table form-group">
                        <div class="table-responsive table-lg">
                            <table class="table table-bordered mb-0 text-center">
                                <thead>
                                <tr>
                                    <th style="width: 15%"><?php echo e(__('userpage.notice_date')); ?></th>
                                    <th style="width: 15%"><?php echo e(__('userpage.notice_target')); ?></th>
                                    <th style="width: 25%"><?php echo e(__('userpage.notice_title')); ?></th>
                                    <th style="width: 35%"><?php echo e(__('userpage.notice_content')); ?></th>
                                    <th style="width: 10%"><?php echo e(__('userpage.notice_memo')); ?></th>
                                </tr>
                                </thead>
                                <tbody id="tbody_notice_list">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php echo $__env->make('layouts.page-navigation-func', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>


                <div class="card-footer text-center card-notice-add-btn">
                    <div id="send_message_button" class="btn btn-success mt-1" style="width: 80px; margin-right: 30px;"><?php echo e(__('userpage.notice_send')); ?></div>
                </div>

            </div>
            <div class="col-sm-3 "></div>
        </div>
    </div>

    <?php echo $__env->make('modals.notice-error-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.notice-result-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script>
        let setv = 'all';
        let search_val = '';
        let pstart = 1;
        let mpstart = 1;
        let pnum = pstart;
        let numg = <?php echo e(session()->get('pages')); ?>;
        let sel_user = 0;

        $(document).ready(function () {
            $('.notice-card-header .nav-link').click(function(){
                pstart = 1;
                mpstart = 1;
                setv = $(this).attr('data-set');

                $('.notice-card-header .nav-link').attr('class','nav-link');
                $(this).attr('class','nav-link active');

                if(setv === 'details'){
                    $('#table_user_list').css({'display':'none'});
                    $('.notice-card .notice-card-body-send').css({'display':'none'});
                    $('.notice-card .notice-card-body-details').css({'display':'block'});
                    $('#send_message_button').css({'display':'none'});
                    getMessageList();
                }
                else{
                    if (setv === 'persion') {
                        $('#table_user_list').css({'display':'block'});
                        showTableList();
                    } else {
                        sel_user = 0;
                        $('#table_user_list').css({'display':'none'});
                    }
                    $('.notice-card .notice-card-body-send').css({'display':'block'});
                    $('.notice-card .notice-card-body-details').css({'display':'none'});
                    $('#send_message_button').css({'display':'inline-block'});
                }
            });

            $('#search_btn').click(function(){
                search_val = $('#search_text').val().replace(/\s/g, '');
                showTableList();
            });

            $('#send_message_button').click(function () {
                if(setv==='persion') {
                    if(sel_user === 0) {
                        $('#showModal').modal('show');
                        return;
                    }
                }
                let title = $('#notice_title').val();
                let content = $('#notice_content').val();

                if(title === ''){
                    $('#error_title').css({'display':'block','margin-top':'10px', 'color':'#d41b11'}).text('<?php echo e(__('userpage.err_notice_title')); ?>');
                    setTimeout(function () {
                        $('#error_title').text('').css({'display':'none', 'margin-top':'0'});
                    },1500);
                    return;
                }
                if(content === ''){
                    $('#error_content').css({'display':'block','margin-top':'10px', 'color':'#d41b11'}).text('<?php echo e(__('userpage.err_notice_content')); ?>');
                    setTimeout(function () {
                        $('#error_content').text('').css({'display':'none', 'margin-top':'0'});
                    },1500);
                    return;
                }

                $.ajax({
                    url: '/admin.noticeSend',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    data: {
                        msg_type:setv,
                        msg_title: title,
                        msg_content: content,
                        target:sel_user
                    },
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            $('#ResultMessageModal').modal('show');
                            $('#result_modal_title').css({'display':'block','margin-top':'10px', 'color':'#0BC334'}).text('<?php echo e(__('userpage.success_send_notice')); ?>');
                            setTimeout(function () {
                                $('#notice_title').val('');
                                $('#notice_content').val('');
                                $('#ResultMessageModal').modal('hide');
                            },1000);
                        }else{
                            $('#ResultMessageModal').modal('show');
                            $('#result_modal_title').css({'display':'block','margin-top':'10px', 'color':'#d41b11'}).text('<?php echo e(__('userpage.failed_send_notice')); ?>');
                            setTimeout(function () {
                                $('#ResultMessageModal').modal('hide');
                            },1000);
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                    }
                });

            });
        });

        function showTableList() {
            $.ajax({
                url: '/admin.noticeUser',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    start: pstart,
                    search_val:search_val
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#tbody_user_list').html('');

                        let lists = data.lists;
                        pstart = parseInt(data.start);
                        let totalpage = parseInt(data.totalpage);
                        let tags = '';

                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let num = list.num;
                            let phone = list.phone || '';
                            let name = list.name || '';

                            tags += '<tr class="select_tr" data-id="'+num+'" style="cursor: pointer">';
                            tags += '<td class="text-nowrap align-middle">' + num + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + phone + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + name + '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_user_list').html(tags);

                        setTablePageNavigation(totalpage, pstart);

                        $('tr[class="select_tr"]').click(function(){
                            let user_id = $(this).attr("data-id");
                            sel_user = user_id;
                            let objs = $('tr[class="select_tr"]');
                            if(objs && objs.length > 0){
                                for(let i=0;i<objs.length;i++){
                                    let o = objs[i];
                                    let o_id = o.getAttribute('data-id');
                                    if(parseInt(user_id) === parseInt(o_id)){
                                        o.style.backgroundColor="#dedfdf";
                                    }
                                    else{
                                        o.style.backgroundColor="transparent";
                                    }
                                }
                            }
                        });
                    }
                    else {
                        $('#tbody_user_list').html('');
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
        function getMessageList() {
            $.ajax({
                url: '/admin.noticeList',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    start: mpstart
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#tbody_notice_list').html('');

                        let lists = data.lists;
                        mpstart = parseInt(data.start);
                        let totalpage = parseInt(data.totalpage);
                        let tags = '';

                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let create_date = list.create_date;
                            let title = list.msg_title || '';
                            let content = list.msg_content || '';
                            let sender = list.msg_sender || '';
                            let type = list.msg_type;
                            let target = '';
                            if (type === "all") {
                                target = '<?php echo e(__('userpage.notice_all')); ?>';
                            } else if(type === "agent") {
                                target = '<?php echo e(__('userpage.notice_agent')); ?>';
                            } else {
                                target = list.msg_target || '';
                            }

                            tags += '<tr>';
                            tags += '<td class="text-nowrap align-middle">' + create_date + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + target + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + title + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + content + '</td>';
                            tags += '<td class="text-nowrap align-middle"></td>';
                            tags += '</tr>';
                        }
                        $('#tbody_notice_list').html(tags);

                        setFuncPageNavigation(totalpage, mpstart, getMessageList);
                    }
                    else {
                        $('#tbody_notice_list').html('');
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/admin/notice-view.blade.php ENDPATH**/ ?>