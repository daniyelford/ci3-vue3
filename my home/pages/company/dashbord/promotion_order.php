<?php $date=new JDF();
if(!empty($company_user_id) && intval($company_user_id)>0 && !empty($company_id) && intval($company_id)>0){ ?>
    <style>
        .b-d{
                border: 1px solid #ee335e !important;
        }
    </style>
    <div class="row row-sm mt-3">
    	<div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
    		<div class="card mg-b-20">
        		<div class="main-content-left main-content-left-mail card-body">
        			<div class="main-mail-menu">
        			    <nav class="nav main-nav-column mg-b-20">
        			        <a href="<?= base_url('company_promotions') ?>" style="text-align:start;" class="nav-link">
        			            <i class="icon ion-md-cube mx-1"></i>
            				    <span class="pulse-danger mr-0 d-none" id="alertBuyLogError" style="position: relative"></span>
            				    <span class="pulse mr-0 d-none" id="alertBuyLog" style="position: relative"></span>
							    بسته ها
            				</a>
        			        <a href="<?= base_url('company_promotion_order') ?>" style="text-align:start;" class="active nav-link">
        			            <i class="las la-shopping-cart mx-1"></i>
            				    سفارش ها
            				</a>
        			    </nav>
        			    <?php if(!empty($wallet) && is_array($wallet)){ ?>
            			    <label class="main-content-label main-content-label-sm">موجودی</label>
            			    <nav class="nav main-nav-column mg-b-20">
            			        <li class="nav-list text-center">
                			    <?= (!empty($wallet['value']) && intval($wallet['value'])>0?number_format($wallet['value']):0) ?>
                		        تومان
                		        </li>
            			    </nav>
        				<?php } ?>
        				<nav class="nav main-nav-column mg-b-20">
            				<a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('wallet') ?>">
							    <i class="bx bx-dollar mx-1"></i>کیف پول
            				</a>
        			        <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('add_wallet_value') ?>">
            				    <span class="pulse-danger mr-0 d-none" id="addValueLogError" style="position: relative"></span>
            				    <i class="bx bx-plus mx-1"></i>
            				    افزایش اعتبار  
            				</a>
            				<a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('wallet_payment') ?>">
            				    <i class="bx bx-pulse mx-1"></i>
            				    تراکنش ها  
            				</a>
        				</nav>
    					<label class="main-content-label main-content-label-sm">دسترسی سریع</label>
    					<nav class="nav main-nav-column">
    					    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('company_one') ?>">
    					        <i class="bx bx-folder-open mx-1"></i>
    					        کسب و کار مربوط</a>
    					    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('company_manager') ?>">
    					        <i class="bx bx-slider-alt mx-1"></i>
    					        همه کسب و کارها
    					    </a>
    					    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url() ?>">
    					        <i class="la la-home mx-1"></i>
    					        خانه
    					    </a>
    					</nav>
    			    </div>
    		    </div>
    	    </div>
    	</div>
		<div class="col-xl-8 col-lg-8 col-md-12" id="orders">
			<div class="row row-sm">
			    <?php if(!empty($order) && is_array($order)){ 
			        foreach($order as $a){
			            if(!empty($a) && !empty($a['id']) && intval($a['id'])>0 && !empty($a['package']) && intval($a['package'])){
			                if(!empty($paks) && is_array($paks)){
			                    foreach($paks as $b){
			                        if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && intval($b['id'])==intval($a['package'])){ ?>
                        			    <div class="col-md-6 col-lg-6 col-xl-4 col-sm-10">
                        				    <div class="card">
                        					    <div class="card-body">
                        						    <div class="pro-img-box">
                        							    <div class="d-flex product-sale">
                        								    <div class="badge <?= (!empty($a['factor'])?(!empty($a['end_time']) && strtotime($a['end_time'])>time()?'bg-success':'bg-warning'):'bg-pink') ?>">
                        								        <?= (!empty($a['factor'])?(!empty($a['end_time']) && strtotime($a['end_time'])>time()?
                        								        'خریداری شده': 
                        								        'منقضی شده'
                        								        ):
                        								        'خریداری نشده'
                        								        ) ?>
                        								    </div>
                        								</div>
                        							    <img class="w-100" style="border:none !important; max-height:250px" src="<?= base_url('assets/svg/package/'.(!empty($b['logo'])?$b['logo']:'package.svg')) ?>" alt="تصویر محصول">
                        								<?php if(empty($a['factor'])){ ?>
                            								<a onclick="pay(<?= intval($b['id']).','.intval($a['id']) ?>);" class="adtocart f-left" style="background: darkgreen !important;position:static;">
                            								    <i class="si si-credit-card tx-30"></i>
                            								</a>
                            								<div class="pt-2">
                            							        پرداخت : 
                            								</div>
                        								<?php }else{
                        								    if(!(!empty($a['end_time']) && strtotime($a['end_time'])>time())){ ?>
                                								<a onclick="pay(<?= intval($b['id']).','.intval($a['id']) ?>);" class="adtocart f-left" style="background: darkgoldenrod !important;position:static;">
                                								    <i class="si si-credit-card tx-30"></i>
                                								</a>
                                								<div class="pt-2">
                            								        تمدید :
                            								    </div>
                        								<?php }
                        								} ?>
                        							</div>
                        							<br>
                        							<div class="text-center pt-3">
                        							    <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">
                        							        <?= (!empty($b['title'])?$b['title']:'') ?>
                        							    </h3>
                        								<span class="tx-15 ml-auto">
                        								    <?= (!empty($b['description'])?$b['description']:'') ?>
                        								</span>
                        								<hr>
                        								<div style="text-align: right;">
                            								<a onclick="showDetailPayment(this);" class="showDetailPayment f-left badge bg-success">
                            								    مشاهده جزئیات
                            								</a>
                            								<a onclick="hideDetailPayment(this);" class="hideDetailPayment f-left badge bg-danger d-none">
                            								    بستن جزئیات
                            								</a>
                        								    قیمت بسته
                        								    <br>
                            								<span class="tx-15 my-2 text-center font-weight-bold text-danger">
                            								    <?= (!empty($b['price']) && intval($b['price'])>0?number_format($b['price']).' تومان':'رایگان') ?>  
                            								</span>
                        								</div>
                        								<span class="payment-detail d-none">
                        								    <hr>
                            								<?php if(!empty($a['factor']) && !empty($a['payment']) && intval($a['payment'])>0){ ?>
                                								<div>
                                								    مبلغ پرداخت شده
                                								    <br>
                                    								<?= (!empty($b['price']) && intval($b['price'])>0?number_format($b['price']).' تومان':'رایگان') ?>  
                                								</div>
                                								<hr>
                            								<?php } if(!empty($a['end_time'])){ ?>
                                								<div>
                                						    		تاریخ انقضای بسته
                                						    		<br>
                                						    		<?= $date->jdate('Y/m/d',strtotime($a['end_time'])) ?>
                                								</div>
                            								<hr>
                            								<?php } ?>
                            								<div class="tx-15 ml-auto">
                            						    		زمان سفارش
                            						    		<br>
                            						    		<?= (!empty($a['time'])?$date->jdate('Y/m/d H:i',strtotime($a['time'])):'') ?>
                            								</div>
                        								</span>
                        							</div>
                        						</div>
                        					</div>
                        				</div>
				<?php               }
			                        
			                    }
			                    
			                }
			                
			            }
			        }
				}else{ ?>
			        <div class="alert alert-danger rounded-10 text-center p-3">
    				    شما هیچ سفارشی را ثبت نکرده اید
			        </div>
				<?php } ?>
			</div>
		</div>
    </div>
    <script>
        function pay(pId,oId){
            sendAjax({pId:pId,oId:oId,cId:<?= intval($company_id) ?>},baseUrl('company/dashbord/pay'),'');
            return true;
        }
        function showDetailPayment(el){
            $(el).parent().parent().find('.payment-detail').removeClass('d-none');
            $(el).addClass('d-none');
            $(el).parent().find('.hideDetailPayment').removeClass('d-none');
            return true;
        }
        function hideDetailPayment(el){
            $(el).parent().parent().find('.payment-detail').addClass('d-none');
            $(el).addClass('d-none');
            $(el).parent().find('.showDetailPayment').removeClass('d-none');
            return true;
        }
    </script>
<?php } ?>