<!--must change-->
<div class="has-position">
    <script>let hasPositionArray=[];</script>
    <?php 
    $date=new JDF();
    if(!empty($my_position) && is_array($my_position)){
        $number_script=0;
        foreach (array_reverse($my_position) as $p) {
            $price=$total_price=0;
            if(!empty($p['info'])){ ?>
                <?php if(!empty($p['info']['price']) && intval($p['info']['price'])>0){
                    if(!empty($p["time_reserve"]) && $p["time_reserve"]!== '00:00:00'){
                        $ex=explode(':',$p["time_reserve"]);
                        if(!empty($ex)){
                            $price+=(!empty($ex['0']) && intval($ex['0'])>0?intval($ex['0']*$p['info']['price']):0);
                            $sum_min=intval($p['info']['price']/60);
                            $sum_sec=intval($p['info']['price']/3600);
                            $price+=(!empty($ex['1']) && intval($ex['1'])>0?intval($sum_min*$ex['1']):0);
                            $price+=(!empty($ex['2']) && intval($ex['2'])>0?intval($sum_sec*$ex['2']):0);
                        }
                        // var_dump($price);
                        // die();
                    // }else{
                    //     $price=0; 
                    }
                // }else{
                //     $price=(!empty($p['info']['price']) && intval($p['info']['price'])>0?intval($p['info']['price']):0);
                }
                $total_price=$price; ?>
                <div style="display:flex;" class="list-group-item text-center company-id-<?= (!empty($p["company_info"]['id']) && intval($p["company_info"]['id'])>0?intval($p["company_info"]['id']):0) ?> position-id-<?= (!empty($p['info']['id']) && intval($p['info']['id'])>0?intval($p['info']['id']):'0') ?> align-items-center">
                    <input type="hidden" class="userPositionIdInput" value="<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):'') ?>">
                    <!--company_info-->
                    <div class="<?= ((!empty($_GET['action']) && $_GET['action']=='calender' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))||
                    (!empty($_GET['action']) && $_GET['action']=='form' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))||(!empty($_GET['action']) && $_GET['action']=='reserve' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))?'d-none':'') ?> inf ml-3">
                	    <span class="avatar avatar-lg brround cover-image" 
                		data-image-src="<?= 
                		(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
                		(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
                		base_url('assets/svg/position/position.svg'))) ?>" 
                		style="background: url(&quot;<?= 
                		(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
                		(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
                		base_url('assets/svg/position/position.svg'))) ?>&quot;) center center;">
                		    <span class="avatar-status <?= (!empty($p['info']["status"]) && intval($p['info']["status"])>0?'bg-success':'bg-danger') ?>"></span>
                		</span>
                	</div>
                	<!--/company_info-->
                	<!--factor info-->
                	<div class="<?= ((!empty($_GET['action']) && $_GET['action']=='calender' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))||
                	(!empty($_GET['action']) && $_GET['action']=='form' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))||(!empty($_GET['action']) && $_GET['action']=='reserve' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))?'d-none':'') ?> inf" title="<?= (!empty($p['info']['description'])?$p['info']['description']:'') ?>">
                	    <strong style="max-width: 140px;word-break: keep-all;text-overflow: ellipsis;overflow: hidden;"><?= (!empty($p['info']['title'])?$p['info']['title']:'') ?></strong>
                		<div class="small text-warning mt-1">
                			<?php if(!empty($p['info']['price']) && intval($p['info']['price'])>0){ ?>
                    			<small>
                    			    قیمت رزرو هر ساعت:<?= number_format($p['info']['price']).'تومان' ?>
                    		    </small>
                    			<br>
                			<?php } if(!empty($total_price) && intval($total_price)>0){ ?>
                    			<small>
                    			    قیمت کل با مالیات:<?= number_format($total_price).'تومان' ?>
                    			</small>
                    			<br>
                			<?php } if(!empty($p["factor"])){ ?>
                    		    <small class="text-success">
                    			    پرداخت شده
                    			</small>
                			<?php } else{ 
                			    if(!empty($p['info']['price'])){ ?>
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
                	<!--factor info-->
                	<!--reserve time info-->
                	<div class="<?= ((!empty($_GET['action']) && $_GET['action']=='calender' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))||
                	(!empty($_GET['action']) && $_GET['action']=='form' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))||
                	(!empty($_GET['action']) && $_GET['action']=='reserve' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))?'d-none':'') ?> inf" title="<?= (!empty($p['info']['description'])?$p['info']['description']:'') ?>">
                		<div class="small text-info mx-2">
                			<small>
                    		    <?= (!(!empty($p['info']['position_type']) && intval($p['info']['position_type'])>0)
                    		    ?'حضوری'
                    		    :'مجازی') ?>
                			</small>
                			<br>
                			<?php if(!empty($p["date_reserve"])){ ?>
                    		    <small>
                        		    زمان حضور: <?= $date->jdate('H:i Y/m/d',$p["date_reserve"]) ?>
                    			</small>
                    			<br>
                			<?php } if(!empty($p["time_reserve"]) && $p["time_reserve"] !== '00:00:00'){ ?>
                    			<small>
                        		    مدت رزرو: <?= $p["time_reserve"] .' ساعت' ?>
                    			</small>
                    			<br>
                			<?php } if(!empty($p["exiting_time"])){ ?>
                    			<small>
                        		    زمان خروج: <?= $date->jdate('H:i Y/m/d',$p["exiting_time"]) ?>
                    			</small>
                			<?php } ?>
                		</div>
                	</div>
                    <!--reserve time info-->
                	<!--controll tools-->
                	<div class="<?= ((!empty($_GET['action']) && $_GET['action']=='calender' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))||
                	(!empty($_GET['action']) && $_GET['action']=='form' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))
                	||(!empty($_GET['action']) && $_GET['action']=='reserve' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id']))?'d-none':'') ?> mr-auto ml-3 inf" style="display: flex;max-height: 70px;gap: 10px;flex-direction: column;flex-wrap: wrap;align-content: flex-end;justify-content: space-between;align-items: stretch;">
                	    <?php if(!empty($p['info']['deleted_at'])){ ?>
                	        <small class="text-danger">خارج از دسترس</small>
                	    <?php }else{
                	        if(!(!empty($p['status']) && intval($p['status'])>0) || empty($p["date_reserve"])){ 
                	            $form_check=$form_check_handler=false;
                	            if(!empty($p['position_form'])){
                    	            foreach($p['position_form'] as $form_p){
                    	                if(!empty($form_p) && !empty($form_p['question']['status']) && intval($form_p['question']['status'])==1 && empty($form_p['answer']))
                    	                    if(!empty($form_p['question']['required']) && intval($form_p['question']['required'])==1){
                    	                        $form_check=true;
                    	                        break;
                        	                }else{
                        	                    $form_check_handler=true;
                        	                }
                    	            }
                	            }if(!$form_check){ ?>
                            		<a onclick="showCalenderPosition(this);" title="تعیین زمان رزرو">
                            		    <i class="fe fe-calendar tx-20-f"></i>
                            		</a>
                        		<?php }
                        		if($form_check||$form_check_handler){ ?>
                        		    <a onclick="showFormPosition(this);" title="پر کردن فرم رزرو">
                            		    <i class="typcn typcn-document-text tx-20-f"></i>
                            		</a>
                    		    <?php } 
                	        } if(!empty($p['status']) && intval($p['status'])>0 && empty($p["factor"]) && 
                    		!empty($p['time_reserve']) && $p['time_reserve'] !== '00:00:00' &&
                    		!empty($p['info']['price']) && intval($p['info']['price'])>0){ ?>
                        	    <a onclick="showAccessReservePositionTime(this);" title="پرداخت هزینه ی رزرو جایگاه">
                        		    <i class="si si-credit-card tx-20-f"></i>
                        		</a>
                    		<?php } if(!empty($p['status']) && intval($p['status'])>0 && !(intval($p['status'])==6) && empty($p["factor"])){ ?>
                        		<a onclick="showTimeReservePositionTime(this);" title="تعیین مدت خدمات">
                            	    <i class="icon ion-md-alarm tx-20-f"></i>
                            	</a>
                        	<?php } if((!empty($p['company_other_product']) && !empty(end($p['company_other_product'])['info']["id"])) || !empty($p['product_order'])){ ?>
                        		<a onclick="showPositionOrder(this);" title="محصولات سفارش داده شده">
                        		    <span class="si si-basket-loaded tx-20-f">
                        			    <?php if(!empty($p['product_order'])){ ?>
                                            <i class="pulse bg-success" style="position: relative;top: -20px;right: 4px;"></i>
                                        <?php } ?>
                                    </span>
                        		</a>
                    		<?php } 
                		} ?>
                	</div>
                	<!--/controll tools-->
                	
                	<div class="<?= (!empty($_GET['action']) && $_GET['action']=='form' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'':'d-none') ?> form-position w-100">
                	    <div class="row">
                		    <div class="col-11 mx-auto text-center">
                			    <a class="btn btn-dark-gradient rounded-10 wd-25 f-right p-0" onclick="hideFormPosition(this);" style="text-align: right;display: block;">
                				    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to menu">
                				</a>
                    			<span>
                    			    فرم رزرو
                    			</span>
                    			<a class="float-left ml-2" 
                    			onclick="accessFormPositionUser(this,<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):0) ?>);" style="text-align: right;display: block;"
                    			title="ثبت فرم">
                    			    <i class="far fa-edit tx-20-f text-success"></i>
                    			</a>
                			</div>
                		</div>
                		<div class="row">
                		    <div class="col-11 mx-auto text-center">
                		        <?php if(!empty($p['position_form'])){ 
                		            foreach($p['position_form'] as $fo){ 
                		                if(!empty($fo) && !empty($fo['question']) && !empty($fo['question']["id"]) && intval($fo['question']["id"])>0 && !empty($fo['question']["status"]) && intval($fo['question']["status"])>0 && empty($fo['answer'])){ ?>
                		                <div class="form-group question">
                		                    <input type="hidden" value="<?= intval($fo['question']["id"]) ?>" class="formQuestionId">
                		                    <label class="form-label"><?= (!empty($fo['question']['question'])?$fo['question']['question']:'').(!empty($fo['question']["required"]) && intval($fo['question']["required"])>0?'(اجباری)':'(اختیاری)') ?></label>
                            			    <?php if(!empty($fo['question']["type_question"]) && $fo['question']["type_question"]=='image'){ 
                            			        echo $this->view('includes/uploader',['url'=>'assets---pic---position','type'=>'image'],true);
                            			    }else{ ?>
                            			        <input type="text" class="text-question form-control">
                            			    <?php } ?>
                		                </div>
                			            <?php } 
                		            }
                			    } ?>
                			</div>
                		</div>
                	</div>
                	
                	<div class="<?= (!empty($_GET['action']) && $_GET['action']=='calender' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'':'d-none') ?> calender-position w-100">
                	    <div class="row">
                		    <div class="col-11 mx-auto text-center">
                			    <a class="btn btn-dark-gradient rounded-10 wd-25 f-right p-0" onclick="hideCalenderPosition(this);" style="text-align: right;display: block;">
                				    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to menu">
                				</a>
                				<?php if(!empty($p['date_reserve'])){ ?>
                				    <span>
                    				    ویرایش زمان ورود
                    				</span>
                    				<a class="float-left ml-2" 
                    				onclick="accessTimePositionUser(this,<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):0) ?>);" style="text-align: right;display: block;"
                    				title="ویرایش زمان">
                    				    <i class="far fa-edit tx-20-f text-success"></i>
                    				</a>
                				<?php }else{ ?>
                    				<span>
                    				    تعیین زمان ورود
                    				</span>
                    				<a class="float-left ml-2" 
                    				onclick="accessTimePositionUser(this,<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):0) ?>);" style="text-align: right;display: block;"
                    				title="ثبت زمان">
                    				    <i class="far fa-calendar-check tx-20-f text-success"></i>
                    				</a>
                				<?php } ?>
                			</div>
                		</div>
                		<div class="row" style="">
                		    <div class="col-11 mx-auto">
                    		    <?= (!empty($p["order_time"])?$p["order_time"]:'<div class="alert alert-danger rounded-10 text-center p-3 text-dark">زمان مشخصی برای رزرو وجود ندارد</div>') ?>
                		        <span class="calIn ">
                			        <br>
                    			    <strong>نوبت های داده شده</strong>
                			        <br>
                			        <br>
                			        <?php $this->view('includes/calendar/reserve_position',['limited'=>(!empty($p['info']['count_reserve']) && intval($p['info']['count_reserve'])>0?$p['info']['count_reserve']:0),'selected_start'=>(!empty($p['date_reserve'])?strtotime($p['date_reserve']):0),'selected_end'=>(!empty($p['exiting_time'])?strtotime($p['exiting_time']):0),'reserve_position'=>$p['position_calendar']]) ?>
                		        </span>
                			</div>
                		</div>
                	</div>
                	
                	<div class="<?= (!empty($_GET['action']) && $_GET['action']=='buy' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'':'d-none') ?> factor-position-order" style="position: fixed;top: 0;background: #1f2940;bottom: 0;left: 0;right: 0;z-index: 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;">
                        <div class="row row-sm">
                    	    <div class="col-md-12 col-xl-12">
                    		    <div class="main-content-body-invoice" style="max-height: 600px;overflow-x:hidden;overflow-y: auto;padding:0;">
                    			    <div class="card card-invoice">
                    				    <div class="card-header p-0">
                    					    <a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hidAccessReservePositionTime(this);" style="text-align: right;display: block;" title="بستن">
                							    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to position list">
                						    </a>
                    					</div>
                    					<div class="card-body p-0">
                    					    <div class="text-center">
                    						    <h6 class="invoice-title">صورتحساب رزرو جایگاه</h6>
                    						</div>
                    						<div class="row mg-t-20">
                    						    <div class="col-12">
                    							    <img class="ht-100-f mx-auto rounded-50 w-auto mb-3" src="<?= base_url('assets/svg/position/'.(!empty($p['info']['icon'])?$p['info']['icon']:'position.svg')) ?>">
                    							</div>
                    							<div class="col-12">
                    							    <label class="tx-gray-600">صورت حساب داده شده برای جایگاه</label>
                    							    <div class="billed-to">
                    								    <h6><?= (!empty($p['info']['title'])?$p['info']['title']:'') ?></h6>
                				                        <p>به قیمت 
                				                        <?= (!empty($p['info']['price']) && intval($p['info']['price'])>0?number_format($p['info']['price']).'تومان':'رایگان') ?>
                				                        می باشد که برای شما به مدت 
                    				                    <?= (!empty($p["time_reserve"]) && $p["time_reserve"]!=='00:00:00'?$p["time_reserve"].' ساعت ':'یک ساعت') ?>
                				                        به صورت
                                                		<?= (!empty($p['info']['position_type']) && intval($p['info']['position_type'])>0?'حضوری':'مجازی') ?>
                				                        رزرو شده است و شما می توانید در ساعت 
                				                        <?= (!empty($p["date_reserve"]) && intval($p["date_reserve"])>0?$date->jdate('H:i Y/m/d',$p["date_reserve"]):'تعیین نشده') ?>
                				                        در جایگاه حاضر باشید
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
                    								    <span>مدت رزرو</span>
                    									<span><?= (!empty($p["time_reserve"]) && $p["time_reserve"]!=='00:00:00'?$p["time_reserve"].' ساعت ':'یک ساعت') ?></span>
                    								</p>
                    							    <p class="invoice-info-row">
                    								    <span>هزینه ی جایگاه در ساعت</span>
                    									<span><?= (!empty($p['info']['price']) && intval($p['info']['price'])>0?number_format($p['info']['price']).'تومان':'رایگان') ?></span>
                    								</p>
                    								<p class="invoice-info-row">
                    								    <span>هزینه ی کلی</span>
                    									<span><?= (!empty($price) && intval($price)>0?number_format($price).'تومان':'رایگان') ?></span>
                    								</p>
                    							</div>
                    						</div>
                    						<a class="btn btn-purple mt-3 btn-block" onclick="payPositionReserveNow(this,<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):0).','.(!empty($p['info']['id']) && intval($p['info']['id'])>0?intval($p['info']['id']):0) ?>);">
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
                	
                	<div class="<?= (!empty($_GET['action']) && $_GET['action']=='menu' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'':'d-none') ?> order" style="position: fixed;top: 0;background: #1f2940;bottom: 0;left: 0;right: 0;z-index: 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;">
                	    <div class="col mt-2 mb-4">
                		    <a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hidePositionOrder(this);" style="margin-bottom:-25px;text-align: right;display: block;">
                    		    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to menu">
                    		</a>
                    	    <?php if(!(!empty($p['status']) && intval($p['status'])==6) && !empty($p['company_other_product']) && !empty(end($p['company_other_product'])['info']["id"])){ ?>
                        	    <a class="btn btn-dark-gradient rounded-10 wd-25 ml-2 mr-auto p-0" onclick="showCompanyOtherProductHas(this);" style="text-align: right;display: block;">
                        		    <img class="w-100 h-100" src="<?= base_url('assets/svg/icon/add.svg') ?>" alt="add product for buy">
                        		</a>
                    	    <?php } ?>
                    	</div>
                		<div class="<?= (!empty($_GET['action']) && $_GET['action']=='menu' && !empty($_GET['call']) && $_GET['call']=='list' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'d-none':'') ?> col-12" style="max-height: 520px;overflow-x:hidden;overflow-y: auto;padding:0;">
                		    <?php if(!empty($p['product_order'])){
                			    $p['product_order']=array_reverse($p['product_order']);
                				$show_controll=false;
                				foreach ($p['product_order'] as $o) {
                				    if(!empty($o) && !empty($o["id"]) && intval($o["id"])>0 && 
                					!empty($o['product_info']["id"]) && intval($o['product_info']["id"])>0){ 
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
                								<p style="max-width: 140px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;margin-bottom: 5px;" title="<?= (!empty($o['product_info']['description'])?$o['product_info']['description']:'') ?>">
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
                								<?php } if(!empty($o['product_info']['deleted_at'])){ ?>
                								    <small class="text-danger">خارج از دسترس</small>
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
                                                                        			برای شما سفارش شده که می توانید هم اکنون آن را با اعتبار کیف پول خود پرداخت کنید
                                                                        			<!--و مبلغ -->
                                                                        			<!--<span class="product-total-result"></span>-->
                                                                        			<!--را به حساب ارائه دهنده واریز کنید-->
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
                		<div class="<?= (!empty($_GET['action']) && $_GET['action']=='menu' && !empty($_GET['call']) && $_GET['call']=='list' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'':'d-none') ?> col-12 company-other-product" style="position: fixed;top: 0;background: #1f2940;bottom: 0;left: 0;right: 0;z-index: 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;padding: 12px;">
                		    <div class="row">
                			    <div class="col">
                				    <a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hideCompanyOtherProductHas(this);" style="text-align: right;display: block;">
                					    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to position list">
                					</a>
                				</div>
                				<div class="col-12" style="max-height: 520px;overflow-x: hidden;overflow-y:auto;">
                				    <?php 
                				    $pro_num=0;
                				    if(!empty($p['company_other_product'])){ 
                					    $a_array=[];
                						foreach ($p['company_other_product'] as $cop) { 
                						    if(!empty($cop['info']["id"]) && intval($cop['info']["id"])>0 && !in_array(intval($cop['info']["id"]),$a_array)){ 
                							    $a_array[]=intval($cop['info']["id"]);
                							    $pro_num++;
                							    ?>
                    							<div class="list-group-item d-flex text-center 
                    							product-id-<?= (!empty($cop['info']["id"]) && intval($cop['info']["id"])>0?
                    							intval($cop['info']["id"]):0) ?> 
                    							company-id-<?= (!empty($p["company_info"]['id']) && intval($p["company_info"]['id'])>0?
                    							intval($p["company_info"]['id']):0) ?> 
                    							position-id-<?= (!empty($p['info']['id']) && intval($p['info']['id'])>0?
                    							intval($p['info']['id']):'0') ?> align-items-center">
                    							    <div title="<?= (!empty($cop['info']['description'])?$cop['info']['description']:'') ?>" class="ml-3">
                    								    <span class="avatar avatar-lg brround cover-image" 
                    									data-image-src="<?= 
                    									(!empty($cop['info']["icon"])?base_url('assets/svg/product/'.$cop['info']["icon"]):
                    									(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
                    									(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
                    									base_url('assets/svg/product/product.svg')))) ?>" 
                    									style="background: url(&quot;<?= 
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
                					}if(!(intval($pro_num)>0)){ ?>
                					    <div class="alert alert-danger text-center rounded-10 mt-3 text-dark p-3">
                						    کالایی برای این جایگاه وجود ندارد
                						</div>
                					<?php } ?>
                				</div>
                			</div>
                		</div>
                	</div>
                	
                	<div class="<?= (!empty($_GET['action']) && $_GET['action']=='reserve' && !empty($_GET['count']) && intval($_GET['count'])>0 && !empty($p['user_position_id']) && intval($p['user_position_id'])>0 && intval($_GET['count'])===intval($p['user_position_id'])?'':'d-none') ?> reserve-timer w-100">
                	    <div class="row">
                		    <div class="col-11 mx-auto text-center">
                			    <a class="btn btn-dark-gradient rounded-10 wd-25 f-right p-0" onclick="hideTimeReservePositionTime(this);" style="text-align: right;display: block;">
                				    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to menu">
                				</a>
                				<?php if(!empty($p['time_reserve']) && $p['time_reserve']!== '00:00:00'){ ?>
                            	    <span>
                            	        تغییر زمان خروج
                            	    </span>
                            	    <a class="f-left ml-2" 
                    				onclick="accessServiceTimerPositionUser(this,<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):0) ?>);" style="text-align: right;display: block;"
                    				title="ثبت زمان">
                    			        <i class="far fa-calendar-check tx-20-f text-success"></i>
                    				</a>
                                <?php }else{ ?>
                                    <span>
                            	        تعیین زمان خروج
                            	    </span>
                            	    <a class="f-left ml-2" 
                    				onclick="accessServiceTimerPositionUser(this,<?= (!empty($p['user_position_id']) && intval($p['user_position_id'])>0?intval($p['user_position_id']):0) ?>);" style="text-align: right;display: block;"
                    				title="ثبت زمان">
                    			        <i class="far fa-calendar-check tx-20-f text-success"></i>
                    				</a>
                                <?php } ?>
                			</div>
                		</div>
                		<div class="row">
                		    <div class="col-11 mx-auto">
                        	    <?php if(!empty($p['status']) && intval($p['status'])>0 && !(intval($p['status'])==6) && !empty($p["order_time_end"])){ 
                        		    echo $p['order_time_end'];
                        	    } ?>
                        	</div>
                	    </div>		        
                	</div>
                </div>
            <?php $number_script++;} ?>
        <?php } 
    } ?>
</div>