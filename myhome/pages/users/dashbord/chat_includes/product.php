<div class="col-12 mx-auto mx-auto bg-secondary p-3 rounded-10" style="max-height:600px;overflow-y:auto;overflow-x:hidden;">
        <?php $number=0;$date = new JDF(); 
        if(!empty($data['product'])){ ?>
    	    <div class="card">
    		    <div class="card-body">
    		        <div class="lists">
                        <?php foreach($data['product'] as $a){
                            if(!empty($a['info']) && !empty($a['info']['id']) && intval($a['info']['id'])>0 && (!empty($a['chat']) || !empty($a['order']))){ $number++; ?>
            					<a onclick="productElementsToolsNumber(this,<?= intval($a['info']['id']) ?>);" class="w-100 d-flex py-3" style="flex-direction: row;flex-wrap: nowrap;align-items: center;justify-content: flex-start;border-bottom: 1px solid;padding: 5px 0;"> 
            						<img class="wd-65 rounded-10" src="<?= base_url('assets/svg/product/'.(!empty($a['info']['icon'])?$a['info']['icon']:'product.svg')) ?>" alt="تصویر محصول">
            						<div class="text-center ml-auto mr-2" title="<?= (!empty($a['info']['description'])?$a['info']['description']:'') ?>">
            						    <?= (!empty($a['info']['title'])?$a['info']['title']:(!empty($a['info']['key'])?$a['info']['key']:'')) ?>
            						</div>
            					    <?= (!empty($a['info']['deleted_at'])?'<small class="text-danger">خارج از دسترس</small>':'') ?>
            						<span class="text-warning font-weight-normal tx-13 ml-1 mr-auto">
            						    <?= (!empty($a['info']['price'])?$a['info']['price']:'') ?>
            					    </span>
            					</a>
            				    <div class="show-div-setting">
            					    <div class="chat <?= (!empty($_GET) && !empty($_GET['count']) && intval($_GET['count'])>0 && intval($_GET['count'])===intval($a['info']['id'])?'':'d-none') ?>" id="chatmodelproduct<?= intval($a['info']['id']) ?>">
            					        <?php if(!empty($a['chat'])){ 
            						        echo $a['chat'];
            						    }elseif(!empty($a['order'])){ ?>
            						        <div class="card-columns">
                						        <?php foreach($a['order'] as $b){ 
                						            if(!empty($b)){ ?>
                						                <div class="card p-1" style="background-color: #a0bfac !important;background-color: #656617 !important;height:auto;">
                						                    <?php if(!empty($b['user'])){ ?>
                						                        <div class="card-header">
                						                            <div class="row">
                						                                <div class="col-4 px-1 pt-1">
                        						                            <img class="w-100 rounded-20" src="<?= (!empty($b['user']["image"])?$b['user']["image"]:base_url('assets/svg/user/user.svg')) ?>">
                						                                </div>
                						                                <div class="col-8 px-1">
                						                                    <div class="row">
                						                                        <div class="col-9 pt-3">
                                						                            <span>
                                    						                            <?= (!empty($b['user']["name"])?$b['user']["name"]:'') ?>
                                    						                            <?= (!empty($b['user']["family"])?$b['user']["family"]:'') ?>
                                						                            </span>
                						                                            
                						                                        </div>
                						                                        <div class="col-1 pt-3 px-1">
                                						                            <?php if(!empty($b['user']["phone"])){ ?>
                                    						                            <a href="tel:<?= $b['user']["phone"] ?>">
                                    						                                <i class="si si-call-out tx-12-f text-success"></i>
                                    						                            </a>
                                						                            <?php } ?>
                						                                        </div>
                						                                    </div>
                						                                </div>
                						                            </div>
                						                        </div>
                						                    <?php } if(!empty($b['info'])){ ?>
                						                        <div class="card-body tx-14-f">
                    						                        تعداد سفارش:
                    						                        <?= (!empty($b['order']["count"])?$b['order']["count"]:'') ?><br>
                    						                        پرداخت محصول:
                    						                        <?= (!empty($b['order']["status"])?'<span class="text-success">پرداخت شده</span>':'<span class="text-danger">پرداخت نشده</span>') ?><br>
                    						                        زمان ثبت سفارش:
                    						                        <?= (!empty($b['order']["time"])?$date->jdate('Y/m/d h:i',$b['order']["time"]):'') ?>
                    						                    </div>
                						                    <?php } 
                						                    if(!empty($b['order'])){ ?>
                    						                    <div class="card-footer tx-10-f">
                						                            نوع سفارش:
                						                            <?php if(!empty($b['position'])){ ?>
                        						                        <span class="text-success">
                        						                            حضور در جایگاه
                        						                        </span>
                    						                            <br>
                    						                            <?= (!empty($b['info']["time_reserve"]) && !empty($b['position'])?'مدت زمان رزرو:'.$b['info']["time_reserve"]:'') ?><br>
                    						                            <?= (!empty($b['info']["date_reserve"])?'زمان ورود به جایگاه:'.$date->jdate('Y/m/d h:i',strtotime($b['info']["date_reserve"])):'') ?><br>
                    						                            پرداخت هزینه ی جایگاه:
                    						                            <?= (!empty($b['info']["factor"])?'<span class="text-success">پرداخت شده</span>':'<span class="text-danger">پرداخت نشده</span>') ?><br>
                        						                        وضعیت ورود:
                        						                        <?php if(!empty($b['info']["status"]) && intval($b['info']["status"])>0){ ?>
                        						                            <?php if($b['info']["status"]==6){ ?>
                        						                                <span class="text-success">اتمام خدمات</span>
                        						                            <?php } if($b['info']["status"]==1){ ?>
                        						                                <span class="text-success">مشتری وارد شده</span>
                        						                            <?php } ?>
                        						                        <?php }else{ ?>
                        						                            <span class="text-danger">در انتظار مشتری</span>
                        						                        <?php } ?><br>
                        						                        زمان درخواست:
                        						                        <?= (!empty($b['info']["time"])?$date->jdate('Y/m/d h:i',strtotime($b['info']["time"])):'') ?>
                        						                    <?php }else{ ?>
                        						                        <span class="text-success">خرید فوری</span>
                        						                    <?php } ?>
                    						                    </div>
            						                        <?php } ?>
                						                </div>
                						            <?php } 
                						        } ?>
            						        </div>
            						    <?php } ?>
            						</div>
            					</div>
                        <?php } 
                        } ?>
    		        </div>
    	        </div>
    	    </div>
        <?php }
        if(!$number>0){ ?>
            <div class="alert alert-danger text-center mt-2 rounded-10 p-5">
                شما هیچ پیامی از این بخش دریافت نکردید
            </div>
        <?php } ?>
    </div>