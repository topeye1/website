@extends('layouts.master_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="col-sm-3 "></div>
            <div class="card email-card">
                <div class="card-header d-flex justify-content-center email-card-header">
                    <ul class="nav nav-underline" style="font-size: 16px">
                        <li class="nav-item">
                            <a class="nav-link active" data-set="signup" href="#">{{ __('userpage.signup1') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-set="coupons" href="#">{{ __('userpage.coupon_related') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-set="agent" href="#">{{ __('userpage.agent_closing') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body form-group email-card-body-signup" style="width: 50%; margin: 0 auto; display: block;">
                    <div class="form-group">
                        <div class="row align-items-center">
                            <div class="col-md-3">{{ __('userpage.mail_auth') }}</div>
                            <div class="col-md-7" >
                                <div id="button_mail_1" style="display: none;">
                                    <input type="file" name="uploadfile_1" id="uploadfile_1" accept="text/html" value="" style="display: none">
                                    <input type="hidden" name="old_uploadfile_1" id="old_uploadfile_1" value="">
                                    <div id="button-file_1" class="btn btn-primary btn-user my-view btn-block mb-2">{{ __('userpage.select_html_file') }}</div>
                                </div>
                                <div id="cont_mail_1" style="display: none;">
                                    <a class="link_mail mr-3" id="link_mail_1" href="#"></a>
                                    <span id="date_1"></span>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div id="button-conf_1" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.confirm') }}</div>
                                <div id="button-edit_1" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.edit') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">{{ __('userpage.mail_signup') }}</div>
                            <div class="col-md-7" >
                                <div id="button_mail_2" style="display: none;">
                                    <input type="file" name="uploadfile_2" id="uploadfile_2" accept="text/html" value="" style="display: none">
                                    <input type="hidden" name="old_uploadfile_2" id="old_uploadfile_2" value="">
                                    <div id="button-file_2" class="btn btn-primary btn-user my-view btn-block mb-2">{{ __('userpage.select_html_file') }}</div>
                                </div>
                                <div id="cont_mail_2" style="display: none;">
                                    <a class="link_mail mr-3" id="link_mail_2" href="#"></a>
                                    <span id="date_2"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="button-conf_2" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.confirm') }}</div>
                                <div id="button-edit_2" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.edit') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">{{ __('userpage.mail_password') }}</div>
                            <div class="col-md-7" >
                                <div id="button_mail_3" style="display: none;">
                                    <input type="file" name="uploadfile_3" id="uploadfile_3" accept="text/html" value="" style="display: none">
                                    <input type="hidden" name="old_uploadfile_3" id="old_uploadfile_3" value="">
                                    <div id="button-file_3" class="btn btn-primary btn-user my-view btn-block mb-2">{{ __('userpage.select_html_file') }}</div>
                                </div>
                                <div id="cont_mail_3" style="display: none;">
                                    <a class="link_mail mr-3" id="link_mail_3" href="#"></a>
                                    <span id="date_3"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="button-conf_3" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.confirm') }}</div>
                                <div id="button-edit_3" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.edit') }}</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body form-group email-card-body-coupons" style="width: 50%; margin: 0 auto; display:none;">
                    <div class="form-group">
                        <div class="row align-items-center">
                            <div class="col-md-3">{{ __('userpage.mail_coupon') }}</div>
                            <div class="col-md-7" >
                                <div id="button_mail_4" style="display: none;">
                                    <input type="file" name="uploadfile_4" id="uploadfile_4" accept="text/html" value="" style="display: none">
                                    <input type="hidden" name="old_uploadfile_4" id="old_uploadfile_4" value="">
                                    <div id="button-file_4" class="btn btn-primary btn-user my-view btn-block mb-2">{{ __('userpage.select_html_file') }}</div>
                                </div>
                                <div id="cont_mail_4" style="display: none;">
                                    <a class="link_mail mr-3" id="link_mail_4" href="#"></a>
                                    <span id="date_4"></span>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div id="button-conf_4" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.confirm') }}</div>
                                <div id="button-edit_4" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.edit') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">{{ __('userpage.mail_due') }}</div>
                            <div class="col-md-7" >
                                <div id="button_mail_5" style="display: none;">
                                    <input type="file" name="uploadfile_5" id="uploadfile_5" accept="text/html" value="" style="display: none">
                                    <input type="hidden" name="old_uploadfile_5" id="old_uploadfile_5" value="">
                                    <div id="button-file_5" class="btn btn-primary btn-user my-view btn-block mb-2">{{ __('userpage.select_html_file') }}</div>
                                </div>
                                <div id="cont_mail_5" style="display: none;">
                                    <a class="link_mail mr-3" id="link_mail_5" href="#"></a>
                                    <span id="date_5"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="button-conf_5" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.confirm') }}</div>
                                <div id="button-edit_5" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.edit') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">{{ __('userpage.mail_used') }}</div>
                            <div class="col-md-7" >
                                <div id="button_mail_6" style="display: none;">
                                    <input type="file" name="uploadfile_6" id="uploadfile_6" accept="text/html" value="" style="display: none">
                                    <input type="hidden" name="old_uploadfile_6" id="old_uploadfile_6" value="">
                                    <div id="button-file_6" class="btn btn-primary btn-user my-view btn-block mb-2">{{ __('userpage.select_html_file') }}</div>
                                </div>
                                <div id="cont_mail_6" style="display: none;">
                                    <a class="link_mail mr-3" id="link_mail_6" href="#"></a>
                                    <span id="date_6"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="button-conf_6" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.confirm') }}</div>
                                <div id="button-edit_6" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.edit') }}</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body form-group email-card-body-agent" style="width: 50%; margin: 0 auto; display: none;">
                    <div class="form-group">
                        <div class="row align-items-center">
                            <div class="col-md-3">{{ __('userpage.mail_welcome') }}</div>
                            <div class="col-md-7" >
                                <div id="button_mail_7" style="display: none;">
                                    <input type="file" name="uploadfile_7" id="uploadfile_7" accept="text/html" value="" style="display: none">
                                    <input type="hidden" name="old_uploadfile_7" id="old_uploadfile_7" value="">
                                    <div id="button-file_7" class="btn btn-primary btn-user my-view btn-block mb-2">{{ __('userpage.select_html_file') }}</div>
                                </div>
                                <div id="cont_mail_7" style="display: none;">
                                    <a class="link_mail mr-3" id="link_mail_7" href="#"></a>
                                    <span id="date_7"></span>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div id="button-conf_7" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.confirm') }}</div>
                                <div id="button-edit_7" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.edit') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">{{ __('userpage.mail_closing') }}</div>
                            <div class="col-md-7" >
                                <div id="button_mail_8" style="display: none;">
                                    <input type="file" name="uploadfile_8" id="uploadfile_8" accept="text/html" value="" style="display: none">
                                    <input type="hidden" name="old_uploadfile_8" id="old_uploadfile_8" value="">
                                    <div id="button-file_8" class="btn btn-primary btn-user my-view btn-block mb-2">{{ __('userpage.select_html_file') }}</div>
                                </div>
                                <div id="cont_mail_8" style="display: none;">
                                    <a class="link_mail mr-3" id="link_mail_8" href="#"></a>
                                    <span id="date_8"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="button-conf_8" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.confirm') }}</div>
                                <div id="button-edit_8" class="btn btn-primary btn-user my-view btn-block" style="display: none;">{{ __('userpage.edit') }}</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-sm-3 "></div>
        </div>
    </div>

@endsection
@section('js')

    <script>
        let html_file_name = "";

        $(document).ready(function () {
            $('.email-card-header .nav-link').click(function(){
                pstart = 1;
                mpstart = 1;
                let setv = $(this).attr('data-set');

                $('.email-card-header .nav-link').attr('class','nav-link');
                $(this).attr('class','nav-link active');

                if(setv === 'signup'){
                    $('.email-card-body-signup').css({'display':'block'});
                    $('.email-card-body-coupons').css({'display':'none'});
                    $('.email-card-body-agent').css({'display':'none'});
                } else if(setv === 'coupons'){
                    $('.email-card-body-signup').css({'display':'none'});
                    $('.email-card-body-coupons').css({'display':'block'});
                    $('.email-card-body-agent').css({'display':'none'});
                } else if(setv === 'agent'){
                    $('.email-card-body-signup').css({'display':'none'});
                    $('.email-card-body-coupons').css({'display':'none'});
                    $('.email-card-body-agent').css({'display':'block'});
                }

            });

            checkMailCont();

            $('a[id^="link_mail_"]').click(function(){
                let oid=$(this).attr("id");
                let num = oid.split('_')[2];

                $.ajax({
                    url: '/admin.showHtml',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    data: {
                        index: num
                    },
                    type: 'POST',
                    success: function (data) {
                        $('#modal-file-name').text('');

                        if (data.msg === "ok") {
                            $('#modal-file-name').text(data.file_name);
                            //let iframe = '<iframe src="http://'+data.file_path+'"></iframe>'
                            window.open(data.file_path, '_blank');
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(jqXHR['responseText'] ?? errdata);
                    }
                });
            });

            $('div[id^="button-conf_"]').click(function(){
                let oid=$(this).attr("id");
                let num = oid.split('_')[1];
                let uploadfile_html =  $('#uploadfile_'+num).prop('files')[0];
                if (uploadfile_html === undefined || uploadfile_html === null || uploadfile_html === ''){
                    alert('You didn\'t select an upload file.');
                    return;
                }
                let form_data = new FormData();
                form_data.append('uploadfile_html', uploadfile_html);
                form_data.append('file_name', html_file_name);
                form_data.append('index', num);

                $.ajax({
                    url: '/admin.htmlFile',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === 'ok') {
                            checkMailCont();
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                    }
                });

            });
            $('div[id^="button-edit_"]').on('mouseup', function () {
                let oid=$(this).attr("id");
                let num = oid.split('_')[1];
                let id1 = 'cont_mail_'+num;
                let id2 = 'button_mail_'+num;
                let btn1 = 'button-conf_'+num;
                let btn2 = 'button-edit_'+num;
                $('#'+id1).css('display', 'none');
                $('#'+id2).css('display', 'block');
                $('#'+btn1).css('display', 'block');
                $('#'+btn2).css('display', 'none');
            });

            $('div[id^="button-file_"]').on('mouseup', function () {
                let oid=$(this).attr("id");
                let num = oid.split('_')[1];
                $('#uploadfile_'+num).trigger('click');
            });
            $('input[id^="uploadfile_"]').change(function(){
                let oid=$(this).attr("id");
                let num = oid.split('_')[1];
                if (this.files && this.files[0])
                {
                    html_file_name = this.files[0].name;
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#button-file_'+num).text(html_file_name);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

        });
        function checkMailCont() {
            $.ajax({
                url: '/admin.checkEmail',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let lists = data.mail_lists;
                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let eid = list.eid;
                            let id1 = 'cont_mail_'+eid;
                            let id2 = 'button_mail_'+eid;
                            let link = 'link_mail_'+eid;
                            let dt = 'date_'+eid;
                            let btn1 = 'button-conf_'+eid;
                            let btn2 = 'button-edit_'+eid;
                            showAndHidden(id1, id2, link, dt, btn1, btn2, list);
                        }
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

        function showAndHidden(id1, id2, link, dt, btn1, btn2, val) {
            if (val.file_name !== null && val.file_name !== '') {
                $('#'+id1).css('display', 'block');
                $('#'+id2).css('display', 'none');
                $('#'+btn1).css('display', 'none');
                $('#'+btn2).css('display', 'block');
                $('#'+link).text(val.file_name);
                $('#'+dt).text(val.upload_date);
            } else {
                $('#'+id1).css('display', 'none');
                $('#'+id2).css('display', 'block');
                $('#'+btn1).css('display', 'block');
                $('#'+btn2).css('display', 'none');
            }
        }



    </script>
@endsection
