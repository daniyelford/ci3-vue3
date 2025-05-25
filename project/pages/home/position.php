<div class="row row-sm mt-3">
    <div class="col-lg-4">
        <div class="card mg-b-20">
    	    <div class="card-body text-center">
    		    <div class="pl-0">
    			    <div class="main-profile-overview">
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
    	    <div class="card-body" style="max-height: 400px;overflow: auto;">
    		    <?php if(!empty($data)){ ?> 
    		        <h3 class="text-center">جایگاه ها</h3>
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
                		    <?php foreach($data as $a){
                		        if(!empty($a) && !empty($a['id']) && intval($a['id'])>0){ ?>
                    		        <tr style="border-bottom: 1px solid grey;height: 60px;">
    		                            <td><img class="rounded-20 ht-50" src="<?= base_url('assets/svg/position/'.(!empty($a['icon'])?$a['icon']:'position.svg')) ?>"></td>
    		                            <td style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;max-width: 90px;" title="<?= (!empty($a["title"])?$a["title"]:'') ?>"><?= (!empty($a["title"])?$a["title"]:'') ?></td>
    		                            <td style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;max-width: 120px;" title="<?= (!empty($a["description"])?$a["description"]:'') ?>"><?= (!empty($a["description"])?$a["description"]:'') ?></td>
    		                            <td><?= (!empty($a["price"]) && intval($a["price"])>0?number_format($a["price"]).'تومان':'رایگان') ?></td>
    		                            <td>
    		                                <a class="disable <?= (!empty($a['status'])&&intval($a['status'])>0?'':'d-none') ?>" onclick="diablePosition(this,<?= intval($a['id']) ?>);">
                                                <i class="fas fa-ban tx-20-f text-danger"></i>
                                            </a>
                                            <a class="enable <?= (!empty($a['status'])&&intval($a['status'])>0?'d-none':'') ?>" onclick="enablePosition(this,<?= intval($a['id']) ?>);">
                                                <i class="far fa-check-circle tx-20-f text-success"></i>
                                            </a>
                                            <a class="disableManager <?= (empty($a['deleted_at'])?'':'d-none') ?>" onclick="diablePositionManager(this,<?= intval($a['id']) ?>);">
                                                <i class="fas fa-trash tx-20-f text-danger"></i>
                                            </a>
                                            <a class="enableManager <?= (empty($a['deleted_at'])?'d-none':'') ?>" onclick="enablePositionManager(this,<?= intval($a['id']) ?>);">
                                                <i class="fa fa-undo tx-20-f text-success"></i>
                                            </a>
    		                            </td>
    		                        </tr>
    		                    <?php }
                            } ?>
    		            </tbody>
    		        </table>
                <?php }else{ ?>
                    <div class="alert alert-danger p-3 rounded-10 text-center">
                        هیچ جایگاهی وجود ندارد
                    </div>
                <?php } ?>
    	    </div>
        </div>
    </div>
</div>
<script>
    function diablePosition(el,id){
        $(el).addClass('d-none');
        $(el).parent().find('.enable').removeClass('d-none');
        sendAjax({id:id},baseUrl('company/position/position/disable'),'');
        return true; 
    }
    function enablePosition(el,id){
        $(el).addClass('d-none');
        $(el).parent().find('.disable').removeClass('d-none');
        sendAjax({id:id},baseUrl('company/position/position/enable'),'');
        return true;
    }
    function diablePositionManager(el,id){
        $(el).addClass('d-none');
        $(el).parent().find('.enableManager').removeClass('d-none');
        sendAjax({id:id},baseUrl('company/position/position/disable_manager'),'');
        return true; 
    }
    function enablePositionManager(el,id){
        $(el).addClass('d-none');
        $(el).parent().find('.disableManager').removeClass('d-none');
        sendAjax({id:id},baseUrl('company/position/position/enable_manager'),'');
        return true;
    }
</script>