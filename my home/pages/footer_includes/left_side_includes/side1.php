<?php if(!empty($my_company)){
        				    foreach ($my_company as $com) { 
        					    if(!empty($com) && !empty($com['company_info']['id']) && intval($com['company_info']['id'])>0 &&
            				    !empty($com['role_id']) && intval($com['role_id'])>0 && !empty($com['status']) && intval($com['status'])>0){ ?>
            					    <a 
            					    <?php if(intval($com['status'])==1){ ?>
                					    onclick="companyManager(this);"
                                    <?php }elseif(intval($com['status'])==2){  ?>
                                        onclick="return not23();"
                                    <?php } ?>
            						class="list d-flex align-items-center border-bottom p-3">
            							<input type="hidden" value="<?= (!empty($com['company_role_id']) && intval($com['company_role_id'])>0?intval($com['company_role_id']):0) ?>" class="company-role-id">
            							<input type="hidden" value="<?= (!empty($com['company_role_parent_id']) && intval($com['company_role_parent_id'])>0?intval($com['company_role_parent_id']):0) ?>" class="company-role-parent-id">
            							<input type="hidden" value="<?= intval($com['role_id']) ?>" class="role-id">
            							<input type="hidden" value="<?= intval($com['company_user_id']) ?>" class="company-user-id">
            							<input type="hidden" value="<?= intval($com['company_info']['id']) ?>" class="company-id">
            							<div class="">
            							    <span class="avatar bg-dark brround avatar-md" style="overflow: hidden;">
            								    <img src="<?= base_url('assets/svg/company/'.(!empty($com['company_info']['icon'])?$com['company_info']['icon']:'company.svg')) ?>" alt="company pictures">
            								    <span class="avatar-status <?= (!empty($com['status']) && intval($com['status'])==1?
            									'pulse':'pulse-danger') ?>" style="margin: -3px 18px 0 0;">
        									    </span>
        									</span>
        								</div>
            							<span class="wrapper w-100 mr-3">
            							    <p class="mb-0 d-flex">
            								    <b><?= (!empty($com['company_info']['title'])?$com['company_info']['title']:'') ?></b>
            								</p>
            								<div class="d-flex justify-content-between align-items-center">
            								    <div class="d-flex align-items-center">
            									    <small class="text-muted ml-auto" title="<?= (!empty($com['company_info']['description'])?$com['company_info']['description']:'') ?>" style="text-overflow: ellipsis;white-space: nowrap;max-width: 100px;overflow: hidden;">
            										    <?= (!empty($com['company_info']['description'])?$com['company_info']['description']:'') ?>
        											</small>
        										</div>
        									</div>
        								</span>
            							<?php if(!empty($com['company_info']['status']) && intval($com['company_info']['status'])>0){ ?>
                							<span class="badge bg-success-transparent text-success mr-auto ml-1 float-left">
                							    فعال
                							</span>
            							<?php }else{ ?>
            							    <span class="badge bg-danger-transparent text-danger mr-auto ml-1 float-left">
            								    غیرفعال
            								</span>
        								<?php }
        								if(!empty($com['status']) && intval($com['status'])==1){ ?>
                						    <span class="badge bg-success-transparent text-success mr-auto ml-1 float-left">
                    						    <?= (!empty($com['role_info'])?$com['role_info']:'') ?>
                							</span>
            							<?php }elseif(!empty($com['status']) && intval($com['status'])==2){  ?>
            							    <span class="badge bg-danger-transparent text-danger mr-auto ml-1 float-left">
                							    معلق
            								</span>
        								<?php }else{ ?>
                						    <span class="badge bg-danger-transparent text-danger mr-auto ml-1 float-left">
                    						    درانتظار پاسخ
                							</span>
            							<?php } ?>
            						</a>
        		   		<?php   }
        					}
        				}else{ ?>
    					    <div class="alert alert-danger rounded-10 text-dark text-center p-3">
        					    شما کسب و کاری برای خود ندارید ابتدا با فشردن دکمه ی افزودن در بالا یکی اضافه کنید
        					</div>
        				<?php } ?>