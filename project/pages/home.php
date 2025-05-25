<?php $date=new Jdf(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="FT Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		<!-- Title -->
		<title></title>
		<!-- Favicon -->
		<link rel="icon" href="<?= base_url('assets/img/brand/favicon.png') ?>" type="image/x-icon"/>
		<!-- Icons css -->
		<link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
		<!--  Custom Scroll bar-->
		<link href="<?= base_url('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') ?>" rel="stylesheet"/>
		<!--  Sidebar css -->
		<link href="<?= base_url('assets/plugins/sidebar/sidebar.css') ?>" rel="stylesheet">
		<!-- Sidemenu css -->
		<link rel="stylesheet" href="<?= base_url('assets/css-rtl/sidemenu.css') ?>">
		<!--  Owl-carousel css-->
		<link href="<?= base_url('assets/plugins/owl-carousel/owl.carousel.css') ?>" rel="stylesheet" />
		<!-- Maps css -->
		<!--<link href="<?= base_url('assets/plugins/jqvmap/jqvmap.min.css') ?>" rel="stylesheet">-->
		<!--- Style css -->
		<link href="<?= base_url('assets/css-rtl/style.css') ?>" rel="stylesheet">
		<!--- Dark-mode css -->
		<link href="<?= base_url('assets/css-rtl/style-dark.css') ?>" rel="stylesheet">
		<!---Skinmodes css-->
		<link href="<?= base_url('assets/css-rtl/skin-modes.css') ?>" rel="stylesheet">
		<!---Switcher css-->
		<link href="<?= base_url('assets/switcher/css/switcher-rtl.css') ?>" rel="stylesheet">
		<link href="<?= base_url('assets/switcher/demo.css') ?>" rel="stylesheet">
		<!-- notify -->
		<link href="<?= base_url('assets/plugins/notify/css/notifIt.css') ?>" rel="stylesheet">
		<!-- calender -->
		 <!--<link href="<?= base_url('assets/plugins/fullcalendar/fullcalendar.min.css') ?>" rel="stylesheet"> -->
		<?php if(!empty($chart)){ ?>
			<!--chart-->
			<script src="https://code.highcharts.com/highcharts.js"></script>
			<script src="https://code.highcharts.com/modules/series-label.js"></script>
			<script src="https://code.highcharts.com/modules/exporting.js"></script>
			<script src="https://code.highcharts.com/modules/export-data.js"></script>
			<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		<?php }if(!empty($map)){ ?>
			<!-- map  -->
			<script src="<?= base_url('assets/inc/map/maptiler.js') ?>"></script>
			<link href="<?= base_url('assets/inc/map/maptiler.css') ?>" rel="stylesheet" />
		<?php } ?>
		<script>
			const geojson={'company':{},'position':{},'product':{}};
			const chartMain=[];
			let markerNumber=0;
		</script>
		<style>
			.work-setting-tab{
				overflow-y: auto;
		    	overflow-x: hidden;
	    		max-height: 350px;
			}
			/* .ckbox{
				display: inline-block;
			} */
		</style>
	</head>
	<body class="main-body app sidebar-mini dark-theme">
	<!-- Loader -->
		<div id="global-loader">
			<img src="assets/img/loader.svg" class="loader-img" alt="لودر">
		</div>
	<!-- /Loader -->
	<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="index.html"><img src="assets/img/brand/logo.jpg" class="main-logo" alt="لوگو"></a>
				<a class="desktop-logo logo-dark active" href="index.html"><img src="assets/img/brand/logo-white.png" class="main-logo dark-theme" alt="لوگو"></a>
				<a class="logo-icon mobile-logo icon-light active" href="index.html"><img src="assets/img/brand/favicon.png" class="logo-icon" alt="لوگو"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="index.html"><img src="assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="لوگو"></a>
			</div>
			<div class="main-sidemenu">
				<!-- user info  -->
				<?php if(!empty($user_info)){ ?>
					<div class="app-sidebar__user clearfix">
						<div class="dropdown user-pro-body">
							<div class="">
								<img alt="user-img" class="avatar avatar-xl brround" src="<?= (!empty($user_info['image'])?$user_info['image']:base_url('assets/svg/user/login.svg')) ?>">
								<span class="avatar-status profile-status bg-green"></span>
							</div>
							<div class="user-info">
								<h4 class="font-weight-semibold mt-3 mb-0"><?= (!empty($user_info['name'])?$user_info['name']:'').(!empty($user_info['family'])?' '.$user_info['family']:'') ?></h4>
								<span class="mb-0 text-muted"><?= (!empty($user_info['role'])?$user_info['role']:'کاربر') ?></span>
							</div>
						</div>
					</div>
				<?php } ?>
				<!-- user info  -->
				<!-- category -->
				<?php if(!empty($category)){ ?>
					<ul class="side-menu">
						<?= $category ?>
					</ul>
				<?php } ?>
				<!-- category -->
			</div>
		</aside>
		<!-- main-sidebar -->
		<!-- main-content -->
		<div class="main-content app-content">
			<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="index.html"><img src="assets/img/brand/logo.jpg" class="logo-1" alt="لوگو"></a>
							<a href="index.html"><img src="assets/img/brand/logo-white.png" class="dark-logo-1" alt="لوگو"></a>
							<a href="index.html"><img src="assets/img/brand/favicon.png" class="logo-2" alt="لوگو"></a>
							<a href="index.html"><img src="assets/img/brand/favicon.png" class="dark-logo-2" alt="لوگو"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<!-- search desktop -->
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="هر چیزی را جستجو کنید ..." type="search"> 
							<button class="btn" onclick="emptyInput(this);"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="main-header-right">
						<!-- lang  -->
						<!-- <ul class="nav">
							<li class="">
								<div class="dropdown  nav-itemd-none d-md-flex">
									<a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
										<span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img src="assets/img/flags/us_flag.jpg" alt="img"></span>
										<div class="my-auto">
											<strong class="mr-2 ml-2 my-auto">انگلیسی</strong>
										</div>
									</a>
									<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
										<a href="#" class="dropdown-item d-flex ">
											<span class="avatar  ml-3 align-self-center bg-transparent"><img src="assets/img/flags/french_flag.jpg" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">فرانسه</span>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex">
											<span class="avatar  ml-3 align-self-center bg-transparent"><img src="assets/img/flags/germany_flag.jpg" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">آلمان</span>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex">
											<span class="avatar ml-3 align-self-center bg-transparent"><img src="assets/img/flags/italy_flag.jpg" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">ایتالیا</span>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex">
											<span class="avatar ml-3 align-self-center bg-transparent"><img src="assets/img/flags/russia_flag.jpg" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">روسیه</span>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex">
											<span class="avatar  ml-3 align-self-center bg-transparent"><img src="assets/img/flags/spain_flag.jpg" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">اسپانیا</span>
											</div>
										</a>
									</div>
								</div>
							</li>
						</ul> -->
						<!-- lang  -->
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<!-- search mobile -->
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="جستجو کردن">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>
							<!-- search mobile -->
							<!-- setting menus -->
							<?php if(!empty($id) && intval($id)>0){ ?>
								<div class="dropdown nav-item main-header-message ">
									<a class="new nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class=" pulse-danger"></span></a>
									<div class="dropdown-menu">
										<div class="menu-header-content bg-primary text-right">
											<div class="d-flex">
												<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">پیام ها</h6>
												<span class="badge badge-pill badge-warning mr-auto my-auto float-left">علامت گذاری همه</span>
											</div>
											<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">شما 4 پیام خوانده نشده دارید</p>
										</div>
										<div class="main-message-list chat-scroll" style="overflow: auto;">
											<a href="#" class="p-3 d-flex border-bottom">
												<div class="  drop-img  cover-image  " data-image-src="assets/img/faces/3.jpg">
													<span class="avatar-status bg-teal"></span>
												</div>
												<div class="wd-90p">
													<div class="d-flex">
														<h5 class="mb-1 name">پتی کروزر</h5>
													</div>
													<p class="mb-0 desc">متاسفم اما مطمئن نیستم که چگونه به شما در این زمینه کمک کنم ......</p>
													<p class="time mb-0 text-left float-right mr-2 mt-2">15 مهر 3:55 بعد از ظهر</p>
												</div>
											</a>
											<a href="#" class="p-3 d-flex border-bottom">
												<div class="drop-img cover-image" data-image-src="assets/img/faces/2.jpg">
													<span class="avatar-status bg-teal"></span>
												</div>
												<div class="wd-90p">
													<div class="d-flex">
														<h5 class="mb-1 name">جیمی چانگا</h5>
													</div>
													<p class="mb-0 desc">همه آماده! اکنون وقت آن است که اکنون به سراغ شما بروم ......</p>
													<p class="time mb-0 text-left float-right mr-2 mt-2">مهر 06 01:12 صبح</p>
												</div>
											</a>
											<a href="#" class="p-3 d-flex border-bottom">
												<div class="drop-img cover-image" data-image-src="assets/img/faces/9.jpg">
													<span class="avatar-status bg-teal"></span>
												</div>
												<div class="wd-90p">
													<div class="d-flex">
														<h5 class="mb-1 name">گراهام کراکر</h5>
													</div>
													<p class="mb-0 desc">آیا آماده تحویل کالا هستید ...</p>
													<p class="time mb-0 text-left float-right mr-2 mt-2">25 مهر 10:35 صبح</p>
												</div>
											</a>
										</div>
										<div class="text-center dropdown-footer">
											<a href="#">مشاهده همه</a>
										</div>
									</div>
								</div>
								<div class="dropdown nav-item main-header-notification">
									<a class="new nav-link" href="#">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
									<div class="dropdown-menu">
										<div class="menu-header-content bg-primary text-right">
											<div class="d-flex">
												<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">اطلاعیه</h6>
												<span class="badge badge-pill badge-warning mr-auto my-auto float-left">علامت گذاری همه</span>
											</div>
											<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">شما 4 اعلان خوانده نشده دارید</p>
										</div>
										<div class="main-notification-list Notification-scroll" style="overflow: auto;">
											<a class="d-flex p-3 border-bottom" href="#">
												<div class="notifyimg bg-pink">
													<i class="la la-file-alt text-white"></i>
												</div>
												<div class="mr-3">
													<h5 class="notification-label mb-1">پرونده های جدید موجود است</h5>
													<div class="notification-subtext">10 ساعت پیش</div>
												</div>
												<div class="mr-auto">
													<i class="las la-angle-left text-left text-muted"></i>
												</div>
											</a>
											<a class="d-flex p-3" href="#">
												<div class="notifyimg bg-purple">
													<i class="la la-gem text-white"></i>
												</div>
												<div class="mr-3">
													<h5 class="notification-label mb-1">به روزرسانی های موجود</h5>
													<div class="notification-subtext">2 روز قبل</div>
												</div>
												<div class="mr-auto">
													<i class="las la-angle-left text-left text-muted"></i>
												</div>
											</a>
											<a class="d-flex p-3 border-bottom" href="#">
												<div class="notifyimg bg-success">
													<i class="la la-shopping-basket text-white"></i>
												</div>
												<div class="mr-3">
													<h5 class="notification-label mb-1">سفارش جدید دریافت شد</h5>
													<div class="notification-subtext">1 ساعت پیش</div>
												</div>
												<div class="mr-auto">
													<i class="las la-angle-left text-left text-muted"></i>
												</div>
											</a>
											<a class="d-flex p-3 border-bottom" href="#">
												<div class="notifyimg bg-warning">
													<i class="la la-envelope-open text-white"></i>
												</div>
												<div class="mr-3">
													<h5 class="notification-label mb-1">بررسی جدید دریافت شد</h5>
													<div class="notification-subtext">1 روز پیش</div>
												</div>
												<div class="mr-auto">
													<i class="las la-angle-left text-left text-muted"></i>
												</div>
											</a>
											<a class="d-flex p-3 border-bottom" href="#">
												<div class="notifyimg bg-danger">
													<i class="la la-user-check text-white"></i>
												</div>
												<div class="mr-3">
													<h5 class="notification-label mb-1">22 ثبت نام تایید شده</h5>
													<div class="notification-subtext">2 ساعت پیش</div>
												</div>
												<div class="mr-auto">
													<i class="las la-angle-left text-left text-muted"></i>
												</div>
											</a>
											<a class="d-flex p-3 border-bottom" href="#">
												<div class="notifyimg bg-primary">
													<i class="la la-check-circle text-white"></i>
												</div>
												<div class="mr-3">
													<h5 class="notification-label mb-1">پروژه تصویب شده است</h5>
													<div class="notification-subtext">4 ساعت پیش</div>
												</div>
												<div class="mr-auto">
													<i class="las la-angle-left text-left text-muted"></i>
												</div>
											</a>
										</div>
										<div class="dropdown-footer">
											<a href="#">مشاهده همه</a>
										</div>
									</div>
								</div>
							<?php } ?>
							<!-- setting menus -->
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href="#"><img alt="user image" src="<?= (!empty($user_info['image'])?$user_info['image']:base_url('assets/svg/user/login.svg')) ?>"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="user image" src="<?= (!empty($user_info['image'])?$user_info['image']:base_url('assets/svg/user/login.svg')) ?>" class=""></div>
											<div class="mr-3 my-auto">
												<h6><?= (!empty($user_info['name'])?$user_info['name']:'').(!empty($user_info['family'])?' '.$user_info['family']:'') ?></h6>
												<span><?= (!empty($user_info['role'])?$user_info['role']:'کاربر') ?></span>
											</div>
										</div>
									</div>
									<?php if(!empty($id) && intval($id)>0){ ?>
										<a class="dropdown-item" href="#"><i class="bx bx-user-circle"></i>مشخصات حساب</a>
										<a class="dropdown-item" href="#"><i class="bx bx-cog"></i> ویرایش حساب</a>
										<a class="dropdown-item" href="#"><i class="bx bx-dollar"></i>کیف پول</a>
										<a class="dropdown-item" href="#"><i class="bx bxs-inbox"></i>وظایف</a>
										<a class="dropdown-item" href="#"><i class="bx bxs-inbox"></i>جلسات</a>
										<a class="dropdown-item" href="#"><i class="bx bx-slider-alt"></i>تنظیمات کسب و کار</a>
										<a class="dropdown-item" href="<?= base_url('logout') ?>">
										<i class="bx bx-log-out"></i> خروج از سیستم</a>
									<?php }else{ ?>
										<a class="google-login dropdown-item" href="<?= base_url('users/users/auto_auth/google') ?>">
											<img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/user/google-login.svg') ?>">
											ورود با حساب gmail
										</a>
										<!-- login -->
										<a class="costum-login dropdown-item" data-target="#select2modal" data-toggle="modal" href="#">
											<img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/user/costum-login.svg') ?>">
											ورود با حساب کاربری و رمز عبور
										</a>
										<!-- login -->
										<!-- add user -->
										<a class="add-user dropdown-item" data-target="#modaldemo6" data-toggle="modal" href="#">
											<img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/user/add-user.svg')?>">
											افزودن حساب کاربری
										</a>
										<!-- add user -->
									<?php } ?>
								</div>
							</div>
							<!-- Sidebar-right -->
							<?php if(!empty($id) && intval($id)>0){ ?>
								<div class="dropdown main-header-message right-toggle">
									<a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
										<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
									</a>
								</div>
							<?php } ?>
							<!-- Sidebar-right -->
						</div>
					</div>
				</div>
			</div>
			<!-- /main-header -->
			<!-- container -->
			<div class="container-fluid" id="content">
				<!-- content -->
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
							مدیریت کسب و کار خانه من
						</h2>
						<p class="mg-b-0">
							همه چیز در منزل من برای شما محیاست کافیست وارد شوید
						</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>
							<div class="main-star">
								<a href="<?= base_url('add_wallet_value') ?>" class="hd-50 wd-150 tx-13 btn btn-dark-gradient rounded-10 p-0">
									<img class="wd-50 hd-50" src="<?= base_url('assets/svg/icon/wallet.svg') ?>" alt="pay">
									افزودن موجودی
								</a>
							</div>
						</div>
						<div>
							<label class="tx-13">موجودی:</label>
							<h5>563،275</h5>
						</div>
						<div>
							<!-- <label class="tx-13">فروش آفلاین</label> -->
							<!-- <h5>783،675</h5> -->
						</div>
					</div>
				</div> 
				<!-- tablighat -->
				<!-- breadcrumb -->
				<!-- row -->
				<!-- <div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">سفارشات امروز</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">500000 تومان</h4>
											<p class="mb-0 tx-12 text-white op-7">در مقایسه با هفته گذشته</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> +427</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">درآمد امروز</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">100000تومان</h4>
											<p class="mb-0 tx-12 text-white op-7">در مقایسه با هفته گذشته</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> -23.09٪</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">درآمد کل</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">71000 تومان</h4>
											<p class="mb-0 tx-12 text-white op-7">در مقایسه با هفته گذشته</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 52.09٪</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">محصول فروخته شده</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">480000 تومان</h4>
											<p class="mb-0 tx-12 text-white op-7">در مقایسه با هفته گذشته</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> -152.3</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div> -->
				<!-- row closed -->
				<!-- tablighat -->
				
				<!-- row opened -->
				<div class="row row-sm">
					

					<!-- product -->
					<div class="col-xl-4 col-md-12 col-lg-6">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">فعالیت فروش</h3>
								<p class="tx-12 mb-0 text-muted">فعالیت های فروش ، تاکتیک هایی است که فروشندگان برای دستیابی به اهداف و هدف خود استفاده می کنند</p>
							</div>
							<div class="product-timeline card-body pt-2 mt-1" style="overflow:auto;">
								<div class="row">
									<div class="col-6">
										<table id="example-delete" class="table text-md-nowrap dataTable dtr-inline" role="grid" aria-describedby="example-delete_info" style="width: 700px;">
											<thead>
												<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example-delete" rowspan="1" colspan="1" style="width: 93px;" aria-sort="ascending" aria-label="نام: activate to sort column descending">نام</th><th class="sorting" tabindex="0" aria-controls="example-delete" rowspan="1" colspan="1" style="width: 173px;" aria-label="موقعیت: activate to sort column ascending">موقعیت</th><th class="sorting" tabindex="0" aria-controls="example-delete" rowspan="1" colspan="1" style="width: 79px;" aria-label="دفتر: activate to sort column ascending">دفتر</th><th class="sorting" tabindex="0" aria-controls="example-delete" rowspan="1" colspan="1" style="width: 37px;" aria-label="سن: activate to sort column ascending">سن</th><th class="sorting" tabindex="0" aria-controls="example-delete" rowspan="1" colspan="1" style="width: 80px;" aria-label="تاریخ شروع: activate to sort column ascending">تاریخ شروع</th><th class="sorting" tabindex="0" aria-controls="example-delete" rowspan="1" colspan="1" style="width: 118px;" aria-label="حقوق: activate to sort column ascending">حقوق</th></tr>
											</thead>
											<tbody>
											<tr role="row" class="odd">
													<td class="sorting_1" tabindex="0" style="">آنجلیکا راموس</td>
													<td>مدیر عامل (مدیر عامل)</td>
													<td>لندن</td>
													<td>47</td>
													<td>1397/10/09</td>
													<td style="">12000000 تومان</td>
												</tr><tr role="row" class="even">
													<td tabindex="0" class="sorting_1">اشتون کاکس</td>
													<td>نویسنده فنی جوان</td>
													<td>سانفرانسیسکو</td>
													<td>66</td>
													<td>1397/01/12</td>
													<td style="">86000 تومان</td>
												</tr><tr role="row" class="odd">
													<td class="sorting_1" tabindex="0">امید فوئنتس</td>
													<td>دبیر، منشی</td>
													<td>سانفرانسیسکو</td>
													<td>41</td>
													<td>1390/02/12</td>
													<td style="">109،850 تومان</td>
												</tr><tr role="row" class="even">
													<td class="sorting_1" tabindex="0">اولیویا لیانگ</td>
													<td>مهندس پشتیبانی</td>
													<td>سنگاپور</td>
													<td>64</td>
													<td>1391/02/03</td>
													<td style="">234،500 تومان</td>
												</tr><tr role="row" class="odd">
													<td tabindex="0" class="sorting_1">ایری ساتو</td>
													<td>حسابدار</td>
													<td>توکیو</td>
													<td>33</td>
													<td>1388/11/28</td>
													<td style="">162،700 تومان</td>
												</tr><tr role="row" class="even">
													<td tabindex="0" class="sorting_1">ببر نیکسون</td>
													<td>معمار سیستم</td>
													<td>ادینبورگ</td>
													<td>61</td>
													<td>1391/04/25</td>
													<td style="">320 هزار و 800 تومان</td>
												</tr><tr role="row" class="odd">
													<td class="sorting_1" tabindex="0">بردلی گریر</td>
													<td>مهندس نرم افزار</td>
													<td>لندن</td>
													<td>41</td>
													<td>1392/10/13</td>
													<td style="">132000 تومان</td>
												</tr><tr role="row" class="even">
													<td class="sorting_1" tabindex="0">برندن واگنر</td>
													<td>مهندس نرم افزار</td>
													<td>سانفرانسیسکو</td>
													<td>28</td>
													<td>1391/06/07</td>
													<td style="">206،850 تومان</td>
												</tr><tr role="row" class="odd">
													<td class="sorting_1" tabindex="0">برونو نش</td>
													<td>مهندس نرم افزار</td>
													<td>لندن</td>
													<td>38</td>
													<td>1391/05/03</td>
													<td style="">163،500 تومان</td>
												</tr><tr role="row" class="even">
													<td tabindex="0" class="sorting_1">بریل ویلیامسون</td>
													<td>متخصص ادغام</td>
													<td>نیویورک</td>
													<td>61</td>
													<td>1392/12/02</td>
													<td style="">372000 تومان</td>
												</tr></tbody>
											<tfoot>
												<tr><th rowspan="1" colspan="1">نام</th><th rowspan="1" colspan="1">موقعیت</th><th rowspan="1" colspan="1">دفتر</th><th rowspan="1" colspan="1">سن</th><th rowspan="1" colspan="1">تاریخ شروع</th><th rowspan="1" colspan="1" style="">حقوق</th></tr>
											</tfoot>
										</table>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<!-- product -->
					<!-- chart -->
					<div class="col-xl-4 col-md-12 col-lg-6">
						<div class="card">
							<div class="card-header pb-0">
								<h3 class="card-title mb-2">سفارشات اخیر</h3>
								<p class="tx-12 mb-0 text-muted">سفارش ، دستورالعمل های سرمایه گذار برای خرید یا فروش به کارگزار یا کارگزاری است</p>
							</div>
							<div class="card-body sales-info ot-0 pt-0 pb-0">
								<figure class="highcharts-figure chart d-none">
									<a class="chart-close" onclick="hideChart();">
										<img class="w-100d h-100d" src="https://www.my-home.ir/assets/svg/back.svg">
									</a>
									<div id="container"></div>
								</figure>
								<script>
									function changeChart(chartInfo){
										if(chart) chart.destroy();
										var chart = Highcharts.chart('container',chartInfo);
										return true;
									}
								</script>
							</div>
						</div>

					</div>
					<!-- chart -->
					<!-- position -->
					<div class="col-xl-4 col-md-12 col-lg-6">
						<div class="card card-dashboard-map-one">
							<div class="breadcrumb-header justify-content-between">
								<div class="my-auto">
									<div class="d-flex"><h4 class="content-title mb-0 my-auto">برنامه ها</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقویم</span></div>
								</div>
								<div class="d-flex my-xl-auto right-content">
									<div class="pr-1 mb-3 mb-xl-0">
										<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
									</div>
									<div class="pr-1 mb-3 mb-xl-0">
										<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
									</div>
									<div class="pr-1 mb-3 mb-xl-0">
										<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
									</div>
									<div class="mb-3 mb-xl-0">
										<div class="btn-group dropdown">
											<button type="button" class="btn btn-primary">20 مهر 1399</button>
											<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="sr-only">منوی کشویی</span>
											</button>
											<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
												<a class="dropdown-item" href="#">1399 </a>
												<a class="dropdown-item" href="#">1398 </a>
												<a class="dropdown-item" href="#">1397 </a>
												<a class="dropdown-item" href="#">1396</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="main-content-app pd-b-0  main-content-calendar pt-0">
							<div class="row row-sm">
								<div class="col-lg-12 col-xl-12">
									<div class="main-content-body main-content-body-calendar card p-4">
										<div class="main-calendar" id="calendar"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- position -->
					<!-- map  -->
					<?php if(!empty($map)){ ?>
						<div class="col-xl-4 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-body">
									<div id='map' class="d-none"></div>
									<script>
										maptilersdk.config.apiKey = 'kvXmcJTTN5s5LnvpEyP5';
										const map = new maptilersdk.Map({
											container: 'map',
											style: maptilersdk.MapStyle.STREETS,
											center: [<?= (!empty($lon) && $lon !== 'none'?$lon:'0') ?>,<?= (!empty($lat) && $lat !== 'none'?$lat:'0') ?>],
											zoom: 14,
										});
										map.on('load', function () {
											map.addSource('contours', {
												type: 'vector',
												url:`https://api.maptiler.com/tiles/contours/tiles.json`
											});
											map.addLayer({
												'id': 'terrain-data',
												'type': 'line',
												'source': 'contours',
												'source-layer': 'contour',
												'layout': {
													'line-join': 'round',
													'line-cap': 'round'
												},
												'paint': {
													'line-color': '#ff69b4',
													'line-width': 1
												}
											});
										});
									</script>
								</div>
							</div>
						</div>
					<?php } ?>
					
				</div>
				<!-- row close -->

				<!-- row opened -->
				<!-- <div class="row row-sm row-deck">
					<div class="col-md-12 col-lg-4 col-xl-4">
						<div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">کشورهای برتر شما</h6><span class="d-block mg-b-10 text-muted tx-12">درآمد عملکرد فروش براساس کشور</span>
							<div class="list-group">
								<div class="list-group-item border-top-0">
									<i class="flag-icon flag-icon-us flag-icon-squared"></i>
									<p>ایالات متحده</p><span>1،671,010 تومان</span>
								</div>
								<div class="list-group-item">
									<i class="flag-icon flag-icon-nl flag-icon-squared"></i>
									<p>هلند</p><span>1064075 تومان</span>
								</div>
								<div class="list-group-item">
									<i class="flag-icon flag-icon-gb flag-icon-squared"></i>
									<p>انگلستان</p><span>1055098 تومان</span>
								</div>
								<div class="list-group-item">
									<i class="flag-icon flag-icon-ca flag-icon-squared"></i>
									<p>کانادا</p><span>1045049 تومان</span>
								</div>
								<div class="list-group-item">
									<i class="flag-icon flag-icon-in flag-icon-squared"></i>
									<p>هند</p><span>1930012 تومان</span>
								</div>
								<div class="list-group-item border-bottom-0 mb-0">
									<i class="flag-icon flag-icon-au flag-icon-squared"></i>
									<p>استرالیا</p><span>1042000 تومان</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-8 col-xl-8">
						<div class="card card-table-two">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mb-1">آخرین درآمد شما</h4>
								<i class="mdi mdi-dots-horizontal text-gray"></i>
							</div>
							<span class="tx-12 tx-muted mb-3 ">این آخرین درآمد شما برای تاریخ امروز است.</span>
							<div class="table-responsive country-table">
								<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
									<thead>
										<tr>
											<th class="wd-lg-25p">تاریخ</th>
											<th class="wd-lg-25p tx-right">تعداد فروش</th>
											<th class="wd-lg-25p tx-right">درآمد</th>
											<th class="wd-lg-25p tx-right">مالیات </th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>05 مهر 1399</td>
											<td class="tx-right tx-medium tx-inverse">34</td>
											<td class="tx-right tx-medium tx-inverse">658020 تومان</td>
											<td class="tx-right tx-medium tx-danger">- 45.10 تومان</td>
										</tr>
										<tr>
											<td>06 مهر 1399</td>
											<td class="tx-right tx-medium tx-inverse">26</td>
											<td class="tx-right tx-medium tx-inverse">453025 تومان</td>
											<td class="tx-right tx-medium tx-danger">- 15002 تومان</td>
										</tr>
										<tr>
											<td>07 مهر 1399</td>
											<td class="tx-right tx-medium tx-inverse">34</td>
											<td class="tx-right tx-medium tx-inverse">653012 تومان</td>
											<td class="tx-right tx-medium tx-danger">- 13045 تومان</td>
										</tr>
										<tr>
											<td>08 مهر 1399</td>
											<td class="tx-right tx-medium tx-inverse">45</td>
											<td class="tx-right tx-medium tx-inverse">546047 تومان</td>
											<td class="tx-right tx-medium tx-danger">- 24022 تومان</td>
										</tr>
										<tr>
											<td>09 مهر 1399</td>
											<td class="tx-right tx-medium tx-inverse">31</td>
											<td class="tx-right tx-medium tx-inverse">425072 تومان</td>
											<td class="tx-right tx-medium tx-danger">- 25001 تومان</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div> -->
				<!-- /row -->
				<!-- content -->
			</div>
		</div>
    		<!-- Container closed -->
    		<!-- Sidebar-right-->
    		<!-- company manager -->
    		<?php if(!empty($id) && intval($id)>0){ ?>
    			<div class="sidebar sidebar-left sidebar-animate">
    				<div class="panel panel-primary card mb-0 box-shadow">
    					<div class="tab-menu-heading border-0 p-3">
    						<div class="card-options ml-auto">
    							<a href="#" class="sidebar-remove">
    								<img class="wd-25 hd-25" src="<?= base_url('assets/svg/back.svg') ?>" alt="back icon">
    							</a>
    						</div>
    						<div class="card-title mb-0 pt-1 text-center mx-auto">تنظیمات کسب و کار</div>
    						<a class="ripple mx-1 my-0 px-3 py-1 btn-success-gradient rounded-10" data-target="#modaldemo3" data-toggle="modal">
    							افزودن
    						</a>
    					</div>
    					<div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
    						<div class="tabs-menu">
    							<ul class="nav panel-tabs">
    								<li>
    									<a href="#side1" data-toggle="tab" class="active">
    										<img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/company/selector.svg') ?>">
    										کسب و کار های من
    									</a>
    								</li>
    								<li>
    									<a href="#side2" data-toggle="tab">
    										<img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/company/add.svg') ?>">
    										رزرو های من
    									</a>
    								</li>
    								<li>
    									<a href="#side3" data-toggle="tab">
    										<img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/company/company.svg') ?>">
    										سفارشات
    									</a>
    								</li>
    							</ul>
    						</div>
    						<div class="tab-content">
    							<div class="tab-pane active work-setting-tab" id="side1">
    								<?php if(!empty($my_company)){
    									foreach ($my_company as $com) { ?>
    										<div class="list d-flex align-items-center border-bottom p-3 company-id-<?= (!empty($com['company_info']['id'])?$com['company_info']['id']:'') ?>">
    											<input type="hidden" value="<?= (!empty($com['company_role_id'])?$com['company_role_id']:'') ?>" class="company_role_id">
    											<input type="hidden" value="<?= (!empty($com['company_role_parent_id'])?$com['company_role_parent_id']:'') ?>" class="company_role_parent_id">
    											<input type="hidden" value="<?= (!empty($com['role_id'])?$com['role_id']:'') ?>" class="role_id">
    											<input type="hidden" value="<?= (!empty($com['company_info']['id'])?$com['company_info']['id']:'') ?>" class="company_id">
    											<div class="">
    												<span class="avatar bg-dark brround avatar-md" style="overflow: hidden;">
    													<img src="<?= base_url('assets/svg/company/'.(!empty($com['company_info']['icon'])?$com['company_info']['icon']:'company.svg')) ?>" alt="company pictures">
    													<span class="avatar-status 
    													<?= ((intval($com['company_info']['type'])>0 || (intval($com['company_info']['type'])==0 && (intval($com['role_id'])== 1||intval($com['role_id'])== 2))) && !empty($com['company_info']['status']) && intval($com['company_info']['status'])>0?'bg-success':'bg-danger') ?>"></span>
    												</span>
    											</div>
    											<a class="wrapper w-100 mr-3" href="<?= base_url('company/manage/'.(!empty($com['company_info']['id'])?$com['company_info']['id']:'').'/'.(!empty($com['role_id']) && intval($com['role_id'])>0?intval($com['role_id']):'manager')) ?>">
    												<p class="mb-0 d-flex">
    													<b><?= (!empty($com['company_info']['title'])?$com['company_info']['title']:'') ?></b>
    												</p>
    												<div class="d-flex justify-content-between align-items-center">
    													<div class="d-flex align-items-center">
    														<small class="text-muted ml-auto">
    															<?= (!empty($com['company_info']['description'])?$com['company_info']['description']:'') ?>
    														</small>
    													</div>
    												</div>
    											</a>
    										</div>
    									<?php }
    								}else{ ?>
    									<div class="alert alert-danger rounded-10 text-dark text-center p-3">
    										شما کسب و کاری برای خود ندارید ابتدا با فشردن دکمه ی افزودن در بالا یکی اضافه کنید
    									</div>
    								<?php } ?>
    							</div>
    							<div class="tab-pane work-setting-tab" id="side2">
    								<!-- <div class="row"> -->
    									<!-- <div class="col"> -->
    									<!-- company/show_company_position_valex/'.$p["company_info"]['id'].'/'.$p['info']['id']) ?> -->
    										<!-- <a class="btn btn-dark-gradient p-0 rounded-10 wd-25 mr-1 mt-1 ml-auto" href="#" style="text-align: left;display: block;">
    											
    										</a>
    									</div>
    									<div class="col-11 mx-auto"> -->
    										<div class="list-group list-group-flush">
    											<?php if(!empty($my_position)){ 
    												foreach ($my_position as $p) {
    													if(!empty($p['info'])){ ?>	
    														<div class="list-group-item d-flex text-center company-id-<?= (!empty($p["company_info"]['id']) && intval($p["company_info"]['id'])>0?intval($p["company_info"]['id']):0) ?> position-id-<?= (!empty($p['info']['id']) && intval($p['info']['id'])>0?intval($p['info']['id']):'0') ?> align-items-center">
    															<div class="ml-3">
    																<span class="avatar avatar-lg brround cover-image" 
    																data-image-src="<?= 
    																(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
    																(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
    																base_url('assets/svg/position/position.svg'))) ?>" 
    																style="background: url(&quot;<?= 
    																(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
    																(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
    																base_url('assets/svg/position/position.svg'))) ?>&quot;) center center;">
    																<span class="avatar-status <?= (!empty($p["status"]) && intval($p["status"])>0?'bg-success':'bg-danger') ?>"></span></span>
    															</div>
    															<div style="max-width: 140px;max-height: 96px;word-break: keep-all;text-overflow: ellipsis;overflow: hidden;">
    																<strong><?= (!empty($p['info']['title'])?$p['info']['title']:'') ?></strong>
    																<br>
    																<?= (!empty($p['info']['description'])?$p['info']['description']:'') ?>
    																<div class="small text-muted">
    																	<?= (!empty($p['info']['status']) && intval($p['info']['status'])>0?'معتبر':'نامعتبر') ?>
    																	<br>
    																	<?= (!empty($p["factor"])?'پرداخت شده':(!empty($p['info']['price'])?'پرداخت نشده':'رایگان')) ?>
    																	<br>
    																	<?= (!empty($p["time_reserve"])?$p["time_reserve"].' ساعت ':'') ?>
    																	<?= (!empty($p['info']['position_type']) && intval($p['info']['position_type'])>0?'حضوری':'مجازی') ?>
    																</div>
    															</div>
    															<div class="mr-auto">
    																<a onclick="showCalenderPosition(this);" 
    																class="btn btn-sm btn-dark-gradient rounded-10 wd-25 p-0">
    																	<img class="w-100 h-100" src="<?= base_url('assets/svg/icon/setting.svg') ?>" alt="my position setting">
    																</a>
    															</div>
    															<div class="d-none calender-position">
    																<div class="row">
    																	<div class="col">
    																		<a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hideCalenderPosition(this);" style="text-align: right;display: block;">
    																			<img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to menu">
    																		</a>
    																	</div>
    																	<div class="col">
    																		<a class="btn btn-dark-gradient p-0 rounded-10 wd-25 mr-auto" onclick="showPositionOrder(this);" style="text-align: left;display: block;">
    																			<img class="w-100 h-100" src="<?= base_url('assets/svg/icon/buy.svg') ?>" alt="my position setting">
    																		</a>
    																	</div>
    																</div>
    																<div class="row">
    																	<div class="col-11 mx-auto">
    																		<?= (!empty($p["order_time"])?$p["order_time"]:'<div class="alert alert-danger rounded-10 text-center p-3 text-dark">زمان مشخصی برای رزرو وجود ندارد</div>') ?>
    																	</div>
    																</div>
    																<div class="row order d-none">
    																	<div class="col">
    																		<a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hidePositionOrder(this);" style="text-align: right;display: block;">
    																			<img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to menu">
    																		</a>
    																	</div>
    																	<div class="col">
    																		<a class="btn btn-dark-gradient rounded-10 wd-25 mr-auto p-0" onclick="showCompanyOtherProduct(this);" style="text-align: right;display: block;">
    																			<img class="w-100 h-100" src="<?= base_url('assets/svg/icon/add.svg') ?>" alt="add product for buy">
    																		</a>
    																	</div>
    																	<div class="col-12" style="max-height: 200px;overflow-x: hidden;overflow-y: auto;">
    																		<?php if(!empty($p['product_order'])){
    																			foreach ($p['product_order'] as $o) { ?>
    																				<div class="list-group-item d-flex text-center product-id-<?= (!empty($o['product_info']["id"]) && intval($o['product_info']["id"])>0?intval($o['product_info']["id"]):0) ?> company-id-<?= (!empty($p["company_info"]['id']) && intval($p["company_info"]['id'])>0?intval($p["company_info"]['id']):0) ?> position-id-<?= (!empty($p['info']['id']) && intval($p['info']['id'])>0?intval($p['info']['id']):'0') ?> align-items-center">
    																					<div class="ml-3">
    																						<span class="avatar avatar-lg brround cover-image" 
    																						data-image-src="<?= 
    																						(!empty($o['product_info']["icon"])?base_url('assets/svg/product/'.$o['product_info']["icon"]):
    																						(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
    																						(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
    																						base_url('assets/svg/product/product.svg')))) ?>" 
    																						style="background: url(&quot;<?= 
    																						(!empty($o['product_info']["icon"])?base_url('assets/svg/product/'.$o['product_info']["icon"]):
    																						(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
    																						(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
    																						base_url('assets/svg/product/product.svg')))) ?>&quot;) center center;">
    																							<span class="avatar-status <?= (!empty($o['product_info']['status']) && intval($o['product_info']['status'])>0?'bg-success':'bg-danger') ?>"></span>
    																						</span>
    																					</div>
    																					<div style="max-width: 140px;max-height: 96px;word-break: keep-all;text-overflow: ellipsis;overflow: hidden;">
    																						<strong>
    																							<?= (!empty($o['product_info']['title'])?$o['product_info']['title']:
    																							(!empty($o['product_info']['key'])?$o['product_info']['key']:''))?>
    																						</strong>
    																						<br>
    																						<?= (!empty($o['product_info']['description'])?$o['product_info']['description']:'') ?>
    																						<div class="small text-muted">
    																							قیمت:<?= (!empty($o["price"])?$o["price"]:'رایگان') ?>	
    																							<br>
    																							<?php if(!empty($o['status']) && intval($o['status'])>0){ ?>
    																								حساب شده
    																							<?php }else{ ?>
    																								پرداخت نشده
    																								<a onclick="payProduct();" class="btn btn-dark-gradient rounded-10 wd-25 p-0">
    																									<img src="<?= base_url('assets/svg/icon/buy.svg') ?>" alt="payment" class="w-100 h-100">
    																								</a>
    																							<?php } ?>
    																							<br>
    																							<?= (!empty($o["time"])?$date->jdate('Y/m/d/ h:i',strtotime($o["time"])):'') ?>
    																						</div>
    																					</div>
    																				</div>
    																		<?php }
    																		} ?>
    																	</div>
    																	<div class="col-12 d-none company-other-product">
    																		<div class="row">
    																			<div class="col">
    																				<a class="btn btn-dark-gradient rounded-10 wd-25 ml-auto p-0" onclick="hideCompanyOtherProduct(this);" style="text-align: right;display: block;">
    																					<img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to position list">
    																				</a>
    																			</div>
    																			<div class="col-12" style="max-height: 210px;overflow-x: hidden;overflow-y:auto;">
    																				<?php if(!empty($p['company_other_product'])){ 
    																					foreach ($p['company_other_product'] as $cop) { ?>
    																						<div class="list-group-item d-flex text-center 
    																						product-id-<?= (!empty($cop['info']["id"]) && intval($cop['info']["id"])>0?
    																						intval($cop['info']["id"]):0) ?> 
    																						company-id-<?= (!empty($p["company_info"]['id']) && intval($p["company_info"]['id'])>0?
    																						intval($p["company_info"]['id']):0) ?> 
    																						position-id-<?= (!empty($p['info']['id']) && intval($p['info']['id'])>0?
    																						intval($p['info']['id']):'0') ?> align-items-center">
    																							<div class="ml-3">
    																								<span class="avatar avatar-lg brround cover-image" 
    																								data-image-src="<?= 
    																								(!empty($cop['info']["icon"])?base_url('assets/svg/product/'.$cop['info']["icon"]):
    																								(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
    																								(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
    																								base_url('assets/svg/product/product.svg')))) ?>" 
    																								style="background: url(&quot;<?= 
    																								(!empty($cop['info']["icon"])?base_url('assets/svg/product/'.$cop['info']["icon"]):
    																								(!empty($p['info']['icon'])?base_url('assets/svg/position/'.$p['info']['icon']):
    																								(!empty($p["company_info"]['icon'])?base_url('assets/svg/company/'.$p["company_info"]['icon']):
    																								base_url('assets/svg/product/product.svg')))) ?>&quot;) center center;">
    																									<span class="avatar-status <?= (!empty($cop['info']['status']) && intval($cop['info']['status'])>0?'bg-success':'bg-danger') ?>"></span>
    																								</span>
    																							</div>
    																							<div style="max-width: 140px;max-height: 96px;word-break: keep-all;text-overflow: ellipsis;overflow: hidden;">
    																								<strong>
    																									<?= (!empty($cop['info']['title'])?$cop['info']['title']:
    																									(!empty($cop['info']['key'])?$cop['info']['key']:''))?>
    																								</strong>
    																								<br>
    																								<?= (!empty($cop['info']['description'])?$cop['info']['description']:'') ?>
    																								<div class="small text-muted">
    																									<?= (!empty($cop['key'])?$cop['key']:'') ?>
    																								</div>
    																							</div>
    																							<div class="mr-auto">
    																								<?php if(!empty($cop['info']['status']) && intval($cop['info']['status'])>0){ ?>
    																									
    																									<a onclick="addProductToPosition(this,<?= $cop['info']['id'].','.$p['company_user_id'] ?>);" class="btn btn-sm btn-light">
    																										افزودن
    																									</a>
    																								<?php } ?>
    																							</div>
    																						</div>
    																					<?php }
    																				}else{ ?>
    																					<div class="alert alert-danger text-center text-dark p-3">
    																						کالایی برای این جایگاه وجود ندارد
    																					</div>
    																				<?php } ?>
    																			</div>
    																		</div>
    																	</div>
    																</div>
    															</div>
    														</div>
    											<?php 	} 
    												}
    											}?>
    										</div>
    									<!-- </div> -->
    								<!-- </div> -->
    							</div>
    							<div class="tab-pane work-setting-tab" id="side3">
    								<?php if(!empty($my_order)){ 
    									if(!empty($my_order['suggest'])){ ?>
    										<div class="row">
    											<div class="col">
    												<a onclick="showOrderSuggest(this);" class="wd-50 hd-50 p-0 btn btn-sm btn-light">
    													<img src="<?= base_url('assets/svg/icon/shop.svg') ?>" alt="suggest for user">
    													فروشگاه
    												</a>
    											</div>
    										</div>
    										<div class="row suggest d-none">
    											<div class="col">
    												<a onclick="HideOrderSuggest(this);" class="wd-20 hd-20 p-0 btn btn-sm btn-light">
    													<img src="<?= base_url('assets/svg/back.svg') ?>" alt="back to orders">
    												</a>
    											</div>
    										</div>
    										<div class="list-group list-group-flush suggest d-none">
    											<?php foreach ($my_order['suggest'] as $s) { ?>
    												<div class="list-group-item d-flex  
    												align-items-center">
    													<div class="ml-2">
    														<span class="avatar avatar-md brround cover-image"
    														data-image-src="<?= base_url('assets/svg/package/'.(!empty($s['logo'])?$s['logo']:'package.svg')) ?>">
    															<span class="avatar-status <?= (!empty($s['status']) && intval($s['status'])>0?'bg-success':'bg-danger') ?>"></span>
    														</span>
    													</div>
    													<div class="">
    														<div class="font-weight-semibold">
    															<?= (!empty($s['title'])?$s['title'].'<br>':'') ?>
    															<?= (!empty($s['description'])?$s['description'].'<br>':'') ?>
    															<?= (!empty($s['price'])?$s['price'].'<br>':'') ?>
    														</div>
    													</div>
    													<div class="mr-auto">
    														<a onclick="addToPay(this,<?= $s['id'] ?>);" class="wd-20 hd-20 p-0 btn btn-sm btn-light">
    															<img src="<?= base_url('assets/svg/icon/buy.svg') ?>" alt="buy this product">
    														</a>
    													</div>
    												</div>
    											<?php } ?>
    										</div>
    									<?php }else{ ?>
    										<div class="alert alert-danger rounded-10 text-dark text-center p-3">
    											شما کسب و کاری برای خود ندارید ابتدا یکی اضافه کنید
    										</div>	
    									<?php } 
    									if(!empty($my_order['info'])){ ?>
    										<div class="list-group list-group-flush my-order">
    											<?php foreach ($my_order['info'] as $i) { ?>
    												<div class="list-group-item d-flex 
    												align-items-center">
    													<div class="ml-2">
    														<span class="avatar avatar-md brround
    														cover-image" 
    														data-image-src="<?= base_url('assets/svg/package/'.(!empty($i['package']['logo'])?$i['package']['logo']:'package.svg')) ?>">
    															<span class="avatar-status<?= ($i['order_info']["end_time"] > time()?' bg-success':' bg-danger') ?>"></span>
    														</span>
    													</div>
    													<div class="">
    														<div class="font-weight-semibold">
    															<?= (!empty($i['package']['title'])?$i['package']['title'].'<br>':'') ?>
    															<?= (!empty($i['package']['description'])?$i['package']['description']:'') ?>
    														</div>
    														<div class="small text-muted">
    															<?= (!empty($i['package']['price'])?$i['package']['price']:'') ?>
    														</div>
    													</div>
    													<div class="mr-auto">
    														<a class="btn btn-sm btn-light" onclick="showPayInfo(this);">
    															<i class="fab fa-facebook-messenger"></i>
    														</a>
    													</div>
    													<div class="d-none row pay-info">
    														<div class="col">
    															<a class="wd-20 hd-20 p-0 btn btn-sm btn-light" onclick="hidePayInfo(this);">
    																<img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to order info">
    															</a>
    														</div>
    														<div class="col text-center">
    															<p class="text-muted small">
    																مبلغ:<?= (intval($i['order_info']["payment"])>0?$i['order_info']["payment"]:'رایگان') ?>
    																<?php if($i['order_info']["end_time"] <= time()){?>
    																	<br>
    																	<a onclick="holdoverPackage(<?= $i['order_info']['company_id'] ?>);"  class="wd-80 hd-50 p-0 btn btn-sm btn-light">
    																		<img class="w-50 h-100" src="<?= base_url('assets/svg/icon/buy.svg') ?>" alt="holdover package">
    																		تمدید
    																	</a>
    																<?php } ?>
    															</p>
    														</div>
    														<div class="col">
    															<p class="text-muted small">
    																شماره فاکتور:<?= $i['order_info']["factor"] ?>
    																<br>
    																تاریخ:<?= $date->jdate('Y/m/d',strtotime($i['order_info']["time"])) ?>
    															</p>
    														</div>
    													</div>
    												</div>
    											<?php } ?>
    										</div>
    									<?php }else{ ?>
    										<div class="alert alert-danger rounded-10 text-dark text-center p-3">
    											شما سفارشی در جایگاه ها ندارید
    										</div>	
    									<?php } 
    									
    								
    								}else{ ?>
    									<div class="alert alert-danger rounded-10 text-dark text-center p-3">
    										شما کسب و کاری برای خود ندارید ابتدا با فشردن دکمه ی افزودن در بالا یکی اضافه کنید
    									</div>	
    								<?php } ?>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		<?php } ?>
    		<!-- company manager -->
    		<!--/Sidebar-right-->
		</div>
		
		<!-- modal -->
		<!-- add company -->
		<div class="modal" id="modaldemo3" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">افزودن کسب و کار </h6>
						<button aria-label="بستن" class="close" data-dismiss="modal" type="button">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="add-company-manager" style="overflow-y: auto;overflow-x: hidden;max-height: 410px;">
							<label class="mb-0">
								عکس کسب و کار خود را اضافه کنید
							</label>
							<?= (!empty($company_logo_uploader)?$company_logo_uploader:'') ?>
							<form onsubmit="addCompany(this,event);">
								<div class="mt-1 mb-2">
									<div class="row">
										<div class="parsley-input col-md-6" id="fnWrapper">
											<label>
												عنوان کسب و کار
												<span class="tx-danger">*</span>
											</label>
											<input class="form-control" id="company-title" placeholder='نام کسب و کار' type="text">
										</div>
										<div class="parsley-input col-md-6" id="lnWrapper">
											<label>
												آدرس سایت(اختیاری)
											</label>
											<input dir="ltr" class="form-control" id="company-url" placeholder='example.com' type="text">
										</div>
									</div>
								</div>
								<label>
									توضیح فعالیت
									<span class="tx-danger">*</span>
								</label>
								<textarea class="form-control" id="company-description" placeholder="توضیحات کسب و کار" rows="3"></textarea>
								<p class="mg-b-10 mg-t-10">
									نوع تجارت مورد نظر شما چیست؟
									<span class="tx-danger">*</span>
								</p>
								<div class="row">
									<div class="col-4">
										<label class="rdiobox">
											<input name="type" type="radio" value="0" checked="">
											<span>تجارت تک نفره</span>
										</label>
									</div>
									<div class="col-8">
										<label class="rdiobox">
											<input name="type" disabled type="radio" value="1">
											<span>تجارت چند نفره(با خرید پکیج ها می توانید این بخش را باز کنید)
											</span>
										</label>
									</div>
								</div>
								<div class="mg-t-20">
									<button class="btn btn-success-gradient btn-block pd-x-20" type="submit">
										ثبت
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- add company -->
		<!-- add user -->
		<div class="modal" id="modaldemo6" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">افزودن حساب کاربری</h6>
						<button aria-label="بستن" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
					<div class="modal-body">
						<div id="wizard3" role="application" class="wizard clearfix vertical">
							<div class="steps clearfix">
								<ul role="tablist">
									<li role="tab" class="first current" aria-disabled="false" aria-selected="true">
										<a id="wizard3-t-0" href="#wizard3-h-0" aria-controls="wizard3-p-0">
											<span class="current-info audible">current step: </span>
											<span class="number">1</span> 
											<span class="title">اطلاعات شخصی</span>
										</a>
									</li>
									<li role="tab" class="done" aria-disabled="false" aria-selected="false">
										<a id="wizard3-t-1" href="#wizard3-h-1" aria-controls="wizard3-p-1">
											<span class="number">2</span> 
											<span class="title">مشخصات کاربری</span>
										</a>
									</li>
								</ul>
							</div>
							<div class="content clearfix" style="height: 360px;overflow: auto;">
								<input type="hidden" id="register-user-id">
								<h3 id="wizard3-h-0" tabindex="-1" class="title current">اطلاعات شخصی</h3>
								<section id="wizard3-p-0" role="tabpanel" aria-labelledby="wizard3-h-0" class="body current" aria-hidden="false" style="">
									<form id="register">
										<div class="control-group form-group">
											<label class="form-label">نام</label>
											<input type="text" id="name" class="form-control" autocomplete="on" placeholder="نام">
										</div>
										<div class="control-group form-group">
											<label class="form-label">نام خانوادگی</label>
											<input type="text" id="family" class="form-control" autocomplete="on" placeholder="نام خانوادگی">
										</div>
										<div class="control-group form-group">
											<label class="form-label">شماره تلفن</label>
											<input type="tel" id="phone" class="form-control" autocomplete="on" placeholder="شماره تلفن">
										</div>
										<div class="control-group form-group">
											<label class="form-label">تاریخ تولد</label>
											<?= (!empty($timer)?$timer:'') ?>
										</div>
										<div class="control-group form-group">
											<label class="form-label">پست الکترونیک (اختیاری)</label>
											<input type="email" id="gmail" class="form-control" autocomplete="on" placeholder="آدرس ایمیل">
										</div>
									</form>
								</section>
								<h3 id="wizard3-h-1" tabindex="-1" class="title">مشخصات حساب کاربری</h3>
								<section id="wizard3-p-1" role="tabpanel" aria-labelledby="wizard3-h-1" class="body d-none" aria-hidden="true">
									<form id="registerAuthInfo">
										<div class="control-group form-group">
											<label class="form-label">نام کاربری</label>
											<input type="text" id="register-username" class="form-control" autocomplete="on" placeholder="نام کاربری">
										</div>
										<div class="control-group form-group">
											<label class="form-label">رمز عبور</label>
											<input type="text" id="register-password" class="form-control" autocomplete="on" placeholder="رمز عبور">
										</div>
									</form>
								</section>
							</div>
							<div class="actions clearfix">
								<ul role="menu" aria-label="Pagination">
									<li class="d-none">
										<a class="btn btn-danger-gradient">قبلی</a>
									</li>
									<li class="">
										<a class="btn btn-success-gradient" onclick="register(event);">بعدی</a>
									</li>
									<li class="d-none">
										<a class="btn btn-success-gradient" onclick="authRegister(event);">پایان</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?= base_url('assets/js/users/register.js') ?>"></script>
		<!-- add user -->
		<!-- login  -->
		<div class="modal" id="select2modal" data-select2-id="select2modal" aria-hidden="true" style="display: none;">
			<div class="modal-dialog" role="document" data-select2-id="7">
				<div class="modal-content modal-content-demo" data-select2-id="6">
					<div class="modal-header">
						<h6 class="modal-title">
							ورود به ناحیه کاربری
						</h6>
						<button aria-label="بستن" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
					<form id="auth">
						<div class="modal-body" data-select2-id="5">
							<div class="form-group">
								<label>نام کاربری</label> 
								<input id="username" class="form-control" autocomplete="on" placeholder=" نام کاربری خود را وارد کنید" type="text">
							</div>
							<div class="form-group">
								<label>کلمه عبور</label>
								<input id="password" class="form-control" autocomplete="on" placeholder="رمز ورود خود را وارد کنید" type="password">
							</div>
						</div>
						<div class="modal-footer">
							<button onclick="authAction(event);" class="btn btn-success-gradient btn-block">ورود به حساب</button>
						</div>
					</form>	
				</div>
			</div>
		</div>
		<script src="<?= base_url('assets/js/users/login.js') ?>"></script>
		<!-- login  -->
		<!-- Message Modal -->
		<!-- <div class="modal fade" id="chatmodel" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-right chatbox" role="document">
				<div class="modal-content chat border-0">
					<div class="card overflow-hidden mb-0 border-0">
						<div class="action-header clearfix">
							<div class="float-right hidden-xs d-flex ml-2">
								<div class="img_cont ml-3">
									<img src="assets/img/faces/6.jpg" class="rounded-circle user_img" alt="img">
								</div>
								<div class="align-items-center mt-2">
									<h4 class="text-white mb-0 font-weight-semibold">دنیل اسکات</h4>
									<span class="dot-label bg-success"></span><span class="mr-3 text-white">آنلاین</span>
								</div>
							</div>
							<ul class="ah-actions actions align-items-center">
								<li class="call-icon">
									<a href="#" class="d-done d-md-block phone-button" data-toggle="modal" data-target="#audiomodal">
										<i class="si si-phone"></i>
									</a>
								</li>
								<li class="video-icon">
									<a href="#" class="d-done d-md-block phone-button" data-toggle="modal" data-target="#videomodal">
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


						<div class="card-body msg_card_body">
							<div class="chat-box-single-line">
								<abbr class="timestamp">1 مهر 1399</abbr>
							</div>
							<div class="d-flex justify-content-start">
								<div class="img_cont_msg">
									<img src="assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
								<div class="msg_cotainer">
									سلام ، حال شما چطور است؟
									<span class="msg_time">8:40 صبح ، امروز</span>
								</div>
							</div>
							<div class="d-flex justify-content-end ">
								<div class="msg_cotainer_send">
									سلام کانر پیج هستم من خوبم شما چطور؟
									<span class="msg_time_send">8:55 صبح ، امروز</span>
								</div>
								<div class="img_cont_msg">
									<img src="assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
							</div>
							<div class="d-flex justify-content-start ">
								<div class="img_cont_msg">
									<img src="assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
								<div class="msg_cotainer">
									من هم خوب هستم <span class="msg_time">9:00 صبح امروز</span> متشکرم
									<span class="msg_time"></span>
								</div>
							</div>
							<div class="d-flex justify-content-end ">
								<div class="msg_cotainer_send"><span class="msg_time_send">  ساعت 9:05</span>
									از کانر پیج استقبال
									<span class="msg_time_send">می کنید</span>
								</div>
								<div class="img_cont_msg">
									<img src="assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
							</div>
							<div class="d-flex justify-content-start ">
								<div class="img_cont_msg">
									<img src="assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
								<div class="msg_cotainer">
									آیا می توانید قالب را به روز کنید؟
									<span class="msg_time">9:07 صبح ، امروز</span>
								</div>
							</div>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									اما من باید برای شما توضیح دهم که چگونه این همه اشتباه  <span class="msg_time_send">امروز 9:10 صبح </span>
									<span class="msg_time_send"></span>
								</div>
								<div class="img_cont_msg">
									<img src="assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
							</div>
							<div class="d-flex justify-content-start ">
								<div class="img_cont_msg">
									<img src="assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
								<div class="msg_cotainer">
									آیا می توانید قالب را به روز کنید؟
									<span class="msg_time">9:07 صبح ، امروز</span>
								</div>
							</div>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									اما من باید برای شما توضیح دهم که چگونه این همه اشتباه  <span class="msg_time_send">امروز 9:10 صبح </span>
									<span class="msg_time_send"></span>
								</div>
								<div class="img_cont_msg">
									<img src="assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
							</div>
							<div class="d-flex justify-content-start ">
								<div class="img_cont_msg">
									<img src="assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
								<div class="msg_cotainer">
									آیا می توانید قالب را به روز کنید؟
									<span class="msg_time">9:07 صبح ، امروز</span>
								</div>
							</div>
							<div class="d-flex justify-content-start">
								<div class="img_cont_msg">
									<img src="assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
								</div>
								<div class="msg_cotainer">
									باشه خداحافظ ، بعدا برایت پیامک می کنیم ..
									<span class="msg_time">9:12 صبح ، امروز</span>
								</div>
							</div>
						</div>

						

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
						</div>

					</div>
				</div>
			</div>
		</div> -->
		<!-- Audio Modal -->
		<!-- <div id="audiomodal" class="modal fade">
			<div class="modal-dialog" role="document">
				<div class="modal-content border-0">
					<div class="modal-body mx-auto text-center p-7">
						<h5>تماس صوتی والکس</h5>
						<img src="assets/img/faces/6.jpg" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
						<h4 class="mb-1  font-weight-semibold">دنیل اسکات</h4>
						<h6>صدا زدن...</h6>
						<div class="mt-5">
							<div class="row">
								<div class="col-4">
									<a class="icon icon-shape rounded-circle mb-0 mr-3" href="#">
										<i class="fas fa-volume-up bg-light"></i>
									</a>
								</div>
								<div class="col-4">
									<a class="icon icon-shape rounded-circle text-white mb-0 mr-3" href="#" data-dismiss="modal" aria-label="بستن">
										<i class="fas fa-phone text-white bg-success"></i>
									</a>
								</div>
								<div class="col-4">
									<a class="icon icon-shape  rounded-circle mb-0 mr-3" href="#">
										<i class="fas fa-microphone-slash bg-light"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- modal -->
		<!-- Footer opened -->
		<div class="main-footer ht-40">
			<div class="container-fluid pd-t-0-f ht-100p">
				<span></span>
			</div>
		</div>
		<!-- Footer closed -->
		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
		<!-- JQuery min js -->
		<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
		<!-- Bootstrap Bundle js -->
		<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
		<!-- Moment js -->
		<script src="<?= base_url('assets/plugins/moment/moment.js') ?>"></script>
		<!-- Rating js-->
		<script src="<?= base_url('assets/plugins/rating/jquery.rating-stars.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/rating/jquery.barrating.js') ?>"></script>
		<!--Internal  Perfect-scrollbar js -->
		<!-- <script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> -->
		<!-- <script src="assets/plugins/perfect-scrollbar/p-scroll.js"></script> -->
		<!--Internal Sparkline js -->
		<script src="<?= base_url('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') ?>"></script>
		<!-- Custom Scroll bar Js-->
		<script src="<?= base_url('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
		<!-- right-sidebar js -->
		<script src="<?= base_url('assets/plugins/sidebar/sidebar-rtl.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/sidebar/sidebar-custom.js') ?>"></script>
		<!-- Eva-icons js -->
		<script src="<?= base_url('assets/js/eva-icons.min.js') ?>"></script>
		<!--Internal  Chart.bundle js -->
		<!--<script src="<?= base_url('assets/plugins/chart.js/Chart.bundle.min.js') ?>"></script>-->
		<!-- Moment js -->
		 <script src="assets/plugins/raphael/raphael.min.js"></script> 
		<!--Internal  Flot js-->
		<script src="<?= base_url('assets/plugins/jquery.flot/jquery.flot.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/jquery.flot/jquery.flot.pie.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/jquery.flot/jquery.flot.resize.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/jquery.flot/jquery.flot.categories.js') ?>"></script>
		<script src="<?= base_url('assets/js/dashboard.sampledata.js') ?>"></script>
		<script src="<?= base_url('assets/js/chart.flot.sampledata.js') ?>"></script>
		<!--Internal Apexchart js-->
		<!-- <script src="assets/js/apexcharts.js"></script> -->
		<!-- Internal Map -->
		<!-- <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
		<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
		<script src="assets/js/modal-popup.js"></script> -->
		<!--Internal  index js -->
		<script src="<?= base_url('assets/js/index.js') ?>"></script>
		<!-- <script src="assets/js/jquery.vmap.sampledata.js"></script> -->
		<!-- Sticky js -->
		<script src="<?= base_url('assets/js/sticky.js') ?>"></script>
		<!-- custom js -->
		<script src="<?= base_url('assets/js/custom.js') ?>"></script>
		<!-- Left-menu js-->
		<script src="<?= base_url('assets/plugins/side-menu/sidemenu.js') ?>"></script>
		<!-- Switcher js -->
		<script src="<?= base_url('assets/switcher/js/switcher-rtl.js') ?>"></script>
		<!-- notify -->
		<script src="<?= base_url('assets/plugins/notify/js/notifIt.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/notify/js/notifit-custom.js') ?>"></script>
		<!-- calender -->
		<!-- <script src="<?= base_url('assets/plugins/fullcalendar/fullcalendar.min.js') ?>"></script> -->
		<!-- <script src="<?= base_url('assets/js/app-calendar.js') ?>"></script>
		<script src="<?= base_url('assets/js/app-calendar-events.js') ?>"></script> -->
		<!-- costum -->
		<script>
			function emptyInput(el){
				$(el).parent().find('input').val('');
				return true;
			}
			function sendAjax(dataSend,urlSend,tag=''){
				$.ajax({
					method:'post',
					data:dataSend,
					url:urlSend,
					success:function(e){
						if(tag!==''){
                    	    $(tag).html(e);
							return not10();
        			    }else{
							if(e==1){
								window.location.reload();
							}else{
								// return not9(e);
								return not11();
							}
						}
					},error:function(){
						return not8();
					}
				});
				return true;
			}
			<?php if(!empty($id) && intval($id)>0){ ?>
				function addCompany(el,event){
					event.preventDefault();
					let n=$('#company-title').val(),d=$('#company-description').val(),u=$('#company-url').val(),f=$(el).find('.file-name').val(),t=$(el).children('input[name=type]:checked').val(),uId=<?= intval($id) ?>;
					if(typeof(t)=="undefined") t=0;
					if(n!==''&&t!==''&&d!==''&&uId!=='')
						return sendAjax({file:f,title:n,url:u,type:t,des:d,user:uId},window.location.origin+'/company/dashbord/add','');
					else
						return not1();
				}
				function showCalenderPosition(el){
					$(el).parent().parent().children().addClass('d-none');
					$(el).parent().parent().children('.calender-position').removeClass('d-none');
					return true;
				}
				function hideCalenderPosition(el){
					$(el).parent().parent().parent().parent().children().removeClass('d-none');
					$(el).parent().parent().parent().parent().children('.calender-position').addClass('d-none');
					return true;
				}
				function showPositionOrder(el){
					$(el).parent().parent().parent().children().addClass('d-none');
					$(el).parent().parent().parent().children('.order').removeClass('d-none');
					return true;
				}
				function hidePositionOrder(el){
					$(el).parent().parent().parent().children().removeClass('d-none');
					$(el).parent().parent().parent().children('.order').addClass('d-none');
					return true;
				}
				function showCompanyOtherProduct(el){
					$(el).parent().parent().children().addClass('d-none');
					$(el).parent().parent().children('.company-other-product').removeClass('d-none');
					return true;
				}
				function hideCompanyOtherProduct(el){
					$(el).parent().parent().parent().parent().children().removeClass('d-none');
					$(el).parent().parent().parent().parent().children('.company-other-product').addClass('d-none');
					return true;
				}
				function showPayInfo(el){
					$(el).parent().parent().children().addClass('d-none');
					$(el).parent().parent().children('.pay-info').removeClass('d-none');
					return true;
				}
				function hidePayInfo(el){
					$(el).parent().parent().parent().children().removeClass('d-none');
					$(el).parent().parent().parent().children('.pay-info').addClass('d-none');
					return true;
				}
				function showOrderSuggest(el){
					$(el).parent().parent().parent().children().addClass('d-none')
					$(el).parent().parent().parent().children('.suggest').removeClass('d-none');
					return true;
				}
				function HideOrderSuggest(el){
					$(el).parent().parent().parent().children().removeClass('d-none')
					$(el).parent().parent().parent().children('.suggest').addClass('d-none');
					return true;
				}
				function addToPay(el,id){
					
				}
				function holdoverPackage(){

				}
			<?php } ?>
			// map 
			<?php if(!empty($map)){ ?>
				var myPro = JSON.stringify(geojson.products),
				myPos =JSON.stringify(geojson.position),projson=[],posjson=[];
				projson = JSON.parse(myPro);
				posjson = JSON.parse(myPos);
				for (const [key, value] of Object.entries(projson)) {
					value.mark.forEach(function (marker) {
						var el = document.createElement('div');
						el.className = 'marker product-marker all-markers product-marker-count-'+marker.count;
						el.style.backgroundImage ='url("'+marker.icon.url+'")';
						el.style.width = marker.icon.iconSize[0] + 'px';
						el.style.height = marker.icon.iconSize[1] + 'px';
						markers[marker.count]=new maptilersdk.Marker(el).setLngLat(marker.coordinates).setPopup(new maptilersdk.Popup().setHTML('<input type="hidden" class="categoryId" value="'+marker.categoryId+'"><input type="hidden" class="companyId" value="'+marker.companyId+'"><input type="hidden" class="positionId" value="'+marker.positionId+'"><input type="hidden" class="productId" value="'+marker.productId+'">'+marker.message+marker.option)).addTo(map);
					});
				}
				for (const [key, value] of Object.entries(posjson)) {
					value.mark.forEach(function (marker) {
						var el = document.createElement('div');
						el.className = 'marker position-marker all-markers position-marker-count-'+marker.count;
						el.style.backgroundImage ='url('+marker.icon.url+')';
						el.style.width = marker.icon.iconSize[0] + 'px';
						el.style.height = marker.icon.iconSize[1] + 'px';
						markers[marker.count]=new maptilersdk.Marker(el).setLngLat(marker.coordinates).setPopup(new maptilersdk.Popup().setHTML('<input type="hidden" class="categoryId" value="'+marker.categoryId+'"><input type="hidden" class="companyId" value="'+marker.companyId+'"><input type="hidden" class="positionId" value="'+marker.positionId+'"><input type="hidden" class="productId" value="'+marker.productId+'">'+marker.message+marker.option)).addTo(map);
					});
				}
				function addMarkerToMap(e){
					var f=0,m=0,
					ln1=e.lngLat.lng,
					lt1=e.lngLat.lat;
					Object.values(markers).forEach(function (marker) {
						var ln2=marker._lngLat.lng,
						lt2=marker._lngLat.lat,lt,ln;
						lt=lt1-lt2;
						ln=ln1-ln2;
						if(ln<0.002 && lt<0.002){if(ln>-0.002 && lt>-0.002){f=1;}}
					})
					if(f==1){
						return false;
					}else{
					Object.keys(markers).forEach(function (index){
						if(index>m){
							m=index;
						}
					})
					m++;
					markers[m]=new maptilersdk.Marker().setLngLat([ln1,lt1]).setPopup(new maptilersdk.Popup().setHTML("<a onclick='delMarker("+m+","+ln1+","+lt1+");'>حذف</a>")).addTo(map);
						return true;
					}
				}
			<?php } ?>
		</script>
	</body>
</html>