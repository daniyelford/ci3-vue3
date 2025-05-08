<?php if(!empty($data)){ ?>
    <div id="company-manager-selector">
        <a id="company-manager-selector-btn" onclick="showParentChild(this);"><img src="<?= base_url() ?>assets/svg/company/selector.svg"></a>
        <ul id="company-manager-selector-menu" class="child d-none p-fixed t-0 b-0 l-0 r-0 w-100d h-100d z-index-9 bg-grey">
            <li>
                <a onclick="hideChild(this);"><img src="<?= base_url() ?>assets/svg/back.svg"></a>
            </li>
            <?php foreach($data as $a){ ?>
                <li class="li-<?= $a['id'] ?>">
                    <?php if(!empty($a['icon'])&&is_string($a['icon'])){ ?>
                        <img src="<?= base_url() ?>assets/svg/company/<?= $a['icon'] ?>">
                    <?php } ?>
                    <span><?= (!empty($a['title'])?$a['title']:'') ?></span>
                    <span><?= (!empty($a['description'])?$a['description']:'') ?></span>
                    <span><?= (!empty($a['type']) && intval($a['type'])>0?'کسب و کار دستجمعی':'شغل انفرادی') ?></span>
                    <span><?= (!empty($a['status'])&&intval($a['status'])>0?'فعال':'غیرفعال') ?></span>
                    <?php if(!empty($id) && intval($id)!==intval($a['id'])){ ?>
                        <a href="<?= base_url() ?>role/set_company_showen/<?= $a['id'] ?>">
                            مدیریت کسب و کار
                        </a>
                    <?php }else{ ?>
                        <span>
                            درحال مدیریت
                        </span>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>