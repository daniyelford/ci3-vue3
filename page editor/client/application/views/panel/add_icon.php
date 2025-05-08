<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container-fluid mt-5" style="min-height:480px;">
    <div class="row mt-5">
        <div class="col-lg-12 col-md-12">
			<div class="card">
    			<div class="card-body">
					<div class="main-content-label mg-b-5">
					<a style="float:left;padding: 7px;color:red;" title="انصراف" href="<?php echo base_url()."icon";?>"><i class="fa fa-times" aria-hidden="true"></i></a>
					<?php if(isset($edit) && !empty($edit)){?>
						<h3 class="pull-right txt-start">
						    ویرایش آیکون
						</h3>
					<?php }else{?>
					<h3 class="pull-right txt-start">
					    ایجاد آیکون
					</h3>
					<?php }?>
					</div><p class="mg-b-20">
					<?php if(isset($edit) && !empty($edit)){?>
				        به آسانی می توانید آیکون های خود را ویرایش کنید
					<?php }else{?>
                        در این بخش شما می توانید به آسانی آیکون هایی را به وجود آورد تا کنار منو ها قرار بگیرند
					<?php }?>
					لیست آیکون ها را از 
					<!--<a href="https://fontawesome.com/icons">لیست اول</a> -->
					<!-- ؛ <a href="https://simplelineicons.github.io/">لیست دوم</a>-->
					<!-- ؛ <a href="https://cryptofont.com/">لیست سوم</a>-->
					<!-- ؛ <a href="https://themify.me/themify-icons">لیست چهارم</a>-->
					<!-- ؛ <a href="https://materialdesignicons.com/">لیست ینجم</a>-->
					<!-- ؛ <a href="https://feathericons.com/">لیست ششم</a>-->
					<!-- ؛ <a href="https://www.s-ings.com/typicons/">لیست هفتم</a>-->
					<!-- ؛ <a href="https://icons8.com/line-awesome">لیست هشتم</a> -->
                    <a href="https://fontawesome.com/v4/cheatsheet/">این لیست</a>
					بردارید
					
					
					</p>
					<div class="pd-30 pd-sm-40 bg-gray-200">
						<?= form_open()?>
							<div class="row row-xs" style="line-height: 0px;height: 55px;">
								<div class="col-md-6">
								    <label>عنوان آیکون</label>
									<?= form_input($e) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="titleErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>نوع آیکون</label>
								    <?= $h ?>
								</div>
								</div>
								<div class="row row-xs d-none mt-3" id="cls" style="line-height: 0px;height: 55px;">
								<div class="col-md-12 mg-t-10 mg-md-t-0">
								    <label>class مربوطه</label>
									<?= form_input($f) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="classErr">نمیتوانید فیلد class را خالی بگذارید!</span>
								</div>
								</div>
								<div class="row row-xs d-none mt-3" id="svg" style="line-height: 0px;height: 55px;">
								<div class="col-md-12 mg-t-10 mg-md-t-0">
								    <label>svg code</label>
									<?= form_input($g) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="svgErr">نمیتوانید فیلد svg را خالی بگذارید!</span>
								</div>
								
								</div>
							
								<div class="row row-xs mt-3" style="line-height: 0px;height: 55px;">
								<div class="col-md-6 mg-t-10 mg-md-t-0">
        								    <a href="#" id="send" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button"><?php echo (!empty($edit)?'ویرایش':'افزودن');?></a>
        								</div>
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        									<a href="<?php echo base_url().'icon';?>" class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
        								</div>
								</div>
							</div>
						<?= form_close()?>
					</div>
				</div>
			</div>
		</div>        
    </div>
</div>
<script>
    $(document).ready(function (){
        if($("#as").val()=='1'){
            if($("#cls").hasClass('d-none')){$("#cls").removeClass('d-none');}
            if($("#svg").hasClass('d-none')){}else{$("#svg").addClass('d-none');}
        }
        if($("#as").val()=='0'){
            if($("#cls").hasClass('d-none')){}else{$("#cls").addClass('d-none');}
            if($("#svg").hasClass('d-none')){$("#svg").removeClass('d-none');}
        }
        if($("#as").val()=='none'){
            if($("#svg").hasClass('d-none')){}else{$("#svg").addClass('d-none');}
            if($("#cls").hasClass('d-none')){}else{$("#cls").addClass('d-none');}
        }
        $("#as").on('change',function(){
            switch($(this).val()){
                case '1':
                    $("#shrtcd").val('');
                    if($("#cls").hasClass('d-none')){$("#cls").removeClass('d-none');}
                    if($("#svg").hasClass('d-none')){}else{$("#svg").addClass('d-none');}
                    break;
                    
                case '0':
                    $("#class").val('');
                    if($("#cls").hasClass('d-none')){}else{$("#cls").addClass('d-none');}
                    if($("#svg").hasClass('d-none')){$("#svg").removeClass('d-none');}
                    break;
                    
                default:
                    $("#shrtcd").val('');
                    $("#class").val('');
                    if($("#svg").hasClass('d-none')){}else{$("#svg").addClass('d-none');}
                    if($("#cls").hasClass('d-none')){}else{$("#cls").addClass('d-none');}
                    break;
            }
        })
        $("#send").click(function(){
            let title = $("#title").val();
            let iconClass =$("#class").val();
            let shrtcd=$("#shrtcd").val();
            let send="ok";
            let x;
            if($("#as").val()=='none'){
                $("#as").css({"border":"1px solid red"});
            }else{
                $("#as").css({"border":"1px solid green"});
            }
            if(title ==''){
                $("#title").css({"border":"1px solid red"});
                if($("#titleErr").hasClass('d-none')){
                    $("#titleErr").removeClass("d-none");
                    $("#titleErr").addClass("d-block");
                }
            }else{
                $("#title").css({"border":"1px solid green"});
                if($("#titleErr").hasClass('d-none')){}else{
                    $("#titleErr").removeClass("d-block");
                    $("#titleErr").addClass("d-none");
                }
            }
            if(shrtcd == ''){
                $("#shrtcd").css({"border":"1px solid red"});
                if($("#svgErr").hasClass('d-none')){
                    $("#svgErr").removeClass("d-none");
                    $("#svgErr").addClass("d-block");
                }
            }else{
                x='ok';
                if($("#svgErr").hasClass('d-none')){}else{
                $("#svgErr").removeClass("d-block");
                $("#svgErr").addClass("d-none");}
                $("#shrtcd").css({"border":"1px solid green"});
            }
            if(iconClass == ''){
                $("#class").css({"border":"1px solid red"});
                if($("#classErr").hasClass('d-none')){
                    $("#classErr").removeClass("d-none");
                    $("#classErr").addClass("d-block");
                }
            }else{
                x='ok';
                if($("#classErr").hasClass('d-none')){}else{
                    $("#classErr").removeClass("d-block");
                    $("#classErr").addClass("d-none");
                }
                $("#class").css({"border":"1px solid green"});
            }
            if(shrtcd == '' && iconClass == ''){
                x='';
            }
            if(title != '' && x=='ok'){
                <?php if(!empty($edit)){?>
                let id='<?php echo $edit;?>';
                  $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>icon/edit_icon_check",
                    data:{title : title , iconClass : iconClass , send : send , shrtcd : shrtcd , id : id},
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                     window.location.replace("<?php echo base_url();?>icon/edit_icon/"+id); 
                            });
                        }
                        if(values==1){
                            swal({
                                title: "عملیات موفق",
                                text: "آیکون ویرایش شد",
                                icon: "success",
                                button: "ادامه"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>icon"); 
                            });
                        }
                        
                    }
                })
                <?php }else{ ?>
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>icon/check_add_icon",
                    data:{title : title , iconClass : iconClass ,shrtcd : shrtcd, send : send },
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                     window.location.replace("<?php echo base_url();?>icon/add_icon"); 
                            });
                        }
                        if(values==1){
                            swal({
                                title: "عملیات موفق",
                                text: "آیکون جدید اضافه شد",
                                icon: "success",
                                button: "ادامه"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>icon"); 
                            });
                        }
                        
                    }
                })
                <?php }?>
            }
        })
    })
</script>