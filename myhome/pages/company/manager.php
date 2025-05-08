<?php if(!empty($data)){ ?>
    <div id="company-manager" class="text-center">
        <h1>مدیریت کسب و کارها</h1>
        <table class="w-100d">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $a){ ?>
                    <tr class="trId-<?= intval($a['id']) ?>">
                        <td>
                            <?php if(!empty($a['icon'])){ ?>
                                <img src="<?= base_url() ?>assets/svg/company/<?= $a['icon'] ?>">
                            <?php } ?>
                        </td>
                        <td>
                            <?= (!empty($a['title'])?$a['title']:'') ?>
                        </td>
                        <td>
                            <?= (!empty($a['url'])?$a['url']:'') ?> 
                        </td>
                        <td>
                            <?= (!empty($a['description'])?$a['description']:'-') ?>
                        </td>
                        <td>
                            <input type="hidden" value="<?= intval($a['type']) ?>" class="company-type-number">
                            <a onclick="editCompany(event,this,<?= intval($a['id']) ?>);"><img src="<?= base_url() ?>assets/svg/icon/edit.svg"></a>
                            <a class="disable <?= (!empty($a['status'])&&intval($a['status'])>0?'':'d-none') ?>" onclick="btnTypeAction('disable','company',this,event,<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/disable.svg"></a>
                            <a class="enable <?= (!empty($a['status'])&&intval($a['status'])>0?'d-none':'') ?>" onclick="btnTypeAction('enable','company',this,event,<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/enable.svg"></a>
                            <a onclick="btnTypeAction('delete','company',this,event,<?= $a['id'] ?>);"><img src="<?= base_url() ?>assets/svg/icon/delete.svg"></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <div>
<?php }
echo (!empty($edit)?$edit:'');
?>