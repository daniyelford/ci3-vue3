<?php 
    if(!empty($data)){
        foreach($data as $d){
    ?>
<div class="col-xl-4 col-lg-6 col-md-12">
    <div class="card mb-4 box-shadow">
        <?= (!empty($pic)?$pic:'') ?>
        <div class="card-body">
            <?= (!empty($d['title'])?'<p class="card-text my-1">'.$d['title'].'</p>':'') ?>
            <?= (!empty($d['des'])?'<p class="card-text my-1">'.$d['des'].'</p>':'') ?>
            <?= (!empty($d['content'])?'<p class="card-text">'.$d['content'].'</p>':'') ?>
                            <?= (!empty($d['date'])?'<small class="text-muted"> درج پست :'.date('Y/m/d',strtotime($d['date'])).'</small><br>':'') ?>
                <?= (!empty($d['exp'])?'<small class="text-muted"> انقضای پست :'.date('Y/m/d',strtotime($d['exp'])).'</small><br>':'') ?>
                <hr>
            <?= (!empty($d['price']) && !empty($d['n_p'])?'<p class="card-text d-inline mt-1">قیمت اولیه :<del>'.$d['price'].'</del></p><p class="card-text mt-1 d-inline pull-left">قیمت با تخفیف :'.$d['n_p'].'</p>':(!empty($d['price']) && empty($d['n_p'])?'<p class="card-text mt-1">قیمت :'.$d['price'].'</p>':'')) ?>
            <div class="d-flex justify-content-between align-items-center mt-1" style="width: 100%;">
                <a class="btn btn-primary pd-x-25 text-center rounded-10 box-shadow-pink text-white btn-block" href="<?= base_url()?>post/show_post/<?= $d['id']?>">مشاهده</a>
            </div>
        </div>
    </div>
</div>
<?php }
}?>








<!---->


