<?php if(!empty($reserve)){
    $date=new JDF();?>
    <div class="row row-sm">
        <div class="col-12">
            <div class="row row-sm all-reserves-info">
                <div class="col-md-6 col-sm-12 col-lg-4" style="overflow-y: auto;max-height: 190px;">
                    <div class="card custom-card">
                        <div class="">
                            <div class=" main-content-contacts pt-0">
                                <div class="main-content-left main-content-left-contacts">
                                    <div class="" class="mainContactList">
                                        <div class="main-contact-label"></div>
                                        <?php 
                                        $numbe=0;
                                        foreach($reserve as $a){
                                            if(!empty($a) && !empty($a['user_info']) &&
                                            !empty($a['position_id']) && intval($a['position_id'])>0 &&
                                            !empty($a['position_user_id']) && intval($a['position_user_id'])>0){ ?>
                                                <div class="main-contact-item <?php if(!empty($_GET['user']) && intval($_GET['user'])>0){if(intval($a['position_user_id'])===intval($_GET['user'])){echo 'bg-secondary';}}else{if($numbe==0){echo 'bg-secondary';}} ?>">
                                                    <input type="hidden" value="<?= intval($a['position_id']) ?>" class="pIds">
                                                    <div class="main-img-user">
                                                        <img alt="user picture" src="<?= (!empty($a['user_info']['image'])?$a['user_info']['image']:base_url('assets/svg/user/user.svg')) ?>">
                                                    </div>
                                                    <div class="main-contact-body">
                                                        <h6><?= (!empty($a['user_info']['name'])?$a['user_info']['name']:'') ?> <?= (!empty($a['user_info']['family'])?$a['user_info']['family']:'') ?></h6>
                                                        <?php if(!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==1){ ?>
                                                            <small class="tx-8-f text-info">
                                                                مشتری رسیده
                                                            </small>
                                                        <?php }elseif(!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==2){ ?>
                                                            <small class="tx-8-f text-warning">
                                                                وجه نقد دریافت کنید
                                                            </small>
                                                        <?php }elseif(!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==3){ ?>
                                                            <small class="tx-8-f text-danger">
                                                                پرداخت محصولات کامل نیست
                                                            </small>
                                                        <?php }elseif(!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==4){ ?>
                                                            <small class="tx-8-f text-success">
                                                                پرداخت شد
                                                            </small>
                                                        <?php }elseif(!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==5){ ?>
                                                            <small class="tx-8-f text-secondary">
                                                                مشکل خدماتی
                                                            </small>
                                                        <?php }elseif(!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==6){ ?>
                                                            <small class="tx-8-f text-success">
                                                                اتمام خدمات
                                                            </small>
                                                        <?php }else{ ?>
                                                            <small class="tx-8-f text-warning">
                                                                درانتظار مشتری
                                                            </small>
                                                        <?php } ?>
                                                    </div>
                                                    <?php if(!empty($a['user_info']['phone'])){ ?>
                                                        <a class="main-contact-star ml-1 mt-1" href="tel:<?= $a['user_info']['phone'] ?>" title="تماس با مشتری">
                                                            <i class="fe fe-phone tx-15-f"></i>
                                                        </a>
                                                    <?php }
                                                    if(!empty($a['data'])){ $numbe++; ?>
                                                        <a class="main-contact-star ml-1 mt-1 firstClick" onclick="showReserveInfo(this,<?= $numbe ?>,<?= intval($a['position_user_id']) ?>);" title="تنظیمات خدمات به مشتری">
                                                            <i class="fa fa-cog fa-spin tx-15-f"></i>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            <?php } 
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $numb=0;
                foreach($reserve as $a){    
                    if(!empty($a['data']) && !empty($a['position_user_id']) && intval($a['position_user_id'])>0){ $numb++; ?>
                        <div class="col-md-6 col-lg-8 col-sm-12 re-info re-count-<?= $numb ?> <?php if(!empty($_GET['user']) && intval($_GET['user'])>0){if(intval($a['position_user_id'])!==intval($_GET['user'])){echo 'd-none';}}else{if($numb!=1){echo 'd-none';}} ?>">
                            <div class="">
                                <div class="card">
                                    <div class="main-contact-info-header pt-3">
                                        <div class="media">
                                            <div class="main-img-user">
                                                <img alt="position picture" src="<?= base_url('assets/svg/position/'.(!empty($data['info']['icon'])?$data['info']['icon']:'position.svg')) ?>">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1 text-pink">
                                                    <?= (!empty($data['info']['title'])?$data['info']['title']:'') ?>
                                                </h6>
                                                <span class="text-info tx-9-f">
                                                    <?php if(!empty($data['info']['price']) && intval($data['info']['price'])>0){
                                                        	if(!empty($a['data']['factor'])){ ?>
                                                    		    هزینه ی جایگاه پرداخت شده
                                                        	<?php }else{ ?>
                                                        		هزینه جایگاه به مبلغ 
                                                        	    <?= number_format($data['info']['price']) ?>
                                                        	    را در هر ساعت از مشتری دریافت کنید
                                                            <?php }
                                                    	}else{ ?>
                                                    	    جایگاه رزرو است
                                                        <?php }    
                                                    ?>
                                                </span>
                                                <nav class="contact-info mt-1">
                                                    <?php if(!empty($a['form'])){ ?>
                                                        <a class="showPositionForm contact-icon border tx-inversebtn ripple btn-secondary text-white btn-icon" onclick="showPositionForm(this);" title="مشاهده ی جواب فرم" >
                                                            <i class="typcn typcn-document-text"></i>
                                                        </a>
                                                        <a class="hidePositionForm d-none contact-icon border tx-inversebtn ripple btn-danger text-white btn-icon" onclick="hidePositionForm(this);" title="بستن">
                                                            <i class="fas fa-ban"></i>
                                                        </a>
                                                    <?php } if(!(!empty($a['data']['status']) && intval($a['data']['status'])>0)){ ?>
                                                        <a class="showPositionReserveTime contact-icon border tx-inversebtn ripple btn-secondary text-white btn-icon" onclick="showPositionReserveTime(this);" title="تعیین زمان دیگر" >
                                                            <i class="fe fe-calendar"></i>
                                                        </a>
                                                        <a class="hidePositionReserveTime d-none contact-icon border tx-inversebtn ripple btn-danger text-white btn-icon" onclick="hidePositionReserveTime(this);" title="بستن">
                                                            <i class="fas fa-ban"></i>
                                                        </a>
                                                    <?php } 
                                                    if(!empty($a['product_order'])){ ?>
                                                        <a onclick="showOrderProduct(this);" class="showOrderProduct contact-icon border tx-inversebtn ripple btn-secondary text-white btn-icon" title="سفارشات محصول">
                                                            <i class="icon ion-md-cube"></i>
                                                        </a>
                                                        <a class="hideOrderProduct d-none contact-icon border tx-inversebtn ripple btn-danger text-white btn-icon" onclick="hideOrderProduct(this);" title="بستن">
                                                    	    <i class="fas fa-ban"></i>
                                                        </a>
                                                    <?php }
                                                    if((empty($a['reserve_user_status']) || intval($a['reserve_user_status'])==0) && ((!empty($a['data']['date_reserve']) && strtotime(!empty($a['data']['date_reserve']))<=time())||empty($a['data']['date_reserve']))){ ?>
                                                        <a class="contact-icon border tx-inversebtn ripple btn-success text-white btn-icon" onclick="arrivedPersent(<?= intval($a['position_id']).','.intval($a['position_user_id']) ?>);" title="رسیدن مشتری به جایگاه">
                                                            <i class="far fa-calendar-check tx-15-f"></i>
                                                        </a>
                                                    <?php }
                                                    if((!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==1) || 
                                                    (!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==2)||
                                                    (!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==3)||
                                                    (!empty($a['reserve_user_status']) && intval($a['reserve_user_status'])==4)){
                                                        if(!empty($a['data']['date_reserve']) && !empty($a['data']['time_reserve'])){ 
                                                            $cal=explode(':',$a['data']['time_reserve']);
                                                            $time_reserve=((!empty($cal['0']) && intval($cal['0'])>0?intval($cal['0']):0)*3600)+
                                                            ((!empty($cal['1']) && intval($cal['1'])>0?intval($cal['1']):0)*60)+
                                                            intval($cal['2']);
                                                            $end_time_cal=strtotime($a['data']['date_reserve'])+$time_reserve;
                                                            if($end_time_cal<time()||empty($a['data']['factor'])){ ?>
                                                                <a class="contact-icon border tx-inversebtn ripple btn-success text-white btn-icon" onclick="endService(<?= intval($a['position_id']).','.intval($a['position_user_id']) ?>);" title="اتمام خدمات">
                                                                    <i class="far fa-check-circle tx-15-f"></i>
                                                                </a>
                                                            <?php }else{ ?>
                                                                <br>
                                                                <br>
                                                                <span class="p-1 rounded-10 bg-success text-primary">جایگاه هنوز رزرو است</span>
                                                            <?php }
                                                        }else{ ?>
                                                            <a class="contact-icon border tx-inversebtn ripple btn-success text-white btn-icon" onclick="endService(<?= intval($a['position_id']).','.intval($a['position_user_id']) ?>);" title="اتمام خدمات">
                                                                <i class="far fa-check-circle tx-15-f"></i>
                                                            </a>
                                                        <?php }
                                                    } ?>
                                                </nav>
                                                <div class="main-contact-info-body px-4 showPositionForm d-none">
                                                    <?php 
                                                    if(!empty($a['form'])){
                                                        $number_form=false;
                                                        foreach($a['form'] as $form){
                                                            if(!empty($form) && !empty($form['question']) && !empty($form['question']['status']) && intval($form['question']['status'])>0 && !empty($form['answer'])){
                                                                $number_form=true; ?>
                                                                <div class="mt-2">
                                                                    <p>
                                                                        <?= (!empty($form['question']['question'])?$form['question']['question']:'').(!empty($form['question']['required']) && intval($form['question']['required'])>0?'(اجباری)':'(اختیاری)') ?>
                                                                    </p>
                                                                    <div>
                                                                        <?php if(!empty($form['question']['type_question']) && !empty(end($form['answer'])['user_answer_value'])){ 
                                                                            if($form['question']['type_question']==='image'){ ?>
                                                                                <img class="rounded-10 mx-auto w-50 hd-150 h-auto" src="<?= base_url('assets/pic/position/'.end($form['answer'])['user_answer_value']) ?>">
                                                                            <?php }else{ ?>
                                                                                <p><?= end($form['answer'])['user_answer_value'] ?></p>
                                                                            <?php }
                                                                        } ?>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                        }
                                                        if(!$number_form){ ?>
                                                            <div class="alert alert-danger rounded-10 text-center p-3">
                                                                مشتری جواب سوالات فرم جایگاه را نداده است
                                                            </div>
                                                        <?php }
                                                    } ?>
                                                </div>
                                                <div class="main-contact-info-body px-4 showPositionReserveTime d-none">
                                                    <?= (!empty($a['timer'])?$a['timer']:'') ?>
                                                    <a class="btn btn-success rounded-10 text-white btn-block mt-2" 
                                                    onclick="savePositionReserveTime(this,<?= intval($a['position_user_id']) ?>);">تغییر زمان</a>
                                                </div>
                                                <div class="main-contact-info-body">
                                                    <div class="media-list pb-0">
                                                        <div class="media mb-0">
                                                            <div class="media-body">
                                                                <div>
                                                                    <?php if(!empty($a['data']['time'])){ ?>
                                                                        <p class="text-right tx-10-f text-info mb-2">
                                                                            زمان درخواست رزرو:
                                                                            <small class="f-left tx-9-f text-warning">
                                                                                <?= $date->jdate('H:i Y/m/d',strtotime($a['data']['time'])) ?>
                                                                            </small>
                                                                        </p>
                                                                    <?php } if(!empty($a['data']['time_reserve']) && intval($a['data']['time_reserve'])>0){ ?>
                                                                        <p class="text-right tx-10-f text-info mb-0">
                                                                            مدت رزرو خدمات(ساعت):
                                                                            <small class="f-left tx-9-f text-warning">
                                                                                <?= $a['data']['time_reserve'] ?> 
                                                                            </small>
                                                                        </p>
                                                                    <?php }if(!empty($a['data']['date_reserve'])){ ?>
                                                                        <p class="text-right tx-10-f text-info mb-0">
                                                                            زمان ورود مشتری:
                                                                            <small class="f-left tx-9-f text-warning">
                                                                                <?= $date->jdate('H:i Y/m/d',strtotime($a['data']['date_reserve'])) ?>
                                                                            </small>
                                                                        </p>
                                                                    <?php } if(!empty($a['data']['time_reserve']) && intval($a['data']['time_reserve'])>0){ ?>
                                                                        <p class="text-right tx-10-f text-info mb-0">
                                                                            زمان خروج مشتری:
                                                                            <small class="f-left tx-9-f text-warning">
                                                                                <?php 
                                                                                $time_hand=strtotime($a['data']['date_reserve']);
                                                                                $time_hand_one=explode(':',$a['data']['time_reserve']);
                                                                                if(!empty($time_hand_one)){
                                                                                    if(!empty($time_hand_one['0']) && intval($time_hand_one['0'])>0){
                                                                                        $time_hand+=($time_hand_one['0']*3600);
                                                                                    }
                                                                                    if(!empty($time_hand_one['1']) && intval($time_hand_one['1'])>0){
                                                                                        $time_hand+=($time_hand_one['1']*60);
                                                                                    }
                                                                                    if(!empty($time_hand_one['2']) && intval($time_hand_one['2'])>0){
                                                                                        $time_hand+=$time_hand_one['2'];
                                                                                    }
                                                                                }
                                                                                echo $date->jdate('H:i Y/m/d',$time_hand); ?>
                                                                            </small>
                                                                        </p>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="main-contact-info-body p-0 showOrderProduct d-none">
                                                    <div class="list-group">
                                                        <?php if(!empty($a['product_order'])){
                                                            foreach($a['product_order'] as $b){ ?>
                                                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                                                    <span class="d-flex">
                                                                        <img alt="product picture" class="ml-3 rounded-circle avatar-md" src="<?= base_url('assets/svg/product/'.(!empty($b['pro']['icon'])?$b['pro']['icon']:'product.svg')) ?>">
                                                                        <div class="w-100">
                                                                            <div class="w-100 justify-content-between">
                                                                                <h5 class="mb-2 tx-14 text-right mr-2">
                                                                                    <?= (!empty($b['pro']['title'])?$b['pro']['title']:(!empty($b['pro']['key'])?$b['pro']['key']:'')) ?>
                                                                                </h5>
                                                                                <small class="text-warning mx-1 f-right">
                                                                                    <?=$b['data']['count']?> عدد
                                                                                    <!--<?= (!empty($b['pro']['price'])?number_format($b['pro']['price']).'تومان':'رایگان') ?>-->
                                                                                </small>
                                                                                <small class="tx-9-f badge f-left badge-<?= (!empty($b['data']['payment_id'])?'success':'danger') ?>">
                                                                                    <?= (!empty($b['data']['payment_id'])?'پرداخت شده':'پرداخت نشده') ?>
                                                                                </small>
                                                                            </div>
                                                                            <br>
                                                                            <p class="mb-1 tx-10" title="<?= (!empty($b['pro']['description'])?$b['pro']['description']:'') ?>" style="overflow: hidden;white-space: nowrap;max-width: 150px;text-overflow: ellipsis;">
                                                                                <?= (!empty($b['pro']['description'])?$b['pro']['description']:'') ?>
                                                                            </p>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
<?php } ?>
