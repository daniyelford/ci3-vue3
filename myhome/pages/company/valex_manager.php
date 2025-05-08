<?php
echo $map;
if(!empty($data) && 
!empty($data['role_id']) && intval($data['role_id'])>0 &&
($role_id=intval($data['role_id']))!==false &&
!empty($company_info)){ 
    if(empty($code_mely)){ ?>
        <div class='alert alert-danger rounded-10 text-center p-3 my-3'>
            به دلیل جلوگیری از هرگونه سواستفاده و کلاهبرداری اینترنتی شما موظف به تکمیل <a href="<?= base_url('user_setting') ?>">اطلاعات کاربری</a> خود می باشد و فقط مبحث تبلیغات محصولی برای شما فعال می باشد
        </div>    	
    <?php } 
    if(!empty($company_info['status']) && intval($company_info['status'])>0){ ?>
        <!--upgrade company promotions and company users-->
        <div class="row row-sm mt-2">
            <?php if(intval($role_id)==10||intval($role_id)==3||intval($role_id)==1||intval($role_id)==8||intval($role_id)==14){ ?>
            	<div class="col-sm-12 col-lg-6 col-xl-6">
            	    <div class="card card-img-holder">
            		    <div class="card-body list-icons">
                		    <div class="clearfix"></div>
                		    <div class="float-right  mt-2">
                			    <span class="text-primary ">
                				    <i class="si si-basket-loaded tx-30"></i>
                				</span>
            				</div>
            				<div class="float-left text-right">
            				    <h4 class="card-text mb-1 tx-15-f p-3">مدیریت محصولات کسب و کار</h4>
            				</div>
                		</div>
                		<div class="card-footer p-2">
                    		<a href="<?= base_url('product_company_manager') ?>" 
                    		class="btn btn-success-gradient btn-block tx-15-f p-3 shadow-light rounded-10 border-0">
                    		    مشاهده محصولات
                    	    </a>
                	    </div>
                    </div>
                </div>
            <?php } if(intval($role_id)==10||intval($role_id)==3||intval($role_id)==1||intval($role_id)==8){ ?>
            	<div class="col-sm-12 col-lg-6 col-xl-6">
                    <div class="card card-img-holder">
                	    <div class="card-body list-icons">
                		    <div class="clearfix"></div>
                			<div class="float-right  mt-2">
                			    <span class="text-primary ">
                				    <i class="si si-basket-loaded tx-30"></i>
                				</span>
                			</div>
                			<div class="float-left text-right">
                			    <h4 class="card-text mb-1 tx-15-f p-3">مدیریت سفارش محصولات کسب و کار</h4>
                			</div>
            			</div>
            			<div class="card-footer p-2">
                    			<?php if(!empty($code_mely)){ ?>
                    			     
                    			<?php }else{ ?>
                    			    <!--onclick="userInfoError();"-->
                    			<?php } ?>
                    	    <a href="<?= base_url('product_company_order_manager') ?>"
                    		class="btn btn-success-gradient btn-block tx-15-f p-3 shadow-light rounded-10 border-0">
                    	        سفارش محصولات
                    		</a>
                		</div>
                	</div>
                </div>
            <?php } if(intval($role_id)==11||intval($role_id)==7||intval($role_id)==1||intval($role_id)==8||intval($role_id)==15){ ?>
            	<div class="col-sm-12 col-lg-6 col-xl-6">
                    <div class="card p-0 card-img-holder">
                	    <div class="card-body list-icons">
                		    <div class="clearfix"></div>
                			<div class="float-right  mt-2">
                			    <span class="text-primary ">
                				    <i class="si si-credit-card tx-30"></i>
                				</span>
                			</div>
                			<div class="float-left text-right">
                			    <h4 class="card-text mb-1 tx-15-f p-3">مدیریت جایگاه های کسب و کار</h4>
                			</div>
            			</div>
            			<div class="card-footer p-2">
                    	    <a <?php if(!empty($code_mely)){ ?>
                    		    href="<?= base_url('position_company_manager') ?>"
                    		<?php }else{ ?>
                    		    onclick="userInfoError();"   
                    		<?php } ?>
                    		class="btn btn-primary-gradient btn-block tx-15-f p-3 shadow-light rounded-10 border-0">
                    		    مشاهده جایگاه ها
                    		</a>
                		</div>
                	</div>
                </div>
            <?php } if(intval($role_id)==11||intval($role_id)==7||intval($role_id)==1||intval($role_id)==8){ ?>
            	<div class="col-sm-12 col-lg-6 col-xl-6">
                    <div class="card p-0 card-img-holder">
                	    <div class="card-body list-icons">
                		    <div class="clearfix"></div>
                			<div class="float-right  mt-2">
                			    <span class="text-primary ">
                				    <i class="si si-credit-card tx-30"></i>
                				</span>
                			</div>
                			<div class="float-left text-right">
                			    <h4 class="card-text mb-1 tx-15-f p-3">مدیریت رزرو جایگاه های کسب و کار</h4>
                			</div>
            			</div>
            			<div class="card-footer p-2">
                		    <a <?php if(!empty($code_mely)){ ?>
                		        href="<?= base_url('position_company_reserve_manager') ?>"
                    		<?php }else{ ?>
                    		    onclick="userInfoError();"   
                    		<?php } ?>
                    		class="btn btn-primary-gradient btn-block tx-15-f p-3 shadow-light rounded-10 border-0">
                    	        رزرو جایگاه ها
                    		</a>
                		</div>
                	</div>
                </div>
            <?php } ?>
        </div>
        <div class="row mt-2" style="justify-content: center;">
            <?php if(intval($role_id)==12||intval($role_id)==1||intval($role_id)==8){ ?>
            	<div class="col-sm-12 col-lg-6 col-xl-6">
            	    <div class="card p-0 card-img-holder">
            		    <div class="card-body list-icons">
            			    <div class="clearfix"></div>
            			    <div class="float-right  mt-2">
            				    <span class="text-primary ">
            					    <i class="far fa-calendar-check tx-30"></i>
            					</span>
            				</div>
            				<div class="float-left text-right">
            				    <h4 class="card-text mb-1 tx-15-f p-3">مدیریت نشست های کسب و کار</h4>
            				</div>
            			</div>
            			<div class="card-footer p-2">
                			<a <?php if(!empty($company_info['type']) && intval($company_info['type'])>0){ 
                			    if(!empty($code_mely)){ ?>
            			            href="<?= base_url('meet_company_manager') ?>"
                    			<?php }else{ ?>
                    			    onclick="userInfoError();"
                    			<?php } 
                    		}else{ ?>
                			    onclick="permitionDenaied();"
                			<?php } ?>
                			class="btn btn-pink-gradient btn-block tx-15-f p-3 shadow-light rounded-10 border-0">
                			    مشاهده نشست ها
                			</a>
            			</div>
            		</div>
            	</div>
            <?php } 
            if(intval($role_id)==1||intval($role_id)==13||intval($role_id)==8){ ?>
            	<div class="col-sm-12 col-lg-6 col-xl-6">
            	    <div class="card p-0 card-img-holder">
            		    <div class="card-body list-icons">
            			    <div class="clearfix"></div>
            			    <div class="float-right  mt-2">
            				    <span class="text-primary ">
            					    <i class="fe fe-users tx-30"></i>
            					</span>
            				</div>
            				<div class="float-left text-right">
            				    <h4 class="card-text mb-1 tx-15-f p-3">مدیریت اعضای کسب و کار</h4>
            				</div>
            			</div>
            			<div class="card-footer p-2">
                			<a <?php if(!empty($company_info['type']) && intval($company_info['type'])>0){ 
                			    if(!empty($code_mely)){ ?>
                			        href="<?= base_url('company_users') ?>"
                    			<?php }else{ ?>
                    			    onclick="userInfoError();"
                    			<?php } 
                    		}else{ ?>
                			    onclick="permitionDenaied();"
                			<?php } ?>
                			class="btn btn-pink-gradient btn-block tx-15-f p-3 shadow-light rounded-10 border-0">
                			    مشاهده اعضای کسب و کار 
                			</a>
            			</div>
            		</div>
            	</div>
            	<div class="col-sm-12 ">
            	    <div class="card bg-warning-gradient text-white ">
            		    <a <?php if(!empty($company_info['type']) && intval($company_info['type'])>0){ 
                			    if(!empty($code_mely)){ ?>
                			        href="<?= base_url('company_resume') ?>"
                    			<?php }else{ ?>
                    			    onclick="userInfoError();"
                    			<?php } 
                    		}else{ ?>
                			    onclick="permitionDenaied();"
                			<?php } ?> class="card-body">
            			    <div class="row">
            				    <div class="col-3">
            					    <div class="icon1 mt-2 text-center">
            						    <i class="fa-classic fas fa-briefcase fa-fw fa-6x tx-40 text-light"></i>
            						</div>
            					</div>
            					<div class="col-9">
            					    <div class="mt-0 text-center">
            						    <h2 class="text-white mb-0 tx-12-f py-4">
            						        مدیریت دریافت رزومه ها
            						    </h2>
            						</div>
            					</div>
            				</div>
            			</a>
            		</div>
            	</div>
            	<!--
            	<div class="col-12">
            	    <div class="card p-0 card-img-holder">
            		    <div class="card-body list-icons">
            			    <div class="clearfix"></div>
            			    <div class="float-right  mt-2">
            				    <span class="text-primary ">
            					    <i class="typcn typcn-document-text tx-30"></i>
            					</span>
            				</div>
            				<div class="float-left text-right">
            				    <h4 class="card-text mb-1 tx-15-f p-3">مدیریت دریافت اطلاعات</h4>
            				</div>
            			</div>
            			<div class="card-footer p-2">
                			<a onclick="showApiPrice();" class="btn btn-pink-gradient btn-block tx-15-f p-3 shadow-light rounded-10 border-0">
                			    مشاهده لیست قیمت ها 
                			</a>
            			</div>
            		</div>
            	</div>
            	-->
            <?php } if(intval($role_id)==1||intval($role_id)==8){ ?>
        	    <div class="col-sm-12 col-lg-4 col-xl-4">
            	    <div class="card bg-success-gradient text-white ">
            		    <a onclick="mapMarkerChangeLocationImage('company',true,<?= (!empty($company_info['id'])&&intval($company_info['id'])>0?intval($company_info['id']):0) ?>,0,0,0);" class="card-body">
            			    <div class="row">
            				    <div class="col-3">
            					    <div class="icon1 mt-2 text-center">
            						    <i class="si si-location-pin tx-40 text-light"></i>
            						</div>
            					</div>
            					<div class="col-9">
            					    <div class="mt-0 text-center">
            						    <h2 class="text-white mb-0 tx-12-f py-4">
            						        تعیین محل کسب و کار
            						    </h2>
            						</div>
            					</div>
            				</div>
            			</a>
            		</div>
            	</div>
            	<div class="col-sm-12 col-lg-4 col-xl-4">
        	        <div class="card bg-primary-gradient text-white ">
            		    <a href="<?= base_url('company_promotions') ?>" class="text-white card-body">
            			    <div class="row">
            				    <div class="col-3">
                				    <span class="pulse-danger mr-2 d-none permissionError"></span>
            					    <div class="icon1 mt-2 text-center">
            						    <i class="icon ion-md-cube tx-30"></i>
            						</div>
            					</div>
            					<div class="col-9">
            					    <div class="mt-0 text-center">
            					        <h2 class="text-white mb-0 tx-12-f py-4">
                						    بسته های ارتقاء کسب و کار
                					    </h2>
            						</div>
            					</div>
            				</div>
                		</a>
            		</div>
            	</div>
            	<div class="col-sm-12 col-lg-4 col-xl-4">
            	    <div class="card bg-danger-gradient text-white ">
            		    <a href="<?= base_url('company_promotion_order') ?>" class="card-body">
            			    <div class="row">
            				    <div class="col-3">
            					    <div class="icon1 mt-2 text-center">
            						    <i class="las la-shopping-cart tx-40 text-light"></i>
            						</div>
            					</div>
            					<div class="col-9">
            					    <div class="mt-0 text-center">
            						    <h2 class="text-white mb-0 tx-12-f py-4">
            							    مشاهده بسته های سفارش شده
            						    </h2>
            						</div>
            					</div>
            				</div>
            			</a>
            		</div>
            	</div>
            <?php } ?>
        </div>
        <!--company product and company position-->
        <!--company info and company tasks and company meets and company setting-->
        <div class="row">
        	<div class="col-12">
        		<div class="card user-wideget rounded-10 overflow-hidden user-wideget-widget widget-user">
        		    <div class="widget-user-header bg-secondary-gradient">
                        <img class="wd-75 f-left rounded-10 mb-2" onclick="downloadImage(this);" src="<?= base_url('assets/qrcode/'.(!empty($company_info['qr_code'])?$company_info['qr_code']:'tes.png')) ?>" alt="company qrcode">
        			    <h3 class="widget-user-username"><?= (!empty($company_info['title'])?$company_info['title']:'') ?></h3>
        				<h6 class="widget-user-desc" style="max-width: 200px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" title="<?= (!empty($company_info['description'])?$company_info['description']:'') ?>"><?= (!empty($company_info['description'])?$company_info['description']:'') ?></h6>
        			</div>
            		<div class="widget-user-image pt-2">
            		    <img src="<?= base_url('assets/svg/company/'.(!empty($company_info['icon'])?$company_info['icon']:'company.svg')) ?>" class="brround" alt="company logo">
            		</div>
            		<div class="user-wideget-footer pt-3">
            		    <div class="row">
            			    <div class="col-sm-4 border-left">
            				    <div class="description-block">
            				        <a <?php if(!empty($company_info['type']) && intval($company_info['type'])>0){ 
            				            if(!empty($code_mely)){ ?>
        						            href="<?= base_url('company_meet') ?>"
                            			<?php }else{ ?>
                            			    onclick="userInfoError();"
                            			<?php } 
                            		}else{ ?>
        						        onclick="permitionDenaied();"
        						    <?php } ?> >
                					    <h5 class="description-header text-light pt-4 pb-2">جلسات</h5>
            				        </a>
            					</div>
            				</div>
            			    <div class="col-sm-4 border-left">
            				    <div class="description-block">
            				        <?php if((intval($role_id)==8||intval($role_id)==1)){?>
                				        <a onclick="editCompanyShowe(this);">
                    					    <h5 class="description-header text-light pt-4 pb-2">ویرایش کسب و کار</h5>
                				        </a>
                				        <div class="edit-company d-none">
                				            <div class="modal d-block" aria-hidden="true">
                                    			<div class="modal-dialog modal-lg" role="document">
                                    				<div class="modal-content modal-content-demo">
                                    					<div class="modal-header">
                                    						<h6 class="modal-title">ویرایش کسب و کار </h6>
                                    						<button onclick="editCompanyHide();" aria-label="بستن" class="close">
                                    							<span aria-hidden="true">×</span>
                                    						</button>
                                    					</div>
                                    					<div class="modal-body">
                                    						<div id="edit-company-manager" style="overflow-y: auto;overflow-x: hidden;max-height: 500px;">
                                    							<label class="mb-0">
                                    								عکس کسب و کار
                                    							</label>
                                    							<div class="wd-100 mx-auto">
                                								    <img src="<?= base_url('assets/svg/company/'.(!empty($company_info['icon'])?$company_info['icon']:'company.svg')) ?>" class="brround" alt="company logo">
                                    							</div>
                                    							<div class="w-50 mx-auto my-1 company-logo-uploader">
                                        							<?= (!empty($company_logo_uploader)?$company_logo_uploader:'') ?>
                                    							</div>
                                    							<form>
                                    								<div class="mt-1 mb-2">
                                    									<div class="row">
                                    										<div class="parsley-input col-md-6">
                                    											<label>
                                    												عنوان کسب و کار
                                    												<span class="tx-danger">*</span>
                                    											</label>
                                    											<input value="<?= (!empty($company_info['title'])?$company_info['title']:'') ?>" class="form-control shadow-light rounded-10" id="company-title-edit" placeholder='نام کسب و کار' type="text">
                                    										</div>
                                    										<div class="parsley-input col-md-6" id="lnWrapper">
                                    											<label>
                                    												آدرس سایت(اختیاری)
                                    											</label>
                                    											<input dir="ltr" value="<?= (!empty(trim($company_info['url']))?trim($company_info['url']):'') ?>" class="form-control shadow-light rounded-10" id="company-url-edit" placeholder='example.com' type="text">
                                    										</div>
                                    									</div>
                                    								</div>
                                    								<label>
                                    									توضیح فعالیت
                                    									<span class="tx-danger">*</span>
                                    								</label>
                                    								<textarea class="form-control shadow-light rounded-10" id="company-description-edit" placeholder="توضیحات کسب و کار" rows="3"><?= (!empty(trim($company_info['description']))?trim($company_info['description']):'') ?></textarea>
                                    								
                                    								<div class="mg-t-20 mb-2">
                                    									<button class="btn btn-success-gradient btn-block pd-x-20" onclick="editOneCompany(this);" type="button">
                                    										ویرایش
                                    									</button>
                                    								</div>
                                    							</form>
                                    						</div>
                                    					</div>
                                    				</div>
                                    			</div>
                                    		</div>
                				        </div>
            				        <?php } ?>
            					</div>
            				</div>
            				<div class="col-sm-4">
            				    <div class="description-block">
            				        <a <?php if(!empty($company_info['type']) && intval($company_info['type'])>0){ 
            				            if(!empty($code_mely)){ ?>
        						            href="<?= base_url('company_task') ?>"
                    			        <?php }else{ ?>
                    			            onclick="userInfoError();"
                    			        <?php } 
                    			    }else{ ?>
        						        onclick="permitionDenaied();"
        						    <?php } ?> >
                					    <h5 class="description-header text-light pt-4 pb-2">وظایف</h5>
            				        </a>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
        <!--company info and company tasks and company meets and company setting-->
        <script>
            function permitionDenaied(){
                $('.permissionError').removeClass('d-none');
                return not17();
            }
            function editCompanyShowe(el){
                $(el).parent().find('.edit-company').removeClass('d-none');
                return true;
            }
            function editCompanyHide(){
                $('.edit-company').addClass('d-none');
                return true;
            }
            function editOneCompany(el){
                let t=$.trim($('#company-title-edit').val()),
                u=$('#company-url-edit').val(),
                d=$.trim($('#company-description-edit').val()),
                i=$(el).parent().parent().parent().find('.company-logo-uploader').find('.file-name').val();
                if(t!==''){
                    $('#company-title-edit').removeClass('border-danger');
                }else{
                    $('#company-title-edit').addClass('border-danger');
                }
                if(d!==''){
                    $('#company-description-edit').removeClass('border-danger');
                }else{
                    $('#company-description-edit').addClass('border-danger');
                }
                if(t!=='' && d!==''){
                    sendAjax({id:<?= (!empty($company_info['id'])&&intval($company_info['id'])>0?intval($company_info['id']):0) ?>,t:t,d:d,i:i,u:u},baseUrl('company/company/edit'),'');
                    return true;
                }
                return not1();
            }
            function showApiPrice(){
                $.ajax({
                    data:{company_id:<?= (!empty($company_info['id'])&&intval($company_info['id'])>0?intval($company_info['id']):0) ?>},
                    url:baseUrl('includes/api/company_manager_show'),
                    method:'POST',
                    success:function (x){
                        $('#content').html(x);
                    }
                });
            }
            function userInfoError(){
                window.location.replace(baseUrl('user_setting'));
                return not35();
            }
        </script>
    <?php }else{ 
        if(intval($role_id)==1||intval($role_id)==8){ ?>
            <div class="row row-sm mt-2">
        	    <div class="col-6">
        	        <div class="card bg-success-gradient text-white ">
            		    <a href="<?= base_url('company_promotions') ?>" class="text-white card-body">
            			    <div class="row">
            				    <div class="col-3">
                				    <span class="pulse-danger mr-2 d-none permissionError"></span>
            					    <div class="icon1 mt-2 text-center">
            						    <i class="icon ion-md-cube tx-30"></i>
            						</div>
            					</div>
            					<div class="col-9">
            					    <div class="mt-0 text-center">
            					        <h2 class="text-white mb-0 tx-15-f p-3">
                						    بسته های ارتقاء کسب و کار
                					    </h2>
            						</div>
            					</div>
            				</div>
                		</a>
            		</div>
            	</div>
            	<div class="col-6">
            	    <div class="card bg-warning-gradient text-white ">
            		    <a href="<?= base_url('company_promotion_order') ?>" class="card-body">
            			    <div class="row">
            				    <div class="col-3">
            					    <div class="icon1 mt-2 text-center">
            						    <i class="las la-shopping-cart tx-40 text-light"></i>
            						</div>
            					</div>
            					<div class="col-9">
            					    <div class="mt-0 text-center">
            						    <h2 class="text-white mb-0 tx-20-f p-3">
            							    مشاهده بسته های سفارش شده
            						    </h2>
            						</div>
            					</div>
            				</div>
            			</a>
            		</div>
            	</div>
            	<div class="col-12">
            	    <div class="alert alert-danger p-3 text-center mt-4 rounded-10">
                        کسب و کار شما به حالت معلق در آمده است
                    </div>
            	</div>
            </div>
        <?php } 
    } 
} ?>