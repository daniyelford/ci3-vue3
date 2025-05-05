<?php if(!empty($data)){ ?>
    <section class="<?= $section_id ?>">
        <?php if(!empty($t) && $t!=='dashbord') { ?>
            <a class="z-index-9 w-50px h-50px b-210px l-0 p-fixed" id="dashbord-manager-btn-show" onclick="changePageClick('dashbord');"><img width="100%" height="100%" src="<?= base_url() ?>assets/svg/user/dashbord.svg"></a>
        <?php } ?>
        <?= $data ?>
    </section>
<?php } ?>