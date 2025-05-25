<?php
$date = new Jdf();
$start_time=time();
$end_time=time()+3600*24*30;
if(!empty($shop_data) && is_array($shop_data)){
    // $start_time=min(time(),min(array_values(array_column($shop_data, 'date_reserve'))));
    $end_time2=max(array_values(array_column($shop_data, 'exiting_time')));
    $end_time1=max(array_values(array_column($shop_data, 'date_reserve')));
    if(max($end_time2,$end_time1)>time()) $end_time=max($end_time2,$end_time1)+(3600*24);
} ?>
<style>
    .caltd{min-height:70px;min-width:16%;display:inline-block;text-align:center;max-width:49%;width:auto;border-bottom: 1px solid yellow;margin:0;}
</style>
<div style="overflow-y:scroll;">
    <?php for($time_counter=mktime(0,0,0,date("m",$start_time),date("d",$start_time), date("Y",$start_time));$time_counter<=$end_time;$time_counter=mktime(0,0,0,date("m",$time_counter),date("d",$time_counter)+1, date("Y",$time_counter))) { ?>
        <div class="caltd <?= mktime(0, 0, 0,  date('m',$time_counter), date('d',$time_counter), date('Y',$time_counter)); ?>" <?= (date('Y-m-d',$time_counter)===date('Y-m-d',time())?'style="background:#48ad09;border:1px solid blue;"':'') ?>>
            <strong>
                <?= $date->jdate('l',$time_counter) ?>
            </strong>
            <br>
            <small>
                <?= $date->jdate('Y/m/d',$time_counter) ?>
            </small>
            <div class="positionCalendarList">
                <?php if(!empty($shop_data) && is_array($shop_data)){
                    foreach($shop_data as $a){
                        if(!empty($a['date_reserve']) && intval($a['date_reserve'])>0){
                            if(($time_counter <= $a['date_reserve'] && $a['date_reserve']< $time_counter+(3600*24)) || ($time_counter>$a['date_reserve'] && ($a['exiting_time']>$time_counter+(3600*24) || $a['exiting_time']>$time_counter))){ ?>
                                <div class="CalendarPositionUserId<?= (!empty($a['position_user_id'])?$a['position_user_id']:0) ?> CalendarPositionId<?= (!empty($a['position_id'])?$a['position_id']:0) ?>" style="background-color:#<?= $a['background_color'] ?>;padding: 6px;border-radius: 10px;">
                                    <img class="wd-50 rounded-10" src="<?= base_url((!empty($a['info']['position_info']['icon'])?'assets/svg/position/'.$a['info']['position_info']['icon']:(!empty($a['info']['position_info']['qr_code'])?'assets/qrcode/'.$a['info']['position_info']['qr_code']:'assets/svg/position/position.svg'))) ?>">
                                    <br>
                                    <span>
                                        <?= (!empty($a['info']['company_info']['title'])?$a['info']['company_info']['title']:'') ?>
                                    </span>
                                    <br>
                                    <span>
                                        <?= (!empty($a['info']['position_info']['title'])?$a['info']['position_info']['title']:'') ?>
                                    </span>
                                    <br>
                                    <small>
                                        از  <?= $date->jdate('H:i Y/m/d',$a['date_reserve']) ?>
                                    </small>
                                    <br>
                                    <small>
                                        <?= (!empty($a['exiting_time'])?' تا '.$date->jdate('H:i Y/m/d',$a['exiting_time']):'') ?>
                                    </small>
                                    <br>
                                    <span>
                                        <?php if(!empty($a['position_user_status']) && intval($a['position_user_status'])>0){ 
                                            if(intval($a['position_user_status'])===6){
                                                echo 'اتمام خدمات';
                                            }
                                            if(intval($a['position_user_status'])===1){
                                                echo 'شما رسیدید';
                                            }
                                        }else{ 
                                            echo 'در انتظار شما';
                                        } ?>
                                    </span>
                                </div>
                            <?php }
                        }
                    }
                } ?>
            </div>
        </div>
    <?php } ?>
</div>