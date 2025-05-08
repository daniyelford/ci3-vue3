<?php if(!empty($role_id) && intval($role_id)>0){
$date=new JDF(); ?>
    <script src="<?= base_url('assets/js/home/product.js') ?>"></script>
	<div class="row row-sm mt-2">
	    <div class="col-lg-4">
			<div class="card mg-b-20">
			    <div class="card-body text-center">
				    <div class="pl-0">
					    <div class="main-profile-overview">
							<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
							<div class="row">
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
							<div class="row row-sm mt-2">
                        	    <div class="col-md-7 mx-auto">
                                    <img class="w-100 rounded-10" src="<?= base_url('assets/img/brand/logo-white.png') ?>">
                                </div>
                            </div>
					    </div>
				    </div>
			    </div>
		    </div>
		</div>
		<div class="col-lg-8">
		    <?php if(!empty($data)){ ?>
		        <div class="row">
		            <?php foreach($data as $a){ 
		                if(!empty($a) && !empty($a['reserve'])){ ?>
            	    		<div class="col-4 text-center px-1">
                		        <span class="bg-<?= (!empty($a['info']['deleted_at'])?'danger':(!empty($a['info']['status']) && intval($a['info']['status'])>0?'success':'warning')) ?> d-block px-2 rounded-10 pt-2">
                		            <span onclick="productElementsTools(this,'reserve',0);">
                		                 <img class="ht-150 rounded-10" alt="position profile" 
                		                 src="<?= base_url((!empty($a['info']['icon'])?'assets/svg/product/'.$a['info']['icon']:(!empty($a['info']['qr_code'])?'assets/qrcode/'.$a['info']['qr_code']:'assets/svg/product/product.svg'))) ?>">
                        			    <br>
                        			    <span style="padding: 6px;display:inline-block;max-width: 90%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                            			    <?= (!empty($a['info']['title'])?$a['info']['title']:(!empty($a['info']['key'])?$a['info']['key']:'')) ?>
                        			    </span>
                		            </span>
                		        </span>
                		        <div class="show-div-setting col-12">
                		            <div class="reserve d-none">
                    				    <div class="modal d-block">
                                        	<div class="modal-dialog" role="document">
                                        		<div class="modal-content border-0">
                                        		    <div class="modal-header">
                                            		    <a class="btn back-to-product-show-index wd-30 p-0 hd-30" onclick="backproductElementsTools(this,'products',0);">
                                            		        <img class="w-100d h-100d" src="<?= base_url('assets/svg/back.svg') ?>">
                                            		    </a>
                                                    </div>
                                        			<div class="modal-body mx-auto text-center p-7">
                                        			    <div class="row">
                                					        <div class="card">
                                                			    <div class="card-header pb-0">
                                                			        <h5>
                                                			             سفارشات محصول 
                                                			        </h5>
                                                			    </div>
                        				                        <div class="card-body pt-1">
                        				                            <div style="max-height:400px;overflow-y:auto;overflow-x:hidden;">
                                                    				    <?php foreach(array_reverse($a['reserve']) as $res){
                                                    				        if(empty(!$res) && !empty($res['position_user_info'])){ 
                                                                                if(!empty($res['position_user_info']["position_id"]) && intval($res['position_user_info']["position_id"])>0 && !empty($position)){
                                                                            		$parent_pos_info=$position[array_search($res['position_user_info']["position_id"],array_values(array_column($position,'id')))];
                                                                            		$pos_info=$position[array_search($res['position_user_info']["position_id"],array_values(array_column($position,'id')))]['info'];
                                                                            		if(!empty($res['position_user_info']["time_reserve"]) && intval($res['position_user_info']["time_reserve"])>0){
                                                                                        if(!empty($pos_info['price']) && intval($pos_info['price'])>0){
                                                                                            $ex=explode(':',$res['position_user_info']["time_reserve"]);
                                                                                            if(!empty($ex)){
                                                                                                $price=(!empty($ex['0']) && intval($ex['0'])>0?intval($ex['0']*$pos_info['price']):0);
                                                                                                $sum_min=intval($pos_info['price']/60);
                                                                                                $sum_sec=intval($pos_info['price']/3600);
                                                                                                $price+=(!empty($ex['1']) && intval($ex['1'])>0?intval($sum_min*$ex['1']):0);
                                                                                                $price+=(!empty($ex['2']) && intval($ex['2'])>0?intval($sum_sec*$ex['2']):0);
                                                                                            }
                                                                                        }else{
                                                                                            $price=0; 
                                                                                        }
                                                                                    }else{
                                                                                        $price=(!empty($pos_info['price']) && intval($pos_info['price'])>0?intval($pos_info['price']):0);
                                                                                    }
                                                                                    $total_price=$price+($price/10); 
                                                                                } ?>
                                                                                <div>
                                                                                    <div onclick="showProductsInRes(this);" class="list d-flex align-items-center border-bottom p-3">
                                                                                        <?php if(!empty($res['user_reserve_info']['0']['image'])){ ?>
                                                                                            <div>
                                                                                                <img class=" ht-50 rounded-10 " src="<?= $res['user_reserve_info']['0']['image'] ?>">
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                        <div>
                                                                                            <?= (!empty($res['user_reserve_info']['0']['name'])?$res['user_reserve_info']['0']['name']:'').' '.(!empty($res['user_reserve_info']['0']['family'])?$res['user_reserve_info']['0']['family']:'') ?>
                                                                                            <?php if(!empty($res['user_reserve_info']['0']['phone'])){ ?>
                                                                                                <div>
                                                                                                    <a href="tel:<?= $res['user_reserve_info']['0']['phone'] ?>">
                                                                                                        <i class="si si-call-out text-success tx-25-f"></i>
                                                                                                    </a>
                                                                                                </div>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                        <?php if(!empty($pos_info)){ ?>
                                                                                            <div>
                                                                                        	    <span class="avatar bg-dark brround avatar-md">
                                                                                        		    <img src="<?= base_url('assets/svg/position/'.(!empty($pos_info['icon'])?$pos_info['icon']:'position.svg')) ?>">
                                                                                        		</span>
                                                                                        	</div>
                                                                                        	<div class="pr-2">
                                                                                        	    <p class="mb-0">
                                                                                            	    <?= (!empty($pos_info['title'])?$pos_info['title']:'') ?>
                                                                                        		</p>
                                                                                        	</div>
                                                                                        	<div class="pr-2 wapper">
                                                                                        	وضعیت:
                                                                                            <?php if(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==1){ ?>
                                                                                                <small class="tx-8-f text-info">
                                                                                                    مشتری رسیده
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==2){ ?>
                                                                                                <small class="tx-8-f text-warning">
                                                                                                    وجه نقد دریافت کنید
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==3){ ?>
                                                                                                <small class="tx-8-f text-danger">
                                                                                                    پرداخت محصولات کامل نیست
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==4){ ?>
                                                                                                <small class="tx-8-f text-success">
                                                                                                    پرداخت شد
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==5){ ?>
                                                                                                <small class="tx-8-f text-secondary">
                                                                                                    مشکل خدماتی
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==6){ ?>
                                                                                                <small class="tx-8-f text-success">
                                                                                                    اتمام خدمات
                                                                                                </small>
                                                                                            <?php }else{ ?>
                                                                                                <small class="tx-8-f text-warning">
                                                                                                    درانتظار مشتری
                                                                                                </small>
                                                                                            <?php } ?>
                                                                                            <br>
                                                                                            هزینه ی جایگاه:
                                                                                            <?php if(!empty($res['position_user_info']["factor"])){ ?>
                                                                                                <small class="text-success">
                                                                                                    پرداخت شده
                                                                                                </small>
                                                                                            <?php } else{ 
                                                                                                if(!empty($pos_info['price'])){ ?>
                                                                                                    <small class="text-danger">
                                                                                                        پرداخت نشده
                                                                                                    </small>
                                                                                                <?php }else{ ?>
                                                                                                    <small class="text-success">
                                                                                                        رایگان
                                                                                                    </small>
                                                                                                <?php }
                                                                                            } ?>
                                                                                        </div>
                                                                                        <div class="pr-2 wapper">
                                                                                            <small>
                                                                                                قیمت رزرو هر ساعت:<?= (!empty($pos_info['price']) && intval($pos_info['price'])>0?number_format($pos_info['price']).'تومان':'رایگان') ?>
                                                                                            </small>
                                                                                            <small>
                                                                                                قیمت جایگاه با مالیات:<?= (!empty($total_price) && intval($total_price)>0?number_format($total_price).'تومان':'رایگان') ?>
                                                                                            </small>
                                                                                            <br>
                                                                                            <small>
                                                                                                زمان حضور:<?= (!empty($res['position_user_info']["date_reserve"])?$date->jdate('h:i Y/m/d',strtotime($res['position_user_info']["date_reserve"])):'تعیین نشده') ?>
                                                                                            </small>
                                                                                            <br>
                                                                                            <small>
                                                                                                مدت رزرو:<?= (!empty($res['position_user_info']["time_reserve"]) && intval($res['position_user_info']["time_reserve"])>0?$res['position_user_info']["time_reserve"].' ساعت ':'تعیین نشده') ?>
                                                                                            </small>
                                                                                            <br>
                                                                                        </div>
                                                                                    <?php }else{ ?>
                                                                                        <div>
                                                                                            <span class="avatar bg-dark brround avatar-md">
                                                                                        	    <img src="<?= base_url('assets/svg/position/position.svg') ?>">
                                                                                        	</span>
                                                                                        </div>
                                                                                        <div class="pr-2">
                                                                                            <p class="mb-0">
                                                                                                سفارش حضوری
                                                                                        	</p>
                                                                                        </div>
                                                                                        <div class="pr-2 wapper">
                                                                                            <?php if(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==1){ ?>
                                                                                                <small class="tx-8-f text-info">
                                                                                                    مشتری رسیده
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==2){ ?>
                                                                                                <small class="tx-8-f text-warning">
                                                                                                    وجه نقد دریافت کنید
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==3){ ?>
                                                                                                <small class="tx-8-f text-danger">
                                                                                                    پرداخت محصولات کامل نیست
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==4){ ?>
                                                                                                <small class="tx-8-f text-success">
                                                                                                    پرداخت شد
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==5){ ?>
                                                                                                <small class="tx-8-f text-secondary">
                                                                                                    مشکل خدماتی
                                                                                                </small>
                                                                                            <?php }elseif(!empty($res['position_user_info']["status"]) && intval($res['position_user_info']["status"])==6){ ?>
                                                                                                <small class="tx-8-f text-success">
                                                                                                    اتمام خدمات
                                                                                                </small>
                                                                                            <?php }else{ ?>
                                                                                                <small class="tx-8-f text-warning">
                                                                                                    درانتظار مشتری
                                                                                                </small>
                                                                                            <?php } ?>
                                                                                            <br>
                                                                                        </div>
                                                                                        <div class="pr-2 wapper">
                                                                                            <small>
                                                                                                زمان خرید:<?= (!empty($res['position_user_info']["date_reserve"])?$date->jdate('h:i Y/m/d',strtotime($res['position_user_info']["date_reserve"])):'تعیین نشده') ?>
                                                                                            </small>
                                                                                            <br>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                                <div class="order-products d-none">
                                                                                    <?php $show_controll=false;
                                                                                    foreach ($res['position_product_order_info'] as $o) {
                                                                                        if(!empty($o) && intval($o)>0 && intval($a['id'])==intval($o)){
                                                                                            $p_info=$a['info'];
                                                                                            $show_controll=true; ?>
                                                                                                <div class="list-group-item d-flex text-center product-id-<?= 
                                                                                                (!empty($p_info["id"]) && intval($p_info["id"])>0?intval($p_info["id"]):0) ?> 
                                                                                                company-id-<?= (!empty($company['info']['id']) && intval($company['info']['id'])>0?intval($company['info']['id']):0) ?>
                                                                                                position-id-<?= (!empty($pos_info['id']) && intval($pos_info['id'])>0?intval($pos_info['id']):'0') ?> align-items-center">
                                                                                                    <div class="ml-3">
                                                                                                        <span class="avatar avatar-lg brround cover-image" 
                                                                                                        data-image-src="<?=  (!empty($p_info["icon"])?
                                                                                                        base_url('assets/svg/product/'.$p_info["icon"]):
                                                                                                            (!empty($p_info['qr_code'])?base_url('assets/qrcode/'.$p_info['qr_code']):
                                                                                                        base_url('assets/svg/product/product.svg'))) ?>" 
                                                                                                        style="background: url(&quot;<?=  (!empty($p_info["icon"])?
                                                                                                        base_url('assets/svg/product/'.$p_info["icon"]):
                                                                                                            (!empty($p_info['qr_code'])?base_url('assets/qrcode/'.$p_info['qr_code']):
                                                                                                        base_url('assets/svg/product/product.svg'))) ?>&quot;) center center;">
                                                                                                            <span class="avatar-status <?= (!empty($p_info['status']) && intval($p_info['status'])>0?'bg-success':'bg-danger') ?>">
                                                                                                            </span>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    <div style="max-height: 96px;width:100%;text-align:center;">
                                                                                                        <strong>
                                                                                                            <?= (!empty($p_info['title'])?$p_info['title']:
                                                                                                            (!empty($p_info['key'])?$p_info['key']:''))?>
                                                                                                        </strong>
                                                                                                        <br>
                                                                                                        <span style="display:inline-block;max-width: 140px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;margin-bottom: 5px;" title="<?= (!empty($p_info['description'])?$p_info['description']:'') ?>">
                                                                                                            <?= (!empty($p_info['description'])?$p_info['description']:'') ?>
                                                                                                        </span>
                                                                                                        <div class="small text-muted">
                                                                                                            قیمت:<?= (!empty($p_info["price"]) && intval($p_info["price"])>0?number_format($p_info["price"]).'تومان':'رایگان') ?>	
                                                                                                            <br>
                                                                                                            قیمت کل با مالیات:
                                                                                                            <?php $count_new=(!empty($res['position_product_order_info']['count']) && intval($res['position_product_order_info']['count'])>1?intval($res['position_product_order_info']['count']):1);
                                                                                                            $step1=(!empty($p_info["price"]) && intval($p_info["price"])>0?intval($p_info["price"]*$count_new):0);
                                                                                                            $step1=(intval($step1)>0?$step1+($step1*0.1):0);
                                                                                                            echo (intval($step1)>0?number_format($step1).'تومان':'رایگان'); ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="small mr-auto text-muted wd-50-f ml-2">
                                                                                                        <?php if(!empty($res['position_user_info']["status"]['status']) && intval($res['position_user_info']["status"]['status'])>0 && $res['position_user_info']["status"]['status']!==6 && !(!empty($res['position_product_order_info']['status']) && intval($res['position_product_order_info']['status'])>0)&&!empty($res['position_product_order_info']["price"]) && intval($res['position_product_order_info']["price"])>0){ ?>
                                                                                                            <div>
                                                                                                                تعداد:
                                                                                                                <br>
                                                                                                                <input type="number" value="<?= (!empty($res['position_product_order_info']['count']) && intval($res['position_product_order_info']['count'])>1?intval($res['position_product_order_info']['count']):1) ?>" min="0" class="product-count form-control p-0 text-center wd-50" onchange="changeCountOrder(this,<?= (!empty($res['position_product_order_info']['count']) && intval($res['position_product_order_info']['id'])>0?intval($res['position_product_order_info']['id']):0) ?>)">
                                                                                                            </div>
                                                                                                            <a onclick="showPayProduct(this,<?= (!empty($p_info['price']) && intval($p_info['price'])>0?intval($p_info['price']):0) ?>);">
                                                                                                                <img src="<?= base_url('assets/svg/icon/pay.svg') ?>" alt="payment" class="wd-30-f rounded-10">
                                                                                                            </a>
                                                                                                        <?php }else{ ?>
                                                                                                            <div>
                                                                                                                تعداد:
                                                                                                                <?= (!empty($res['position_product_order_info']['count']) && intval($res['position_product_order_info']['count'])>1?intval($res['position_product_order_info']['count']):1) ?>
                                                                                                            </div>
                                                                                                        <?php }
                                                                                                        if(!empty($res['position_product_order_info']['status']) && intval($res['position_product_order_info']['status'])>0){ ?>
                                                                                                                <small class="text-success">
                                                                                                                    حساب شده
                                                                                                                </small>
                                                                                                            <?php }else{
                                                                                                                if(!empty($p_info["price"]) && intval($p_info["price"])>0){ ?>
                                                                                                                    <small class="text-danger">
                                                                                                                        پرداخت نشده
                                                                                                                    </small>
                                                                                                                <?php }else{ ?>
                                                                                                                    <small class="text-success">
                                                                                                                	    رایگان
                                                                                                                	</small>
                                                                                                                <?php }
                                                                                                            }?>
                                                                                                    </div>
                                                                                                    <div class="d-none factor-product-position-order" style="position: fixed;top: 0;background: #1f2940;bottom: 0;left: 0;right: 0;z-index: 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;">
                                                                                                        <div class="row row-sm">
                                                                                                            <div class="col-md-12 col-xl-12">
                                                                                                                <div class="main-content-body-invoice" style="max-height: 600px;overflow-x:hidden;overflow-y: auto;padding:0;">
                                                                                                                    <div class="card card-invoice">
                                                                                                                        <div class="card-header p-0">
                                                                                                                            <a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hidePayProduct(this);" style="text-align: right;display: block;" title="بستن">
                                                                                                                                <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to position list">
                                                                                                                            </a>
                                                                                                                        </div>
                                                                                                                        <div class="card-body p-0">
                                                                                                                            <div class="text-center">
                                                                                                                                <h6 class="invoice-title">صورتحساب محصول</h6>
                                                                                                                            </div>
                                                                                                                            <div class="row mg-t-20">
                                                                                                                                <div class="col-12">
                                                                                                                                    <img class="ht-100-f mx-auto rounded-50 w-auto mb-3" src="<?= base_url('assets/svg/product/'.(!empty($p_info["icon"])?$p_info["icon"]:'product.svg')) ?>">
                                                                                                                                </div>
                                                                                                                                <div class="col-12">
                                                                                                                                    <label class="tx-gray-600">صورت حساب داده شده برای جایگاه</label>
                                                                                                                                    <div class="billed-to">
                                                                                                                                        <h6><?= (!empty($p_info['title'])?$p_info['title']:'') ?></h6>
                                                                                                                                        <p>
                                                                                                                                            طبق این فاکتور محصول 
                                                                                                                                            <?= (!empty($p_info['title'])?$p_info['title']:'') ?>
                                                                                                                                            به مبلغ
                                                                                                                                            <?= (!empty($p_info['price']) && intval($p_info['price'])>0?number_format($p_info['price']).' تومان':'رایگان') ?>
                                                                                                                                            به تعداد
                                                                                                                                            <span class="product-count-result"></span>
                                                                                                                                            عدد
                                                                                                                                            برای شما سفارش شده که می توانید هم اکنون آن را با اعتبار کیف پول خود پرداخت کنید و مبلغ 
                                                                                                                                            <span class="product-total-result"></span>
                                                                                                                                            را به حساب ارائه دهنده واریز کنید
                                                                                                                                        </p>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="col-12 mt-1">
                                                                                                                                    <label class="tx-gray-600">اطلاعات فاکتور</label>
                                                                                                                                    <p class="invoice-info-row">
                                                                                                                                        <?php $wallet=$_SESSION['my_wallet']; ?>
                                                                                                                                        <span>موجودی کیف پول شما</span>
                                                                                                                                        <span><?= (!empty($wallet) && !empty($wallet['value']) && intval($wallet['value'])>0?number_format($wallet['value']):0) ?> تومان</span>
                                                                                                                                    </p>
                                                                                                                                    <p class="invoice-info-row">
                                                                                                                                        <span>هزینه ی کلی</span>
                                                                                                                                        <span class="product-total-result"></span>
                                                                                                                                    </p>
                                                                                                                                    <p class="invoice-info-row">
                                                                                                                                        <span>قیمت با 10% مالیات تراکنش</span>
                                                                                                                                        <span class="product-total-result-tax"></span>
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <a class="btn btn-purple mt-3 btn-block" onclick="payProduct(<?= intval($res['position_product_order_info']["id"]) ?>);">
                                                                                                                                <img class="wd-35-f" src="<?= base_url('assets/svg/icon/pay.svg') ?>" alt="پرداخت">
                                                                                                                                پرداخت
                                                                                                                            </a>
                                                                                                                            <a href="<?= base_url('add_wallet_value') ?>" class="btn btn-danger mt-1 btn-block">
                                                                                                                                <img class="wd-20-f" src="<?= base_url('assets/svg/icon/wallet.svg') ?>" alt="افزودن موجودی">
                                                                                                                                افزودن موجودی حساب
                                                                                                                            </a>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            <?php }
                                                                                        }
                                                                                        if(!$show_controll){ ?>
                                                                                            <div class="alert alert-danger text-center text-dark p-3">
                                                                                                در این جایگاه محصولی سفارش ندادید
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
                                                                            <?php }
                                                                    	} ?>
                        				                            </div>
                        				                        </div>
                    				                        </div>
                    				                    </div>
                    				                </div>
                    				            </div>
                    				        </div>
                    				    </div>
                    				</div>
                		        </div>
    		                </div>
		                <?php }
		            } ?>
        		</div>
		    <?php }else{ ?>
		        <div class="alert alert-danger p-4 text-center rounded-10">
		            شما سفارشی برای محصولات خود ندارید
		        </div>
		    <?php } ?>
		</div>
	</div>
	<script>
        function showProductsInRes(el){
            $(el).parent().find('.order-products').removeClass('d-none');
        }
	</script>
<?php } ?>