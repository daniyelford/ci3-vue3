	<?php if(!empty($product)){ ?>
	    <div class="col-12 mb-2" id="product">
		    <div class="card" style="margin: 0;height: 437px;">
		        <?php $include=''; ?>
			    <div class="card-header pb-1">
				    <h3 class="card-title mb-2">محصولات غیرفیزیکی</h3>
					<p class="tx-12 mb-0 text-muted">
					    محصولاتی که توسط کسب و کار های موجود ارائه نمی شوند(قیمت ها به <strong>تومان</strong> است)
					</p>
				</div>
				<div class="product-timeline card-body pt-2 mt-1" style="overflow:auto;max-height:350px;">
					<div class="table-responsive">
						    <table id="myTable" class="table w-100">
							    <thead>
									<tr>
                                        <th class="pb-2" style="min-width: 90px;padding: 0;">اسم محصول</th>
                                        <th class="pb-2" style="min-width: 95px;padding: 0;">قیمت</th>
                                        <th class="pb-2" style="min-width: 100px;padding: 0;"></th>
                                        <th class="pb-2"></th>
									</tr>
								</thead>
							    <tbody>
								    <?php
									foreach($product as $p){ 
									    if(!empty($p) && !empty($p['product_info'])){
    									    $pro=$p['product_info']; 
    									    if(!empty($pro['id']) && intval($pro['id'])>0){
        									    $include.=(!empty($pro["chart"])?$pro['chart']:'').(!empty($pro["map"])?$pro['map']:''); ?>
            								    <tr class="column-number-td">
                								    <td class="" title="<?= (!empty($pro['info']["description"])?$pro['info']["description"]:'') ?>">
                									    <a href="<?= base_url('product/'.intval($pro['id'])) ?>">
                									        <?= (!empty($pro['info']["title"])?$pro['info']["title"]:(!empty($pro['info']["key"])?$pro['info']["key"]:'')) ?>
                									    </a>
            										</td>
                									<td class="" title="<?= (!empty($pro['info']["description"])?$pro['info']["description"]:'') ?>">
                									    <?= (!empty($pro['info']['status']) && intval($pro['info']['status'])>0?(!empty($pro['info']["price"])?number_format($pro['info']["price"]):'تماس بگیرید'):'نا موجود') ?>
                									</td>
            										<td class="">
            										    <?php if(!empty($pro['image']) && !empty(trim($pro['image']))) { ?>
                                                            <a class="btn pro-btn m-0 show-image ht-35 product-footer wd-35 pd-4 rounded-10 btn-dark-gradient " 
                                                            style="line-height:9px" onclick="productElementsTools(this,'image',<?= intval($pro['id']) ?>);">
                                                                <i class="la la-image wd-20 mt-1"></i>
                                                                <small class="tx-8">
                                                                    عکس 
                                                                </small>
                                                            </a>
                                                        <?php } if(!empty($pro['video']) && !empty(trim($pro['video']))) { ?>
                                                            <a class="btn pro-btn m-0 show-video ht-35 wd-35 product-footer pd-4 rounded-10 btn-dark-gradient " 
                                                            style="line-height:9px" onclick="productElementsTools(this,'video',<?= intval($pro['id']) ?>);">
                                                                <i class="la la-film wd-20 mt-1"></i>
                                                                <small class="tx-8">
                                                                    فیلم
                                                                </small>
                                                            </a>
                										<?php } if(!empty($pro['tel']) && !empty(trim($pro['tel']))){ ?>
                                                            <a class="btn pro-btn m-0 show-tel product-footer pd-4 ht-35 wd-35 rounded-10 btn-dark-gradient"
                                                            style="line-height:9px" onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($pro['id']).');':'loginError(this);') ?>">
                                                                <i class="si si-call-out wd-20 mt-1"></i>
                                                                <small class="tx-8">
                                                                    تماس
                                                                </small>
                                                            </a>
                                                        <?php } if(!empty($pro['chat']) && !empty(trim($pro['chat']))) { ?>
                                                            <a class="btn pro-btn m-0 ht-35 show-chat product-footer pd-4 wd-35 rounded-10 btn-dark-gradient " 
                                                            style="line-height:9px" onclick="productElementsTools(this,'chat',<?= intval($pro['id']) ?>);">
                                                                <i class="icon ion-md-chatboxes wd-20 mt-1"></i>
                                                                <small class="tx-8">
                                                                    نظرات
                                                                </small>
                                                            </a>
                                                        <?php } if(!empty($pro['chart']) && !empty(trim($pro['chart']))) { ?>
                                                            <a class="btn pro-btn m-0 ht-35 show-chart product-footer pd-4 wd-35 rounded-10 btn-dark-gradient" 
                                                            style="line-height:9px" onclick="showChartProductId(<?= intval($pro['id']) ?>);">
                                                                <i class="wd-20 mt-1 icon ion-ios-stats"></i>
                                                                <small class="tx-8">
                                                                    نمودار
                                                                </small>
                                                            </a>
                                                        <?php } if(!empty($pro['map']) && !empty(trim($pro['map']))) { ?>
                                                            <a class="btn pro-btn m-0 ht-35 show-map product-footer pd-4 wd-35 rounded-10 btn-dark-gradient " 
                                                            style="line-height:9px" onclick="mapMarkerChangeLocationImage('product',true,0,0,0,<?= intval($pro['id']) ?>);">
                                                                <i class="si si-location-pin wd-20 mt-1"></i>
                                                                <small class="tx-8">
                                                                    محل 
                                                                </small>
                                                            </a>
                                                        <?php } if(!empty($pro['key_value']) && !empty(trim($pro['key_value']))) { ?>
                                                            <a class="btn pro-btn m-0 ht-35 show-key product-footer pd-4 wd-35 rounded-10 btn-dark-gradient " 
                                                            style="line-height:9px" onclick="productElementsTools(this,'key-value',<?= intval($pro['id']) ?>);">
                                                                <i class="icon ion-ios-list-box wd-20 mt-1"></i>
                                                                <small class="tx-8">
                                                                    ویژگی 
                                                                </small>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
            										<td class="show-div-setting">
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
                                                        <?php }
                                                        if(!empty($pro['key_value']) && !empty(trim($pro['key_value']))) { ?>
                                                            <div class="key-value d-none">
                                                                <?= $pro['key_value'] ?>
                                                            </div>
                                                        <?php } ?>
            										</td>
            									</tr>
									<?php
									        }
									    } 
									} ?>
								</tbody>
							</table>
				    </div>
				</div>
				<div class="card-footer">
					<?= $include ?>
				    <ul class="pagination pagination-lg pager" id="pager" style="overflow-x: auto;overflow-y: hidden;">
                    </ul>
				</div>
				<script>
    				$(document).ready(function(){
    					$('#myTable').DataTable({
                    		language: {
                    			searchPlaceholder: 'جستجو...',
                    			sSearch: '',
                    			lengthMenu: '_MENU_',
                    		}
                    	});
    				});
				    tblPagination('#myTable','#pager');
				</script>
			</div>
		</div>
	<?php } ?>