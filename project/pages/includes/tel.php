<?php if(!empty($p_id) && intval($p_id)>0 && ((!empty($tel) && is_array($tel)) || ( !(!empty($tel) && is_array($tel)) && !empty($role) && is_string($role) && $role=='manager'))){ ?>
    <div class="modal d-block <?= (!empty($type) && $type=='position'?'position-tel-':'product-tel-').intval($p_id) ?>">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content border-0">
    		    <div class="modal-header">
        		    <a class="btn back-to-product-show-index wd-30 p-0 hd-30" onclick="backproductElementsTools(this,'tel',<?= intval($p_id) ?>);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/back.svg"></a>
        			<?php if(!empty($role) && is_string($role) && $role=='manager'){ ?>
            			<a class="btn back-to-product-show-index wd-30 p-0 hd-30 mr-auto" id="showAddTel" onclick="showAddTel();">
                            <img src="<?= base_url() ?>assets/svg/icon/add.svg">
                        </a>
                        <a class="mr-auto d-none" id="hideAddTel" onclick="hideAddTel();">
                            <i class="far fa-arrow-alt-circle-left tx-30-f text-danger"></i>
                        </a>
                    <?php } ?>
    		    </div>
    			<div class="modal-body mx-auto text-center p-7">
    			    <?php if(!empty($info)){ ?>
        				<h5><?= (!empty($info['title'])?$info['title']:'') ?></h5>
        				<img src="<?= base_url('assets/svg/'.(!empty($type) && $type=='position'?'position':'product').'/'.(!empty($info['icon'])?$info['icon']:(!empty($type) && $type=='position'?'position.svg':'product.svg'))) ?>" 
        				class=" user-img-circle hd-100 wd-150 mt-4 mb-3" alt="img">
        				<h4 class="mb-1 <?= (!empty($info['status']) && intval($info['status'])>0?'text-success':'text-danger') ?> font-weight-semibold"><?= (!empty($info['status']) && intval($info['status'])>0?'دردسترس ':'مشغول') ?></h4>
        				<h6 style="display:inline-block;text-align:center; max-width: 250px;max-height:100px;word-break: break-word;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" title="<?= (!empty($info['description'])?$info['description']:'') ?>"><?= (!empty($info['description'])?$info['description']:'') ?></h6>
    				<?php } ?>
    				<div class="">
    					<div class="row">
                            <div class="col-12" id="main-tel-bodys">
                        		<div class="card card-dashboard-eight pb-2">
                        			<h6 class="card-title border-bottom" style="padding-bottom: 10px;margin-bottom: 0;">
                        			    تماس با شماره ها</h6>
                        			<span class="d-block mg-b-10 text-muted tx-12"></span>
                        			<div class="card-body" style="overflow-x:hidden;overflow-y:auto; max-height:212px;">
                                    	<div class="list-group">
        					                <?php 
        					                if(!empty($tel) && is_array($tel)){
        					                foreach($tel as $a){ ?>
                                    			<div class="list-group-item border-bottom">
                                    			    <a class="icon icon-shape rounded-circle text-white mb-0 mr-3" href="tel:<?= $a['tel'] ?>" data-dismiss="modal" aria-label="بستن">
                    									<i class="fas fa-phone text-white bg-success"></i>
                    								</a>
                                    				<p>
                                    				</p>
                                    				<span title="<?= (!empty($a['description'])?$a['description']:'') ?>" style="max-width: 250px;max-height: 60px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                                        <?= (!empty($a['description'])?$a['description']:'') ?>
                                                    </span>
                                                    <?php if(!empty($role) && is_string($role) && $role=='manager'){ ?>
                                                        <a class="btn wd-30 p-1 mx-2 hd-30 disable btn-danger <?= (!empty($a['status'])&&intval($a['status'])>0?'':'d-none') ?>" onclick="disableTelAction(this,<?= $a['id'] ?>);"><img src="<?= base_url('assets/svg/icon/disable.svg') ?>"></a>
                                                        <a class="btn wd-30 p-1 mx-2 hd-30 enable btn-success <?= (!empty($a['status'])&&intval($a['status'])>0?'d-none':'') ?>" onclick="enableTelAction(this,<?= $a['id'] ?>);"><img src="<?= base_url('assets/svg/icon/enable.svg') ?>"></a>
                                                    <?php } ?>
                                    			</div>
                        					<?php } 
                        					}else{ ?>
                        					    <div class="alert alert-danger rounded-10 text-center">
                        					        اطلاعات تماسی وجود ندارد لطفا اضافه کنید
                        					    </div>
                        					<?php } ?>
                                		</div>
                        			</div>
                        		</div>
                        	</div>
                        	<?php if(!empty($role) && is_string($role) && $role=='manager'){ ?>
                            	<div id="add-product-tel" class="col-12 d-none">
                            	    <div class="mb-4 main-content-label">افزودن مشخصات تماس</div>
                            		<div class="form-group">
                        				<div class="row">
                        					<div class="col-md-3">
                        					    <label class="form-label">شماره تماس</label>
                        					</div>
                        					<div class="col-md-9">
                        					    <input id="p-tel-tel" type="text" class="shadow-light rounded-10 form-control" placeholder="شماره تماس">
                        				    </div>
                        			    </div>
                        			</div>
                            	    <div class="form-group">
                        				<div class="row">
                        					<div class="col-md-3">
                        					    <label class="form-label">شرایط پاسخگویی</label>
                        				    </div>
                        					<div class="col-md-9">
                        					    <textarea id="p-tel-des" class="shadow-light rounded-10 form-control" name="example-textarea-input" rows="3" placeholder="توضیحات "></textarea>
                        				    </div>
                        			    </div>
                        			</div>
                        		    <a class="btn btn-block btn-success rounded-10" onclick="addTelAction();">ذخیره اطلاعات</a>
                                </div>
                            <?php } ?>
    					</div>
    				</div>
    			</div>
    	    </div>
        </div>
    </div>
    <?php if(!empty($role) && is_string($role) && $role=='manager'){ ?>
        <script>
            function showAddTel(){
                $('#showAddTel').addClass('d-none');
                $('#hideAddTel').removeClass('d-none');
                $('#main-tel-bodys').addClass('d-none');
                $('#add-product-tel').removeClass('d-none');
                return true;
            }
            function hideAddTel(){
                $('#hideAddTel').addClass('d-none');
                $('#showAddTel').removeClass('d-none');
                $('#add-product-tel').addClass('d-none');
                $('#main-tel-bodys').removeClass('d-none');
                return true;
            }
            function addTelAction(){
                if($('#p-tel-tel').val()!==''&&$('#p-tel-des').val()!==''){
                    $('#p-tel-tel').removeClass('border-danger');
                    $('#p-tel-des').removeClass('border-danger');
                    sendAjax({tel:$('#p-tel-tel').val(),des:$('#p-tel-des').val()},baseUrl("<?= ($type=='position'?'company/position/position/add_tel':'company/product/product/add_tel') ?>"),'');
                    return true;
                }else{
                    if($('#p-tel-tel').val()!==''){
                       $('#p-tel-tel').removeClass('border-danger');
                    }else{
                        $('#p-tel-tel').addClass('border-danger');
                    }
                    if($('#p-tel-des').val()!==''){
                       $('#p-tel-des').removeClass('border-danger');
                    }else{
                        $('#p-tel-des').addClass('border-danger');
                    }
                    return not1();
                }
            }
            function disableTelAction(el,id){
                $(el).addClass('d-none');
                $(el).parent().find('.enable').removeClass('d-none');
                sendAjax({id:id},baseUrl("<?= ($type=='position'?'company/position/position/disable_tel':'company/product/product/disable_tel') ?>"),'');
                return true;
            }
            function enableTelAction(el,id){
                $(el).addClass('d-none');
                $(el).parent().find('.disable').removeClass('d-none');
                sendAjax({id:id},baseUrl("<?= ($type=='position'?'company/position/position/enable_tel':'company/product/product/enable_tel') ?>"),'');
                return true;
            }
        </script>
<?php } 
} ?>


 