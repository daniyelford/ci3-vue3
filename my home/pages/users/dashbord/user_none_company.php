<?php if(!empty($data)){ $date=new JDF(); ?>
    <div>
        <?php foreach($data as $a){ ?>
            <div>
                <input type="hidden" value="<?= $a['id'] ?>">
                <input type="hidden" value="<?= $a['status'] ?>">
                <?php if(!empty($a['info']) && !empty($a['info']['0'])){ ?>
                    <div>
                        <?php if(!empty($a['info']['0']['name'])){ ?>
                            <?= $a['info']['0']['name'] ?>
                        <?php } ?>
                        <?php if(!empty($a['info']['0']['family'])){ ?>
                            <?= $a['info']['0']['family'] ?>
                        <?php } ?>
                        <?php if(!empty($a['info']['0']['image'])){ ?>
                            <img src="<?= $a['info']['0']['image'] ?>">
                        <?php } ?>
                        <?php if(!empty($a['info']['0']['gmail'])){ ?>
                            <?= $a['info']['0']['gmail'] ?>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if(!empty($a['login'])){ ?>
                    <div>
                        <?php foreach($a['login'] as $b){
                            if(!empty($b['login'])&&intval($b['login'])>0){ ?>
                                <?php if(!empty($b['city'])){?>
                                    <?= $b['city'] ?>
                                <?php } ?>
                                <?php if(!empty($b['country'])){?>
                                    <?= $b['country'] ?>
                                <?php } ?>
                                <?php if(!empty($b['time'])){?>
                                    <?= $date->jdate('Y/md H:i',strtotime($b['time'])) ?>
                                <?php } ?>
                        <?php } 
                        } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>