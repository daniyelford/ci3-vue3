<style>
.modal-content {
    position: absolute;
    top: 44px;
    max-height:500px;
    overflow:auto;
}
#map-search {
    position: relative;
    margin-top: 10px;
    right: 45px;
    top: 5px;
    z-index: 9;
}
#map-product-list{
    position: absolute;
    top: 69px;
    bottom: 74px;
    width: 110px;
    font-size:11px;
    display: flex;
    left: 8px;
    height: auto;
    background: #2f083682;
    z-index: 9;
    right: auto;
    overflow-x: hidden;
    overflow-y: auto;
    flex-wrap: nowrap;
    flex-direction: column;
}
</style>
<?php
$all_array=[];
if(!empty($company_position_product)){
    foreach($company_position_product as $a){
        echo (!empty($a['company_info']["map"])?$a['company_info']['map']:'').
        (!empty($a['product_info']["map"])?$a['product_info']['map']:'').
        (!empty($a['position_info']["map"])?$a['position_info']['map']:'');
    }
}
if(!empty($company_position)){
    foreach($company_position as $a){
        echo (!empty($a['company_info']["map"])?$a['company_info']['map']:'').
        (!empty($a['product_info']["map"])?$a['product_info']['map']:'').
        (!empty($a['position_info']["map"])?$a['position_info']['map']:'');
    }
}
if(!empty($company)){
    foreach($company as $a){
        echo (!empty($a['company_info']["map"])?$a['company_info']['map']:'').
        (!empty($a['product_info']["map"])?$a['product_info']['map']:'').
        (!empty($a['position_info']["map"])?$a['position_info']['map']:'');
    }
}
if(!empty($company_product)){
    foreach($company_product as $a){
        echo (!empty($a['company_info']["map"])?$a['company_info']['map']:'').
        (!empty($a['product_info']["map"])?$a['product_info']['map']:'').
        (!empty($a['position_info']["map"])?$a['position_info']['map']:'');
    }
}
?>
<input id="map-search" onkeyup="searchInMapList();" type="search" class="form-control rounded-10 wd-md-80p wd-50p" placeholder="جستجو کنید">
<div id="map-product-list">
    <?php
    $include='';
    if(!empty($company_position_product)){
        foreach($company_position_product as $p){ 
    	    if(!empty($p) && !empty($p['product_info'])){
        	    $pro=$p['product_info']; 
        	    if(!empty($pro['id']) && intval($pro['id'])>0){
            	    $include.=(!empty($pro["chart"])?$pro['chart']:'').(!empty($pro["map"])?$pro['map']:''); ?>		    
                	<div onclick="mapMarkerChangeLocationImageMap('product',true,0,0,0,<?= intval($pro['id']) ?>);">
                        <div class="card rounded-10 mb-0" title="<?= (!empty($pro['info']['description'])?$pro['info']['description']:'') ?>">
                            <img alt="product" class="img-fluid card-img-top ht-120 rounded-10" 
                            src="<?= base_url('assets/svg/product/'.(!empty($pro['info']['icon'])?$pro['info']['icon']:'product.svg'))?>">
                            <span  class="<?= (!empty($pro['info']['status']) && intval($pro['info']['status'])>0?'pulse':'pulse-danger') ?>"></span>
                            <div class="rounded-10 card-img-overlay pd-30 bg-black-4 d-flex flex-column justify-content-center text-center p-3">
                                <a href="<?= base_url('product/'.intval($pro['id'])) ?>" class="tx-white tx-medium mg-y-10 map-pro-title">
                                    <?= (!empty($pro['info']["title"])?$pro['info']["title"]:(!empty($pro['info']["key"])?$pro['info']["key"]:'')) ?>
                                </a>
                                <p class="tx-white-7 tx-small mg-b-15">
                                    <?= (!empty($pro['info']['price'])?number_format($pro['info']['price']).'تومان':'رایگان') ?>
                                </p>
                                <p class="tx-13 mg-b-0" style="gap: 5px;display: flex;flex-wrap: wrap;flex-direction: row;align-content: stretch;justify-content: center;align-items: stretch;">
                                    <?php if(!empty($p['company_info']['info']['title'])){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-company product-footer"
                                        href="<?= base_url('show_company/'.str_replace(' ','--',$p['company_info']['info']['title'])) ?>" title="مشاهده کسب و کار">
                                            <i class="far fa-address-card text-white tx-16-f"></i>
                                        </a>
                                    <?php } if(empty($pro['reserve'])) { ?>
                					    <a class="setup-btns-event d-none pro-btn product-footer d-none" 
                                        onclick="<?= (!empty($id) && intval($id)>0?'reserveProductInPosition(this,'.(!empty($p['position_info']['info']['id']) && intval($p['position_info']['info']['id'])>0?intval($p['position_info']['info']['id']):0).','.intval($pro['id']).');':'loginError(this);') ?>"
                                        title="رزرو">
                                            <i class="fe fe-bell tx-16-f"></i>
                                        </a>
                					<?php } 
                					if(!empty($pro['image']) && !empty(trim($pro['image']))) { ?>
                                        <a class="show-image setup-btns-event d-none pro-btn product-footer" 
                                        onclick="productElementsTools(this,'image',<?= intval($pro['id']) ?>);"
                                        title="عکس">
                                            <i class="la la-image tx-16-f"></i>
                                        </a>
                                    <?php } 
                                    if(!empty($pro['video']) && !empty(trim($pro['video']))) { ?>
                                        <a class="show-video setup-btns-event d-none pro-btn product-footer" 
                                        onclick="productElementsTools(this,'video',<?= intval($pro['id']) ?>);"
                                        title="فیلم">
                                            <i class="la la-film tx-16-f"></i>
                                        </a>
                    				<?php } 
                    				if(!empty($pro['tel']) && !empty(trim($pro['tel']))){ ?>
                                        <a class="show-tel setup-btns-event d-none pro-btn product-footer"
                                        onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($pro['id']).');':'loginError(this);') ?>"
                                        title="تماس">
                                            <i class="si si-call-out tx-16-f"></i>
                                        </a>
                                    <?php } 
                                    if(!empty($pro['chat']) && !empty(trim($pro['chat']))) { ?>
                                        <a class="show-chat setup-btns-event d-none pro-btn product-footer" 
                                        onclick="productElementsTools(this,'chat',<?= intval($pro['id']) ?>);"
                                        title="نظرات">
                                            <i class="icon ion-md-chatboxes tx-16-f"></i>
                                        </a>
                                    <?php } 
                                    if(!empty($pro['chart']) && !empty(trim($pro['chart']))) { ?>
                                        <a class="setup-btns-event d-none pro-btn show-chart product-footer" 
                                        onclick="showChartProductId(<?= intval($pro['id']) ?>);"
                                        title="نمودار">
                                            <i class="icon ion-ios-stats tx-16-f"></i>
                                        </a>
                                    <?php }
                                    if(!empty($pro['key_value']) && !empty(trim($pro['key_value']))){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-key-value product-footer"
                                        onclick="productElementsTools(this,'key-value',<?= intval($pro['id']) ?>);"
                                        title="ویژگی">
                                            <i class="icon ion-ios-list-box tx-16-f"></i>
                                        </a>
                                    <?php } ?>
                                    <a class="setup-btns-click pro-btn product-footer" onclick="setupBtnsClick(this);" title="بیشتر">
                                        <i class="fa fa-cog fa-spin text-info tx-20-f"></i>
                                    </a>
                                </p>
                                <span class="show-div-setting">
                                    <?php if(!empty($pro['tel']) && !empty(trim($pro['tel']))){ ?>
                                        <div class="tel d-none">
                                            <?= $pro['tel'] ?>
                                        </div>
                                    <?php } if(!empty($pro['video']) && !empty(trim($pro['video']))) {?>
                                        <div class="video d-none">
                                            <?= $pro['video'] ?>
                                        </div>
                                    <?php }if(!empty($pro['image']) && !empty(trim($pro['image']))) {?>
                                        <div class="image d-none">
                                            <?= $pro['image'] ?>
                                        </div>
                                    <?php } if(!empty($pro['chat']) && !empty(trim($pro['chat']))) { ?>
                                        <div class="chat d-none" id="chatmodelproduct<?= intval($pro['id']) ?>">
                                            <?= $pro['chat'] ?>
                                        </div>
                                    <?php } if(!empty($pro['key_value']) && !empty(trim($pro['key_value']))) { ?>
                                        <div class="key-value d-none">
                                            <?= $pro['key_value'] ?>
                                        </div>
                                    <?php } ?>
                                </span>
                            </div>
                        </div>
                    </div>
    			<?php }
    		}
    	}
    }
    if(!empty($company_product)){
        foreach($company_product as $p){ 
    	    if(!empty($p) && !empty($p['product_info'])){
        	    $pro=$p['product_info']; 
        	    if(!empty($pro['id']) && intval($pro['id'])>0 && !empty(trim($pro["map"]))){
            	    $include.=(!empty($pro["chart"])?$pro['chart']:'').$pro['map']; ?>		    
                	<div onclick="mapMarkerChangeLocationImageMap('product',true,0,0,0,<?= intval($pro['id']) ?>);">
                        <div class="card rounded-10 mb-0" title="<?= (!empty($pro['info']['description'])?$pro['info']['description']:'') ?>">
                            <img alt="product" class="img-fluid card-img-top ht-120 rounded-10" 
                            src="<?= base_url('assets/svg/product/'.(!empty($pro['info']['icon'])?$pro['info']['icon']:'product.svg'))?>">
                            <span  class="<?= (!empty($pro['info']['status']) && intval($pro['info']['status'])>0?'pulse':'pulse-danger') ?>"></span>
                            <div class="rounded-10 card-img-overlay pd-30 bg-black-4 d-flex flex-column justify-content-center text-center p-3">
                                <a href="<?= base_url('product/'.intval($pro['id'])) ?>" class="tx-white tx-medium mg-y-10 map-pro-title">
                                    <?= (!empty($pro['info']["title"])?$pro['info']["title"]:(!empty($pro['info']["key"])?$pro['info']["key"]:'')) ?>
                                </a>
                                <p class="tx-white-7 tx-small mg-b-15">
                                    <?= (!empty($pro['info']['price'])?number_format($pro['info']['price']).'تومان':'رایگان') ?>
                                </p>
                                <p class="tx-13 mg-b-0" style="gap: 5px;display: flex;flex-wrap: wrap;flex-direction: row;align-content: stretch;justify-content: center;align-items: stretch;">
                                    <?php if(!empty($p['company_info']['info']['title'])){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-company product-footer"
                                        href="<?= base_url('show_company/'.str_replace(' ','--',$p['company_info']['info']['title'])) ?>" title="مشاهده کسب و کار">
                                            <i class="far fa-address-card text-white tx-16-f"></i>
                                        </a>
                                    <?php } if(empty($pro['reserve'])) { ?>
                					    <a class="setup-btns-event d-none pro-btn product-footer d-none" 
                                        onclick="<?= (!empty($id) && intval($id)>0?'reserveProductInPosition(this,'.(!empty($p['position_info']['info']['id']) && intval($p['position_info']['info']['id'])>0?intval($p['position_info']['info']['id']):0).','.intval($pro['id']).');':'loginError(this);') ?>"
                                        title="رزرو">
                                            <i class="fe fe-bell tx-16-f"></i>
                                        </a>
                					<?php } 
                					if(!empty($pro['image']) && !empty(trim($pro['image']))) { ?>
                                        <a class="show-image setup-btns-event d-none pro-btn product-footer" 
                                        onclick="productElementsTools(this,'image',<?= intval($pro['id']) ?>);"
                                        title="عکس">
                                            <i class="la la-image tx-16-f"></i>
                                        </a>
                                    <?php }
                                    if(!empty($pro['video']) && !empty(trim($pro['video']))) { ?>
                                        <a class="show-video setup-btns-event d-none pro-btn product-footer" 
                                        onclick="productElementsTools(this,'video',<?= intval($pro['id']) ?>);"
                                        title="فیلم">
                                            <i class="la la-film tx-16-f"></i>
                                        </a>
                    				<?php } 
                    				if(!empty($pro['tel']) && !empty(trim($pro['tel']))){ ?>
                                        <a class="show-tel setup-btns-event d-none pro-btn product-footer"
                                        onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($pro['id']).');':'loginError(this);') ?>"
                                        title="تماس">
                                            <i class="si si-call-out tx-16-f"></i>
                                        </a>
                                    <?php } 
                                    if(!empty($pro['chat']) && !empty(trim($pro['chat']))) { ?>
                                        <a class="show-chat setup-btns-event d-none pro-btn product-footer" 
                                        onclick="productElementsTools(this,'chat',<?= intval($pro['id']) ?>);"
                                        title="نظرات">
                                            <i class="icon ion-md-chatboxes tx-16-f"></i>
                                        </a>
                                    <?php } 
                                    if(!empty($pro['chart']) && !empty(trim($pro['chart']))) { ?>
                                        <a class="setup-btns-event d-none pro-btn show-chart product-footer" 
                                        onclick="showChartProductId(<?= intval($pro['id']) ?>);"
                                        title="نمودار">
                                            <i class="icon ion-ios-stats tx-16-f"></i>
                                        </a>
                                    <?php }
                                    if(!empty($pro['key_value']) && !empty(trim($pro['key_value']))){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-key-value product-footer"
                                        onclick="productElementsTools(this,'key-value',<?= intval($pro['id']) ?>);"
                                        title="ویژگی">
                                            <i class="icon ion-ios-list-box tx-16-f"></i>
                                        </a>
                                    <?php } ?>
                                    <a class="setup-btns-click pro-btn product-footer" onclick="setupBtnsClick(this);" title="بیشتر">
                                        <i class="fa fa-cog fa-spin text-success tx-20-f"></i>
                                    </a>
                                </p>
                                <span class="show-div-setting">
                                    <?php if(!empty($pro['tel']) && !empty(trim($pro['tel']))){ ?>
                                        <div class="tel d-none">
                                            <?= $pro['tel'] ?>
                                        </div>
                                    <?php } if(!empty($pro['video']) && !empty(trim($pro['video']))) {?>
                                        <div class="video d-none">
                                            <?= $pro['video'] ?>
                                        </div>
                                    <?php }if(!empty($pro['image']) && !empty(trim($pro['image']))) {?>
                                        <div class="image d-none">
                                            <?= $pro['image'] ?>
                                        </div>
                                    <?php } if(!empty($pro['chat']) && !empty(trim($pro['chat']))) { ?>
                                        <div class="chat d-none" id="chatmodelproduct<?= intval($pro['id']) ?>">
                                            <?= $pro['chat'] ?>
                                        </div>
                                    <?php } if(!empty($pro['key_value']) && !empty(trim($pro['key_value']))) { ?>
                                        <div class="key-value d-none">
                                            <?= $pro['key_value'] ?>
                                        </div>
                                    <?php } ?>
                                </span>
                            </div>
                        </div>
                    </div>
    			<?php }
    		}
    	}
    }
	$company_ids=$position_ids=$product_ids=[];
	if(!empty($company_position)){
        foreach($company_position as $p){
            if(!empty($p['company_info']) && 
            !empty($p['company_info']['info']['id']) && 
            intval($p['company_info']['info']['id'])>0 && 
            !in_array(intval($p['company_info']['info']['id']),$company_ids)){
                $company_ids[]=intval($p['company_info']['info']['id']);
                $include.= (!empty($p['company_info']['map'])?$p['company_info']['map']:''); ?>
            <?php }
            if(!empty($p['position_info']) && !empty($p['position_info']['info']['id']) &&
            intval($p['position_info']['info']['id'])>0 &&
            !in_array(intval($p['position_info']['info']['id']),$position_ids) && 
            !empty($p['position_info']['map']) && 
            !empty(trim($p['position_info']['map']))){ 
                $position_ids[]=intval($p['position_info']['info']['id']);
                $include.= (!empty($p['position_info']['map'])?$p['position_info']['map']:''); ?>
                    <div onclick="mapMarkerChangeLocationImageMap('position',true,0,0,<?= intval($p['position_info']['info']['id']) ?>,0);">
                        <div class="card rounded-10 mb-0" title="<?= (!empty($p['position_info']['info']['description'])?$p['position_info']['info']['description']:'') ?>">
                            <img alt="product" class="img-fluid card-img-top ht-120 rounded-10" src="<?= base_url('assets/svg/position/'.(!empty($p['position_info']['info']['icon'])?$p['position_info']['info']['icon']:'position.svg'))?>">
                            <span  class="<?= (!empty($p['position_info']['info']['status']) && intval($p['position_info']['info']['status'])>0?'pulse':'pulse-danger') ?>"></span>
                            <div class="rounded-10 card-img-overlay pd-30 bg-black-4 d-flex flex-column justify-content-center text-center p-3">
                                <a href="<?= base_url('position/'.intval($p['position_info']['info']['id'])) ?>" class="map-pro-title tx-white tx-medium mg-y-10">
                                    <?= (!empty($p['position_info']['info']['title'])?$p['position_info']['info']['title']:'') ?>
                                </a>
                                <p class="tx-white-7 tx-small mg-b-15">
                                    <?= (!empty($p['position_info']['info']['price'])?number_format($p['position_info']['info']['price']).'تومان':'رایگان') ?>
                                </p>
                                <p class="tx-13 mg-b-0" style="gap: 5px;display: flex;flex-wrap: wrap;flex-direction: row;align-content: stretch;justify-content: center;align-items: stretch;">
                                    <?php if(!empty($p['company_info']['info']['title'])){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-company product-footer"
                                        href="<?= base_url('show_company/'.str_replace(' ','--',$p['company_info']['info']['title'])) ?>" title="مشاهده کسب و کار">
                                            <i class="far fa-address-card text-white tx-16-f"></i>
                                        </a>
                                    <?php } if(!empty($p['position_info']['tel']) && !empty(trim($p['position_info']['tel']))){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-tel product-footer" onclick="<?= (!empty($id) && intval($id)>0?'productElementsTools(this,'."'".'tel'."',".intval($p['position_info']['info']['id']).');':'loginError(this);') ?>" title="تماس">
                                            <i class="si si-call-out tx-16-f"></i>
                                        </a>
                                    <?php } if(!empty($p['position_info']['chat']) && !empty(trim($p['position_info']['chat']))){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-chat product-footer" onclick="productElementsTools(this,'chat',<?= intval($p['position_info']['info']['id']) ?>);" title="نظرات">
                                            <i class="icon ion-md-chatboxes tx-16-f"></i>
                                        </a>
                                    <?php } if(!empty($p['position_info']['image']) && !empty(trim($p['position_info']['image']))){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-image product-footer" onclick="productElementsTools(this,'image',<?= intval($p['position_info']['info']['id']) ?>);" title="عکس">
                                            <i class="la la-image tx-16-f"></i>
                                        </a>
                                    <?php }if(!empty($p['position_info']['video']) && !empty(trim($p['position_info']['video']))){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-video product-footer" onclick="productElementsTools(this,'video',<?= intval($p['position_info']['info']['id']) ?>);" title="فیلم">
                                            <i class="la la-film tx-16-f"></i>
                                        </a>
                                    <?php } if(empty($p['position_info']['reserve'])){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-reserve product-footer" 
                                        onclick="<?= (!empty($id) && intval($id)>0?'reservePosition(this,'.intval($p['position_info']['info']['id']).');':'loginError(this);') ?>" title="رزرو">
                                            <i class="fe fe-bell tx-16-f"></i>
                                        </a>
                                    <?php } ?>
                                    <a class="setup-btns-click pro-btn product-footer" onclick="setupBtnsClick(this);" title="بیشتر">
                                        <i class="fa fa-cog fa-spin text-warning tx-20-f"></i>
                                    </a>
                                </p>
                                <span class="show-div-setting">
                                    <?php if(!empty($id) && intval($id)>0 && !empty($p['position_info']['tel']) && !empty(trim($p['position_info']['tel']))){ ?>
                                        <div class="tel d-none">
                                            <?= trim($p['position_info']['tel']) ?>
                                        </div>
                                    <?php } if(!empty($p['position_info']['chat']) && is_string($p['position_info']['chat']) && !empty(trim($p['position_info']['chat']))){ ?>
                                        <div class="chat d-none" id="chatmodelposition<?= intval($p['position_info']['info']['id']) ?>">
                                            <?= trim($p['position_info']['chat']) ?>
                                        </div>
                                    <?php } if(!empty($p['position_info']['image']) && is_string($p['position_info']['image']) && !empty(trim($p['position_info']['image']))){ ?>
                                        <div class="image d-none">
                                            <?= trim($p['position_info']['image']) ?>
                                        </div>
                                    <?php } if(!empty($p['position_info']['video']) && is_string($p['position_info']['video']) && !empty(trim($p['position_info']['video']))){ ?>
                                        <div class="video d-none">
                                            <?= trim($p['position_info']['video']) ?>
                                        </div>
                                    <?php } ?>
                                </span>
                            </div>
                        </div>
                    </div>
            <?php }
            if(!empty($p['product_info']) && !empty($p['product_info']['info']['id']) && intval($p['product_info']['info']['id'])>0 && !in_array(intval($p['product_info']['info']['id']),$product_ids)){ 
                $product_ids[]=intval($p['product_info']['info']['id']);
                $include .= (!empty($p['product_info']['map'])?$p['product_info']['map']:''); ?>
            <?php } 	
        }
	} 
	if(!empty($company)){
	    $company_idssss=[];
        foreach($company as $p){ 
    	    if(!empty($p) && !empty(trim($p['map']))){
        	    if(!empty($p['id']) && intval($p['id'])>0 && !in_array(intval($p['id']),$company_idssss) && !empty($p['info']) && !empty($p['info']["title"])){
        	        $company_idssss[]=intval($p['id']);
            	    $include.=$p['map']; ?>		    
                	<div onclick="mapMarkerChangeLocationImageMap('company',true,<?= (!empty($p['id']) && intval($p['id'])>0?intval($p['id']):0) ?>,0,0,0);">
                        <div class="card rounded-10 mb-0" title="<?= (!empty($p['info']['description'])?$p['info']['description']:'') ?>">
                            <img alt="product" class="img-fluid card-img-top ht-120 rounded-10" 
                            src="<?= base_url('assets/svg/company/'.(!empty($p['info']['icon'])?$p['info']['icon']:'company.svg'))?>">
                            <span  class="<?= (!empty($p['info']['status']) && intval($p['info']['status'])>0?'pulse':'pulse-danger') ?>"></span>
                            <div class="rounded-10 card-img-overlay pd-30 bg-black-4 d-flex flex-column justify-content-center text-center p-3">
                                <a href="<?= base_url('show_company/'.str_replace(' ','--',$p['info']["title"])) ?>" class="map-pro-title tx-white tx-medium mg-y-10">
                                    <?= $p['info']["title"] ?>
                                </a>
                                 <p class="tx-13 mg-b-0" style="gap: 5px;display: flex;flex-wrap: wrap;flex-direction: row;align-content: stretch;justify-content: center;align-items: stretch;">
                                    <?php if(!empty($p['info']["title"])){ ?>
                                        <a class="setup-btns-event d-none pro-btn show-company product-footer"
                                        href="<?= base_url('show_company/'.str_replace(' ','--',$p['info']["title"])) ?>" title="مشاهده کسب و کار">
                                            <i class="far fa-address-card text-white tx-16-f"></i>
                                        </a>
                                    <?php } ?>
                                    <a class="setup-btns-click pro-btn product-footer" onclick="setupBtnsClick(this);" title="بیشتر">
                                        <i class="fa fa-cog fa-spin text-danger tx-20-f"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
    			<?php }
    		}
    	}
    }
	if(!empty($include)){
    	echo $include;
	}else{ ?>
	    <div class="alert alert-danger rounded-10 ">
	        محصولی روی نقشه وجود ندارد
	    </div>
	<?php } ?>
</div>
<script>
    function searchInMapList (){
        $('#map-product-list').children().filter(function () {
            $(this).toggle($(this).find('.map-pro-title').text().toLowerCase().indexOf($('#map-search').val().toLowerCase()) > -1);
        })
    }
    function mapMarkerChangeLocationImageMap(type,fly,cId,catId,poId,prId){ 
        let a= geojson[type],num=0,check=false;
        $('.all-markers').html('');
        for (const k in a) { 
            let b=a[k].mark;
            for (const v in b){
                let icon=b[v].icon.url;
                if(typeof(icon)=='undefined' || icon==''){
                    icon=baseUrl('assets/svg/product/map.svg');
                }
                if(typeof(fly)!=='undefined' && fly){
                    if((cId != 0 && b[v].companyId==cId)||(catId != 0 && b[v].categoryId==catId)||(poId != 0 && b[v].positionId==poId)||(prId != 0 && b[v].productId==prId)){
                        $('#map-list-shower').children('.list-group').append('<div onclick="map.flyTo({center:['+b[v].coordinates+'], zoom: 24});" class="list-group-item p-1"><img class="wd-50 h-auto marker-list-image-style" src="'+icon+'<p style="word-break: break-all;text-align: center;max-height: 50px;overflow: hidden;">'+b[v].message+'</p><span class="marker-list-option-style">'+b[v].option+'</span></div>');
                        if(num==0){
                            map.flyTo({center:b[v].coordinates, zoom: 18});
                            num++;
                        }
                    }
                }
                if(prId != 0 && b[v].productId==prId && !check){
                    check=true;
                    $('.'+type+'-marker-count-'+b[v].count).html('<img width="20px" height="20px" src="'+icon+'">');
                }
                if(poId != 0 && b[v].positionId==poId && !check){
                    check=true;
                    $('.'+type+'-marker-count-'+b[v].count).html('<img width="20px" height="20px" src="'+icon+'">');
                }
                if(cId != 0 && b[v].companyId==cId && !check){
                    check=true;
                    $('.'+type+'-marker-count-'+b[v].count).html('<img width="20px" height="20px" src="'+icon+'">');
                }
                if(catId != 0 && b[v].categoryId==catId && !check){
                    check=true;
                    $('.'+type+'-marker-count-'+b[v].count).html('<img width="20px" height="20px" src="'+icon+'">');
                }
            }
        }
        return true;
    }
</script>