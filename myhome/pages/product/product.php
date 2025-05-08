<?php $date=new JDF();
$include=''; 
if(!empty($data) && !empty($data['id']) && intval($data['id'])>0 && !empty($data['info'])){ 
    echo (!empty($data['map'])?$data['map']:''); ?>
    <div class="row row-sm mt-4">
        <div class="col-lg-4">
    	    <div class="card mg-b-20">
    		    <div class="card-body">
    			    <div class="pl-0">
    					<div class="main-profile-overview">
    					    <div class="main-img-user profile-user">
    						    <img alt="product image" src="<?= base_url('assets/svg/product/'.(!empty($data['info']['icon'])?$data['info']['icon']:'product.svg')) ?>">
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
    							    <?php if(!empty($data['info']['status']) && intval($data['info']['status'])>0){ 
    							        if(!empty($data['info']['price']) && intval($data['info']['price'])>0){ ?>
            							    <a class="mb-1 rounded-10 pt-3 bg-success text-center col-12 setup-btns-event pro-btn product-footer" 
            							    onclick="<?= (!empty($id) && intval($id)>0?'forceBuy(this);':'loginError(this);') ?>"
                                            title="خرید آنی">
                                                <i class="si si-credit-card tx-70-f"></i>
                                                <p class="py-1">
                                                    خرید آنی
                                                </p>
                                            </a>
                                            <span class="buyProductCount d-none mb-1 rounded-10 py-3 bg-primary text-center col-12 setup-btns-event pro-btn product-footer">
                                                <label for="#buyProductCount">تعداد:</label>
                                                <input onchange="buyProductCountChange(this);" type="number" step="1" value="1" min="1" id="buyProductCount" class="w-25 text-center mx-auto mb-2 shadow-light rounded-10 form-control">
                                                <a class="btn btn-success rounded-10 px-5 py-3 text-center" 
                                                data-target="#buyProductNow"
                                                data-toggle="modal">
                                                    <i class="si si-basket-loaded tx-20-f"></i>
                                                    سفارش فوری
                                                    </a>
                                            </span>
                                        <?php }else{ ?>
                                            <span class="mb-1 rounded-10 py-5 bg-success text-center col-12 setup-btns-event pro-btn product-footer">
                                                محصول به صورت حضوری رایگان است
                                            </span>
                                        <?php } 
                                    }else{ ?>
                                        <span class="mb-1 rounded-10 py-5 bg-danger text-center col-12 setup-btns-event pro-btn product-footer">
                                            موجودی محصول کافی نیست
                                        </span>
    								<?php }
    								if(!empty($company['info']['title'])){ ?>
                						<a href="<?= base_url('show_company/'.str_replace(' ','--',$company['info']['title'])) ?>" 
                						class="mb-1 rounded-10 pt-3 bg-light text-center col-6 setup-btns-event pro-btn product-footer" 
                                        title="کسب و کار">
                                            <i class="far fa-address-card text-white tx-70-f"></i>
                                            <p class="py-1">
                                                کسب و کار
                                            </p>
                                        </a>
                					<?php } if(!empty($data['image']) && !empty(trim($data['image']))) { ?>
                                        <a class="mb-1 rounded-10 pt-3 bg-secondary text-center col-6 show-image setup-btns-event pro-btn product-footer" 
                                        onclick="productElementsTools(this,'image',<?= intval($data['id']) ?>);"
                                        title="عکس">
                                            <i class="la la-image tx-70-f"></i>
                                            <p class="py-1">
                                                عکس
                                            </p>
                                        </a>
                                    <?php } 
                                    if(!empty($data['video']) && !empty(trim($data['video']))) { ?>
                                        <a class="mb-1 rounded-10 pt-3 bg-primary text-center col-6 show-video setup-btns-event  pro-btn product-footer" 
                                        onclick="productElementsTools(this,'video',<?= intval($data['id']) ?>);"
                                        title="فیلم">
                                            <i class="la la-film tx-70-f"></i>
                                            <p class="py-1">
                                                فیلم
                                            </p>
                                        </a>
                    				<?php } 
                    				
                                    if(!empty($data['chat']) && !empty(trim($data['chat']))) { ?>
                                        <a class="mb-1 rounded-10 pt-3 bg-warning text-center col-6 show-chat setup-btns-event  pro-btn product-footer" 
                                        onclick="productElementsTools(this,'chat',<?= intval($data['id']) ?>);"
                                        title="نظرات">
                                            <i class="icon ion-md-chatboxes tx-70-f"></i>
                                            <p style="position: relative;top: -30px">
                                                نظرات
                                            </p>
                                        </a>
                                    <?php } 
                                    if(!empty($data['chart']) && !empty(trim($data['chart']))) { ?>
                                        <a class="mb-1 rounded-10 pt-3 bg-success text-center col-6 setup-btns-event pro-btn show-chart product-footer" 
                                        onclick="showChartProductId(<?= intval($data['id']) ?>);"
                                        title="نمودار">
                                            <i class="icon ion-ios-stats tx-70-f"></i>
                                            <p style="position: relative;top: -30px">
                                                نمودار
                                            </p>
                                        </a>
                                    <?php } 
                                    if(!empty($data['map']) && !empty(trim($data['map']))) { ?>
                                        <a class="mb-1 rounded-10 pt-3 bg-danger text-center col-6 setup-btns-event pro-btn show-map product-footer" 
                                        onclick="mapMarkerChangeLocationImage('product',true,<?= (!empty($company['id']) && intval($company['id'])>0?intval($company['id']):0) ?>,0,<?= (!empty($position) && is_array($position) && count($position)>0 && !empty($position['0']) && !empty($position['0']['id']) && intval($position['0']['id'])>0?(count($position)>1 && !empty($position[array_search('1',array_values(array_column(array_column($position,'info'),'status')))])?$position[array_search('1',array_values(array_column(array_column($position,'info'),'status')))]['id']:intval($position['0']['id'])):0) ?>,<?= intval($data['id']) ?>);"
                                        title="محل">
                                            <i class="si si-location-pin tx-70-f"></i>
                                            <p class="py-1">
                                                محل
                                            </p>
                                        </a>
                                    <?php }
                                    if(!empty($data['key_value']) && !empty(trim($data['key_value']))){ ?>
                                        <a class="mb-1 rounded-10 pt-3 bg-info text-center col-6 setup-btns-event  pro-btn show-key-value product-footer"
                                        onclick="productElementsTools(this,'key-value',<?= intval($data['id']) ?>);"
                                        title="ویژگی">
                                            <i class="icon ion-ios-list-box tx-70-f"></i>
                                            <p style="position: relative;top: -30px">
                                                ویژگی
                                            </p>
                                        </a>
                                    <?php }
                                    if(!empty($data['tel']) && !empty(trim($data['tel']))){ ?>
                                        <a class="mb-1 rounded-10 pt-3 bg-success text-center col-6 show-tel setup-btns-event  pro-btn product-footer"
                                        onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($data['id']).');':'loginError(this);') ?>"
                                        title="تماس">
                                            <i class="si si-call-out tx-70-f"></i>
                                            <p class="py-1">
                                                تماس
                                            </p>
                                        </a>
                                    <?php } 
                                    $rree=(!empty($position) && is_array($position) && count($position)>0 && !empty($position['0']) && !empty($position['0']['id']) && intval($position['0']['id'])>0?(count($position)>1 && !empty($position[array_search('1',array_values(array_column(array_column($position,'info'),'status')))])?$position[array_search('1',array_values(array_column(array_column($position,'info'),'status')))]['id']:intval($position['0']['id'])):0);
                                    if(empty($data['reserve']) && intval($rree)>0) { ?>
                                        <a class="mb-1 rounded-10 pt-3 bg-primary text-center col-12 setup-btns-event pro-btn product-footer" 
                                        onclick="<?= (!empty($id) && intval($id)>0?'reserveProductInPosition(this,'.$rree.','.intval($data['id']).');':'loginError(this);') ?>"
                                        title="رزرو">
                                            <i class="fe fe-bell tx-70-f"></i>
                                            <p class="py-1">
                                                رزرو
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
                                        <?php } if(!empty($data['key_value']) && !empty(trim($data['key_value']))) { ?>
                                            <div class="key-value d-none">
                                                <?= $data['key_value'] ?>
                                            </div>
                                        <?php }
                                        echo (!empty($data["chart"])?$data['chart']:'').(!empty($data["map"])?$data['map']:''); ?>
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
                						        <span class="hidden-xs">جایگاه های ارائه دهنده</span>
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
                				        <?php if(!empty($position)){ ?>
                                            <div class="row" style="height:335px;">
                                                <?php foreach($position as $po){
                                                if(!empty($po['info']['id']) &&
                                                intval($po['info']['id'])>0){ 
                                                    $include.= (!empty($po['map'])?$po['map']:''); ?>
                                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 p-0">
                                                        <div class="card rounded-10 mb-0" title="<?= (!empty($po['info']['description'])?$po['info']['description']:'') ?>">
                                                            <img alt="product" class="img-fluid card-img-top ht-120 rounded-10" src="<?= base_url('assets/svg/position/'.(!empty($po['info']['icon'])?$po['info']['icon']:'position.svg'))?>">
                                                            <span  class="<?= (!empty($po['info']['status']) && intval($po['info']['status'])>0?'pulse':'pulse-danger') ?>"></span>
                                                            <div class="rounded-10 card-img-overlay pd-30 bg-black-4 d-flex flex-column justify-content-center text-center p-3">
                                                                <a href="<?= base_url('position/'.intval($po['info']['id'])) ?>" class="tx-white tx-medium mg-y-10">
                                                                    <?= (!empty($po['info']['title'])?$po['info']['title']:'') ?>
                                                                </a>
                                                                <p class="tx-white-7 tx-small mg-b-15">
                                                                    <?= (!empty($po['info']['price'])?number_format($po['info']['price']).'تومان':'رایگان') ?>
                                                                </p>
                                                                <p class="tx-13 mg-b-0" style="gap: 5px;display: flex;flex-wrap: wrap;flex-direction: row;align-content: stretch;justify-content: center;align-items: stretch;">
                                                                    
                                                                    <?php if(!empty($po['map']) && !empty(trim($po['map']))){ ?>
                                                                        <a class="setup-btns-event d-none pro-btn show-map product-footer" onclick="mapMarkerChangeLocationImage('position',true,0,0,<?= intval($po['info']['id']) ?>,0);" title="محل">
                                                                            <i class="si si-location-pin tx-20-f"></i>
                                                                        </a>
                                                                	<?php } if(!empty($po['tel']) && !empty(trim($po['tel']))){ ?>
                                                                        <a class="setup-btns-event d-none pro-btn show-tel product-footer" onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($po['info']['id']).');':'loginError(this);') ?>" title="تماس">
                                                                            <i class="si si-call-out tx-20-f"></i>
                                                                        </a>
                                                                    <?php } if(!empty($po['chat']) && !empty(trim($po['chat']))){ ?>
                                                                	    <a class="setup-btns-event d-none pro-btn show-chat product-footer" onclick="productElementsTools(this,'chat',<?= intval($po['info']['id']) ?>);" title="نظرات">
                                                                            <i class="icon ion-md-chatboxes tx-20-f"></i>
                                                                        </a>
                                                                    <?php } if(!empty($po['image']) && !empty(trim($po['image']))){ ?>
                                                                	    <a class="setup-btns-event d-none pro-btn show-image product-footer" onclick="productElementsTools(this,'image',<?= intval($po['info']['id']) ?>);" title="عکس">
                                                                            <i class="la la-image tx-20-f"></i>
                                                                        </a>
                                                                    <?php }if(!empty($po['video']) && !empty(trim($po['video']))){ ?>
                                                                	    <a class="setup-btns-event d-none pro-btn show-video product-footer" onclick="productElementsTools(this,'video',<?= intval($po['info']['id']) ?>);" title="فیلم">
                                                                            <i class="la la-film tx-20-f"></i>
                                                                        </a>
                                                                    <?php }
                                                                    if(empty($po['reserve'])){ ?>
                                                                        <a class="setup-btns-event d-none pro-btn show-reserve product-footer" 
                                                                        onclick="<?= (!empty($id) && intval($id)>0?'reservePosition(this,'.intval($po['info']['id']).');':'loginError(this);') ?>" title="رزرو">
                                                                            <i class="fe fe-bell tx-20-f"></i>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <a class="setup-btns-click pro-btn product-footer" onclick="setupBtnsClick(this);" title="بیشتر">
                                                                        <i class="fa fa-cog fa-spin tx-20-f"></i>
                                                                    </a>
                                                                </p>
                                                                <span class="show-div-setting">
                                                                    <?php if(!empty($id) && intval($id)>0 && !empty($po['tel']) && !empty(trim($po['tel']))){ ?>
                                                                        <div class="tel d-none">
                                                                            <?= trim($po['tel']) ?>
                                                                        </div>
                                                                    <?php } if(!empty($po['chat']) && is_string($po['chat']) && !empty(trim($po['chat']))){ ?>
                                                                        <div class="chat d-none" id="chatmodelposition<?= intval($po['info']['id']) ?>">
                                                                            <?= trim($po['chat']) ?>
                                                                        </div>
                                                                    <?php } if(!empty($po['image']) && is_string($po['image']) && !empty(trim($po['image']))){ ?>
                                                                        <div class="image d-none">
                                                                            <?= trim($po['image']) ?>
                                                                        </div>
                                                                    <?php } if(!empty($po['video']) && is_string($po['video']) && !empty(trim($po['video']))){ ?>
                                                                        <div class="video d-none">
                                                                            <?= trim($po['video']) ?>
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
                					<div class="tab-pane" style="max-height: 370px;overflow-y: auto;overflow-x: hidden;" id="companyPositions">
                						<?php if(!empty($data['reserve'])){ ?>
                				            <div class="row" style="height:335px;">
                				                <div class="col-12">
                        				            <?php
                        				            foreach(array_reverse($data['reserve']) as $res){
                                			            if(!empty($res) && !empty($res['position_user_info'])){ 
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
                                			                }
                                                            ?>
                                    			            <div>
                                    			                <div onclick="showProductsInRes(this);" class="list d-flex align-items-center border-bottom p-3">
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
                                                        				    <!--<small>-->
                                                        				    <!--    قیمت جایگاه با مالیات:<?= (!empty($total_price) && intval($total_price)>0?number_format($total_price).'تومان':'رایگان') ?>-->
                                                        				    <!--</small>-->
                                                        				    <!--<br>-->
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
                                                            					زمان حضور:<?= (!empty($res['position_user_info']["date_reserve"])?$date->jdate('h:i Y/m/d',strtotime($res['position_user_info']["date_reserve"])):'تعیین نشده') ?>
                                                        				    </small>
                                                        				    <br>
                                                        				    
                                                        				</div>
                                                    				<?php } ?>
                                    			                </div>
                                        			            <div class="order-products d-none">
                                        			                <?php 
                                                            	    $show_controll=false;
                                                            		foreach ($res['position_product_order_info'] as $o) {
                                                            		    if(!empty($o) && intval($o)>0 && intval($data['id'])==intval($o)){
                                                            		        $p_info=$data['info'];
                                                            				$show_controll=true; 
                                                            				?>
                                                            				<div class="list-group-item d-flex text-center product-id-<?= 
                                                            				(!empty($p_info["id"]) && intval($p_info["id"])>0?intval($p_info["id"]):0) ?> 
                                                            				company-id-<?= (!empty($company['info']['id']) && intval($company['info']['id'])>0?intval($company['info']['id']):0) ?>
                                                            				position-id-<?= (!empty($pos_info['id']) && intval($pos_info['id'])>0?intval($pos_info['id']):'0') ?> align-items-center">
                                                            				    <div class="ml-3">
                                                            					    <span class="avatar avatar-lg brround cover-image" 
                                                            						data-image-src="<?= 
                                                            						    (!empty($p_info["icon"])?base_url('assets/svg/product/'.$p_info["icon"]):
                                                            							(!empty($pos_info['icon'])?base_url('assets/svg/position/'.$pos_info['icon']):
                                                            							(!empty($company['info']['icon'])?base_url('assets/svg/company/'.$company['info']['icon']):
                                                            							base_url('assets/svg/product/product.svg')))) ?>" 
                                                            						style="background: url(&quot;<?= 
                                                            						    (!empty($p_info["icon"])?base_url('assets/svg/product/'.$p_info["icon"]):
                                                            							(!empty($pos_info['icon'])?base_url('assets/svg/position/'.$pos_info['icon']):
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
                                                            						<p style="max-width: 140px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;margin-bottom: 5px;" title="<?= (!empty($p_info['description'])?$p_info['description']:'') ?>">
                                                            						    <?= (!empty($p_info['description'])?$p_info['description']:'') ?>
                                                            						</p>
                                                            						<div class="small text-muted">
                                                            						    قیمت:<?= (!empty($p_info["price"]) && intval($p_info["price"])>0?number_format($p_info["price"]).'تومان':'رایگان') ?>	
                                                                						<br>
                                                                						<!--قیمت کل با مالیات:-->
                                                                						<?php 
                                                                				// 		$count_new=(!empty($res['position_product_order_info']['count']) && intval($res['position_product_order_info']['count'])>1?intval($res['position_product_order_info']['count']):1);
                                                                				// 		$step1=(!empty($p_info["price"]) && intval($p_info["price"])>0?intval($p_info["price"]*$count_new):0);
                                                                				// 		$step1=(intval($step1)>0?$step1+($step1*0.1):0);
                                                                				// 		echo (intval($step1)>0?number_format($step1).'تومان':'رایگان');
                                                                						if(!empty($p_info['status']) && intval($p_info['status'])>0){ ?>
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
                                                                						} ?>
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
                                                                                                    		<!--<p class="invoice-info-row">-->
                                                                                                    		<!--    <span>قیمت با 10% مالیات تراکنش</span>-->
                                                                                                    		<!--	<span class="product-total-result-tax"></span>-->
                                                                                                    		<!--</p>-->
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
                				        <?php }else{ 
                				            if(!empty($id) && intval($id)>0){ ?>
                    				            <div class="alert alert-danger rounded-10 text-center p-3">
                    				                شما قبلا از این محصول استفاده نکردید
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
    <div class="modal" id="buyProductNow" style="display:none;" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
            	    <h6 class="modal-title">فاکتور خرید</h6>
            	    <button aria-label="بستن" class="close" data-dismiss="modal" type="button">
            		    <span aria-hidden="true">×</span>
            		</button>
            	</div>
            	<div class="modal-body">
            	    <div style="overflow-y: auto;overflow-x: hidden;min-height: 200px;max-height: 410px;">
                        <p>
                            طبق این فاکتور محصول 
                            <?= (!empty($data['info']['title'])?$data['info']['title']:'') ?>
                            به مبلغ
                            <?= (!empty($data['info']['price']) && intval($data['info']['price'])>0?number_format($data['info']['price']).' تومان':'رایگان') ?>
                            به تعداد
                            <span class="product-count-result">1</span>
                            عدد
                            برای شما سفارش شده که می توانید هم اکنون مبلغ را با درگاه مستقیم پرداخت کنید و مبلغ 
                            <span class="product-total-result">
                                <!--+($data['info']['price']*0.1)-->
                                <?= (!empty($data['info']['price']) && intval($data['info']['price'])>0?number_format($data['info']['price']):0) ?> تومان
                            </span>
                            را 
                            <!--با احتساب مالیات-->
                            به حساب ارائه دهنده واریز کنید
                            <br>
                            <br>
                            <br>
                            <br>
                            <strong>
                                مبلغ پرداختی:
                                <span class="product-total-result">
                                <!--+($data['info']['price']*0.1)-->
                                <?= (!empty($data['info']['price']) && intval($data['info']['price'])>0?number_format($data['info']['price']):0) ?> تومان
                            </span>
                            </strong>
                            <br>
                            <br>
                            <strong>
                                موجودی فعلی: 
                                <?= (!empty($_SESSION['my_wallet']['value'])?number_format($_SESSION['my_wallet']['value']):0) ?>
                                تومان
                            </strong>
                        </p>
            	    </div>
            	</div>
            	<div class="modal-footer">
            	    <div class="row w-100 px-0 mx-0">
            	        <div class="col-6">
            	            <a class="btn btn-block btn-warning rounded-10 p-3" href="<?= base_url('add_wallet_value') ?>">
                    	        افزودن موجودی
                    	    </a>
            	        </div>
            	        <div class="col-6">
                    	    <a class="btn btn-block btn-success rounded-10 p-3" onclick="payProductNow();">
                    	        پرداخت
                    	    </a>
            	        </div>
            	    </div>
            	</div>
            </div>
        </div>
    </div>
    <?= $include ?>
    <script>
        var count=1;
        function forceBuy(el){
            $(el).addClass('d-none');
            $(el).parent().find('.buyProductCount').removeClass('d-none');
            return true;
        }
        function showProductsInRes(el){
            $(el).parent().find('.order-products').removeClass('d-none');
        }
        function buyProductCountChange(el){
            let c,d,e,a=$(el).val(),b=<?= (!empty($data['info']['price']) && intval($data['info']['price'])>0?intval($data['info']['price']):0) ?>;
            $('#buyProductNow').find('.product-count-result').html(a);
            c=a*b;
            // d=c*0.1;
            // e=c+d;
            count=a;
            $('#buyProductNow').find('.product-total-result').html(String(c).replace(/(.)(?=(\d{3})+$)/g,'$1,')+' تومان');
            return true;
        }
        function payProductNow(){
            // console.log(count);
            sendAjax({count:count,id:<?= intval($data['id']) ?>},baseUrl('product/dashbord/pay_product_now'),'');
            return true;
        }
    </script>
<?php } ?>