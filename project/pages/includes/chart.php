<?php if(!empty($data)){
    $str=$times=$n='';$arr=$t=[];
    $c=range('a','z');
    $c[]=':';
    $c[]='-';
    $c[]='_';
    $c[]='/';
    $c[]='-';
    $c[]='+';
    ?>
    <script>
        <?php foreach($data as $a){
            $arr[$a['id']][]=['id'=>$a['id'],'title'=>$a['t'],'time'=>str_replace([':','/'],'.',$a['time']),'value'=>$a['v']];
        }
        foreach($arr as $key => $value){
            $b=[];
            $id=0;
            foreach($value as $v){
                $e=true;
                foreach ($c as $d) {
                    if (strpos($v['value'], $d)) {
                        if($e) $e=false;
                    }
                }
                if($e){
                    $id=$v['id'];
                    $n = $v['title'];
                    $t[] = "'".$v['time']."'";
                    $b[] = str_replace(',','',$v['value']);
                }
            }
            $str=implode(',',$b);
            $times=implode(',',$t);
            if(!empty($str)){ ?>
                var cat = [<?= $times ?>];
                chartMain.push({id:<?= $id ?>,info:{
                    title: {
                        text: '<?= $n ?>',
                            align: 'center'
                        },
                        chart: {
                            type: 'spline'
                        },
                        xAxis: {
                            categories: cat,
                        labels: {
                            formatter: function() {
                                const uniqueYears = Array.from(new Set(cat.map(x => new Date(x).getFullYear())));
                                const year = new Date(this.value).getFullYear();
                                if (uniqueYears.indexOf(year) !== -1) {
                                    uniqueYears.splice(uniqueYears.indexOf(year), 1);
                                    return year;
                                } else {
                                    return '';
                                }
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'تغییرات'
                        }
                    },
                    series: [{
                        data: [<?= $str ?>]
                    }],
                }});
            <?php 
                break;
            } 
        } ?>
        
    </script>
<?php } ?>
