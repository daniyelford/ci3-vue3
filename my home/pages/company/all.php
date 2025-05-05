<?php 
if(!function_exists('sorting_company_data')){
    function sorting_company_data($z){
        $x = array_column($z, 'company_info');
        $x = array_column($x, 'status');
        array_multisort($x, SORT_DESC, $z);
        return $z;
    }
} ?>
<div class="row row-sm mt-3">
    <div class="col-lg-4 col-xl-3 col-md-12 col-sm-12">
        <div class="card mg-b-20">
            <div class="main-content-left main-content-left-mail card-body">
            	<div class="main-mail-menu">
            	    <div class="main-profile-overview">
    					<div class="main-img-user profile-user">
    					    <img alt="company image" src="<?= (!empty($_SESSION['user_info']['image'])?$_SESSION['user_info']['image']:base_url('assets/svg/user/user.svg')) ?>">
    					</div>
    					<div class="d-flex justify-content-between mg-b-20">
    					    <div>
    						    <h5 class="main-profile-name"><?= (!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'') .' '. (!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'') ?></h5>
    						</div>
    					</div>
    				</div>
        			<label class="main-content-label main-content-label-sm mg-b-20">دسترسی سریع</label>
        			<nav class="nav main-nav-column">
        			    <a style="text-align:start;" class="btn btn-success-gradient text-light btn-block p-1 rounded-10 nav-link"
        			     data-target="#modaldemo3" data-toggle="modal">
        				    <i class="fa fa-plus mx-1"></i>
        					افزودن کسب و کار
        				</a>
        			    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link"
        			    href="<?= base_url('wallet') ?>">
        				    <i class="bx bx-slider-alt mx-1"></i>
        				    کیف پول
        			    </a>
    					<a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link"
    					href="<?= base_url() ?>">
        				    <i class="la la-home mx-1"></i>
        				    خانه
        			    </a>
        			</nav>
        	    </div>
            </div>
        </div>
    </div>    
    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($company_info)){ 
                    $company_info=sorting_company_data($company_info); ?>
        			<div class="card mg-b-20">
        			    <div class="card-header">
        			        <h2>
        			            کسب و کار های من
        			            
        			        </h2>
        			    </div>
        			    <div class="card-body" style="height:318px;overflow-y:auto;">
                            <?php foreach ($company_info as $com) { 
                                if(!empty($com) && !empty($com['company_info']['id']) && intval($com['company_info']['id'])>0 &&
                                is_null($com['company_info']['deleted_at']) && !empty($com['role_id']) && intval($com['role_id'])>0){ ?>
                                    <div class="pd-2">
                                        <a onclick="<?= (!empty($com['status']) && intval($com['status'])==1?'companyManager(this);':
                                        (!empty($com['status']) && intval($com['status'])==2?'return not23();':
                                        'acceptCompanyRequest(this,'.intval($com['company_user_id']).');')) ?>" 
                                        class="list d-flex align-items-center border-bottom p-3 rounded-10 <?= (!empty($com['company_info']['status']) && intval($com['company_info']['status'])==1?'shadow-light':'') ?>">
                                            <input type="hidden" value="<?= (!empty($com['company_role_id']) && intval($com['company_role_id'])>0?intval($com['company_role_id']):0) ?>" class="company-role-id">
                                        	<input type="hidden" value="<?= (!empty($com['company_role_parent_id']) && intval($com['company_role_parent_id'])>0?intval($com['company_role_parent_id']):0) ?>" class="company-role-parent-id">
                                        	<input type="hidden" value="<?= intval($com['role_id']) ?>" class="role-id">
                                        	<input type="hidden" value="<?= intval($com['company_user_id']) ?>" class="company-user-id">
                                        	<input type="hidden" value="<?= intval($com['company_info']['id']) ?>" class="company-id">
                                        	<div class="">
                                        	    <span class="avatar bg-dark brround avatar-md" style="overflow: hidden;">
                                        		    <img src="<?= base_url('assets/svg/company/'.(!empty($com['company_info']['icon'])?$com['company_info']['icon']:'company.svg')) ?>" alt="company pictures">
                                        			<span class="avatar-status 
                                        			<?= (!empty($com['company_info']['status']) && intval($com['company_info']['status'])==1 && !empty($com['status']) && intval($com['status'])==1?'pulse':'pulse-danger') ?>"></span>
                                        		</span>
                                        	</div>
                                        	<span class="wrapper mr-1 w-100">
                                        	    <p class="mb-0 d-flex">
                                        		    <b class="company-name"><?= (!empty($com['company_info']['title'])?$com['company_info']['title']:'') ?></b>
                                        		</p>
                                        		<div class="d-flex justify-content-between align-items-center" title="<?= (!empty($com['company_info']['description'])?$com['company_info']['description']:'') ?>" style="width:100px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                                				    <?= (!empty($com['company_info']['description'])?$com['company_info']['description']:'') ?>
                                        		</div>
                                        	</span>
                                        	<span class="f-left">
                                            	<?php
                                            	if(!empty($com['company_info']['status']) && intval($com['company_info']['status'])==1){ ?>
                                        		    <!--<span class="tx-8-f my-1 badge bg-success-transparent ml-1 text-success mr-auto float-left">-->
                                        		    <!--    فعال-->
                                        		    <!--</span>-->
                                        		<?php }else{ ?>
                                        		    <span class="tx-8-f my-1 badge bg-danger-transparent ml-1 text-danger mr-auto float-left">
                                        		        <!--غیرفعال-->
                                        		        بدون بسته حرفه ای
                                        		    </span>
                                        		<?php }
                                            	if(intval($com['role_id'])== 1 || intval($com['role_id'])== 8){
                                            	    if(!empty($com['company_info']['type']) && intval($com['company_info']['type'])>0){ ?>
                					                <span class="tx-8-f my-1 badge bg-success-transparent ml-1 text-success mr-auto float-left">کسب و کار گروهی است</span>
                                        		<?php }else{ ?>
                                                    <span class="tx-8-f my-1 badge bg-danger-transparent ml-1 text-danger mr-auto float-left">کسب و کار انفرادی است</span>
                                        		<?php } 
                                        		}
                                        		if(!empty($com['status']) && intval($com['status'])>0){ 
                                        		    if(intval($com['status'])==2){ ?>
                                        		        <span class="tx-8-f my-1 badge bg-danger-transparent ml-1 text-danger mr-auto float-left">
                                                            در انتظار کارگزینی
                                                        </span>
                                        		    <?php }else{ ?>
                                            		    <!--<span class="tx-8-f my-1 badge bg-success-transparent ml-1 text-success mr-auto float-left">-->
                                            		    <!--    درحال همکاری-->
                                            		    <!--</span>-->
                                        		    <?php } ?>
                                        		<?php }else{ ?>
                                                    <span class="tx-8-f my-1 badge bg-danger-transparent ml-1 text-danger mr-auto float-left">در انتظار تایید شما</span>
                                        		<?php }
                                        		if(!empty($com['role_info']) && intval($com['role_status'])>0){ ?>
                                                    <span class="tx-8-f my-1 badge bg-secondary-transparent ml-1 text-white mr-auto float-left">
                                                        عنوان شغلی :
                                                        <b class="role-info">
                                                            <?= $com['role_info'] ?>
                                                        </b>
                                            		</span>
                                        		<?php }else{ ?>
                                        		    <span class="tx-8-f my-1 badge bg-danger-transparent ml-1 text-danger mr-auto float-left">
                                        		        در انتظار کارگزینی
                                        		    </span>
                                        		<?php } ?>
                                        		
                                        	</span>
                                        </a>
                    				</div>
                            <?php }
                            } ?>
                        </div>
        			</div>
        			<div id="accept" class="d-none">
        			    <div class="modal d-block" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">درخواست همکاری</h6>
                                        <button onclick="hideAccept();" aria-label="بستن" class="close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-10 mx-auto text-center">
                                                <p>
                                                    شما از کسب و کار 
                                                    <span id="company-name"></span> 
                                                    درخواست همکاری دارید و از شما تقاضای همکاری در بخش شغلی 
                                                    <span id="role-info-shower"></span>
                                                    را دارند
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="acceptWork();">
                                            تایید شغل  
                                        </a>
                                        <input type="hidden" id="company-user-id">
                                    </div>
                                </div>
                            </div>
                        </div>
        			</div>
        			<script>
        			    function acceptCompanyRequest(el,cuid){
        			        $('#company-user-id').val(cuid);
        			        $('#role-info-shower').text($(el).find('.role-info').text());
        			        $('#company-name').text($(el).find('.company-name').text())
        			        $('#accept').removeClass('d-none');
        			        return true;
        			    }
        			    function hideAccept(){
        			        $('#company-user-id').val('');
        			        $('#accept').addClass('d-none');
        			        return true;
        			    }
        			    function acceptWork(){
                            let i =$('#company-user-id').val();
                            sendAjax({i:i},baseUrl('company/company/accept_work'),'#content');
                            return true;
        			    }
        			</script>
                <?php }else{ ?>
                    <a class="ripple" data-target="#modaldemo3" data-toggle="modal">
                        <div class="alert alert-danger rounded-10 text-dark text-center p-3">
                            شما کسب و کاری برای خود ندارید با کلیک می توانید برای خود یکی اضافه کنید
                        </div>
                    </a>
                    <script>
                        $(function(){
                            $('.companyManagerShowErrorLog').removeClass('d-none');
                            $('.workCreateLogError').removeClass('d-none');
                        })
                    </script>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php $this->view('footer_includes/left_side_includes/side3'); ?>
</div>