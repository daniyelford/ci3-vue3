<?php if(!empty($p_id) && intval($p_id)>0 && ((!empty($key) && !empty($value) && is_array($key) && is_array($value))||(!(!empty($key) && !empty($value) && is_array($key) && is_array($value)) && !empty($role) && is_string($role) && $role=='manager'))){ ?>
    <div class="modal d-block <?= (!empty($type) && $type=='position'?'position-key-':'product-key-').intval($p_id) ?>">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content border-0">
    		    <div class="modal-header">
        		    <a class="btn back-to-product-show-index wd-30 p-0 hd-30" onclick="backproductElementsTools(this,'key-value',<?= intval($p_id) ?>);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/back.svg"></a>
        			<?php if(!empty($role) && is_string($role) && $role=='manager'){ ?>
            			<a class="btn wd-30 p-0 hd-30 mr-auto showAddKey" onclick="showAddKey(this);">
                            <img src="<?= base_url() ?>assets/svg/icon/add.svg">
                        </a>
                        <a class="mr-auto d-none hideAddKey" onclick="hideAddKey(this);">
                            <i class="far fa-arrow-alt-circle-left tx-30-f text-danger"></i>
                        </a>
                    <?php } ?>
    		    </div>
    			<div class="modal-body key-values p-7" style="height: 400px;overflow: auto;">
    	            <div class="row">
            			<div class="col-12">
            				<div class="card mg-b-20">
            					<div class="card-body">
            					    <?php if(!empty($key) && !empty($value)){ ?>
                						<div class="row">
                							<div class="col-12">
                                                <ul class="product-value tree" style="text-align: right;">
                                                    <?php foreach($key as $a){
                                                        foreach($value as $b){
                                                            if(intval($b['product_key_id'])==intval($a['id'])){ ?>
                                                                <li class="branch product-info my-2 <?= (!empty($a['responsive'])&&intval($a['responsive'])>0?'':'d-none-responsive') ?>" style="clear: both;">
                                                                    <a class="w-100 d-inline-block product-key-<?= $a['key'] ?> title-product-key" onclick="showProductValue(this);" style="border-bottom: 1px solid gray;padding: 6px;">
                                                                        <i class="si si si-plus ml-2"></i>
                                                                        <?= (!empty($a['title'])?$a['title']:$a['key']) ?>
                                                                    </a>
                                                                    <?php if(!empty($role) && is_string($role) && $role=='manager'){ ?>
                                                                        <span class="d-none edit-product-key edit-product-key-<?= intval($a['id']) ?>">
                                                                            <input type="text" class="edit-box-key form-control w-50 d-inline-block" value="<?= (!empty($a['title'])?$a['title']:'') ?>">
                                                                        </span>
                                                                        <span class="f-left" style="display: flex;flex-wrap: nowrap;flex-direction: row;justify-content: flex-start;align-content: stretch;align-items: center;">
                                                                            <a class="show mx-1" onclick="ShowChangeKey(this);">
                                                                                <i class="fa fa-cog fa-spin text_primary tx-20-f"></i>
                                                                            </a>
                                                                            <a class="mx-1 accesp d-none" onclick="editKeyAction(this,<?= $a['id'] ?>);">
                                                                                <i class="far fa-check-circle text-success tx-20-f"></i>
                                                                            </a>
                                                                            <a class="mx-1 disable <?= (!empty($a['status'])&&intval($a['status'])>0?'':'d-none') ?>" 
                                                                            onclick="disableKeyAction(this,<?= $a['id'] ?>);">
                                                                                <i class="icon ion-ios-pause text-warning tx-20-f"></i>
                                                                            </a>
                                                                            <a class="mx-1 enable <?= (!empty($a['status'])&&intval($a['status'])>0?'d-none':'') ?>" 
                                                                            onclick="enableKeyAction(this,<?= $a['id'] ?>);">
                                                                                <i class="ti-arrow-circle-right text-success tx-20-f"></i>
                                                                            </a>
                                                                            <a class="mx-1" onclick="deleteKeyAction(this,<?= $a['id'] ?>);">
                                                                                <i class="fa fa-trash tx-20-f text-danger text-secondary"></i>
                                                                            </a>
                                                                        </span>
                                                                    <?php } ?>
                                                                    <ul class="product-value tree" style="clear:both;border-bottom: 1px solid gray;">
                                                                        <li class="title-product-value d-none m-1">
                                                                            <span class="title">
                                                                                <?= (!empty($b['title'])?$b['title']:'') ?>
                                                                            </span>
                                                                            <span class="f-left">
                                                                                <?php if(!empty($role) && is_string($role) && $role=='manager'){ ?>
                                                                                    <a class="show" onclick="ShowChangeValue(this);">
                                                                                        <i class="typcn typcn-edit tx-20-f text-primary"></i>
                                                                                    </a>
                                                                                    <a class="d-none accesp" onclick="editValueAction(this,<?= $b['id'] ?>);">
                                                                                        <i class="far fa-check-circle text-success tx-20-f"></i>
                                                                                    </a>
                                                                                    <span class="d-none edit-box-key-value edit-box-key-value-<?= intval($b['id']) ?>">
                                                                                        <input type="text" class="edit-box-value w-50 d-inline-block form-control" value="<?= (!empty($b['title'])?$b['title']:'') ?>">
                                                                                    </span>
                                                                                <?php } ?>
                                                                            </span>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                        <?php }
                                                        }
                                                    } ?>
                                                </ul>
                							</div>
                						</div>
                					<?php }else{ ?>
                					    <div class="alert alert-danger p-3 rounded-10 text-center">
                					        این محصول ویژگی ندارد
                					    </div>
                					<?php } ?>
            					</div>
            				</div>
            			</div>
            		</div>		    
    			</div>
    			<div class="modal-body add-key-values p-7 d-none" style="height: 400px;overflow: auto;">
    	            <div class="row">
    			        <div class="col-12">
                            <div class="add-product-key-value">
                                <div class='row text-center'>
                                    <div class='col-5'>
                                        <label>صفت مورد نظر</label>
                                        <input type="text" class="add-box-key form-control" placeholder="مثلآ رنگ">
                                    </div>
                                    <div class='col-6'>
                                        <label>مقدار صفت</label>
                                        <input type="text" class="add-box-value form-control" placeholder="مثلآ مشکی">
                                    </div>
                                    <div class='col-1 p-0'>
                                        <label style="margin-top: 45px;"></label>
                                        <a onclick="addKeyValueAction(this,<?= intval($p_id) ?>);">
                                            <i class="far fa-check-circle text-success tx-20-f"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
            			</div>
            		</div>
    		    </div>
            </div>
        </div>
    </div>
    <?php if(!empty($role) && is_string($role) && $role=='manager'){ ?>
        <script>
            function addKeyValueAction(el,id){
                if($(el).parent().parent().find('.add-box-key').val() !==''&&$(el).parent().parent().find('.add-box-value').val()!==''){
                    $(el).parent().parent().find('.add-box-key').removeClass('border-danger');
                    $(el).parent().parent().find('.add-box-value').removeClass('border-danger');
                    sendAjax({pId:id,key:$(el).parent().parent().find('.add-box-key').val(),value:$(el).parent().parent().find('.add-box-value').val()},baseUrl('company/product/product/add_key_value'),'');
                }else{
                    if($(el).parent().parent().find('.add-box-key').val() !==''){
                        $(el).parent().parent().find('.add-box-key').removeClass('border-danger');
                    }else{
                        $(el).parent().parent().find('.add-box-key').addClass('border-danger');
                    }
                    if($(el).parent().parent().find('.add-box-value').val()!==''){
                        $(el).parent().parent().find('.add-box-value').removeClass('border-danger');
                    }else{
                        $(el).parent().parent().find('.add-box-value').addClass('border-danger');
                    }
                    return not1();
                }
            }
            function showAddKey(el){
                $(el).addClass('d-none');
                $(el).parent().children('.hideAddKey').removeClass('d-none');
                $(el).parent().parent().children('.key-values').addClass('d-none');
                $(el).parent().parent().children('.add-key-values').removeClass('d-none');
            }
            function hideAddKey(el){
                $(el).addClass('d-none');
                $(el).parent().children('.showAddKey').removeClass('d-none');
                $(el).parent().parent().children('.add-key-values').addClass('d-none');
                $(el).parent().parent().children('.key-values').removeClass('d-none');
            }
            function ShowChangeKey(el){
                $(el).addClass('d-none');
                $(el).parent().find('.accesp').removeClass('d-none');
                $(el).parent().parent().find('.title-product-key').addClass('d-none');
                $(el).parent().parent().find('.edit-product-key').removeClass('d-none');
            }
            function editKeyAction(el,id){
                if($(el).parent().parent().find('.edit-box-key').val()!==''){
                    $(el).parent().parent().find('.edit-box-key').removeClass('border-danger');
                    $(el).addClass('d-none');
                    $(el).parent().find('.show').removeClass('d-none');
                    $(el).parent().parent().find('.title-product-key').text($(el).parent().parent().find('.edit-box-key').val());
                    $(el).parent().parent().find('.title-product-key').removeClass('d-none');
                    $(el).parent().parent().find('.edit-product-key').addClass('d-none');
                    sendAjax({id:id,t:$(el).parent().parent().find('.edit-box-key').val()},baseUrl('company/product/product/edit_key'),'');
                }else{
                    $(el).parent().parent().find('.edit-box-key').addClass('border-danger');
                    return not1();
                }
            }
            function disableKeyAction(el,id){
                $(el).addClass('d-none');
                $(el).parent().find('.enable').removeClass('d-none');
                sendAjax({id:id},baseUrl('company/product/product/disable_key'),'');
            }
            function enableKeyAction(el,id){
                $(el).addClass('d-none');
                $(el).parent().find('.disable').removeClass('d-none');
                sendAjax({id:id},baseUrl('company/product/product/enable_key'),'');
            }
            function deleteKeyAction(el,id){
                $(el).parent().parent().remove();
                sendAjax({id:id},baseUrl('company/product/product/delete_key'),'');
            }
            function ShowChangeValue(el){
                $(el).addClass('d-none');
                $(el).parent().find('.accesp').removeClass('d-none');
                $(el).parent().parent().find('.title').addClass('d-none');
                $(el).parent().find('.edit-box-key-value').removeClass('d-none');
            }
            function editValueAction(el,id){
                if($(el).parent().find('.edit-box-value').val()!==''){
                    $(el).parent().find('.edit-box-value').removeClass('border-danger');
                    $(el).addClass('d-none');
                    $(el).parent().find('.show').removeClass('d-none');
                    $(el).parent().parent().find('.title').text($(el).parent().find('.edit-box-value').val());
                    $(el).parent().parent().find('.title').removeClass('d-none');
                    $(el).parent().find('.edit-box-key-value').addClass('d-none');
                    sendAjax({id:id,t:$(el).parent().find('.edit-box-value').val()},baseUrl('company/product/product/edit_value'),'');
                }else{
                    $(el).parent().find('.edit-box-value').addClass('border-danger');
                    return not1();
                }
            }
        </script>
<?php } 
} ?>