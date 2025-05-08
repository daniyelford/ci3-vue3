<div class="container-fluid">
    <div class="main-header-left">
	    <div class="responsive-logo">
		    <a href="<?= ((!empty($map_page)&&$map_page)||(!empty($company_page)&&$company_page)||(!empty($search)&&$search)?base_url('exit_page'):base_url()) ?>"><img src="<?= base_url('assets/img/brand/logo.jpg') ?>" class="logo-1" alt="لوگو"></a>
			<a href="<?= ((!empty($map_page)&&$map_page)||(!empty($company_page)&&$company_page)||(!empty($search)&&$search)?base_url('exit_page'):base_url()) ?>"><img src="<?= base_url('assets/img/brand/logo-white.png') ?>" class="dark-logo-1" alt="لوگو"></a>
			<a href="<?= ((!empty($map_page)&&$map_page)||(!empty($company_page)&&$company_page)||(!empty($search)&&$search)?base_url('exit_page'):base_url()) ?>"><img src="<?= base_url('assets/img/brand/favicon.png') ?>" class="logo-2" alt="لوگو"></a>
			<a href="<?= ((!empty($map_page)&&$map_page)||(!empty($company_page)&&$company_page)||(!empty($search)&&$search)?base_url('exit_page'):base_url()) ?>"><img src="<?= base_url('assets/img/brand/favicon-white.png') ?>" class="dark-logo-2" alt="لوگو"></a>
		</div>
		<div class="app-sidebar__toggle" data-toggle="sidebar">
		    <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
			<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
		</div>
		<!-- search desktop -->
	    <!--<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">-->
		<!--	<input class="form-control" placeholder="هر چیزی را جستجو کنید ..." type="search"> -->
		<!--	<button class="btn" onclick="emptyInput(this);"><i class="fas fa-search d-none d-md-block"></i></button>-->
		<!--</div>-->
	</div>
	<div class="main-header-right">
        <?php $this->view('header_includes/nav_includes/top_menu') ?>
	</div>
</div>