<?php $include=''; ?>
<div class="row row-sm mt-4">
    <div class="col-lg-4">
	    <div class="card mg-b-20">
		    <div class="card-body">
			    <div class="pl-0">
				    <?php if(!empty($data) && !empty($data['id']) && intval($data['id'])>0){ 
				        echo (!empty($data['map'])?$data['map']:''); ?>
					    <div class="main-profile-overview">
							<div class="main-img-user profile-user">
							    <img alt="company image" src="<?= base_url('assets/svg/company/'.(!empty($data['info']['icon'])?$data['info']['icon']:'company.svg')) ?>">
							</div>
							<div class="d-flex justify-content-between mg-b-20">
							    <div>
								    <h5 class="main-profile-name"><?= (!empty($data['info']['title'])?$data['info']['title']:'') ?></h5>
								</div>
							</div>
							<h6>توضیحات</h6>
							<div class="main-profile-bio">
							    <?= (!empty($data['info']['description'])?$data['info']['description']:'') ?>
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
		    <div class="card-body">
			    <div class="tabs-menu ">
				<!-- Tabs -->
				    <ul class="nav nav-tabs profile navtab-custom panel-tabs">
					    <li class="">
						    <a href="#companyProducts" data-toggle="tab" aria-expanded="true" class="active">
						        <span class="visible-xs">
						            <i class="las la-user-circle tx-16 mr-1"></i>
						        </span> 
						        <span class="hidden-xs">محصولات</span>
						    </a>
						</li>
						<li class="">
						    <a href="#companyPositions" data-toggle="tab" aria-expanded="false">
						        <span class="visible-xs">
						            <i class="las la-cog tx-16 mr-1"></i>
						        </span>
						        <span class="hidden-xs">جایگاه ها</span>
						    </a>
						</li>
					</ul>
				</div>
				<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
				    <div class="tab-pane active" style="max-height: 370px;overflow-y: auto;overflow-x: hidden;" id="companyProducts">
				        <?php if(!empty($pro)){ ?>
				            <div class="row" style="height:335px;">
    				            <?php foreach($pro as $p){ 
        							if(!empty($p)){
            						    $pro=$p; 
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
        						    }
        						} ?>
				            </div>
				        <?php }else{ ?>
				            <div class="alert alert-danger rounded-10 text-center p-3">
				                این کسب و کار محصولی برای ارائه ندارد
				            </div>
				        <?php } ?>
					</div>
					<div class="tab-pane" style="max-height: 370px;overflow-y: auto;overflow-x: hidden;" id="companyPositions">
						<?php if(!empty($pos)){ ?>
                            <div class="row" style="height:335px;">
                                <?php foreach($pos as $po){
                                if(!empty($po) && ($p['position_info']=$po)!==false && !empty($p['position_info']['info']['id']) &&
                                intval($p['position_info']['info']['id'])>0){ 
                                    $include.= (!empty($p['position_info']['map'])?$p['position_info']['map']:''); ?>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 p-0">
                                        <div class="card rounded-10 mb-0" title="<?= (!empty($p['position_info']['info']['description'])?$p['position_info']['info']['description']:'') ?>">
                                            <img alt="product" class="img-fluid card-img-top ht-120 rounded-10" src="<?= base_url('assets/svg/position/'.(!empty($p['position_info']['info']['icon'])?$p['position_info']['info']['icon']:'position.svg'))?>">
                                            <span  class="<?= (!empty($p['position_info']['info']['status']) && intval($p['position_info']['info']['status'])>0?'pulse':'pulse-danger') ?>"></span>
                                            <div class="rounded-10 card-img-overlay pd-30 bg-black-4 d-flex flex-column justify-content-center text-center p-3">
                                                <a href="<?= base_url('position/'.intval($p['position_info']['info']['id'])) ?>" class="tx-white tx-medium mg-y-10">
                                                    <?= (!empty($p['position_info']['info']['title'])?$p['position_info']['info']['title']:'') ?>
                                                </a>
                                                <p class="tx-white-7 tx-small mg-b-15">
                                                    <?= (!empty($p['position_info']['info']['price'])?number_format($p['position_info']['info']['price']).'تومان':'رایگان') ?>
                                                </p>
                                                <p class="tx-13 mg-b-0" style="gap: 5px;display: flex;flex-wrap: wrap;flex-direction: row;align-content: stretch;justify-content: center;align-items: stretch;">
                                                    
                                                    <?php if(!empty($p['position_info']['map']) && !empty(trim($p['position_info']['map']))){ ?>
                                                        <a class="setup-btns-event d-none pro-btn show-map product-footer" onclick="mapMarkerChangeLocationImage('position',true,0,0,<?= intval($p['position_info']['info']['id']) ?>,0);" title="محل">
                                                            <i class="si si-location-pin tx-20-f"></i>
                                                        </a>
                                                	<?php } if(!empty($p['position_info']['tel']) && !empty(trim($p['position_info']['tel']))){ ?>
                                                        <a class="setup-btns-event d-none pro-btn show-tel product-footer" onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($p['position_info']['info']['id']).');':'loginError(this);') ?>" title="تماس">
                                                            <i class="si si-call-out tx-20-f"></i>
                                                        </a>
                                                    <?php } if(!empty($p['position_info']['chat']) && !empty(trim($p['position_info']['chat']))){ ?>
                                                	    <a class="setup-btns-event d-none pro-btn show-chat product-footer" onclick="productElementsTools(this,'chat',<?= intval($p['position_info']['info']['id']) ?>);" title="نظرات">
                                                            <i class="icon ion-md-chatboxes tx-20-f"></i>
                                                        </a>
                                                    <?php } if(!empty($p['position_info']['image']) && !empty(trim($p['position_info']['image']))){ ?>
                                                	    <a class="setup-btns-event d-none pro-btn show-image product-footer" onclick="productElementsTools(this,'image',<?= intval($p['position_info']['info']['id']) ?>);" title="عکس">
                                                            <i class="la la-image tx-20-f"></i>
                                                        </a>
                                                    <?php }if(!empty($p['position_info']['video']) && !empty(trim($p['position_info']['video']))){ ?>
                                                	    <a class="setup-btns-event d-none pro-btn show-video product-footer" onclick="productElementsTools(this,'video',<?= intval($p['position_info']['info']['id']) ?>);" title="فیلم">
                                                            <i class="la la-film tx-20-f"></i>
                                                        </a>
                                                    <?php }
                                                    $res=array_values($p['position_info']['reserve']);
                                                    $res=array_column(array_column($res, 'position_user_info'),'status');
                                                    if(empty($res) || is_bool(array_search('0',array_values($res),true))){ ?>
                                                        <a class="setup-btns-event d-none pro-btn show-reserve product-footer" 
                                                        onclick="<?= (!empty($id) && intval($id)>0?'reservePosition(this,'.intval($p['position_info']['info']['id']).');':'loginError(this);') ?>" title="رزرو">
                                                            <i class="fe fe-bell tx-20-f"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <a class="setup-btns-click pro-btn product-footer" onclick="setupBtnsClick(this);" title="بیشتر">
                                                        <i class="fa fa-cog fa-spin tx-20-f"></i>
                                                    </a>
                                                </p>
                                                <span class="show-div-setting">
                                                    <?php if(!empty($id) && intval($id)>0 && !empty($p['position_info']['tel']) && !empty(trim($p['position_info']['tel']))){ ?>
                                                        <div class="tel d-none">
                                                            <?= trim($p['position_info']['tel']) ?>
                                                        </div>
                                                    <?php } if(!empty($p['position_info']['chat']) && is_string($p['position_info']['chat']) && !empty(trim($p['position_info']['chat']))){ ?>
                                                        <div class="chat d-none" id="chatmodelposition<?= intval($p['position_info']['info']['id']) ?>">
                                                            <?= trim($p['position_info']['chat']) ?>
                                                        </div>
                                                    <?php } if(!empty($p['position_info']['image']) && is_string($p['position_info']['image']) && !empty(trim($p['position_info']['image']))){ ?>
                                                        <div class="image d-none">
                                                            <?= trim($p['position_info']['image']) ?>
                                                        </div>
                                                    <?php } if(!empty($p['position_info']['video']) && is_string($p['position_info']['video']) && !empty(trim($p['position_info']['video']))){ ?>
                                                        <div class="video d-none">
                                                            <?= trim($p['position_info']['video']) ?>
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
				                این کسب و کار جایگاهی برای ارائه ندارد
				            </div>
				        <?php } ?>	
					</div>
			    </div>
		    </div>
	    </div>
    </div>
</div>
<?= $include ?>