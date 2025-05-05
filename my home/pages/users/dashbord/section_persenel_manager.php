<?php if(!empty($data)){ $date=new JDF(); ?>
    <div>
        <?php foreach($data as $a){ ?>
            <div>
                <input type="hidden" value="<?= $a['id'] ?>">
                <?php if(!empty($a['role'])){ ?>
                    <?= $a['role'] ?>
                <?php } ?>
                <?php if(!empty($a['info'])){ ?>
                    <div>
                        <?php if(!empty($a['info']['name'])){ ?>
                            <?= $a['info']['name'] ?>
                        <?php } ?>
                        <?php if(!empty($a['info']['family'])){ ?>
                            <?= $a['info']['family'] ?>
                        <?php } ?>
                        <?php if(!empty($a['info']['image'])){ ?>
                            <img src="<?= $a['info']['image'] ?>">
                        <?php } ?>
                        <?php if(!empty($a['info']['gmail'])){ ?>
                            <?= $a['info']['gmail'] ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>