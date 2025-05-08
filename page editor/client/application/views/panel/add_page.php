<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/js/modal.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style type="text/css"
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
<?php
$po = (!empty($post_s) ? $post_s : '');
$sl = (!empty($slider_s) ? $slider_s : '');
$si = (!empty($side_s) ? $side_s : '');
$co = (!empty($content_s) ? $content_s : '');
$bo = (!empty($box_s) ? $box_s : '');
$al = (!empty($all_s) ? $all_s : '');
$a = form_input($title);
$g = form_input($link);
$h = form_textarea($style);
$i = form_button($btn);
?>
<!-- Internal Select2 js-->
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
<!--Internal Fileuploads js-->
<script src="<?php echo base_url(); ?>assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fileuploads/js/file-upload.js"></script>
<!--Internal Fancy uploader js-->
<script src="<?php echo base_url(); ?>assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fancyuploder/fancy-uploader.js"></script>
<!--Internal  Form-elements js-->
<script src="<?php echo base_url(); ?>assets/js/advanced-form-elements.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<!--Internal Sumoselect js-->
<script src="<?php echo base_url(); ?>assets/plugins/sumoselect/jquery.sumoselect.js"></script>
<style>
    span.file-icon > p {
        font-size: 23px !important;
    }

    .dir-ltr {
        direction: ltr !important;
    }

    .sure {
        background-color: #718d71;
        box-shadow: 2px 3px 7px #20b22c;
        margin-left: 5%;
        /*margin-right: 5%;*/
        width: 95%;
    }

    .unSure {
        background-color: #d4c73b;
        box-shadow: 2px 3px 7px #c481ab;
    }

    .del {
        background-color: #d43b3b;
        box-shadow: 2px 3px 7px mediumvioletred;
    }

    .inpBtn {
        margin-top: 3px;
        color: white;
        text-align: center;
        padding-left: 10px;
        padding-right: 10px;
        margin-right: 5px;
        border-radius: 10px;
        padding-top: 5px;
        padding-bottom: 4px;
        border: none;
        outline: none;
    }

    .inpBtn:hover, #link:hover, #title:hover {
        position: relative;
        top: 2px;
    }

    #error {
        position: absolute;
        z-index: 402;
        width: 12%;
        margin-left: 44%;
        margin-right: 44%;
        top: 222px;
        height: 44px;
        line-height: 44px;
        border-radius: 10px;
        text-align: center;
        background-color: rgba(238, 115, 115, 0.28);
        box-shadow: 2px 3px 8px #b1375f;
        color: #fc0404;
        text-shadow: 2px 2px 3px #262424;
        font-weight: bold;
        font-size: 20px;
    }

    .leaflet-popup-content-wrapper {
        background: rgba(245, 222, 179, 0.35) !important;
        font-size: 15px;
        font-weight: bold;
    }

    .dropify-wrapper.touch-fallback {
        z-index: 0 !important;
        /*height:271px !important;*/
    }

    .dropify-wrapper.has-preview {
        z-index: 0;
    }

    .dropify-wrapper:hover {
        z-index: 0 !important;
    }

    .picture-div:hover {
        opacity: 0.9;
    }

    #s_side, #s_content, #s_box, #s_post, #s_slider, #s_all {
        list-style: none;
        width: 100%;
        background-color: #507eb714;
        height: auto;
        padding: 0;
        overflow-y: auto;
        height: 55px;
    }

    .li {
        display: inline-grid;
        border-radius: 10px;
        background-color: #17adad;
        width: 48%;
        overflow:hidden;
        height: 50px;
        line-height: 50px;
        text-align: center !important;
        color: #eff1e8;
        padding: 0px 10px;
        margin: 1px 1% 0px 1%;
    }

    #s_all .li {
        display: inline-grid;
        border-radius: 10px;
        background-color: #17adad;
        width: 19%;
        overflow:hidden;
        height: 50px;
        line-height: 50px;
        text-align: center !important;
        color: #eff1e8;
        padding: 0px 10px;
        margin: 1px 0.3% 0px 0.3%;
    }

    #style {
        direction: ltr !important;
    }
</style>
<div class="container-fluid mt-5" style="min-height:480px;">
    <div class="row mt-5">
        <div class="col-lg-10 mx-auto col-md-10 my-5">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <a style="float:left;padding: 7px;color:red;" title="انصراف"
                           href="<?php echo base_url() . "page"; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                        <a style="float:left;padding: 7px;color:black;" class='' id="showBtn" style="color: #6c008052;padding-top: 1px;" title="نمایش" href="#"><i
                                    class="fa fa-desktop" aria-hidden="true"></i></a>
                        <a style="float:left;padding: 7px;color:black;" class="d-none" id="hideBtn" title="بازگشت"
                           href="#"><i class="fa fa-reply" aria-hidden="true"></i></a>

                        <?php if (isset($edit) && !empty($edit)) { ?>
                            <h3 class="pull-right txt-start">
                                ویرایش صفحه
                            </h3>
                        <?php } else { ?>
                            <h3 class="pull-right txt-start">
                                ایجاد صفحه
                            </h3>
                        <?php } ?>
                    </div>
                    <p class="mg-b-40"></p>
                    
                    <div class="pd-30 pd-sm-20 bg-gray-200 d-none" id="newhtml"></div>
                    <div class="pd-30 pd-sm-20 bg-gray-200 d-none" id="selectPic">
                        <div class='row'>
                            <input type="hidden" id="pi" value="<?= (!empty($pic)?$pic:'') ?>">
                            <div class=" col-xl-12 col-lg-12 col-md-12" id='ebnsina'>
        					<h6 style="margin-bottom:0px;">افزودن عکس</h6>
        					<p id="picErr" class="d-none text-center" style="color:red;">حتما عکسی را انتخاب کنید</p>
                            <div class="row mt-3 px-2  pt-2 mx-auto text-center" id="bit-pic" style="padding-right: 10px;padding-left:10px;width:100%;">
                        	    <div class="col-sm-12 col-md-10 mg-t-10 mg-sm-t-0 mx-auto">
            				        <form method="post" id="upload_form" align="center" enctype="multipart/form-data">
            				            <input type="file" class="dropify" id="image_file" name="image_file" data-default-file="<?php echo base_url();?>assets/img/faces/<?= (!empty($pic)?$pic:'1.png') ?>" data-height="200">
            				            <input type="submit" name="upload" id="upload" value="افزودن" class="btn btn-info-gradient btn-block mt-1" />
            				        </form>
            				        <script>
                                        $(document).ready(function (){
                                            $('#upload_form').on('submit',function(e){ 
                                                e.preventDefault();
                                                if($('#image_file').val() == ''){  
                                                    if($('#picErr').hasClass('d-none')){
                                                        $('#picErr').removeClass('d-none');
                                                    }
                                                }else{
                                                    if($('#picErr').hasClass('d-none')){}else{
                                                        $('#picErr').addClass('d-none');
                                                    }
                                                    $.ajax({  
                                                        url:"<?php echo base_url(); ?>pic/pic_logo",   
                                                        method:"POST",  
                                                        data:new FormData(this),  
                                                        contentType: false,  
                                                        cache: false,  
                                                        processData:false, 
                                                        async:false,
                                                        success:function(data){
                                                            if(data == '0'){
                                                               swal({
                                                                    title: "عملیات ناموفق",
                                                                    text: "فایل مورد نظر پسوند مجاز را ندارد",
                                                                    icon: "error",
                                                                    button: "باشه"
                                                                }) 
                                                            }else{
                                                                $('#pi').val(data);
                                                                swal({
                                                                    title: "عملیات موفق",
                                                                    text: "",
                                                                    icon: "success",
                                                                    button: "باشه"
                                                                })
                                                                if($("#selectPic").hasClass('d-none')){
                                                                }else{
                                                                    $("#selectPic").addClass('d-none');
                                                                }
                                                                if($("#oldhtml").hasClass('d-none')){
                                                                    $("#oldhtml").removeClass('d-none');
                                                                }
                                                            }
                                                        }
                                                    });  
                                                }
                                            });
                                        })
                                    </script> 
            				    </div>
            		        </div>
            			</div>
                        </div>
                    </div>
                    <div class="pd-30 pd-sm-20 bg-gray-200" id="oldhtml">
                        <?php echo form_open(); ?>
                        <?php if (isset($edit) && !empty($edit)) {
                            echo "<input value='" . $edit . "' type='hidden' id='id'>";
                        } ?>
                        <div class="row row-xs" style="line-height: 0px;height: 55px;">
                            <div class="col-md-6">
                                <label>عنوان صفحه</label>
                                <?= $a ?>
                                <br/>
                                <span class="my-2 text-danger tx-10 d-none" id="titleErr">نمیتوانید این فیلد را خالی بگذارید!</span>
                            </div>
                            <div class="col-md-6">
                                <label>آدرس صفحه</label>
                                <?= $g ?>
                                <br/>
                                <span class="my-2 text-danger tx-10 d-none" id="linkErr">نمیتوانید این فیلد را خالی بگذارید!</span>
                            </div>
                        </div>
                        <a href="#" id="selectLogo">افزودن لوگوی اصلی</a>
                        <?php if (!empty($side_html_e) || !empty($content_html_e)) {?>
                            <div class="row row-xs mt-3" id="loko" style="line-height: 0px;height: 55px;">
                        <?php }else{?>
                            <div class="row row-xs mt-3 d-none" id="loko" style="line-height: 0px;height: 55px;">
                        <?php }?>
                                <div class="col-md-6 mg-t-10 mg-md-t-0">
                                    <input type='hidden' id='side_id' value="<?php echo $si; ?>">
                                    <?php if (!empty($side_html_e)) { ?>
                                        <div class="" id='s_side'>
                                            <?php echo $side_html_e; ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="d-none" id='s_side'>
                                        </div>
                                    <?php } ?>
                                </div>
                               
                                <div class="col-md-6 mg-t-10 mg-md-t-0">
                                    <input type='hidden' id='content_id' value="<?php echo $co; ?>">
                                    <?php if (!empty($content_html_e)) { ?>
                                        <div class="" id='s_content'>
                                            <?php echo $content_html_e; ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="d-none" id='s_content'>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <div class="row row-xs mt-3" style="line-height: 0px;height: 55px;">
                            <div class="col-md-6 mg-t-10 mg-md-t-0">
                                <label>افزودن سایدبار</label>
                                <?= $d ?>
                            </div>
                            <div class="col-md-6 mg-t-10 mg-md-t-0">
                                <label>افزودن متن</label>
                                <?= $e ?>
                            </div>
                        </div>
                        <?php if(empty($edit)){?>
                            <a href="#" id="addMenu">افزودن منو</a>
                        <?php }?>
                        <?php if (!empty($box_html_e) || !empty($post_html_e) || !empty($slider_html_e)) {?>
                            <div class="row row-xs mt-3" id="lokomo" style="line-height: 0px;height: 55px;">
                        <?php }else{?>
                            <div class="row row-xs mt-3 d-none" id="lokomo" style="line-height: 0px;height: 55px;">
                        <?php }?>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type='hidden' id='box_id' value="<?php echo $bo; ?>">
                                    <?php if (!empty($box_html_e)) { ?>
                                        <div id='s_box' class="">
                                            <?php echo $box_html_e; ?>
                                        </div>
                                    <?php } else { ?>
                                        <div id='s_box' class="d-none">
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type='hidden' id="post_id" value="<?php echo $po; ?>">
                                    <?php if (!empty($post_html_e)) { ?>
                                        <div id='s_post' class="">
                                            <?php echo $post_html_e; ?>
                                        </div>
                                    <?php } else { ?>
                                        <div id='s_post' class="d-none">
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type='hidden' id='slider_id' value="<?php echo $sl; ?>">
                                    <?php if (!empty($slider_html_e)) { ?>
                                        <div id='s_slider' class="">
                                            <?php echo $slider_html_e; ?>
                                        </div>
                                    <?php } else { ?>
                                        <div id='s_slider' class="d-none">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <div class="row row-xs mt-3" style="line-height: 0px;height: 55px;">
                            <div class="col-md-4 mg-t-10 mg-md-t-0">
                                <label>افرودن جعبه</label>
                                <?= $f ?>
                            </div>
                            <div class="col-md-4 mg-t-10 mg-md-t-0">
                                <label>افزودن پست ها</label>
                                <?= $b ?>
                            </div>
                            <div class="col-md-4 mg-t-10 mg-md-t-0">
                                <label>افزودن اسلایدر</label>
                                <?= $c ?>
                            </div>
                        </div>
                        <?php if (!empty($all_html_e)) {?>
                        <div class="row row-xs my-4" id='allhtmls' style="line-height: 0px;height: 55px;">
                            <input type='hidden' value='<?php echo $al; ?>' id="all_id">
                            <p>اولویت بندی پست و اسلایدر و جعبه و متن ها</p>
                            <div class="col-md-12 mg-t-10 mg-md-t-0" id="s_all">
                                <?php echo $all_html_e; ?>
                            </div>
                            </div>
                        <?php }else{?>
                        <div class="row row-xs my-4 d-none" id='allhtmls' style="line-height: 0px;height: 55px;">
                            <input type='hidden' value='<?php echo $al; ?>' id="all_id">
                            <p>اولویت بندی پست و اسلایدر و جعبه و متن ها</p>
                            <div class="col-md-12 mg-t-10 mg-md-t-0" id="s_all">
                            </div>
                        </div>
                        <?php }?>
                        <a href='#' id="set">تنظیمات پیشرفته</a>
                        <div class="row row-xs mt-5 d-none" id="loca" style="line-height: 0px;height: 250px;">
                            <div class="col-md-12 mg-t-10 mg-md-t-0">
                                <label>استایل های صفحه</label>
                                <?= $h ?>
                            </div>
                        </div>
                        <div class="row row-xs mt-3" style="line-height: 0px;height: 55px;">
                            <div class="col-md-12 mg-t-10 mg-md-t-0 mx-auto">
                                <?= $i ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<script>
    function komeil(a, b) {
        let check_id = $(a).val().split(',');
        let id;
        var rn = 1 + Math.floor(Math.random() * 6);
        if ($.inArray(b, check_id, 2)) {
            id = b + ':' + rn;
        } else {
            id = b;
        }
        return id;
    }

    function removeParent(a, b, c, d) {
        if (d == '') {
            if ($(a).hasClass('d-none') && $(b).hasClass('d-none')) {
                if ($(c).hasClass('d-none')) {
                } else {
                    $(c).addClass('d-none');
                }
            } else {
                if ($(c).hasClass('d-none')) {
                    $(c).removeClass('d-none');
                }
            }
        } else {
            if ($(a).hasClass('d-none') && $(b).hasClass('d-none') && $(c).hasClass('d-none')) {
                if ($(d).hasClass('d-none')) {
                } else {
                    $(d).addClass('d-none');
                }
            } else {
                if ($(d).hasClass('d-none')) {
                    $(d).removeClass('d-none');
                }
            }
        }
    }

    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };
    
    function removeA(arr) {
        var what, a = arguments, L = a.length, ax;
        while (L > 1 && arr.length) {
            what = a[--L];
            while ((ax= arr.indexOf(what)) !== -1) {
                arr.splice(ax, 1);
            }
        }
        return arr;
    }

    $(document).ready(function (){
        $("#selectLogo").click(function (){
            if($("#oldhtml").hasClass('d-none')){
                
            }else{
                $("#oldhtml").addClass('d-none');
            }
            if($("#selectPic").hasClass('d-none')){
                $("#selectPic").removeClass('d-none');}
        })
    })

    //config page
    $(document).ready(function () {
        
        $('#set').click(function () {
            $(this).remove();
            if ($("#loca").hasClass('d-none')) {
                $("#loca").removeClass('d-none');
            }
        });
        
        $("#showBtn").click(function () {
            let xa = $('#all_id').val();
            let send = "send";
            $.ajax({
                url: '<?php echo base_url();?>page/show_htmls',
                method: 'POST',
                data: {xa: xa, send: send},
                success: function (x) {
                    $('#newhtml').html(x);
                    if ($("#showBtn").hasClass('d-none')) {
                    } else {
                        $("#showBtn").addClass('d-none');
                    }
                    if ($("#hideBtn").hasClass('d-none')) {
                        $("#hideBtn").removeClass('d-none');
                    }
                    if ($("#oldhtml").hasClass('d-none')) {
                    } else {
                        $("#oldhtml").addClass('d-none');
                    }
                    if ($("#newhtml").hasClass('d-none')) {
                        $("#newhtml").removeClass('d-none');
                    }
                }
            })
        });
        
        $("#hideBtn").click(function () {
            $('#post').val('none');
            $('#side').val('none');
            $('#slider').val('none');
            $('#box').val('none');
            $('#content').val('none');
            if ($("#hideBtn").hasClass('d-none')) {
            } else {
                $("#hideBtn").addClass('d-none');
            }
            if ($("#showBtn").hasClass('d-none')) {
                $("#showBtn").removeClass('d-none');
            }
            if ($("#newhtml").hasClass('d-none')) {
            } else {
                $("#newhtml").addClass('d-none');
            }
            $("#newhtml").html('');
            if ($("#oldhtml").hasClass('d-none')) {
                $("#oldhtml").removeClass('d-none');
            }
        });
    });
    //end of config page

    //menu
    $(document).ready(function(){
        $("#addMenu").click(function(){
            $("#newhtml").html('');
            let se = "se";
            $.ajax({
                url: '<?php echo base_url();?>page/add_menu',
                method: 'POST',
                data: {se: se},
                success: function (x) {
                    $('#newhtml').html(x);
                    if ($("#newhtml").hasClass('d-none')) {
                        $("#newhtml").removeClass('d-none');
                    }
                    if ($("#oldhtml").hasClass('d-none')) {
                        } else {
                        $("#oldhtml").addClass('d-none');
                    }
                    if ($("#hideBtn").hasClass('d-none')) {
                        $("#hideBtn").removeClass('d-none');
                    }
                    if ($("#showBtn").hasClass('d-none')) {
                    } else {
                        $("#showBtn").addClass('d-none');
                    }
                }
            })
        })
    })
    //end of menu

    //set posts
    $(document).ready(function () {
        //add post
        $('#post').on('change', function () {
            if ($(this).val() == 0) {
                $("#newhtml").html('');
                let se = "se";
                $.ajax({
                    url: '<?php echo base_url();?>page/add_post',
                    method: 'POST',
                    data: {se: se},
                    success: function (x) {
                        $('#newhtml').html(x);
                        if ($("#newhtml").hasClass('d-none')) {
                            $("#newhtml").removeClass('d-none');
                        }
                        if ($("#oldhtml").hasClass('d-none')) {
                        } else {
                            $("#oldhtml").addClass('d-none');
                        }
                        if ($("#hideBtn").hasClass('d-none')) {
                            $("#hideBtn").removeClass('d-none');
                        }
                        if ($("#showBtn").hasClass('d-none')) {
                        } else {
                            $("#showBtn").addClass('d-none');
                        }
                    }
                })
            } else {
                if ($('#lokomo').hasClass('d-none')) {
                    $('#lokomo').removeClass('d-none');
                }
                if ($('#allhtmls').hasClass('d-none')) {
                    $('#allhtmls').removeClass('d-none');
                }

                let id = komeil("#post_id", $(this).val());


                $('#post_id').val($('#post_id').val() + ',' + id);


                if ($('#s_post').hasClass('d-none')) {
                    $('#s_post').removeClass('d-none');
                }
                $('#s_post').html($('#s_post').html() + '<div class="li">' + $('#post option:selected').text() + '<input type="hidden" value="' + id + '"></div>');
                $('#s_all').html($('#s_all').html() + '<div class="li">' + $('#post option:selected').text() + '<input type="hidden" class="dani" value="post:' + id + '"></div>');

                $('#all_id').val($('#all_id').val() + ',post:' + id);
                let ul = $('#s_post');
                ul.children().each(function (i, div) {
                    ul.prepend(div);
                })
                $(this).val('none');
            }
        });
        //end of add post
        //remove post
        $('#s_post').on('click', '.li', function () {
            rmid = $(this).children('input').val();
            ids = $('#post_id').val().split(',');
            allrmid = 'post:' + rmid;
            $('#s_all :input[value="' + allrmid + '"]').parent().remove();
            if ($('#s_all').children().length == 0) {
                if ($('#allhtmls').hasClass('d-none')) {

                } else {
                    $('#allhtmls').addClass('d-none');
                }
            }
            all = $('#all_id').val().split(',');
            for (j = 1; j <= all.length; j++) {
                if (allrmid == all[j]) {
                    all = $.grep(all, function (value) {
                        return value != allrmid;
                    });
                }
            }
             removeA(all,allrmid);
            all.remove(allrmid);
            $('#all_id').val(all.join(','));
            
            for (i = 1; i <= ids.length; i++) {
                if (rmid == ids[i]) {
                    ids = $.grep(ids, function (value) {
                        return value != rmid;
                    });
                }
            }  
            removeA(ids,rmid);
            ids.remove(rmid);
            $('#post_id').val(ids.join(','));
         
            $(this).remove();
            if ($('#s_post').children().length == 0) {
                if ($('#s_post').hasClass('d-none')) {

                } else {
                    $('#s_post').addClass('d-none');
                }
                removeParent('#s_box', '#s_post', '#s_slider', '#lokomo');
            }
        });
        //end of remove post
    });
    //end of set posts

    //set sliders
    $(document).ready(function(){ 
        //add slider
        $('#slider').on('change',function(){
             if ($(this).val() == 0) {
                $("#newhtml").html('');
                let se = "se";
                $.ajax({
                    url: '<?php echo base_url();?>page/add_slider',
                    method: 'POST',
                    data: {se: se},
                    success: function (x) {
                        $('#newhtml').html(x);
                        if ($("#newhtml").hasClass('d-none')) {
                            $("#newhtml").removeClass('d-none');
                        }
                        if ($("#oldhtml").hasClass('d-none')) {
                        } else {
                            $("#oldhtml").addClass('d-none');
                        }
                        if ($("#hideBtn").hasClass('d-none')) {
                            $("#hideBtn").removeClass('d-none');
                        }
                        if ($("#showBtn").hasClass('d-none')) {
                        } else {
                            $("#showBtn").addClass('d-none');
                        }
                    }
                })
            } else {
                if($('#lokomo').hasClass('d-none')){
                    $('#lokomo').removeClass('d-none');
                }
                if($('#allhtmls').hasClass('d-none')){
                    $('#allhtmls').removeClass('d-none');
                }
    
                let id = komeil("#slider_id",$(this).val());
    
                $('#slider_id').val($('#slider_id').val()+','+id);
                if($('#s_slider').hasClass('d-none')){
                  $('#s_slider').removeClass('d-none');         
                }
                $('#s_slider').html($('#s_slider').html()+'<div class="li">'+$('#slider option:selected').text()+'<input type="hidden" value="'+id+'"></div>');
                $('#s_all').html($('#s_all').html()+'<div class="li">'+$('#slider option:selected').text()+'<input type="hidden" class="dani" value="slider:'+id+'"></div>');
                $('#all_id').val($('#all_id').val()+',slider:'+id);
                let ul=$('#s_slider');
                ul.children().each(function(i,div){ul.prepend(div)})
                $(this).val('none');
            }
        });
        //end of add slider
        //remove slider
        $('#s_slider').on('click','.li',function(){
            rmid=$(this).children('input').val();
            ids=$('#slider_id').val().split(',');
            allrmid='slider:'+rmid;
            $('#s_all :input[value="'+allrmid+'"]').parent().remove();
            if ( $('#s_all').children().length == 0 ) {
                if($('#allhtmls').hasClass('d-none')){

                }else{
                    $('#allhtmls').addClass('d-none');
                }
            }
            all=$('#all_id').val().split(',');
            for(j=1;j<=all.length;j++){
                if(allrmid==all[j]){
                    all = jQuery.grep(all, function(value) {
                        return value != allrmid;
                    });
                }
            }
            removeA(all,allrmid);
            all.remove(allrmid);
            $('#all_id').val(all.join(','));
            for(i=1;i<=ids.length;i++){
                if(rmid==ids[i]){
                    ids = jQuery.grep(ids, function(value) {
                        return value != rmid;
                    });
                }
            }
           
            removeA(ids,rmid);
            ids.remove(rmid);
            $('#slider_id').val(ids.join(','));
            
            $(this).remove();
            if ( $('#s_slider').children().length == 0 ) {
                if($('#s_slider').hasClass('d-none')){

                }else{
                    $('#s_slider').addClass('d-none');
                }
                removeParent('#s_box','#s_post','#s_slider','#lokomo');
            }
        });
        //end of remove slider
    });    
    //end of set sliders

    //set boxs
    $(document).ready(function(){    
        //add box
        $('#box').on('change',function(){
             if ($(this).val() == 0) {
                $("#newhtml").html('');
                let se = "se";
                $.ajax({
                    url: '<?php echo base_url();?>page/add_box',
                    method: 'POST',
                    data: {se: se},
                    success: function (x) {
                        $('#newhtml').html(x);
                        if ($("#newhtml").hasClass('d-none')) {
                            $("#newhtml").removeClass('d-none');
                        }
                        if ($("#oldhtml").hasClass('d-none')) {
                        } else {
                            $("#oldhtml").addClass('d-none');
                        }
                        if ($("#hideBtn").hasClass('d-none')) {
                            $("#hideBtn").removeClass('d-none');
                        }
                        if ($("#showBtn").hasClass('d-none')) {
                        } else {
                            $("#showBtn").addClass('d-none');
                        }
                    }
                })
            } else {
                if($('#lokomo').hasClass('d-none')){
                    $('#lokomo').removeClass('d-none');
                }
                if($('#allhtmls').hasClass('d-none')){
                    $('#allhtmls').removeClass('d-none');
                }
                let id = komeil("#box_id", $(this).val());
                $('#box_id').val($('#box_id').val()+','+id);
                if($('#s_box').hasClass('d-none')){
                  $('#s_box').removeClass('d-none');         
                }
                $('#s_box').html($('#s_box').html()+'<div class="li">'+$('#box option:selected').text()+'<input type="hidden" value="'+id+'"></div>');
    
                $('#s_all').html($('#s_all').html()+'<div class="li">'+$('#box option:selected').text()+'<input type="hidden" class="dani" value="box:'+id+'"></div>');
                $('#all_id').val($('#all_id').val()+',box:'+id);
    
                let ul=$('#s_box');
                ul.children().each(function(i,div){ul.prepend(div)})
                $(this).val('none');
            }
        });
        //end of add box
        //remove box
        $('#s_box').on('click','.li',function(){
            rmid=$(this).children('input').val();
            ids=$('#box_id').val().split(',');
            allrmid='box:'+rmid;
            $('#s_all :input[value="'+allrmid+'"]').parent().remove();
            if ( $('#s_all').children().length == 0 ) {
                if($('#allhtmls').hasClass('d-none')){

                }else{
                    $('#allhtmls').addClass('d-none');
                }
            }
            all=$('#all_id').val().split(',');
            for(j=1;j<=all.length;j++){
                if(allrmid==all[j]){
                    all = jQuery.grep(all, function(value) {
                        return value != allrmid;
                    });
                }
            }
            removeA(all,allrmid);
            all.remove(allrmid);
            $('#all_id').val(all.join(','));
            for(i=1;i<=ids.length;i++){
                if(rmid==ids[i]){
                    ids = jQuery.grep(ids, function(value) {
                        return value != rmid;
                    });
                }
            }
           
            removeA(ids,rmid);
            ids.remove(rmid);
            
            $('#box_id').val(ids.join(','));
            $(this).remove();
            if ( $('#s_box').children().length == 0 ) {
                if($('#s_box').hasClass('d-none')){

                }else{
                    $('#s_box').addClass('d-none');
                }
                removeParent('#s_box','#s_post','#s_slider','#lokomo');
            }
        });
        //end of remove box
    });
    //end of set boxs

    //set sides
    $(document).ready(function(){    
        //add side
        $('#side').on('change',function(){
             if ($(this).val() == 0) {
                $("#newhtml").html('');
                let se = "se";
                $.ajax({
                    url: '<?php echo base_url();?>page/add_side',
                    method: 'POST',
                    data: {se: se},
                    success: function (x) {
                        $('#newhtml').html(x);
                        if ($("#newhtml").hasClass('d-none')) {
                            $("#newhtml").removeClass('d-none');
                        }
                        if ($("#oldhtml").hasClass('d-none')) {
                        } else {
                            $("#oldhtml").addClass('d-none');
                        }
                        if ($("#hideBtn").hasClass('d-none')) {
                            $("#hideBtn").removeClass('d-none');
                        }
                        if ($("#showBtn").hasClass('d-none')) {
                        } else {
                            $("#showBtn").addClass('d-none');
                        }
                    }
                })
            } else {
                if($('#loko').hasClass('d-none')){
                    $('#loko').removeClass('d-none');
                }
                if($('#allhtmls').hasClass('d-none')){
                    $('#allhtmls').removeClass('d-none');
                }
                let id=komeil('#side_id',$(this).val())
                $('#side_id').val($('#side_id').val()+','+id);
                if($('#s_side').hasClass('d-none')){
                  $('#s_side').removeClass('d-none');         
                }
    
                $('#s_side').html($('#s_side').html()+'<div class="li">'+$('#side option:selected').text()+'<input type="hidden" value="'+id+'"></div>');
    
                $('#s_all').html($('#s_all').html()+'<div class="li">'+$('#side option:selected').text()+'<input type="hidden" class="dani" value="side:'+id+'"></div>');
                $('#all_id').val($('#all_id').val()+',side:'+id);
    
                let ul=$('#s_side');
                ul.children().each(function(i,div){ul.prepend(div)})
                $(this).val('none');
            }
        });
        //end of add side
        //remove side
        $('#s_side').on('click','.li',function(){
            rmid=$(this).children('input').val();
            ids=$('#side_id').val().split(',');
            allrmid='side:'+rmid;
            $('#s_all :input[value="'+allrmid+'"]').parent().remove();
            if ( $('#s_all').children().length == 0 ) {
                if($('#allhtmls').hasClass('d-none')){

                }else{
                    $('#allhtmls').addClass('d-none');
                }
            }
            all=$('#all_id').val().split(',');
            for(j=1;j<=all.length;j++){
                if(allrmid==all[j]){
                    all = jQuery.grep(all, function(value) {
                        return value != allrmid;
                    });
                }
            }
            removeA(all,allrmid);
            all.remove(allrmid);
           
            $('#all_id').val(all.join(','));
            for(i=1;i<=ids.length;i++){
                if(rmid==ids[i]){
                    ids = jQuery.grep(ids, function(value) {
                        return value != rmid;
                    });
                }
            }
            removeA(ids,rmid);
            ids.remove(rmid);
            $('#side_id').val(ids.join(','));
            $(this).remove();
            if ( $('#s_side').children().length == 0 ) {
                if($('#s_side').hasClass('d-none')){

                }else{
                    $('#s_side').addClass('d-none');
                }
                removeParent('#s_side','#s_content','#loko','')
            }
        });
        //end of remove side
    });         
    //end of set sides

    //set content
    $(document).ready(function(){    
        //add content
        $('#contentS').on('change',function(){
            if ($(this).val() == 0) {
            
                $("#newhtml").html('');
                let se = "se";
                
                $.ajax({
                    url: '<?php echo base_url();?>page/add_con',
                    method: 'POST',
                    data: {se: se},
                    success: function (x) {
                        $('#newhtml').html(x);
                        if ($("#newhtml").hasClass('d-none')) {
                            $("#newhtml").removeClass('d-none');
                        }
                        if ($("#oldhtml").hasClass('d-none')) {
                        } else {
                            $("#oldhtml").addClass('d-none');
                        }
                        if ($("#hideBtn").hasClass('d-none')) {
                            $("#hideBtn").removeClass('d-none');
                        }
                        if ($("#showBtn").hasClass('d-none')) {
                        } else {
                            $("#showBtn").addClass('d-none');
                        }
                    }
                })
            
            } else {
                if($('#loko').hasClass('d-none')){
                    $('#loko').removeClass('d-none');
                }
                if($('#allhtmls').hasClass('d-none')){
                    $('#allhtmls').removeClass('d-none');
                }
                let id = komeil("#content_id", $(this).val());
                $('#content_id').val($('#content_id').val()+','+id);
                if($('#s_content').hasClass('d-none')){
                  $('#s_content').removeClass('d-none');         
                }
                $('#s_content').html($('#s_content').html()+'<div class="li">'+$('#content option:selected').text()+'<input type="hidden" value="'+id+'"></div>');
                $('#s_all').html($('#s_all').html()+'<div class="li">'+$('#content option:selected').text()+'<input type="hidden" class="dani" value="content:'+id+'"></div>');
                $('#all_id').val($('#all_id').val()+',content:'+id);
    
    
                let ul=$('#s_content');
                ul.children().each(function(i,div){ul.prepend(div)})
                $(this).val('none');
            }
        });
        //end of add content
        //remove content
        $('#s_content').on('click','.li',function(){
            rmid=$(this).children('input').val();
            ids=$('#content_id').val().split(',');
            allrmid='content:'+rmid;
            $('#s_all :input[value="'+allrmid+'"]').parent().remove();
            if ( $('#s_all').children().length == 0 ) {
                if($('#allhtmls').hasClass('d-none')){

                }else{
                    $('#allhtmls').addClass('d-none');
                }
            }
            all=$('#all_id').val().split(',');
            for(j=1;j<=all.length;j++){
                if(allrmid==all[j]){
                    all = jQuery.grep(all, function(value) {
                        return value != allrmid;
                    });
                }
            }
            removeA(all,allrmid);
            all.remove(allrmid);
            $('#all_id').val(all.join(','));
            for(i=1;i<=ids.length;i++){
                if(rmid==ids[i]){
                    ids = jQuery.grep(ids, function(value) {
                        return value != rmid;
                    });
                }
            }
           
            removeA(ids,rmid);
            ids.remove(rmid);
            $('#content_id').val(ids.join(','));
            $(this).remove();
            if ( $('#s_content').children().length == 0 ) {
                if($('#s_content').hasClass('d-none')){

                }else{
                    $('#s_content').addClass('d-none');
                }
                removeParent('#s_side','#s_content','#loko','')
            }
        });
        //end of remove content
    });
    //end of set contents

    //send data
    $(document).ready(function () {
        $("#send").click(function () {
            let title = $("#title").val();
            let link = $("#link").val();
            if (title == '') {
                $("#title").css({"border": "1px solid red"});
                if ($("#titleErr").hasClass('d-none')) {
                    $("#titleErr").removeClass("d-none").addClass("d-block");
                }
            } else {
                if ($("#titleErr").hasClass('d-none')) {
                } else {
                    $("#titleErr").addClass("d-none").removeClass("d-block");
                }
                $("#title").css({"border": "1px solid green"});
            }
            if (link == '') {
                $("#link").css({"border": "1px solid red"});
                if ($("#linkErr").hasClass('d-none')) {
                    $("#linkErr").removeClass("d-none").addClass("d-block");
                }
            } else {
                if ($("#linkErr").hasClass('d-none')) {
                } else {
                    $("#linkErr").addClass("d-none").removeClass("d-block");
                }
                $("#link").css({"border": "1px solid green"});
            }
            if (title != '' && link != '') {
                let s = "s";
                let logo=$("#pi").val();
                let title = $("#title").val();
                let cssS = $("#style").val();
                let link = $('#link').val();
                let all = $('#all_id').val();
                <?php if(!empty($edit) && is_numeric($edit)){?>
                let id = '<?php echo $edit;?>';
                $.ajax({
                    url: '<?php echo base_url();?>page/check_edit',
                    method: 'POST',
                    data: {logo:logo,all: all, link: link, s: s, title: title, cssS: cssS, id: id},
                    success: function (x) {
                        $('body').html(x)
                        if (x == 1) {
                            swal({
                                title: "عملیات موفق",
                                text: "صفحه ی مورد نظر ویرایش شد",
                                icon: "success",
                                button: "متوجه شدم"
                            }).then(function () {
                                window.location.replace("<?php echo base_url();?>page");
                            });
                        } if (x == 0) {
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function () {
                                window.location.replace("<?php echo base_url();?>page/edit/" + id);
                            });
                        }
                    }
                });
                <?php }else{?>
                $.ajax({
                    url: '<?php echo base_url();?>page/check_add',
                    method: 'POST',
                    data: {logo:logo,all: all, link: link, s: s, title: title, cssS: cssS},
                    success: function (x) {
                        if (x == 1) {
                            swal({
                                title: "عملیات موفق",
                                text: "صفحه ی مورد نظر ساخته شد",
                                icon: "success",
                                button: "متوجه شدم"
                            }).then(function () {
                                window.location.replace("<?php echo base_url();?>page");
                            });
                        } else {
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function () {
                                window.location.replace("<?php echo base_url();?>page/add");
                            });
                        }
                    }
                });
                <?php }?>
            }
        });
    });
    //end of send data
</script>
<script src="<?php echo base_url();?>assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pickerjs/picker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/file-upload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/fancy-uploader.js"></script>