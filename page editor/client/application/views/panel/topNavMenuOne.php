<?php
$data = array("class" => "navbar-form", "method" => "post", "role" => "search");
$formOpen = form_open();
$formOpen1 = form_open(array(), $data);
$formSearch = form_input(array('type' => 'search', 'name' => 'search', 'class' => 'form-control', 'placeholder' => 'هر چیزی را جستجو کنید ...'));
$formSearch1 = form_input(array('type' => 'search', 'name' => 'search1', 'class' => 'form-control', 'placeholder' => 'هر چیزی را جستجو کنید ...'));
$btnSearch = form_button(array("content" => "<i class='fas fa-search d-none d-md-block'></i>", "name" => "btnSearch", "value" => "btnSearch", "type" => "submit", "class" => "btn"));
$btnReset = form_button(array("content" => "<i class='fas fa-times'></i>", "name" => "btnReset", "value" => "btnReset", "type" => "reset", "class" => "btn btn-default"));
$btnSearch1 = form_button(array("content" => "<svg xmlns='http://www.w3.org/2000/svg' class='header-icon-svgs'  style='color:black;width:20px;height:20px;' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
												 <circle cx='11' cy='11' r='8'></circle>
												 <line x1='21' y1='21' x2='16.65' y2='16.65'></line>
												 </svg>", "name" => "btnSearch1", "value" => "btnSearch1", "type" => "submit", "class" => "btn btn-default nav-link resp-btn"));
$formClose = form_close();
//another var

$company_name='پرتال ساز علاءالدین';
$company_name_ex='علاءالدین';
$answerPicProfile = '3.jpg';
$numberMassageUnread = '4';
$usernameMassageSender = 'ali';
$contentOfMassage = 'hi man';
$timeMassageSend = 'friday';
$allMassageLink = '#';
$numberNewsUnread = '4';
$titleNews = 'news';
//$levelNews = 'pink';
$levelNews = 'danger';
//$levelNews = 'warning';
//$levelNews = 'primary';

// $levelNews = 'success';
$allNewsLink = '';
$userManager = '#';

$message = '';

?>
<style>
    .comp{
        float: left;
        line-height: 66px;
        padding-right: 10px;
        font-size:25px;
    }
    .comphide{
        float:left;
        font-size:22px;
        line-height:70px;
        display:none;
    }
    @media screen and (max-width: 500px){
        .comp{
            display:none;
        }
        .comphide{
            display:block;
        }
    }
    @media screen and (max-width: 350px){
          .main-header-notification{
              display:none;
          }
    }
    @media screen and (max-width: 300px){
        .main-header-message {
            display:none;
        }
    }
    
    @media screen and (max-width: 260px){
        .comphide{
            display:none;
        }
    }

</style>
<style>
    .sub-menu li a:before {
        display:none !important;
    }
    .horizontalMenu > .horizontalMenu-list > li > ul.sub-menu > li > a {
        padding: 8px 20px;
        color:black !important;
    }
    .dropdown-item svg{
        height:50px !important;
    }
    .marginSide{
        margin-right:235px !important;
    }
</style>
<div class="main-content app-content" style="margin:0px;">
	<div class="main-header sticky side-header nav nav-item" style="padding-right:0px !important;">
		<div class="container-fluid">
			<div class="main-header-left">
			    <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a>
				<div class="logo">
					<a href="#"><img src="<?= base_url() ?>assets/img/brand/<?= $icon1 ?>" style="display:inline-block;width:71px;height:71px" alt="<?= $icon1Des ?>"></a>
        			<h1 class='comp'><?= (!empty(COMPANY)?COMPANY:$company_name) ?></h1>
		        	<h1 class='comphide'><?= (!empty(COMPANY)?COMPANY:$company_name_ex) ?></h1>
				</div>
				<?php echo (!empty($right_btn)?$right_btn:'');?>
		        <button class="navbar-toggle collapse in" data-toggle="collapse" id="leftSlider-toggle-2" style="border: none;background-color: #00008b00;outline: none;">
		            <svg width="32px" height="32px" viewBox="0 0 32 32" data-name="Layer 2" id="Layer_2" xmlns="http://www.w3.org/2000/svg"><title/><path d="M11.43,12.67c3.16,0,6.32,0,9.48,0a1.25,1.25,0,0,0,0-2.5c-3.16,0-6.32,0-9.48,0A1.25,1.25,0,0,0,11.43,12.67Z"/><path d="M11.35,17.23q4.81.11,9.63-.05c1.61-.05,1.62-2.55,0-2.5q-4.82.15-9.63.05A1.25,1.25,0,0,0,11.35,17.23Z"/><path d="M21.06,19q-4.72.21-9.47.35c-1.61.05-1.61,2.55,0,2.5q4.74-.13,9.47-.35C22.67,21.4,22.67,18.9,21.06,19Z"/></svg>
                </button>
				<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block" style="">
					<?= $formOpen ?>
					<?= $formSearch ?>
					<?= $btnSearch ?>
					<?= $formClose ?>
				</div>
			</div>
			<div class="main-header-right">
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
				    <?php if(isset($_SESSION['active']) && $_SESSION['active'] == 1){?>
					<div class="dropdown nav-item main-header-message" >
						<a class="new nav-link" href="#" style='line-height: 45px;'>
							<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" style='color:black;width:20px;height:20px;' viewBox="0 0 24 24"
								 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								 stroke-linejoin="round">
								<path
										d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
								<polyline points="22,6 12,13 2,6"></polyline>
							</svg>
							<?= $ticket_html ?>
						</a>	
					</div>
					<?php }?>
					<?php if(isset($_SESSION['active']) && $_SESSION['active'] == 1){?>
					<div class="dropdown nav-item main-header-notification">
						<a class="new nav-link" href="#" style='line-height: 45px;'>
							<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" style='color:black;width:20px;height:20px;' viewBox="0 0 24 24"
								 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								 stroke-linejoin="round">
								<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
								<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
							</svg>
						</a>
						<?= $news_html ?>
						
					</div>
					<?php }?>
					<div class="nav-item full-screen fullscreen-button">
						<a class="new nav-link full-screen-link" style="padding-top:3px;" href="#">
							<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
								 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								 stroke-linejoin="round">
								<path
										d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
							</svg>
						</a>
					</div>
					
					
					<div class="dropdown main-profile-menu nav nav-item nav-link my-auto">
						<a class="profile-user d-flex" href="#"><img alt="profile" class="my-auto" style="width:22px;height:22px;" src="<?= base_url() ?>assets/img/faces/<?= $profilePicture ?>"></a>
						<div class="dropdown-menu" style="margin-left: -15px;margin-top: -8px;">
							<div class="main-header-profile bg-primary p-3">
								<div class="d-flex wd-100p">
									<div class="main-img-user"><img alt="" src="<?= base_url() ?>assets/img/faces/<?= $profilePicture ?>"></div>
									<div class="mr-3 my-auto">
										<h6><?= $username ?></h6>
										<span><?= $rule_users ?></span>
									</div>
								</div>
							</div>
						<?php if(isset($_SESSION['active']) && $_SESSION['active'] == 1){?>
							<a class="dropdown-item" href="<?php echo base_url();?>ticket"><i class="bx bx-envelope"></i>پیام
								های کاربران</a>
							<a class="dropdown-item" href="<?php echo base_url();?>news"><i class="bx bxs-inbox"></i>صندوق
								خبری</a>
						<?php }  if(isset($_SESSION['active']) && $_SESSION['role'] == 'admin'){?>
							<a class="dropdown-item" href="<?php echo base_url();?>user"><i class="bx bx-slider-alt"></i> تنظیمات
								حساب های کاربران</a>
								<?php }?>
								<?php if(isset($_SESSION['active']) && $_SESSION['active'] == 1){?>
							<a class="dropdown-item" href="<?php echo base_url();?>user/edit_me"><i class="bx bx-cog"></i>ویرایش حساب
								کاربری من</a>
                            <a class="dropdown-item" href="<?php echo base_url();?>user/change_password"><i class="bx bx-cog"></i>
                                تغییر نام و رمز کاربری
						    </a>								
							<?php }?>
							<?php if(isset($_SESSION['active']) && $_SESSION['active'] == 1){?>
							<a class="dropdown-item" href="<?php echo base_url().'auth'.DS.'logout' ?>"><i class="bx bx-log-out"></i> خروج از پروفایل</a>
							<?php }else{?>
							<a class="dropdown-item" href="<?php echo base_url().'auth'?>"><i class="bx bx-log-out"></i>ورود به پروفایل </a>
							<?php }?>
						</div>
					</div>
					<?php echo (!empty($left_btn)?$left_btn:'');?>
				</div>
			</div>
			
		</div>
		<?php if(isset($_SESSION['active']) && $_SESSION['active'] == 1 && $_SESSION['role'] == 'admin'){
		    include_once('top_manage.php');
		}?>
	</div>