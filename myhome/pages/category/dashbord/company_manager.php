<?php if(!empty($data) && !empty($data['p'])){ ?>
    <div id="all-category-manager">
        <input type="hidden" class="mode" value="<?= (!empty($mode)?$mode:'') ?>">
        <div>
            <table>
                <thead>
                    <tr>
                        <th>عکس</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['p'] as $a){?>
                        <tr>
                            <td>
                                <img src="<?= base_url() ?>assets/svg/category/<?= (!empty($a['icon'])?$a['icon']:'category.svg') ?>">
                            </td>
                            <td>
                                <?= (!empty($a['title'])?$a['title']:'-') ?>
                            </td>
                            <td>
                                <a onclick="addProductToCategory(<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/add.svg"></a>
                                <a onclick="showInnerCategory(<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/show.svg"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if(!empty($data['child'])){ 
            for($b=0;$b<=count($data['child'])-1;$b++){ 
                if(!empty($data['child'][$b]) && !empty($data['child'][$b]['info']) && !empty($data['child'][$b]['p_id']) && intval($data['child'][$b]['p_id'])>0){ ?>
                    <table class="d-none" id="manager-category-parent-id-<?= intval($data['child'][$b]['p_id']) ?>">
                        <thead>
                            <tr>
                                <th>عکس</th>
                                <th>نام</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['child'][$b]['info'] as $c){?>
                                <tr>
                                    <td>
                                        <img src="<?= base_url() ?>assets/svg/category/<?= (!empty($c['icon'])?$c['icon']:'category.svg') ?>">
                                    </td>
                                    <td><?= (!empty($c['title'])?$c['title']:'') ?></td>
                                    <td>
                                        <a onclick="addProductToCategory(<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/add.svg"></a>
                                        <a onclick="showInnerCategory(<?= $c['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/show.svg"></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } 
            }
        } ?>
    </div>
<?php } ?>