<?php if(!empty($data)){ ?>
    <div>
        <?php foreach($data as $a){ ?>
            <div>
                <input type="hidden" value="<?= $a['id'] ?>">
                <?php if($a['icon']){ ?>
                    <img src="<?= base_url() ?>assets/svg/company/<?= $a['icon'] ?>">
                <?php } ?>
                <div><?= $a['title'] ?></div>
                <div><?= $a['description'] ?></div>
                <a></a>
                <a></a>
                <a></a>
                <a></a>
                <a></a>
            </div>
        <?php } ?>
    </div>
<?php } ?>