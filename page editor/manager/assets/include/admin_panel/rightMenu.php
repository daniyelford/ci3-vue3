<?php
$rule_users = 'admin';
$username = 'danial';
$categoryMenu = "main";
$linkMenu = "#";
$titleMenu = "main";
$y = 'category';
$x = 'sathe dastresi menu';
$profilePicture = '20.jpg';
$num = 1;//in adade knare menuee b many jadidn afzode shode
$z = 'rabte menu ba menu madar';
$a = array();//
$h = "<li><a class='slide-item' href={$linkMenu}>{$titleMenu}</a></li>";
$g = "<ul class='slide-menu'>" . $h . "</ul>";

function mainMenu($case, $class)
{
	return "<ul class={$class}>" . $case . "</ul>";
}

$find = litlleMenu();
$mainMenu = mainMenu($find, 'slide-menu');

function litlleMenu()
{

}

//$case = "<li><a class='slide-item' href='" . $linkMenu . "'>" . $titleMenu . "</a>" . $f . "</li>";


?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
	<div class="main-sidebar-header active">
		<a class="desktop-logo logo-light active" title="aladdin" href="#"><img
					src="<?= base_url() ?>assets/img/brand/light.png"
					class="main-logo" width="130px" height="100px" alt="لوگو علاالدین"></a>
		<a class="desktop-logo logo-dark active" title="aladdin" href="#"><img
					src="<?= base_url() ?>assets/img/brand/darken.png"
					class="main-logo dark-theme" width="130px" height="100px"
					alt="لوگو علاالدین"></a>
		<a class="logo-icon mobile-logo icon-light active" title="aladdin" href="#"><img
					src="<?= base_url() ?>assets/img/brand/light.png"
					class="logo-icon" alt="لوگو علاالدین"></a>
		<a class="logo-icon mobile-logo icon-dark active" title="aladdin" href="#"><img
					src="<?= base_url() ?>assets/img/brand/darken.png" class="logo-icon dark-theme"
					alt="لوگو علاالدین"></a>
	</div>
	<div class="main-sidemenu">
		<div class="app-sidebar__user clearfix">
			<div class="dropdown user-pro-body">
				<div class="">
					<img alt="user-img" class="avatar avatar-xl brround"
						 src="<?= base_url() ?>assets/img/faces/<?= $profilePicture ?>"><span
							class="avatar-status profile-status bg-green"></span>
				</div>
				<div class="user-info">
					<h4 class="font-weight-semibold mt-3 mb-0"><?= $username ?></h4>
					<span class="mb-0 text-muted"><?= $rule_users ?></span>
				</div>
			</div>
		</div>
		<ul class="side-menu">
			<?php //if ($x==1){foreach(){?>
			<li class="side-item side-item-category">
				<?= $categoryMenu ?>
			</li>
			<?php //if ($categoryMenu==$y){?>
			<li class="slide">
				<a class="side-menu__item" href="<?= $linkMenu ?>" data-toggle="slide">
					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
						<path d="M0 0h24v24H0V0z" fill="none"></path>
						<path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"></path>
						<path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"></path>
					</svg>
					<span class="side-menu__label"><?= $titleMenu ?></span>
					<span
							class="badge badge-success side-badge"><?= $num ?>
					</span>
				</a>
				<?php //for($x=2;$x<count();$x++){ if ($z==$titleMenu){ ?>
				<ul class="slide-menu">
					<li><a class="slide-item" href="<?= $linkMenu ?>"><?= $titleMenu ?></a></li>
				</ul>
			</li>
			<?php //}}}} ?>


			<?php //for ($x = 1, $xMax = count($a);
			//	   $x <= $xMax;
			//	   $x++) {
			//if ($x == $num) { ?>
			<li class="side-item side-item-category"><?= $categoryMenu ?></li>
			<li class="slide">
				<a class="side-menu__item" href="#">
					<span class="side-menu__label"><?= $linkMenu ?> </span>
				</a>
				<?php //$num++;
				//						if ($x == $num) {
				//							echo $f;
				//						} else {
				//							echo $g;
				//						} ?>
			</li>
			<?php //}
			//			} ?>
		</ul>
	</div>
</aside>
