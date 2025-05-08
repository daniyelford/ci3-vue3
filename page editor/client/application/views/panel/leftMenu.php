<div class="sidebar sidebar-left sidebar-animate">
	<div class="panel panel-primary card mb-0 box-shadow">
		<div class="tab-menu-heading border-0 p-3">
			<div class="card-title mb-0">اطلاعیه</div>
			<div class="card-options mr-auto">
				<a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
			</div>
		</div>
		<div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
			<div class="tabs-menu ">
				<!-- Tabs -->
				<ul class="nav panel-tabs">
					<li class="">
						<a href="#side3" data-toggle="tab">
							<i class="ion ion-md-chatboxes tx-18 ml-2"></i>تیکت ها</a>
					</li>
					<li><a href="#side1" class="active" data-toggle="tab"><i
									class="ion ion-md-notifications tx-18  ml-2"></i>اخبار</a>
					</li>
					<li><a href="#side2" data-toggle="tab"><i class="ion ion-md-contacts tx-18 ml-2"></i>کاربران</a>
					</li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="tab-pane active " id="side1">
					<?php //for(){ ?>
					<div class="list d-flex align-items-center border-bottom p-3">
						<div class="">
							<span class="avatar bg-primary brround avatar-md"><?= $titleNews ?></span>
						</div>
						<a class="wrapper w-100 mr-3" href="#">
							<p class="mb-0 d-flex ">
								<b><?= $contentNews ?></b>
							</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center">
									<i class="mdi mdi-clock text-muted ml-1"></i>
									<small class="text-muted ml-auto"><?= $timeNews ?></small>
									<p class="mb-0"></p>
								</div>
							</div>
						</a>
					</div>
					<?php //} ?>
				</div>
				<div class="tab-pane  " id="side2">
					<div class="list-group list-group-flush ">
						<?php //for(){ ?>
						<div class="list-group-item d-flex  align-items-center">
							<div class="ml-3">
                                <span class="avatar avatar-lg brround cover-image"
									  data-image-src="<?= base_url() ?>assets/img/faces/<?= $userPicTicket ?>"><span
											class="avatar-status bg-success"></span></span>
							</div>
							<div>
								<strong><?= $usernameTicket ?></strong><?= $contentTicket ?>
								<div class="small text-muted">
									<?= $timeTicket ?>
								</div>
							</div>
						</div>
						<?php //} ?>
					</div>
				</div>
				<div class="tab-pane  " id="side3">
					<div class="list-group list-group-flush ">
						<?php //for(){ ?>
						<div class="list-group-item d-flex  align-items-center">
							<div class="ml-2">
                                <span class="avatar avatar-md brround cover-image"
									  data-image-src="<?= base_url() ?>assets/img/faces/<?= $userPic ?>"><span
											class="avatar-status bg-success"></span></span>
							</div>
							<div class="">
								<div class="font-weight-semibold" data-toggle="modal"
									 data-target="#chatmodel"><?= $username ?>
								</div>
							</div>
							<div class="mr-auto">
								<?= $ruleUser ?>
								<a href="<?= base_url() ?><?= $ticketAddress ?>/123.<?= $ticketId ?>.123123"
								   class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i
											class="fab fa-facebook-messenger"></i></a>
							</div>
						</div>
						<?php //} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
