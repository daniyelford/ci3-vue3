<?php if(!empty($reserve_position)){
    $date = new Jdf();
    $start_time=time()-3600*24*366;
    $end_time=time()+3600*24*366;
    if(!empty($reserve_position)){
        $start_time=time();
        $end_time2=max(array_values(array_column($reserve_position, 'exiting_time')));
        $end_time1=max(array_values(array_column($reserve_position, 'date_reserve')));
        $end_time=max($end_time2,$end_time1);
        $end_time=max($start_time,$end_time)+3600*24*7;
        // $number = count(array_filter($reserve_position,function($a) use ($time_counter, $next_day_time){ return $time_counter <= $a['date_reserve'] && $a['date_reserve'] <= $next_day_time; }));
            // echo ((!empty($limited) && intval($limited)>0 && $number<=$limited) || !(!empty($limited) && intval($limited)>0)?'onclick="positionStartDateClick(this,'.$today_time.');"':'') ;
    }?>
    <style>
        .caltd{min-height:70px;min-width:16%;display:inline-block;text-align:center;max-width:49%;width:auto;border-bottom: 1px solid yellow;margin:0;}
    </style>
    <div style="overflow-y:scroll;">
        <?php for($time_counter=mktime(0,0,0,date("m",$start_time),date("d",$start_time), date("Y",$start_time));$time_counter<=$end_time;$time_counter=mktime(0,0,0,date("m",$time_counter),date("d",$time_counter)+1, date("Y",$time_counter))) { ?>
            <div class="caltd" <?= (date('Y-m-d',$time_counter)===date('Y-m-d',time())?'style="background:#48ad09;border:1px solid blue;"':'') ?>>
                <strong>
                    <?= $date->jdate('l',$time_counter) ?>
                </strong>
                <br>
                <small>
                    <?= $date->jdate('Y/m/d',$time_counter) ?>
                </small>
                <div class="positionCalendarList">
                    <?php if(!empty($reserve_position)){
                        foreach($reserve_position as $a){
                            if(!empty($a['date_reserve']) && intval($a['date_reserve'])>0){
                                if(
                                ($time_counter<=$a['date_reserve'] && $a['date_reserve']<$time_counter+(3600*24)) || 
                                ($a['date_reserve']<$time_counter && 
                                ($a['exiting_time']>$time_counter+(3600*24) || $a['exiting_time']>$time_counter))){ ?>
                                    <div style="background-color:pink;padding: 6px;border-radius: 10px;height:10px;"></div>
                                <?php }
                            }
                        }
                    } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>