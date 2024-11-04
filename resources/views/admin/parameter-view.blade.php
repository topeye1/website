@extends('layouts.master_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="col-sm-3 "></div>
            <div class="card param-tab">
                <div class="card-header d-flex justify-content-center param-tab-header">
                    <ul class="nav nav-underline" style="font-size: 16px">
                        <li class="nav-item">
                            <a class="nav-link active" data-set="watcher" href="#">Watcher</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-set="maker" href="#">Maker</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-set="etc" href="#">ETC</a>
                        </li>
                    </ul>
                </div>


                <div class="card-body form-group param-body-watcher" style="width: 80%; margin: 0 auto">
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w1" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w1') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w2" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w2') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-5 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w3" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w3') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <h6>L-Stop</h6>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w4" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w4') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w5" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w5') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-5 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w6" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w6') }}</div>
                                    </div>

                                </div>
                                {{--<div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <select class="list-pages" id="input_param_w7" style="text-align: center; width: 100%; font-size: .8rem; border-radius: 0.4rem; padding: 0.5rem 0; border: 1px solid #d1d3e2;" disabled>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w7') }}</div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <h6>S-Break</h6>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w8" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w8') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w9" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w9') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_w10" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w10') }}</div>
                                    </div>

                                </div>
                                {{--<div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <select class="list-pages" id="input_param_w11" style="text-align: center; width: 100%; font-size: .8rem; border-radius: 0.4rem; padding: 0.5rem 0; border: 1px solid #d1d3e2;" disabled>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_w11') }}</div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body form-group param-body-maker" style="display: none; width: 80%; margin: 0 auto">
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m1" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m1') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m2" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m2') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m3" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m3') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m4" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m4') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m5" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m5') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m6" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m7') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m7" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m8') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m8" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m9') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m9" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m10') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m10" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m11') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m11" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m12') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m12" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m13') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m13" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m14') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m14" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m15') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m15" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m16') }}</div>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_m16" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_m19') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body form-group param-body-etc" style="display: none; width: 80%; margin: 0 auto">
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_e1" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_e1') }}</div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_e2" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_e2') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_e3" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_e3') }}</div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_e4" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_e4') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 pr-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <input type="number" class="form-control form-control-user my-input" id="input_param_e5" style="text-align: center;">
                                        </div>
                                        <div class="col-9">{{ __('userpage.param_e5') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center card-notice-add-btn">
                    <div id="edit_param_button" class="btn btn-success mt-1" style="width: 80px; margin-right: 30px;">{{ __('userpage.edit') }}</div>
                </div>

            </div>
            <div class="col-sm-3 "></div>
        </div>
    </div>

@endsection
@section('js')

    <script>
        let setv = 'watcher';
        let e_param = ['m1', 'm2', 'm3', 'm4', 'm5', 'm7', 'm8', 'm9', 'm10', 'm11', 'm12', 'm13', 'm14', 'm15', 'm16', 'm19']
        getParamInfo();
        $(document).ready(function () {
            $('.param-tab-header .nav-link').click(function(){
                setv = $(this).attr('data-set');

                $('.param-tab-header .nav-link').attr('class','nav-link');
                $(this).attr('class','nav-link active');

                if (setv === 'watcher') {
                    $('.param-tab .param-body-watcher').css({'display':'block'});
                    $('.param-tab .param-body-maker').css({'display':'none'});
                    $('.param-tab .param-body-etc').css({'display':'none'});
                } else if (setv === 'maker') {
                    $('.param-tab .param-body-watcher').css({'display':'none'});
                    $('.param-tab .param-body-maker').css({'display':'block'});
                    $('.param-tab .param-body-etc').css({'display':'none'});
                } else if (setv === 'etc') {
                    $('.param-tab .param-body-watcher').css({'display':'none'});
                    $('.param-tab .param-body-maker').css({'display':'none'});
                    $('.param-tab .param-body-etc').css({'display':'block'});
                }

            });
            $('#input_param_m1').change(function() {
                let val = $('#input_param_m1').val()
                if (parseFloat(val) > 5)
                    val = 5
                else if (parseFloat(val) < 0.5)
                    val = 0.5
                $('#input_param_m1').val(val)
            });
            $('#input_param_m2').change(function() {
                let val = $('#input_param_m2').val()
                if (parseFloat(val) > 5)
                    val = 5
                else if (parseFloat(val) < 0.5)
                    val = 0.5
                $('#input_param_m2').val(val)
            });
            $('#input_param_m3').change(function() {
                let val = $('#input_param_m3').val()
                if (parseFloat(val) > 5)
                    val = 5
                else if (parseFloat(val) < 0.5)
                    val = 0.5
                $('#input_param_m3').val(val)
            });
            $('#input_param_m4').change(function() {
                let val = $('#input_param_m4').val()
                if (parseFloat(val) > 5)
                    val = 5
                else if (parseFloat(val) < 0.5)
                    val = 0.5
                $('#input_param_m4').val(val)
            });
            $('#input_param_m11').change(function() {
                let val = $('#input_param_m11').val()
                if (parseFloat(val) > 1.5)
                    val = 1.5
                else if (parseFloat(val) < 0.5)
                    val = 0.5
                $('#input_param_m11').val(val)
            });
            $('#input_param_m12').change(function() {
                let val = $('#input_param_m12').val()
                if (parseFloat(val) > 1.5)
                    val = 1.5
                else if (parseFloat(val) < 0.5)
                    val = 0.5
                $('#input_param_m12').val(val)
            });
            $('#input_param_m13').change(function() {
                let val = $('#input_param_m13').val()
                if (parseFloat(val) > 1.5)
                    val = 1.5
                else if (parseFloat(val) < 0.5)
                    val = 0.5
                $('#input_param_m13').val(val)
            });
            $('#input_param_m14').change(function() {
                let val = $('#input_param_m14').val()
                if (parseFloat(val) > 1.5)
                    val = 1.5
                else if (parseFloat(val) < 0.5)
                    val = 0.5
                $('#input_param_m14').val(val)
            });
            $('#input_param_m15').change(function() {
                let val = $('#input_param_m15').val()
                if (parseFloat(val) > 3)
                    val = 3
                else if (parseFloat(val) < -3)
                    val = -3
                $('#input_param_m15').val(val)
            });

            $('#edit_param_button').click(function () {
                let edit_datas = [];
                if (setv === 'watcher') {
                    for (let i = 1; i <= 11; i++) {
                        let param1 = 'w' + i;
                        let param2 = $('#input_param_w'+i).val();
                        let param = {
                            p1: param1,
                            p2: param2
                        }
                        edit_datas.push(param);
                    }
                } else if (setv === 'maker') {
                    for (let i = 0; i < e_param.length; i++) {
                        let p_name = e_param[i]
                        let idx = i + 1;
                        let p_val = $('#input_param_m'+idx).val();
                        let param = {
                            p1: p_name,
                            p2: p_val
                        }
                        edit_datas.push(param);
                    }
                } else if (setv === 'etc') {
                    for (let i = 1; i <= 5; i++) {
                        let param1 = 'e' + i;
                        let param2 = $('#input_param_e'+i).val();
                        let param = {
                            p1: param1,
                            p2: param2
                        }
                        edit_datas.push(param);
                    }
                }
                let f_data = JSON.stringify(edit_datas);
                let form_data = new FormData();
                form_data.append('datas', f_data);

                $.ajax({
                    url: '/admin.editParam',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            alert('Updated successfully.');
                        } else if (data.msg === "err") {
                            alert('Update failed.')
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                        console.log(errorThrown);
                    }
                });

            });
        });

        function getParamInfo() {
            $.ajax({
                url: '/admin.paramInfo',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let lists = data.lists;
                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            if (list.ptype === 'w') {
                                if (list.pname === 'w1') {
                                    $('#input_param_w1').val(list.pvalue);
                                } else if (list.pname === 'w2') {
                                    $('#input_param_w2').val(list.pvalue);
                                } else if (list.pname === 'w3') {
                                    $('#input_param_w3').val(list.pvalue);
                                } else if (list.pname === 'w4') {
                                    $('#input_param_w4').val(list.pvalue);
                                } else if (list.pname === 'w5') {
                                    $('#input_param_w5').val(list.pvalue);
                                } else if (list.pname === 'w6') {
                                    $('#input_param_w6').val(list.pvalue);
                                }/* else if (list.pname === 'w7') {
                                    $('#input_param_w7').val(list.pvalue);
                                }*/ else if (list.pname === 'w8') {
                                    $('#input_param_w8').val(list.pvalue);
                                } else if (list.pname === 'w9') {
                                    $('#input_param_w9').val(list.pvalue);
                                } else if (list.pname === 'w10') {
                                    $('#input_param_w10').val(list.pvalue);
                                } /*else if (list.pname === 'w11') {
                                    $('#input_param_w11').val(list.pvalue);
                                }*/
                            } else if (list.ptype === 'm') {
                                if (list.pname === 'm1') {
                                    $('#input_param_m1').val(list.pvalue);
                                } else if (list.pname === 'm2') {
                                    $('#input_param_m2').val(list.pvalue);
                                } else if (list.pname === 'm3') {
                                    $('#input_param_m3').val(list.pvalue);
                                } else if (list.pname === 'm4') {
                                    $('#input_param_m4').val(list.pvalue);
                                } else if (list.pname === 'm5') {
                                    $('#input_param_m5').val(list.pvalue);
                                } else if (list.pname === 'm7') {
                                    $('#input_param_m6').val(list.pvalue);
                                } else if (list.pname === 'm8') {
                                    $('#input_param_m7').val(list.pvalue);
                                } else if (list.pname === 'm9') {
                                    $('#input_param_m8').val(list.pvalue);
                                } else if (list.pname === 'm10') {
                                    $('#input_param_m9').val(list.pvalue);
                                } else if (list.pname === 'm11') {
                                    $('#input_param_m10').val(list.pvalue);
                                } else if (list.pname === 'm12') {
                                    $('#input_param_m11').val(list.pvalue);
                                } else if (list.pname === 'm13') {
                                    $('#input_param_m12').val(list.pvalue);
                                } else if (list.pname === 'm14') {
                                    $('#input_param_m13').val(list.pvalue);
                                } else if (list.pname === 'm15') {
                                    $('#input_param_m14').val(list.pvalue);
                                } else if (list.pname === 'm16') {
                                    $('#input_param_m15').val(list.pvalue);
                                } else if (list.pname === 'm19') {
                                    $('#input_param_m16').val(list.pvalue);
                                }
                            } else if (list.ptype === 'e') {
                                if (list.pname === 'e1') {
                                    $('#input_param_e1').val(list.pvalue);
                                } else if (list.pname === 'e2') {
                                    $('#input_param_e2').val(list.pvalue);
                                } else if (list.pname === 'e3') {
                                    $('#input_param_e3').val(list.pvalue);
                                } else if (list.pname === 'e4') {
                                    $('#input_param_e4').val(list.pvalue);
                                } else if (list.pname === 'e5') {
                                    $('#input_param_e5').val(list.pvalue);
                                }
                            }
                        }
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                    console.log(errorThrown);
                }
            });
        }

    </script>
@endsection
