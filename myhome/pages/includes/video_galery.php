<?php if(!empty($p_id) && intval($p_id)>0 && (!empty($data)||(empty($data) && !empty($role) && $role=='manager'))){ ?>
    <style>
        video.video-player{
            width: 145px;
            margin-top: 5px;
            min-height: 100px;
            display: inline-block;
        }
        video.video-player.active {
            width: 100%;
        }
        .video-parent-style{
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px grey;
            height: auto;
            display: inline-block;
        }
    </style>
    <div class="modal d-block gallerymodel">
    	<div class="modal-dialog modal-dialog-right" role="document">
    		<div class="modal-content chat border-0">
    			<div class="card overflow-hidden mb-0 border-0">
    			    <div class="action-header clearfix bg-light">
    			        <?php if(!empty($role) && $role=='manager' && !empty($uploader)){ ?>
        					<a class="s f-left" onclick="showAddVideo(this);">
            				    <img class="wd-30-f" src="<?= base_url('assets/svg/icon/add.svg') ?>">
            				</a>
            				<a class="h f-left d-none" onclick="hideAddVideo(this);">
                                <i class="far fa-arrow-alt-circle-left tx-30-f text-danger"></i>
                            </a>
        				<?php } ?>
    					<a class="f-right" onclick="hideVideo();">
        				    <img class="wd-30-f" src="<?= base_url('assets/svg/back.svg') ?>">
        				</a>
                    </div>
                    <?php if(!empty($role) && $role=='manager' && !empty($uploader)){ ?>
    					<div class="card-body msg_card_body video-upload d-none">
    					    <h3 class="text-center">
    					        افزودن فیلم به گالری
    					    </h3>
    					    <?= $uploader ?>
    					    <br>
    					    <a class="btn btn-success-gradient rounded-10 btn-block" onclick="addVideoAction(this);">ذخیره</a>
    					</div>
					<?php } ?>
					<div class="card-body msg_card_body video-gallery">
					    <?php if(!empty($data)){ ?>
    					    <div class="text-wrap videoBox-<?= (!empty($type) && $type=='position'?'position':'product') ?>-<?= intval($p_id) ?>">
    							<?php foreach($data as $b){ ?>
                                    <span class="video-parent-style">
                                        <video class="video-player rounded-10 video-<?= (!empty($type) && $type=='position'?'position':'product') ?>-<?= intval($b['id']) ?>" controls>
                                            <source src="<?= base_url('assets/video/'.(!empty($type) && $type=='position'?'position':'product').'/'. $b['address']) ?>" type="video/mp4">
                                        </video>
                                        <div>
                                            <a class="btn btn-dark-gradient rounded-10 mx-1 mb-1" onclick="showVideoBigger(this);">
                                                <i class="far fa-eye tx-20-f text-white"></i>
                                            </a>
                                            <?php if(!empty($role) && $role=='manager'){ ?>
                                                <a class="btn btn-dark-gradient rounded-10 mx-1 mb-1" onclick="deleteVideoAction(this,<?= $b['id'] ?>);">
                                                    <i class="fa fa-trash tx-20-f text-danger"></i>
                                                </a>
                                            <?php } ?>
                                        </div>
    							    </span>
                                <?php } ?>
    						</div>
    						<div class="videoBox-<?= (!empty($type) && $type=='position'?'position':'product') ?>-<?= intval($p_id)?>-pagination"></div>
						<?php } ?>
					    <div class="empty-video-alert-error <?= (!(!empty($data) && is_array($data)) && !empty($role) && $role=='manager'?'':'d-none') ?> alert alert-danger rounded-10 text-center p-3">
                            شما فیلمی در این گالری ندارید یکی اضافه کنید
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
    	function showAddVideo(el){
    	    $(el).addClass('d-none');
    	    $(el).parent().find('.h').removeClass('d-none');
    	    $(el).parent().parent().find('.video-upload').removeClass('d-none');
    	    $(el).parent().parent().find('.video-gallery').addClass('d-none');
    	    return true;
    	}
    	function hideAddVideo(el){
    	    $(el).addClass('d-none');
    	    $(el).parent().find('.s').removeClass('d-none');
    	    $(el).parent().parent().find('.video-upload').addClass('d-none');
    	    $(el).parent().parent().find('.video-gallery').removeClass('d-none');
    	    return true;
    	}
    	function addVideoAction(el){
    	    if($(el).parent().find('.file-name').val()!==''){
                sendAjax({pId:<?= intval($p_id) ?>,i:$(el).parent().find('.file-name').val()},baseUrl('company/<?= (!empty($type) && $type=='position'?'position':'product').'/'.(!empty($type) && $type=='position'?'position':'product') ?>/add_video'),'');
                return true;
            }else{
                $(el).parent().find('.imageuploadform').children('div').find('a').addClass('border-danger');
                $(el).parent().find('.imageuploadform').children('div').find('a').removeClass('border-none');
                return not1();
            }
    	}
    	function deleteVideoAction(el,id){
    	    if($(el).parent().parent().parent().children().length==1){
                $(el).parent().parent().parent().parent().find('.empty-video-alert-error').removeClass('d-none');
            }
            $(el).parent().parent().remove();
    	    sendAjax({id:id},baseUrl('company/<?= (!empty($type) && $type=='position'?'position':'product').'/'.(!empty($type) && $type=='position'?'position':'product') ?>/remove_video'),'');
    	}
        // tblPagination('.videoBox-<?= (!empty($type) && $type=='position'?'position':'product') ?>-<?= intval($p_id)?>','.videoBox-<?= (!empty($type) && $type=='position'?'position':'product') ?>-<?= intval($p_id)?>-pagination');
    </script>
<?php } ?>