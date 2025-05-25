<?php
$c=$b=[];
array_walk($data['other'], function ($value, $key) use (&$c) {
    if(intval($value['info']['id'])>0&&!in_array(intval($value['info']['id']),$c)){
        $c[]=intval($value['info']['id']);
    }
});
array_walk($data['my'], function ($value, $key) use (&$b) {
    if(intval($value['info']['id'])>0&&!in_array(intval($value['info']['id']),$b)){
        $b[]=intval($value['info']['id']);
    }
});
?>
<div class="col-lg-4 col-xl-3 col-md-12 col-sm-12">
    <div class="card mg-b-20">
        <div class="main-content-left main-content-left-mail card-body">
            <?php if(!empty($company_users) && is_array($company_users)){ ?>
                <a class="btn btn-primary btn-compose" onclick="addMeet();" id="btnCompose">درخواست جدید</a>
        	<?php } ?>
        	<div class="main-mail-menu">
        	    <nav class="nav main-nav-column mg-b-20">
        		    <a class="nav-link other active" onclick="showOtherMeet(this);">
        			    <i class="bx bxs-inbox mx-1"></i>
        				درخواست های دیگران
        			    <span><?= (count($c)>0?count($c):'') ?></span>
        			</a>
        			<a class="nav-link my" onclick="showMyMeet(this);">
        			    <i class="bx bx-send mx-1"></i>
        				درخواست های من
        				<span><?= (count($b)>0?count($b):'') ?></span>
        			</a>
        		</nav>
    			<label class="main-content-label main-content-label-sm">دسترسی سریع</label>
    			<nav class="nav main-nav-column">
    			    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('company_one') ?>">
    				    <i class="bx bx-folder-open mx-1"></i>
    				کسب و کار مربوط</a>
    				<a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('company_manager') ?>">
    				    <i class="bx bx-slider-alt mx-1"></i>
    					همه کسب و کارها
    				</a>
    				<a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url() ?>">
    				    <i class="la la-home mx-1"></i>
    					خانه
    				</a>
    			</nav>
    		</div>
    	</div>
    </div>
</div>