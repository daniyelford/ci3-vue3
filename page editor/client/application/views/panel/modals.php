<?php
$chat_info='';
$chat_received='سلام کانر پیج هستم من خوبم شما چطور؟';
$chat_send='سلام کانر پیج هستم من خوبم شما چطور؟';
$time_received='1 sep 1998';
$time_send='1 sep 1998';
?>
<!-- Message Modal -->
<div class="modal fade" id="chatmodel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-right chatbox" role="document">
		<div class="modal-content chat border-0">
			<div class="card overflow-hidden mb-0 border-0">
				<!-- action-header -->
				<div class="action-header clearfix">
					<div class="float-right hidden-xs d-flex ml-2">
						<div class="img_cont ml-3">
							<img src="<?= base_url() ?>assets/img/faces/<?= $photo_chat ?>"
								 class="rounded-circle user_img"
								 alt="photo-sender-chat">
						</div>
						<div class="align-items-center mt-2">
							<h4 class="text-white mb-0 font-weight-semibold"><?= $sender_name ?></h4>
							<span class="dot-label bg-success"></span><span
									class="mr-3 text-white"><?= $is_online ?></span>
						</div>
					</div>
					<ul class="ah-actions actions align-items-center">
						<li class="call-icon">
							<a href="#" class="d-done d-md-block phone-button" data-toggle="modal"
							   data-target="#audiomodal">
								<i class="si si-phone"></i>
							</a>
						</li>
						<li class="video-icon">
							<a href="#" class="d-done d-md-block phone-button" data-toggle="modal"
							   data-target="#videomodal">
								<i class="si si-camrecorder"></i>
							</a>
						</li>
						<li class="dropdown">
							<a href="#" data-toggle="dropdown" aria-expanded="true">
								<i class="si si-options-vertical"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><i class="fa fa-user-circle"></i> مشاهده نمایه</li>
								<li><i class="fa fa-users"></i>دوستان اضافه کنید</li>
								<li><i class="fa fa-plus"></i> افزودن به گروه</li>
								<li><i class="fa fa-ban"></i> مسدود کردن</li>
							</ul>
						</li>
						<li>
							<a href="#" class="" data-dismiss="modal" aria-label="بستن">
								<span aria-hidden="true"><i class="si si-close text-white"></i></span>
							</a>
						</li>
					</ul>
				</div>
				<!-- action-header end -->

				<!-- msg_card_body -->
				<div class="card-body msg_card_body">
					<div class="chat-box-single-line">
						<abbr class="timestamp">
						    <?= jdate('Y-m-d h:i a',time());?>
						</abbr>
					</div>
					<?php //if(){?>
					<div class="d-flex justify-content-start">
						<div class="img_cont_msg">
							<img src="<?= base_url()?>assets/img/faces/<?= $photo_chat?>" class="rounded-circle user_img_msg" alt="photo-chat-sender">
						</div>
						<div class="msg_cotainer">
						<?= $chat_received?>
							<span class="msg_time"><?= $time_received?></span>
						</div>
					</div>
					<?php //}else{?>
					<div class="d-flex justify-content-end ">
						<div class="msg_cotainer_send">
						<?= $chat_send?>
							<span class="msg_time_send"><?= $time_send?></span>
						</div>
						<div class="img_cont_msg">
							<img src="<?= base_url()?>assets/img/faces/<?= $photo?>" class="rounded-circle user_img_msg" alt="photo-chat-received">
						</div>
					</div>
					<?php //}?>
				</div>
				<!-- msg_card_body end -->
				<!-- card-footer -->
				<div class="card-footer">
					<div class="msb-reply d-flex">
						<div class="input-group">
							<input type="text" class="form-control " placeholder="تایپ کردن....">
							<div class="input-group-append ">
								<button type="button" class="btn btn-primary ">
									<i class="far fa-paper-plane" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</div>
				</div><!-- card-footer end -->
			</div>
		</div>
	</div>
</div>
