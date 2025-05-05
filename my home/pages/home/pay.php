<div class="row row-sm mt-3">
    <div class="col-lg-4">
        <div class="card mg-b-20">
    	    <div class="card-body text-center">
    		    <div class="pl-0">
    			    <div class="main-profile-overview">
    				    <hr class="mg-y-10">
						<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
						<div class="row">
                            <div class="col-12 mt-1">
                                <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('wallet') ?>">
                				    <i class="bx bx-folder-open mx-1"></i>
                					کیف پول
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
        <div class="card">
    	    <div class="card-body" style="max-height: 400px;overflow: auto;">
    		    <?php if(!empty($data) && !empty($user_data)){ 
    		    $date=new JDF(); ?> 
    		        <h3 class="text-center">درخواست های برداشت</h3>
                    <table class="w-100d text-center " id="manager-category-parent-id-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                		    <?php foreach(array_reverse($data) as $a){
                		        if(!empty($a) && !empty($a['pay']) && !empty($a['cart']) && !empty($a['pay_wallet_id']) && intval($a['pay_wallet_id'])>0 &&
                		        !empty($a['pay']["id"]) && intval($a['pay']["id"])>0 && !empty($a['cart']["cart_number"]) && intval($a['cart']["cart_number"])>0 && !empty($a['cart']["user_id"]) && intval($a['cart']["user_id"])>0){ 
                		            foreach(array_reverse($user_data) as $b){
                		                if(!empty($b) && !empty($b['user_id']) && intval($b['user_id'])>0 && intval($b['user_id'])==intval($a['cart']["user_id"])){ ?>
                		                    <tr style="border-bottom: 1px solid grey;height: 60px;">
                                		        <td title="<?= (!empty($b['birthday'])?$date->jdate('Y/m/d',$b['birthday']):'') ?>">
                                                    <img class="ht-70 rounded-10" src="<?= (!empty($b['image'])?$b['image']:base_url('assets/svg/user/user.svg')) ?>">
                                		        </td>
                                		        <td title="<?= (!empty($b['mely_code'])?$b['mely_code']:'') ?>">
                    		                        <?= (!empty($b['name'])?$b['name']:'') ?> <?= (!empty($b['family'])?$b['family']:'') ?>
                                		        </td>
                                		        <td class="<?= (!empty($a['cart']["status"]) && intval($a['cart']["status"])>0?'text-success':'text-danger') ?>" title="<?= (!empty($a['cart']["cart_info"])?$a['cart']["cart_info"]:'') ?>">
                                                    <?= $a['cart']["cart_number"] ?>
                                		        </td>
                                		        <td>
                                		            <?= (!empty($a['pay']["pay_value"])&&intval($a['pay']["pay_value"])?number_format($a['pay']["pay_value"]):0) ?> تومان
                                		        </td>
                                		        <td>
                                		            <?php if(!empty($b['phone'])){ ?>
                                                        <a href="tel:<?= $b['phone'] ?>">
                                                            <i class="si si-call-end tx-20-f text-success"></i>
                                                        </a>
                                                    <?php } if(!empty($b['home_tel'])){ ?>
                                                        <a href="tel:<?= $b['home_tel'] ?>">
                                                            <i class="la la-home tx-20-f text-primary"></i>
                                                        </a>
                                                    <?php } ?>
                		                            <a class="disable <?= (!empty($a['cart_action_status'])&&intval($a['cart_action_status'])>0?'':'d-none') ?>" onclick="diablePayCartUser(this,<?= intval($a['pay_wallet_id']).','.intval($a['pay']["id"]) ?>);">
                                                        <i class="fas fa-ban tx-20-f text-danger"></i>
                                                    </a>
                                                    <a class="enable <?= (!empty($a['cart_action_status'])&&intval($a['cart_action_status'])>0?'d-none':'') ?>" onclick="enablePayCartUser(this,<?= intval($a['pay_wallet_id']).','.intval($a['pay']["id"]) ?>);">
                                                        <i class="far fa-check-circle tx-20-f text-success"></i>
                                                    </a>
                                		        </td>
                    		                </tr>
                    		            <?php }
                    		        }
                    		    } 
                    	    } ?>
    		            </tbody>
    		        </table>
                <?php }else{ ?>
                    <div class="alert alert-danger p-3 rounded-10 text-center">
                        هیچ کاربری وجود ندارد
                    </div>
                <?php } ?>
    	    </div>
        </div>
    </div>
</div>
<script>
    function diablePayCartUser(el,payWalletId,payId){
        $(el).addClass('d-none');
        $(el).parent().find('.enable').removeClass('d-none');
        sendAjax({payWalletId:payWalletId,payId:payId},baseUrl('includes/wallet/disable_pay'),'');
        return true; 
    }
    function enablePayCartUser(el,payWalletId,payId){
        $(el).addClass('d-none');
        $(el).parent().find('.disable').removeClass('d-none');
        sendAjax({payWalletId:payWalletId,payId:payId},baseUrl('includes/wallet/enable_pay'),'');
        return true;
    }
</script>