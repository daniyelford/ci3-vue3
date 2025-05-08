<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
    <div>
        <?php $date=new JDF();
        $gef_id=0;
        $f=false;
        $repeat2=[];
        if(!empty($data) && is_array($data)){
            foreach($data as $m){ 
                if(!empty($m) && !empty($m['meet']) && !empty($m['meet']['my']) && !empty($m['user']['user_id']) && intval($m['user']['user_id'])>0 &&
                !in_array(intval($m['user']['user_id']),$repeat2)){
                    $repeat2[]=intval($m['user']['user_id']); ?>
                    <span class="changeUserMeetId <?= ($f?'d-none':'') ?> userId<?= intval($m['user']['user_id']) ?>">
                        <?php if(!$f)$gef_id=intval($m['user']['user_id']);
                        $f=$g=true; 
                        if(!empty($m['user']) && !empty($m['meet']['my'])){ ?>
            			    <h6 class="card-title mb-1">
                                <img style="width: 70px;height: auto;max-height: 75px;border-radius: 50px;margin: 5px;" src="<?= (!empty($m['user']['user_info']["image"])?$m['user']['user_info']["image"]:base_url('assets/svg/user/user.svg')) ?>">
                                <span>
            					    درخواست های
            					    <?= (!empty($m['user']['user_info']["name"])?$m['user']['user_info']["name"]:'').' '.(!empty($m['user']['user_info']["name"])?$m['user']['user_info']["family"]:'') ?>
                                </span>
                            </h6>
                        <?php } ?>
                    </span>
                <?php }
            }
        } ?>
    </div>
    <?php if(!empty($data) && is_array($data)){
        $n=1;
        $g=true;
        foreach($data as $m){ 
            if(!empty($m) && !empty($m['meet']) && !empty($m['meet']['my'])){ ?>
                <span class="changeUserMeetId userId<?= (!empty($m['user']['user_id']) && intval($m['user']['user_id'])>0?intval($m['user']['user_id']):0).' '.($gef_id==intval($m['user']['user_id'])?'':'d-none') ?>">
                    <?php if(!empty($m['user']) && !empty($m['meet']['my'])){ ?>
            		    <div aria-multiselectable="true" class="accordion" id="accordion<?= $n ?>" role="tablist"  style="overflow-y:auto;overflow-x:hidden;max-height:800px;">
            			    <?php $check_ids=[];
            				foreach(array_reverse($m['meet']['my']) as $aa){ 
                                if(!empty($aa) && (empty($aa['status']) || intval($aa['status'])==0 || (!empty($aa['status']) && intval($aa['status'])>0 && intval($aa['status'])!==1)) && !empty($aa['info']['id']) && intval($aa['info']['id'])>0 && !in_array(intval($aa['info']['id']),$check_ids)){
                                    $check_ids[]=intval($aa['info']['id']); ?>
                                    <div class="card mb-0">
                        			    <div class="card-header" id="headingU<?= $n ?>R<?= $aa['info']['id'] ?>" role="tab">
                        				    <div class="row">
                        					    <div class="col-10">
                                				    <a class="" aria-controls="collapseU<?= $n ?>R<?=  $aa['info']['id'] ?>" aria-expanded="true" data-toggle="collapse" 
                                					href="#collapseU<?= $n ?>R<?=  $aa['info']['id'] ?>">
                                					    <i class="far fa-arrow-alt-circle-down"></i>
                                					    <?= (!empty($aa['info']['title'])?$aa['info']['title']:'') ?>
                                					</a>
                        					    </div>
                        					    <div class="col-2">
                                                    <a class="btn btn-success-gradient p-1" onclick="acceptMeet(<?= (!empty($aa['info']['id']) && intval($aa['info']['id'])>0?intval($aa['info']['id']):0) ?>);" title="تایید زمان نشست در کسب و کار مورد نظر" >
                                    				    <i class="far fa-check-circle tx-30-f"></i>
                                    				</a>
                        					    </div>    
                        				    </div>
                        			    </div>
                        			    <div aria-labelledby="headingU<?= $n ?>R<?= $aa['info']['id'] ?>" class="collapse" 
                        			    data-parent="#accordion1" 
                    				    id="collapseU<?= $n ?>R<?=  $aa['info']['id'] ?>" role="tabpanel">
                                            <?php $n++;
                                            foreach(array_reverse($m['meet']['my']) as $a){
                                                if(!empty($a) && (empty($a['status']) || intval($a['status'])==0 || (!empty($a['status']) && intval($a['status'])>0 && intval($a['status'])!==1)) && !empty($a['info']['id']) && intval($a['info']['id'])>0 && intval($aa['info']['id'])==intval($a['info']['id'])){ 
                                                    $g=false; ?> 
                                                    <div class="email-media shadow-light p-2 rounded-10">
                                                        <div class="mt-0 d-sm-flex">
                                    					    <img class="ml-2 rounded-circle avatar-md" src="<?= (!empty($a['request_user_info']['image'])?$a['request_user_info']['image']:base_url('assets/svg/user/user.svg')) ?>" alt="user image">
                                    						<div class="media-body">
                                							    <div class="float-left d-flex fs-15">
                                								    <span class="mr-3 mt-1 
                                								    <?php if(!empty($a['status']) && intval($a['status'])==3){ ?>
                                									    text-success
                                									<?php }elseif(!empty($a['status']) && intval($a['status'])==2){ ?>
                                									    text-warning
                                								    <?php }else{ ?>
                                									    text-danger
                                								    <?php } ?>">
                                        							    <?php if(!empty($a['status']) && intval($a['status'])==3){ ?>
                                        								    هماهنگ شده
                                        							    <?php }elseif(!empty($a['status']) && intval($a['status'])==2){ ?>
                                        							        هماهنگ کردن
                                        							    <?php }else{ ?>
                                        							        در انتظار پذیرش درخواست
                                        							    <?php } ?>
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
                                    					    <p class="text-center tx-10-f">
                                						        زمان فراخوان :
                            									<?= (!empty($a['info']['run_time'])?$date->jdate('Y/m/d H:i',strtotime($a['info']['run_time'])):'در دست بررسی') ?>
                                						    </p>
                                						    <?php if(!empty($a['run_time'])){ ?>
                                    						    <p class="text-center tx-10-f">
                                    						        زمان درخواست جلسه فوری :
                                									<?= $date->jdate('Y/m/d H:i',strtotime($a['run_time'])) ?>
                                    						    </p>
                                    					    <?php } ?>
                                						    <hr>
                                    					    <?php if(empty($a['status']) || intval($a['status'])==0){ ?>
                                        					    <div class="alert alert-warning rounded-10 text-center p-4">
                                            				        درخواست از سمت شما برای تایید زمان مناسب درحال بررسی می باشد
                                            				    </div>
                                        				    <?php }elseif(!empty($a['status']) && intval($a['status'])==2){ ?>
                                        				        <div class="alert alert-danger rounded-10 p-4 text-center">
                                    					            زمانی را که شما برای اجرای جلسه انتخاب نمودید از سمت گیرنده دارای مشکلاتی بوده که ترجیح به تغییر در زمان اجرا دادند
                                    					        </div>
                                    					        <div class="row options">
                                        				            <div class="col-12 ">
                                        						        <a class="btn btn-danger-gradient rounded-10 p-3 w-100" onclick="changeTime(<?= (!empty($a['info']['id']) && intval($a['info']['id'])>0?intval($a['info']['id']):0) ?>,<?= (!empty($a['meet_user_id']) && intval($a['meet_user_id'])>0?intval($a['meet_user_id']):0) ?>,0);">
                                        						            تغییر زمان درخواست شده
                                        						        </a>
                                        						    </div>
                                        						    <div class="col-12 mt-1">
                                        						        <a class="btn btn-success-gradient rounded-10 p-3 w-100" onclick="acceptMeetTimeExp(<?= (!empty($a['meet_user_id']) && intval($a['meet_user_id'])>0?intval($a['meet_user_id']):0) ?>);">
                                            						        تایید این زمان به عنوان زمان جلسه
                                            					        </a>
                                                				    </div>
                                                				    <?php if(!empty($a['run_time'])){ ?>
                                                    				    <div class="col-12 my-1">
                                                    				        <a class="btn btn-dark-gradient rounded-10 p-3 w-100" onclick="acceptMeetTimeExpSingle(<?= (!empty($a['meet_user_id']) && intval($a['meet_user_id'])>0?intval($a['meet_user_id']):0) ?>);">
                                                					            تایید زمان درخواست شده به عنوان جلسه ای انفرادی با شخص
                                                					        </a>
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
                            } ?>
                        </div>
                    <?php } ?>
                </span>
            <?php }
        } 
        if($g){ ?>
            <div class="alert alert-danger rounded-10 text-center p-5">
                هیچ درخواست جدیدی از این شخص وجود ندارد
            </div>  
        <?php }
    }else{ ?>
        <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
            <div class="alert alert-danger rounded-10 text-center p-5">
                درخواستی از همکارانتان برای تشکیل جلسه ای در کسب کار ثبت نگردیده است
            </div>
        </div>
    <?php } ?>
</div>