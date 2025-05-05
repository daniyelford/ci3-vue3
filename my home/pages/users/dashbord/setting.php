<?php if(!empty($data) && !empty($info)){ ?>
    <style>
        .hide-password,.show-password {
            position: relative;
            top: -30px;
            float: left;
            left: 18px;
        }
    </style>
    <div class="row row-sm mt-3">
    	<div class="col-lg-4">
    	    <div class="card mg-b-20">
    		    <div class="card-body text-center">
    			    <div class="pl-0">
    				    <div class="main-profile-overview">
    					    <div class="main-img-user profile-user">
    						    <img alt="user profile" src="<?= (!empty($info['image'])?$info['image']:base_url('assets/svg/user/user.svg')) ?>">
    						</div>
    						<div class="text-center mg-b-20">
    							<div id="profile-user-picture-upload">
    							    <?= (!empty($uploader)?$uploader:'') ?>
    							</div>
    						</div>
    						
    						<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
							<div class="row">
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('wallet') ?>">
                					    <i class="bx bx-dollar mx-1"></i>
                					    کیف پول
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('resume') ?>">
                					    <i class="bx bx-slider-alt mx-1"></i>
                					    رزومه
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-block btn-dark-gradient p-1 rounded-10" href="<?= base_url() ?>">
                			            <i class="la la-home mx-1"></i>
                					    خانه
                				    </a>
                                </div>
							</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-8">
    	    <div class="card">
    		    <div class="card-body">
        		    <div class="rounded-10 alert alert-danger p-4 text-center">
        			    برای ثبت کسب و کار و کیف پول اینترنتی در جهت جلو گیری از سو استفاده اینترنتی شما موظف هستید به صورت کامل اطلاعات خود را تکمیل کنید و فقط عناوین اختیاری را می توانید خالی بگذارید
        		    </div>
        			<div class="mb-4 main-content-label">احراز هویت</div>
        			<div class="form-group <?= (!empty($info['cart_mely_picture'])?'d-none':'') ?>">
    				    <div class="row">
    				        <div class="col-6 mx-auto">
    						    <img alt="user profile" src="<?= base_url('assets/svg/user/cart-mely.svg') ?>">
    						</div>
    					</div>
    				    <div class="row">
    					    <div class="col-md-4">
    						    <label class="form-label">عکس کارت ملی کنار صورت</label>
    					    </div>
    						<div class="col-md-8" id="cart-mely-user-picture-upload">
    						    <?= (!empty($upload)?$upload:'') ?>
    					    </div>
    				    </div>
    				</div>
    				<form class="form-horizontal">
    				    <div class="form-group <?= (!empty($info['mely_code'])?'d-none':'') ?>">
    						<div class="row">
    							<div class="col-md-3">
    							    <label class="form-label">کد ملی</label>
    						    </div>
    							<div class="col-md-9">
    							    <input id="mely-cod" value="<?= (!empty($info['mely_code'])?$info['mely_code']:'') ?>" type="text" <?= (!empty($info['mely_code'])?'disabled':'') ?> class="<?= (!empty($info['mely_code'])?'disabled':'') ?> shadow-light rounded-10 form-control" placeholder="کد ملی">
    						    </div>
    					    </div>
    				    </div>
        			    <div class="mb-4 main-content-label">اطلاعات شخصی</div>
    					<div class="form-group ">
    					    <div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">نام </label>
    							</div>
    							<div class="col-md-9">
    							    <input id="name" value="<?= (!empty($info['name'])?$info['name']:'') ?>" type="text" class="shadow-light rounded-10 form-control" placeholder="نام کوچک">
    							</div>
    						</div>
    					</div>
    					<div class="form-group ">
    					    <div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">نام خانوادگی</label>
    							</div>
    							<div class="col-md-9">
    							    <input id="family" value="<?= (!empty($info['family'])?$info['family']:'') ?>" type="text" class="shadow-light rounded-10 form-control" placeholder="نام خانوادگی">
    							</div>
    						</div>
    					</div>
    				    <div class="form-group ">
    						<div class="row">
    							<div class="col-md-3">
    							    <label class="form-label">تاریخ تولد</label>
    						    </div>
    							<div class="col-md-9">
    							    <?= (!empty($timer)?$timer:'') ?>
    							</div>
    					    </div>
    				    </div>
    					<!--
    					<div class="mb-4 main-content-label"> 
    				    	اطلاعات کاربری
        					<?php if(!empty($data['auth_info_id']) && intval($data['auth_info_id'])>0){ ?>
        					    <div class="text-center rounded-10 alert alert-success p-3 mt-2">
        					        شما اطلاعات کاربری دارید برای ویرایش می توانید اقدام کنید 
        					    </div>
        					<?php }else{ ?>
        					    <i class="text-danger">اجباری</i>
        					<?php } ?>
    				    </div>
    					<?php if(empty($data['auth_info_id']) || intval($data['auth_info_id'])==0){ ?>
        					<div class="form-group ">
        					    <div class="row">
        						    <div class="col-md-3">
        							    <label class="form-label">نام کاربری</label>
        							</div>
        							<div class="col-md-9">
        							    <input id="username" type="text" class="shadow-light rounded-10 form-control" placeholder="نام کاربری">
        							</div>
        						</div>
        					</div>
    					<?php } ?>
    					<div class="form-group ">
    					    <div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">کلمه عبور</label>
    							</div>
    							<div class="col-md-9">
    							    <input id="password" type="password" class="shadow-light rounded-10 form-control" placeholder="کلمه عبور">
    							    <span class="far fa-eye show-password" onclick="showPassword(this);"></span>
    							    <span class="far fa-eye-slash hide-password d-none" onclick="hidePassword(this);"></span>
    							</div>
    						</div>
    					</div>
    					-->
    					<div class="mb-4 main-content-label <?= (!empty($info['gmail']) && !empty($info['phone'])?'d-none':'') ?>">اطلاعات ثبتی</div>
    					<div class="form-group <?= (!empty($info['gmail'])?'d-none':'') ?>">
    						<div class="row">
    							<div class="col-md-3">
    							    <label class="form-label">ایمیل</label>
    							</div>
    							<div class="col-md-9">
    							    <input type="hidden" id="gmail" value="<?= (!empty($info['gmail'])?$info['gmail']:'') ?>">
        							<a class="btn btn-block btn-danger" href="<?= base_url('users/users/auto_auth/google') ?>">
										عضویت با gmail
									</a>
								</div>
    							
    					    </div>
    					</div>
    					<div class="form-group <?= (!empty($info['phone'])?'d-none':'') ?>">
    					    <div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">شماره همراه</label>
    							</div>
    							<div class="col-md-6">
    							    <input type="hidden" id="phone" value="<?= (!empty($info['phone'])?$info['phone']:'') ?>">
    							    <input id="phone_register_doing" value="<?= (!empty($info['phone'])?$info['phone']:'') ?>" type="text" class="shadow-light rounded-10 form-control" placeholder="شماره همراه" >
    						        <input id="phone-code" type="password" class="d-none shadow-light rounded-10 form-control" placeholder="کد ارسالی" >
    							</div>
    							<div class="col-md-3">
    						        <a id="send_code_phone" onclick="sendCodePhone(this);" class="btn btn-success rounded-10">ارسال کد</a>
    						        <a id="send_code_phone_accept" onclick="sendCodephoneAccept(this);" class="d-none btn btn-success rounded-10">ثبت کد</a>
    						    </div>
    						</div>
    					</div>
    					<div class="mb-4 main-content-label">اطلاعات تماس</div>
    					<div class="form-group ">
    						<div class="row">
    							<div class="col-md-4">
    							    <label class="form-label">شماره ثابت<i>(اختیاری)</i></label>
    							</div>
    							<div class="col-md-8">
    							    <input id="tel" value="<?= (!empty($info['home_tel'])?$info['home_tel']:'') ?>" type="text" class="shadow-light rounded-10 form-control" placeholder="شماره ثابت">
    						    </div>
    					    </div>
    					</div>
    					<div class="form-group ">
    						<div class="row">
    						    <div class="col-md-4">
    							    <label class="form-label">نشانی<i>(اختیاری)</i></label>
    							</div>
    							<div class="col-md-8">
    							    <textarea id="address" class="shadow-light rounded-10 form-control" name="example-textarea-input" rows="2" placeholder="نشانی"><?= (!empty(trim($info['address']))?trim($info['address']):'') ?></textarea>
    							</div>
    						</div>
    					</div>
    					<div class="form-group ">
    					    <div class="row">
    						    <div class="col-md-4">
    							    <label class="form-label">کد پستی<i>(اختیاری)</i></label>
    							</div>
    							<div class="col-md-8">
    							    <input id="posty-cod" type="text" class="shadow-light rounded-10 form-control" placeholder="کد پستی" value="<?= (!empty($info['posty_code'])?$info['posty_code']:'') ?>">
    							</div>
    						</div>
    					</div>
    				</form>
    			</div>
    			<div class="card-footer text-left">
    			    <button type="button" onclick="saveEditProfile();" class="btn btn-success-gradient btn-block">بروزرسانی پروفایل</button>
    			</div>
    		</div>
    	</div>
    </div>
    <script>
        function sendCodephoneAccept(el){
            if($('#phone-code').val()!==''){
                sendAjax({phone:$('#phone_register_doing').val(),code:$('#phone-code').val()},baseUrl('users/dashbord/send_code_phone_accept'),'');
            }else{
                return not1();
            }
        }
        function sendCodePhone(el){
            if($('#phone_register_doing').val()!==''){
                let siteKey=$('#site-key').val(),url=baseUrl('users/dashbord/send_code_phone'),data={phone:$('#phone_register_doing').val()};
                grecaptcha.ready(function() {
                    grecaptcha.execute(siteKey, {action: 'send'}).then(function(token) {
                		$('#send').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                		$.post(url,{data:data, token: token}, function(result) {
                		    if(result==1){
                                $('#send_code_phone').addClass('d-none');
                                $('#phone-code').removeClass('d-none');
                                $('#send_code_phone_accept').removeClass('d-none');
                                $('#phone_register_doing').addClass('d-none');
                		    }else{
                		        if(result==2){
                                    return not41();
                		        }else{
                		            if(result==3){
                                        return not38();
                		            }else{
                		                return not8();
                		            }
                		        }
                		    }
                		});
                    });
                });
                return true;
            }else{
                $('#phone_register_doing').addClass('border-danger');
            }
        }
        function showPassword(el){
            $(el).addClass('d-none');
            $(el).parent().find('.hide-password').removeClass('d-none');
            $('#password').prop('type','text');  
            return true;
        }
        function hidePassword(el){
            $(el).addClass('d-none');
            $(el).parent().find('.show-password').removeClass('d-none');
            $('#password').prop('type','password');  
            return true;
        }
        function saveEditProfile(){
            // username=$('#username').val(),
            // password=$('#password').val(),
            let name=$('#name').val(),
            family=$('#family').val(),
            melyCod=$('#mely-cod').val(),
            gmail=$('#gmail').val(),
            phone=$('#phone').val(),
            tel=$('#tel').val(),
            address=$('#address').val(),
            postyCod=$('#posty-cod').val(),
            day=$('#day').val(),
            month=$('#month').val(),
            year=$('#year').val(),
            image=$('#profile-user-picture-upload').find('.file-name').val(),
            cartMelyImage=$('#cart-mely-user-picture-upload').find('.file-name').val();
            if(name!==''&&family!==''&&<?= (empty($info['cart_mely_picture'])?'cartMelyImage!==""&&':'') ?>melyCod!==''&&phone!==''){
                $('#name').removeClass('border-danger');
                $('#family').removeClass('border-danger');
                $('#mely-cod').removeClass('border-danger');
                // $('#gmail').removeClass('border-danger');
                $('#phone').removeClass('border-danger');
                // if(username!==''||password!==''){
                //     <?php if(empty($data['auth_info_id']) || intval($data['auth_info_id'])==0){ ?>
                //         if(username!=='' && username.length>=8 && password!=='' && password.length>=8){
                //             $('#username').removeClass('border-danger');
                //             $('#password').removeClass('border-danger');
                //             sendAjax({
                //                 name:name,
                //                 family:family,
                //                 melyCod:melyCod,
                //                 cartMelyImage:cartMelyImage,
                //                 gmail:gmail,
                //                 username:username,
                //                 password:password,
                //                 phone:phone,
                //                 tel:tel,
                //                 day:day,
                //                 month:month,
                //                 year:year,
                //                 image:image,
                //                 address:address,
                //                 postyCod:postyCod
                //             },baseUrl('users/dashbord/edit_user'),'');
                //         }else{
                //             if(username==''){
                //                 $('#username').addClass('border-danger');
                //             }else{
                //                 $('#username').removeClass('border-danger');
                //             }
                //             if(password==''){
                //                 $('#password').addClass('border-danger');
                //             }else{
                //                 $('#password').removeClass('border-danger');
                //             }
                //             if(username.length<8){
                //                 $('#username').addClass('border-danger');
                //                 return not31();
                //             }else{
                //                 $('#username').removeClass('border-danger');
                //             }
                //             if(password.length<8){
                //                 $('#password').addClass('border-danger');
                //                  return not32();
                //             }else{
                //                 $('#password').removeClass('border-danger');
                //             }
                //             return not1();
                //         }
                //     <?php }else{ ?>
                //         sendAjax({
                //             name:name,
                //             family:family,
                //             melyCod:melyCod,
                //             cartMelyImage:cartMelyImage,
                //             gmail:gmail,
                //             password:password,
                //             phone:phone,
                //             tel:tel,
                //             day:day,
                //             month:month,
                //             year:year,
                //             image:image,
                //             address:address,
                //             postyCod:postyCod
                //         },baseUrl('users/dashbord/edit_user'),'');
                //     <?php } ?>
                // }else{
                    sendAjax({
                        name:name,
                        family:family,
                        melyCod:melyCod,
                        cartMelyImage:cartMelyImage,
                        gmail:gmail,
                        phone:phone,
                        tel:tel,
                        day:day,
                        month:month,
                        year:year,
                        image:image,
                        address:address,
                        postyCod:postyCod
                    },baseUrl('users/dashbord/edit_user'),'');
                // }
            }else{
                if(name==''){
                    $('#name').addClass('border-danger');
                }else{
                    $('#name').removeClass('border-danger');
                }
                if(family==''){
                    $('#family').addClass('border-danger');
                }else{
                    $('#family').removeClass('border-danger');
                }
                if(melyCod==''){
                    $('#mely-cod').addClass('border-danger');
                }else{
                    $('#mely-cod').removeClass('border-danger');
                }
                if(phone==''){
                    $('#phone_register_doing').addClass('border-danger');
                }else{
                    $('#phone_register_doing').removeClass('border-danger');
                }
                <?php if(empty($info['cart_mely_picture'])){ ?>
                    if(cartMelyImage==''){
                        $('#cart-mely-user-picture-upload').find('a').addClass('border-danger');
                    }else{
                        $('#cart-mely-user-picture-upload').find('a').removeClass('border-danger');
                    }
                <?php } ?>
                return not1();
            }
        }
        $(function(){
            processAjaxData('حساب کاربری',$('#content').html(),'<?= base_url("user_setting")?>');
        })
    </script>
<?php }else{ header("Location:".base_url());} ?>