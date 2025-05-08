<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?php echo base_url();?>assets/js/modal.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style type="text/css" id="s./node_modules/css-loader/index.js!./node_modules/sass-loader/lib/loader.js!./package/src/animation.scss-0">/**
 * @license
 * Copyright Akveo. All Rights Reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 */
.eva-animation {
  animation-duration: 1s;
  animation-fill-mode: both; }

.eva-infinite {
  animation-iteration-count: infinite; }

.eva-icon-shake {
  animation-name: eva-shake; }

.eva-icon-zoom {
  animation-name: eva-zoomIn; }

.eva-icon-pulse {
  animation-name: eva-pulse; }

.eva-icon-flip {
  animation-name: eva-flipInY; }

.eva-hover {
  display: inline-block; }

.eva-hover:hover .eva-icon-hover-shake, .eva-parent-hover:hover .eva-icon-hover-shake {
  animation-name: eva-shake; }

.eva-hover:hover .eva-icon-hover-zoom, .eva-parent-hover:hover .eva-icon-hover-zoom {
  animation-name: eva-zoomIn; }

.eva-hover:hover .eva-icon-hover-pulse, .eva-parent-hover:hover .eva-icon-hover-pulse {
  animation-name: eva-pulse; }

.eva-hover:hover .eva-icon-hover-flip, .eva-parent-hover:hover .eva-icon-hover-flip {
  animation-name: eva-flipInY; }

@keyframes eva-flipInY {
  from {
    transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
    animation-timing-function: ease-in;
    opacity: 0; }
  40% {
    transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
    animation-timing-function: ease-in; }
  60% {
    transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
    opacity: 1; }
  80% {
    transform: perspective(400px) rotate3d(0, 1, 0, -5deg); }
  to {
    transform: perspective(400px); } }

@keyframes eva-shake {
  from,
  to {
    transform: translate3d(0, 0, 0); }
  10%,
  30%,
  50%,
  70%,
  90% {
    transform: translate3d(-3px, 0, 0); }
  20%,
  40%,
  60%,
  80% {
    transform: translate3d(3px, 0, 0); } }

@keyframes eva-pulse {
  from {
    transform: scale3d(1, 1, 1); }
  50% {
    transform: scale3d(1.2, 1.2, 1.2); }
  to {
    transform: scale3d(1, 1, 1); } }

@keyframes eva-zoomIn {
  from {
    opacity: 1;
    transform: scale3d(0.5, 0.5, 0.5); }
  50% {
    opacity: 1; } }
</style>
<?php $_SESSION['mark_num']=(isset($_SESSION['mark_num'])&&!empty($_SESSION['mark_num'])?$_SESSION['mark_num']:0);?>
<!-- Internal Select2 js-->
<script src="<?php echo base_url();?>assets/plugins/select2/js/select2.min.js"></script>
<!--Internal Fileuploads js-->
<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/file-upload.js"></script>
<!--Internal Fancy uploader js-->
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/fancy-uploader.js"></script>
<!--Internal  Form-elements js-->
<script src="<?php echo base_url();?>assets/js/advanced-form-elements.js"></script>
<script src="<?php echo base_url();?>assets/js/select2.js"></script>
<!--Internal Sumoselect js-->
<script src="<?php echo base_url();?>assets/plugins/sumoselect/jquery.sumoselect.js"></script>
<style>
    #co,#coa{
        direction:ltr !important;
    }
    span.file-icon>p{
        font-size:23px !important;
    }
    #titleMp {
		background-color: #284068;
		color: white;
		width: 90%;
		margin-left: 5%;
		margin-right: 5%;
		border-radius: 10px;
		padding: 7px;
		box-shadow: 2px 3px 7px #84842e;
		margin-bottom: 5px;
	}

	#titleMp::placeholder {
		color: lightgrey;
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

	.inpBtn:hover, #title:hover {
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
	.dropify-wrapper.has-preview{
	    z-index:0;
	}
	.dropify-wrapper:hover {
	    z-index:0 !important;
	}
	
	.picture-div:hover{
	    opacity:0.9;
	}
	label{
	    direction:rtl !important;
	}
</style>
<div class="container-fluid mt-5" style="min-height:480px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 my-5">
			<div class="card">
    			<div class="card-body">
					<div class="main-content-label mg-b-5">

					<h3 class="pull-right txt-start">
						ایجاد ساید بار 
					</h3>
					</div>
				
					<p class="mg-b-20">در این بخش شما می توانید به آسانی در هر قسمت از صفحه ی خود فضایی به وجود آورید و بر اساس اولویت آنها را مرتب کنید و داخل آن منو های مورد نظر خود را وارد کنید</p>
				
					<div class="pd-30 pd-sm-20 bg-gray-200">
						<?php echo form_open();?>
						    <input type="hidden" id="mapPlaceNum" value='<?= (!empty($map)?$map:'') ?>'>
							<div class="row row-xs" style="line-height: 0px;height: 55px;">
								<div class="col-md-6">
								    <label>عنوان سایدبار</label>
									<?= form_input($t) ?>
									<br/>
									<span class="mt-2 text-danger tx-10 d-none" id="titleErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
								<div class="col-md-3 mg-t-10 mg-md-t-0">
								    <label>محل مورد نظر</label>
									<?= $p ?>
								</div>

								<div class="col-md-3 mg-t-10 mg-md-t-0">
								    <label>اضافه کردن بخش ها</label>
									<?= $add ?>
						        </div>
							</div>
							<div class="row row-xs mt-3 d-none" id="cssBox" style="line-height: 0px;height: 55px;">
								<div class="col-md-12 mg-t-10 mg-md-t-0">
								    <label>css دلخواه</label>
									<?= form_textarea($css) ?>
								</div>
							</div>
							<a href='#' id="set">تنظیمات پیشرفته</a>
							<div class="row row-xs mt-3 d-none" id="htmls" style="line-height: 0px;height: 55px;">
								<div class="col-md-4 mg-t-10 mg-md-t-0">
								    <label>دکمه ی سایدبار</label>
									<?= form_textarea($btn) ?>
								</div>
								<div class="col-md-4 mg-t-10 mg-md-t-0">
								    <label>html ها را ببندید</label>
									<?= form_textarea($he) ?>
								</div>
								<div class="col-md-4 mg-t-10 mg-md-t-0">
								    <label>html قبل سایدبار</label>
									<?= form_textarea($hs) ?>
								</div>
							</div>
							<div class="row row-xs mt-3 d-none" id="smap" style="line-height: 0px;height: 250px;">
								<input type="hidden" id="latLng" name="latLng">
				                <div id="error" style="display:none">پاک شد</div>
								<div class="col-md-6 mx-auto mg-t-10 mg-md-t-0" style="z-index:0" id="map">
								</div>
						    </div>
							<div class="row row-xs mt-3" style="line-height: 0px;height: 55px;">	
								<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <a href="#" id="sendSide" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button">افزودن</a>
        						</div>
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        							<a href="#" id='back' class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
        						</div>
							</div>
					    <?php echo form_close();?>
					</div>
				</div>
			</div>
		</div>        
    </div>
</div>

<script>
    let ln, marker, lt, map, popup, x, title, i, marks, mark, z;
    
    // start map
    
    function onMapClick(e) {
		map.addLayer(marker);
	}

	function f(x, y) {
		return '<label style="margin-left: 25%;margin-bottom: 5px" for="titleMp">عنوان مکان</label>' +
			'<input type="text" id="titleMp" placeholder="عنوانی را وارد کنید">' +
			'<button type="button" onclick="s(' + x + ',' + y +')" class="sure inpBtn">درسته</button>';
	}

	function g(x, y) {
		return '<div><button class="inpBtn del" onclick="del(' + x + ',' + y+');" type="button">پاک شود</button></div>';
	}

	function s(lti, lng) {
		lt = parseFloat(lti);
		ln = parseFloat(lng);
		title = $("#titleMp").val();
		marker = new L.marker({lon: ln,lat: lt}).bindPopup(title + g(ln, lt)).addTo(map);
		ln = lt = 0;
		map.closePopup();
		$.ajax({
			method: 'post',
			url: '<?php echo base_url()?>map/add_mark',
			data: {lt: lti, ln: lng, title: title},
			success: function (ha) {
			    if(ha==0){
			        alert('error');
			    }else{
			        $('#mapPlaceNum').val($('#mapPlaceNum').val()+','+ha);
			    }
			},
			error:function(){
			}
		})
	}

	function del(ln, lt) {
	    let idMaps=$('#mapPlaceNum').val();
		$.ajax({
			method: 'post',
			url: '<?php echo base_url()?>map/del_mark',
			data: {lt: lt, ln: ln,idMaps:idMaps},
			success: function (viii) {
				if (viii === 0) {
				      alert('error delete');
				}else{
				    $('#mapPlaceNum').val(viii);
					if(map.removeLayer(marker)){
    					$("#error").show();
    					function h() {
    						$("#error").hide();
    					}
    					setTimeout(h, 3000);
					}
					maryan();
				  
				}
			}
		});
	}

	function j() {
	    let aha="<?php echo (!empty($edit)?$edit:'ha');?>";
		$.ajax({
			method: 'post',
			data:{aha:aha},
			url: '<?php echo base_url()?>map/check_marks',
			success: function (value) {
				if (value) {
					marks = value.split(',');
					for (i = 0; i <= marks.length; i++) {
						mark = marks[i].split('|');
						L.marker({lon: parseFloat(mark[0]), lat:parseFloat(mark[1])}).bindPopup(mark[2]+ g(parseFloat(mark[0]), parseFloat(mark[1]))).addTo(map);
					}
				} 
				else {	
				    function f(x, y) {
		                return '<label style="margin-left: 25%;margin-bottom: 5px" for="titleMp">عنوان مکان</label>' +'<input type="text" id="titleMp" placeholder="عنوانی وارد کنید">' +'<button type="button" onclick="s(' + x + ',' + y + ')" class="sure inpBtn">im sure</button>';
	                }
				}
			}
		})
	}

    function maryan () {
		map = L.map('map').setView({lon: 50.615054368972785 , lat: 35.955950233885645}, 13);
		j();
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
		}).addTo(map);
		L.control.scale({imperial: true, metric: true}).addTo(map);
		popup = L.popup();
		map.on('click', function (e) {
			popup.setLatLng(e.latlng).setContent(f(e.latlng.lat, e.latlng.lng)).openOn(map);
	    });
	}
	
    $(document).ready(function (){
    	map = L.map('map').setView({lon: 50.615054368972785 , lat: 35.955950233885645}, 13);
		j();
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
		}).addTo(map);
		L.control.scale({imperial: true, metric: true}).addTo(map);
		popup = L.popup();
		map.on('click', function (e) {
			popup.setLatLng(e.latlng).setContent(f(e.latlng.lat, e.latlng.lng)).openOn(map);
	    });
    })
    
    // end map
    // start config this page

    $(document).ready(function(){
        $('#set').click(function (){
            $(this).remove();
            if($('#htmls').hasClass('d-none')){
                $('#htmls').removeClass('d-none');
            }
        })
        // if($('#cssBox').hasClass('d-none')){}else{$("#cssBox").addClass('d-none')}
        if($("#add option:last-child").hasClass('d-none')){}else{$("#add option:last-child").addClass('d-none');}
        if($("#smap").hasClass('d-none')){}else{$("#smap").addClass('d-none');}
        $('#place').on('change',function(){
            if($(this).val()=='top' || $(this).val()=='right' || $(this).val()=='left'){
                if($("#add option:last-child").hasClass('d-none')){}else{$("#add option:last-child").addClass('d-none');}
                if($("#smap").hasClass('d-none')){}else{$("#smap").addClass('d-none');}
                $("#add").val('1');
            }
            if($(this).val()=='foot'){
                if($("#add option:last-child").hasClass('d-none')){
                    $("#add option:last-child").removeClass('d-none');
                }
                $("#add").val('1');
            }
        })
        $("#add").on('change',function(){
            if($(this).val()==3){
                if($("cssBox").hasClass('d-none')){}else{$("cssBox").addClass('d-none');}
                if($("#smap").hasClass('d-none')){$('#smap').removeClass('d-none');}
            }
            if($(this).val()==2){
                if($("#cssBox").hasClass('d-none')){$('#cssBox').removeClass('d-none');}
                if($("#smap").hasClass('d-none')){}else{$("#smap").addClass('d-none');}
            }
            if($(this).val()==1){
                if($("#cssBox").hasClass('d-none')){}else{$("#cssBox").addClass('d-none');}
                if($("#smap").hasClass('d-none')){}else{$("#smap").addClass('d-none');}
                let send="ok";
                let m=$('#mapPlaceNum').val();
                if(m != ''){
                    $.ajax({
                        method:'post',
                        url:"<?php echo base_url();?>sidebars/del_map",
                        data:{send:send,m:m},
                        success:function (values){
                            if(values == 1){
                                $('#mapPlaceNum').val('');
                            }else{
                                alert('error delete markers')
                            }
                        }
                    })
                }
                $('#css').val('');
            }
        });
    })

    //end config this page
    // start send data for insert and update
    
    $(document).ready(function (){
        $("#back").click(function () {
            if ($("#newhtml").hasClass('d-none')) {
            } else {
                $("#newhtml").addClass('d-none');
            }
            $("#newhtml").html('');
            if ($("#oldhtml").hasClass('d-none')) {
                $("#oldhtml").removeClass('d-none');
            }
            if($("#hideBtn").hasClass('d-none')){}else{$("#hideBtn").addClass('d-none');}
            if($("#showBtn").hasClass('d-none')){$("#showBtn").removeClass('d-none');}
            $('#side').val('none');
        });
        $("#sendSide").click(function(){
            let title = $("#title").val();
            let place =$("#place").val();
            let map = $('#mapPlaceNum').val();
            let css = $('#css').val();
            let customHtml=$("#custom_html").val();
            let endCustomHtml=$("#custom_html_end").val();
            let sideBtn=$("#sideBtn").val();
            let send="ok";
            if(title==''){
                $("#title").css({"border":"1px solid red"});
                $("#titleErr").removeClass("d-none");
                $("#titleErr").addClass("d-block");
            }else{
                $("#titleErr").removeClass("d-block");
                $("#titleErr").addClass("d-none");
                $("#title").css({"border":"1px solid green"});  
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>sidebars/check_add_side",
                    data:{sideBtn:sideBtn,map:map,title : title , place : place , customHtml : customHtml , endCustomHtml : endCustomHtml , send : send ,css:css},
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            })
                        }else{
                            $.ajax({
                                method:'post',
                                url:"<?php echo base_url();?>sidebars/mark_side",
                                data:{values:values,send:send,map:map},
                                success:function (y){
                                    if(y==0){
                                        swal({
                                            title: "خطا",
                                            text: "",
                                            icon: "error",
                                            button: "متوجه شدم"
                                        });
                                    }
                                    if(y==1){
                                        swal({
                                            title: "عملیات موفق",
                                            text: "سایدبار جدید اضافه شد",
                                            icon: "success",
                                            button: "ادامه"
                                        });
                                        $.ajax({
                                            method:'post',
                                            url:"<?php echo base_url();?>page/side_new",
                                            data:{send:send,y:y},
                                            success:function (x){
                                                $('#side').html(x);
                                                if ($("#newhtml").hasClass('d-none')) {
                                                } else {
                                                    $("#newhtml").addClass('d-none');
                                                }
                                                $("#newhtml").html('');
                                                if ($("#oldhtml").hasClass('d-none')) {
                                                    $("#oldhtml").removeClass('d-none');
                                                }
                                            }
                                        })
                                        $('#side').val('none');
                                    }
                                }
                            })
                        }
                        
                    }
                    ,error:function(){
                        alert('errrrr')
                    }
                })
            }
        })
    })
</script>