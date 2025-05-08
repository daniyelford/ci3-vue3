<?php if(!empty($data)){ ?>
    <h3 class="text-center" style="
    margin: 6px 0;
    font-size: 13px;
">کسب و کار های موجود
</h3>
    <a class="scroll-left" onmouseenter="scrollMoveLeftComapany(this,'.all-company-in-category');" onmouseleave="scrollOffComapany();"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/left.svg"></a>
    <a class="scroll-right" onmouseenter="scrollMoveRightComapany(this,'.all-company-in-category');" onmouseleave="scrollOffTwoComapany();"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/right.svg"></a>
    <?php foreach($data as $a){ ?>
        <div class="all-company-in-category company-category-<?= $a['category_id'] ?>">
            <input type="hidden" value="<?= $a['category_id'] ?>" class="company-parent-category">
            <?php foreach($a['companies'] as $b){ ?>
                <div class="company-show companyId<?= $b['info']['id'] ?>" onclick="mapMarkerChangeLocationImage('company',true,<?= $b['info']['id'] ?>,<?= $a['category_id'] ?>,0,0);">
                    <div class="company-info">
                        <span class="company-name d-block my-5px">
                            <?= $b['info']['title'] ?>
                        </span>
                        <span class="company-logo mt-10px d-block">
                            <img src="<?= base_url() . 'assets/svg/company/' . (!empty($b['info']['icon'])?$b['info']['icon']:'category.svg') ?>">
                        </span>
                        <?php if(!empty($b['info']['description'])){?>
                            <span class="company-description d-none">
                                <?= $b['info']['description'] ?>
                            </span>
                            <a class="company-description-shower" onclick="clickCompanyDescription(this,<?= $b['info']['id'] ?>);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/company/info.svg"></a>
                        <?php } ?>
                        <a class="company-products" onclick="clickProductCompany(this,<?= $b['info']['id'] ?>);"><img src="<?= base_url() ?>assets/svg/product/product.svg" class="w-100d h-100d"></a>
                        <?php if(!empty($b['position'])){ ?>
                            <a class="company-position" onclick="clickPositionCompany(this,<?= $b['info']['id'] ?>);"><img src="<?= base_url() ?>assets/svg/position/btn.svg" class="w-100d h-100d"></a>
                        <?php } ?>
                    </div>
                    <div class="d-none all-product-in-category" id="product-company-<?= $b['info']['id'] ?>">
                        <a class="back-to-company-info p-absolut t-0 " onclick="backToCompanyInfo(this);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/back.svg"></a>
                        <?php foreach($b['product'] as $c){ ?>
                            <div class="company-products company-product-products" id="company-product-show-<?= $c['title']['id'] ?>">
                                <input type="hidden" value="<?= $c['title']['id'] ?>" class="product-id">
                                <div class="product-show">
                                    <span class="product-image h-100px w-100d">
                                        <?php if(!empty($c['image'])){ 
                                            echo $c['image'];
                                        }else{ ?>
                                            <img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/product/image.svg">
                                        <?php } ?>
                                    </span>
                                    <span class="product-name">
                                        <?= (!empty($c['title']['title'])?$c['title']['title']:$c['title']['key']) ?>
                                    </span>
                                    <?= $c['key_value'] ?>
                                    <?php if(!empty($c['title']['description'])){ ?>
                                        <a class="show-info product-footer" onclick="clickShowCompanyProductWithType(this,'info',<?= $b['info']['id'] ?>,<?= $c['title']['id'] ?>);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/product/info.svg"></a>
                                    <?php } if(!empty($c['tel'])){ ?>
                                        <a class="show-tel product-footer" onclick="clickShowCompanyProductWithType(this,'tel',<?= $b['info']['id'] ?>,<?= $c['title']['id'] ?>);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/product/tel.svg"></a>
                                    <?php } if(!empty($c['video'])) {?>
                                        <a class="show-video product-footer" onclick="clickShowCompanyProductWithType(this,'video',<?= $b['info']['id'] ?>,<?= $c['title']['id'] ?>);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/product/video.svg"></a>
                                    <?php } if(!empty($c['chat'])) {?>
                                        <a class="show-chat product-footer" onclick="clickShowCompanyProductWithType(this,'chat',<?= $b['info']['id'] ?>,<?= $c['title']['id'] ?>);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/product/chat.svg"></a>
                                    <?php } if(!empty($c['chart'])) {?>
                                        <a class="show-chart product-footer" onclick="showChart(this);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/product/chart.svg"></a>
                                        <?= $c['chart'] ?>
                                    <?php } ?>
                                </div>
                                <?php if(!empty($c['title']['description'])){ ?>
                                    <div class="info d-none">
                                        <a class="back-to-product-show" onclick="backToShowCompanyProductWithType(this,<?= $b['info']['id'] ?>);"><img src="<?= base_url() ?>assets/svg/back.svg" class="w-100d h-100d"></a>
                                        <?= $c['title']['description'] ?>
                                    </div>    
                                <?php } if(!empty($c['tel'])){ ?>
                                    <div class="tel d-none">
                                        <a class="back-to-product-show" onclick="backToShowCompanyProductWithType(this,<?= $b['info']['id'] ?>);"><img src="<?= base_url() ?>assets/svg/back.svg" class="w-100d h-100d"></a>
                                        <?= $c['tel'] ?>
                                    </div>
                                <?php } if(!empty($c['video'])) {?>
                                    <div class="video d-none">
                                        <a class="back-to-product-show" onclick="backToShowCompanyProductWithType(this,<?= $b['info']['id'] ?>);"><img src="<?= base_url() ?>assets/svg/back.svg" class="w-100d h-100d"></a>
                                        <?= $c['video'] ?>
                                    </div>
                                <?php } if(!empty($c['map'])) {?>
                                    <div class="map d-none">
                                        <?= $c['map'] ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="d-none all-position-in-category" id="position-in-company-<?= $b['info']['id'] ?>">
                        <a class="back-to-company-info p-absolut t-0 " onclick="backToCompanyInfo(this);"><img class="w-100d h-100d" src="<?= base_url() ?>assets/svg/back.svg"></a>
                        <?= (!empty($b['position'])?$b['position']:'') ?>
                    </div>
                </div>
                <?= (!empty($b['map'])?$b['map']:'') ?>
            <?php } ?>
        </div>
    <?php } 
} ?>