<?php 
$date=new JDF(); ?>
<!--tarakonesh mali-->
<?php if(!empty($wallet) && is_array($wallet)){
    $w=array_reverse($wallet);?>
    <div class="row row-sm my-2">
        <div class="col-12 bd-b bd-primary mb-3 pb-1">
            <h5 class="text-center">
                جزئیات تراکنش های 
                <a class="text-success" href="<?= base_url('wallet') ?>">
                    کیف پول
                </a>
            </h5>
        </div>
		<?php foreach($w as $b){
		    if(!empty($b) && !empty($b['info'])){
		        $a=$b['info']; ?>
    			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
    				<div class="card">
    					<div class="card-body p-3">
    						<div class="card-widget">
    						    <h4 class="text-right">
        					        موجودی فعلی : 
        						    <span class="float-left">
                						<?= (!empty($a['value']) && intval($a['value'])>0?number_format($a['value']):0) ?>
                						تومان
        						    </span>
        					    </h4>
        					    <br>
        						<h6 class="text-right">
        						    موجودی قبلی :
    						        <span class="float-left">
    	    					        <?= (!empty($a['old_value']) && intval($a['old_value'])>0?number_format($a['old_value']):0) ?>
        						        تومان
    						        </span>
        					    </h6>
        					    <p class="text-right">
            						<span class="badge badge-<?= (!empty($a['change_value']) && intval($a['change_value'])>0?'success':
            						((!empty($a['change_value']) && intval($a['change_value'])<0)?'danger':'secondary')) ?>">
            						    میزان تغییرات :
            						    <?= (!empty($a['change_value'])?number_format($a['change_value']):0) ?>
            						    تومان
            						</span>
            						<?php if(!empty($b['detailes'])){ ?>
                						<a onclick="showWalletDetails(this);" class="sWd float-left btn pd-x-5 pd-y-2 rounded-5 btn-info-gradient tx-9-f detailes-payment">جزییات</a>
                                        <a onclick="hideWalletDetails(this);" class="hWd d-none float-left btn pd-x-5 pd-y-2 rounded-5 btn-danger-gradient tx-9-f detailes-payment">بستن</a>
                                    <?php } ?>
        					    </p>
        					    <?php if(!empty($b['detailes'])){ ?>
        					        <div class="d-none details w-100">
        					            <?php if(!empty($b['detailes']['payment']) && is_array($b['detailes']['payment']) && 
        					            ($p=$b['detailes']['payment'])!==false && !empty($p['user_id']) && intval($p['user_id'])>0){
                    					    if(!empty($p['user_id_seller']) && is_array($p['user_id_seller']) &&
                    					    !empty($p['user_id_seller']['id']) && intval($p['user_id_seller']['id'])>0){
                    					        if(intval($p['user_id_seller']['id'])==intval($p['user_id'])){ 
                    					            if(!empty($p['user_id_buier']) && is_array($p['user_id_buier'])){ ?>
                    					                <h5 class="text-center">
                        					                خرید مشتری درون برنامه
                    					                </h5>
                    					                <p class="text-right">
                                                            به مبلغ
                                                            <span class="float-left">
                                                                <?= (!empty($p['pay_value'])?number_format($p['pay_value']):'') ?>تومان
                                                            </span>
                                                        </p>
                                                        <h6 class="text-center">
                                                            مشتری
                                                        </h6>
                                                        <p class="text-right">
                                                            <img class="rounded wd-45" src="<?= (!empty($p['user_id_buier']['info']['image'])?$p['user_id_buier']['info']['image']:base_url('assets/svg/user/user.svg')) ?>" >
                                                            <span class="float-left">
                        					                    <?= (!empty($p['user_id_buier']['info']['name'])?$p['user_id_buier']['info']['name']:'') ?>
                        					                    <?= (!empty($p['user_id_buier']['info']['family'])?$p['user_id_buier']['info']['family']:'') ?>
                        					                    <!--<?= (!empty($p['user_id_buier']['info']['phone'])?$p['user_id_buier']['info']['phone']:'') ?>-->
                        					                    <!--<?= (!empty($p['user_id_buier']['info']['gmail'])?$p['user_id_buier']['info']['gmail']:'') ?>-->
                        					                    
                                                            </span>
                                                        </p>
                    					            <?php }else{ ?>
                        					            <h5 class="text-center">
                        					                افزودن موجودی کیف پول
                        					            </h5>
                            					        <p class="text-right">
                                                            به مبلغ
                                                            <span class="float-left">
                                                                <?= (!empty($p['pay_value'])?number_format($p['pay_value']):'') ?>تومان
                                                            </span>
                                                        </p>
                                                        <p class="text-right">
                                                            رسید پرداخت
                                                            <span class="float-left">
                                                                <?= (!empty($p['factor_api_token']) && is_string($p['factor_api_token'])?trim($p['factor_api_token']):'') ?>
                                                            </span>
                                                        </p>
                    					        <?php }
                    					        }else{ 
                    					            if(!empty($p['user_id_buier']) && is_array($p['user_id_buier']) &&
                    					            !empty($p['user_id_buier']['id']) && intval($p['user_id_buier']['id'])>0 &&
                    					            intval($p['user_id_buier']['id'])==intval($p['user_id'])){ ?>
                        					            خرید محصول در جایگاه ها
                        					            <p class="text-right">
                                                            به مبلغ
                                                            <span class="float-left">
                                                                <?= (!empty($p['pay_value'])?number_format($p['pay_value']):'') ?>تومان
                                                            </span>
                                                        </p>
                                                        <h6 class="text-center">
                                                            فروشنده
                                                        </h6>
                                                        <p class="text-right">
                                                            <img class="rounded wd-45" src="<?= (!empty($p['user_id_seller']['info']['image'])?$p['user_id_seller']['info']['image']:base_url('assets/svg/user/user.svg')) ?>" >
                                                            <span class="float-left">
                        					                    <?= (!empty($p['user_id_seller']['info']['name'])?$p['user_id_seller']['info']['name']:'') ?>
                        					                    <?= (!empty($p['user_id_seller']['info']['family'])?$p['user_id_seller']['info']['family']:'') ?>
                        					                    <!--<?= (!empty($p['user_id_seller']['info']['phone'])?$p['user_id_seller']['info']['phone']:'') ?>-->
                        					                    <!--<?= (!empty($p['user_id_seller']['info']['gmail'])?$p['user_id_seller']['info']['gmail']:'') ?>-->
                        					                    
                                                            </span>
                                                        </p>
                    					        <?php }
                    					        }
                    					    }else{
                    					        if(!empty($p['user_id_buier']) && is_array($p['user_id_buier']) &&
                    					        !empty($p['user_id_buier']['id']) && intval($p['user_id_buier']['id'])>0 &&
                    					        intval($p['user_id_buier']['id'])==intval($p['user_id'])){ ?>
                    					            <h5 class="text-center">
                        					            تسویه حساب
                    					            </h5>
                    					            <p class="text-right">
                                                        به مبلغ
                                                        <span class="float-left">
                                                            <?= (!empty($p['pay_value'])?number_format($p['pay_value']):'') ?>تومان
                                                        </span>
                                                    </p>
                    					        <?php }
                    					    }
        					            }
        					            if(!empty($b['detailes']['type']) && intval($b['detailes']['type'])>0){
            					            if(!empty($b['detailes']['cart_info']) && is_array($b['detailes']['cart_info']) &&
            					            !empty($b['detailes']['cart_info']['id']) && intval($b['detailes']['cart_info']['id'])>0 &&
            					            !empty($b['detailes']['cart_info']['cart_number'])){ ?>
                                                <p class="text-right">
                                                    وضعیت
                                                    <span class="float-left">
                                                        <?= (!empty($b['detailes']["action"]) && intval($b['detailes']["action"])>0?'تسویه شد':'در انتظار پاسخ بانک') ?>
                                                    </span> 
                                                </p>
                                                <p class="text-right">
                                                    شماره حساب
                                                    <span class="float-left">
                                                        <?= $b['detailes']['cart_info']['cart_number'] ?>
                                                    </span>
                                                </p>
                                                <p class="text-right d-none">
                                                    توضیحات حساب
                                                    <span class="float-left">
                                                        <?= (!empty($b['detailes']['cart_info']['cart_info']) && is_string($b['detailes']['cart_info']['cart_info'])?$b['detailes']['cart_info']['cart_info']:'') ?>
                                                    </span>
                                                </p>
        					               <?php }
        					            }
        					            if(!empty($b['detailes']['position']) && is_array($b['detailes']['position'])){ ?>
            					            <h6 class="text-center">
                                                اطلاعات جایگاه
                                            </h6>
                                            <p class="text-right">
                                                <img class="rounded wd-45" src="<?= base_url('assets/svg/position/'.(!empty($b['detailes']['position']['icon'])?$b['detailes']['position']['icon']:'position.svg')) ?>" >
                                                <span class="float-left">
                        					        <?= (!empty($b['detailes']['position']['title'])?$b['detailes']['position']['title']:'') ?>
                                                </span>
                                            </p>
                                            <p class="text-right">
                                                نوع
                                                <span class="float-left">
                        					        <?= (!empty($b['detailes']['position']['position_type']) && intval($b['detailes']['position']['position_type'])>0?'مجازی':'حضوری') ?>
                                                </span>
                                            </p>
            					            <p class="text-right">
                                                توضیحات جایگاه
                                                <span class="float-left">
                    					            <?= (!empty($b['detailes']['position']['description'])?$b['detailes']['position']['description']:'') ?>
                                                </span>
                                            </p>
                                            <p class="text-right">
                                                قیمت
                                                <span class="float-left">
                        					        <?= (!empty($b['detailes']['position']['price'])?number_format($b['detailes']['position']['price']):0) ?> تومان در هر ساعت
                                                </span>
                                            </p>
        					            <?php }
        					            if(!empty($b['detailes']['product']) && is_array($b['detailes']['product'])){ ?>
            					            <h6 class="text-center">
                                                اطلاعات محصول
                                            </h6>
                                            <p class="text-right">
                                                <img class="rounded wd-45" src="<?= base_url('assets/svg/product/'.(!empty($b['detailes']['product']['icon'])?$b['detailes']['product']['icon']:'product.svg')) ?>" >
                                                <span class="float-left">
                        					        <?= (!empty($b['detailes']['product']['title'])?$b['detailes']['product']['title']:(!empty($b['detailes']['product']['key'])?$b['detailes']['product']['key']:'')) ?>
                                                </span>
                                            </p>
            					            <p class="text-right">
                                                توضیحات محصول
                                                <span class="float-left">
                    					            <?= (!empty($b['detailes']['product']['description'])?$b['detailes']['product']['description']:'') ?>
                                                </span>
                                            </p>
                                            <p class="text-right">
                                                قیمت
                                                <span class="float-left">
                        					        <?= (!empty($b['detailes']['product']['price'])?number_format($b['detailes']['product']['price']):'') ?> تومان
                                                </span>
                                            </p>
        					            <?php }
        					            if(!empty($b['detailes']['package']) && is_array($b['detailes']['package'])){ ?>
        					                <h6 class="text-center">
                                                اطلاعات پکیج
                                            </h6>
                                            <p class="text-right">
                                                <img class="rounded wd-45" src="<?= base_url('assets/svg/package/'.(!empty($b['detailes']['package']['logo'])?$b['detailes']['package']['logo']:'package.svg')) ?>" >
                                                <span class="float-left">
                					                <?= (!empty($b['detailes']['package']['title'])?$b['detailes']['package']['title']:'') ?>
                        					    </span>
                                            </p>
                                            <p class="text-right">
                                                توضیحات پکیج
                                                <span class="float-left">
                    					            <?= (!empty($b['detailes']['package']['description'])?$b['detailes']['package']['description']:'') ?>
                                                </span>
                                            </p>
                                            <p class="text-right">
                                                قیمت
                                                <span class="float-left">
                        					        <?= (!empty($b['detailes']['package']['price'])?number_format($b['detailes']['package']['price']):'') ?> تومان
                                                </span>
                                            </p>
        					            <?php } ?>
        					        </div>
        					    <?php } ?>
    						</div>
    					</div>
                        <div class="card-footer p-2 text-center bg-<?= (!empty($a['change_value']) && intval($a['change_value'])>0?'success':
            			((!empty($a['change_value']) && intval($a['change_value'])<0)?'danger':'primary')) ?>-gradient">
        					<p class="tx-11-f text-mute m-0">
        					    در تاریخ
        						<?= (!empty($a['time']) && is_string($a['time'])>0?$date->jdate('h:i Y/m/d',strtotime($a['time'])):'') ?>
        				    </p>
                        </div>
    				</div>
    		    </div>
	    <?php } 
	    } ?>
	</div>
	<script>
	    function showWalletDetails(el){
	        $(el).parent().parent().find('.details').removeClass('d-none');
	        $(el).addClass('d-none');
	        $(el).parent().find('.hWd').removeClass('d-none');
	        return true;
	    }
	    function hideWalletDetails(el){
	        $(el).parent().parent().find('.details').addClass('d-none');
	        $(el).addClass('d-none');
	        $(el).parent().find('.sWd').removeClass('d-none');
	        return true;
	    }
	</script>
<?php }else{ ?>
    <div class="row row-sm my-2">
        <div class="col-12 bd-b bd-primary mb-3 pb-1">
            <div class="alert alert-danger p-4 rounded-10 text-center">
                <a class="text-success" href="<?= base_url('add_wallet_value') ?>">
                    شما تراکنشی ندارید برای افزودن مبلغ به کیف پول خود کلیک کنید
                </a>
            </div>
        </div>
    </div>
<?php } ?>
<!--tarakonesh mali-->