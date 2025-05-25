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
        			        <a href="<?= base_url('company_promotions') ?>" style="text-align:start;" class="active nav-link">
        			            <i class="icon ion-md-cube mx-1"></i>
							    بسته ها
            				</a>
        			        <a href="<?= base_url('company_promotion_order') ?>" style="text-align:start;" class="nav-link">
            				    <span class="pulse-danger mr-0 d-none" id="alertBuyLogError" style="position: relative"></span>
            				    <span class="pulse mr-0 d-none" id="alertBuyLog" style="position: relative"></span>
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
        <div class="col-xl-8 col-lg-8 col-md-12">
			<div class="row row-sm">
			    <?php if(!empty($paks) && is_array($paks)){ 
			        foreach($paks as $a){
			            if(!empty($a) && !empty($a['id']) && intval($a['id'])>0){ ?>
            			    <div class="col-md-6 col-lg-6 col-xl-4 col-sm-10">
            				    <div class="card">
            					    <div class="card-body">
            						    <div class="pro-img-box">
            							    <img class="w-100" style="border:none !important; max-height:250px" src="<?= base_url('assets/svg/package/'.(!empty($a['logo'])?$a['logo']:'package.svg')) ?>" alt="تصویر محصول">
            							</div>
            							<div class="text-center">
            							    <h3 class="h6 mb-3 font-weight-bold text-uppercase">
            							        <?= (!empty($a['title'])?$a['title']:'') ?>
            							    </h3>
            								<span class="tx-15 ml-auto">
            								    <?= (!empty($a['description'])?$a['description']:'') ?>
            								</span>
            								<hr>
                        					<a onclick="buyPak(<?= intval($a['id']) ?>);" class="adtocart f-left" style="position: static;">
            								    <i class="las la-shopping-cart "></i>
            								</a>
                        					<div>
                        					    قیمت بسته
                        					</div>
            								<h4 class="tx-15 my-2 text-center font-weight-bold text-danger">
            								    <?= (!empty($a['price']) && intval($a['price'])>0?number_format($a['price']).' تومان':'رایگان') ?>  
            								</h4>
            							</div>
            						</div>
            					</div>
            				</div>
				<?php   }
			        }
				} ?>
			</div>
		</div>
    </div>
    <script>
        function buyPak(pakId){
            sendAjax({pakId:pakId,cId:<?= intval($company_id) ?>},baseUrl('company/dashbord/buy_pak'),'');
            return true;
        }
    </script>
<?php } ?>