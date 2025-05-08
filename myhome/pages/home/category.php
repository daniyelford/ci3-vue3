<div class="row row-sm mt-3">
    <div class="col-lg-4">
        <div class="card mg-b-20">
    	    <div class="card-body text-center">
    		    <div class="pl-0">
    			    <div class="main-profile-overview">
    				    <a class="btn btn-primary btn-compose btn-block" onclick="showAddCategory();">
						    ایجاد دسته بندی
						</a>
    					<hr class="mg-y-10">
						<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
						<div class="row">
                            <div class="col-12 mt-1">
                                <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('wallet') ?>">
                				    <i class="bx bx-folder-open mx-1"></i>
                					کیف پول
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
    		<div class="card-body">
        		<?php if(!empty($data)){ ?>
        		    <h3 class="text-center">دسته بندی</h3>
                    <table class="w-100d text-center " id="manager-category-parent-id-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $c){
                                $category_logo_editor=(!empty($c['category_logo_editor'])?$c['category_logo_editor']:'');
                                $a=(!empty($c['info'])?$c['info']:[]);
                                if(!empty($a['id']) && intval($a['id'])>0){ ?>
                                    <tr class="tr-category-id-<?= $a['id'] ?>" style="height:60px;border-bottom: 1px solid grey;">
                                        <td>
                                            <img class="rounded-20 ht-50" src="<?= base_url('assets/svg/category/'.(!empty($a['icon'])?$a['icon']:'category.svg')) ?>">
                                        </td>
                                        <td>
                                            <?= (!empty($a['title'])?$a['title']:'') ?>
                                        </td>
                                        <td title="<?= (!empty($a['description'])?$a['description']:'') ?>" style="overflow: hidden;white-space: nowrap;max-width: 90px;text-overflow: ellipsis;">
                                            <?= (!empty($a['description'])?$a['description']:'') ?>
                                        </td>
                                        <td>
                                            <a onclick="productElementsTools(this,'edit-category',0);">
                                                <i class="fa fa-cog fa-spin tx-20-f text-warning"></i>
                                            </a>
                                            <a class="disable <?= (!empty($a['status'])&&intval($a['status'])>0?'':'d-none') ?>" onclick="diableCategory(this,<?= $a['id'] ?>);">
                                                <i class="fas fa-ban tx-20-f text-danger"></i>
                                            </a>
                                            <a class="enable <?= (!empty($a['status'])&&intval($a['status'])>0?'d-none':'') ?>" onclick="enableCategory(this,<?= $a['id'] ?>);">
                                                <i class="far fa-check-circle tx-20-f text-success"></i>
                                            </a>
                                        </td>
                                        <td class="show-div-setting">
                                            <div class="d-none edit-category">
                                                <div class="modal d-block" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">ویرایش دسته بندی</h6>
                                                                <button onclick="hideChat();" aria-label="بستن" class="close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" style="max-height: 400px;overflow: auto;">
                                                                <div class="row mb-0">
                                                                    <div class="col-md-4">
                                                                        <div class="row mt-2">
                                                                            <div class="col-12 text-center">
                                                                                عکس اصلی دسته بندی را بارگذاری کنید
                                                                            </div>
                                                                            <img class="mx-auto ht-100 rounded-10" src="<?= base_url('assets/svg/category/'.(!empty($a['icon'])?$a['icon']:'category.svg')) ?>">
                                                                            <div class="col-12 mt-2 mx-auto text-center">
                                                                                <?= (!empty($category_logo_editor)?$category_logo_editor:'') ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                    <div class="col-md-8 py-0">
                                                                        <hr>
                                                                        <div class="row mt-2">
                                                                            <div class="col-md-6">
                                                								<label>
                                                								    نام دسته
                                                    							</label>
                                                    							<input value="<?= (!empty($a['title'])?$a['title']:'') ?>" class="form-control shadow-light rounded-10 category-title" placeholder="اسم مورد نظر" type="text">
                                                    						</div>
                                                    						<div class="col-md-6">
                                                                                <?php if(!empty($category)){ ?>
                                                                                    <label for="role-chooser">
                                                                                        سردسته را مشخص کنید
                                                                                    </label>
                                                                                    <select class="product-category form-control text-center SlectBox SumoUnder shadow-light rounded-10" tabindex="-1">
                                                                                        <option value="0">اصلی</option>
                                                                                        <?php foreach($category as $b){ 
                                                                                            if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($b['title'])){ ?>
                                                                                                <option <?= (!empty($a['parent_id']) && intval($a['parent_id'])>0 && intval($b['id'])==intval($a['parent_id'])?'selected':'') ?> value="<?= $b['id'] ?>"><?= $b['title'] ?></option>
                                                                                        <?php } 
                                                                                        } ?>
                                                    					    		</select>
                                                                                <?php } ?>
                                                                            </div>
                                                                            <div class="col-12">
                                                								<label>
                                                								    توضیحات دسته
                                                    							</label>
                                                    							<textarea class="form-control shadow-light rounded-10 category-description" col="4" placeholder="توضیحات مورد نظر" type="text"><?= (!empty($a['description'])?$a['description']:'') ?></textarea>
                                                    						</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="ManagerEditCategory(this,<?= $a['id'] ?>);">
                                                                    ویرایش دسته بندی  
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } 
                            } ?>
                        </tbody>
                    </table>
                <?php }else{ ?>
                    <div class="alert alert-danger rounded-10 text-center p-3">
                        دسته بندی ندارید یکی اضافه کنید
                    </div>
                <?php } ?>
    	    </div>
        </div>
    </div>
</div>
<div class="d-none" id="add-category">
    <div class="modal d-block" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">افزودن دسته بندی</h6>
                    <button onclick="hideAddCategory();" aria-label="بستن" class="close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 400px;overflow: auto;">
                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row mt-2">
                                <div class="col-12 text-center">
                                    عکس اصلی دسته بندی را بارگذاری کنید
                                </div>
                                <div class="col-md-6 mt-2 mx-auto text-center">
                                    <?= (!empty($category_logo_uploader)?$category_logo_uploader:'') ?>
                                </div>
                            </div>
                        </div>    
                        <div class="card-body py-0">
                            <hr>
                            <div class="row mt-2">
                                <div class="col-md-6">
    								<label>
    								    نام دسته
        							</label>
        							<input class="form-control shadow-light rounded-10 category-title" placeholder="اسم مورد نظر" type="text">
        						</div>
        						<div class="col-md-6">
                                    <?php if(!empty($category)){ ?>
                                        <label for="role-chooser">
                                            سردسته را مشخص کنید
                                        </label>
                                        <select class="form-control text-center SlectBox SumoUnder shadow-light rounded-10 product-category" tabindex="-1">
                                            <option value="0">اصلی</option>
                                            <?php foreach($category as $b){ 
                                                if(!empty($b) && !empty($b['id']) && !empty($b['title'])){ ?>
                                                    <option value="<?= $b['id'] ?>"><?= $b['title'] ?></option>
                                            <?php } 
                                            } ?>
        					    		</select>
                                    <?php } ?>
                                </div>
                                <div class="col-12">
                                    <label>
                                        توضیحات دسته
                                    </label>
                                    <textarea class="form-control shadow-light rounded-10 category-description" col="4" placeholder="توضیحات مورد نظر" type="text"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="ManagerAddCategory(this);">
                        ایجاد دسته بندی  
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function enableCategory(el,id){
        $(el).addClass('d-none');
        $(el).parent().find('.disable').removeClass('d-none');
        sendAjax({id:id},baseUrl('category/category/valex_enable_category'),'');
        return true;
    }
    function diableCategory(el,id){
        $(el).addClass('d-none');
        $(el).parent().find('.enable').removeClass('d-none');
        sendAjax({id:id},baseUrl('category/category/valex_disable_category'),'');
        return true;
    }
    function showAddCategory(){
        $('#add-category').removeClass('d-none');
        return true;
    }
    function hideAddCategory(){
        $('#add-category').addClass('d-none');
        return true;
    }
    function ManagerEditCategory(el,id){
        let file=$(el).parent().parent().find('.file-name').val(),
        title=$(el).parent().parent().find('.category-title').val(),
        des=$(el).parent().parent().find('.category-description').val(),
        parentId=$(el).parent().parent().find('.product-category').val();
        if(id!=='' && title!=='')
            sendAjax({id:id,file:file,title:title,description:des,parentId:parentId},baseUrl('category/category/valex_edit_category'),'');
        else
            not1();
        return true;
    }
    function ManagerAddCategory(el){
        let file=$(el).parent().parent().find('.file-name').val(),
        title=$(el).parent().parent().find('.category-title').val(),
        des=$(el).parent().parent().find('.category-description').val(),
        parentId=$(el).parent().parent().find('.product-category').val();
        if(title!=='')
            sendAjax({file:file,title:title,description:des,parentId:parentId},baseUrl('category/category/valex_add_category'),'');
        else
            not1();
        return true;
    }
</script>
    