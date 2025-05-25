<?php
if(!empty($menu) && is_array($menu)){
    $a=$menu;
    if(!empty($a) && !empty($a['p_id']) && intval($a['p_id'])>0 && !empty($a['info']) && is_array($a['info'])){ ?>
        <div class="d-none w-100d children-category-nav-menu parent-id-<?= intval($a['p_id']) ?>">
            <input type="hidden" class="category-parent-id" value="<?= intval($a['p_id']) ?>">
            <input type="hidden" class="category-parent-parent-id" value="<?= intval($a['p_p_id']) ?>">
            <?php if(intval($a['p_p_id'])>0){ ?>
                <a class="back-to-parent d-none" onclick="backToParentCategory(this)">
                    <img src="<?= base_url() ?>assets/svg/back.svg">
                </a>
            <?php } ?>
            <input type="hidden" value="<?= intval($a['p_id']) ?>" class="category-parent-id">
            <ul class="ul-flex" style="<?= (intval($a['p_p_id'])>0?'margin: 5px 25px;':'') ?>">
                <?php foreach($a['info'] as $b){ ?>
                    <li><a class="category-show-menu" onclick="changeCategoryInnerCategory(this,<?= $b['id'] ?>);"><img src="<?= base_url() ?>assets/svg/category/<?= (!empty($b['icon'])?$b['icon']:'category.svg') ?> "><?= $b['title'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
    <?php }
} ?>