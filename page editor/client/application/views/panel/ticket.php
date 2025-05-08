            <style>
                .main-img-user::after {
                    display: none !important;
                }
            </style>
            <div class="container-fluid my-5">
            <div class="row row-sm main-content-app">
				<div class="col-xl-10 col-lg-10 my-5 mx-auto">
					<div class="card">
						<?php if(!empty($users)){?>
						<div class="main-content-left main-content-left-chat">
							<div class="main-chat-contacts-wrapper">
								<label class="main-content-label main-content-label-sm">مخاطبین </label>
								<div class="main-chat-contacts" id="chatActiveContacts">
								    <?php foreach($users as $user){if($user['id'] != $_SESSION['id']){?>
									<div class="mx-2" style="width: 85px;text-align: center;">
									    <a href="<?= base_url()?>ticket/send/<?= $user['id'] ?>">
										<div class="main-img-user"><img alt="user picture"src="<?= base_url()?>assets/img/faces/<?= (!empty($user['pic'])?$user['pic']:'1.png') ?>"></div>
										<?php if(!empty($user['name']) && !empty($user['family'])){?>
										<div class='pd-x-10'><?= $user['name'].' '.$user['family']  ?></div>
										<?php }elseif(!empty($user['name']) && empty($user['family'])){?>
										<div class='pd-x-10'><?= $user['name']  ?></div>
										<?php }elseif(empty($user['name']) && !empty($user['family'])){?>
										<div class='pd-x-10'><?= $user['family']  ?></div>
										<?php }else{?>
										<div class='pd-x-10'>کاربر بی هویت</div>
										<?php }?>
										</a>
									</div>
									<?php }}?>
								</div><!-- main-active-contacts -->
							</div><!-- main-chat-active-contacts -->
								<?php }else{?>
						    <div class='alert  rounded-10 text-center pd-x-25'><p>کاربری برای سایت شما موجود نیست </p> 
						    <a class='btn btn-info box-shadow-pink rounded-10 text-center pd-x-25' href="<?base_url()?>ticket/send_server"> ارسال پیام به سرور</a>
						    </div>
						<?php }?>
							<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && !empty($sites)){?>
							<div class="main-chat-contacts-wrapper">
								<label class="main-content-label main-content-label-sm">سایت ها</label>
								<div class="main-chat-contacts" id="chatActiveContacts">
								    <?php foreach($sites as $site){?>
									<div class="mx-2" style="width: 85px;text-align: center;">
									    <a href="<?= base_url()?>ticket/send_server/<?= $site['id'] ?>">
										<div class="main-img-user"><img alt="user picture" src="<?= base_url() ?>assets/img/faces/1.png"></div>
										<div class='pd-x-10'><?= $site['name']  ?></div>
										</a>
									</div>
									<?php }?>
								</div><!-- main-active-contacts -->
							</div>
							<?php }?>
							<?php if(!empty($tickets)){?>
							<div class="main-chat-list" id="ChatList">
							    <?php foreach($tickets as $ticket){?> 
								<div class="media new">
									<div class="main-img-user online">
										<img alt="user picture" src="<?= base_url()?>assets/img/faces/<?= $ticket['sender_pic'] ?>">
										<span style="color: #5353ef;font-size: 9px;font-weight: bold;margin-top: -8px;"><?= $ticket['role']?></span>
									</div>
									<div class="media-body">
										<div class="media-contact-name">
											<span><?= $ticket['ticket_title']?></span>
											<span><?= $ticket['ticket_date'] ?></span>
										</div>
										<p><?= $ticket['ticket_content'] ?></p>
									</div>
								</div>
							    <?php }?>
							</div>
							<?php }else{?>
							    <div class='my-2 alert alert-info box-shadow-pink rounded-10 text-center pd-x-25'>هیچ پیامی برای شما وجود ندارد</div>
							<?php }?>
							<!-- main-chat-list -->
						
						</div>
					
					</div>
				</div>
            </div>
            </div>