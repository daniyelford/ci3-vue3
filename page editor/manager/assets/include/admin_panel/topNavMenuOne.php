<?php
$data = array("class" => "navbar-form", "method" => "post", "role" => "search");
$formOpen = form_open();
$formOpen1 = form_open(array(),$data);
$formSearch = form_input(array('type' => 'search', 'name' => 'search', 'class' => 'form-control', 'placeholder' => 'هر چیزی را جستجو کنید ...'));
$formSearch1 = form_input(array('type' => 'search', 'name' => 'search1', 'class' => 'form-control', 'placeholder' => 'هر چیزی را جستجو کنید ...'));
$btnSearch = form_button(array("content" => "<i class='fas fa-search d-none d-md-block'></i>", "name" => "btnSearch", "value" => "btnSearch", "type" => "submit", "class" => "btn"));
$btnReset = form_button(array("content" => "<i class='fas fa-times'></i>", "name" => "btnReset", "value" => "btnReset", "type" => "reset", "class" => "btn btn-default"));
$btnSearch1 = form_button(array("content" => "<svg xmlns='http://www.w3.org/2000/svg' class='header-icon-svgs' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
												 <circle cx='11' cy='11' r='8'></circle>
												 <line x1='21' y1='21' x2='16.65' y2='16.65'></line>
												 </svg>", "name" => "btnSearch1", "value" => "btnSearch1", "type" => "submit", "class" => "btn btn-default nav-link resp-btn"));
$formClose = form_close();
//another var
$rule_users = 'admin';
$username = 'danial';
$profilePicture = '20.jpg';
$exit = 'exitSite.php';
$answerPicProfile = '3.jpg';
$numberMassageUnread = '4';
$usernameMassageSender = 'ali';
$contentOfMassage = 'hi man';
$timeMassageSend = 'friday';
$allMassageLink = '#';
$numberNewsUnread = '4';
$titleNews = 'news';
$timeNews = 'friday';

//$levelNews = 'pink';
//$levelNews = 'danger';
//$levelNews = 'warning';
//$levelNews = 'primary';
$levelNews = 'success';

$allNewsLink = '#';
$countryPic = 'french_flag.jpg';
$countryName = 'iran';
$userManager = '#';
$editProfile = '#';
?>
<div class="main-content app-content">
	<div class="main-header sticky side-header nav nav-item">
		<div class="container-fluid">
			<div class="main-header-left ">
				<div class="responsive-logo">
					<a href="#"><img src="<?= base_url() ?>assets/img/brand/logo.png" class="logo-1" alt="لوگو"></a>
					<a href="#"><img src="<?= base_url() ?>assets/img/brand/logo-white.png" class="dark-logo-1"
									 alt="لوگو"></a>
					<a href="#"><img src="<?= base_url() ?>assets/img/brand/favicon.png" class="logo-2" alt="لوگو"></a>
					<a href="#"><img src="<?= base_url() ?>assets/img/brand/favicon.png" class="dark-logo-2" alt="لوگو"></a>
				</div>
				<div class="app-sidebar__toggle" data-toggle="sidebar">
					<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
					<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
				</div>
				<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
					<?= $formOpen ?>
					<?= $formSearch ?>
					<?= $btnSearch ?>
					<?= $formClose ?>
				</div>
			</div>
			<div class="main-header-right">
				<ul class="nav">
					<li class="">
						<div class="dropdown  nav-itemd-none d-md-flex">
							<a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
							   aria-expanded="false">
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
											src="<?= base_url() ?>assets/img/flags/<?= $countryPic ?>" alt="img"></span>
								<div class="my-auto">
									<strong class="mr-2 ml-2 my-auto"><?= $countryName ?></strong>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
								<a href="#" class="dropdown-item d-flex ">
                                    <span class="avatar  ml-3 align-self-center bg-transparent"><img
												src="<?= base_url() ?>assets/img/flags/<?= $countryPic ?>"
												alt="img"></span>
									<div class="d-flex">
										<span class="mt-2"><?= $countryName ?></span>
									</div>
								</a>
							</div>
						</div>
					</li>
				</ul>
				<div class="nav nav-item  navbar-nav-right ml-auto">
					<div class="nav-link" id="bs-example-navbar-collapse-1">
						<?= $formOpen1 ?>
						<div class="input-group">
							<?= $formSearch1 ?>
							<span class="input-group-btn">
										<?= $btnReset ?>
										<?= $btnSearch1 ?>
								</span>
						</div>
						<?= $formClose ?>
					</div>
					<div class="dropdown nav-item main-header-message ">
						<a class="new nav-link" href="#">
							<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
								 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								 stroke-linejoin="round">
								<path
										d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
								<polyline points="22,6 12,13 2,6"></polyline>
							</svg>
							<?php if ($numberMassageUnread >= 1) { ?>
								<span class=" pulse-danger"></span>
							<?php } ?>
						</a>
						<div class="dropdown-menu">
							<div class="menu-header-content bg-primary text-right">
								<div class="d-flex">
									<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">پیام ها</h6>
									<span class="badge badge-pill badge-warning mr-auto my-auto float-left">علامت گذاری همه</span>
								</div>
								<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
									شما <?= $numberMassageUnread ?> پیام
									خوانده نشده دارید</p>
							</div>
							<div class="main-message-list chat-scroll">
								<?php //foreach(){ ?>
								<a href="#" class="p-3 d-flex border-bottom">
									<div class="  drop-img  cover-image  "
										 data-image-src="<?= base_url() ?>assets/img/faces/<?= $answerPicProfile ?>">
										<span class="avatar-status bg-teal"></span>
									</div>
									<div class="wd-90p">
										<div class="d-flex">
											<h5 class="mb-1 name"><?= $usernameMassageSender ?></h5>
										</div>
										<p class="mb-0 desc"><?= $contentOfMassage ?></p>
										<p class="time mb-0 text-left float-right mr-2 mt-2"><?= $timeMassageSend ?></p>
									</div>
								</a>
								<?php //}?>
							</div>
							<div class="text-center dropdown-footer">
								<a href="<?= $allMassageLink ?>">مشاهده همه</a>
							</div>
						</div>
					</div>
					<div class="dropdown nav-item main-header-notification">
						<a class="new nav-link" href="#">
							<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
								 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								 stroke-linejoin="round">
								<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
								<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
							</svg>
							<?php if ($numberNewsUnread >= 1) { ?>
								<span class=" pulse"></span>
							<?php } ?>
						</a>
						<div class="dropdown-menu">
							<div class="menu-header-content bg-primary text-right">
								<div class="d-flex">
									<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">اطلاعیه</h6>
									<!--									<span class="badge badge-pill badge-warning mr-auto my-auto float-left">علامت گذاری همه</span>-->
								</div>
								<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
									شما <?= $numberNewsUnread ?> اعلان
									خوانده نشده دارید</p>
							</div>
							<div class="main-notification-list Notification-scroll">
								<?php //foreach(){ ?>
								<a class="d-flex p-3 border-bottom" href="#">
									<div class="notifyimg bg-<?= $levelNews ?>">
										<i class="la la-file-alt text-white"></i>
									</div>
									<div class="mr-3">
										<h5 class="notification-label mb-1"><?= $titleNews ?></h5>
										<div class="notification-subtext"><?= $timeNews ?></div>
									</div>
								</a>
								<?php //} ?>
							</div>
							<div class="dropdown-footer">
								<a href="<?= $allNewsLink ?>">مشاهده همه</a>
							</div>
						</div>
					</div>
					<div class="nav-item full-screen fullscreen-button">
						<a class="new nav-link full-screen-link" href="#">
							<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
								 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								 stroke-linejoin="round">
								<path
										d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
							</svg>
						</a>
					</div>
					<div class="dropdown main-profile-menu nav nav-item nav-link">
						<a class="profile-user d-flex" href="#"><img alt=""
																	 src="<?= base_url() ?>assets/img/faces/<?= $profilePicture ?>"></a>
						<div class="dropdown-menu">
							<div class="main-header-profile bg-primary p-3">
								<div class="d-flex wd-100p">
									<div class="main-img-user"><img alt=""
																	src="<?= base_url() ?>assets/img/faces/<?= $profilePicture ?>"
																	class=""></div>
									<div class="mr-3 my-auto">
										<h6><?= $username ?></h6>
										<span><?= $rule_users ?></span>
									</div>
								</div>
							</div>
							<!--<a class="dropdown-item" href="#"><i class="bx bx-user-circle"></i>مشخصات </a>-->
							<a class="dropdown-item" href="<?= $allMassageLink ?>"><i class="bx bx-envelope"></i>پیام
								های کاربران</a>
							<a class="dropdown-item" href="<?= $allNewsLink ?>"><i class="bx bxs-inbox"></i>صندوق
								خبری</a>
							<a class="dropdown-item" href="<?= $userManager ?>"><i class="bx bx-slider-alt"></i> تنظیمات
								حساب های کاربران</a>
							<a class="dropdown-item" href="<?= $editProfile ?>"><i class="bx bx-cog"></i>ویرایش حساب
								کاربری من</a>
							<a class="dropdown-item" href="<?= $exit ?>"><i class="bx bx-log-out"></i> خروج از سیستم</a>
						</div>
					</div>
					<div class="dropdown main-header-message right-toggle">
						<a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
							<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
								 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								 stroke-linejoin="round">
								<line x1="3" y1="12" x2="21" y2="12"></line>
								<line x1="3" y1="6" x2="21" y2="6"></line>
								<line x1="3" y1="18" x2="21" y2="18"></line>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
