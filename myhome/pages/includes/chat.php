<?php if((!empty($data) || (!empty($chat_box) && $chat_box)) && !empty($p_id) && intval($p_id) > 0){ ?>
    <div class="modal d-block chatmodel">
    	<div class="modal-dialog modal-dialog-right chatbox" role="document">
    		<div class="modal-content chat border-0">
    			<div class="card overflow-hidden mb-0 border-0">
    				<div class="action-header clearfix bg-light">
    					<a class="f-left" onclick="hideChat();">
        				    <img class="wd-30-f" src="<?= base_url('assets/svg/back.svg') ?>">
        				</a>
    					<div class="float-right hidden-xs d-flex ml-2" title="<?= (!empty($info["description"])?$info["description"]:'') ?>">
    						<div class="img_cont ml-3">
    							<img src="<?= base_url('assets/svg/'.(!empty($type) && $type=='product'?'product':'position').'/'.
    							(!empty($info["icon"])?$info["icon"]:(!empty($type) && $type=='product'?'product':'position').'.svg')) ?>" class="rounded-circle user_img" alt="img">
    						    <?php if(!empty($type) && $type=='position') { ?>
        							<span class="<?= (!empty($info['status']) && intval($info['status'])>0?'pulse':'pulse-danger') ?>"></span>
    							<?php } ?>
    						</div>
    						<div class="align-items-center mt-2">
    							<h4 class="text-white mb-0 font-weight-semibold">
    							    <?= (!empty($info["title"])?$info["title"]:(!empty($info["key"])?$info["key"]:'')) ?>
    							</h4>
    							<!--
    							<span class="mr-3 text-white">
    							    <?= (!empty($info["price"])?$info["price"]:'') ?>    
    							</span>
    							-->
    						</div>
    					</div>
					</div>
					<div class="card-body msg_card_body">
					    <?= (!empty($data)?$data:'') ?>
                    </div>
					<div class="card-footer">
						<span class="chat-replay"></span>
						<div class="msb-reply d-flex">
							<div class="input-group">
								<input type="text" onkeypress="enterInputChat(this,event);" class="form-control chat-box-text" placeholder="تایپ کردن....">
								<div class="input-group-append ">
								    <input type="hidden" value="<?= intval($p_id); ?>" class="pId">
								    <input type="hidden" class="parentId">
                                    <input type="hidden" value="<?= (!empty($user_id) && intval($user_id)>0?intval($user_id):'') ?>" class="userId">
                                    <input type="hidden" value="<?= (!empty($type) && $type=='product'?'product':'position') ?>" class="type">
									<button type="button" class="btn btn-primary"
									onclick="<?= (!empty($chat_box) && $chat_box?"sendChat(this);":'loginError(this);') ?>">
										<i class="far fa-paper-plane" aria-hidden="true"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
    </div>
    <script>
        function enterInputChat(el,e) {
            if(e.which == 13) {
                $(el).parent().find('button').click();
            }
        }
    </script>
<?php } ?>