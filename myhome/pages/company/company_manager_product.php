<?php if(!empty($data)){ ?>
    <div>
        <?php foreach($data as $a){ ?>
            <div>
                <div>
                    <?php if(!empty($a['category'])){ ?>
                        <span>
                            <?php if(!empty($a['category']['icon'])){ ?>
                                <img src="<?= base_url() ?>assets/svg/<?= $a['category']['icon'] ?>">
                            <?php } ?>
                            <div><?= $a['category']['title'] ?></div>
                        </span>
                    <?php } ?>
                    <a>category setting</a>
                </div>
                <div>
                    <?php if(!empty($a['info'])){ ?>
                        <input type="hidden" value="<?= $a['info']['id'] ?>">
                        <div><?= $a['info']['key'] ?></div>
                        <div><?= (!empty($a['info']['title'])?$a['info']['title']:'-') ?></div>
                        <div><?= (!empty($a['info']['description'])?$a['info']['description']:'-') ?></div>
                    <?php } ?>
                    <a>edit</a>
                    <a>status</a>
                    <a>delete</a>
                </div>
                <div>
                    <?php if(!empty($a['key_value'])){ ?>
                        <div><?= $a['key_value'] ?></div>
                    <?php } ?>
                    <a>key value setting</a>
                </div>
                <div>
                    <?php if(!empty($a['tel'])){ ?>
                        <div><?= $a['tel'] ?></div>
                    <?php } ?>
                    <a>tel setting</a>
                </div>
                <div>
                    <?php if(!empty($a['image'])){ ?>
                        <div><?= $a['image'] ?></div>
                    <?php } ?>
                    <a>image setting</a>
                </div>
                <div>
                    <?php if(!empty($a['video'])){ ?>
                        <div><?= $a['video'] ?></div>
                    <?php } ?>
                    <a>video setting</a>
                </div>
                <div>
                    <?php if(!empty($a['map'])){ ?>
                        <div><?= $a['map'] ?></div>
                    <?php } ?>
                    <a>map setting</a>
                </div>
                <div>
                    <?php if(!empty($a['chat'])){ ?>
                        <div><?= $a['chat'] ?></div>
                    <?php } ?>
                    <a>chat setting</a>
                </div>
            </div>
        <?php } ?>
        <a>add</a>
    </div>
<?php } ?>
<?= (!empty($add)?$add:'') ?>