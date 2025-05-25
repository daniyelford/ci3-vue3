<?php $date=new JDF(); 
if(!empty($data) && is_array($data)){
    $my=(!empty($data['my_task']) && is_array($data['my_task'])?$data['my_task']:[]);
    $other=(!empty($data['other_task']) && is_array($data['other_task'])?$data['other_task']:[]); ?>
    <style>
        .b-d{
                border: 1px solid #ee335e !important;
        }
    </style>
    <div class="row row-sm mt-3">
    	<div class="col-lg-4 col-xl-3 col-md-12 col-sm-12">
    		<div class="card mg-b-20">
        		<div class="main-content-left main-content-left-mail card-body">
        		    <?php if(!empty($role_id) && intval($role_id)>0 && (intval($role_id)==1||intval($role_id)==8)){ ?>
        			    <a class="btn btn-primary btn-compose" onclick="addtask();" id="btnCompose">ایجاد وظیفه</a>
        			<?php } ?>
        			<div class="main-mail-menu">
        				<nav class="nav main-nav-column mg-b-20">
        				    <?php if(!empty($role_id) && intval($role_id)>0 && (intval($role_id)==1||intval($role_id)==8)){ ?>
        				        <a class="nav-link my active" onclick="showMytask(this);">
            					    <i class="bx bx-send mx-1"></i>
            					    ارجاع وظایف
            					</a>
        				    <?php }else{ ?>
                                <a class="nav-link other active" onclick="showOthertask(this);">
            					    <i class="bx bxs-inbox mx-1"></i>
            					    ظایف من
            					</a>
        				    <?php } ?>
        				</nav>
    					<label class="main-content-label main-content-label-sm">دسترسی سریع</label>
    					<nav class="nav main-nav-column">
    					    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('company_one') ?>">
    					        <i class="bx bx-folder-open mx-1"></i>
    					        کسب و کار مربوط</a>
    					    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('company_manager') ?>">
    					        <i class="bx bx-slider-alt mx-1"></i>
    					        همه کسب و کارها
    					    </a>
    					    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url() ?>">
    					        <i class="la la-home mx-1"></i>
    					        خانه
    					    </a>
    					</nav>
    			    </div>
    		    </div>
    	    </div>
    	</div>
    	<?php if(!empty($role_id) && intval($role_id)>0 && (intval($role_id)==1||intval($role_id)==8)){ 
    	    $chchch=false; ?>
        	<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12" id="from-me">
                <?php if(!empty($my)){ ?>
                    <div>
    					<h6 class="card-title mb-1">
    					    ارجاع وظایف به دیگران
    					</h6>
    					<p class="text-muted card-sub-title">
                    	    شما می توانید برای افراد تیم وظیفه مشخص کنید
                    	</p>
    				</div>
    				<div aria-multiselectable="true" class="accordion" id="accordion1" role="tablist"  style="overflow-y:auto;overflow-x:hidden;height:800px;">
    				    <?php 
    				    $check_ids=[];
    				    foreach($my as $aa){ 
                            if(!empty($aa['info']['id']) && intval($aa['info']['id'])>0 && !in_array(intval($aa['info']['id']),$check_ids)){
                                $check_ids[]=intval($aa['info']['id']); ?>
                                <div class="card mb-0">
                				    <div class="card-header" id="headingR<?= $aa['info']['id'] ?>" role="tab">
                					    <a class="<?= (!empty($aa['info']['status']) && intval($aa['info']['status'])==1?
                					    'bg-success':
                					    (empty($aa['status']) || intval($aa['status'])==0?
                					    'bg-secondary':
                					    (!empty($aa['status']) && intval($aa['status'])==1?
                					    'bg-warning':
                					    'bg-danger'))) ?> text-center" aria-controls="collapseR<?=  $aa['info']['id'] ?>" aria-expanded="true" data-toggle="collapse" href="#collapseR<?=  $aa['info']['id'] ?>">
                					        <?= (!empty($aa['info']['title'])?$aa['info']['title']:'') ?>
                						</a>
                				    </div>
                						<div aria-labelledby="headingR<?= $aa['info']['id'] ?>" class="collapse" data-parent="#accordion1" id="collapseR<?=  $aa['info']['id'] ?>" role="tabpanel">
                                            <?php foreach($my as $a){
                                                if(!empty($a) && !empty($a['info']['id']) && intval($a['info']['id'])>0 && intval($aa['info']['id'])==intval($a['info']['id'])){ 
                                                    $chchch=true; ?> 
                                                    <div class="email-media shadow-light p-2 rounded-10">
                                                        <div class="mt-0 d-sm-flex">
                            								<img class="ml-2 rounded-circle avatar-md" src="<?= (!empty($a['request_user_info']['image'])?$a['request_user_info']['image']:base_url('assets/svg/user/user.svg')) ?>" alt="user image">
                            								<div class="media-body">
                            									<div class="float-left d-flex fs-15">
                            									    <span class="mr-3 mt-1 
                            									    <?= (!empty($a['info']['status']) && intval($a['info']['status'])==1?
                                            					    'text-success':
                                            					    (empty($a['status']) || intval($a['status'])==0?
                                            					    'text-secondary':
                                            					    (!empty($a['status']) && intval($a['status'])==1?
                                            					    'text-warning':
                                            					    'text-danger'))) ?>">
                                										<?= (!empty($a['info']['status']) && intval($a['info']['status'])==1?
                                										'انجام شده':
                                										(empty($a['status']) || intval($a['status'])==0?
                                										'در انتظار تایید'
                                										:(!empty($a['status']) && intval($a['status'])==2?
                                										'رد شده':
                                										(!empty($a['run_time'])?'فوری':
                                										'تایید شده')))) ?>
                            									    </span>
                            										<small class="mr-3 mt-1">
                            										    <a onclick="showtaskDetail(this);" class="show">
                            										        <i class="fe fe-clipboard tx-16" title="مشاهده جزئیات"></i>
                            										    </a>
                            										    <a onclick="hidetaskDetail(this);" class=" hide d-none">
                            										        <i class="si si-logout tx-16" title="بستن جزئیات"></i>
                            										    </a>
                            									    </small>
                            									</div>
                            									<div class="media-title  font-weight-bold mt-3">
                            									    <span class="">
                                									    <?= (!empty($a['request_user_info']['name'])?$a['request_user_info']['name']:'') ?> 
                            									    </span>
                            									    <span class="">
                            									        <?= (!empty($a['request_user_info']['family'])?$a['request_user_info']['family']:'') ?>
                            									    </span>
                            									</div>
                            									<?php if(!empty($a['request_user_info']['phone'])){ ?>
                                									<a href="tel:<?= $a['request_user_info']['phone'] ?>">
                                    									<small class="mr-1">
                                    									    <i class="la la-phone tx-15" title="تماس"></i>
                                    								    </small>
                                									</a>
                            									<?php } ?>
                            									<span class="mr-3">
                            									    <?= (!empty($a['time'])?$date->jdate('Y/m/d H:i',strtotime($a['time'])):'') ?>
                            									</span>
                            								</div>
                            							</div>
                            							<div class="eamil-body mt-2 d-none">
                                                            <p class="">
                                                                دلیل نیاز به وظیفه:
                                                                <?= (!empty($a['info']['title'])?$a['info']['title']:'') ?>
                                                            </p>
                                						    <p class="">
                                						        توضیحات نسبی :
                            									<?= (!empty($a['info']['description'])?$a['info']['description']:'ندارد') ?>
                                						    </p>
                                						    <?php if(!empty($a['time'])){ ?>
                                            				    <p class="tx-10-f text-center">
                                            					    زمان درخواست وظیفه
                                            					    <?= $date->jdate('Y/m/d H:i',strtotime($a['time'])) ?>
                                            				    </p>
                                        				    <?php } if(!empty($a['info']['dead_time'])){ ?>
                                            				    <p class="tx-10-f text-center">
                                            					    زمان ارائه ی فوری
                                            					    <?= $date->jdate('Y/m/d H:i',strtotime($a['info']['dead_time'])) ?>
                                            				    </p>
                                        				    <?php } if(!empty($a['run_time'])){ ?>
                                            				    <p class="tx-10-f text-center">
                                            					    زمان شروع وظیفه
                                            					    <?= $date->jdate('Y/m/d H:i',strtotime($a['run_time'])) ?>
                                            				    </p>
                                        				    <?php } if(!empty($a['suggest_time'])){ ?>
                                            				    <p class="tx-10-f text-center">
                                            					    زمان پیشنهادی برای انجام  
                                            					    <?= $date->jdate('Y/m/d H:i',strtotime($a['suggest_time'])) ?>
                                            					</p>
                                        				    <?php } if(!empty($a['status']) && intval($a['status'])==1){ ?>
                                                				<hr>
                                        						<div class="email-attch">
                                        						    <?php if(!empty($a['info']['status'])&&intval($a['info']['status'])==1){ ?>
                                            					        <p class="">
                                                        				    گزارش وظیفه:
                                                        					<?= (!empty($a['info']['result'])?$a['info']['result']:'ندارد') ?>
                                                        				</p>
                                            						<?php }else{ ?>
                                                					    <div class="float-left">
                                                						    <a onclick="changeResult(this);">
                                                							    <i class="typcn typcn-edit tx-18" title="تعیین نتیجه"></i>
                                                							</a>
                                                						</div>
                                                    					<p class="">
                                                        				    گزارش وظیفه:
                                                        					<?= (!empty($a['info']['result'])?$a['info']['result']:'ندارد') ?>
                                                        				</p>
                                                        				<a class="btn btn-success-gradient btn-block pb-2 pt-3 px-0" onclick="doTask(<?= (!empty($a['info']['id']) && intval($a['info']['id'])>0?intval($a['info']['id']):0) ?>);"
                                                                        title="در صورتی که فعالیت به درستی به اتمام رسیده است شما می توانید آن را انجام شده تلقی کنید">
                                                                            انجام شد
                                                                        </a>
                                                        				<div class="row d-none task-result">
                                                                            <div class="modal d-block" aria-hidden="true">
                                                                                <div class="modal-dialog modal-lg" role="document">
                                                                                    <div class="modal-content modal-content-demo">
                                                                                        <div class="modal-header">
                                                                                            <h6 class="modal-title">تعیین نتیجه وظیفه</h6>
                                                                                            <button onclick="hidetaskResult(this);" aria-label="بستن" class="close">
                                                                                                <span aria-hidden="true">×</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-10 mx-auto text-center">
                                                                                                    <textarea rows="10" class="form-control result"><?= (!empty($a['info']['result'])?$a['info']['result']:'') ?></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="saveResult(this);">
                                                                                                ثبت نتیجه
                                                                                            </a>
                                                                                            <input type="hidden" class="tId" value="<?= (!empty($a['info']['id']) && intval($a['info']['id'])>0?intval($a['info']['id']):0) ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                    				<?php } ?>
                                        						</div>
                            								<?php } ?>
                            							</div>
                        				            </div>
                                                <?php }
                                            } ?>
                						</div>
                					</div>
                            <?php }
                        } 
                        ?>
            		</div>
            		<?php if(!$chchch){  ?>
                        <div class="alert alert-danger rounded-10 text-center p-5">
                            هیچ کدام از درخواست های شما مورد تایید برای اجرا نبودند 
                        </div>
                    <?php } 
                }else{ ?>
                    <div class="alert alert-danger rounded-10 text-center p-5">
                        شما هیچ وظیفه ای به همکارانتان ارجاع ندادید
                    </div>
                <?php } ?>
        	</div>
    	<?php }else{ ?>
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12" id="from-other">
                <?php if(!empty($other)){ $chch=false;?>
                    <div>
    					<h6 class="card-title mb-1">
    					    وظایف من
    					</h6>
    					<p class="text-muted card-sub-title">
                    	    شما می توانید وظایفی را به عهده بگیرید
                    	</p>
    				</div>
    				<div aria-multiselectable="true" class="accordion" id="accordion" role="tablist"  style="overflow-y:auto;overflow-x:hidden;height:800px;">
    				    <?php $check_idss=[];
    				    foreach($other as $aa){
                            if(!empty($aa)){
                                if(!empty($aa['info']['id']) && intval($aa['info']['id'])>0 && !in_array(intval($aa['info']['id']),$check_idss)){
                                    $check_idss[]=intval($aa['info']['id']);?>
                                    <div class="card mb-0">
                					    <div class="card-header" id="heading<?= $aa['info']['id'] ?>" role="tab">
                					        <div class="row">
                					            <?php if(!empty($aa['info']['status']) && intval($aa['info']['status'])==1){ ?>
                					                <div class="col-12">
                                					    <a class="text-center bg-success" aria-controls="collapse<?=  $aa['info']['id'] ?>" aria-expanded="true" data-toggle="collapse" href="#collapse<?=  $aa['info']['id'] ?>">
                                					        <?= (!empty($aa['info']['title'])?$aa['info']['title']:'') ?>
                                					    </a>
                        					        </div>
                					            <?php }else{ 
                					                if(empty($aa['status']) || intval($aa['status'])==0) { ?>
                    					                <div class="col-1 p-0 mr-3">
                                                            <a class="btn btn-success-gradient p-1 tx-10-f" 
                                                            onclick="acceptTask(<?= (!empty($aa['user_task_id']) && intval($aa['user_task_id'])>0?intval($aa['user_task_id']):0) ?>);" 
                                                            title="اگر میتوانید این کار را انجام دهید این دکمه را کلیک کنید">
                                                			    قبول
                                                		    </a>
                                    				    </div>
                        					            <div class="col-8 mx-auto">
                                						    <a class="text-center bg-secondary" aria-controls="collapse<?=  $aa['info']['id'] ?>" aria-expanded="true" data-toggle="collapse" href="#collapse<?=  $aa['info']['id'] ?>">
                                					            <?= (!empty($aa['info']['title'])?$aa['info']['title']:'') ?>
                                						    </a>
                        					            </div>
                            						    <div class="col-1 p-0 ml-3 mr-auto">
                                                            <a class="btn btn-danger-gradient p-1 tx-10-f" onclick="rejectTask(<?= (!empty($aa['user_task_id']) && intval($aa['user_task_id'])>0?intval($aa['user_task_id']):0) ?>);"
                                                            title="اگر از انجام این کار مطمئن نیستید این دکمه را کلیک کنید">
                                                			    رد
                                                		    </a>
                                    				    </div>
                					                <?php }else{ 
                					                    if(!empty($aa['status']) && intval($aa['status'])==1){ ?>
                					                        <div class="col-12">
                                    						    <a class="text-center bg-warning" aria-controls="collapse<?=  $aa['info']['id'] ?>" aria-expanded="true" data-toggle="collapse" href="#collapse<?=  $aa['info']['id'] ?>">
                                    					            <?= (!empty($aa['info']['title'])?$aa['info']['title']:'') ?>
                                    						    </a>
                            					            </div>
                					                    <?php }else{ ?>
                					                        <div class="col-12">
                                    						    <a class="text-center bg-danger" aria-controls="collapse<?=  $aa['info']['id'] ?>" aria-expanded="true" data-toggle="collapse" href="#collapse<?=  $aa['info']['id'] ?>">
                                    					            <?= (!empty($aa['info']['title'])?$aa['info']['title']:'') ?>
                                    						    </a>
                            					            </div>
                					                <?php } 
                					                }
                					            } ?>
                					        </div>
                						</div>
                						<div aria-labelledby="heading<?= $aa['info']['id'] ?>" class="collapse" data-parent="#accordion" id="collapse<?=  $aa['info']['id'] ?>" role="tabpanel">
                                            <?php foreach($other as $a){
                                                if(!empty($a) && !empty($a['info']['id']) && intval($a['info']['id'])>0 && intval($aa['info']['id'])===intval($a['info']['id'])){ 
                                                    $chch=true; ?> 
                                                    <div class="card-body">
                                            			<div class="email-media shadow-light p-2 rounded-10">
                                                            <div class="mt-0 d-sm-flex">
                                    							<img class="ml-2 rounded-circle avatar-md" src="<?= (!empty($a['from_user_info']['image'])?$a['from_user_info']['image']:base_url('assets/svg/user/user.svg')) ?>" alt="user image">
                                    							<div class="media-body">
                                    								<div class="float-left d-flex fs-15">
                                    								    <span class="mr-3 mt-1 
                                									    <?= (!empty($a['info']['status']) && intval($a['info']['status'])==1?
                                                					    'text-success':
                                                					    (empty($a['status']) || intval($a['status'])==0?
                                                					    'text-secondary':
                                                					    (!empty($a['status']) && intval($a['status'])==1?
                                                					    'text-warning':
                                                					    'text-danger'))) ?>">
                                    										<?= (!empty($a['info']['status']) && intval($a['info']['status'])==1?
                                    										'انجام شده':
                                    										(empty($a['status']) || intval($a['status'])==0?
                                    										'در انتظار تایید'
                                    										:(!empty($a['status']) && intval($a['status'])==2?
                                    										'رد شده':
                                    										(!empty($a['run_time'])?'فوری':
                                    										'تایید شده')))) ?>
                                									    </span>
                                    									<small class="mr-3 mt-1">
                                    									    <a onclick="showtaskDetail(this);" class="show">
                                    									        <i class="fe fe-clipboard tx-16" title="مشاهده جزئیات"></i>
                                    									    </a>
                                    									    <a onclick="hidetaskDetail(this);" class=" hide d-none">
                                    									        <i class="si si-logout tx-16" title="بستن جزئیات"></i>
                                    									    </a>
                                    								    </small>
                                    								</div>
                                    								<div class="media-title font-weight-bold mt-3">
                                    								    <span class="">
                                        								    <?= (!empty($a['from_user_info']['name'])?$a['from_user_info']['name']:'') ?> 
                                    								    </span>
                                    								    <span class="">
                                    								        <?= (!empty($a['from_user_info']['family'])?$a['from_user_info']['family']:'') ?>
                                    								    </span>
                                    								</div>
                                    								<?php if(!empty($a['from_user_info']['phone'])){ ?>
                                        								<a href="tel:<?= $a['from_user_info']['phone'] ?>">
                                            								<small class="mr-1">
                                            								    <i class="la la-phone tx-15" title="تماس"></i>
                                            							    </small>
                                        								</a>
                                    								<?php } ?>
                                    								<span class="mr-3">
                                    								    <?= (!empty($a['time'])?$date->jdate('Y/m/d H:i',strtotime($a['time'])):'') ?>
                                    								</span>
                                    							</div>
                                    						</div>
                                    						<div class="eamil-body mt-2 d-none">
                                                                <p class="">
                                                                    عنوان وظیفه
                                                                    <?= (!empty($a['info']['title'])?$a['info']['title']:'') ?>
                                                                </p>
                                        					    <p class="">
                                        					        شرح وظیفه
                                        					        <?= (!empty($a['info']['description'])?$a['info']['description']:'ندارد') ?>
                                        					    </p>
                                        					    <?php if(!empty($a['time'])){ ?>
                                            					    <p class="tx-10-f text-center">
                                            					        زمان درخواست وظیفه
                                            					        <?= $date->jdate('Y/m/d H:i',strtotime($a['time'])) ?>
                                            					    </p>
                                        					    <?php } if(!empty($a['info']['dead_time'])){ ?>
                                            					    <p class="tx-10-f text-center">
                                            					        زمان ارائه ی فوری
                                            					        <?= $date->jdate('Y/m/d H:i',strtotime($a['info']['dead_time'])) ?>
                                            					    </p>
                                        					    <?php } if(!empty($a['run_time'])){ ?>
                                            					    <p class="tx-10-f text-center">
                                            					        زمان شروع وظیفه
                                            					        <?= $date->jdate('Y/m/d H:i',strtotime($a['run_time'])) ?>
                                            					    </p>
                                        					    <?php } if(!empty($a['suggest_time'])){ ?>
                                            					    <p class="tx-10-f text-center">
                                            					        زمان پیشنهادی برای انجام  
                                            					        <?= $date->jdate('Y/m/d H:i',strtotime($a['suggest_time'])) ?>
                                            					    </p>
                                        					    <?php } if(!empty($a['status']) && intval($a['status'])==1){ ?>
                                            					    <hr>
                                        							<div class="email-attch">
                                        							    <?php if(!empty($a['info']['status'])&&intval($a['info']['status'])==1){ ?>
                                        							        <p class="">
                                                    						    گزارش وظیفه:
                                                    						    <?= (!empty($a['info']['result'])?$a['info']['result']:'ندارد') ?>
                                                    					    </p>
                                        							    <?php }else{ ?>
                                            							    <div class="float-left">
                                            								    <a onclick="changeResult(this);">
                                            								        <i class="typcn typcn-edit tx-18" title="تعیین نتیجه"></i>
                                            								    </a>
                                            								</div>
                                                							<p class="">
                                                    						    گزارش وظیفه:
                                                    						    <?= (!empty($a['info']['result'])?$a['info']['result']:'ندارد') ?>
                                                    					    </p>
                                                    					    <div class="row d-none task-result">
                                                                                <div class="modal d-block" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content modal-content-demo">
                                                                                            <div class="modal-header">
                                                                                                <h6 class="modal-title">تعیین نتیجه وظیفه</h6>
                                                                                                <button onclick="hidetaskResult(this);" aria-label="بستن" class="close">
                                                                                                    <span aria-hidden="true">×</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-10 mx-auto text-center">
                                                                                                        <textarea rows="10" class="form-control result"><?= (!empty($a['info']['result'])?$a['info']['result']:'') ?></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="saveResult(this);">
                                                                                                    ثبت نتیجه
                                                                                                </a>
                                                                                                <input type="hidden" class="tId" value="<?= (!empty($a['info']['id']) && intval($a['info']['id'])>0?intval($a['info']['id']):0) ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                					    <?php } ?>
                                        							</div>
                                        					    <?php } ?>
                                    						</div>
                                				        </div>
                                                    </div>
                                                <?php }
                                            } ?>
                						</div>
                					</div>
                            <?php }
                            } 
                        } ?>
    				</div>
                    <?php if(!$chch){ ?>
                        <div class="alert alert-success rounded-10 text-center p-5">
                            شما وظیفه برای انجام ندارید
                        </div>
                    <?php } 
                }else{ ?>
                    <div class="alert alert-danger rounded-10 text-center p-5">
                        درخواست برای انجام وظیفه ای در کسب کارتان از شما نشده است
                    </div>
                <?php } ?>
        	</div>
        <?php } ?>
    </div>
    <div class="row d-none" id="task-timer">
        <div class="modal d-block" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">تعیین زمان وظیفه</h6>
                        <button onclick="hidetaskTimer();" aria-label="بستن" class="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-10 mx-auto text-center">
                                <h6>زمان شروع کار</h6>
                            </div>
                            <div class="col-10 mx-auto text-center" id="run-time">
                                <?= (!empty($timer)?$timer:'') ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-10 mx-auto text-center">
                                <h6>تخمین زمان ارائه</h6>
                            </div>
                            <div class="col-10 mx-auto text-center" id="suggest-time">
                                <?= (!empty($timer)?$timer:'') ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="acceptTimertask();">
                            قبول وظیفه  
                        </a>
                        <input type="hidden" id="tId">
                        <input type="hidden" id="tUId">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-none" id="add-task">
        <div class="modal d-block" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">درخواست وظیفه ی جدید</h6>
                        <button onclick="hideAddtask();" aria-label="بستن" class="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-5 pl-0">
                                <div class="card">
                                    <div class="card-body px-0 py-1 rounded-10" id="user-list-task">
                                        <div class="main-content-body main-content-body-mail" style="overflow-y: auto;overflow-x: hidden;max-height: 340px;">
                                            <?php if(!empty($company_users) && is_array($company_users)){ 
                                                foreach($company_users as $a) {
                                                    if(!empty($a) && !empty($a['company_user_id']) && intval($a['company_user_id'])>0 && !empty($company_user_id) && intval($company_user_id)!== intval($a['company_user_id'])){ ?>
                        								<div class="main-mail-item">
                        									<div>
                        										<label class="ckbox">
                        										    <input type="checkbox" onclick="checkUserList(this,<?= intval($a['company_user_id']) ?>);">
                        										    <span></span>
                        									    </label>
                        									</div>
                        									<div class="main-img-user">
                        									    <img alt="user image" src="<?= (!empty($a["user_info"]["image"])?$a["user_info"]["image"]:base_url('assets/svg/user/user.svg')) ?>">
                        									</div>
                        									<div class="main-mail-body" style="cursor: context-menu;min-width:50px">
                        										<div class="main-mail-from">
                        											<?= (!empty($a["user_info"]["name"])?$a["user_info"]["name"]:'').' '.(!empty($a["user_info"]["family"])?$a["user_info"]["family"]:'') ?>
                        										</div>
                        										<div class="main-mail-subject tx-10-f">
                        										    <?= (!empty($a['role'])?$a['role']:'') ?>
                        										</div>
                        									</div>
                        								</div>
        							            <?php } 
                                                }
        							        }else{ ?>
        							            <div class="alert alert-danger rounded-10 p-3 text-center">
        							                شما هیچ کارمندی در این کسب و کار ندارید
        							            </div>
        							        <?php } ?>
        							    </div>    
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="card mb-0">
            						<div class="card-body pb-0">
        								<div class="form-group">
        									<div class="row align-items-center">
        										<label class="col-sm-2">موضوع</label>
        										<div class="col-sm-10">
        											<input type="text" id="task-title" class="form-control">
        										</div>
        									</div>
        								</div>
        								<div class="form-group">
        									<div class="row ">
        										<label class="col-sm-2">توضیحات</label>
        										<div class="col-sm-10">
        											<textarea rows="10" id="task-des" class="form-control"></textarea>
        										</div>
        									</div>
        								</div>
        								<div class="form-group">
                        					<label class="ckbox">
                        					    <input type="checkbox" id="show-force" onclick="showForce(this);">
                        						<span>
        								            تعیین زمان ارائه
                        						</span>
                        					</label>
                        				</div>
        								<div class="form-group d-none" id="dead-time">
                						    <?= (!empty($timer)?$timer:'') ?>
            						    </div>
            						</div>
            					</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="saveAddtask();">
                            ثبت درخواست  
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let userList=[];
        function showtaskDetail(el){
            $(el).addClass('d-none');
            $(el).parent().find('.hide').removeClass('d-none');
            $(el).parents('.email-media').find('.eamil-body').removeClass('d-none');
            return true;
        }
        function hidetaskDetail(el){
            $(el).addClass('d-none');
            $(el).parent().find('.show').removeClass('d-none');
            $(el).parents('.email-media').find('.eamil-body').addClass('d-none');
            return true;
        }
        function showMytask(el){
            $(el).parent().children().removeClass('.active');
            $(el).addClass('active');
            $('#from-other').addClass('d-none');
            $('#from-me').removeClass('d-none');
            return true;
        }
        function showOthertask(el){
            $(el).parent().children().removeClass('.active');
            $(el).addClass('active');
            $('#from-me').addClass('d-none');
            $('#from-other').removeClass('d-none');
            return true;
        }
        function changeResult(el){
            $(el).parent().parent().find('.task-result').removeClass('d-none');
            return true;
        }
        function hidetaskResult(el){
            $(el).parents('.task-result').addClass('d-none');
            return true;
        }
        function addtask(){
            $('#add-task').removeClass('d-none');
            return true;
        }
        function hideAddtask(){
            $('#add-task').addClass('d-none');
            return true;
        }
        function showForce(el){
            if(el.checked){
                $('#dead-time').removeClass('d-none');
            }else{
                $('#dead-time').addClass('d-none');
            }
            return true;
        }
        function checkUserList(el,reqCuId){
            if(el.checked){
                if (!userList.includes(reqCuId)) {
                    userList.push(reqCuId);
                }
            }else{
                let index = userList.indexOf(reqCuId);
                if (index > -1) {
                    userList.splice(index, 1);
                }
            }
            return true;
        }
        function hidetaskTimer(){
            $('#task-timer').addClass('d-none');
            $('#tId').val('');
            $('#tUId').val('');
            return true;
        }
        function acceptTask(tUId){
            $('#task-timer').removeClass('d-none');
            $('#tUId').val(tUId);
            return true;
        }
        function acceptTimertask(){
            let h=$('#run-time').find('.hour').val(),d=$('#run-time').find('.day').val(),m=$('#run-time').find('.month').val(),y=$('#run-time').find('.year').val(),
            hd=$('#suggest-time').find('.hour').val(),dd=$('#suggest-time').find('.day').val(),md=$('#suggest-time').find('.month').val(),yd=$('#suggest-time').find('.year').val(),
            tUId=$('#tUId').val();
            if(h!==''&&d!==''&&m!==''&&y!==''&&hd!==''&&dd!==''&&md!==''&&yd!==''&&tUId!==''){
                sendAjax({h:h,d:d,m:m,y:y,hd:hd,dd:dd,md:md,yd:yd,tUId:tUId},baseUrl('company/task/task/accept_task'),'#content');
            }else{
                return not8();
            }
            return true;
        }
        function saveAddtask(){
            let t=$('#task-title').val(),
            d=$('#task-des').val(),
            hd='',dd='',md='',yd='';
            if($('#show-force').get(0).checked){
                hd=$('#dead-time').find('.hour').val();
                dd=$('#dead-time').find('.day').val();
                md=$('#dead-time').find('.month').val();
                yd=$('#dead-time').find('.year').val();
            }
            if(t!=='' && d!=='' && userList.length>0){
                $('#task-title').removeClass('border-danger');
                $('#task-des').removeClass('border-danger');
                $('#user-list-task').removeClass('b-d');
                sendAjax({CuId:<?= (!empty($company_user_id) && intval($company_user_id)>0?$company_user_id:0) ?>,hd:hd,dd:dd,md:md,yd:yd,t:t,d:d,userList:userList},baseUrl('company/task/task/add'),'#content');
                return true;
            }else{
                if(t!==''){
                    $('#task-title').removeClass('border-danger');
                }else{
                    $('#task-title').addClass('border-danger');
                }
                if(d!==''){
                    $('#task-des').removeClass('border-danger');
                }else{
                    $('#task-des').addClass('border-danger');
                }
                if(userList.length>0){
                    $('#user-list-task').removeClass('b-d');
                }else{
                    $('#user-list-task').addClass('b-d');
                }
                return not1();
            }
        }
        function saveResult(el){
            let t=$(el).parent().parent().find('.result').val(),i=$(el).parent().find('.tId').val();
            if(i!==''&&t!==''){
                sendAjax({i:i,t:t},baseUrl('company/task/task/save_result'),'#content');
            }else{
                return not1();
            }
        }
        function rejectTask(id){
            sendAjax({id:id},baseUrl('company/task/task/reject_task'),'#content');
            return true;
        }
        function doTask(id){
            sendAjax({id:id},baseUrl('company/task/task/do_task'),'#content');
            return true;
        }
    </script>
<?php } ?>