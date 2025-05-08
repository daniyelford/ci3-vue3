<?php if(!empty($position)){ 
        $include=''; ?>
        <div class="col-12 mb-2" id="position">
            <div class="card card-dashboard-eight pb-2" style="margin: 0;max-height: 460px;">
                <div class="card-header pb-1">
                    <h6 class="card-title">
                        جایگاه ارائه محصولات معتبر
                    </h6>
                    <span class="d-block mg-b-10 text-muted tx-12">
                        این محصولات توسط مشاغل تایید شده در مکان های شناخته شده ارائه می شوند(قیمت ها به تومان است)
                    </span>
                </div>
                <div class="product-timeline card-body pt-2 mt-1" style="overflow:auto;max-height:350px;">
                    <div class="row" id="position-sevices">
                        <?php $company_ids=$position_ids=$product_ids=[];
                        foreach($position as $p){
                            if(!empty($p['company_info']) && !empty($p['company_info']['info']['id']) && intval($p['company_info']['info']['id'])>0 && !in_array(intval($p['company_info']['info']['id']),$company_ids)){
                                $company_ids[]=intval($p['company_info']['info']['id']);
                                $include.= (!empty($p['company_info']['map'])?$p['company_info']['map']:''); ?>
                              <!--
                                <script>
                                    companyInfo.push({
                                        id:<?= intval($p['company_info']['info']['id']) ?>,
                                        icon:"<?= (!empty($p['company_info']['info']['icon'])?$p['company_info']['info']['icon']:'') ?>",
                                        title:"<?= (!empty($p['company_info']['info']['title'])?$p['company_info']['info']['title']:'') ?>",
                                        description:"<?= (!empty($p['company_info']['info']['description'])?$p['company_info']['info']['description']:'') ?>",
                                    })
                                </script>
                              -->
                            <?php }
                            if(!empty($p['position_info']) && !empty($p['position_info']['info']['id']) &&
                            intval($p['position_info']['info']['id'])>0 &&
                            !in_array(intval($p['position_info']['info']['id']),$position_ids)){ 
                                $position_ids[]=intval($p['position_info']['info']['id']);
                                $include.= (!empty($p['position_info']['map'])?$p['position_info']['map']:''); ?>
                                <div class="col-6 col-md-4 col-lg-3 col-xl-2 p-0">
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
                                                <?php $res=array_values($p['position_info']['reserve']);
                                                $res=array_column(array_column($res, 'position_user_info'),'status');
                                                if(empty($res) || is_bool(array_search('0',array_values($res),true))){ ?>
                                                    <a class="setup-btns-event d-none pro-btn show-reserve product-footer" 
                                                    onclick="<?= (!empty($id) && intval($id)>0?'reservePosition(this,'.intval($p['position_info']['info']['id']).');':'loginError(this);') ?>" title="رزرو">
                                                        <i class="fe fe-bell tx-20-f"></i>
                                                    </a>
                                                <?php } if(!empty($p['company_info']['info']['title'])){ ?>
            									    <a href="<?= base_url('show_company/'.str_replace(' ','--',$p['company_info']['info']['title'])) ?>" class="setup-btns-event d-none pro-btn product-footer" 
                                                    title="کسب و کار">
                                                        <i class="far fa-address-card text-white tx-20-f"></i>
                                                    </a>
            									<?php } if(!empty($p['position_info']['map']) && !empty(trim($p['position_info']['map']))){ ?>
                                                    <a class="setup-btns-event d-none pro-btn show-map product-footer" 
                                                    onclick="mapMarkerChangeLocationImage('position',true,<?= (!empty($p['company_info']['info']['id'])&&intval($p['company_info']['info']['id'])>0?intval($p['company_info']['info']['id']):0) ?>,0,<?= intval($p['position_info']['info']['id']) ?>,0);" title="محل">
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
                                                <?php } ?>
                                                <a class="setup-btns-click pro-btn product-footer" onclick="setupBtnsClick(this);" title="بیشتر">
                                                    <i class="fa fa-cog fa-spin tx-20-f text-warning"></i>
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
                            if(!empty($p['product_info']) && !empty($p['product_info']['info']['id']) && intval($p['product_info']['info']['id'])>0 && !in_array(intval($p['product_info']['info']['id']),$product_ids)){ 
                                $product_ids[]=intval($p['product_info']['info']['id']);
                                $include .= (!empty($p['product_info']['map'])?$p['product_info']['map']:''); ?>
                                <!--
                                <script>
                                    productInfo.push({
                                        id:<?= intval($p['product_info']['info']['id']) ?>,
                                        icon:"<?= (!empty($p['product_info']['info']['icon'])?$p['product_info']['info']['icon']:'') ?>",
                                        price:"<?= (!empty($p['product_info']['info']['price'])?$p['product_info']['info']['price']:'') ?>",
                                        values:'<?= (!empty($p['product_info']['key_value'])?json_encode($p['product_info']['key_value']):'') ?>',
                                        title:"<?= (!empty($p['product_info']['info']['title'])?$p['product_info']['info']['title']:'') ?>",
                                        key:"<?= (!empty($p['product_info']['info']['key'])?$p['product_info']['info']['key']:'') ?>",
                                        description:"<?= (!empty($p['product_info']['info']['description'])?$p['product_info']['info']['description']:'') ?>",
                                    })
                                </script>
                                -->
                            <?php } ?>	
                        <?php } ?>
                    </div>
                </div>
				<div class="card-footer">
					<?= $include ?>
				</div>
            </div>
        </div>
        <div class="col-12 mb-2">
		    <img style="border-radius:20px;opacity:0.7;width:100%;height:310px" src="<?= base_url('assets/pic/loby.jpg') ?>">
		</div>
    <?php } ?>