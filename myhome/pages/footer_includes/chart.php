<?php if(!empty($chart)){ ?>
    <div class="modal chart" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
        	    <div class="modal-header">
        		    <button aria-label="" class="close"
        			onclick="hideChart();">
        			    <span aria-hidden="true">×</span>
        			</button>
        		</div>
        		<div class="modal-body">
        		    <figure class="highcharts-figure m-0">
                        <div id="chartContainer"></div>
                    </figure>
                    <script>
                        function changeChart(chartInfo){
                            if(chart) chart.destroy();
                            var chart = Highcharts.chart('chartContainer',chartInfo);
                            return true;
                        }
                    </script>
        		</div>
        	</div>
        </div>
    </div>
<?php } ?>