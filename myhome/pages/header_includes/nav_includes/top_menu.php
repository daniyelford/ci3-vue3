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
<div class="nav nav-item  navbar-nav-right ml-auto">
    <!-- search mobile -->
<!--<div class="nav-link" id="bs-example-navbar-collapse-1">
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
	</div> -->
	<!-- search mobile -->
	<!-- setting menus -->
    <?php if(empty($search)){ ?>
	    <div class="main-header-message">
            <a href="<?= base_url('search') ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </a>
        </div>
    <?php }else{ ?>
        <div class="main-header-message">
            <a href="<?= base_url('exit_page') ?>">
                <img class="wd-20" src="<?= base_url('assets/svg/icon/home.svg') ?>">
                <span  class="pulse-danger"></span>
            </a>
        </div>
    <?php } 
    if(!empty($id) && intval($id)>0){ ?>
	    <div class="main-header-message">
		    <a href="<?= (!empty($chat)&&$chat?base_url():base_url('chat')) ?>">
    		    <img class='wd-20' src="<?= (!empty($chat)&&$chat?base_url('assets/svg/icon/home.svg'):base_url('assets/svg/icon/inbox.svg')) ?>">
    			<span class="<?= (!empty($chat)&&$chat?'pulse-danger':'pulse bg-secondary') ?>"></span>
    		</a>
		</div>
	<?php } ?>
	<div class="main-header-notification">
	    <a href="<?= (!empty($map_page) && $map_page?base_url('exit_page'):base_url('map')) ?>">
    	    <img class='wd-20' src="<?= (!empty($map_page) && $map_page?base_url('assets/svg/icon/home.svg'):base_url('assets/svg/product/map.svg')) ?>">
    		<span class="<?= (!empty($map_page) && $map_page?'pulse-danger':'pulse') ?>"></span>
    	</a>
	</div>
	<!-- setting menus -->
	<div class="nav-item full-screen fullscreen-button">
	    <a class="new nav-link full-screen-link" href="#">
    	    <img class='wd-20' src="<?= base_url('assets/svg/icon/fullscreen.svg') ?>">
		</a>
	</div>
	<div class="dropdown main-profile-menu nav nav-item nav-link">
	    <a class="profile-user d-flex">
		    <img style="height: 40px;width: auto;" alt="user image" src="<?= (!empty($user_info['image'])?$user_info['image']:base_url('assets/svg/user/login.svg')) ?>">
			<span class="pulse-danger d-none loginErrorLog"></span>
			<?= (!empty($id) && intval($id)>0 && !empty($has_auth_info_error) && $has_auth_info_error?'<span class="pulse-danger authInfoErrorLog"></span>':'') ?>
			
		</a>
		<div class="dropdown-menu">
		    <div class="main-header-profile bg-primary p-0">
			    <div class="d-flex wd-100p">
				    <div class="">
					    <img alt="user image" src="<?= (!empty($user_info['image'])?$user_info['image']:base_url('assets/svg/user/login.svg')) ?>" style="height: 55px;width: auto;">
						<span class="pulse-danger loginErrorLog d-none"></span>
					</div>
					<div class="mr-3 my-auto">
					    <?php if(!empty($id) && intval($id)>0){ ?>
					        <h6>
					            <?= (!empty($user_info['name'])?$user_info['name']:'').(!empty($user_info['family'])?' '.$user_info['family']:'') ?>
					        </h6>
					    <?php }else{ ?>
					        <small>
					            از یک مورد برای ورود استفاده کنید
					        </small>
					    <?php } ?>
						<span><?= (!empty($user_info['role'])?$user_info['role']:'') ?></span>
					</div>
				</div>
			</div>
			<?php if(!empty($id) && intval($id)>0){ ?>
			    <a class="dropdown-item" href="<?= base_url('user_setting') ?>">
				    <i class="bx bx-user-circle"></i>
					<?= (!empty($has_auth_info_error) && $has_auth_info_error?'<span class="pulse-danger authInfoErrorLog"></span>':'') ?>
					حساب کاربری
				</a>
				<a class="dropdown-item" href="<?= base_url('wallet') ?>">
				    <i class="bx bx-dollar"></i>کیف پول
				</a>
				<a href="<?= base_url('shopping') ?>" class="dropdown-item">
        			<!--<img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/company/add.svg') ?>">-->
        			<i class="si si-basket-loaded tx-20-f"></i>
        			سبد خرید
        		</a>
        		<a href="<?= base_url('reserve') ?>" class="dropdown-item">
        			<!--<img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/company/add.svg') ?>">-->
        			<i class="si si-basket-loaded tx-20-f"></i>
        			سبد رزرو
        		</a>
				<?php if(!empty($id) && intval($id)===1){ ?>
    			    <a href="<?= base_url('all_category_manager') ?>" class="dropdown-item">
    				    <i class="fe fe-align-right"></i>دسته بندی
    				</a>
    				<a href="<?= base_url('all_company_manager') ?>" class="dropdown-item">
    				    <i class="fe fe-align-right"></i>کسب و کار ها
    				</a>
    				<a href="<?= base_url('all_product_manager') ?>" class="dropdown-item">
    				    <i class="fe fe-align-right"></i>محصولات
    				</a>
    				<a href="<?= base_url('all_position_manager') ?>" class="dropdown-item">
    				    <i class="fe fe-align-right"></i>جایگاه ها
    				</a>
    				<a href="<?= base_url('all_user_manager') ?>" class="dropdown-item">
    				    <i class="fe fe-align-right"></i>نفرات
    				</a>
    				<a href="<?= base_url('all_support_manager') ?>" class="dropdown-item">
    				    <i class="fe fe-align-right"></i>پشتیبانی
    				</a>
    				<a href="<?= base_url('all_wallet_changeing') ?>" class="dropdown-item">
    				    <i class="fe fe-align-right"></i>استعلام کارت ها
    				</a>
    				<a href="<?= base_url('all_pay_request') ?>" class="dropdown-item">
    				    <i class="fe fe-align-right"></i>درخواست های برداشت
    				</a>
				<?php } ?>
				<a class="dropdown-item" href="<?= base_url('logout') ?>">
				    <i class="bx bx-log-out"></i> خروج از سیستم
				</a>
			<?php }else{ ?>
				<a class="add-user dropdown-item" data-target="#modaldemo6" data-toggle="modal" href="#">
				    <img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/user/add-user.svg')?>">
					افزودن حساب کاربری
				</a>
			    <a class="google-login dropdown-item" href="<?= base_url('users/users/auto_auth/google') ?>">
				    <img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/user/google-login.svg') ?>">
					ورود با حساب gmail
				</a>
				<a class="costum-login dropdown-item" data-target="#select9modal" data-toggle="modal" href="#">
				    <img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/user/phone-luck.svg') ?>">
                    ورود با شماره همراه
				</a>
				<a class="google-login dropdown-item" onclick="webauthnLogin();">
				    <img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/user/google-login.svg') ?>">
					webAuthn
				</a>
				<!-- login -->
				<!--<a class="costum-login dropdown-item" data-target="#select2modal" data-toggle="modal" href="#">-->
				<!--    <img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/user/costum-login.svg') ?>">-->
				<!--	ورود با حساب کاربری و رمز عبور-->
				<!--</a>-->
				<!-- login -->
				<!-- add user -->
				<!-- add user -->
			<?php } ?>
		</div>
	</div>
	<!-- Sidebar-right -->
	<?php if(!empty($id) && intval($id)>0){ ?>
	    <div class="dropdown main-header-message right-toggle">
		    <a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
			    <img class='wd-20' src="<?= base_url('assets/svg/icon/menu.svg') ?>">
				<span class="pulse-danger d-none companyManagerShowErrorLog"></span>
				<span class="pulse bg-warning" id="reserveManagerShowErrorLog"></span>
			</a>
		</div>
	<?php } ?>
	<!-- Sidebar-right -->
</div>