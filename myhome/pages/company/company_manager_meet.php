<?php $date=new JDF();
if(!empty($my)){ ?>
    <div>
        <?php foreach($my as $b){ ?>
            <div>
                <input type="hidden" value="<?= $b['meet_id'] ?>">
                <div>
                    <input type="hidden" value="<?= $b['user_id'] ?>">
                    <input type="hidden" value="<?= $b['from_user_company_id'] ?>">
                    <?= (!empty($b['from']['name'])?$b['from']['name']:'') ?>
                    <?= (!empty($b['from']['family'])?$b['from']['family']:'') ?>
                    <?php if(!empty($b['from']['image'])){ ?>
                        <img src="<?= $b['from']['image'] ?>">
                    <?php } ?>
                </div>
                <div><?= $date->jdate('Y/m/d H:i',strtotime($b['time'])) ?></div>
                <div><?= $b['status'] ?></div>
                    <!--request time-->
                <?php if(!empty($b['info'])){ ?>
                    <input type="hidden" value="<?= $b['info']['id'] ?>">
                    <div><?= $b['info']['title'] ?></div>
                    <div><?= $b['info']['description'] ?></div>
                    <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['time'])) ?></div>
                    <?php if(!empty($b['info']['run_time'])){?>
                        <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['run_time'])) ?></div>
                    <?php } ?>
                <?php }else{ ?>
                    <a>accept</a>
                    <a>denied</a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php }
if(!empty($other)){ ?>
    <div>
        <?php foreach($other as $b){ ?>
            <div>
                <input type="hidden" value="<?= $b['meet_id'] ?>">
                <div>
                    <input type="hidden" value="<?= $b['user_id'] ?>">
                    <input type="hidden" value="<?= $b['from_user_company_id'] ?>">
                    <?= (!empty($b['from']['name'])?$b['from']['name']:'') ?>
                    <?= (!empty($b['from']['family'])?$b['from']['family']:'') ?>
                    <?php if(!empty($b['from']['image'])){ ?>
                        <img src="<?= $b['from']['image'] ?>">
                    <?php } ?>
                </div>
                <div><?= $date->jdate('Y/m/d H:i',strtotime($b['time'])) ?></div>
                <div><?= $b['status'] ?></div>
                    <!--request time-->
                <?php if(!empty($b['info'])){ ?>
                    <input type="hidden" value="<?= $b['info']['id'] ?>">
                    <div><?= $b['info']['title'] ?></div>
                    <div><?= $b['info']['description'] ?></div>
                    <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['time'])) ?></div>
                    <?php if(!empty($b['info']['run_time'])){?>
                        <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['run_time'])) ?></div>
                    <?php }
                } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>