<?php if(!empty($company_position_product)){ ?>
	    <div class="col-12 mb-2" id="company-position-product">
		    <div class="card" style="margin: 0;max-height: 460px;">
		        <?php $include=''; ?>
			    <div class="card-header pb-1">
				    <h3 class="card-title mb-2">محصولات دارای مجوز با جایگاه عرضه محصول</h3>
					<p class="tx-12 mb-0 text-muted">
					    محصولاتی که توسط کسب و کار های موجود با جایگاه عرضه محصول ارائه می شوند(قیمت ها به <strong>تومان</strong> است)
					</p>
				</div>
				<div class="product-timeline card-body pt-2 mt-1" style="overflow:auto;max-height:350px;">
					<div id="company-position-product-table" class="row ">
					    <?php foreach($company_position_product as $p){ 
							if(!empty($p) && !empty($p['product_info'])){
    						    $pro=$p['product_info']; 
    							if(!empty($pro['id']) && intval($pro['id'])>0){
        						    $include.=(!empty($pro["chart"])?$pro['chart']:'').(!empty($pro["map"])?$pro['map']:''); ?>		    
            						<div class="col-6 col-md-4 col-lg-3 col-xl-2 p-0">
                                        <div class="card rounded-10 mb-0" title="<?= (!empty($pro['info']['description'])?$pro['info']['description']:'') ?>">
                                            <img alt="product" class="img-fluid card-img-top ht-120 rounded-10" 
                                            src="<?= base_url('assets/svg/product/'.(!empty($pro['info']['icon'])?$pro['info']['icon']:'product.svg'))?>">
                                            <span  class="<?= (!empty($pro['info']['status']) && intval($pro['info']['status'])>0?'pulse':'pulse-danger') ?>"></span>
                                            <div class="rounded-10 card-img-overlay pd-30 bg-black-4 d-flex flex-column justify-content-center text-center p-3">
                                                <a href="<?= base_url('product/'.intval($pro['id'])) ?>" class="tx-white tx-medium mg-y-10">
                                                    <?= (!empty($pro['info']["title"])?$pro['info']["title"]:(!empty($pro['info']["key"])?$pro['info']["key"]:'')) ?>
                                                </a>
                                                <p class="tx-white-7 tx-small mg-b-15">
                                                    <?= (!empty($pro['info']['status']) && intval($pro['info']['status'])>0?(!empty($pro['info']['price'])?number_format($pro['info']['price']).'تومان':'رایگان'):'نا موجود') ?>
                                                </p>
                                                <p class="tx-13 mg-b-0" style="gap: 5px;display: flex;flex-wrap: wrap;flex-direction: row;align-content: stretch;justify-content: center;align-items: stretch;">
                                                    <?php if(!empty($p['company_info']['info']['title'])){ ?>
            									        <a href="<?= base_url('show_company/'.str_replace(' ','--',$p['company_info']['info']['title'])) ?>" class="setup-btns-event d-none pro-btn product-footer" 
                                                        title="کسب و کار">
                                                            <i class="far fa-address-card text-white tx-20-f"></i>
                                                        </a>
            									    <?php } if(empty($pro['reserve'])) { ?>
            									        <a class="setup-btns-event d-none pro-btn product-footer d-none" 
                                                        onclick="<?= (!empty($id) && intval($id)>0?'reserveProductInPosition(this,'.(!empty($p['position_info']['info']['id']) && intval($p['position_info']['info']['id'])>0?intval($p['position_info']['info']['id']):0).','.intval($pro['id']).');':'loginError(this);') ?>"
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
                                                        onclick="mapMarkerChangeLocationImage('product',true,<?= (!empty($p['company_info']['id']) && intval($p['company_info']['id'])>0?intval($p['company_info']['id']):0) ?>,0,<?= (!empty($p['position_info']['id']) && intval($p['position_info']['id'])>0?intval($p['position_info']['id']):0) ?>,<?= intval($pro['id']) ?>);"
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
                                                        <i class="fa fa-cog fa-spin tx-20-f text-warning"></i>
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
						    }
						} ?>
				    </div>
				</div>
				<div class="card-footer">
					<?= $include ?>
				</div>
			</div>
		</div>
		<div class="col-12 mb-2">
		    <img style="border-radius:20px;opacity:0.7;width:100%;height:310px" src="<?= base_url('assets/pic/market-new.jpeg') ?>">
		</div>
	<?php } ?>