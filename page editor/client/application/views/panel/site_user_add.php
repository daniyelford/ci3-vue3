
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container-fluid my-5" style="min-height:480px;">
    <div class="row mt-5">
        <div class="col-lg-12 col-md-12 my-5">
			<div class="card">
    			<div class="card-body">
					<div class="main-content-label mg-b-5">
					<a style="float:left;padding: 7px;color:red;" title="انصراف" href="<?php echo base_url()."site_user";?>"><i class="fa fa-times" aria-hidden="true"></i></a>
				
						<h3 class="pull-right txt-start">
						    افزودن سایت
						</h3>
				
					</div><p class="mg-b-20">
					
					</p>
					<div class="pd-30 pd-sm-40 bg-gray-200">
						<?= form_open()?>
							<div class="row row-xs" style="line-height: 0px;height: 55px;">
								<div class="col-md-6">
								    <label>آدرس دامنه</label>
									<?= form_input($url) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="urlErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>نام دیتابیس</label>
								    <?= form_input($tbl) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="tblErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
							</div>
							<div class="row row-xs mt-4" style="line-height: 0px;height: 55px;">
								<div class="col-md-6">
								    <label>نام کاربری سایت</label>
									<?= form_input($user) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="userErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>رمز عبور سایت</label>
								    <?= form_input($pass) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="passErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
							</div>
							<div class="row row-xs mt-4" style="line-height: 0px;height: 55px;">
								<div class="col-md-6">
								    <label>نام خریدار</label>
									<?= form_input($name) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="nameErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>شماره خریدار</label>
								    <?= form_input($phone) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="phoneErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
							</div>
							<div class="row row-xs mt-4" style="line-height: 0px;height: 55px;">
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>اسم شرکت</label>
								    <?= form_input($com) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="comErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
									<div class="col-md-6">
								    <label>توضیحات سایت</label>
									<?= form_input($des) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="desErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
							</div>
							<div class="row row-xs mt-3" style="line-height: 0px;height: 55px;">
								<div class="col-md-6 mg-t-10 mg-md-t-0">
        								    <a href="#" id="send" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button"><?php echo (!empty($edit)?'ویرایش':'افزودن');?></a>
        								</div>
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        									<a href="<?php echo base_url().'site_user';?>" class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
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
        $("#send").click(function(){
            let name = $("#name").val();
            let url =$("#url").val();
            let com =$("#com").val();
            let phone =$("#phone").val();
            let user =$("#user").val();
            let pass =$("#pass").val();
            let des =$("#des").val();
            let tbl =$("#tbl").val();
            let send="ok";

            
            
            if(name == ''){
                $("#name").css({"border":"1px solid red"});
                if($("#nameErr").hasClass('d-none')){
                    $("#nameErr").removeClass("d-none");
                    $("#nameErr").addClass("d-block");
                }
            }else{
                if($("#nameErr").hasClass('d-none')){}else{
                    $("#nameErr").removeClass("d-block");
                    $("#nameErr").addClass("d-none");
                }
                $("#name").css({"border":"1px solid green"});
            }
            if(url == ''){
                $("#url").css({"border":"1px solid red"});
                if($("#urlErr").hasClass('d-none')){
                    $("#urlErr").removeClass("d-none");
                    $("#urlErr").addClass("d-block");
                }
            }else{
                if($("#urlErr").hasClass('d-none')){}else{
                    $("#urlErr").removeClass("d-block");
                    $("#urlErr").addClass("d-none");
                }
                $("#url").css({"border":"1px solid green"});
            }
            if(com == ''){
                $("#com").css({"border":"1px solid red"});
                if($("#comErr").hasClass('d-none')){
                    $("#comErr").removeClass("d-none");
                    $("#comErr").addClass("d-block");
                }
            }else{
                if($("#comErr").hasClass('d-none')){}else{
                    $("#comErr").removeClass("d-block");
                    $("#comErr").addClass("d-none");
                }
                $("#com").css({"border":"1px solid green"});
            }
            if(phone == ''){
                $("#phone").css({"border":"1px solid red"});
                if($("#phoneErr").hasClass('d-none')){
                    $("#phoneErr").removeClass("d-none");
                    $("#phoneErr").addClass("d-block");
                }
            }else{
                if($("#phoneErr").hasClass('d-none')){}else{
                    $("#phoneErr").removeClass("d-block");
                    $("#phoneErr").addClass("d-none");
                }
                $("#phone").css({"border":"1px solid green"});
            }
            if(user == ''){
                $("#user").css({"border":"1px solid red"});
                if($("#userErr").hasClass('d-none')){
                    $("#userErr").removeClass("d-none");
                    $("#userErr").addClass("d-block");
                }
            }else{
                if($("#userErr").hasClass('d-none')){}else{
                    $("#userErr").removeClass("d-block");
                    $("#userErr").addClass("d-none");
                }
                $("#user").css({"border":"1px solid green"});
            }
            if(pass == ''){
                $("#pass").css({"border":"1px solid red"});
                if($("#passErr").hasClass('d-none')){
                    $("#passErr").removeClass("d-none");
                    $("#passErr").addClass("d-block");
                }
            }else{
                if($("#passErr").hasClass('d-none')){}else{
                    $("#passErr").removeClass("d-block");
                    $("#passErr").addClass("d-none");
                }
                $("#pass").css({"border":"1px solid green"});
            }
            if(des == ''){
                $("#des").css({"border":"1px solid red"});
                if($("#desErr").hasClass('d-none')){
                    $("#desErr").removeClass("d-none");
                    $("#desErr").addClass("d-block");
                }
            }else{
                if($("#desErr").hasClass('d-none')){}else{
                    $("#desErr").removeClass("d-block");
                    $("#desErr").addClass("d-none");
                }
                $("#des").css({"border":"1px solid green"});
            }
            if(tbl == ''){
                $("#tbl").css({"border":"1px solid red"});
                if($("#tblErr").hasClass('d-none')){
                    $("#tblErr").removeClass("d-none");
                    $("#tblErr").addClass("d-block");
                }
            }else{
                if($("#tblErr").hasClass('d-none')){}else{
                    $("#tblErr").removeClass("d-block");
                    $("#tblErr").addClass("d-none");
                }
                $("#tbl").css({"border":"1px solid green"});
            }
            
            
            
            if(name != '' && url != '' && com != '' && phone != '' && user != '' &&  pass != '' && des != '' && tbl != ''){
                <?php if(!empty($edit)){?>
                let id='<?php echo $edit; ?>';
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>site_user/check_edit",
                    data:{name:name, url:url, com:com,  phone:phone,  user:user, pass:pass, des:des, tbl:tbl, send : send,id:id },
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                     window.location.replace("<?php echo base_url();?>site_user/edit/"+id); 
                            });
                        }
                        if(values==1){
                            swal({
                                title: "عملیات موفق",
                                text: "ویرایش  شد",
                                icon: "success",
                                button: "ادامه"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>site_user"); 
                            });
                        }
                        
                    }
                })
                <?php }else{?>
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>site_user/check_add",
                    data:{name:name, url:url, com:com,  phone:phone,  user:user, pass:pass, des:des, tbl:tbl, send : send },
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                     window.location.replace("<?php echo base_url();?>site_user/add"); 
                            });
                        }
                        if(values==1){
                            swal({
                                title: "عملیات موفق",
                                text: "سایت جدید اضافه شد",
                                icon: "success",
                                button: "ادامه"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>site_user"); 
                            });
                        }
                        
                    }
                })
                <?php }?>
            }
        })
    })
</script>