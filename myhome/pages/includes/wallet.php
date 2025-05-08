<?php 
$date=new JDF(); ?>
<div class="row row-sm my-3">
    <?php if(!empty($wallet) && is_array($wallet)){
        $chart_array=[]; 
        foreach($wallet as $a){
            $chart_array[]=(!empty($a['value']) && intval($a['value'])>0?intval($a['value']):0);
        } ?>
        <div class="col-12">
            <figure class="highcharts-figure">
                <div id="my_account" style="border-radius: 10px;max-height: 270px;"></div>
            </figure>
        	<script>
        	    Highcharts.chart('my_account', {
        	        title: {
                        text: 'تغییرات مالی'
                    },
                
                    xAxis: {
                        tickInterval: 1,
                        type: 'logarithmic',
                        accessibility: {
                            rangeDescription: 'Range: 1 to 10'
                        }
                    },
                
                    yAxis: {
                        title: {
                            text: 'مقدار'
                        }
                    },
                    series: [{
                        data: [<?= (!empty($chart_array) && is_array($chart_array)?(($a=implode(',',$chart_array))!==false && !empty(trim($a))?trim($a):''):'') ?>],
                        pointStart: 1
                    }]
                });
            </script>
        </div>
    <?php } ?>
	<div class="col-xl-3 col-md-6 col-lg-6 col-sm-6 my-1">
    	<a class="btn btn-dark-gradient w-100 h-100 p-5 rounded-10 shadow-light" href="<?= base_url('add_wallet_value') ?>">
			افزودن موجودی
    	</a>
	</div>
	<div class="col-xl-3 col-md-6 col-lg-6 col-sm-6 my-1">
    	<a class="btn btn-dark-gradient w-100 h-100 p-5 rounded-10 shadow-light" href="<?= base_url('wallet_payment') ?>">
		    آمار تراکنش ها
    	</a>
	</div>
	<div class="col-xl-3 col-md-6 col-lg-6 col-sm-6 my-1">
    	<a class="btn btn-dark-gradient w-100 h-100 p-5 rounded-10 shadow-light" href="<?= base_url('add_cart') ?>">
			حساب های بانکی 
    	</a>
	</div>
	<div class="col-xl-3 col-md-6 col-lg-6 col-sm-6 my-1">
    	<a class="btn btn-dark-gradient w-100 h-100 p-5 rounded-10 shadow-light" href="<?= base_url('remove_wallet_value') ?>">
		    تسویه حساب
        </a>
	</div>
</div>