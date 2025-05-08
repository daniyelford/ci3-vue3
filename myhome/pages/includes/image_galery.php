<?php if(!empty($p_id) && intval($p_id)>0 && ((!empty($data) && is_array($data))||!(!empty($data) && is_array($data)) && !empty($role) && $role=='manager')){ ?>
    <div class="modal d-block gallerymodel">
    	<div class="modal-dialog modal-dialog-right" role="document">
    		<div class="modal-content chat border-0">
    			<div class="card overflow-hidden mb-0 border-0">
    			    <div class="action-header clearfix bg-light">
    			        <?php if(!empty($role) && $role=='manager' && !empty($uploader)){ ?>
        					<a class="f-left s" onclick="showUploadProductImg(this);">
            				    <img class="wd-30-f" src="<?= base_url('assets/svg/icon/add.svg') ?>">
            				</a>
            				<a class="f-left h d-none" onclick="hideUploadProductImg(this);">
            				    <i class="far fa-arrow-alt-circle-left tx-30-f text-danger"></i>
            				</a>
        				<?php } ?>
    					<a class="f-right" onclick="hideImage();">
        				    <img class="wd-30-f" src="<?= base_url('assets/svg/back.svg') ?>">
        				</a>
                    </div>
                    <?php if(!empty($uploader)){ ?>
    				    <div class="card-body msg_card_body upload d-none">
    				        <h3 class="text-center">
    				            افزودن عکس به گالری
    				        </h3>
					        <?= $uploader ?>
					        <br>
    					    <a onclick="addPicGallery(this);" class="btn btn-success-gradient btn-block rounded-10">
    					        ذخیره
    					    </a>
    				    </div>
					<?php } ?>
    				<div class="card-body msg_card_body pic-gallery">
					    <?php if(!empty($data) && is_array($data)){ ?>
    					    <div class="demo-gallery">
    	                		<ul class="list-unstyled row row-sm pr-0 lightgallery">
                                    <?php foreach($data as $a){ 
                                        if(!empty($a) && !empty($a['address']) && is_string($a['address'])){ ?>
                                            <li class="col-sm-6 col-lg-4" 
                                            data-responsive="<?= base_url('assets/pic/'.(!empty($type) && $type=='position'?'position':'product').'/'. $a['address']) ?>" 
                                            data-src="<?= base_url('assets/pic/'.(!empty($type) && $type=='position'?'position':'product').'/'. $a['address']) ?>" 
                                            data-sub-html="">
                                                <a class="text-center">
                                				    <img class="img-responsive" 
                        							src="<?= base_url('assets/pic/'.(!empty($type) && $type=='position'?'position':'product').'/'.$a['address']) ?>" 
                        							alt="picture">
                        							<?php if(!empty($role) && $role=='manager'){ ?>
                        						        <i onclick="deletePicAction(this,<?= $a['id'] ?>);" class="fa fa-trash tx-30-f text-danger" style="position: relative;bottom: 50%;left:5px;"></i>
                                                    <?php }else{ ?>
                                                        <i onclick="openFullscreen(this);" class="s far fa-eye tx-30-f text-white" style="position: relative;bottom: 50%;"></i>
                                                        <i onclick="closeFullscreen(this);" class="h far fa-eye-slash tx-30-f text-danger d-none" style="position: absolute;top: 50%;right: 49%;"></i>
                                                    <?php } ?>
                        						</a>
                        					</li>
                                    <?php } 
                                    } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="empty-pic-alert-error <?= (!(!empty($data) && is_array($data)) && !empty($role) && $role=='manager'?'':'d-none') ?> alert alert-danger rounded-10 text-center p-3">
                            شما عکسی در این گالری ندارید یکی اضافه کنید
                        </div>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>
    <script>
        function openFullscreen(el) {
            $(el).addClass('d-none');
            $(el).parent().find('.h').removeClass('d-none');
            let elem=$(el).parent().get(0);
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        }
        function closeFullscreen(el) {
            $(el).addClass('d-none');
            $(el).parent().find('.s').removeClass('d-none');
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    </script>
    <?php if(!empty($role) && $role=='manager'){ ?>
        <script>
            function hideUploadProductImg(el){
                $(el).addClass('d-none');
                $(el).parent().find('.s').removeClass('d-none');
                $(el).parent().parent().find('.upload').addClass('d-none'); 
                $(el).parent().parent().find('.pic-gallery').removeClass('d-none');
                return true;
            }
            function showUploadProductImg(el){
                $(el).addClass('d-none');
                $(el).parent().find('.h').removeClass('d-none');
                $(el).parent().parent().find('.upload').removeClass('d-none'); 
                $(el).parent().parent().find('.pic-gallery').addClass('d-none');
                return true;
            }
            function addPicGallery(el){
                if($(el).parent().find('.file-name').val()!==''){
                    sendAjax({pId:<?= intval($p_id) ?>,i:$(el).parent().find('.file-name').val()},baseUrl('company/<?= (!empty($type) && $type=='position'?'position':'product').'/'.(!empty($type) && $type=='position'?'position':'product') ?>/add_image'),'');
                    return true;
                }else{
                    $(el).parent().find('.imageuploadform').children('div').find('a').addClass('border-danger');
                    $(el).parent().find('.imageuploadform').children('div').find('a').removeClass('border-none');
                    return not1();
                }
            }
            function deletePicAction(el,id){
                if($(el).parent().parent().parent().children().length==1){
                    $(el).parent().parent().parent().parent().parent().find('.empty-pic-alert-error').removeClass('d-none');
                }
                $(el).parent().parent().remove();
                sendAjax({id:id},baseUrl('company/<?= (!empty($type) && $type=='position'?'position':'product').'/'.(!empty($type) && $type=='position'?'position':'product') ?>/remove_image'),'');
            }
        </script>
<?php }
} ?>