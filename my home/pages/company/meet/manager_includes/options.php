<div class="col-lg-4 col-xl-3 col-md-12 col-sm-12">
    <div class="card mg-b-20">
        <div class="main-content-left main-content-left-mail card-body">
            <h6 class="text-center mt-1 mb-3">
        	    درخواست کنندگان جلسه
            </h6>
        	<div class="main-mail-menu">
        	    <span style="max-height: 245px;overflow: auto;display: block;">
            	    <?php if(!empty($data) && is_array($data)){
            		    $f=false; ?>
            		    <nav class="nav main-nav-column mg-b-20">
                            <?php $repeat=[];
                            foreach($data as $m){ 
                                if(!empty($m['user']) && !empty($m['meet']['my']) && !empty($m['user']['user_id']) && 
                                intval($m['user']['user_id'])>0 && !in_array(intval($m['user']['user_id']),$repeat)){ 
                                    $repeat[]=intval($m['user']['user_id']); ?>
                        			<a class="nav-link changeUserMeetIdBtn px-2 py-4 <?= (!$f?'bg-dark':'') ?>" 
                        			onclick="changeUserMeetId(this,'.userId<?= intval($m['user']['user_id']) ?>');">
                        			    <img style="width: 30px;height: auto;max-height: 40px;border-radius: 50px;margin: 5px;" src="<?= (!empty($m['user']['user_info']["image"])?$m['user']['user_info']["image"]:base_url('assets/svg/user/user.svg')) ?>">
                                        <span>
                    					    <?= (!empty($m['user']['user_info']["name"])?$m['user']['user_info']["name"]:'').' '.(!empty($m['user']['user_info']["name"])?$m['user']['user_info']["family"]:'') ?>
                                        </span>
                        			</a>
                				    <?php $f=true;
                				}
                            } ?>
                        </nav>
            		<?php }else{ ?>
                        <div class="alert alert-danger rounded-10 text-center p-5">
                            درخواستی از همکارانتان برای تشکیل جلسه ای در کسب کار ثبت نگردیده است
                        </div>
        			<?php } ?>
        	    </span>
    			<label class="main-content-label main-content-label-sm">دسترسی سریع</label>
    			<nav class="nav main-nav-column">
    			    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('company_one') ?>">
    				    <i class="bx bx-folder-open mx-1"></i>
    					کسب و کار مربوط
    				</a>
    			    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url('company_manager') ?>">
    				    <i class="bx bx-slider-alt mx-1"></i>
    				    همه کسب و کارها
    			    </a>
					<a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link" href="<?= base_url() ?>">
    				    <i class="la la-home mx-1"></i>
    				    خانه
    			    </a>
    			</nav>
    	    </div>
        </div>
    </div>
</div>