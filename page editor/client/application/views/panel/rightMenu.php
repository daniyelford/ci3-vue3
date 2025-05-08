<?php
if(isset($data)&&!empty($data)){
$icon1='logo1.png';
$icon1Des='';
$num = 1;//in adade knare menuee b many jadidn afzode shode
?>
<style>
    .cccc{
            width: 120px;
    height: 86px;
    margin-top: -28px;
    }
    .imm{
        width:85px;
    }
</style>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside style="float:right;margin:-8px 0;padding:0;color: #14112d;width: 240px;max-height: 100%;background-color:white;height:537px;z-index:0;overflow-y: scroll;" class="ml-5">
    <!--pic company-->
	<div class="main-sidebar-header active">
		<a class="desktop-logo logo-light active" title="aladdin" href="#"><img
					src="<?= base_url() ?>assets/img/brand/<?= $icon1 ?>"
					class="main-logo cccc" alt="<?= $icon1Des ?>"></a>
		<a class="desktop-logo logo-dark active" title="aladdin" href="#"><img
		src="<?= base_url() ?>assets/img/brand/<?= $icon1 ?>"
					class="main-logo dark-theme cccc" alt="<?= $icon1Des ?>">
		</a>
	</div>
	<??>
	<div class="main-sidebar-header active mt-5 text-center mx-auto" style="position: fixed;top: 134.4px;background: #ebd9d9;height: 150px;">
	<div class="mt-3 text-center">
	    <img alt="user-img" class="imm" style="position: fixed;bottom: 55px;right: 73px;" src="<?= base_url() ?>assets/img/faces/<?= $profilePicture ?>">
		<span class="avatar-status profile-status bg-green"style="width: 15px;height: 15px;position: fixed;bottom: 0;left: 85px;"></span>
	</div>
	<div style="margin-top: 70px;margin-left: auto;margin-right: auto;">
		<h4 class="font-weight-semibold mt-3 mb-0"><?= $username ?></h4>
		<span class="mb-0 text-muted"><?= $rule_users ?></span>
	</div>
	<div class="main-sidemenu mt-5" style="position: fixed;top: 115px;width: 240px;padding-right: 10px;right: 0;border-top-style: none;overflow-y: auto;">
		<ul class="side-menu" style="width: 100%;">
		    <?php foreach($data as $key){
		        echo $key;
		    }?>
		</ul>
	</div>
</aside>
<?php }?>