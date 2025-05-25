<?php if(!empty($data) && !empty($data['0']) && !empty($position_id) && intval($position_id)>0){ 
    $category_selected=(!empty($category_selected) && !empty($category_selected['0']) && !empty($category_selected['0']['category_id']) && intval($category_selected['0']['category_id'])>0?intval($category_selected['0']['category_id']):0); ?>
    <script src="<?= base_url('assets/js/includes/format_number.js') ?>"></script>
    <div class="row row-sm mt-3">
    	<div class="col-lg-4">
    	    <div class="card mg-b-20">
    		    <div class="card-body text-center">
    			    <div class="pl-0">
    				    <div class="main-profile-overview">
    					    <div class="main-img-user profile-user">
    						    <img alt="position profile" src="<?= base_url('assets/svg/position/'.(!empty($data['0']['icon'])?$data['0']['icon']:'position.svg')) ?>">
    						</div>
    						<div class="text-center mg-b-20">
    							<div id="profile-user-picture-upload">
    							    <?= (!empty($uploader)?$uploader:'') ?>
    							</div>
    						</div>
    						<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
							<div class="row">
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('position_company_manager') ?>">
                					    <i class="si si-credit-card mx-1"></i>
                					    جایگاه مربوط
                				    </a>
                                </div>
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
    	    <div class="card">
    		    <div class="card-body pb-0">
    				<form class="form-horizontal">
        			    <div class="mb-4 main-content-label">اطلاعات جایگاه</div>
    					<div class="form-group">
    					    <div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">عنوان</label>
    							</div>
    							<div class="col-md-9">
    							    <input id="position-title" value="<?= (!empty($data['0']['title'])?$data['0']['title']:'') ?>" type="text" class="shadow-light rounded-10 form-control" placeholder="نام جایگاه">
    							</div>
    						</div>
    					</div>
    					<div class="form-group">
    						<div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">
                                        توضیحات
							        </label>
    							</div>
    							<div class="col-md-9">
    							    <textarea id="position-des" class="shadow-light rounded-10 form-control" name="example-textarea-input" rows="4" placeholder="توضیحات خدمات"><?= (!empty(trim($data['0']['description']))?trim($data['0']['description']):'') ?></textarea>
    							</div>
    						</div>
    					</div>
    					<div class="mb-4 main-content-label">نوع خدمات رسانی</div>
    					<div class="form-group">
    						<div class="row">
        						<div class="col-6">
        						    <label class="rdiobox">
        							    <input name="position-type-in-place" type="radio" value="0" <?= (!empty($data['0']['position_type']) && intval($data['0']['position_type'])>0?'':'checked="true"') ?>>
        								<span>حضوری</span>
        							</label>
    							</div>
    							<div class="col-6">
        						    <label class="rdiobox">
    								    <input name="position-type-in-place" type="radio" value="1" <?= (!empty($data['0']['position_type']) && intval($data['0']['position_type'])>0?'checked="true"':'') ?>>
    									<span>آنلاین</span>
        							</label>
        						</div>
        					</div>
    				    </div>
    				    <div class="mb-4 main-content-label">دسته بندی جایگاه</div>
        			    <?php if(!empty($category)){ ?>
            			    <div class="form-group">
            			        <div class="row my-2">
            						<div class="col-12 text-center">
                                        <select id="position-category" class="form-control SlectBox SumoUnder shadow-light rounded-10" tabindex="-1">
                                            <option value="0">متفرقه</option>
                                            <?php foreach($category as $a){ 
                                                if(!empty($a) && !empty($a['id']) && intval($a['id'])>0){ ?>
                                                    <option <?= (intval($a['id'])===intval($category_selected)?'selected':'') ?> value="<?= intval($a['id']) ?>"><?= (!empty($a['title'])?$a['title']:'') ?></option>
                                            <?php } 
                                            } ?>
                                        </select>
                                    </div>
            					</div>
            			    </div>
        			    <?php } ?>
        			    <div class="mb-4 main-content-label">قیمت رزرو جایگاه در ساعت به تومان</div>
    					<div class="form-group">
    					    <div class="row">
        						<div class="col-6">
        							<div class="input-group shadow-light rounded-10 overflow-hidden">
                        				<div class="input-group-prepend">
                        					<div class="input-group-text">
                        						<label class="rdiobox wd-16 mg-b-0">
                        							<input onclick="changePrice(this);" class="radio-type" value="p" name="data[]" type="radio" <?= (!empty($data['0']['price']) && intval($data['0']['price'])>0?'checked':'') ?>>
                        						    <span></span>
                        					    </label>
                        				    </div>
                        				</div>
                                        <input type="number" onkeyup="addTax(this);" step="1000" class="form-control" id="position-price" 
                                        <?= (!empty($data['0']['price']) && intval($data['0']['price'])>0?'value="'.intval($data['0']['price']*10/11).'"':'readonly=""') ?> placeholder="قیمت رزرو جایگاه برای هر ساعت">
                        		    </div>
        					    </div>
        					    <div class="col-6">
        							<div class="input-group shadow-light rounded-10 overflow-hidden">
                        				<div class="input-group-prepend">
                        					<div class="input-group-text">
                        						<label class="rdiobox wd-16 mg-b-0">
                        							<input onclick="changePrice(this);" class="radio-type" value="" name="data[]" type="radio" <?= (!empty($data['0']['price']) && intval($data['0']['price'])>0?'':'checked') ?>>
                        						    <span></span>
                        					    </label>
                        				    </div>
                        				</div>
                        			    <input class="form-control" readonly="" placeholder="رزرو به صورت رایگان است">
                        		    </div>
        						</div>
        					</div>
        					<div class="row">
        						<div class="col-12">
                        		    <div class="alert alert-warning text-center p-4 mt-4 rounded-10">
                        		        قیمت با احتساب مالیات:
                        		        <span id="newPrice"><?= (!empty($data['0']['price']) && intval($data['0']['price'])>0?number_format($data['0']['price']).' تومان':'رایگان') ?></span>
                        		        
                        		    </div>
        						</div>
        					</div>
    					</div>
    				</form>
    			</div>
    			<div class="card-footer text-left">
    			    <button type="button" onclick="saveEditPosition(1);" class="btn btn-success-gradient btn-block">بروزرسانی و ماندن</button>
    			    <button type="button" onclick="saveEditPosition(0);" class="btn btn-success-gradient btn-block">بروزرسانی و بازگشت</button>
    			</div>
    			</div>
    		</div>
    	</div>
    </div>
    <script>
        function addTax(el){
            let a = parseFloat($(el).val()),tax=0,newPrice=0;
            if(a !== 'NaN' && a>0){
                tax=(a/10);
                newPrice=a+tax;
                $('#newPrice').text($.number_format(newPrice)+' تومان');
            }else{
                $('#newPrice').text('رایگان');
            }
            return true;
        }
        function saveEditPosition(sp){
            if($('#position-title').val()!=='' && $('#position-des').val()!==''){
                let a =parseFloat($('#position-price').val());
                if (!isNaN(a)) a=a+(a/10); else a='';
                $('#position-title').removeClass('border-danger');
                $('#position-des').removeClass('border-danger');
                if(sp===1){
                    sendAjax({
                        id:<?= intval($position_id) ?>,
                        c:$('#position-category').val(),
                        pt:$('input[name="position-type-in-place"]:checked').val(),
                        t:$('#position-title').val(),
                        d:$('#position-des').val(),
                        p:a,
                        stayPage:sp,
                        i:$('#profile-user-picture-upload').find('.file-name').val()
                    },baseUrl('company/position/position/edit'),'#content');
                    return not10();
                }else{
                    sendAjax({
                        id:<?= intval($position_id) ?>,
                        c:$('#position-category').val(),
                        pt:$('input[name="position-type-in-place"]:checked').val(),
                        t:$('#position-title').val(),
                        d:$('#position-des').val(),
                        p:a,
                        stayPage:sp,
                        i:$('#profile-user-picture-upload').find('.file-name').val()
                    },baseUrl('company/position/position/edit'),'');
                }
            }else{
                if($('#position-title').val()!==''){
                    $('#position-title').removeClass('border-danger');
                }else{
                    $('#position-title').addClass('border-danger');
                }
                if($('#position-des').val()!==''){
                    $('#position-des').removeClass('border-danger');
                }else{
                    $('#position-des').addClass('border-danger');
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
                $('#newPrice').text('رایگان');
            }
        }
    </script>
<?php } ?>