<?php if(!empty($info)){ $row_num=0;?>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.js"></script>
    <style>
        .hide-password,.show-password {
            position: relative;
            top: -30px;
            float: left;
            left: 18px;
        }
        .elips{
            text-overflow: ellipsis;max-width: 150px;max-height: 70px;white-space: nowrap;overflow: hidden;
        }
        .tooles,.toolIn{
            overflow-x: hidden;overflow-y: auto;height: 300px;box-shadow: 1px 2px 10px black;border-radius: 10px;padding: 5px;
        }
        .text{
            height: 150px !important;box-shadow: 1px 2px 10px darkcyan;padding: 5px;border-radius: 10px;overflow-x: hidden;overflow-y: auto;
        }
    </style>
    <div class="row row-sm mt-3">
    	<div class="col-lg-4">
    	    <div class="card mg-b-20">
    		    <div class="card-body text-center">
    			    <div class="pl-0">
    				    <div class="main-profile-overview">
    					    <div class="main-img-user profile-user">
    						    <img alt="user profile" src="<?= (!empty($info['image'])?$info['image']:base_url('assets/svg/user/user.svg')) ?>">
    						</div>
    						<h5 class="main-profile-name mg-b-20">
    						    <?= (!empty($info['name'])?$info['name']:'').' '.(!empty($info['family'])?$info['family']:'') ?>
    					    </h5>
    						<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
							<div class="row">
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-success-gradient btn-block p-1 rounded-10" onclick="showAddResume();">
                					    <i class="bx bx-plus mx-1"></i>
                					    افزودن رزومه
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('wallet') ?>">
                					    <i class="bx bx-dollar mx-1"></i>
                					    کیف پول
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('user_setting') ?>">
                					    <i class="bx bx-user-circle mx-1"></i>
                					    حساب کاربری
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-block btn-dark-gradient p-1 rounded-10" href="<?= base_url() ?>">
                			            <i class="la la-home mx-1"></i>
                					    خانه
                				    </a>
                                </div>
							</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-8">
    	    <div class="card">
    		    <div class="card-body toolIn" style="height: 500px;">
    		        <div class="d-none" id="add-resume">
                        <div class="modal d-block" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">رزومه ساز</h6>
                                        <button onclick="hideAddResume();" aria-label="بستن" class="close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="max-height:450px;overflow-x:hidden;overflow-y:auto;">
                                        <div class="card">
                                            <div class="card-header">
                                                محل سکونت:
                                                <?= (!empty($info['address'])?$info['address']:'<a href="'.base_url('user_setting').'" class="text-warning">شما در حساب کربری نشانی خود را مشخص نکردید اگر تمایل دارید آگهی های نزدیک به شما قبول شوند نشانی خود را وارد کنید</a>') ?>
                                                <hr>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 my-1 form-group">
                                                        <lable class="form-lable">
                                                            <span>
                                                                موقعیت شغلی
                                                            </span>
                                                            <select id="role_id" class="form-control">
                                                                <option value='0'>انتخاب کنید</option>
                                                                <?php if(!empty($data)&&!empty($data['roles'])){
                                                                    foreach($data['roles'] as $r){ 
                                                                        if(!empty($r) && !empty($r['id']) && intval($r['id'])>8){ 
                                                                            if(empty($data['access_roles']) || (!empty($data['access_roles']) && !in_array(intval($r['id']),$data['access_roles']))) { $row_num++; ?>
                                                                                <option value='<?= intval($r['id']) ?>'><?= (!empty($r['title'])?$r['title']:'') ?></option>
                                                                            <?php }
                                                                        }
                                                                    }
                                                                } ?>
                                                            </select>
                                                        </lable>
                                                    </div>
                                                </div>
                                                <?php if($row_num>0){ ?>
                                                    <div class="row mt-2">
                                                        <div class="col-12 text-center my-1 form-group">
                                                            <label>توضیحات مربوط رزومه و سابقه کار و اخلاق کاری خود را به طور کامل شرح دهید</label>
                                                            <div id="editor" style="border-radius: 10px;padding: 5px;box-shadow: 1px 1px 10px darkgrey;min-height: 200px;"></div>
                                                            <script>
                                                                const quill = new Quill('#editor');
                                                            </script>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="alert alert-danger rounded-10 p-3 text-center">
                                                        شما برای همه ی موقعیت های شغلی رزومه درست کردید و قابلیت افزودن رزومه جدبد را ندارید
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if($row_num>0){ ?>
                                            <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="addResume(this);">
                                                افزودن  
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    		        <?php if(!empty($data) && !empty($data['resume'])){ 
    		            foreach($data['resume'] as $d){ 
    		                if(!empty($d) && !empty($d['resume_id']) && intval($d['resume_id'])>0){ ?>
        		                <div class="list-group-item">
        		                    <div>
        		                        <h6>
        		                            <span>
                        		                <?= (!empty($d['user_resume_role']["title"])?$d['user_resume_role']["title"]:'') ?>
        		                            </span>
        		                            <span class="f-left">
        		                                <a onclick="enableUserResume(this,<?= intval($d['resume_id']) ?>);" class="enable <?= (!empty($d['resume_status']) && intval($d['resume_status'])>0?'d-none':'') ?>">
        		                                    <i class="far fa-check-circle tx-20-f text-success"></i>
        		                                </a>
        		                                <a onclick="disableUserResume(this,<?= intval($d['resume_id']) ?>);" class="disable <?= (!empty($d['resume_status']) && intval($d['resume_status'])>0?'':'d-none') ?>">
        		                                    <i class="fas fa-ban tx-20-f text-danger"></i>
        		                                </a>
        		                            </span>
        		                        </h6>
        		                        <textarea onchange="changeUserResumeText(this,<?= intval($d['resume_id']) ?>);" class="text rounded-10 w-100 form-control">
                    		                <?= (!empty($d['resume_text'])?trim($d['resume_text']):'') ?>
        		                        </textarea>
        		                        <div class="keyTooles" style="height: 15px;padding-top: 3px;">
        		                            <span class="f-right">
        		                                <a onclick="showToolesResume(this,'other-company-request');" class="show">
        		                                    <small class="text-warning">
            		                                    مشاغل مرتبط
        		                                    </small>
        		                                </a>
        		                                <a onclick="hideToolesResume(this,'other-company-request');" class="d-none hide">
        		                                    <i class="fas fa-ban tx-20-f text-danger"></i>
        		                                </a>
        		                            </span>
        		                            <span class="f-left">
        		                                <a onclick="showToolesResume(this,'send-resume');" class="show">
        		                                    <small class="text-success">
            		                                    کار درخواست شده 
        		                                    </small>
        		                                </a>
        		                                <a onclick="hideToolesResume(this,'send-resume');" class="d-none hide">
        		                                    <i class="fas fa-ban tx-20-f text-danger"></i>
        		                                </a>
        		                            </span>
        		                        </div>
        		                    </div>
        		                    <div class="d-none mt-3 tooles send-resume">
                                        <?php $send_handler=false;
                                        if(!empty($d['send_resume'])){
                                            foreach($d['send_resume'] as $send){
                                                if(!empty($send) && !empty($send["company_info"]) && !empty($send["company_info"]['id'])){ ?>
                                                    <div class="list-group-item text-center">
                                                        <div>
                                                            <span class="f-right">
                                                                <img class="wd-70 rounded-10" src="<?= base_url((!empty($send['company_info']['icon'])?'assets/svg/company/'.$send['company_info']['icon']:(!empty($send['company_info']['qr_code'])?'assets/qrcode/'.$send['company_info']['qr_code']:'assets/svg/company/company.svg'))) ?>">
                                                            </span>
                                                            <span class="pt-3 d-inline-block">
                                                                <?= (!empty($send['company_info']['title'])?$send['company_info']['title']:'') ?>
                                                            </span>
                                                            <span class="f-left pt-3">
                                                                <?php if(!empty($send['resume_company_role_request_status']) && intval($send['resume_company_role_request_status'])==1){ $send_handler=true;?>
                                                                    <a href="<?= base_url('company_manager') ?>">
                                                                        <small class="text-success">
                                                                            شروع فعالیت
                                                                        </small>
                                                                    </a>
                                                                <?php }elseif(!empty($send['resume_company_role_request_status']) && intval($send['resume_company_role_request_status'])==2){  ?>
                                                                    <small class="text-danger">
                                                                        رد شد
                                                                    </small>
                                                                <?php }else{ ?>
                                                                    <small class="text-warning">
                                                                        در حال بررسی
                                                                    </small>
                                                                <?php } ?>
                                                            </span>
                                                        </div>
                                                        <div class="text w-100 mt-3">
                                                            <small>
                                                                <?= (!empty($send['company_info']['description'])?$send['company_info']['description']:'') ?>
                                                            </small>
                                                            <hr>
                                                            <p>
                                                                <?= (!empty($send["company_role_request_text"])?$send["company_role_request_text"]:'') ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php }
                                            }
                                        }else{ ?>
                                            <div class="alert alert-danger rounded-10 text-center p-3">
                                                شما درخواست شغلی با این رزومه ندارید
                                            </div>
                                        <?php } ?>
        		                    </div>
                                    <div class="d-none mt-3 tooles other-company-request">
                                        <?php
                                        if(!$send_handler){
                                            if(!empty($d['other_company_request'])){
                                                foreach($d['other_company_request'] as $send){ 
                                                    if(!empty($send)){ ?>
                                                        <div class="list-group-item text-center">
                                                            <div>
                                                                <span class="f-right">
                                                                    <img class="wd-70 rounded-10" src="<?= base_url((!empty($send['company_info']['icon'])?'assets/svg/company/'.$send['company_info']['icon']:(!empty($send['company_info']['qr_code'])?'assets/qrcode/'.$send['company_info']['qr_code']:'assets/svg/company/company.svg'))) ?>">
                                                                </span>
                                                                <span class="pt-3 d-inline-block">
                                                                    <?= (!empty($send['company_info']['title'])?$send['company_info']['title']:'') ?>
                                                                </span>
                                                                <span class="f-left pt-3">
                                                                    <a onclick="sendResume(this,<?= (!empty($send['company_role_request_id']) && intval($send['company_role_request_id'])>0?intval($send['company_role_request_id']):0) ?>,<?= (!empty($send['user_resume_id']) && intval($send['user_resume_id'])>0?intval($send['user_resume_id']):0) ?>,<?= (!empty($send['role_id']) && intval($send['role_id'])>0?intval($send['role_id']):0) ?>);">
                                                                        <small class="text-success">
                                                                            ارسال رزومه
                                                                        </small>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                            <div class="text w-100 mt-3">
                                                                <small>
                                                                    <?= (!empty($send['company_info']['description'])?$send['company_info']['description']:'') ?>
                                                                </small>
                                                                <hr>
                                                                <p>
                                                                    <?= (!empty($send["text"])?$send["text"]:'') ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                }
                                            }else{ ?>
                                                <div class="alert alert-danger rounded-10 text-center p-3">
                                                    درخواست کاری دیگری برای این عنوان شغلی وجود ندارد
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <div class="alert alert-danger rounded-10 text-center p-3">
                                                این رزومه در حال همکاریست 
                                            </div>
                                        <?php } ?>
                                    </div>
        		                </div>
    		                <?php }
    		            } ?>
    				<?php }else{ ?>
    				    <div class="alert alert-danger text-center p-4 rounded-10">
    				        شما هیچ رزومه ای نساختید
    				    </div>
    				<?php } ?>
    			</div>
    		</div>
    	</div>
    </div>
    <script>
        function sendResume(el,crrId,urId,rId){
            sendAjax({crrId:crrId,urId:urId,rId:rId},baseUrl('users/dashbord/send_resume'),'');
            if($(el).parent().parent().parent().parent().children().length>1){
                $(el).parent().parent().parent().remove();
            }else{
                $(el).parent().parent().parent().parent().html('<div class="alert alert-danger rounded-10 text-center p-3">درخواست کاری دیگری برای این عنوان شغلی وجود ندارد</div>');
            }
        }
        function addResume(el){
            if($('#role_id').val()!=='' && $('#editor').text()!=='' && $('#role_id').val()>0){
                sendAjax({
                    role_id:$('#role_id').val(),
                    text:$('#editor').text()
                },baseUrl('users/dashbord/add_resume'),'');
            }else{
                if($('#role_id').val()!=='' && $('#role_id').val()>0){
                    $('#role_id').css('border','1px solid green');
                }else{
                    $('#role_id').css('border','1px solid red');
                }
                if($('#editor').text()!==''){
                    $('#editor').css('border','1px solid green');
                }else{
                    $('#editor').css('border','1px solid red');
                }
                return not1();
            }
        }
        function showAddResume(el){
            $('#add-resume').removeClass('d-none');
        }
        function hideAddResume(el){
            $('#add-resume').addClass('d-none');
        }
        function enableUserResume(el,id){
            $(el).addClass('d-none');
            $(el).parent().find('.disable').removeClass('d-none');
            $(el).parent().parent().parent().find('.keyTooles').removeClass('d-none');
            $(el).parent().parent().parent().find('.text').prop('disabled', false);
            sendAjax({status:1,id:id},baseUrl('users/dashbord/edit_resume_status'),'');
        }
        function disableUserResume(el,id){
            $(el).addClass('d-none');
            $(el).parent().find('.enable').removeClass('d-none');
            $(el).parent().parent().parent().find('.keyTooles').addClass('d-none');
            $(el).parent().parent().parent().find('.text').prop('disabled', true);
            sendAjax({status:0,id:id},baseUrl('users/dashbord/edit_resume_status'),'');
        }
        function changeUserResumeText(el,id){
            if($(el).val()!==''){
                $(el).css('border','1px solid green');
                sendAjax({text:$(el).val(),id:id},baseUrl('users/dashbord/edit_resume_text'),'');
            }else{
                $(el).css('border','1px solid red');
            }
        }
        function showToolesResume(el,type){
            $('.show').removeClass('d-none');
            $('.hide').addClass('d-none');
            $(el).addClass('d-none');
            $(el).parent().find('.hide').removeClass('d-none');
            $('.tooles').addClass('d-none');
            $(el).parent().parent().parent().parent().find('.'+type).removeClass('d-none');
        }
        function hideToolesResume(el,type){
            $(el).addClass('d-none');
            $(el).parent().find('.show').removeClass('d-none');
            $(el).parent().parent().parent().parent().find('.'+type).addClass('d-none');
        }
    </script>
<?php }else{ 
    header("Location:".base_url());
} ?>