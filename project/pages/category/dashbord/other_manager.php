<?php if(!empty($data)){
    $a=$data;
    // var_dump($a['info']);
    if(!empty($a['info']) && !empty($a['p_id'])){ ?>
        <table class="d-none w-100d mt-30px f-left text-center" id="manager-category-parent-id-<?= intval($a['p_id']) ?>">
            <caption>
                <a onclick="showParentCategory(<?= intval($a['p_id']) ?>);" style="position: absolute;top: 60px;width: 40px;height: 40px;right: 10px;display: inline-block;"><img src="<?= base_url() ?>assets/svg/back.svg"></a>
            </caption>
            <thead>
                <tr>
                    <th></th> 
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($a['info'] as $c){ ?>
                    <tr class="tr-category-id-<?= $c['id'] ?>">
                        <td>
                            <?php if(!empty($c['icon'])){ ?>
                                <img src="<?= base_url() ?>assets/svg/category/<?= $c['icon'] ?>">
                            <?php } ?>
                        </td>
                        <td><?= (!empty($c['title'])?$c['title']:'') ?></td>
                        <td><?= (!empty($c['description'])?$c['description']:'') ?></td>
                        <td>
                            <a onclick="addProductToCategory(<?= $c['id'] ?>);"><img src="<?= base_url() ?>assets/svg/product/add.svg"></a>
                            <a onclick="showInnerCategory(this,<?= $c['id'] ?>,<?=  (!empty($c['parent_id'])&&intval($c['parent_id'])>0?intval($c['parent_id']):0) ?>);"><img src="<?= base_url() ?>assets/svg/category/show.svg"></a>
                            <a onclick="addCategoryIn(<?= $c['id'] ?>);"><img src="<?= base_url() ?>assets/svg/category/add.svg"></a>
                            <a onclick="editCategory(this,<?= $c['id'] ?>,<?= (!empty($a['p_id'])&&intval($a['p_id'])>0?intval($a['p_id']):0) ?>);"><img src="<?= base_url() ?>assets/svg/icon/edit.svg"></a>
                            <a class="disable <?= (!empty($c['status'])&&intval($c['status'])>0?'d-none':'') ?>" onclick="btnTypeAction('disable','category',this,event,<?= $c['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/disable.svg"></a>
                            <a class="enable <?= (!empty($c['status'])&&intval($c['status'])>0?'':'d-none') ?>" onclick="btnTypeAction('enable','category',this,event,<?= $c['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/enable.svg"></a>
                            <a onclick="btnTypeAction('delete','category',this,event,<?= $c['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/delete.svg"></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php }
} ?>