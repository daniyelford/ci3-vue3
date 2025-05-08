<?php if(!empty($data)){
    foreach($data as $d){
        echo (!empty($d['style'])?'<style>'.$d['style'].'</style>':'');
?>

<div class="col-12 mx-auto">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between hydr">
                <h3><?= $d['title']?></h3>
                <?= (!empty($d['date'])? '<h6 class="pull-left text-end">'.date('Y/m/d',strtotime($d['date'])).'</h6>':'') ?>
                <?= (!empty($d['des'])?'<h5>'.$d['des'].'</h5>':'') ?>
            </div>
        </div>
        <div class="card-body">
               
                <?= (!empty($pic)?$pic:'') ?>
              <br>
                    <?= $d['text'] ?>
        </div>
    </div>
</div>
<?php } } ?>