<?php $date=new JDF();
$include=''; ?>
<div class="row row-sm mt-4">
    <div class="col-lg-4">
	    <div class="card mg-b-20">
		    <div class="card-body">
			    <div class="pl-0">
				    <?php if(!empty($data) && !empty($data['id']) && intval($data['id'])>0 && !empty($data['info'])){ 
				        echo (!empty($data['map'])?$data['map']:''); ?>
					    <div class="main-profile-overview">
							<div class="main-img-user profile-user">
							    <img alt="position image" src="<?= base_url('assets/svg/position/'.(!empty($data['info']['icon'])?$data['info']['icon']:'position.svg')) ?>">
							</div>
							<div class="d-flex justify-content-between mg-b-20">
							    <div>
								    <h5 class="main-profile-name"><?= (!empty($data['info']['title'])?$data['info']['title']:'') ?></h5>
								</div>
							</div>
							<div class="d-flex justify-content-between mg-b-20">
							    <div>
								    <h6 class=""><?= (!empty($data['info']['price']) && intval($data['info']['price'])>0?number_format($data['info']['price']).' تومان':'') ?></h6>
								</div>
							</div>
							<hr class="mg-y-20">
							<label class="main-content-label tx-13 mg-b-20">بارکد</label>
							<div class="main-profile-social-list">
							    <img class="wd-100" onclick="downloadImage(this);" src="<?= base_url('assets/qrcode/'.(!empty($data['info']['qr_code'])?$data['info']['qr_code']:'tes.png')) ?>">
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
	    <div class="card">
	        <div class="row row-sm">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-body h-100">
							<div class="row row-sm">
								<?php $res=array_values($data['reserve']);
                                $res=array_column(array_column($res, 'position_user_info'),'status');
                                if(empty($res) || is_bool(array_search('0',array_values($res),true))){ ?>
                                    <a class="rounded-10 mb-1 pt-3 bg-danger text-center col-12 setup-btns-event pro-btn product-footer" 
                                    onclick="<?= (!empty($id) && intval($id)>0?'reservePosition(this,'.intval($data['id']).');':'loginError(this);') ?>"
                                    title="رزرو">
                                        <i class="fe fe-bell tx-70-f"></i>
                                        <p class="py-1">
                                            رزرو
                                        </p>
                                    </a>
                                <?php }
								if(!empty($company['info']['title'])){ ?>
            						<a href="<?= base_url('show_company/'.str_replace(' ','--',$company['info']['title'])) ?>" 
            						class="rounded-10 mb-1 pt-3 bg-light text-center col-6 setup-btns-event pro-btn product-footer" 
                                    title="کسب و کار">
                                        <i class="far fa-address-card text-white tx-70-f"></i>
                                        <p class="py-1">
                                            کسب و کار
                                        </p>
                                    </a>
            					<?php }
            					if(!empty($data['image']) && !empty(trim($data['image']))) { ?>
                                    <a class="rounded-10 mb-1 pt-3 bg-secondary text-center col-6 show-image setup-btns-event pro-btn product-footer" 
                                    onclick="productElementsTools(this,'image',<?= intval($data['id']) ?>);"
                                    title="عکس">
                                        <i class="la la-image tx-70-f"></i>
                                        <p class="py-1">
                                            عکس
                                        </p>
                                    </a>
                                <?php } 
                                if(!empty($data['video']) && !empty(trim($data['video']))) { ?>
                                    <a class="rounded-10 mb-1 pt-3 bg-primary text-center col-6 show-video setup-btns-event  pro-btn product-footer" 
                                    onclick="productElementsTools(this,'video',<?= intval($data['id']) ?>);"
                                    title="فیلم">
                                        <i class="la la-film tx-70-f"></i>
                                        <p class="py-1">
                                            فیلم
                                        </p>
                                    </a>
                				<?php } 
                				if(!empty($data['tel']) && !empty(trim($data['tel']))){ ?>
                                    <a class="rounded-10 mb-1 pt-3 bg-success text-center col-6 show-tel setup-btns-event  pro-btn product-footer"
                                    onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($data['id']).');':'loginError(this);') ?>"
                                    title="تماس">
                                        <i class="si si-call-out tx-70-f"></i>
                                        <p class="py-1">
                                            تماس
                                        </p>
                                    </a>
                                <?php } 
                                if(!empty($data['chat']) && !empty(trim($data['chat']))) { ?>
                                    <a class="rounded-10 mb-1 pt-3 bg-pink text-center col-6 show-chat setup-btns-event  pro-btn product-footer" 
                                    onclick="productElementsTools(this,'chat',<?= intval($data['id']) ?>);"
                                    title="نظرات">
                                        <i class="icon ion-md-chatboxes tx-70-f"></i>
                                        <p style="position: relative;top: -30px">
                                            نظرات
                                        </p>
                                    </a>
                                <?php } 
                                if(!empty($data['map']) && !empty(trim($data['map']))) { ?>
                                    <a class="rounded-10 mb-1 pt-3 bg-danger text-center col-6 setup-btns-event pro-btn show-map product-footer" 
                                    onclick="mapMarkerChangeLocationImage('position',true,<?= (!empty($company['id']) && intval($company['id'])>0?intval($company['id']):0) ?>,0,<?= intval($data['id']) ?>,0);"
                                    title="محل">
                                        <i class="si si-location-pin tx-70-f"></i>
                                        <p class="py-1">
                                            محل
                                        </p>
                                    </a>
                                <?php } ?>
                                <span class="show-div-setting">
                                    <?php if(!empty($data['tel']) && !empty(trim($data['tel']))){ ?>
                                        <div class="tel d-none">
                                            <?= $data['tel'] ?>
                                        </div>
                                    <?php } if(!empty($data['video']) && !empty(trim($data['video']))) {?>
                                        <div class="video d-none">
                                            <?= $data['video'] ?>
                                        </div>
                                    <?php }if(!empty($data['image']) && !empty(trim($data['image']))) {?>
                                        <div class="image d-none">
                                            <?= $data['image'] ?>
                                        </div>
                                    <?php } if(!empty($data['chat']) && !empty(trim($data['chat']))) { ?>
                                        <div class="chat d-none" id="chatmodelproduct<?= intval($data['id']) ?>">
                                            <?= $data['chat'] ?>
                                        </div>
                                    <?php } 
                                    echo (!empty($data["map"])?$data['map']:''); ?>
            					</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-md-12 col-xl-4 col-xs-12 col-sm-12">
					<div class="card">
						<div class="card-body">
							<div class="feature2">
								<i class="mdi mdi-headset bg-pink  ht-50 wd-50 text-center brround text-white"></i>
							    <h5 class="mb-3 tx-16 d-inline-block mr-3">توضیحات</h5>
							</div>
							<div class="main-profile-bio">
							    <?= (!empty($data['info']['description'])?$data['info']['description']:'') ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
			    <div class="col-12">
			        <div class="card">
            		    <div class="card-body">
            			    <div class="tabs-menu ">
            				    <ul class="nav nav-tabs profile navtab-custom panel-tabs">
            					    <li>
            						    <a href="#companyProducts" data-toggle="tab" aria-expanded="true" class="active">
            						        <span class="visible-xs">
            						            <i class="las la-user-circle tx-16 mr-1"></i>
            						        </span> 
            						        <span class="hidden-xs">محصولات</span>
            						    </a>
            						</li>
            						<li>
            						    <a href="#companyPositions" data-toggle="tab" aria-expanded="false">
            						        <span class="visible-xs">
            						            <i class="las la-cog tx-16 mr-1"></i>
            						        </span>
            						        <span class="hidden-xs">دفعات رزرو</span>
            						    </a>
            						</li>
            					</ul>
            				</div>
            				<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
            				    <div class="tab-pane active" style="max-height: 370px;overflow-y: auto;overflow-x: hidden;" id="companyProducts">
            				        <?php if(!empty($product)){ ?>
            				            <div class="row" style="height:335px;">
                				            <?php foreach($product as $pro){ 
                							    if(!empty($pro['id']) && intval($pro['id'])>0){
                        						    $include.=(!empty($pro["chart"])?$pro['chart']:'').(!empty($pro["map"])?$pro['map']:''); ?>		    
                            						<div class="col-12 col-md-6 col-lg-4 col-xl-3 p-0">
                                                        <div class="card rounded-10 mb-0" title="<?= (!empty($pro['info']['description'])?$pro['info']['description']:'') ?>">
                                                            <img alt="product" class="img-fluid card-img-top ht-120 rounded-10" 
                                                            src="<?= base_url('assets/svg/product/'.(!empty($pro['info']['icon'])?$pro['info']['icon']:'product.svg'))?>">
                                                            <span  class="<?= (!empty($pro['info']['status']) && intval($pro['info']['status'])>0?'pulse':'pulse-danger') ?>"></span>
                                                            <div class="rounded-10 card-img-overlay pd-30 bg-black-4 d-flex flex-column justify-content-center text-center p-3">
                                                                <a href="<?= base_url('product/'.intval($pro['id'])) ?>" class="tx-white tx-medium mg-y-10">
                                                                    <?= (!empty($pro['info']["title"])?$pro['info']["title"]:(!empty($pro['info']["key"])?$pro['info']["key"]:'')) ?>
                                                                </a>
                                                                <p class="tx-white-7 tx-small mg-b-15">
                                                                    <?= (!empty($pro['info']['price'])?number_format($pro['info']['price']).'تومان':'رایگان') ?>
                                                                </p>
                                                                <p class="tx-13 mg-b-0" style="gap: 5px;display: flex;flex-wrap: wrap;flex-direction: row;align-content: stretch;justify-content: center;align-items: stretch;">
                                                                    <?php if(empty($pro['reserve'])) { ?>
                            									        <a class="setup-btns-event d-none pro-btn product-footer d-none" 
                                                                        onclick="<?= (!empty($id) && intval($id)>0?'reserveProductInPosition(this,'.intval($data['id']).','.intval($pro['id']).');':'loginError(this);') ?>"
                                                                        title="رزرو">
                                                                            <i class="fe fe-bell tx-20-f"></i>
                                                                        </a>
                            									    <?php } 
                            										if(!empty($pro['image']) && !empty(trim($pro['image']))) { ?>
                                                                        <a class="show-image setup-btns-event d-none pro-btn product-footer" 
                                                                        onclick="productElementsTools(this,'image',<?= intval($pro['id']) ?>);"
                                                                        title="عکس">
                                                                            <i class="la la-image tx-20-f"></i>
                                                                        </a>
                                                                    <?php } 
                                                                    if(!empty($pro['video']) && !empty(trim($pro['video']))) { ?>
                                                                        <a class="show-video setup-btns-event d-none pro-btn product-footer" 
                                                                        onclick="productElementsTools(this,'video',<?= intval($pro['id']) ?>);"
                                                                        title="فیلم">
                                                                            <i class="la la-film tx-20-f"></i>
                                                                        </a>
                                									<?php } 
                                									if(!empty($pro['tel']) && !empty(trim($pro['tel']))){ ?>
                                                                        <a class="show-tel setup-btns-event d-none pro-btn product-footer"
                                                                        onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($pro['id']).');':'loginError(this);') ?>"
                                                                        title="تماس">
                                                                            <i class="si si-call-out tx-20-f"></i>
                                                                        </a>
                                                                    <?php } 
                                                                    if(!empty($pro['chat']) && !empty(trim($pro['chat']))) { ?>
                                                                        <a class="show-chat setup-btns-event d-none pro-btn product-footer" 
                                                                        onclick="productElementsTools(this,'chat',<?= intval($pro['id']) ?>);"
                                                                        title="نظرات">
                                                                            <i class="icon ion-md-chatboxes tx-20-f"></i>
                                                                        </a>
                                                                    <?php } 
                                                                    if(!empty($pro['chart']) && !empty(trim($pro['chart']))) { ?>
                                                                        <a class="setup-btns-event d-none pro-btn show-chart product-footer" 
                                                                        onclick="showChartProductId(<?= intval($pro['id']) ?>);"
                                                                        title="نمودار">
                                                                            <i class="icon ion-ios-stats tx-20-f"></i>
                                                                        </a>
                                                                    <?php } 
                                                                    if(!empty($pro['map']) && !empty(trim($pro['map']))) { ?>
                                                                        <a class="setup-btns-event d-none pro-btn show-map product-footer" 
                                                                        onclick="mapMarkerChangeLocationImage('product',true,0,0,0,<?= intval($pro['id']) ?>);"
                                                                        title="محل">
                                                                            <i class="si si-location-pin tx-20-f"></i>
                                                                        </a>
                                                                    <?php }
                                                                    if(!empty($pro['key_value']) && !empty(trim($pro['key_value']))){ ?>
                                                                        <a class="setup-btns-event d-none pro-btn show-key-value product-footer"
                                                                        onclick="productElementsTools(this,'key-value',<?= intval($pro['id']) ?>);"
                                                                        title="ویژگی">
                                                                            <i class="icon ion-ios-list-box tx-20-f"></i>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <a class="setup-btns-click pro-btn product-footer" onclick="setupBtnsClick(this);" title="بیشتر">
                                                                        <i class="fa fa-cog fa-spin tx-20-f"></i>
                                                                    </a>
                                                                </p>
                                                                <span class="show-div-setting">
                                                                    <?php if(!empty($pro['tel']) && !empty(trim($pro['tel']))){ ?>
                                                                        <div class="tel d-none">
                                                                            <?= $pro['tel'] ?>
                                                                        </div>
                                                                    <?php } if(!empty($pro['video']) && !empty(trim($pro['video']))) {?>
                                                                        <div class="video d-none">
                                                                            <?= $pro['video'] ?>
                                                                        </div>
                                                                    <?php }if(!empty($pro['image']) && !empty(trim($pro['image']))) {?>
                                                                        <div class="image d-none">
                                                                           <?= $pro['image'] ?>
                                                                        </div>
                                                                    <?php } if(!empty($pro['chat']) && !empty(trim($pro['chat']))) { ?>
                                                                        <div class="chat d-none" id="chatmodelproduct<?= intval($pro['id']) ?>">
                                                                            <?= $pro['chat'] ?>
                                                                        </div>
                                                                    <?php } if(!empty($pro['key_value']) && !empty(trim($pro['key_value']))) { ?>
                                                                        <div class="key-value d-none">
                                                                            <?= $pro['key_value'] ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                							    <?php }
                    						} ?>
            				            </div>
            				        <?php }else{ ?>
            				            <div class="alert alert-danger rounded-10 text-center p-3">
            				                این کسب و کار محصولی برای ارائه ندارد
            				            </div>
            				        <?php } ?>
            					</div>
            					<div class="tab-pane" style="max-height: 370px;overflow-y: auto;overflow-x: hidden;" id="companyPositions">
            						<?php if(!empty($data['reserve'])){ ?>
                                        <div class="row" style="height:335px;">
                                            <div class="col-12">
                                                <?php foreach($data['reserve'] as $res){
                            			            if(!empty($res)){ 
                            			                if(!empty($res['position_user_info']["time_reserve"]) && intval($res['position_user_info']["time_reserve"])>0){
                                                        	if(!empty($data['info']['price']) && intval($data['info']['price'])>0){
                                                        		$ex=explode(':',$res['position_user_info']["time_reserve"]);
                                                        		if(!empty($ex)){
                                                            		$price=(!empty($ex['0']) && intval($ex['0'])>0?intval($ex['0']*$data['info']['price']):0);
                                                            		$sum_min=intval($data['info']['price']/60);
                                                            		$sum_sec=intval($data['info']['price']/3600);
                                                            		$price+=(!empty($ex['1']) && intval($ex['1'])>0?intval($sum_min*$ex['1']):0);
                                                            	    $price+=(!empty($ex['2']) && intval($ex['2'])>0?intval($sum_sec*$ex['2']):0);
                                                        	    }
                                                        	}else{
                                                        	    $price=0; 
                                                            }
                                                        }else{
                                                            $price=(!empty($data['info']['price']) && intval($data['info']['price'])>0?intval($data['info']['price']):0);
                                                        }
                                                        $total_price=$price; ?>
                                			            <div>
                                			                <div onclick="showProductsInRes(this);" class="list d-flex align-items-center border-bottom p-3">
                                			                    <div>
                                			                        <span class="avatar bg-dark brround avatar-md">
                                			                            <img src="<?= base_url('assets/svg/position/'.(!empty($data['info']['icon'])?$data['info']['icon']:'position.svg')) ?>">
                                			                        </span>
                                			                    </div>
                                			                    <div class="pr-2">
                                			                        <p class="mb-0">
                                    			                        <?= (!empty($data['info']['title'])?$data['info']['title']:'') ?>
                                			                        </p>
                                			                    </div>
                                			                    <div class="pr-2 wapper">
                                    			                    <?php if(!empty($res['position_user_status']) && intval($res['position_user_status'])==1){ ?>
                                                                        <small class="tx-8-f text-info">
                                                                            مشتری رسیده
                                                                        </small>
                                                                    <?php }elseif(!empty($res['position_user_status']) && intval($res['position_user_status'])==2){ ?>
                                                                        <small class="tx-8-f text-warning">
                                                                            وجه نقد دریافت کنید
                                                                        </small>
                                                                    <?php }elseif(!empty($res['position_user_status']) && intval($res['position_user_status'])==3){ ?>
                                                                        <small class="tx-8-f text-danger">
                                                                            پرداخت محصولات کامل نیست
                                                                        </small>
                                                                    <?php }elseif(!empty($res['position_user_status']) && intval($res['position_user_status'])==4){ ?>
                                                                        <small class="tx-8-f text-success">
                                                                            پرداخت شد
                                                                        </small>
                                                                    <?php }elseif(!empty($res['position_user_status']) && intval($res['position_user_status'])==5){ ?>
                                                                        <small class="tx-8-f text-secondary">
                                                                            مشکل خدماتی
                                                                        </small>
                                                                    <?php }elseif(!empty($res['position_user_status']) && intval($res['position_user_status'])==6){ ?>
                                                                        <small class="tx-8-f text-success">
                                                                            اتمام خدمات
                                                                        </small>
                                                                    <?php }else{ ?>
                                                                        <small class="tx-8-f text-warning">
                                                                            درانتظار مشتری
                                                                        </small>
                                                                    <?php } ?>
                                                                    <br>
                                                                    <?php if(!empty($res['position_user_info']["factor"])){ ?>
                                                    					<small class="text-success">
                                                    				    	پرداخت شده
                                                    					</small>
                                                					<?php } else{ 
                                                					    if(!empty($data['info']['price'])){ ?>
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
                                                    				    نوع خدمات:<?= (!(!empty($data['info']['position_type']) && intval($data['info']['position_type'])>0)?'حضوری':'مجازی') ?>
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
                                                				    <small>
                                                				        قیمت رزرو هر ساعت:<?= (!empty($data['info']['price']) && intval($data['info']['price'])>0?number_format($data['info']['price']).'تومان':'رایگان') ?></small>
                                                				    <br>
                                                				    <small>
                                                				        قیمت کل:<?= (!empty($total_price) && intval($total_price)>0?number_format($total_price).'تومان':'رایگان') ?>
                                                				    </small>
                                                				</div>
                                			                </div>
                                    			            <div class="order-products d-none">
                                    			                <?php 
                                                        	    $show_controll=false;
                                                        	    if(!empty($res['position_product_order_info'])){
                                                            		foreach (array_reverse($res['position_product_order_info']) as $o) {
                                                            		    if(!empty($o['product_id']) && intval($o['product_id'])>0 && !empty($product) &&
                                                                        ($p_info=$product[array_search(intval($o['product_id']),array_column($product,'id'))]['info'])!==false && !empty($p_info)){ 
                                                            				$show_controll=true; ?>
                                                            				<div class="list-group-item d-flex text-center product-id-<?= 
                                                            				(!empty($p_info["id"]) && intval($p_info["id"])>0?intval($p_info["id"]):0) ?> 
                                                            				company-id-<?= (!empty($company['info']['id']) && intval($company['info']['id'])>0?intval($company['info']['id']):0) ?>
                                                            				position-id-<?= (!empty($data['info']['id']) && intval($data['info']['id'])>0?intval($data['info']['id']):'0') ?> align-items-center">
                                                            				    <div class="ml-3">
                                                            					    <span class="avatar avatar-lg brround cover-image" 
                                                            						data-image-src="<?= 
                                                            						    (!empty($p_info["icon"])?base_url('assets/svg/product/'.$p_info["icon"]):
                                                            							(!empty($data['info']['icon'])?base_url('assets/svg/position/'.$data['info']['icon']):
                                                            							(!empty($company['info']['icon'])?base_url('assets/svg/company/'.$company['info']['icon']):
                                                            							base_url('assets/svg/product/product.svg')))) ?>" 
                                                            						style="background: url(&quot;<?= 
                                                            						    (!empty($p_info["icon"])?base_url('assets/svg/product/'.$p_info["icon"]):
                                                            							(!empty($data['info']['icon'])?base_url('assets/svg/position/'.$data['info']['icon']):
                                                            							(!empty($company['info']['icon'])?base_url('assets/svg/company/'.$company['info']['icon']):
                                                            							base_url('assets/svg/product/product.svg')))) ?>&quot;) center center;">
                                                                						<span class="avatar-status <?= (!empty($p_info['status']) && intval($p_info['status'])>0?'bg-success':'bg-danger') ?>"></span>
                                                            						</span>
                                                            					</div>
                                                            					<div style="max-height: 96px;width:100%;text-align:center;">
                                                            					    <strong>
                                                            						    <?= (!empty($p_info['title'])?$p_info['title']:
                                                            							(!empty($p_info['key'])?$p_info['key']:''))?>
                                                            						</strong>
                                                            						<br>
                                                            						<p style="max-width: 140px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;margin-bottom: 5px;text-align:center;" title="<?= (!empty($p_info['description'])?$p_info['description']:'') ?>">
                                                            						    <?= (!empty($p_info['description'])?$p_info['description']:'') ?>
                                                            						</p>
                                                            						<div class="small text-muted">
                                                            						    قیمت:<?= (!empty($p_info["price"]) && intval($p_info["price"])>0?number_format($p_info["price"]).'تومان':'رایگان') ?>	
                                                            						<br>
                                                            						<?php if(!empty($o['status']) && intval($o['status'])>0){ ?>
                                                            						    <small class="text-success">
                                                            							    حساب شده
                                                            							</small>
                                                            						<?php }else{
                                                            						  //  var_dump($o);
                                                            		    
                                                            						if(!empty($p_info["price"]) && intval($p_info["price"])>0){ ?>
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
                                                            				</div>
                                                                				<div class="small mr-auto text-muted wd-50-f ml-2">
                                                                				    <?php if(!empty($p['status']) && intval($p['status'])>0 && $p['status']!==6 && !(!empty($o['status']) && intval($o['status'])>0)&&!empty($o["price"]) && intval($o["price"])>0){ ?>
                                                                    				    <div>
                                                                        				    تعداد:
                                                                        					<br>
                                                                        					<input type="number" value="<?= (!empty($o['count']) && intval($o['count'])>1?intval($o['count']):1) ?>" min="0" class="product-count form-control p-0 text-center wd-50" onchange="changeCountOrder(this,<?= (!empty($o['count']) && intval($o['id'])>0?intval($o['id']):0) ?>)">
                                                                        				</div>
                                                                						<a onclick="showPayProduct(this,<?= (!empty($p_info['price']) && intval($p_info['price'])>0?intval($p_info['price']):0) ?>);">
                                                                						    <img src="<?= base_url('assets/svg/icon/pay.svg') ?>" alt="payment" class="wd-30-f rounded-10">
                                                                						</a>
                                                                					<?php }else{ ?>
                                                                        				<div>
                                                                                		    تعداد:
                                                                                	        <?= (!empty($o['count']) && intval($o['count'])>1?intval($o['count']):1) ?>
                                                                                	    </div>
                                                            		                <?php } ?>
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
                                                                                                    		<p class="invoice-info-row d-none">
                                                                                                    		    <span>قیمت با 10% مالیات تراکنش</span>
                                                                                                    			<span class="product-total-result-tax"></span>
                                                                                                    		</p>
                                                                                                    	</div>
                                                                                                    </div>
                                                                                                    <a class="btn btn-purple mt-3 btn-block" onclick="payProduct(<?= intval($o["id"]) ?>);">
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
            				        <?php }else{ 
                				        if(!empty($id) && intval($id)>0){ ?>
                    				        <div class="alert alert-danger rounded-10 text-center p-3">
                				                شما قبلا از این جایگاه استفاده نکردید
                				            </div>
                                        <?php }else{ ?>
                				            <div class="alert alert-danger rounded-10 text-center p-3">
                    				            برای مشاهده باید وارد حساب کاربری شوید
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
<?= $include ?>
<script>
    function showProductsInRes(el){
        $(el).parent().find('.order-products').removeClass('d-none');
    }
</script>