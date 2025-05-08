<?php if(!empty($api)){ ?>
    <div>
        <?php foreach($api as $a){ ?>
            <div>
                <input type="hidden" value="<?= $a['id'] ?>">
                <?php if(!empty($a['url'])){ ?>
                    <?= $a['url'] ?>
                <?php } ?>
                <?php if(!empty($a['category_id']) && !empty($category)){ 
                    foreach($category as $b){ 
                        if(intval($a['category_id'])===intval($b['id'])){?>
                            <?php if(!empty($b['icon'])){ ?>
                                <img src="<?= base_url() ?>assets/svg/category/<?= $b['icon'] ?>">
                            <?php } ?>
                            <?php if(!empty($b['title'])){ ?>
                                <?= $b['title'] ?>
                            <?php } ?>
                            <?php if(!empty($b['description'])){ ?>
                                <?= $b['description'] ?>
                            <?php } ?>
                            <?php if(!empty($b['status'])){ ?>
                                <?= $b['status'] ?>
                            <?php } ?>
                        <?php }
                    }
                } ?>
                <?php if(!empty($a['api_key'])){ ?>
                    <?= $a['api_key'] ?>
                <?php } ?>
                <?php if(!empty($a['status'])){ ?>
                    <?= $a['status'] ?>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<?php if(!empty($category)){ ?>
    <div class="d-none">
        <?php foreach($category as $b){?>
            <div class="<?= $b['parent_id']?>">
                <input type="hidden" value="<?= $b['id'] ?>">
                <?php if(!empty($b['icon'])){ ?>
                    <img src="<?= base_url() ?>assets/svg/category/<?= $b['icon'] ?>">
                <?php } ?>
                <?php if(!empty($b['title'])){ ?>
                    <?= $b['title'] ?>
                <?php } ?>
                <?php if(!empty($b['description'])){ ?>
                    <?= $b['description'] ?>
                <?php } ?>
                <?php if(!empty($b['status'])){ ?>
                    <?= $b['status'] ?>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>