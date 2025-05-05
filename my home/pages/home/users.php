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
    		    <?php if( !empty($data)){ $date=new JDF(); ?> 
    		        <h3 class="text-center">کاربران</h3>
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
                		    <?php foreach($data as $a){
                		        if(!empty($a) && !empty($a['id']) && intval($a['id'])>0){ ?>
                    		        <tr style="border-bottom: 1px solid grey;height: 60px;">
                    		            <td title="<?= (!empty($a['birthday'])?$date->jdate('Y/m/d',$a['birthday']):'') ?>">
                                           <img class="ht-70 rounded-10" src="<?= (!empty($a['image'])?$a['image']:base_url('assets/svg/user/user.svg')) ?>">
                    		            </td>
                    		            <td title="<?= (!empty($a['gmail'])?$a['gmail']:'') ?>">
        		                            <?= (!empty($a['name'])?$a['name']:'') ?> <?= (!empty($a['family'])?$a['family']:'') ?>
                    		            </td>
                    		            <td class="cart-mely-code">
                                            <?= (!empty($a['mely_code'])?$a['mely_code']:'') ?>
                    		            </td>
                    		            <td title="<?= (!empty($a['address'])?$a['address']:'') ?>">
                                            <?= (!empty($a['posty_code'])?$a['posty_code']:'') ?>
                    		            </td>
                    		            <td class="cart-mely-picture">
                    		                <img class="ht-70 rounded-10" src="<?= base_url('assets/svg/user/'.(!empty($a['cart_mely_picture'])?$a['cart_mely_picture']:'cart-mely.svg')) ?>">
                    		            </td>
    		                            <td>
                                            <?php if(!empty($a['cart_mely_picture'])){ ?>
                                                <a onclick="deleteCartPic(this,<?= intval($a['id']) ?>);" title="حذف عکس کارت ملی">
                                                    <i class="si si-trash tx-20-f text-warning"></i>
                                                </a>
                                            <?php } if(!empty($a['mely_code'])){ ?>
                                                <a onclick="deleteCartCode(this,<?= intval($a['id']) ?>);" title="حذف کد ملی">
                                                    <i class="la la-trash tx-20-f text-primary"></i>
                                                </a>
                                            <?php }  if(!empty($a['phone'])){ ?>
                                                <a href="tel:<?= $a['phone'] ?>">
                                                    <i class="si si-call-end tx-20-f text-success"></i>
                                                </a>
                                            <?php } if(!empty($a['home_tel'])){ ?>
                                                <a href="tel:<?= $a['home_tel'] ?>">
                                                    <i class="la la-home tx-20-f text-primary"></i>
                                                </a>
                                            <?php } if(intval($a['user_id'])!==1){ ?>
        		                                <a class="disable <?= (!empty($a['user_status'])&&intval($a['user_status'])>0?'':'d-none') ?>" onclick="diableUser(this,<?= intval($a['user_id']) ?>);">
                                                    <i class="fas fa-ban tx-20-f text-danger"></i>
                                                </a>
                                                <a class="enable <?= (!empty($a['user_status'])&&intval($a['user_status'])>0?'d-none':'') ?>" onclick="enableUser(this,<?= intval($a['user_id']) ?>);">
                                                    <i class="far fa-check-circle tx-20-f text-success"></i>
                                                </a>
                                            <?php } ?>
    		                            </td>
    		                        </tr>
                    		        
    		                    <?php }
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
    function deleteCartPic(el,id){
        $(el).parent().parent().find('.cart-mely-picture').html('');
        sendAjax({id:id},baseUrl('users/dashbord/disable_cart_pic'),'');
        $(el).remove();
    }
    function deleteCartCode(el,id){
        $(el).parent().parent().find('.cart-mely-code').text('');
        sendAjax({id:id},baseUrl('users/dashbord/disable_cart_code'),'');
        $(el).remove();
    }
    function diableUser(el,id){
        $(el).addClass('d-none');
        $(el).parent().find('.enable').removeClass('d-none');
        sendAjax({id:id},baseUrl('users/dashbord/disable'),'');
        return true; 
    }
    function enableUser(el,id){
        $(el).addClass('d-none');
        $(el).parent().find('.disable').removeClass('d-none');
        sendAjax({id:id},baseUrl('users/dashbord/enable'),'');
        return true;
    }
</script>