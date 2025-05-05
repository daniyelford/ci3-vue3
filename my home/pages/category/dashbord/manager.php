<a onclick="addCategoryIn(0);" class="add-btn"><img src="<?= base_url() ?>assets/svg/icon/add.svg"></a>
<?php if(!empty($data) && !empty($data['p'])){ ?>
    <div id="all-category-manager" class="w-100d d-inline-block pb-5px">
        <input type="hidden" class="mode" value="<?= (!empty($mode)?$mode:'') ?>">
        <div class="w-100d overflow-y f-right d-inline-block" style="max-height:350px;">
            <h3 class="text-center">دسته بندی</h3>
            <table class="w-100d text-center " id="manager-category-parent-id-0">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['p'] as $a){if(!empty($a['id']) && intval($a['id'])>0)?>
                        <tr class="tr-category-id-<?= $a['id'] ?>">
                            <td>
                                <?php if(!empty($a['icon'])){ ?>
                                    <img src="<?= base_url() ?>assets/svg/category/<?= $a['icon'] ?>">
                                <?php } ?>
                            </td>
                            <td>
                                <?= (!empty($a['title'])?$a['title']:'') ?>
                            </td>
                            <td>
                                <?= (!empty($a['description'])?$a['description']:'') ?>
                            </td>
                            <td>
                                <a onclick="addProductToCategory(<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/product/add.svg"></a>
                                <a onclick="showInnerCategory(this,<?= $a['id'] ?>,<?= (!empty($a['parent_id'])&&intval($a['parent_id'])>0?intval($a['parent_id']):0) ?>);"><img src="<?= base_url() ?>assets/svg/category/show.svg"></a>
                                <a onclick="addCategoryIn(<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/category/add.svg"></a>
                                <a onclick="editCategory(this,<?= $a['id'] ?>,<?= (!empty($a['parent_id'])&&intval($a['parent_id'])>0?intval($a['parent_id']):0) ?>);"><img src="<?= base_url() ?>assets/svg/icon/edit.svg"></a>
                                <a class="disable <?= (!empty($a['status'])&&intval($a['status'])>0?'':'d-none') ?>" onclick="btnTypeAction('disable','category',this,event,<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/disable.svg"></a>
                                <a class="enable <?= (!empty($a['status'])&&intval($a['status'])>0?'d-none':'') ?>" onclick="btnTypeAction('enable','category',this,event,<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/enable.svg"></a>
                                <a onclick="btnTypeAction('delete','category',this,event,<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/delete.svg"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= (!empty($data['child'])?$data['child']:'') ?>
        </div>
    </div>
<?php } echo (!empty($add)?$add:'').(!empty($edit)?$edit:''); ?>