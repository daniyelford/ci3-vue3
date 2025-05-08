<div class="container-fluid my-5">
    <div class="row row-sm main-content-app my-4">	
        <div class="col-xl-10 mx-auto col-lg-10 my-5">
            <a style="position: absolute;left: 13px;top: 10px;z-index: 9;" class="text-danger pull-left" href="<?= base_url() ?>ticket"><i class="fa fa-times"></i></a>
        <?php if(!empty($info)){?>
    		<div class="main-chat-list" id="ChatList">
    		    <?php foreach($info as $inf){?> 
    		    <div class="media new">
        			<div class="main-img-user online">
        			    <img alt="user picture" src="<?= base_url()?>assets/img/faces/1.png">
        			</div>
    				<div class="media-body">
    					<a href="<?= base_url().'ticket'.DS.'send_site'.DS.$inf['id'] ?>">
        					<div class="media-contact-name">
        						<span><?= (!empty($inf['name'])?$inf['name']:'کاربر شماره '.$inf['site_user_id']) ?></span>
        						<span><?= $inf['url'] ?></span>
            					<span><?= $inf['title'] ?></span>
            					<span><?= $inf['content'] ?></span>
        						<span><?= date('Y/m/d',strtotime($inf['time'])) ?></span>
        					</div>
    					</a>
    				</div>
    			</div>
    		    <?php }?>
    		</div>
    	<?php }else{?>
    	    <div class='alert rounded-10 alert-danger box-shadow-pink text-center p-5'>
    	        سایت هنوز به مشکل نخورده است
    	    </div>
    	<?php }?>
    	</div>
    </div>
</div>