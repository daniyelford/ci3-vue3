<!--<div class="container-fluid mt-3" style="min-height:480px;">-->
<!--    <div class="row">-->
<!--				<div class="col-lg-12 col-md-12">-->
<!--					<div class="card">-->
<!--						<div class="card-body">-->
<!--							<div class="main-content-label mg-b-5">-->
<!--							    ثبت نام 		-->
<!--							</div>-->
<!--							<p class="mg-b-20">مراحل ثبت نام را به ترتیب پشت سر بگذارید</p>-->
<!--							<div id="wizard3" role="application" class="wizard clearfix vertical"><div class="steps clearfix">-->
<!--							    <ul role="tablist">-->
<!--							        <li role="tab" class="first" aria-disabled="false" aria-selected="false">-->
<!--							            <a id="wizard3-t-0" href="#" aria-controls="wizard3-p-0">-->
<!--							                <span class="number">1</span>-->
<!--							                <span class="title">ثبت دامنه واطلاعات دیتابیس</span>-->
<!--							            </a>-->
<!--							        </li>-->
<!--							        <li role="tab" class="" aria-disabled="false" aria-selected="false">-->
<!--							            <a id="wizard3-t-1" href="#" aria-controls="wizard3-p-1">-->
<!--							                <span class="number">2</span> -->
<!--							                <span class="title">ثبت کاربر آدمین</span> -->
<!--							            </a>-->
<!--							        </li>-->
							        <!--<li role="tab" class="last current done" aria-disabled="false" aria-selected="true"><a id="wizard3-t-2" href="#wizard3-h-2" aria-controls="wizard3-p-2"><span class="current-info audible">current step: </span><span class="number">3</span> <span class="title">جزئیات پرداخت</span></a></li> -->
<!--							        </ul> -->
<!--							        </div>  -->
<!--							        <div class="content clearfix">-->
<!--					                <?= form_open()?>-->
<!--								    <h3 id="wizard3-h-0" tabindex="-1" class="title">اطلاعات دامنه</h3>-->
<!--								    <section id="wizard3-p-0" role="tabpanel" aria-labelledby="wizard3-h-0" class="body" aria-hidden="true" style="display: none;">-->
<!--									<div class="control-group form-group">-->
<!--										<label class="form-label">نام کسب و کار و یا شرکت خود را وارد کنید</label>-->
<!--										<?= form_input($com) ?>-->
<!--									</div>-->
<!--									<div class="control-group form-group">-->
<!--										<label class="form-label">نام دیتابیس سایت خود را وارد کنید</label>-->
<!--										<?= form_input($dbname) ?>-->
<!--									</div>-->
<!--									<div class="control-group form-group">-->
<!--										<label class="form-label">نام کاربری سایت خود را وارد کنید</label>-->
<!--										<?= form_input($username) ?>-->
<!--									</div>-->
									
<!--									<div class="control-group form-group">-->
<!--										<label class="form-label">رمز عبور سایت خود را وارد کنید</label>-->
<!--										<?= form_password($password) ?>-->
<!--									</div>-->
<!--									<div class="control-group form-group mb-0">-->
<!--									    <?= form_button($btn) ?>-->
<!--									</div>-->
<!--								    </section>-->
<!--								    <?= form_close()?>-->
<!--								    <?= form_open()?>-->
<!--								    <h3 id="wizard3-h-2" tabindex="-1" class="title current">در این بخش  شما به عنوان مدیر سایت در سایت خود ثبت نام می کنید</h3>-->
<!--								    <section id="wizard3-p-2" role="tabpanel" aria-labelledby="wizard3-h-2" class="body current" aria-hidden="false" style="">-->
<!--									<div class="form-group">-->
<!--										<label class="form-label">نام کاربری</label>-->
<!--										<?= form_input($username_user)?>-->
									    
										
										
<!--									</div>-->
<!--									<div class="form-group">-->
<!--										<label class="form-label">رمز عبور</label>-->
<!--										<?= form_password($password_user)?>-->
									    
										
										
<!--									</div>-->
<!--									<div class="form-group">-->
<!--										<label class="form-label">کد کپچا را وارد کنید</label>-->
<!--									    <?= form_input($captcha_x)?>-->
<!--									    <img src="<?= base_url().'auth'.DS.'captcha_first'?>" class='img-captcha' alt="captcha">-->
<!--									</div>-->
<!--										<div class="control-group form-group mb-0">-->
<!--									    <?= form_button($btn_user) ?>-->
<!--									</div>-->
<!--								</section>-->
<!--							        <?= form_close()?>-->
<!--							        <script>-->
<!--							            $(document).ready(function(){-->
							             //   $("wizard3-t-1").attr("disabled","disabled");
							             //   $("send").prop('disabled', true);
<!--						                    $("#wizard3-h-0").show();-->
<!--						                    $("#wizard3-p-0").show();-->
<!--						                    $("#wizard3-h-2").hide();-->
<!--						                    $("#wizard3-p-2").hide();-->
							             //   $("#wizard3-t-0").click(function(){
							             //       $(this).addClass('done');
							             //       $("#wizard3-h-0").show();
							             //       $("#wizard3-p-0").show();
							             //       $("#wizard3-h-2").hide();
							             //       $("#wizard3-p-2").hide();
							             //   });
							             //   $("#wizard3-t-1").click(function(){
							             //       $(this).addClass('done');
							             //       $("#wizard3-h-0").hide();
							             //       $("#wizard3-p-0").hide();
							             //       $("#wizard3-h-2").show();
							             //       $("#wizard3-p-2").show();
							             //   });
<!--							            });-->
<!--							            $(document).ready(function(){-->
<!--							                $("#send").click(function(e){-->
<!--    							                e.preventDefault();-->
<!--    							                let url1=window.location.origin;-->
<!--    							                let dbname=$("#dbname").val();-->
<!--    							                let com=$("#com").val();-->
<!--    							                let username =$("#username").val();-->
<!--    							                let password = $("#password").val();-->
<!--    							                if(dbname==''){-->
<!--    							                    $("#dbname").css('border','1px solid red');-->
<!--    							                }else{-->
<!--    							                    $("#dbname").css('border','1px solid green');-->
<!--    							                }-->
<!--    							                if(com==''){-->
<!--    							                    $("#com").css('border','1px solid red');-->
<!--    							                }else{-->
<!--    							                    $("#com").css('border','1px solid green');-->
<!--    							                }-->
<!--    							                if(username==''){-->
<!--    							                    $("#username").css('border','1px solid red');-->
<!--    							                }else{-->
<!--    							                    $("#username").css('border','1px solid green');-->
<!--    							                }-->
<!--    							                if(password==''){-->
<!--    							                    $("#password").css('border','1px solid red');-->
<!--    							                }else{-->
<!--    							                    $("#password").css('border','1px solid green');-->
<!--    							                }-->
<!--    							                if(password=='' && username=='' && com=='' && dbname==''){-->
<!--    							                }else{-->
    							                    
<!--    							                             $.ajax({-->
<!--    							                                url:window.location.origin + "/first/checking",-->
<!--    							                                method:"POST",-->
<!--    							                                data:{url1:url1,dbname:dbname,com:com,username:username,password:password},-->
<!--    							                                success:function(a){-->
<!--    							                                    alert(a)-->
<!--    							                                },erroe:function(){-->
    							                            
<!--    							                                }-->
<!--    							                            })-->
    							                    
<!--    							                }-->
<!--							                })-->
<!--							            })-->
<!--							        </script>-->
							        
<!--							    </div>-->
<!--							    <div class="actions clearfix">-->
							    <!--<ul role="menu" aria-label="Pagination"><li class="" aria-disabled="false"><a href="#previous" role="menuitem">قبلی</a></li><li aria-hidden="true" aria-disabled="true" class="disabled" style="display: none;"><a href="#next" role="menuitem">بعدی</a></li><li aria-hidden="false" style=""><a href="#finish" role="menuitem">پایان</a></li></ul> -->
<!--							    </div></div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--</div>-->



