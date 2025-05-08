<?php
$username = form_input($code_mely_info);
$password = form_input($phone_info);
$captcha=form_input($captcha_info);
$email = form_input($email_info);
$tel = form_input($code_posty_info);
$btnRegister = form_button($btnRegister_info);
?>
<style>
.dan{
    line-height: 70px;
}
    .img-captcha{
        width:200px !important;
        height: 70px !important;
        float: left;
        margin-bottom: 6px;
    }
    .form-inter-captcha{
        width:200px!important;
    }
    #cap{
        display: inline;
        height: 67px;
        text-align: center;
        float: right;
        
    }
    form{
        margin-bottom:50px !important;
    }
</style>
<div class="container">
    <div class="row mt-2">
        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
            <div class="card-sigin">
                <div class="mb-5 d-flex"><a href="index.php">
                        <img src="../../../assets/img/brand/<?= $logo?>"
                             style="width:75px;height:75px;border-radius: 50px;"
                             class="sign-favicon ht-40"
                             alt="لوگو"></a>
                    <h1 class="main-logo1 m-2 my-auto tx-20 text-secondary">پرتال ساز علاالدین</h1>
                </div>
                <div class="main-signup-header">
                    <p class="text-primary alert alert-info tx-14 text-center rounded-10">ساخت حساب کاربری</p>
                    <?php if (!empty($success)) { ?>
                        <p class="alert alert-success text-center tx-14 mb-4 mt-3 rounded-10">
                            <?= $success ?>
                        </p>
                    <?php } if (isset($error) && !empty($error)) {
                    $a=" <div class='alert alert-danger text-center tx-14 mb-4 mt-3 rounded-10'>";
                    foreach ($error as $key => $val){
                        $a.=$val;
                        
                    }
                    $a.="</div>";
                    echo $a;
                    }
                    if(!empty($captcha_error)){echo "<p class='alert alert-danger text-center tx-14 mb-4 mt-3 rounded-10'>".$captcha_error."</p>";}  
                    if (!empty($error_ins)) { ?>
                        <p class="alert alert-danger text-center tx-14 mb-4 mt-3 rounded-10">
                            <?= $error_ins ?>
                        </p>
                    <?php } ?>
                    <?= form_open() ?>
                    <div class="form-group">
                        <label></label>
                        <?= $username ?>
                    </div>
                    <div class="form-group">
                        <label></label>
                        <?= $password ?>
                    </div>
                    <div class="form-group">
                        <label></label>
                        <?= $email ?>
                    </div>
                  
                    <div class="form-group">
                        <label></label>
                        <?= $tel ?>
                    </div>
                    <div class="form-group dan">
                        <label></label>
                        <img src="<?= base_url().'auth'.DS.'captcha'?>" class='img-captcha' alt="captcha">
                        <span id="cap_err" style="dispaly:none;padding-top: 22px;padding-bottom: 22px;" class="alert alert-danger rounded-10 mt-5 pd-x-25 text-center mr-3">کد را به درستی وارد کنید</span>    
                        <?= $captcha ?>
                        
                    </div>
                    
                    <div class="form-group">
                        <?= $btnRegister ?>
                    </div>
                    <div class="form-group my-2">
                        <a class='' href='<?= base_url().$auth?>'>ورود به پنل</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- End -->
