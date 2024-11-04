<?php $__env->startSection('content'); ?>
<div class="col-xl-5 col-lg-6 col-md-4">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-3"><?php echo e(__('userpage.signup1')); ?></h1>
                        </div>
                        <form class="user">
                            <div class="form-group my-form mb-0">
                                <?php echo e(__('userpage.id')); ?>

                            </div>
                            <div class="form-group row mb-1 mt-1">
                                <div class="col-md-7 middle-text">
                                    <input type="email" class="form-control form-control-user my-input" name="input_id" id="input_id" placeholder="<?php echo e(__('userpage.id_help')); ?>">
                                </div>
                                <div class="col-md-5 middle-btn">
                                    <div id="button_send_code" class="btn btn-primary btn-user btn-block"><?php echo e(__('userpage.send_code')); ?></div>
                                </div>
                            </div>
                            <div class="form-group my-form mb-3">
                                <?php echo e(__('userpage.id_des')); ?>

                            </div>

                            <div class="form-group my-form mb-0">
                                <?php echo e(__('userpage.auth_code')); ?>

                            </div>
                            <div class="form-group row mb-3 mt-1">
                                <div class="col-md-7 middle-text">
                                    <input type="text" class="form-control form-control-user my-input" name="input_code" id="input_code">
                                    <input type="hidden" name="confirm_code" id="confirm_code">
                                </div>
                                <div class="col-md-5 middle-btn">
                                    <div id="button_auth" class="btn btn-primary btn-user btn-block"><?php echo e(__('userpage.auth')); ?></div>
                                </div>

                            </div>

                            <div class="form-group my-form mb-0">
                                <?php echo e(__('userpage.password')); ?>

                            </div>
                            <div class="form-group mb-1 mt-1">
                                <input type="password" class="form-control form-control-user my-input" name="input_password" id="input_password" placeholder="<?php echo e(__('userpage.password')); ?>">
                            </div>
                            <div class="form-group my-form mb-3">
                                <?php echo e(__('userpage.password_des')); ?>

                            </div>

                            <div class="form-group my-form mb-0">
                                <?php echo e(__('userpage.confirm_pwd')); ?>

                            </div>
                            <div class="form-group mb-1 mt-1">
                                <input type="password" class="form-control form-control-user my-input" name="input_check_password" id="input_check_password" placeholder="<?php echo e(__('userpage.confirm_pwd')); ?>">
                            </div>
                            <div class="form-group my-form mb-3" id="confirm_pwd">
                                <span class="form-label" id="nomatch_pwd" style="color: red; display: none;"><?php echo e(__('userpage.nomatch_pwd')); ?></span>
                            </div>

                            <div class="form-group my-form mb-0">
                                <?php echo e(__('userpage.name')); ?>

                            </div>
                            <div class="form-group mb-3 mt-1">
                                <input type="text" class="form-control form-control-user my-input" name="input_name" id="input_name">
                            </div>

                            <div class="form-group my-form mb-0">
                                <?php echo e(__('userpage.phone')); ?>

                            </div>
                            <div class="form-group mb-3 mt-1">
                                <input type="text" class="form-control form-control-user my-input" name="input_phone" id="input_phone">
                            </div>

                            <div id="button_login" class="btn btn-primary btn-user my-view btn-block mb-2"><?php echo e(__('userpage.conditions_view')); ?></div>

                            <div class="form-group my-form mb-3 row">
                                <div class="col-md-9 pl-3 d-flex justify-content-center align-items-end">
                                    <span class="form-label" style="text-align: right"><?php echo e(__('userpage.agree_conditions')); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" style="width: 20px" type="checkbox" name="input_conditions_check" id="input_conditions_check">
                                </div>
                            </div>



                            <div id="button_login" class="btn btn-primary btn-user btn-block"><?php echo e(__('userpage.sign_up')); ?></div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>

        $(document).ready(function () {
            $('#button_send_code').click(function () {
                let id = $('#input_id').val().replace(/ /g, '');
                if(id === ""){
                    return;
                }
                $.ajax({
                    url: 'admin.authCodeMail',
                    cache: false,
                    data: {
                        email: id,
                    },
                    type: 'GET',
                    success: function (data) {
                        if (data.msg === "ok") {
                            code = data.code;
                            $('#confirm_code').val(code);
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                    }
                });
            });

            $('#button_auth').click(function () {
                let auth_code = $('#input_code').val().replace(/ /g, '');
                let confirm_code = $('#confirm_code').val().replace(/ /g, '');
                if (auth_code == confirm_code) {

                }
            });


            $('#button_signup').click(function () {
                let id = $('#input_id').val().replace(/ /g, '');
                let password = $('#input_password').val().replace(/ /g, '');
                let check_password = $('#input_check_password').val().replace(/ /g, '');
                let name = $('#input_name').val().replace(/ /g, '');
                let phone = $('#input_phone').val().replace(/ /g, '');
                let checked = $('#input_conditions_check');

                if(id === ""){
                    return;
                }

                if(!isNumeric(phone))
                {
                    return;
                }

                if(password === "") {
                    return;
                }

                if(check_password === "") {
                    return;
                }

                if(password !== check_password){
                    $('#nomatch_pwd').css('display', 'block');
                    return;
                } else {
                    $('#nomatch_pwd').css('display', 'none');
                }

                if(name === "") {
                    return;
                }

                if(!checked[0].checked) {
                    return;
                }

                let form_data = new FormData();
                form_data.append('user_id', id);
                form_data.append('user_pwd', password);
                form_data.append('user_name', name);
                form_data.append('user_phone', phone);

                $.ajax({
                    url: 'user.register',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            window.location.href = 'user';
                        }
                        else if(data.msg === "du"){
                            alert("User ID that already exists.");
                        }
                        else{
                            alert(" don't know -> " + data);
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                    }
                });
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/signup-corporate-view.blade.php ENDPATH**/ ?>