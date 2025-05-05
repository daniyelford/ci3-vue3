<aside class="app-sidebar sidebar-scroll">
	<div class="main-sidebar-header active">
	    <a class="desktop-logo logo-light active" href="<?= ((!empty($map_page)&&$map_page)||(!empty($company_page)&&$company_page)||(!empty($search)&&$search)?base_url('exit_page'):base_url()) ?>"><img src="<?= base_url('assets/img/brand/logo.jpg') ?>" class="main-logo" alt="لوگو"></a>
		<a class="desktop-logo logo-dark active" href="<?= ((!empty($map_page)&&$map_page)||(!empty($company_page)&&$company_page)||(!empty($search)&&$search)?base_url('exit_page'):base_url()) ?>"><img src="<?= base_url('assets/img/brand/logo-white.png') ?>" class="main-logo dark-theme" alt="لوگو"></a>
		<a class="logo-icon mobile-logo icon-light active" href="<?= ((!empty($map_page)&&$map_page)||(!empty($company_page)&&$company_page)||(!empty($search)&&$search)?base_url('exit_page'):base_url()) ?>"><img src="<?= base_url('assets/img/brand/favicon.png') ?>" class="logo-icon" alt="لوگو"></a>
		<a class="logo-icon mobile-logo icon-dark active" href="<?= ((!empty($map_page)&&$map_page)||(!empty($company_page)&&$company_page)||(!empty($search)&&$search)?base_url('exit_page'):base_url()) ?>"><img src="<?= base_url('assets/img/brand/favicon-white.png') ?>" class="logo-icon dark-theme" alt="لوگو"></a>
	</div>
	<div class="main-sidemenu">
	    <!-- user info  -->
		<?php if(!empty($user_info)){ ?>
		    <div class="app-sidebar__user clearfix">
			    <div class="dropdown user-pro-body">
				    <div class="">
					    <a href="<?= base_url('user_setting') ?>">
							<img alt="user-img" style="height: 70px;width: auto;" class="avatar brround" src="<?= (!empty($user_info['image'])?$user_info['image']:base_url('assets/svg/user/login.svg')) ?>">
							<span class="avatar-status profile-status bg-green"></span>
						</a>
					</div>
					<div class="user-info">
					    <h4 class="font-weight-semibold mt-3 mb-0"><?= (!empty($user_info['name'])?$user_info['name']:'').(!empty($user_info['family'])?' '.$user_info['family']:'') ?></h4>
					</div>
				</div>
			</div>
		<?php }
	    //  user info  
        // 	category 
		if(!empty($category)){ ?>
			<ul class="side-menu">
			    <?= $category ?>
			</ul>
		<?php } ?>
		<!-- category -->
	</div>
</aside>