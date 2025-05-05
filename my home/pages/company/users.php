<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.js"></script>
<style>
    .text{
        height: 150px !important;box-shadow: 1px 2px 10px darkcyan;padding: 5px;border-radius: 10px;overflow-x: hidden;overflow-y: auto;
    }
</style>
<?php 
if(!function_exists('sorting_users_data')){
    function sorting_users_data($z){
        $x = array_column($z, 'status');
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
            		            اعضای کسب و کار
            		            <a class="f-left text-success" onclick="addNewUser();">
                    			    <i class="fa fa-plus mx-1"></i>
                        		</a>
            			    </h6>
            		    </div>
            			<div class="card-body" style="overflow-y:auto;height:400px">
                            <?php if(!empty($data)){
                                $data=sorting_users_data($data);
                                foreach ($data as $a) {
                                    if(!empty($a)){ ?>
                                        <div class="pd-2">
                                            <a <?php if(!empty($a['status']) && intval($a['status'])>0){ ?>
                                                onclick="companyUserManager(this);" 
                                            <?php }else{ ?>
                                                onclick="not22();"
                                            <?php } ?>
                                            class="list d-flex align-items-center border-bottom p-3 rounded-10 <?= (!empty($a['status']) && intval($a['status'])>0?'shadow-light':'shadow-dark') ?> ">
                                            	<input type="hidden" value="<?= (!empty($a['user_id']) && intval($a['user_id'])>0?$a['user_id']:0) ?>" class="user-id">
                                            	<input type="hidden" value="<?= (!empty($a['company_role_id']) && intval($a['company_role_id'])>0?$a['company_role_id']:0) ?>" class="company-role-id">
                                            	<input type="hidden" value="<?= (!empty($a['company_user_id']) && intval($a['company_user_id'])>0?$a['company_user_id']:0) ?>" class="company-user-id">
                                            	<div class="">
                                            	    <span class="avatar bg-dark brround avatar-md" style="overflow: hidden;">
                                            		    <img class="user-img" src="<?= (!empty($a['user_info']['image'])?$a['user_info']['image']:base_url('assets/svg/user/user.svg')) ?>" alt="company user picture">
                                            		</span>
                                            	</div>
                                            	<span class="wrapper w-100 mr-3">
                                            	    <p class="mb-0 d-flex">
                                            		    <b class="name-user-info"><?= (!empty($a['user_info']['name'])?$a['user_info']['name']:'').' '.(!empty($a['user_info']['family'])?$a['user_info']['family']:'') ?></b>
                                            		</p>
                                            		<div class="d-flex justify-content-between align-items-center">
                                            		    <div class="d-flex align-items-center">
                                            			    <small class="role-user-info ml-auto">
                                            				    <?= (!empty($a['role'])?$a['role']:'') ?>
                                            				</small>
                                            			</div>
                                            		</div>
                                            	</span>
                                            	<?php if(!empty($a['status']) && intval($a['status'])>0){ 
                                            	    if(intval($a['status'])==2){ ?>
                                            	        <span class="badge bg-warning-transparent text-warning mr-auto ml-1 float-left">در انتظار کارگزینی</span>
                                            	    <?php }else{ ?>
                                        		        <span class="badge bg-success-transparent text-success mr-auto ml-1 float-left">در حال همکاری</span>
                                        		    <?php }
                                        		}else{ ?>
                                        	    	<span class="badge bg-danger-transparent text-danger mr-auto ml-1 float-left">در انتظار همکاری</span>
                                        		<?php } ?>
                                            </a>
                        				</div>
                                <?php }
                                } 
                            }else{ ?>
                                <a onclick="addNewUser();">
                                    <div class="alert alert-danger rounded-10 text-dark text-center p-3">
                                        شما برای مدیریت بهتر کسب و کار خود می توانید اشخاصی را به کسب و کار خود اضافه کنید و برای آنها وظایف و سطح دسترسی متفاوت در نظر بکیرید
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
            		</div>
                </div>
            </div>
            <div class="d-none" id="add-user">
                <div class="modal d-block" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">افزودن همکار</h6>
                                <button onclick="hideAddUser();" aria-label="بستن" class="close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="text-center">
                                                شما می توانید با یکی از روش های زیر به شخص مورد نظر درخواست کاری ارسال کنید
                                                <br>
                                                شما حتی می توانید خود را در بخش های کوچک تر برای انجام فعالیت ها قرار دهید و سطح عملکرد خود را به این صورت ارتقا دهید
                                            </p>
                                        </div>    
                                        <div class="card-body">
                                            <div class="row">
                                                <input type="hidden" id="type-choose" value="#phone-number">
                                                <div class="col-12 text-center my-1">
                                                    <span>
                                                        شماره تماس شخص مورد نظر را وارد کنید
                                                    </span>
                                                </div>
                                                <div class="col-2 mr-auto text-center">
                                                    <span>
                                                        روش اول:
                                                    </span>
                                                </div>
                                                <div class="col-6 ml-auto">
                                                    <div class="input-group shadow-light rounded-10 overflow-hidden">
                    									<div class="input-group-prepend">
                    										<div class="input-group-text">
                    											<label class="rdiobox wd-16 mg-b-0"><input checked onclick="changeTypeAddUser('#phone-number','#gmail');" class="radio-type" value="phone" name="data[]" type="radio"><span></span></label>
                    										</div>
                    									</div>
                                                        <input class="form-control p" type="text" id="phone-number" placeholder="09123456789">
                    								</div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 text-center my-1">
                                                    <span>
                                                        آدرس ایمیل شخص را وارد کنید
                                                    </span>
                                                </div>
                                                <div class="col-2 mr-auto text-center">
                                                    <span>
                                                        روش دوم:
                                                    </span>
                                                </div>
                                                <div class="col-6 ml-auto">
                                                    <div class="input-group shadow-light rounded-10 overflow-hidden">
                    									<div class="input-group-prepend">
                    										<div class="input-group-text">
                    											<label class="rdiobox wd-16 mg-b-0"><input onclick="changeTypeAddUser('#gmail','#phone-number');" class="radio-type" value="gmail" name="data[]" type="radio"><span></span></label>
                    										</div>
                    									</div>
                                                        <input class="form-control p" readonly type="mail" id="gmail" placeholder="gmail@gmail.com">
                    								</div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-2">
                                                <div class="col-8 mx-auto text-center">
                                                    <?php if(!empty($roles) && is_array($roles)){ ?>
                                                        <label for="role-chooser">
                                                            موقعیت شغلی مورد نیاز کدام است
                                                        </label>
                                                        <select id="role-id" class="form-control SlectBox SumoUnder shadow-light rounded-10" tabindex="-1">
                                                            <option value="0" >انتخاب کنید</option>
                                                            <?php foreach($roles as $a){ 
                                                                if(!empty($a) && !empty($a['id']) && !empty($a['title']) && (intval($a['id'])>8)){ ?>
                                                                    <option value="<?= $a['id'] ?>"><?= $a['title'] ?></option>
                                                            <?php } 
                                                            } ?>
                    						    		</select>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                    <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="addUser(<?= intval($company_id).','.intval($company_role_id) ?>);">
                                        افزودن  
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-1">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>
                                ارسال درخواست همکاری
                                <a class="f-left text-success" onclick="addRoleRequest();">
                                    <i class="fa fa-plus mx-1"></i>
                                </a>
                            </h6>
                        </div>
                        <div class="card-body" style="overflow-y: auto;overflow-x: hidden;height: 400px;">
                            <?php if(!empty($company_role_request)){ 
                                foreach($company_role_request as $crr){
                                    if(!empty($crr)){ ?>
                                        <div class="list-group-item">
                		                    <div>
                                                <h6>
                		                            <span>
                                		                <?= (!empty($crr['role_id']) && intval($crr['role_id'])>0 && !empty($roles) && !empty($roles[array_search(intval($crr['role_id']),array_column($roles,'id'))]['title'])?$roles[array_search(intval($crr['role_id']),array_column($roles,'id'))]['title']:'') ?>
                		                            </span>
                		                            <span class="f-left">
                		                                <a onclick="enableCompanyRoleRequest(this,<?= intval($crr['id']) ?>);" class="enable <?= (!empty($crr['status']) && intval($crr['status'])>0?'d-none':'') ?>">
                		                                    <i class="far fa-check-circle tx-20-f text-success"></i>
                		                                </a>
                		                                <a onclick="disableCompanyRoleRequest(this,<?= intval($crr['id']) ?>);" class="disable <?= (!empty($crr['status']) && intval($crr['status'])>0?'':'d-none') ?>">
                		                                    <i class="fas fa-ban tx-20-f text-danger"></i>
                		                                </a>
                		                            </span>
                		                        </h6>
                		                        <textarea onchange="changeCompanyRoleRequestText(this,<?= intval($crr['id']) ?>);" class="text rounded-10 w-100 form-control">
                            		                <?= (!empty($crr['text'])?trim($crr['text']):'') ?>
                		                        </textarea>
                		                    </div>
                		                </div>
                                    <?php }
                                }
                            }else{ ?>
                                <div class="alert alert-danger rounded-10 text-center p-3">
                                    شما در هیچ موقعیت شغلی ای درخواست همکاری ارسال نکردید
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-body d-none" id="addRoleRequest">
                            <div class="modal d-block" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">درخواست همکار</h6>
                                        <button onclick="hideAddRoleRequest();" aria-label="بستن" class="close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="max-height:450px;overflow-x:hidden;overflow-y:auto;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 my-1 form-group">
                                                        <lable class="form-lable">
                                                            <span>
                                                                موقعیت شغلی
                                                            </span>
                                                            <select id="role_id" class="form-control">
                                                                <option value='0'>انتخاب کنید</option>
                                                                <?php if(!empty($roles)){ 
                                                                    foreach($roles as $r){ 
                                                                        if(!empty($r) && !empty($r['id']) && intval($r['id'])>8){ ?>
                                                                            <option value='<?= intval($r['id']) ?>'><?= (!empty($r['title'])?$r['title']:'') ?></option>
                                                                        <?php } 
                                                                    }
                                                                } ?>
                                                            </select>
                                                        </lable>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-12 text-center my-1 form-group">
                                                        <label>
                                                            جزییات درخواست کاری خود را به طور کامل شرح دهید  
                                                        </label>
                                                        <div id="editor" style="border-radius: 10px;padding: 5px;box-shadow: 1px 1px 10px darkgrey;min-height: 200px;"></div>
                                                        <script>
                                                            const quill = new Quill('#editor');
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="addRoleRequestAction();">
                                            افزودن  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function enableCompanyRoleRequest(el,id){
                    $(el).addClass('d-none');
                    $(el).parent().find('.disable').removeClass('d-none');
                    $(el).parent().parent().parent().find('.text').prop('disabled', false);
                    sendAjax({status:1,id:id},baseUrl('company/company/edit_company_role_request_status'),'');
                }
                function disableCompanyRoleRequest(el,id){
                    $(el).addClass('d-none');
                    $(el).parent().find('.enable').removeClass('d-none');
                    $(el).parent().parent().parent().find('.text').prop('disabled', true);
                    sendAjax({status:0,id:id},baseUrl('company/company/edit_company_role_request_status'),'');
                }
                function changeCompanyRoleRequestText(el,id){
                    if($(el).val()!==''){
                        $(el).css('border','1px solid green');
                        sendAjax({text:$(el).val(),id:id},baseUrl('company/company/edit_company_role_request_text'),'');
                    }else{
                        $(el).css('border','1px solid red');
                    }
                }
                function addRoleRequestAction(){
                    if($('#role_id').val()!=='' && $('#editor').text()!=='' && $('#role_id').val()>0){
                        sendAjax({role_id:$('#role_id').val(),text:$('#editor').text()},baseUrl('company/company/add_role_request'),'');
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
                function addRoleRequest(){
                    $('#addRoleRequest').removeClass('d-none');
                    return true;
                }
                function hideAddRoleRequest(){
                    $('#addRoleRequest').addClass('d-none');
                    return true;
                }
                function companyUserManager(el){
                    let cId=<?= intval($company_id) ?>,a=$(el).find('.user-id').val(),b=$(el).find('.company-role-id').val(),c=$(el).find('.company-user-id').val(),d=$(el).find('.name-user-info').text(),e=$(el).find('.role-user-info').text(),
                    f=$(el).find('.user-img').attr('src');
                    d=$.trim(d);e=$.trim(e);
                    sendAjax({userImg:f,companyId:cId,userId:a,companyRoleId:b,companyUserId:c,userInfoName:d,userRoleTitle:e},baseUrl('company/company/user_company_manager'),'');
                    return true;
                }
                function addNewUser(){
                    $('#add-user').removeClass('d-none');
                    return true;
                }
                function hideAddUser(){
                    $('#add-user').addClass('d-none');
                    return true;
                }
                function addUser(cId,crId){
                    let a = $('#type-choose').val(),b=$('#role-id').val(),c;
                    c=$(a).val();
                    if(b!=='' && b!=='0' && b!==0){
                        $('#role-id').removeClass('border-danger');
                        if(c!==''){
                            $(a).removeClass('border-danger');
                            sendAjax({companyId:cId,companyRoleId:crId,type:a,roleId:b,value:c},baseUrl('company/company/add_user'),'');
                            return true;
                        }else{
                            $(a).addClass('border-danger');
                            return not1();
                        }
                    }else{
                        $('#role-id').addClass('border-danger');
                        return not1();
                    }
                }
                function changeTypeAddUser(i,t){
                    $('#type-choose').val(i);
                    $(i).prop('readonly', false);
                    $(t).val('');
                    $(t).removeClass('border-danger');
                    $(t).prop('readonly', true);
                    return true;
                }
            </script>
        <?php } ?>
    </div>
</div>