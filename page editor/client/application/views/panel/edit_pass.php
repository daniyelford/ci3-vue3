<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class='my-5 container fluid' style="min-height:480px;">
    <div class='row row-sm'>
        <div class="col-xl-8 mx-auto my-5">
            <div class="card">
        	    <div class="card-body h-100">
                    <?= form_open()?>
                	<div class="row row-xs my-4" style="line-height: 0px;">
                        <div class="col-md-12 mg-t-10 mg-md-t-0">
                            <label>نام کاربری</label>
                        	<?= form_input($username) ?>
                        	<br>
                        	<span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="err-username">فرم را پر کنید</span>
                        </div>
                    </div>
                    <div class="row row-xs mb-4" style="line-height: 0px;">
                        <div class="col-md-6 mg-t-10 mg-md-t-0">
                            <label>رمز عبور</label>
                        	<?= form_input($pass) ?>
                        	<br>
                        	<span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="err-pass">فرم را پر کنید</span>
                        </div>
                        <div class="col-md-6 mg-t-10 mg-md-t-0">
                            <label>تکرار رمز عبور</label>
                        	<?= form_input($password) ?>
                        	<br>
                        	<span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="err-password">فرم را پر کنید</span>
                        </div>
                    </div>
                    <span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="err-pass-ag">رمز های عبور باید مشابه باشند</span>
                    <div class="row row-xs mb-1" style="line-height: 0px;">
                        <div class="col-md-6 mg-t-10 mg-md-t-0">
                            <a class='btn btn-block rounded-10 text-center text-white btn-info' href='#' id="send">ویرایش</a>
                        </div>
                        <div class="col-md-6 mg-t-10 mg-md-t-0">
                            <a class='btn btn-block rounded-10 text-center text-white btn-danger' href="<?= base_url()?>home">انصراف</a>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#send').click(function(){
            if($('#username').val() == ''){
                $('#username').css('border','1px solid red');
                if($('#err-username').hasClass('d-none')){
                    $('#err-username').removeClass('d-none');
                }
            }else{
                if($('#err-username').hasClass('d-none')){}else{
                    $('#err-username').addClass('d-none');
                }
                $('#username').css('border','1px solid green');
            }
            if($('#pass').val() != $('#password').val()){
                if($('#err-pass-ag').hasClass('d-none')){
                    $('#err-pass-ag').removeClass('d-none');
                }
                $('#pass').css('border','1px solid red');
                $('#password').css('border','1px solid red');
            }else{
                if($('#err-pass-ag').hasClass('d-none')){}else{
                    $('#err-pass-ag').addClass('d-none');
                }
                $('#pass').css('border','1px solid green');
                $('#password').css('border','1px solid green'); 
            }
            if($('#pass').val() == ''){
                if($('#err-pass').hasClass('d-none')){
                    $('#err-pass').removeClass('d-none');
                }
                $('#pass').css('border','1px solid red');
            }else{
                if($('#err-pass').hasClass('d-none')){}else{
                    $('#err-pass').addClass('d-none');
                }
                $('#pass').css('border','1px solid green');
            }
            if($('#password').val() == ''){
                if($('#err-password').hasClass('d-none')){
                    $('#err-password').removeClass('d-none');
                }
                $('#password').css('border','1px solid red');
            }else{
                if($('#err-password').hasClass('d-none')){}else{
                    $('#err-password').addClass('d-none');
                }
                $('#password').css('border','1px solid green');
            }
           
            if($('#username').val() != '' && $('#pass').val() != '' && $('#password').val() != '' && $('#pass').val() == $('#password').val()){
                let usr=$('#username').val();
                let pss=$('#password').val();
                let send='send';
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>user/check_change_pass",
                    data:{usr:usr,pss:pss,send:send},
                    success:function (values){
                        if(values == 0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "",
                                icon: "error",
                                button: "متوجه شدم",
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>user/change_password"); 
                            });
                        }
                        if(values == 1){
                            swal({
                                title: "عملیات موفق",
                                text: "ویرایش شد",
                                icon: "success",
                                button: "ادامه",
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>home"); 
                            });
                        }
                    }
                })
            }
        })
    })
</script>