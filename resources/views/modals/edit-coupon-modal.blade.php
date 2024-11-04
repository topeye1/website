<!-- Add User Modal-->
<div class="modal fade" id="editCouponModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="editCouponLabel" style="text-align: center;">{{ __('userpage.coupon_edit') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 pr-3">
                                <div class="row align-items-center">
                                    <div class="col-4">{{ __('userpage.coupon_name') }}</div>
                                    <div class="col-8">
                                        <input type="email" class="form-control form-control-user my-input" name="input_coupon_name" id="input_coupon_name">
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-4">{{ __('userpage.coupon_level') }}</div>
                                    <div class="col-8">
                                        <input type="number" class="form-control form-control-user my-input" name="input_coupon_level" id="input_coupon_level">
                                    </div>
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
                                    <div class="col-4">{{ __('userpage.validity') }}({{ __('userpage.days') }})</div>
                                    <div class="col-8">
                                        <input type="number" class="form-control form-control-user my-input" name="input_coupon_valid" id="input_coupon_valid">
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-4">{{ __('userpage.coupon_price') }}</div>
                                    <div class="col-8">
                                        <input type="number" class="form-control form-control-user my-input" name="input_coupon_price" id="input_coupon_price" value="1">
                                    </div>
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
                                    <div class="col-4">{{ __('userpage.amount_given') }}</div>
                                    <div class="col-8">
                                        <input type="number" class="form-control form-control-user my-input" name="input_amount_given" id="input_amount_given">
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-4">{{ __('userpage.coin_count') }}</div>
                                    <div class="col-8">
                                        <input type="number" class="form-control form-control-user my-input" name="input_coin_count" id="input_coin_count">
                                    </div>
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
                                    <div class="col-4">{{ __('userpage.description') }}</div>
                                    <div class="col-8">
                                        <textarea class="form-control" rows="3" id="input_description"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <div class="d-flex align-items-center">
                                            <div class="d-inline-block">
                                                <input class="form-control active-checked" type="checkbox" id="coupon_shop_check">
                                            </div>
                                            <div class="d-inline-block ml-3">{{ __('userpage.put_store') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                    <div class="col-12">
                        <div class="error-text" id="error_edit_coupon" style="display: none">{{ __('userpage.error_edit_coupon') }}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" id="btn_user_modal_cancel">{{ __('userpage.cancel') }}</button>
                <a class="btn btn-primary" href="#" id="btn_modal_edit">{{ __('userpage.edit') }}</a>
            </div>
        </div>
    </div>
</div>

<script>
    let coupon_num = 0;
    $(document).ready(function () {
        $('#btn_modal_edit').click(function(){
            let coupon_name = $('#input_coupon_name').val();
            let coupon_level = $('#input_coupon_level').val();
            let coupon_valid = $('#input_coupon_valid').val();
            let coupon_price = $('#input_coupon_price').val();
            let amount_given = $('#input_amount_given').val();
            let coin_count = $('#input_coin_count').val();
            let description = $('#input_description').val();
            let checked = $('#coupon_shop_check').prop('checked');

            if(coupon_name === "" ||
                coupon_level === "" ||
                coupon_valid === "" ||
                coupon_price === "" ||
                amount_given === "" ||
                coin_count === "" ||
                description === "" ) {
                $('#error_edit_coupon').css('display', 'block');
                return;
            }

            let form_data = new FormData();
            form_data.append('coupon_name', coupon_name);
            form_data.append('coupon_level', coupon_level);
            form_data.append('coupon_valid', coupon_valid);
            form_data.append('coupon_price', coupon_price);
            form_data.append('amount_given', amount_given);
            form_data.append('coin_count', coin_count);
            form_data.append('description', description);
            form_data.append('show', checked);
            form_data.append('coupon_num', coupon_num);

            $.ajax({
                url: '/admin.editCoupon',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#editCouponModal').modal('hide');
                        getCouponList();
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        });

        $('#editCouponModal').on('hidden.bs.modal', function () {
            $('#input_coupon_name').val('');
            $('#input_coupon_level').val('');
            $('#input_coupon_valid').val('');
            $('#input_coupon_price').val('');
            $('#input_amount_given').val('');
            $('#input_coin_count').val('');
            $('#input_description').val('');
            $('#coupon_shop_check').prop("checked", false);
            $('#error_edit_coupon').css('display', 'none');
            coupon_num = 0;
        })
    });

    function setEditCouponInfo(jdata) {
        let datas = jQuery.parseJSON(jdata);
        coupon_num = datas.coupon_num;
        $('#input_coupon_name').val(datas.coupon_name);
        $('#input_coupon_level').val(datas.coupon_level);
        $('#input_coupon_valid').val(datas.coupon_valid);
        $('#input_coupon_price').val(datas.coupon_price);
        $('#input_amount_given').val(datas.amount_given);
        $('#input_coin_count').val(datas.coin_count);
        $('#input_description').val(datas.description);
        if (parseInt(datas.show) === 1)
            $('#coupon_shop_check').prop("checked", true);
        else
            $('#coupon_shop_check').prop("checked", false);

        $('#editCouponModal').modal('show');
    }
</script>
