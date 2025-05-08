<div class="none-position p-0">
    <?php $date=new JDF();
    $numbers=0;
    if(!empty($my_position) && is_array($my_position))
    foreach (array_reverse($my_position) as $p) {
        $price=$total_price=0;
        if(!(!empty($p['info']))){ ?> 
            <div class="<?= (!empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'bg-dark':'') ?> rounded-10 list-group-item"  id="nonePositionUserId<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):'') ?>">
                <input type="hidden" class="userPositionIdInput" value="<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):'') ?>">
                <div onclick="showPositionOrderNonePosition(this);" class="inf w-100 py-3" style="display: flex;flex-wrap: nowrap;flex-direction: row;gap: 12px;justify-content: center;align-items: center;">
            	    <span class="avatar avatar-lg brround cover-image" data-image-src="<?= (!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):base_url('assets/svg/position/position.svg')) ?>" 
            		style="background: url(&quot;<?= (!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):base_url('assets/svg/position/position.svg')) ?>&quot;) center center;">
            		    <span class="avatar-status bg-success"></span>
            		</span>
            		<strong style="max-width: 140px;word-break: keep-all;text-overflow: ellipsis;overflow: hidden;">
            		    <?= (!empty($p["company_info"]['title'])?$p["company_info"]['title']:'') ?>
            		</strong>
            		<div class="small text-muted">
            		    <span class="text-warning">
            			    قیمت کل:
            			    <?= (!empty($p['product_order'])?number_format(array_sum(array_column(array_values($p['product_order']), 'price'))):0) ?>
            			    تومان
            			</span>
            		</div>
            		<span class="tx-8-f pt-1 m-1 badge bg-success-transparent text-success">
            		    <?= $date->jdate('H:i Y/m/d',$p['time']) ?>
            		</span>
            		<?php if(!empty($p['status']) && intval($p['status'])===6){ ?>
                	    <span class="tx-8-f pt-1 m-1 badge bg-success-transparent text-success">
                    	    اتمام خدمات 
                		</span>
            		<?php } ?>
            		
            	</div>
            	<div style="box-shadow: 0px 0px 15px #938c8c;border-radius: 10px;" class="order bg-light <?= (!empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'':'d-none') ?>">
            	    <div class="col mt-2 <?= (!empty($_GET['call']) && $_GET['call']=='menu' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'d-none':'') ?>">
            		    <a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hidePositionOrderNonePosition(this);" style="margin-bottom:-25px;text-align: right;display: block;">
                		    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to menu">
                		</a>
                    	<?php if(!empty($p['company_other_product']) && !empty(end($p['company_other_product'])['info']["id"])){ ?>
                    	    <a class="btn btn-dark-gradient rounded-10 wd-25 ml-2 mr-auto p-0" onclick="showCompanyOtherProduct(this);" style="text-align: right;display: block;">
                    		    <img class="w-100 h-100" src="<?= base_url('assets/svg/icon/add.svg') ?>" alt="add product for buy">
                    		</a>
                    	<?php } ?>
                	</div>
            		<div class="col-12 <?= (!empty($_GET['call']) && $_GET['call']=='menu' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'d-none':'') ?>" style="max-height: 520px;overflow-x:hidden;overflow-y: auto;padding:0;">
            		    <?php if(!empty($p['product_order'])){
            				$show_controll=false;
            				foreach (array_reverse($p['product_order']) as $o) {
            				    if(!empty($o) && !empty($o["id"]) && intval($o["id"])>0 && 
            					!empty($o['product_info']["id"]) && intval($o['product_info']["id"])>0){ $numbers++;
            					    $show_controll=true; ?>
            						<div class="list-group-item d-flex text-center product-id-<?= (!empty($o['product_info']["id"]) && intval($o['product_info']["id"])>0?intval($o['product_info']["id"]):0) ?> company-id-<?= (!empty($p["company_info"]['id']) && intval($p["company_info"]['id'])>0?intval($p["company_info"]['id']):0) ?> position-id-<?= (!empty($p['info']['id']) && intval($p['info']['id'])>0?intval($p['info']['id']):'0') ?> align-items-center">
            						    <div class="ml-3">
            							    <span class="avatar avatar-lg brround cover-image" 
            								data-image-src="<?= 
            								(!empty($o['product_info']["icon"])?base_url('assets/svg/product/'.$o['product_info']["icon"]):
            								(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
            								(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
            								base_url('assets/svg/product/product.svg')))) ?>" 
            								style="background: url(&quot;<?= 
            								(!empty($o['product_info']["icon"])?base_url('assets/svg/product/'.$o['product_info']["icon"]):
            								(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
            								(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
            								base_url('assets/svg/product/product.svg')))) ?>&quot;) center center;">
                							    <span class="avatar-status <?= (!empty($o['product_info']['status']) && intval($o['product_info']['status'])>0?'bg-success':'bg-danger') ?>"></span>
            								</span>
            							</div>
            							<div style="max-height: 96px;width:100%;">
            							    <strong>
            								    <?= (!empty($o['product_info']['title'])?$o['product_info']['title']:
            									(!empty($o['product_info']['key'])?$o['product_info']['key']:''))?>
            								</strong>
            								<br>
            								<p style="max-width: 100%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;margin-bottom: 5px;" title="<?= (!empty($o['product_info']['description'])?$o['product_info']['description']:'') ?>">
            								    <?= (!empty($o['product_info']['description'])?$o['product_info']['description']:'') ?>
            								</p>
            								<div class="small text-muted">
            								    قیمت:<?= (!empty($o["price"]) && intval($o["price"])>0?number_format($o["price"]).'تومان':'رایگان') ?>	
            								<br>
            								<?php if(!empty($o['status']) && intval($o['status'])>0){ ?>
            								    <small class="text-success">
            									    حساب شده
            									</small>
            								<?php }else{
            								    if(!empty($o["price"]) && intval($o["price"])>0){ ?>
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
                								<a onclick="showPayProduct(this,<?= (!empty($o['product_info']['price']) && intval($o['product_info']['price'])>0?intval($o['product_info']['price']):0) ?>);">
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
                                            						    <img class="ht-100-f mx-auto rounded-50 w-auto mb-3" src="<?= base_url('assets/svg/product/'.(!empty($o['product_info']["icon"])?$o['product_info']["icon"]:'product.svg')) ?>">
                                            						</div>
                                            						<div class="col-12">
                                            						    <label class="tx-gray-600">صورت حساب داده شده برای جایگاه</label>
                                            							<div class="billed-to">
                                            							    <h6><?= (!empty($o['product_info']['title'])?$o['product_info']['title']:'') ?></h6>
                                        				                    <p>
                                                                    		    طبق این فاکتور محصول 
                                                                    			<?= (!empty($o['product_info']['title'])?$o['product_info']['title']:'') ?>
                                                                    			به مبلغ
                                                                    			<?= (!empty($o['product_info']['price']) && intval($o['product_info']['price'])>0?number_format($o['product_info']['price']).' تومان':'رایگان') ?>
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
                			if(!$show_controll){ ?>
                			    <div class="alert alert-danger text-center text-dark p-3">
                    			    در این جایگاه محصولی سفارش ندادید
                    			</div>
                			<?php }
                		}else{ ?>
                		    <div class="alert alert-danger text-center text-dark p-3">
                			    در این جایگاه محصولی سفارش ندادید
                			</div>
                		<?php } ?>
                	</div>
                	<div class="col-12 <?= (!empty($_GET['call']) && $_GET['call']=='menu' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'':'d-none') ?> company-other-product">
                	    <div class="row">
                		    <div class="col">
                			    <a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hideCompanyOtherProduct(this);" style="text-align: right;display: block;">
                				    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to position list">
                				</a>
                			</div>
                			<div class="col-12" style="max-height: 520px;overflow-x: hidden;overflow-y:auto;">
                			    <?php 
                			    $pro_numb=0;
                			    if(!empty($p['company_other_product'])){ 
                				    $a_array=[];
                					foreach ($p['company_other_product'] as $cop) { 
                					    if(!empty($cop['info']["id"]) && intval($cop['info']["id"])>0 && !in_array(intval($cop['info']["id"]),$a_array)){ 
                						    $a_array[]=intval($cop['info']["id"]); 
                						    $pro_numb++; ?>
                    						<div class="list-group-item d-flex text-center 
                    						product-id-<?= (!empty($cop['info']["id"]) && intval($cop['info']["id"])>0?
                    						intval($cop['info']["id"]):0) ?> 
                    						company-id-<?= (!empty($p["company_info"]['id']) && intval($p["company_info"]['id'])>0?
                    						intval($p["company_info"]['id']):0) ?> 
                    						position-id-<?= (!empty($p['info']['id']) && intval($p['info']['id'])>0?
                    						intval($p['info']['id']):'0') ?> align-items-center">
                    						    <div title="<?= (!empty($cop['info']['description'])?$cop['info']['description']:'') ?>" class="ml-3">
                    							    <span class="avatar avatar-lg brround cover-image" data-image-src="<?= 
                    								(!empty($cop['info']["icon"])?base_url('assets/svg/product/'.$cop['info']["icon"]):
                    								(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
                    								(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
                    								base_url('assets/svg/product/product.svg')))) ?>" style="background: url(&quot;<?= 
                    								(!empty($cop['info']["icon"])?base_url('assets/svg/product/'.$cop['info']["icon"]):
                    								(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
                    								(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
                    								base_url('assets/svg/product/product.svg')))) ?>&quot;) center center;">
                        							    <span class="avatar-status <?= (!empty($cop['info']['status']) && intval($cop['info']['status'])>0?'bg-success':'bg-danger') ?>">
                            							</span>
                    								</span>
                    							</div>
                    							<div title="<?= (!empty($cop['info']['description'])?$cop['info']['description']:'') ?>" style="max-width: 140px;max-height: 96px;word-break: keep-all;text-overflow: ellipsis;overflow: hidden;">
                    							    <strong>
                    								    <?= (!empty($cop['info']['title'])?$cop['info']['title']:(!empty($cop['info']['key'])?$cop['info']['key']:''))?>
                    								</strong>
                    								<div class="small text-muted">
                    								    <?= (!empty($cop['info']['price']) && intval($cop['info']['price'])>0?number_format($cop['info']['price']).'تومان':'رایگان') ?>
                    								</div>
                    							</div>
                    							<div class="mr-auto ml-2">
                    							    <div class="">
                    							        تعداد:
                    								    <br>
                    									<input type="number" value="1" min="1" class="product-count form-control text-center wd-50 p-0">
                    								</div>
                    								<?php if(!empty($cop['info']['status']) && intval($cop['info']['status'])>0){ ?>
                    								    <a onclick="reserveProductInPositionUser(this,<?= $p['user_position_id'].','.$cop['info']['id']?>);" class="btn btn-sm btn-light">
                    									    افزودن
                    									</a>
                    								<?php }else{ ?>
                    								    <small class="text-danger">
                    									    تمام شده
                    									</small>
                    								<?php } ?>
                    							</div>
                							</div>
                						<?php }
                					}
                				}if(!(intval($pro_numb)>0)){ ?>
                				    <div class="alert alert-danger text-center text-dark p-3">
                					    کالایی برای این جایگاه وجود ندارد
                					</div>
                				<?php } ?>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        <?php }
    } 
    if(!($numbers>0)){ ?>
        <div class="alert none-position alert-danger rounded-10 text-center p-3">
            شما هیچ خرید آنی موفقی ندارید
        </div>
    <?php } ?>
</div>