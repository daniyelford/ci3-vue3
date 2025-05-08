<style data-styles="">
    ion-icon {
        visibility: hidden
    }

    .hydrated {
        visibility: inherit
    }
    .w-d{
        width: 48%;
        display: inline-block;
    }
    </style>
<style
        id="s./node_modules/css-loader/index.js!./node_modules/sass-loader/lib/loader.js!./package/src/animation.scss-0">/**
 * @license
 * Copyright Akveo. All Rights Reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 */
    .eva-animation {
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    .eva-infinite {
        animation-iteration-count: infinite;
    }

    .eva-icon-shake {
        animation-name: eva-shake;
    }

    .eva-icon-zoom {
        animation-name: eva-zoomIn;
    }

    .eva-icon-pulse {
        animation-name: eva-pulse;
    }

    .eva-icon-flip {
        animation-name: eva-flipInY;
    }

    .eva-hover {
        display: inline-block;
    }

    .eva-hover:hover .eva-icon-hover-shake, .eva-parent-hover:hover .eva-icon-hover-shake {
        animation-name: eva-shake;
    }

    .eva-hover:hover .eva-icon-hover-zoom, .eva-parent-hover:hover .eva-icon-hover-zoom {
        animation-name: eva-zoomIn;
    }

    .eva-hover:hover .eva-icon-hover-pulse, .eva-parent-hover:hover .eva-icon-hover-pulse {
        animation-name: eva-pulse;
    }

    .eva-hover:hover .eva-icon-hover-flip, .eva-parent-hover:hover .eva-icon-hover-flip {
        animation-name: eva-flipInY;
    }

    @keyframes eva-flipInY {
        from {
            transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
            animation-timing-function: ease-in;
            opacity: 0;
        }
        40% {
            transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
            animation-timing-function: ease-in;
        }
        60% {
            transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
            opacity: 1;
        }
        80% {
            transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
        }
        to {
            transform: perspective(400px);
        }
    }

    @keyframes eva-shake {
        from,
        to {
            transform: translate3d(0, 0, 0);
        }
        10%,
        30%,
        50%,
        70%,
        90% {
            transform: translate3d(-3px, 0, 0);
        }
        20%,
        40%,
        60%,
        80% {
            transform: translate3d(3px, 0, 0);
        }
    }

    @keyframes eva-pulse {
        from {
            transform: scale3d(1, 1, 1);
        }
        50% {
            transform: scale3d(1.2, 1.2, 1.2);
        }
        to {
            transform: scale3d(1, 1, 1);
        }
    }

    @keyframes eva-zoomIn {
        from {
            opacity: 1;
            transform: scale3d(0.5, 0.5, 0.5);
        }
        50% {
            opacity: 1;
        }
    }
</style>
<style>
    .jqstooltip {
        position: absolute;
        left: 0;
        top: 0;
        visibility: hidden;
        background: transparent;
        background-color: rgba(0, 0, 0, 0.6);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
        color: white;
        font: 10px iransans, san serif;
        text-align: left;
        white-space: nowrap;
        padding: 5px;
        border: 1px solid white;
        box-sizing: content-box;
        z-index: 10000;
    }

    .jqsfield {
        color: white;
        font: 10px iransans, san serif;
        text-align: left;
    }
</style>
<style>
    .bg-info {
        background-color: #2e95bc !important;
    }

    .height600 {

        height: 100% !important;
    }

    .height500 {
        height: 500px !important;
    }

    .height400 {
        height: 400px !important;
    }

    div.carousel-item img {
        height: 625px !important;
    }

    .carousel-item {
        transition: transform 0.3s ease-in-out !important;
    }

    /*#savePassword{*/
    /*    position:relative;top: 3px;*/
    /*}*/

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
</style>
<div class="container-fluid">
    <div class=" row no-gutter">
        <!-- The content half -->
        <div class="col-md-6 col-lg-6 col-xl-6 bg-light">
            <div class="login d-flex align-items-center py-2">
                <!-- Demo content-->
                <div class="container p-0">
                    <div class="row mt-2">
                        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                            <div class="card-sigin">
                                <div class="mb-5 d-flex"><a href="index.php">
                                        <img src="<?php echo base_url();?>assets/img/brand/<?= $logo ?>"
                                             style="width:75px;height:75px;border-radius: 50px;"
                                             class="sign-favicon ht-40"
                                             alt="لوگو"></a>
                                    <h1 class="main-logo1 m-2 my-auto tx-20 text-secondary"><?= $company_name ?></h1>
                                </div>
                                <div class="main-signup-header">
                                    <p class="text-primary alert alert-info tx-14 text-center rounded-10">ورود به
                                        پنل مدیریت</p>
                                    <?php if (!empty($error) && isset($error) && is_array($error)) {
                                        foreach ($error as $key => $val) {
                                            ?>
                                            <p class="alert alert-danger text-center font-weight-normal mb-4 mt-3 rounded-10">
                                                <?= $val ?>
                                            </p>
                                        <?php }
                                    }elseif(!empty($error) && isset($error) && is_string($error)){ ?>
                                    <p class="alert alert-danger text-center font-weight-normal mb-4 mt-3 rounded-10">
                                                <?= $error ?>
                                            </p>
                                    <?php }?>
                                    <?php if (!empty($success)) { ?>
                                        <p class="alert alert-success text-center font-weight-normal mb-4 mt-3 rounded-10">
                                            <?= $success ?>
                                        </p>
                                    <?php } ?>
                                    
                                    <?= form_open() ?>
                                    
                                   <?php if(isset($_GET['remember']) || empty($password) || empty($checkbox)){?>
                                    
                                    <div class="form-group">
                                        <label><?= $label3?></label> <?= form_input($username) ?>
                                    </div>
                                   
                                    <!--<?php // if(!empty($this->session->userdata('time_forgot'))){?>-->
                                    <!--<div class='form-group'><div class='alert alert-danger rounded-10 box-shadow-pink text-center'>-->
                                    <!--    برای دریافت دوباره ی رمز چند دقیقه صبر کنید-->
                                    <!--</div></div>-->
                                    <!--<?php// }else{?>-->
                                     <div class="form-group">
                                         <img src="<?= base_url().'auth'.DS.'captcha_forgot'?>" class='img-captcha' alt="captcha_forgot">
                                        <label><?= $label4 ?></label> <?= form_input($captcha_forgot_info) ?>
                                    </div>
                                   <div class="form-group"><?= form_button($btn) ?></div>
                                   <?php //}?>
                                   <div class="form-group w-d">
                                      
                                        <a class="" href="<?= base_url() . $auth ?>">ورود به پنل</a>
                                  /
                                  
                                          <a class=""
                                                     href='<?= base_url() . $create_user_url ?>'>ایجاد
                                        حساب</a>
                                  
                                    </div>
                                   <?php }else{?>
                                    <div class="form-group w-d">
                                        <label><?= $label1?></label> <?= form_input($username) ?>
                                    </div>
                                    <div class="form-group w-d">
                                        <label><?= $label2?></label> <?= form_input($password) ?>
                                    </div>
                                    <div class="form-group pr-1">
                                        <?= form_checkbox($checkbox) ?>
                                        <lable>ذخیره رمز ورود</lable>
                                    </div>
                                    <div class="form-group w-d"><?= form_button($btn) ?></div>
                                    <div class="form-group w-d">
                                        <a class="rounded-10 btn btn-block btn-info"
                                                     href='<?= base_url() . $create_user_url ?>' style="color:white;">ایجاد
                                        حساب</a>
                                    </div>
                                    <?= form_close() ?>
                                    <div class="mt-1 mb-1">
                                        <a class="" href="<?= base_url() . $forget_url ?>">فراموشی رمز عبور</a>
                                    </div>
                                <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- The image half -->
        <div class="col-md-6 my-auto col-lg-6 col-xl-6 d-none ht-100p m-0 p-0 d-md-flex bg-info">
            <div class="row wd-100p mx-auto text-center ht-100p m-0 p-0 bg-info">
                <div class="col-md-12 col-lg-12 col-xl-12 ht-100p m-0 p-0 my-auto bg-info mx-auto wd-100p">
                    <div class="card custom-card bg-info ht-100p m-0 p-0" style="border: 0!important;">
                        <div class="card-body ht-100p p-0 m-0">
                            <div class="ht-100p">
                                <div class="carousel ht-100p m-0 p-0 slide" data-ride="carousel" id="carouselExample4">

                                    <div class="carousel-fade ht-100p m-0 p-0">
                                        <?php if (!empty($slider_pic_active)) {
                                            ?>
                                            <div class="carousel-item active carousel-item-left height600">
                                                <img alt="img" class="d-block ht-xl-100p wd-md-100p m-0 p-0 wd-xl-100p"
                                                     src="<?php echo base_url();?>assets/img/slider/<?= $slider_pic_active ?>">
                                            </div>
                                            <?php if (!empty($slider_pic_one)) { ?>
                                                <div class="carousel-item carousel-item-next carousel-item-left height600">
                                                    <img alt="img"
                                                         class="d-block ht-xl-100p wd-md-100p m-0 p-0 wd-xl-100p"
                                                         src="<?php echo base_url();?>assets/img/slider/<?= $slider_pic_one ?>">
                                                </div>
                                                <?php if (!empty($slider_pic)) {
                                                    foreach ($slider_pic as $val) {
                                                        ?>
                                                        <div class="carousel-item height600">
                                                            <img alt="img"
                                                                 class="d-block ht-xl-100p wd-md-100p m-0 p-0 wd-xl-100p"
                                                                 src="<?php echo base_url();?>assets/img/slider/<?= $val ?>">
                                                        </div>
                                                    <?php }
                                                }
                                            }
                                        } else { ?>
                                            <div class="alert alert_danger text-center mx-auto" style='color:white;'>
                                                بدون عکس
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>