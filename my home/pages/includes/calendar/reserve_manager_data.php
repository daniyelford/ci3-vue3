<?php $date = new Jdf();
    $start_time=time()-3600*24*15;
    $end_time=time()+3600*24*15;
    if(!empty($reserve_manager_data)){
        $start_time=time();
        $end_time=max(array_values(array_column($reserve_manager_data, 'end')));
        $end_time1=max(array_values(array_column($reserve_manager_data, 'start')));
        $end_time=max($end_time,$end_time1)+3600*24;
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
                    <?php if(!empty($reserve_manager_data)){
                        foreach($reserve_manager_data as $a){
                            if(!empty($a['start']) && intval($a['start'])>0){
                                if(($time_counter<$a['start'] && $a['start']<$time_counter+(3600*24)) || ($time_counter>$a['start'] && ($a['end']>$time_counter+(3600*24) || $a['end']>$time_counter))){ ?>
                                    <div class="<?php if(!empty($_GET)) {
                                        if(!empty($_GET['user']) && intval($_GET['user'])>0 && !empty($_GET['count']) && intval($_GET['count'])>0){
                                            if(!empty($a['position_id']) && intval($a['position_id'])===intval($_GET['count']) && !empty($a['position_user_id']) && intval($a['position_user_id'])===intval($_GET['user'])){
                                            }else{
                                                echo 'd-none';
                                            }
                                        }elseif(!empty($_GET['count']) && intval($_GET['count'])>0){
                                            if(!empty($a['position_id']) && intval($a['position_id'])===intval($_GET['count'])){
                                            }else{
                                                echo 'd-none';
                                            }
                                        }else{
                                            echo 'd-none';
                                        }
                                    }?> CalendarPositionUserId<?= (!empty($a['position_user_id'])?$a['position_user_id']:0) ?> CalendarPositionId<?= (!empty($a['position_id'])?$a['position_id']:0) ?>" style="background-color:<?= $a['background_color'] ?>;padding: 6px;border-radius: 10px;">
                                        <img class="wd-50 rounded-10" src="<?= (!empty($a['user']['image'])?$a['user']['image']:base_url('assets/svg/user/user.svg')) ?>">
                                        <br>
                                        <span>
                                            <?= (!empty($a['user']['name'])?$a['user']['name']:'').' '.(!empty($a['user']['family'])?$a['user']['family']:'') ?>
                                        </span>
                                        <br>
                                        <span>
                                            <?= (!empty($a['position_title'])?$a['position_title']:'') ?>
                                        </span>
                                        <br>
                                        <small>
                                            از <?= $date->jdate('H:i Y/m/d',$a['start']) ?>
                                        </small>
                                        <br>
                                        <small>
                                            <?= (!empty($a['end'])?' تا '.$date->jdate('H:i Y/m/d',$a['end']):'') ?>
                                        </small>
                                        <br>
                                        <span>
                                            <?php if(!empty($a['position_user_status']) && intval($a['position_user_status'])>0){ 
                                                if(intval($a['position_user_status'])===6){
                                                    echo 'اتمام خدمات';
                                                }
                                                if(intval($a['position_user_status'])===1){
                                                    echo 'مشتری رسیده';
                                                }
                                            }else{ 
                                                echo 'در انتظار مشتری';
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