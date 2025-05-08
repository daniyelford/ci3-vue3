<?php if(!empty($data) && !empty($p_id) && intval($p_id)>0){ ?>
    <div class="row row-sm mt-3">
    	<div class="col-lg-4">
    	    <div class="card mg-b-20">
    		    <div class="card-body text-center">
    			    <div class="pl-0">
    				    <div class="main-profile-overview">
    					    <div class="main-img-user profile-user">
    						    <img alt="position profile" src="<?= base_url('assets/svg/position/'.(!empty($data['info']['icon'])?$data['info']['icon']:'position.svg')) ?>">
    						</div>
    						<br>
    						<label class="main-content-label tx-13 mg-x-10"><?= (!empty($data['info']['title'])?$data['info']['title']:'') ?></label>
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
                    		<div class="row row-sm mt-2">
                        	    <div class="col-md-7 mx-auto">
                                    <img class="w-100 rounded-10" onclick="downloadImage(this);" src="<?= base_url('assets/qrcode/'.(!empty($data['info']['qr_code'])?$data['info']['qr_code']:'tes.png')) ?>" alt="position qrcode">
                                </div>
                            </div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-8">
    		<div class="row row-sm">
    	        <div class="col-12 text-center mb-1" onclick="productElementsToolsForManager(this,'form');">
        	        <div class="text-right btn btn-light btn-block rounded-10">
        	            <i class="la la-image tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        مدیریت فرم پرسشنامه
            		    </h3>
        	        </div>
    		    </div>
    	        <div class="col-12 text-center mb-1" onclick="productElementsToolsForManager(this,'image');">
        	        <div class="text-right btn btn-info btn-block rounded-10">
        	            <i class="la la-image tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        مدیریت عکس ها
            		    </h3>
        	        </div>
    		    </div>
    		    <div class="col-12 text-center mb-1" onclick="productElementsToolsForManager(this,'video');">
        	        <div class="text-right btn btn-primary btn-block rounded-10">
        	            <i class="la la-film tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        مدیریت فیلم ها
            		    </h3>
        	        </div>
    		    </div>
    		    <div class="col-12 text-center mb-1" onclick="productElementsToolsForManager(this,'tel');">
        	        <div class="text-right btn btn-success btn-block rounded-10">
        	            <i class="si si-call-out tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        شماره های تماس
            		    </h3>
        	        </div>
    		    </div>
    		    <div class="col-12 text-center mb-1" onclick="showProductMapManagerTool();">
        	        <div class="text-right btn btn-warning btn-block rounded-10">
        	            <i class="si si-location-pin tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        مشخص کردن مکان
            		    </h3>
        	        </div>
    		    </div>
    		    <div class="col-12 text-center mb-1" onclick="productElementsToolsForManager(this,'chat');">
        	        <div class="text-right btn btn-danger btn-block rounded-10">
        	            <i class="icon ion-md-chatboxes tx-40 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        پیام های کاربران
            		    </h3>
        	        </div>
    		    </div>
    		    <div class="col-12 text-center mb-1" onclick="productElementsToolsForManager(this,'products');">
        	        <div class="text-right btn btn-pink btn-block rounded-10">
        	            <i class="si si-basket-loaded tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        محصولات قابل ارائه
            		    </h3>
        	        </div>
    		    </div>
                <div class="col-12 text-center mb-1 d-none" onclick="productElementsToolsForManager(this,'reserve');">
        	        <div class="text-right btn btn-secondary btn-block rounded-10">
        	            <i class="fe fe-bell tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        رزرو های مشتریان
            		    </h3>
        	        </div>
    		    </div>
			    <div class="show-div-setting col-12">
			        <div class="form <?= (!empty($_GET['action']) && $_GET['action']=='form'?'':'d-none') ?>">
			             <div class="modal d-block">
                        	<div class="modal-dialog modal-lg" role="document">
                        		<div class="modal-content border-0">
                        		    <div class="modal-header">
                            		    <a class="btn back-to-product-show-index wd-30 p-0 hd-30" onclick="backproductElementsTools(this,'form',0);">
                            		        <img class="w-100d h-100d" alt="back form position" src="<?= base_url('assets/svg/back.svg') ?>">
                            		    </a>
                            		    <a class="btn btn-dark-gradient rounded-10 wd-25 ml-2 mr-auto p-0" onclick="showAddQuestion(this);" style="text-align: right;display: block;">
                                		    <img class="w-100 h-100" src="<?= base_url('assets/svg/icon/add.svg') ?>" alt="add question">
                                		</a>
                                    </div>
                        			<div class="modal-body text-center w-100" style="max-height: 550px;overflow-y: auto;">
                        			    <div class="row add-form-question d-none">
                        			        <div class="col-12">
                        			            <div class="card">
                            			            <div class="card-body">
                        			                    <div class="row">
                        			                        <div class="col-12 form-group">
            							                        <label class="form-label">
            							                            عنوان سوال
            							                            <input class="form-control question" type="text">
            							                        </label>
            								                </div>
                        			                    </div>
                        			                    <div class="row">
            								                <div class="col-md-6" style="border-bottom-left-radius: 10px;border-left: 1px solid green;border-bottom: 1px solid lightgreen;padding-top: 6px;">
                    								            <h6>نوع جواب سوال دریافتی</h6>
                    								            <div class="row">
                                                				    <div class="col-6">
                    							                        <label class="rdiobox"><input class="addTypeQuestion" checked="checked" value="text" name="type_question" type="radio"><span>دریافت متن</span></label>
                    								                </div>
                                    					            <div class="col-6">
                                            						    <label class="rdiobox"><input class="addTypeQuestion" value="image" name="type_question" type="radio"><span>دریافت تصویر</span></label>
                    						                        </div>
                    								            </div>
            								                </div>
            								                <div class="col-md-6" style="border-bottom-left-radius: 10px;border-left: 1px solid green;border-bottom: 1px solid lightgreen;padding-top: 6px;">
                    								            <h6>اولویت پاسخ به سوال</h6>
                    								            <div class="row">
                                                					<div class="col-6">
                    							                        <label class="rdiobox"><input class="addRequired" checked="checked" value="1" name="required" type="radio"><span>اجباری</span></label>
                    								                </div>
                                    					            <div class="col-6">
                                            						    <label class="rdiobox"><input class="addRequired" value="0" name="required" type="radio"><span>اختیاری</span></label>
                    						                        </div>
                                					            </div>
            								                </div>
            								            </div>
                            			            </div>
                            			            <div class="card-footer">
                        			                    <a onclick="addQuestion(this);"class="p-2 rounded-10 btn btn-block btn-success-gradient">افزودن سوال فرم</a>
                            			            </div>
                        			            </div>
                        			        </div>
                        			    </div>
                        			    <div class="row">
                					        <div class="col-12 text-start">
                					            <?php if(!empty($position_form_question) && is_array($position_form_question)){
                					                foreach($position_form_question as $for){ 
                					                    if(!empty($for) && !empty($for["question"]['id']) && intval($for["question"]['id'])>0 && !empty($for["form"]['id']) && intval($for["form"]['id'])>0){ ?>
                					                        <div class="row">
                					                            <div class="col-2">
                					                                <a class="mt-5 disable <?= (!empty($for["form"]['status'])&&intval($for["form"]['status'])>0?'':'d-none') ?>" onclick="disableFormQuestion(this,<?= intval($for["form"]['id']) ?>);" title="غیرفعال کردن سوال">
                					                                    <i class="fas fa-ban text-danger tx-20-f"></i>
                					                                </a>
                					                                <a class="mt-5 enable <?= (!empty($for["form"]['status'])&&intval($for["form"]['status'])>0?'d-none':'') ?>" onclick="enableFormQuestion(this,<?= intval($for["form"]['id']) ?>);" title="فعال کردن سوال">
                    					                                <i class="far fa-check-circle text-success tx-20-f"></i>
                					                                </a>
                					                            </div>
                					                            <div class="col-9">
                        					                        <div class="row">
                        					                            <div class="col-12 form-group">
            							                            		<label class="form-label">
            							                            		    عنوان سوال
            							                            		    <input onchange="questionChangeQuestion(this,<?= intval($for['question']['id']) ?>);" value="<?= (!empty($for["question"]['question'])?$for["question"]['question']:'') ?>" class="form-control question" type="text">
            							                            	    </label>
            								                            </div>
            								                        </div>
            								                        <div class="row">
            								                            <div class="col-md-6" style="border-bottom-left-radius: 10px;border-left: 1px solid red;border-bottom: 1px solid pink;padding-top: 6px;">
                    								                        <h6>نوع جواب سوال دریافتی</h6>
                    								                        <div class="row">
                                                								<div class="col-6">
                    							                            		<label class="rdiobox"><input onchange="typeQuestionChange(this,<?= intval($for['question']['id']) ?>);" class="typeQuestion" <?= (!empty($for["question"]['type_question']) && $for["question"]['type_question']=='text'?'checked="checked"':'') ?> value="text" name="type_question<?= (!empty($for["question"]['id'])?$for["question"]['id']:0) ?>" type="radio"><span>دریافت متن</span></label>
                    								                            </div>
                                    					                        <div class="col-6">
                                            							    		<label class="rdiobox"><input onchange="typeQuestionChange(this,<?= intval($for['question']['id']) ?>);" class="typeQuestion" <?= (!empty($for["question"]['type_question']) && $for["question"]['type_question']=='image'?'checked="checked"':'') ?> value="image" name="type_question<?= (!empty($for["question"]['id'])?$for["question"]['id']:0) ?>" type="radio"><span>دریافت تصویر</span></label>
                    						                            		</div>
                    								                        </div>
            								                            </div>
            								                            <div class="col-md-6" style="border-bottom-left-radius: 10px;border-left: 1px solid red;border-bottom: 1px solid pink;padding-top: 6px;">
                    								                        <h6>اولویت پاسخ به سوال</h6>
                    								                        <div class="row">
                                                								<div class="col-6">
                    							                            		<label class="rdiobox"><input onchange="requiredChange(this,<?= intval($for['question']['id']) ?>);" class="required" <?= (!empty($for["question"]['required']) && intval($for["question"]['required'])>0?'checked="checked"':'') ?> value="1" name="required<?= (!empty($for["question"]['id'])?$for["question"]['id']:0) ?>" type="radio"><span>اجباری</span></label>
                    								                            </div>
                                    					                        <div class="col-6">
                                            							    		<label class="rdiobox"><input onchange="requiredChange(this,<?= intval($for['question']['id']) ?>);" class="required" <?= (!empty($for["question"]['required']) && intval($for["question"]['required'])>0?'':'checked="checked"') ?> value="0" name="required<?= (!empty($for["question"]['id'])?$for["question"]['id']:0) ?>" type="radio"><span>اختیاری</span></label>
                    						                            		</div>
                                					                        </div>
            								                            </div>
            								                        </div>
                					                            </div>
                					                        </div>
                					                        <hr>
    				                                    <?php }
                					                }
    				                            } ?>
                					        </div>
                					    </div>
			                        </div>
			                    </div>
    			            </div>
			            </div>
    				</div>
    				<div class="tel <?= (!empty($_GET['action']) && $_GET['action']=='tel'?'':'d-none') ?>">
    				    <?= $data['tel'] ?>
    				</div>
    				<div class="image <?= (!empty($_GET['action']) && $_GET['action']=='image'?'':'d-none') ?>">
    				    <?= $data['image'] ?>
    				</div>
    				<div class="video <?= (!empty($_GET['action']) && $_GET['action']=='video'?'':'d-none') ?>">
    				    <?= $data['video'] ?>
    				</div>
    				<div class="map <?= (!empty($_GET['action']) && $_GET['action']=='map'?'':'d-none') ?>">
    				    <?= $data['map'] ?>
    				</div>
    				<div class="chat <?= (!empty($_GET['action']) && $_GET['action']=='chat'?'':'d-none') ?>" id="chatmodelposition<?= intval($p_id) ?>">
    				    <?= $data['chat'] ?>
    				</div>
    				<div class="products <?= (!empty($_GET['action']) && $_GET['action']=='products'?'':'d-none') ?>">
    				    <div class="modal d-block">
                        	<div class="modal-dialog" role="document">
                        		<div class="modal-content border-0">
                        		    <div class="modal-header">
                            		    <a class="btn back-to-product-show-index wd-30 p-0 hd-30" onclick="backproductElementsTools(this,'products',0);">
                            		        <img class="w-100d h-100d" src="<?= base_url('assets/svg/back.svg') ?>">
                            		    </a>
                                    </div>
                        			<div class="modal-body mx-auto text-center p-7">
                        			    <div class="row">
                					        <div class="card">
                                			    <div class="card-header pb-0">
                                			        <h5>
                                			            تعیین محصول برای جایگاه
                                			        </h5>
                                			        <p>
                                			            شما در این بخش می توانید محصولات کسب و کار خود را در این جایگاه ارائه بدهید
                                			        </p>
                                			    </div>
        				                        <div class="card-body pt-1">
            					        			<?php if(!empty($company_product)){ ?>
            					        			    <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
            					        			        <?php foreach($company_product as $a){
            					        			            if(!empty($a)){ ?>
                            					            	    <div class="main-mail-item" title="<?= (!empty($a['description'])?$a['description']:'') ?>">
                                    									<div>
                                    										<label class="ckbox">
                                    										    <input 
                                    										    onclick="setAccessPP(this,<?= intval($p_id).','.intval($a['id']).','.intval($company_id) ?>);" 
                                    										    <?= !empty($position_product) && in_array(intval($a['id']),$position_product)?'checked':'' ?> type="checkbox"> 
                                    										    <span></span>
                                    									    </label>
                                    									</div>
                                    									<div class="main-img-user">
                                    									    <img alt="product icon" src="<?= base_url('assets/svg/product/'.(!empty($a['icon'])?$a['icon']:'product.svg')) ?>">
                                    									</div>
                                    									<div class="main-mail-body">
                                    										<div class="main-mail-from">
                                    										    <?= (!empty($a['title'])?$a['title']:(!empty($a['key'])?$a['key']:'')) ?>
                                    										</div>
                                    									</div>
                        								            </div>
                								            <?php }
                								            } ?>
                								        </div>
            								        <?php }else{ ?>
            								            <div class="alert alert-danger rounded-10 text-center p-3">
            								                شما محصولی در کسب و کار برای عرضه ندارید
            								            </div>
            								        <?php } ?>
                								</div>
            								</div>
                        				</div>
                        			</div>
                        	    </div>
                            </div>
                        </div>
    				</div>
    				<div class="reserve <?= (!empty($_GET['action']) && $_GET['action']=='reserve'?'':'d-none') ?>">
    				     <div class="modal d-block">
                        	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        		<div class="modal-content border-0">
                        		    <div class="modal-header">
                            		    <a class="btn back-to-product-show-index wd-30 p-0 hd-30" onclick="backproductElementsTools(this,'reserve',0);">
                            		        <img class="w-100d h-100d" src="<?= base_url('assets/svg/back.svg') ?>">
                            		    </a>
                                    </div>
                        			<div class="modal-body text-center p-7">
                        			    <div class="row">
                        			        <div class="col-12">
                    					        <div class="card">
                                    			    <div class="card-header pb-0">
                                    			        <h5>
                                    			            مدیریت رزرو ها
                                    			        </h5>
                                    			        <p>
                                    			            شما می توانید درخواست های رزرو توسط مشتریان برای این جایگاه را مدیریت کنید
                                    			        </p>
                                    			    </div>
            				                        <div class="card-body pt-1" id="all-reserves-info" style="max-height: 350px;overflow: auto;">
                					        		    <?php if(!empty($reserve) && is_string($reserve)){ 
                					        		        echo $reserve;
                					        		    }else{ ?>
        				                                    <div class="alert alert-danger text-center rounded-10 p-3">
        				                                        شما هیچ رزروی در این جایگاه ندارید
        				                                    </div>
        				                                <?php } ?>
        				                            </div>
        				                        </div>
                        			        </div>
    				                    </div>
    				                </div>
    				            </div>
    				        </div>
    				    </div>
    				</div>
				</div>
    		</div>
    	</div>
    </div>
    <script>
        function typeQuestionChange(el,qId){
            sendAjax({type_question:$(el).val(),id:qId},baseUrl('company/position/position/edit_type_question_form_question'),'');
        }
        function requiredChange(el,qId){
            sendAjax({required:$(el).val(),id:qId},baseUrl('company/position/position/edit_required_form_question'),'');
        }
        function questionChangeQuestion(el,qId){
            if($(el).val()!==''){
                $(el).css('border','1px solid lightgreen');
                sendAjax({question:$(el).val(),id:qId},baseUrl('company/position/position/edit_question_form_question'),'');
            }else{
                $(el).css('border','1px solid red');
            }
        }
        function disableFormQuestion(el,fId){
            $(el).addClass('d-none');
            $(el).parent().find('.enable').removeClass('d-none');
            sendAjax({id:fId,status:0},baseUrl('company/position/position/edit_form_status'),'');
        }
        function enableFormQuestion(el,fId){
            $(el).addClass('d-none');
            $(el).parent().find('.disable').removeClass('d-none');
            sendAjax({id:fId,status:1},baseUrl('company/position/position/edit_form_status'),'');
        }
        function showAddQuestion(el){
            $(el).addClass('d-none');
            $(el).parent().parent().find('.add-form-question').removeClass('d-none');
        }
        function addQuestion(el){
            let a=$(el).parent().parent().find('.addRequired').serialize().replace('=', '":"'),
            b=$(el).parent().parent().find('.addTypeQuestion').serialize().replace('=', '":"'),
            c=$(el).parent().parent().find('.question').val(),data;
            if(c!==''){
                $(el).parent().parent().find('.question').css('border','1px solid green');
                data='{"question":"'+c+'","'+a+'","'+b+'"}';
                sendAjax($.parseJSON(data),baseUrl('company/position/position/add_form'),'');
            }else{
                $(el).parent().parent().find('.question').css('border','1px solid red');
                return not1();
            }
        }
        $(function (){
            <?php if(!empty($_GET['action']) && $_GET['action']=='map'){ ?>
                mapMarkerChangeLocationImage('position',true,0,0,<?= $p_id ?>,0);
            <?php } ?>
        });
        function showPositionForm(el){
            $(el).addClass('d-none');
            $(el).parent().find('.hidePositionForm').removeClass('d-none');
            $(el).parent().parent().children('.showPositionForm').removeClass('d-none');
        }
        function hidePositionForm(el){
            $(el).addClass('d-none');
            $(el).parent().find('.showPositionForm').removeClass('d-none');
            $(el).parent().parent().children('.showPositionForm').addClass('d-none');
        }
        function showProductMapManagerTool(){
            processAjaxData(document.title,$('#content').html(),baseUrl('company_position_setting?action=map'));
            mapMarkerChangeLocationImage('position',true,0,0,<?= $p_id ?>,0);
        }
        function checkBackUrlFunction(){
            processAjaxData(document.title,$('#content').html(),baseUrl('company_position_setting'));
        }
        function productElementsToolsForManager(el,type){
            productElementsTools(el,type,0);
            processAjaxData(document.title,$('#content').html(),baseUrl('company_position_setting?action='+type));
        	return true;    
        }
        function savePositionReserveTime(el,positionUserId){
            let h=$(el).parent().find('.hour').val(),d=$(el).parent().find('.day').val(),m=$(el).parent().find('.month').val(),y=$(el).parent().find('.year').val();
            if(h!==''&&d!==''&&m!==''&&y!==''){
                sendAjax({h:h,d:d,m:m,y:y,positionUserId:positionUserId},baseUrl('company/position/position/change_reserve_time'),'#all-reserves-info');
                $(el).addClass('d-none');
                sendAjax({send:'ok'},baseUrl('company/position/position/side'),'#side2');
            }else{
                return not8();
            }
            return true;
        }
        function arrivedPersent(positionId,id){
            sendAjax({positionId:positionId,id:id},baseUrl('company/position/position/arrived_persent'),'#all-reserves-info');
            sendAjax({send:'ok'},baseUrl('company/position/position/side'),'#side2');
            return true;
        }
        function endService(positionId,id){
            sendAjax({positionId:positionId,id:id},baseUrl('company/position/position/end_service'),'#all-reserves-info');
            sendAjax({send:'ok'},baseUrl('company/position/position/side'),'#side2');
            return true;
        }
        function showOrderProduct(el){
            $(el).addClass('d-none');
            $(el).parent().find('.hideOrderProduct').removeClass('d-none');
            $(el).parent().parent().children('.showOrderProduct').removeClass('d-none');
        }
        function hideOrderProduct(el){
            $(el).addClass('d-none');
            $(el).parent().find('.showOrderProduct').removeClass('d-none');
            $(el).parent().parent().children('.showOrderProduct').addClass('d-none');
        }
        function showPositionReserveTime(el){
            $(el).addClass('d-none');
            $(el).parent().find('.hidePositionReserveTime').removeClass('d-none');
            $(el).parent().parent().children('.showPositionReserveTime').removeClass('d-none');
        }
        function hidePositionReserveTime(el){
            $(el).addClass('d-none');
            $(el).parent().find('.showPositionReserveTime').removeClass('d-none');
            $(el).parent().parent().children('.showPositionReserveTime').addClass('d-none');
        }
        function showReserveInfo(el,id){
            $(el).parents('.all-reserves-info').children('.re-info').addClass('d-none');
            $(el).parents('.all-reserves-info').find('.re-count-'+id).removeClass('d-none');
            return true;
        }
        function setAccessPP(el,posId,proId,cId){
            let s=0;
            if(el.checked) s=1;
            sendAjax({s:s,posId:posId,proId:proId,cId:cId},baseUrl('company/position/position/position_products'),'');
        }
    </script>
<?php } ?>