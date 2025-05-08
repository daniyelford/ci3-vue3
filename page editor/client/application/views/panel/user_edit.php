<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .picture-div:hover{
	    opacity:0.9;
	}
	.preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 2.5% !important;
    }
    #pic_select{
        box-shadow: 8px 8px 800px #9b9b9b;
        max-height: 100px !important;
        overflow-y: auto !important;
        background-color: #3c2b2b2e;
    }
</style>     
<div class='my-5 container fluid' style="min-height:480px;">   
    <div class='row row-sm'>
        <input type="hidden" id="pi" value="<?php echo (empty($pic)?'':$pic); ?>" />
	    <div class="col-xl-12 my-5">
    		<div class="card">
    			<div class="card-body h-100">
        			<div class="row row-sm ">
        				<div class=" col-xl-5 col-lg-12 col-md-12" id='ebnsina'>
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
                                                        url:"<?php echo base_url(); ?>pic/pic_upload_user",   
                                                        method:"POST",  
                                                        data:new FormData(this),  
                                                        contentType: false,  
                                                        cache: false,  
                                                        processData:false, 
                                                        async:false,
                                                        success:function(data){
                                                            $('#pi').val(data);
                                                            swal({
                                                                title: "عملیات موفق",
                                                                text: "",
                                                                icon: "success",
                                                                button: "باشه"
                                                            })
                                                        }
                                                    });  
                                                }
                                            });
                                        })
                                    </script> 
            				    </div>
            		        </div>
            			</div>
			            <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
        					<?= form_open()?>
        					<div class="row row-xs mb-1" style="line-height: 0px;height: 55px;">
        						<div class="col-md-6">
        						    <label>نام</label>
        							<?= form_input($n); ?>
        							<br>
        							<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="nm">نمیتوانید این فیلد را خالی بگذارید!</span>
        						</div>
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <label>نام خانوادگی</label>
        							<?= form_input($f); ?>
        							<br>
        							<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="fm">نمیتوانید این فیلد را خالی بگذارید!</span>
        						</div>
        					</div>
        			        <div class="row row-xs mb-1 mt-3" style="line-height: 0px;height: 55px;">
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <label>کدملی</label>
        							<?= form_input($c); ?>
        							<br>
        							<span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="codm">نمیتوانید این فیلد را خالی بگذارید!</span>
        						</div>
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <label>نام پدر</label>
        							<?= form_input($p); ?>
        						<br>
        						<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="np">نمیتوانید این فیلد را خالی بگذارید!</span>
        						</div>
        					</div>
        					<div class="row row-xs mb-1 mt-3" style="line-height: 0px;height: 55px;">	
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <label>محل تولد</label>
        							<?= form_input($b_p); ?>
        							<br>
        							<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="bp">نمیتوانید این فیلد را خالی بگذارید!</span>
        						</div>
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <label>تاریخ تولد</label>
            						<div class="card">
                        				<div class="card-body" style="padding: 0;">
                        					<div class="main-content-label d-none mg-b-5">
                        			        </div>
                        					<div class="row row-sm">
                        						<div class="input-group col-sm-12">
                        							<div class="input-group-prepend">
                        								<div class="input-group-text">
                        									<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                        								</div>
                        							</div>
                        							<?= form_input($br);?>
                        						</div>
                        					</div>
                        				</div>
                    			    </div>
                    			                <br>
                    			                <span style="position: relative;display: block;bottom: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="br">نمیتوانید این فیلد را خالی بگذارید!</span>
            					</div>
            				</div>
        					<div class="row row-xs mb-1 mt-3" style="line-height: 0px;height: 55px;">
        						<div class="col-md-6">
        						    <label>شماره همراه</label>
        							<?= form_input($ph); ?>
        							<br>
        							<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="ph">نمیتوانید این فیلد را خالی بگذارید!</span>
        						</div>
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <label>ایمیل</label>
        							<?= form_input($e); ?>
        							<br>
        							<!--<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="em">نمیتوانید این فیلد را خالی بگذارید!</span>-->
        						</div>
        					</div>
        					<div class="row row-xs mb-1 mt-3" style="line-height: 0px;height: 55px;">
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <label>آدرس</label>
        							<?= form_input($ad); ?>
        							<br>
        							<span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="ader">نمیتوانید این فیلد را خالی بگذارید!</span>
        						</div>
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <label>کدپستی</label>
        							<?= form_input($c_p); ?>
        							<br>
        							<!--<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="nm">نمیتوانید این فیلد را خالی بگذارید!</span>-->
        						</div>
        				    </div>
        					<?php if($role != 'admin'){?>
        					<div class="row row-xs mb-1 mt-3" style="line-height: 0px;height: 55px;">
        						<div class="col-md-12 mg-t-10 mg-md-t-0">
        						    <label>نقش کاربر</label>
        							<?= $role ?>
        						</div>
        					</div>
        					<?php }?>		
        					<div class="row row-xs mb-1 mt-4" style="line-height: 0px;height: 55px;">
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <a href="#" id="send" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button">افزودن</a>
        						</div>
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        							<a href="<?php echo base_url().(!empty($ot)?'home':'user'); ?>" class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
        						</div>
        					</div>
        				    <?= form_close()?>
    				    </div>
	                </div>
    		    </div>
	        </div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        $('#send').click(function(){
            let pi = $('#pi').val();
            let n = $('#name').val();
            let f = $('#family').val();
            let c = $('#code').val();
            let p = $('#par').val();
            let bp = $('#b_p').val();
            let ph = $('#phone').val() ;
            let a = $('#address').val();
            let dp = $('#datepicker1').val();
            let e = $('#email').val();
            let cp = $('#c_p').val();
            let id = "<?php echo (!empty($id)?$id:$_SESSION['id']);?>";
            <?php if($role != 'admin'){ ?>
            let role = $("#role").val();
            <?php }else{?>
            let role = 0;
            <?php }?>
            if(pi == ''){
            if($("#picErr").hasClass('d-none')){$("#picErr").removeClass('d-none')}
            }else{
            if($("#picErr").hasClass('d-none')){}else{$("#picErr").addClass('d-none')}
            }
            if(n == ''){
                $("#name").css('border','1px solid red')
            if($("#nm").hasClass('d-none')){$("#nm").removeClass('d-none')}
            }else{
                $("#name").css('border','1px solid green')
            if($("#nm").hasClass('d-none')){}else{$("#nm").addClass('d-none')}
            }
            if(f == ''){
                $("#family").css('border','1px solid red')
            if($("#fm").hasClass('d-none')){$("#fm").removeClass('d-none')}
            }else{
                $("#family").css('border','1px solid green')
            if($("#fm").hasClass('d-none')){}else{$("#fm").addClass('d-none')}
            }
            if(c == ''){
                $("#code").css('border','1px solid red')
            if($("#codm").hasClass('d-none')){$("#codm").removeClass('d-none')}
            }else{
                $("#code").css('border','1px solid green')
            if($("#codm").hasClass('d-none')){}else{$("#codm").addClass('d-none')}
            }
            if(p == ''){
                $("#par").css('border','1px solid red')
            if($("#np").hasClass('d-none')){$("#np").removeClass('d-none')}
            }else{
                $("#par").css('border','1px solid green')
            if($("#np").hasClass('d-none')){}else{$("#np").addClass('d-none')}
            }
            if(bp == ''){
                $("#b_p").css('border','1px solid red')
            if($("#bp").hasClass('d-none')){$("#bp").removeClass('d-none')}
            }else{
                $("#b_p").css('border','1px solid green')
            if($("#bp").hasClass('d-none')){}else{$("#bp").addClass('d-none')}
            }
            if(ph == ''){
                $("#phone").css('border','1px solid red')
            if($("#ph").hasClass('d-none')){$("#ph").removeClass('d-none')}
            }else{
                $("#phone").css('border','1px solid green')
            if($("#ph").hasClass('d-none')){}else{$("#ph").addClass('d-none')}
            }
            if(a == ''){
                $("#address").css('border','1px solid red')
            if($("#ader").hasClass('d-none')){$("#ader").removeClass('d-none')}
            }else{
                $("#address").css('border','1px solid green')
            if($("#ader").hasClass('d-none')){}else{$("#ader").addClass('d-none')}
            }
            if(dp == ''){
                $("#datepicker1").css('border','1px solid red')
            if($("#br").hasClass('d-none')){$("#br").removeClass('d-none')}
            }else{
                $("#datepicker1").css('border','1px solid green')
            if($("#br").hasClass('d-none')){}else{$("#br").addClass('d-none')}
            }
            if(n != '' && f != '' && c != '' && p != '' &&  bp != '' &&  ph != '' && a != '' &&  dp != '' && pi != ''){
                let send = 'send';
                $.ajax({  
                    url:"<?php echo base_url(); ?>user/check_edit",   
                    method:"POST",  
                    data:{n:n,f:f,c:c,p:p,bp:bp,ph:ph,a:a,dp:dp,e:e,cp:cp,id:id,role:role,send:send,pi:pi},
                    success:function(x){
                        if(x == 1){
                            swal({
                                title: "عملیات موفق",
                                text: "",
                                icon: "success",
                                button: "باشه"
                            }).then(function(){
                                window.location.replace("<?php echo base_url().(!empty($ot)?'home':'user');?>"); 
                            });
                        }
                        if(x == 0){
                            swal({
                                title: "عملیات نا موفق",
                                text: "",
                                icon: "error",
                                button: "باشه"
                            }).then(function(){
                                window.location.replace("<?php echo base_url().(!empty($ot)?'user/edit_me':'user');?>"); 
                            });
                        }
                    }
                })    
            }
        })
    })
</script>
<script src="<?php echo base_url();?>assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pickerjs/picker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/file-upload.js"></script>
<!--Internal Fancy uploader js-->
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/fancy-uploader.js"></script>