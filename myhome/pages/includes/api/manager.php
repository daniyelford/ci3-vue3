<?php if(!empty($data)){ ?>
    <div>
        <?php foreach($data as $a){ ?>
            <input type="hidden" value="<?= $a['id'] ?>">
            <?php if(!empty($a['company'])){?>
                <div>
                    <?php if(!empty($a['company']['icon'])){ ?>
                        <img src="<?= base_url() ?>assets/svg/company/<?= $a['company']['icon'] ?>">
                    <?php } ?>
                    <?php if(!empty($a['company']['title'])){ ?>
                        <?= $a['company']['title'] ?>
                    <?php } ?>
                    <?php if(!empty($a['company']['description'])){ ?>
                        <?= $a['company']['description'] ?>
                    <?php } ?>
                    <?php if(!empty($a['company']['url'])){ ?>
                        <?= $a['company']['url'] ?>
                    <?php } ?>
                    <?php if(!empty($a['company']['status'])){ ?>
                        <?= $a['company']['status'] ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if(!empty($a['category'])){?>
                <div>
                    <?php if(!empty($a['category']['icon'])){ ?>
                        <img src="<?= base_url() ?>assets/svg/category/<?= $a['category']['icon'] ?>">
                    <?php } ?>
                    <?php if(!empty($a['category']['title'])){ ?>
                        <?= $a['category']['title'] ?>
                    <?php } ?>
                    <?php if(!empty($a['category']['description'])){ ?>
                        <?= $a['category']['description'] ?>
                    <?php } ?>
                    <?php if(!empty($a['category']['status'])){ ?>
                        <?= $a['category']['status'] ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <div>
                <?= $a['url'] ?>
            </div>
            <div>
                <?= $a['status'] ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>