<?php 
if(!empty($data)){
    foreach($data as $d){
        switch($d['size']){
            case '1':
                $s='col-xl-12 col-lg-12 col-md-12 col-xm-12';
                break;
                
            case '2':
                $s='col-xl-10 col-lg-10 col-md-10 col-xm-10';
                break;
                
            case '3':
                $s='col-xl-8 col-lg-8 col-md-8 col-xm-8';
                break;
                
            case '4':
                $s='col-xl-6 col-lg-6 col-md-6 col-xm-6';
                break;
                
            case '5':
                $s='col-xl-4 col-lg-4 col-md-4 col-xm-4';
                break;
                
            default:
                $s='col-xl-2 col-lg-2 col-md-2 col-xm-2';
                break;
        }
        echo (!empty($d['style'])?'<style>'.$d['style'].'</style>':'');
        echo (!empty($d['s_h'])?$d['s_h']:'');
?>
<div class="<?= $s ?>">
    <?= (!empty($d['link'])?'<a href="'.$d['link'].'">':'') ?>
        <div <?= (!empty($d['pic'])?'style="background-color:#fff;background-image: url('.base_url().'pic'.DS.$d['pic'].');"':'') ?> class="card overflow-hidden sales-card">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"><?= $d['title'] ?></h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
					<?= $d['content'] ?>
						</div>
					</div>
				</div>
			</div>
        </div>
    <?= (!empty($d['link'])?'</a>':'') ?>    
</div>
<?= (!empty($d['e_h'])?$d['e_h']:'') ?>
<?php }
}?>