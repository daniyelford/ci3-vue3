<?php if(!empty($user) && is_array($user)){ ?>
	<div class="row row-sm mt-2">
	    <div class="col-lg-4">
			<div class="card mg-b-20">
			    <div class="card-body text-center">
				    <div class="pl-0">
					    <div class="main-profile-overview">
						    <div class="main-img-user profile-user">
							    <img alt="" src="<?= (!empty($user['img'])?$user['img']:'') ?>">
							    <?php if(trim($role)!=='دسترسی کل' && trim($role)!=='مدیر کسب و کار'){ ?>
							        <a onclick="editRole();" class="icon ion-ios-settings tx-30-f profile-edit" title="ویرایش موقعیت شغلی"></a>
							    <?php } ?>
							</div>
							<div class="text-center justify-content-between mg-b-20">
							    <div>
								    <h5 class="main-profile-name"><?= (!empty($user['name'])?$user['name']:'') ?></h5>
								    <p class="main-profile-name-text"><?= (!empty($role)?$role:'') ?></p>
								    <?php if(!empty($user['phone'])){ ?>
								        <a href="tel:<?= $user['phone'] ?>">
								            <i class="icon tx-12-f ion-ios-call text-success"></i>
								        </a>
								    <?php } ?>
								</div>
							</div>
							<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">جلسات</label>
							<div class="row mb-2">
								<div class="col-md-8">
									<h6 class="text-small text-muted mb-0">درخواست از شخص</h6>
								</div>
								<div class="col-md-4">
								    <h5><?= (!empty($company_action['meets']['from_user']) && is_array($company_action['meets']['from_user'])?count($company_action['meets']['from_user']):0) ?></h5>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
								    <h6 class="text-small text-muted mb-0">دعوت های شخص</h6>
								</div>
								<div class="col-md-4">
								    <h5><?= (!empty($company_action['meets']['from_other']) && is_array($company_action['meets']['from_other'])?count($company_action['meets']['from_other']):0) ?></h5>
								</div>
							</div>
							<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">وظایف</label>
							<div class="row mb-2">
								<div class="col-md-6 col mb20">
									<h6 class="text-small text-muted mb-0">ارجاع وظیفه</h6>
								</div>
								<div class="col-md-6 col mb20">
								    <h5><?= (!empty($company_action['tasks']['from_other']) && is_array($company_action['tasks']['from_other'])?count($company_action['tasks']['from_other']):0) ?></h5>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col mb20">
								    <h6 class="text-small text-muted mb-0">وظایف مرتبط</h6>
							    </div>
								<div class="col-md-6 col mb20">
								    <h5><?= (!empty($company_action['tasks']['from_other']) && is_array($company_action['tasks']['from_other'])?count($company_action['tasks']['from_other']):0) ?></h5>
								</div>
							</div>
							<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
							<div class="row">
							    <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('company_users') ?>">
                					    <i class="fe fe-users mx-1"></i>
                					    اعضای کسب و کار
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('company_one') ?>">
                					    <i class="bx bx-folder-open mx-1"></i>
                					    کسب و کار مربوط
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('company_manager') ?>">
                					    <i class="bx bx-slider-alt mx-1"></i>
                					    همه کسب و کارها
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
		    <div class="row row-sm mb-2">
		        <?php if(trim($role)=='کارشناس خدمات'){ ?>
    		        <div class="col-6 text-center">
    	    	        <button type="button"
    	    	        id="typeBtnPos" class="btn btn-info btn-block"><i class="si si-credit-card tx-40"></i></button>
                        <span class="tx-10-f px-1">
                            جایگاه
                        </span>
                    </div>
		        <?php }elseif(trim($role)=='کارشناس محصول'){ ?>
    		        <div class="col-6 text-center">
        		        <button type="button" 
        		        id="typeBtnPro" class="btn btn-success btn-block"><i class="si si-basket-loaded tx-40"></i></button>
        		        <span class="tx-10-f px-1">
        		            محصول
        		        </span>
    		        </div>
		        <?php }else{ ?>
    		        <div class="col-6 text-center">
        		        <button type="button" onclick="changeTypeMode(this,'#typeBtnPos','#product-control','#position-control');" 
        		        id="typeBtnPro" class="btn btn-success btn-block"><i class="si si-basket-loaded tx-40"></i></button>
        		        <span class="tx-10-f px-1">
        		            محصول
        		        </span>
    		        </div>
                    <div class="col-6 text-center">
    	    	        <button type="button" onclick="changeTypeMode(this,'#typeBtnPro','#position-control','#product-control');" 
    	    	        id="typeBtnPos" class="btn btn-info btn-block"><i class="si si-credit-card tx-40"></i></button>
                        <span class="tx-10-f px-1">
                            جایگاه
                        </span>
                    </div>
		        <?php } ?>
		    </div>
		    <?php if(trim($role)=='کارشناس خدمات'){ ?>
		        <span id="position-control">
        			<div class="row row-sm">
        				<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
        				    <div class="card">
        					    <div class="card-body">
        						    <div class="counter-status d-flex md-mb-0">
        							    <div class="counter-icon bg-primary-transparent px-2 pt-1">
        								    <i class="icon ion-ios-pie tx-50-f text-primary"></i>
        								</div>
        								<div class="mr-auto">
        								    <h5 class="tx-13 tect-center">کارشناسی جایگاه</h5>
        									<h2 class="mb-0 tx-22 mb-1 mt-1 tect-center position-count"><?= (!empty($company_action['positions']['access']) && is_array($company_action['positions']['access'])?
        									count(array_filter(array_column(array_column(array_column($company_action['positions']['access'],'position_info'),'info'),'deleted_at'), function($x) { return empty($x); })):0) ?></h2>
        									<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mx-1"></i>خدمات دارای تخصص</p>
        								</div>
        							</div>
        					    </div>
        					</div>
        				</div>
        			</div>
        			<div class="card">
        			    <div class="card-header pb-0">
        			        <h5>
        			            تعیین جایگاه ارائه خدمات برای کارشناس
        			        </h5>
        			        <p>
        			            شما در این بخش می توانید دسترسی جایگاه های ارائه خدمات کسب و کار خود را به این همکار بدهید
        			        </p>
        			    </div>
        				<div class="card-body pt-1">
        					<?php if(!empty($company_action['positions']['all'])){ ?>
        					    <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
            					    <?php $ar=[];
            					    if(!empty($company_action['positions']['access'])){
                					    foreach($company_action['positions']['access'] as $a){
                					        if(!empty($a['company_category_product_position_id']) && intval(['company_category_product_position_id'])>0)
                    					        $ar[]=intval($a['company_category_product_position_id']);
                					    }
            					    }
            					    foreach($company_action['positions']['all'] as $a){
            					        if(!empty($a) && !empty($a['position_info']) && !empty($a['position_info']['info']) && !empty($a['company_category_product_position_id']) && intval($a['company_category_product_position_id'])>0 && empty($a['position_info']['info']['deleted_at'])){ ?>
            					            <div class="main-mail-item">
            									<div>
            										<label class="ckbox">
            										    <input 
                										onclick="setAccess(this,<?= intval($a['company_category_product_position_id']) ?>,1);"
                										<?= (in_array(intval($a['company_category_product_position_id']),$ar)?'checked':'') ?> 
                										type="checkbox"> 
                										<span></span>
            										</label>
            									</div>
            									<div class="main-mail-star"></div>
            									<div class="main-img-user">
            									    <img alt="position icon" src="<?= base_url('assets/svg/position/'.(!empty($a['position_info']['info']['icon'])?$a['position_info']['info']['icon']:'position.svg')) ?>">
            									</div>
            									<div class="main-mail-body">
            										<div class="main-mail-from">
            										    <?= (!empty($a['position_info']['info']['title'])?$a['position_info']['info']['title']:'') ?>
            										</div>
            										<div class="main-mail-subject tx-10-f" style="max-width: 123px;" title="<?= (!empty($a['position_info']['info']['description'])?$a['position_info']['info']['description']:'') ?>">
            										    <?= (!empty($a['position_info']['info']['description'])?$a['position_info']['info']['description']:'') ?>
            										</div>
            									</div>
            									<div class="main-mail-attachment tx-12-f pt-2">
            									    قیمت:
            									    <?= (!empty($a['position_info']['info']['price'])?number_format($a['position_info']['info']['price']).'تومان':'رایگان') ?>
            									</div>
            									<div class="main-mail-date">
            									    <?php if(!empty($a['position_info']['info']['status']) && intval($a['position_info']['info']['status'])>0){  ?>
                									    <span class="badge bg-success-transparent text-success mr-auto ml-1 float-left">
                									        دردسترس
                									    </span>
            									    <?php }else{ ?>
                									    <span class="badge bg-danger-transparent text-danger mr-auto ml-1 float-left">
                									        مشغول
                									    </span>
            									    <?php } ?>
            									</div>
            								</div>
            					    <?php } 
            					    } ?>
        					    </div>
        					<?php }else{ ?>
        					    <div class="alert alert-danger text-center p-3 rounded-10">
        					        شما جایگاهی برای ارائه خدمات در کسب و کار خود ندارید
        					    </div>
        					<?php } ?>
        				</div>
        			</div>
    		    </span>
            <?php }elseif(trim($role)=='کارشناس محصول'){ ?>
                <span id="product-control">
        		    <div class="row row-sm">
        			    <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
        				    <div class="card">
        					    <div class="card-body">
        						    <div class="counter-status d-flex md-mb-0">
        							    <div class="counter-icon bg-primary-transparent px-2 pt-1">
        								    <i class="icon ion-md-cube tx-50-f text-primary"></i>
        								</div>
        								<div class="mr-auto">
        								    <h5 class="tx-13 tect-center">کارشناسی محصولات</h5>
        									<h2 class="mb-0 tx-22 mb-1 mt-1 tect-center product-count"><?= (!empty($company_action['products']['access']) && is_array($company_action['products']['access'])?
        									count(array_filter(array_column(array_column(array_column($company_action['products']['access'],'product_info'),'info'),'deleted_at'), function($x) { return empty($x); })):0) ?></h2>
        									<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mx-1"></i>محصولات دارای تخصص</p>
        								</div>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="card">
        			    <div class="card-header pb-0">
        			        <h5>
        			            تعیین محصول برای کارشناس
        			        </h5>
        			        <p>
        			            شما در این بخش می توانید دسترسی محصولات کسب و کار خود را به این همکار بدهید
        			        </p>
        			    </div>
        				<div class="card-body pt-1">
        					<?php if(!empty($company_action['products']['all'])){ ?>
        					    <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
                					<?php
            					    $ar=[];
            					    if(!empty($company_action['products']['access'])){
                					    foreach($company_action['products']['access'] as $a){
                					        if(!empty($a['company_category_product_position_id']) && intval(['company_category_product_position_id'])>0)
                    					        $ar[]=intval($a['company_category_product_position_id']);
                					    }
            					    }
            					    foreach($company_action['products']['all'] as $a){
            					        if(!empty($a) && !empty($a['product_info']) && !empty($a['product_info']['info']) && !empty($a['company_category_product_position_id']) && intval($a['company_category_product_position_id'])>0 && empty($a['product_info']['info']['deleted_at'])){ ?>
            					            <div class="main-mail-item">
            									<div>
            										<label class="ckbox">
            										    <input 
            										    onclick="setAccess(this,<?= intval($a['company_category_product_position_id']) ?>,0);"
            										    <?= (in_array(intval($a['company_category_product_position_id']),$ar)?'checked':'') ?> 
            										    type="checkbox"> 
            										    <span></span>
            									    </label>
            									</div>
            									<div class="main-mail-star"></div>
            									<div class="main-img-user">
            									    <img alt="product icon" src="<?= base_url('assets/svg/product/'.(!empty($a['product_info']['info']['icon'])?$a['product_info']['info']['icon']:'product.svg')) ?>">
            									</div>
            									<div class="main-mail-body">
            										<div class="main-mail-from">
            										    <?= (!empty($a['product_info']['info']['title'])?$a['product_info']['info']['title']:(!empty($a['product_info']['info']['key'])?$a['product_info']['info']['key']:'')) ?>
            										</div>
            										<div class="main-mail-subject tx-10-f" style="max-width: 123px;" title="<?= (!empty($a['product_info']['info']['description'])?$a['product_info']['info']['description']:'') ?>">
            										    <?= (!empty($a['product_info']['info']['description'])?$a['product_info']['info']['description']:'') ?>
            										</div>
            									</div>
            									<div class="main-mail-attachment tx-12-f pt-2">
            									    قیمت:
            									    <?= (!empty($a['product_info']['info']['price'])?number_format($a['product_info']['info']['price']).'تومان':'رایگان') ?>
            									</div>
            									<div class="main-mail-date">
            									    <?php if(!empty($a['product_info']['info']['status']) && intval($a['product_info']['info']['status'])>0){  ?>
                									    <span class="badge bg-success-transparent text-success mr-auto ml-1 float-left">
                									        دردسترس
                									    </span>
            									    <?php }else{ ?>
                									    <span class="badge bg-danger-transparent text-danger mr-auto ml-1 float-left">
                									        ناموجود
                									    </span>
            									    <?php } ?>
            									</div>
            								</div>
            					    <?php } 
            					    } ?>
        					    </div>
        					<?php }else{ ?>
        					    <div class="alert alert-danger text-center p-3 rounded-10">
        					        شما محصولی در کسب و کار خود ندارید
        					    </div>
        					<?php } ?>
        				</div>
        			</div>
    		    </span>
            <?php }elseif(trim($role)=='تنظیم کننده جلسات'){ ?>
                <div class="row row-sm">
        		    <div class="col-12">
        		        <div class="allert alert-danger rounded-10 p-4 text-center">
        		            این همکار دسترسی برای این آیتم ها را ندارد
        		        </div>
        		    </div>
        	    </div>
            <?php }elseif(trim($role)=='نیرو انسانی'){ ?>
                <div class="row row-sm">
        		    <div class="col-12">
        		        <div class="allert alert-danger rounded-10 p-4 text-center">
        		            این همکار دسترسی برای این آیتم ها را ندارد
        		        </div>
        		    </div>
        	    </div>
            <?php }else{ ?>
    		    <span id="product-control">
        		    <div class="row row-sm">
        			    <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
        				    <div class="card">
        					    <div class="card-body">
        						    <div class="counter-status d-flex md-mb-0">
        							    <div class="counter-icon bg-primary-transparent px-2 pt-1">
        								    <i class="icon ion-md-cube tx-50-f text-primary"></i>
        								</div>
        								<div class="mr-auto">
        								    <h5 class="tx-13 tect-center">کارشناسی محصولات</h5>
        									<h2 class="mb-0 tx-22 mb-1 mt-1 tect-center product-count"><?= (!empty($company_action['products']['access']) && is_array($company_action['products']['access'])?
        									count(array_filter(array_column(array_column(array_column($company_action['products']['access'],'product_info'),'info'),'deleted_at'), function($x) { return empty($x); })):0) ?></h2>
        									<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mx-1"></i>محصولات دارای تخصص</p>
        								</div>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="card">
        			    <div class="card-header pb-0">
        			        <h5>
        			            تعیین محصول برای کارشناس
        			        </h5>
        			        <p>
        			            شما در این بخش می توانید دسترسی محصولات کسب و کار خود را به این همکار بدهید
        			        </p>
        			    </div>
        				<div class="card-body pt-1">
        					<?php if(!empty($company_action['products']['all'])){ ?>
        					    <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
                					<?php
            					    $ar=[];
            					    if(!empty($company_action['products']['access'])){
                					    foreach($company_action['products']['access'] as $a){
                					        if(!empty($a['company_category_product_position_id']) && intval(['company_category_product_position_id'])>0)
                    					        $ar[]=intval($a['company_category_product_position_id']);
                					    }
            					    }
            					    foreach($company_action['products']['all'] as $a){
            					        if(!empty($a) && !empty($a['company_category_product_position_id']) && intval($a['company_category_product_position_id'])>0 && empty($a['product_info']['info']['deleted_at'])){ ?>
            					            <div class="main-mail-item">
            									<div class="">
            										<label class="ckbox">
            										    <input 
            										    onclick="setAccess(this,<?= intval($a['company_category_product_position_id']) ?>,0);"
            										    <?= (in_array(intval($a['company_category_product_position_id']),$ar)?'checked':'') ?> 
            										    type="checkbox"> 
            										    <span></span>
            									    </label>
            									</div>
            									<div class="main-mail-star"></div>
            									<div class="main-img-user">
            									    <img alt="product icon" src="<?= base_url('assets/svg/product/'.(!empty($a['product_info']['info']['icon'])?$a['product_info']['info']['icon']:'product.svg')) ?>">
            									</div>
            									<div class="main-mail-body">
            										<div class="main-mail-from">
            										    <?= (!empty($a['product_info']['info']['title'])?$a['product_info']['info']['title']:(!empty($a['product_info']['info']['key'])?$a['product_info']['info']['key']:'')) ?>
            										</div>
            										<div class="main-mail-subject tx-10-f" style="max-width: 123px;" title="<?= (!empty($a['product_info']['info']['description'])?$a['product_info']['info']['description']:'') ?>">
            										    <?= (!empty($a['product_info']['info']['description'])?$a['product_info']['info']['description']:'') ?>
            										</div>
            									</div>
            									<div class="main-mail-attachment tx-12-f pt-2">
            									    قیمت:
            									    <?= (!empty($a['product_info']['info']['price'])?number_format($a['product_info']['info']['price']).'تومان':'رایگان') ?>
            									</div>
            									<div class="main-mail-date">
            									    <?php if(!empty($a['product_info']['info']['status']) && intval($a['product_info']['info']['status'])>0){  ?>
                									    <span class="badge bg-success-transparent text-success mr-auto ml-1 float-left">
                									        دردسترس
                									    </span>
            									    <?php }else{ ?>
                									    <span class="badge bg-danger-transparent text-danger mr-auto ml-1 float-left">
                									        ناموجود
                									    </span>
            									    <?php } ?>
            									</div>
            								</div>
            					    <?php } 
            					    } ?>
        					    </div>
        					<?php }else{ ?>
        					    <div class="alert alert-danger text-center p-3 rounded-10">
        					        شما محصولی در کسب و کار خود ندارید
        					    </div>
        					<?php } ?>
        				</div>
        			</div>
    		    </span>
    		    <span id="position-control" class="d-none">
        			<div class="row row-sm">
        				<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
        				    <div class="card">
        					    <div class="card-body">
        						    <div class="counter-status d-flex md-mb-0">
        							    <div class="counter-icon bg-primary-transparent px-2 pt-1">
        								    <i class="icon ion-ios-pie tx-50-f text-primary"></i>
        								</div>
        								<div class="mr-auto">
        								    <h5 class="tx-13 tect-center">کارشناسی جایگاه</h5>
        									<h2 class="mb-0 tx-22 mb-1 mt-1 tect-center position-count"><?= (!empty($company_action['positions']['access']) && is_array($company_action['positions']['access'])?
        									count(array_filter(array_column(array_column(array_column($company_action['positions']['access'],'position_info'),'info'),'deleted_at'), function($x) { return empty($x); })):0) ?></h2>
        									<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mx-1"></i>خدمات دارای تخصص</p>
        								</div>
        							</div>
        					    </div>
        					</div>
        				</div>
        			</div>
        			<div class="card">
        			    <div class="card-header pb-0">
        			        <h5>
        			            تعیین جایگاه ارائه خدمات برای کارشناس
        			        </h5>
        			        <p>
        			            شما در این بخش می توانید دسترسی جایگاه های ارائه خدمات کسب و کار خود را به این همکار بدهید
        			        </p>
        			    </div>
        				<div class="card-body pt-1">
        					<?php if(!empty($company_action['positions']['all'])){ ?>
        					    <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
            					    <?php $ar=[];
            					    if(!empty($company_action['positions']['access'])){
                					    foreach($company_action['positions']['access'] as $a){
                					        if(!empty($a['company_category_product_position_id']) && intval(['company_category_product_position_id'])>0)
                    					        $ar[]=intval($a['company_category_product_position_id']);
                					    }
            					    }
            					    foreach($company_action['positions']['all'] as $a){
            					        if(!empty($a) && !empty($a['company_category_product_position_id']) && intval($a['company_category_product_position_id'])>0 && empty($a['position_info']['info']['deleted_at'])){ ?>
            					            <div class="main-mail-item">
            									<div>
            										<label class="ckbox">
            										    <input 
                										onclick="setAccess(this,<?= intval($a['company_category_product_position_id']) ?>,1);"
                										<?= (in_array(intval($a['company_category_product_position_id']),$ar)?'checked':'') ?> 
                										type="checkbox"> 
                										<span></span>
            										</label>
            									</div>
            									<div class="main-mail-star"></div>
            									<div class="main-img-user">
            									    <img alt="position icon" src="<?= base_url('assets/svg/position/'.(!empty($a['position_info']['info']['icon'])?$a['position_info']['info']['icon']:'position.svg')) ?>">
            									</div>
            									<div class="main-mail-body">
            										<div class="main-mail-from">
            										    <?= (!empty($a['position_info']['info']['title'])?$a['position_info']['info']['title']:'') ?>
            										</div>
            										<div class="main-mail-subject tx-10-f" style="max-width: 123px;" title="<?= (!empty($a['position_info']['info']['description'])?$a['position_info']['info']['description']:'') ?>">
            										    <?= (!empty($a['position_info']['info']['description'])?$a['position_info']['info']['description']:'') ?>
            										</div>
            									</div>
            									<div class="main-mail-attachment tx-12-f pt-2">
            									    قیمت:
            									    <?= (!empty($a['position_info']['info']['price'])?number_format($a['position_info']['info']['price']).'تومان':'رایگان') ?>
            									</div>
            									<div class="main-mail-date">
            									    <?php if(!empty($a['position_info']['info']['status']) && intval($a['position_info']['info']['status'])>0){  ?>
                									    <span class="badge bg-success-transparent text-success mr-auto ml-1 float-left">
                									        دردسترس
                									    </span>
            									    <?php }else{ ?>
                									    <span class="badge bg-danger-transparent text-danger mr-auto ml-1 float-left">
                									        مشغول
                									    </span>
            									    <?php } ?>
            									</div>
            								</div>
            					    <?php } 
            					    } ?>
        					    </div>
        					<?php }else{ ?>
        					    <div class="alert alert-danger text-center p-3 rounded-10">
        					        شما جایگاهی برای ارائه خدمات در کسب و کار خود ندارید
        					    </div>
        					<?php } ?>
        				</div>
        			</div>
    		    </span>
		    <?php } ?>
		</div>
	</div>
	<div class="d-none" id="edit-role">
        <div class="modal d-block" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">ویرایش نوع همکاری</h6>
                        <button onclick="hideEditRole();" aria-label="بستن" class="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                    <p class="text-center">
                                        در این بخش می توانید موقعیت شغلی این همکار را تغییر دهید
                                    </p>
                                </div>    
                            <div class="card-body">
                                    <hr>
                                    <div class="row mt-2">
                                        <div class="col-8 mx-auto text-center">
                                            <?php if(!empty($roles) && is_array($roles)){ ?>
                                                <label for="role-chooser">
                                                    موقعیت شغلی مورد نیاز کدام است
                                                </label>
                                                <select id="role-id" class="form-control SlectBox SumoUnder shadow-light rounded-10" tabindex="-1">
                                                    <option value="0" >انتخاب کنید</option>
                                                    <?php
                                                    foreach($roles as $a){ 
                                                        if(!empty($a) && !empty($a['id']) && !empty($a['title'])){
                                                            if(intval($a['id'])>8){ ?>
                                                                <option <?= (trim($a['title'])==trim($role)?'selected':'') ?> value="<?= $a['id'] ?>"><?= $a['title'] ?></option>
                                                            <?php }
                                                        } 
                                                    } ?>
            						    		</select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-50" onclick="editRoleAction();">
                            ویرایش همکاری
                        </a>
                        <a class="btn btn-danger-gradient btn-block rounded-10 p-2 w-50" onclick="expaierRoleAction();">
                            ارجاع به کارگزینی  
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script>
	    function changeTypeMode(el,iB,id,iI){
	        $(el).addClass('btn-success');
	        $(el).removeClass('btn-info');
	        $(iB).removeClass('btn-success');
	        $(iB).addClass('btn-info');
	        $(id).removeClass('d-none');
	        $(iI).addClass('d-none');
	        return true;
	    }
	    function setAccess(el,ccppId,isPos){
	        let s=0;
	        if(el.checked) s=1;
	        if(isPos>0){
	            $('.position-count').text($(el).parent().parent().parent().parent().find('input:checkbox:checked').length);
	        }else{
    	        $('.product-count').text($(el).parent().parent().parent().parent().find('input:checkbox:checked').length);
	        }
	        sendAjax({cuId:<?= (!empty($company_user_id) && intval($company_user_id)>0?intval($company_user_id):0) ?>,ccppId:ccppId,isPos:isPos,status:s},baseUrl('company/company/check_company_access'),'');
	        return true;
	    }
	    function editRole(){
	        $('#edit-role').removeClass('d-none');
	    }
	    function hideEditRole(){
	        $('#edit-role').addClass('d-none');
	    }
	    function expaierRoleAction(){
    	    sendAjax({cuId:<?= (!empty($company_user_id) && intval($company_user_id)>0?intval($company_user_id):0) ?>},baseUrl('company/company/expier_user'),'');
	    }
	    function editRoleAction(){
	        let r=$('#role-id').val();
	        if(r!=='' && r!==0 && r!=='0'){
	            $('#role-id').removeClass('border-danger');
    	        sendAjax({
    	            rId:r,
    	            cuId:<?= (!empty($company_user_id) && intval($company_user_id)>0?intval($company_user_id):0) ?>,
    	            cId:<?= (!empty($company_id) && intval($company_id)>0?intval($company_id):0) ?>
    	        },baseUrl('company/company/edit_user'),'');
	        }else{
	            $('#role-id').addClass('border-danger');
	            return not1();
	        }
	        return true;
	    }
	</script>
<?php } ?>