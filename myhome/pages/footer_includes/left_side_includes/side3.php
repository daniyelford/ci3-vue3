<div class="col-12 mb-2" style="max-height: 350px;overflow-y: auto;">
    <h6 class="text-center my-2">بسته های کسب و کار حرفه ای</h6>
    <?php if(!empty($my_order) && !empty($my_order['info'])){ 
        $date=new JDF();
        foreach ($my_order['info'] as $i) { ?>
        	<div class="list-group-item d-flex align-items-center" title="<?= (!empty($i['package']['description'])?$i['package']['description']:'') ?>">
        		<div class="ml-2">
        			<img class="avatar avatar-md brround cover-image" 
        		    src="<?= base_url('assets/svg/package/'.(!empty($i['package']['logo'])?$i['package']['logo']:'package.svg')) ?>">
        			<span style="right:60px;" class="avatar-status <?= (strtotime($i['order_info']["end_time"]) > time()?'bg-success':'bg-danger') ?>"></span>
        		</div>
        		<div class="">
        			<div class="font-weight-semibold">
        				<span class="tx-10-f">
            			    <?= (!empty($i['package']['title'])?$i['package']['title'].'<br>':'') ?>
        				</span>
        		    </div>
    				<small class="text-warning">
    					<?= (!empty($i['package']['price'])?number_format($i['package']['price']).' تومان':'رایگان') ?>
    			    </small>
        		    <span class="tx-8-f pt-1 m-1 badge <?= (strtotime($i['order_info']["end_time"]) > time()?'bg-success-transparent text-success':'bg-danger-transparent text-danger') ?>">
        		        <?php if(strtotime($i['order_info']["end_time"]) > time()){
        		            echo 'تاریخ انقضا:'.$date->jdate('H:i Y/m/d',strtotime($i['order_info']["end_time"]));
        		        }else{ ?>
        		            بسته منقضی شده
        		        <?php } ?>
        		    </span>
        		</div>
        		<div class="mr-auto">
        			<a class="btn btn-sm btn-light" onclick="showPayInfo(this);">
        			    <i class="fab fa-facebook-messenger"></i>
    			    </a>
    			</div>
        		<div class="d-none row w-100 pay-info" title="<?= $i['company_info']["description"] ?>">
    				<div class="col-1">
        				<a class="wd-20 ht-20 p-0 btn btn-sm btn-light" onclick="hidePayInfo(this);">
        				    <img class="w-100 h-100" src="<?= base_url('assets/svg/back.svg') ?>" alt="back to order info">
            			</a>
    				</div>
        			<div class="col-3 text-center">
            			<img style="height:50px" src="<?= base_url('assets/svg/company/'.(!empty($i['company_info']["icon"])?$i['company_info']["icon"]:'company.svg')) ?>">
            		</div>
        			<div class="col-2 pt-3">
                    	<?= $i['company_info']["title"] ?>
        			</div>    
    				<div class="col-4 tx-8-f pt-3">
    					<span>
    					    <?= $i['company_info']["description"] ?>
        			    </span>
    			    </div>
    			    <div class="col-1 px-0">
    			        <span class="tx-8-f m-1 badge <?= (intval($i['company_info']["type"])>0?'bg-success-transparent text-success':'bg-danger-transparent text-danger') ?>">
            		        <?= (intval($i['company_info']["type"])>0?
            		        'کسب و کار حرفه ای' 
            		        :
            		        'کسب و کار معمولی' 
            		        ) ?>
            		    </span>
            		    <br>
            		    <span class="tx-8-f m-1 badge <?= (intval($i['company_info']["status"])>0?'bg-success-transparent text-success':'bg-danger-transparent text-danger') ?>">
            		        <?= (intval($i['company_info']["status"])>0?'فعال':'غیر فعال' ) ?>
            		    </span>
    			    </div>
    		    </div>
            </div>
        <?php } 
    }else{ ?>
        <div class="alert alert-danger rounded-10 text-dark text-center p-3">
            شما سفارشی در بسته ها ندارید
        </div>	
    <?php } ?>
</div>