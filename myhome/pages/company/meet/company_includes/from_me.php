<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 d-none" id="from-me">
    <?php $date=new JDF();
    $my=(!empty($data) && !empty($data['my']) && is_array($data['my'])?$data['my']:[]);
    if(!empty($my)){ ?>
        <div>
		    <h6 class="card-title mb-1">
			    درخواست های من
			</h6>
			<p class="text-muted card-sub-title">
        	    درخواست های من از دیگران برای اجرای جلسه
			</p>
        </div>
		<div aria-multiselectable="true" class="accordion" id="accordion1" role="tablist"  style="overflow-y:auto;overflow-x:hidden;height:400px;">
		    <?php $check_ids=[];
			foreach(array_reverse($my) as $aa){ 
                if(!empty($aa['info']['id']) && !empty($aa['status']) && intval($aa['info']['id'])>0 && !in_array(intval($aa['info']['id']),$check_ids)){
                    $check_ids[]=intval($aa['info']['id']); ?>
                    <div class="card mb-0">
            		    <div class="card-header" id="headingR<?= $aa['info']['id'] ?>" role="tab">
            			    <a class="text-center" aria-controls="collapseR<?=  $aa['info']['id'] ?>" aria-expanded="true" data-toggle="collapse" href="#collapseR<?=  $aa['info']['id'] ?>">
            				    <?= (!empty($aa['info']['title'])?$aa['info']['title']:'') ?>
            				</a>
            		    </div>
        				<div aria-labelledby="headingR<?= $aa['info']['id'] ?>" class="collapse" data-parent="#accordion1" id="collapseR<?=  $aa['info']['id'] ?>" role="tabpanel">
                            <?php foreach(array_reverse($my) as $a){
                                if(!empty($a)  && !empty($a['info']['id']) && intval($a['info']['id'])>0 && intval($aa['info']['id'])===intval($a['info']['id'])){ ?> 
                                    <div class="email-media shadow-light p-2 rounded-10">
                                        <div class="mt-0 d-sm-flex">
                        				    <img class="ml-2 rounded-circle avatar-md" src="<?= (!empty($a['request_user_info']['image'])?$a['request_user_info']['image']:base_url('assets/svg/user/user.svg')) ?>" alt="user image">
                        					<div class="media-body">
                        					    <div class="float-left d-flex fs-15">
                        						    <span class="mr-3 mt-1 <?= (!empty($a['status']) && intval($a['status'])==1?'text-success':'text-danger') ?>">
                                						<?= (!empty($a['status']) && intval($a['status'])==1?(!empty($a['run_time'])?
                                						'فوری':
                                						'تایید شده')
                                						:'در انتظار تایید') ?>
                        							</span>
                        							<small class="mr-3 mt-1">
                        							    <a onclick="showMeetDetail(this);" class="show">
                        								    <i class="fe fe-clipboard tx-16" title="مشاهده جزئیات"></i>
                        								</a>
                        								<a onclick="hideMeetDetail(this);" class=" hide d-none">
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
                                                دلیل نیاز به جلسه:
                                                <?= (!empty($a['info']['title'])?$a['info']['title']:'') ?>
                                            </p>
                            				<p class="">
                            				    توضیحات نسبی :
                        						<?= (!empty($a['info']['description'])?$a['info']['description']:'ندارد') ?>
                            				</p>
                            				<p class="tx-10-f text-center">
                            				    زمان فراخوان :
                        						<?= (!empty($a['info']['run_time'])?$date->jdate('Y/m/d H:i',strtotime($a['info']['run_time'])):'در دست بررسی') ?>
                            				</p>
                            				<?php if(!empty($a['run_time'])){ ?>
                                        	    <p class="tx-10-f text-center">
                                        		    زمان درخواست جلسه فوری :
                                    				<?= $date->jdate('Y/m/d H:i',strtotime($a['run_time'])) ?>
                                        		</p>
                                        	<?php } ?>
                            				<hr>
                            				<?php if(!empty($a['status']) && intval($a['status'])==1){
                            				    if(empty($a['info']['status']) || intval($a['info']['status'])==0){ ?>
                                    			    <div class="alert alert-primary rounded-10 text-center p-4">
                                    				    زمان اجرا تایید شده و در وضعیت انتظار برای اجرا شدن می باشد
                                    				</div>
                                    			<?php }else{ ?>
                                				    <div class="alert alert-success rounded-10 text-center p-4">
                                    				    اجرا شده
                                    				</div>
                                				<?php } 
                                			} ?>
                                			<hr>
                                			<div class="email-attch">
                                			    <?php if(!empty($a['status']) && intval($a['status'])==1){ ?>
                                    			    <div class="float-left">
                                    				    <a onclick="changeResult(this);">
                                    					    <i class="typcn typcn-edit tx-18" title="تعیین نتیجه"></i>
                                    					</a>
                                    				</div>
                                        			<p class="">
                                            		    نتیجه ی جلسه:
                                            			<?= (!empty($a['info']['result'])?$a['info']['result']:'ندارد') ?>
                                            		</p>
                                            		<div class="row d-none meet-result">
                                                        <div class="modal d-block" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content modal-content-demo">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title">تعیین نتیجه جلسه</h6>
                                                                        <button onclick="hideMeetResult(this);" aria-label="بستن" class="close">
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
                                                                        <input type="hidden" class="mId" value="<?= (!empty($a['info']['id']) && intval($a['info']['id'])>0?intval($a['info']['id']):0) ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
            if(empty($check_ids)){ ?>
                <div class="alert alert-danger rounded-10 text-center p-5">
                    هیچ کدام از درخواست های شما مورد تایید برای اجرا نبودند 
                </div>
            <?php } ?>
        </div>
    <?php }else{ ?>
        <div class="alert alert-danger rounded-10 text-center p-5">
            شما هیچ درخواستی از همکارانتان برای تشکیل جلسه ای در کسب کارتان ثبت نکردید می توانید درخواست جدیدی ثبت کنید
        </div>
    <?php } ?>
</div>