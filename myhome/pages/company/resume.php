<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.js"></script>
<style>
    .text{
        height: 150px !important;box-shadow: 1px 2px 10px darkcyan;padding: 5px;border-radius: 10px;overflow-x: hidden;overflow-y: auto;
    }
</style>
<div class="row row-sm mt-3">
    <div class="col-lg-4 col-xl-3 col-md-12 col-sm-12">
        <div class="card mg-b-20">
            <div class="main-content-left main-content-left-mail card-body">
            	<div class="main-mail-menu">
            	    <div class="main-profile-overview">
    					<div class="main-img-user profile-user">
    					    <img alt="company image" src="<?= base_url((!empty($company_info['icon'])?'assets/svg/company/'.$company_info['icon']:'assets/svg/company/company.svg')) ?>">
    					</div>
    					<div class="d-flex justify-content-between mg-b-20">
    					    <div>
    						    <h5 class="main-profile-name"><?= (!empty($company_info['title'])?$company_info['title']:'') ?></h5>
    						</div>
    					</div>
    				</div>
        			<label class="main-content-label main-content-label-sm mg-b-20">دسترسی سریع</label>
        			<nav class="nav main-nav-column">
        			    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link"
        			    href="<?= base_url('company_one') ?>">
        				    <i class="bx bx-folder-open mx-1"></i>
        					کسب و کار مربوط
        				</a>
        			    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link"
        			    href="<?= base_url('company_manager') ?>">
        				    <i class="bx bx-slider-alt mx-1"></i>
        				    همه کسب و کارها
        			    </a>
    					<a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link"
    					href="<?= base_url() ?>">
        				    <i class="la la-home mx-1"></i>
        				    خانه
        			    </a>
        			</nav>
    				<hr class="mg-y-20">
    				<label class="main-content-label tx-13 mg-b-20">بارکد</label>
    				<div class="main-profile-social-list">
    				    <img class="wd-100" onclick="downloadImage(this);" src="<?= base_url('assets/qrcode/'.(!empty($company_info['qr_code'])?$company_info['qr_code']:'tes.png')) ?>">
    				</div>
    				<hr class="mg-y-20">
    				<label class="main-content-label tx-13 mg-b-20">توضیحات</label>
    				<div class="main-profile-bio">
    				    <?= (!empty($company_info['description'])?$company_info['description']:'') ?>
    				</div>
    				<?php if(!empty($company_info['url'])){ ?>
            			    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link"
            			    href="<?= $company_info['url'] ?>">
            				    <i class="fa-classic fas fa-briefcase fa-fw fa-6x mx-1"></i>
            					آدرس سایت
            				</a>
    				<?php } ?>
        	    </div>
            </div>
        </div>
    </div>    
    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
        <?php if(!empty($company_id) && intval($company_id)>0 && !empty($company_role_id) && intval($company_role_id)>0){ ?>
            <div class="row">
                <div class="col-12">
            		<div class="card mg-b-10">
            		    <div class="card-header">
            		        <h6>
            		            درخواست های همکاری
            			    </h6>
            		    </div>
            			<div class="card-body" style="overflow-y:auto;height:400px">
                            <div>
                                <?php
                                $x_number=false;
                                if(!empty($data)){
                                    $date=new JDF();
                                    foreach ($data as $a) {
                                        if(!empty($a) && !empty($a['company_role_request']) && !empty($a['user_resume']['status']) && intval($a['user_resume']['status'])>0 &&
                                        !empty($a['user_resume_company_role_request']['time']) && !empty($a['user_resume_company_role_request']['id']) && intval($a['user_resume_company_role_request']['id'])>0 &&
                                        !(!empty($a['user_resume_company_role_request']['status'])&&intval($a['user_resume_company_role_request']['status'])>0)){ 
                                            $x_number=true; ?>
                                            <div class="">
                                                <div>
                                                    <h6>
                        		                        <span>
                                        		            <?= (!empty($a['role']['title'])?$a['role']['title']:'') ?>
                                        		        </span>
                        		                        <span class="f-left">
                        		                        </span>
                        		                    </h6>
                        		                    <textarea class="text form-control" disabled="true">
                        		                        <?= (!empty($a['company_role_request']["text"])?trim($a['company_role_request']["text"]):'') ?>
                        		                    </textarea>
                                                </div>
                                                <div class="user_info list d-flex align-items-center border-bottom p-3 rounded-10">
                                                    <div>
                                                        <span class="avatar bg-dark brround avatar-md" style="overflow: hidden;">
                                                    	    <img class="user-img" src="<?= (!empty($a['user_info']['image'])?$a['user_info']['image']:base_url('assets/svg/user/user.svg')) ?>" alt="company user picture">
                                                    	</span>
                                                    </div>
                                                	<span class="wrapper w-100 mr-3">
                                                        <p class="mb-0 d-flex">
                                                    	    <b class="name-user-info"><?= (!empty($a['user_info']['name'])?$a['user_info']['name']:'').' '.(!empty($a['user_info']['family'])?$a['user_info']['family']:'') ?></b>
                                                    	    <?php if(!empty($a['user_info']['phone'])){ ?>
                                                    	        <a class="mx-1 text-success" href="tel:<?= $a['user_info']['phone'] ?>"><i class="icon ion-ios-call text-success"></i></a>
                                                    	    <?php } ?>
                                                    	</p>
                                                    	<div class="d-flex justify-content-between align-items-center">
                                                    	    <div class="d-flex align-items-center">
                                                    			<span class="tx-9-f role-user-info ml-auto" style="max-height: 110px;overflow-y: auto;">
                                                        			<?= (!empty($a['user_resume']['text'])?$a['user_resume']['text']:'') ?>
                                                    			</span>
                                                    			<br>
                                                    			<small class="mx-1 text-warning tx-8-f">
                                                    			    <?= $date->jdate('Y/m/d H:i',strtotime($a['user_resume_company_role_request']['time'])) ?>
                                                    			</small>
                                                    		</div>
                                                    	</div>
                                                    </span>
                                                    <div>
                                                        <a class="text-success tx-11-f mr-1" onclick="acceptWorker(this,<?= $a['user_resume_company_role_request']['id'] ?>);">
                                                            قبول
                                                        </a>
                                                        <a class="mt-2 text-danger tx-11-f mr-1" onclick="deniedWorker(this,<?= $a['user_resume_company_role_request']['id'] ?>);">
                                                            رد
                                                        </a>    
                                                    </div>
                                                </div>
                            				</div>
                                        <?php }
                                    } 
                                } ?>
                            </div>
                            <div class="none-req-error <?= ($x_number?'d-none':'')  ?> alert alert-danger rounded-10 text-dark text-center p-3">
                                هیچ درخواستی در کارتابل موجود نیست
                            </div>
                        </div>
            		</div>
                </div>
            </div>
            <script>
                function acceptWorker(el,id){
                    if(!($(el).parent().parent().parent().parent().children().length>1)){
                        $(el).parent().parent().parent().parent().parent().find('.none-req-error').removeClass('d-none');
                    }
                    $(el).parent().parent().parent().remove();
                    sendAjax({id:id},baseUrl('company/company/accept_user_resume_company_request'),'');
                }
                function deniedWorker(el,id){
                    if(!($(el).parent().parent().parent().parent().children().length>1)){
                        $(el).parent().parent().parent().parent().parent().find('.none-req-error').removeClass('d-none');
                    }
                    $(el).parent().parent().parent().remove();
                    sendAjax({id:id},baseUrl('company/company/denied_user_resume_company_request'),'');
                }
            </script>
        <?php } ?>
    </div>
</div>