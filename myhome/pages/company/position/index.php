<?php if(!empty($data) && !empty($data['positions']) && !empty($role_id) && intval($role_id)>0){ ?>
	<div class="row row-sm mt-2">
	    <div class="col-lg-4">
			<div class="card mg-b-20">
			    <div class="card-body text-center">
				    <div class="pl-0">
					    <div class="main-profile-overview">
					        <a class="btn btn-primary btn-compose btn-block" onclick="showAddPosition();">
						        ایجاد جایگاه
						    </a>
							<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
							<div class="row">
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('company_one') ?>">
                					    <i class="bx bx-folder-open mx-1"></i>
                					    کسب و کار مربوط
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('company_manager') ?>">
                					    <i class="bx bx-slider-alt mx-1"></i>
                					    همه کسب و کارها
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
    	   <div class="row row-sm mb-2">
    		    <div class="col-12 text-center">
        	        <div class="text-right btn btn-success btn-block rounded-10">
        	            <i class="si si-credit-card tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        مدیریت جایگاه ها
            		    </h3>
        	        </div>
    		    </div>
		    </div>
		    <span id="position-control">
        		<div class="row row-sm">
        		    <div class="col-12">
        			    <div class="card">
        				    <div class="card-body bg-warning-gradient rounded-10">
        					    <div class="counter-status d-flex md-mb-0">
        						    <div class="counter-icon bg-primary-transparent px-2 pt-1">
        							    <i class="icon ion-md-cube tx-50-f text-primary"></i>
        						    </div>
        							<div class="mr-auto">
        							    <h5 class="tx-13 tect-center">جایگاه های تحت پوشش</h5>
        								<h2 class="mb-0 tx-22 mb-1 mt-1 tect-center" id="product-count"></h2>
        								<p class="text-primary mb-0 tx-11">
        								    <i class="si si-arrow-up-circle text-success mx-1"></i>جایگاه های دارای تخصص</p>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        		<div class="card">
        		    <div class="card-header pb-0">
        			    <h5>
        			        جایگاه ارائه خدمات من
        			    </h5>
        			    <p>
        			        شما در این بخش جایگاه های ارائه خدمات مشتریان را برای کارشناسی دقیق تر در اختیار دارید تا برای نمایش اطلاعات آن را واضح کنید
        			    </p>
        		    </div>
        			<div class="card-body pt-1">
        			    <?php
        			    if(intval($role_id)==1||intval($role_id)==8){
        			        if(!empty($data['positions']['all'])){ ?>
        				        <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
            					    <?php foreach($data['positions']['all'] as $a){
            					        if(!empty($a) && !empty($a['company_category_product_position_id']) && intval($a['company_category_product_position_id'])>0 && 
            					        !empty($a['position_info']) && !empty($a['position_info']['info']) && 
            					        !empty($a['position_info']['info']['id']) && intval($a['position_info']['info']['id'])>0 && empty($a['position_info']['info']['deleted_at'])){ ?>
            					            <div class="main-mail-item" title="<?= (!empty($a['position_info']['info']['description'])?$a['position_info']['info']['description']:'') ?>">
            									<div class="main-mail-star" style="display: flex;flex-direction: column;flex-wrap: nowrap;align-items: center;">
            									    <a class="text-white bg-dark rounded-10 my-1" onclick="positionAction('m',<?= intval($a['position_info']['info']['id']) ?>);"><i class="fa fa-cog fa-spin"></i></a>
            									</div>
            									<div class="main-img-user">
            									    <img alt="position icon" src="<?= base_url('assets/svg/position/'.(!empty($a['position_info']['info']['icon'])?$a['position_info']['info']['icon']:'position.svg')) ?>">
            									</div>
            									<div class="">
            										<div class="main-mail-from">
            										    <?= (!empty($a['position_info']['info']['title'])?$a['position_info']['info']['title']:'') ?>
            										</div>
            										<div class="main-mail-subject tx-10-f" style="max-width: 123px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                    								    <small class="text-warning">
                            							    قیمت: <?= (!empty($a['position_info']['info']['price']) && intval($a['position_info']['info']['price'])>0?number_format($a['position_info']['info']['price']).'تومان':'رایگان') ?>
                    									</small>
                    							        <br>
                    							        <?php if(!empty($a['position_info']['info']['status']) && intval($a['position_info']['info']['status'])>0){  ?>
                        								    <small class="badge bg-success-transparent text-success">
                        									    دردسترس
                        								    </small>
                    								    <?php }else{ ?>
                        								    <small class="badge bg-danger-transparent text-danger">
                        									    مشغول
                        								    </small>
                    								    <?php } ?>
            										</div>
            									</div>
            									<div class="main-mail-date pt-2">
            									    <a class="disableManager" onclick="deletePositionManager(this,<?= intval($a['position_info']['info']['id']) ?>);">
                                                        <i class="fas fa-trash tx-20-f text-danger"></i>
                                                    </a>
                									<a class="text-white bg-dark rounded-10 mb-1" onclick="positionAction('d',<?= intval($a['position_info']['info']['id']) ?>);"><i class="fa fa-pen tx-20"></i></a>
            									</div>
            								</div>
            					    <?php } 
            					    } ?>
        					    </div>
        				<?php }else{ ?>
        				    <div class="alert alert-danger text-center p-3 rounded-10">
        					    شما جایگاهی برای ارائه خدمات در کسب و کار خود ندارید یکی اضافه کنید
        				    </div>
        			    <?php }
        			    }else{
        			        if(!empty($data['positions']['access'])){ ?>
        			            <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
            					    <?php
            					    foreach($data['positions']['access'] as $a){
            					        if(!empty($a) && !empty($a['company_category_product_position_id']) && intval($a['company_category_product_position_id'])>0 && !empty($a['position_info']) && !empty($a['position_info']['info']) && 
            					        !empty($a['position_info']['info']['id']) && intval($a['position_info']['info']['id'])>0 && empty($a['position_info']['info']['deleted_at'])){ ?>
            					            <div class="main-mail-item" title="<?= (!empty($a['position_info']['info']['description'])?$a['position_info']['info']['description']:'') ?>">
            									<div class="main-mail-star" style="display: flex;flex-direction: column;flex-wrap: nowrap;align-items: center;">
            									    <a class="text-white bg-dark rounded-10 my-1" onclick="positionAction('m',<?= intval($a['position_info']['info']['id']) ?>);"><i class="fa fa-cog fa-spin"></i></a>
            									</div>
            									<div class="main-img-user">
            									    <img alt="position icon" src="<?= base_url('assets/svg/position/'.(!empty($a['position_info']['info']['icon'])?$a['position_info']['info']['icon']:'position.svg')) ?>">
            									</div>
            									<div class="main-mail-body">
            										<div class="main-mail-from">
            										    <?= (!empty($a['position_info']['info']['title'])?$a['position_info']['info']['title']:'') ?>
            										</div>
            										<div class="main-mail-subject tx-10-f" style="max-width: 123px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                        							    <small class="text-warning">
                        								    قیمت: <?= (!empty($a['position_info']['info']['price'])?number_format($a['position_info']['info']['price']).'تومان':'رایگان') ?>
                        								</small>
                    								    <?php if(!empty($a['position_info']['info']['status']) && intval($a['position_info']['info']['status'])>0){  ?>
                        								    <small class="badge bg-success-transparent text-success">
                        								        دردسترس
                        									</small>
                    								    <?php }else{ ?>
                        								    <small class="badge bg-danger-transparent text-danger">
                        								        مشغول
                        								    </small>
                    									<?php } ?>
            										</div>
            									</div>
            									<div class="main-mail-date pt-2">
                									<a class="text-white bg-dark rounded-10 mb-1" onclick="positionAction('d',<?= intval($a['position_info']['info']['id']) ?>);"><i class="fa fa-pen tx-20"></i></a>
            									</div>
            								</div>
            					    <?php } 
            					    } ?>
        					    </div>
        			        <?php }else{ ?>
        			            <div class="alert alert-danger text-center p-3 rounded-10">
            					    شما جایگاهی برای ارائه خدمات در کسب و کار خود ندارید یکی اضافه کنید
            				    </div>
        			    <?php }
        			    } ?>
        		    </div>
        	    </div>
    	    </span>
		</div>
	</div>
	<div class="d-none" id="add-position">
        <div class="modal d-block" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">افزودن جایگاه خدمت رسانی</h6>
                        <button onclick="hideAddPosition();" aria-label="بستن" class="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 400px;overflow: auto;">
                        <div class="card mb-0">
                            <div class="card-header">
                                <div class="row mt-2">
                                    <div class="col-12 text-center">
                                        عکس اصلی جایگاه کسب و کار را بارگذاری کنید
                                    </div>
                                    <div class="col-md-6 mt-2 mx-auto text-center">
                                        <?= (!empty($position_logo_uploader)?$position_logo_uploader:'') ?>
                                    </div>
                                </div>
                            </div>    
                            <div class="card-body pb-0">
                                <hr>
                                <div class="row mt-2">
                                    <div class="col-md-6">
        								<label>
        								    عنوان جایگاه
        								</label>
        								<input class="form-control shadow-light rounded-10" id="position-title" placeholder="اسم مورد نظر" type="text">
        							</div>
        							<div class="col-md-6">
                                        <?php if(!empty($category)){ ?>
                                            <label for="role-chooser">
                                                دسته بندی خدمات خود را تعیین کنید
                                            </label>
                                            <select id="position-category" class="text-center form-control SlectBox SumoUnder shadow-light rounded-10" tabindex="-1">
                                                <option value="0">متفرقه</option>
                                                <?php foreach($category as $a){ 
                                                    if(!empty($a) && !empty($a['id']) && !empty($a['title'])){ ?>
                                                        <option value="<?= $a['id'] ?>"><?= $a['title'] ?></option>
                                                <?php } 
                                                } ?>
            					    		</select>
                                        <?php } ?>
                                    </div>
        						</div>
        						<div class="row mt-2">
        							<div class="col-12">
        								<label>
        								    توضیحات ارائه خدمات جایگاه
        								</label>
        								<textarea row="4" class="form-control shadow-light rounded-10" id="position-description" placeholder="توضیحات کامل"></textarea>
        							</div>
        						</div>
        						<div class="row mt-2">
        							<div class="col-12">
        								<label>
        								    قیمت رزرو به تومان 
        								</label>
        								<div class="row">
        								    <div class="col-md-6">
        								        <div class="input-group shadow-light rounded-10 overflow-hidden">
                        							<div class="input-group-prepend">
                        								<div class="input-group-text">
                        									<label class="rdiobox wd-16 mg-b-0">
                        									    <input onclick="changePrice(this);" class="radio-type" value="" name="data[]" type="radio" checked>
                        									    <span></span>
                        								    </label>
                        								</div>
                        							</div>
                        						    <input class="form-control" readonly="" placeholder="رزرو به صورت رایگان است">
                        						</div>
        								    </div>
        								    <div class="col-md-6">
        								        <div class="input-group shadow-light rounded-10 overflow-hidden">
                        							<div class="input-group-prepend">
                        								<div class="input-group-text">
                        									<label class="rdiobox wd-16 mg-b-0">
                        									    <input onclick="changePrice(this);" class="radio-type" value="p" name="data[]" type="radio">
                        									    <span></span>
                        								    </label>
                        								</div>
                        							</div>
                                                    <input type="number" step="1000" class="form-control" id="position-price" readonly="" placeholder="قیمت رزرو جایگاه برای هر ساعت">
                        						</div>
        								    </div>
        								</div>
        							</div>
                                </div>
        						<p class="mg-b-10 mg-t-10">
        							نوع خدمات رسانی شما در این تجارت چیست؟
        							<span class="tx-danger">*</span>
        						</p>
        						<div class="row">
        							<div class="col-md-6">
        							    <label class="rdiobox">
        								    <input name="position-type-in-place" type="radio" value="0" checked="true">
        									<span>حضوری</span>
        								</label>
        							</div>
        							<div class="col-md-6">
        							    <label class="rdiobox">
    									    <input name="position-type-in-place" type="radio" value="1">
    										<span>آنلاین</span>
        								</label>
        							</div>
        						</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="addPositionAction();">
                            ایجاد جایگاه  
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script>
	    $(function(){
	        $('#product-count').text($('.main-content-body.main-content-body-mail').children().length);
	    })
	    function deletePositionManager(el,id){
	        $(el).parent().parent().remove();
	        sendAjax({id:id},baseUrl('company/position/position/disable_manager'),'');
	        $('#product-count').text($('.main-content-body.main-content-body-mail').children().length);
	    }
	    let typePricePosition=0;
        function showAddPosition(){
            $('#add-position').removeClass('d-none');
            return true;
        }
        function hideAddPosition(){
            $('#add-position').addClass('d-none');
            return true;
        }
        function addPositionAction(){
            let t=$('#position-title').val(),
            d=$('#position-description').val(),
            c=$('#position-category').val(),
            p=$('#position-price').val(),
            i=$('#add-position').find('.file-name').val(),
            pt=$('input[name="position-type-in-place"]:checked').val();
            if(t!=='' && d!==''){
                $('#position-title').removeClass('border-danger');
                $('#position-description').removeClass('border-danger');
                sendAjax({t:t,d:d,c:c,p:p,i:i,pt:pt},baseUrl('company/position/position/add'),'#content');
            }else{
                if(t!==''){
                    $('#position-title').removeClass('border-danger');
                }else{
                    $('#position-title').addClass('border-danger');
                }
                if(d!==''){
                    $('#position-description').removeClass('border-danger');
                }else{
                    $('#position-description').addClass('border-danger');
                }
                return not1();
            }
        }
        function changePrice(el){
            if($(el).val()=='p'){
                typePricePosition=1;
                $('#position-price').prop('readonly', false);
            }else{
                typePricePosition=0;
                $('#position-price').prop('readonly', true);
                $('#position-price').val('');
            }
        }
        function positionAction(t,i){
            sendAjax({t:t,i:i},baseUrl('company/position/position/management'),'');
        }
	</script>
<?php } ?>