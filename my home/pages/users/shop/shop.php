<script src="<?= base_url('assets/js/users/shop/shop.js') ?>"></script>
<div class="row row-sm mt-3">
    <div class="col-lg-4">
        <div class="card mg-b-20">
    	    <div class="card-body text-center">
    		    <div class="pl-0">
    			    <div class="main-profile-overview">
    				    <div class="main-img-user profile-user">
    					    <img alt="user profile" src="<?= (!empty($info['image'])?$info['image']:base_url('assets/svg/user/user.svg')) ?>">
    					</div>
    					<h5 class="main-profile-name mg-b-20">
    					    <?= (!empty($info['name'])?$info['name']:'').' '.(!empty($info['family'])?$info['family']:'') ?>
    					</h5>
    				</div>
    				<nav class="nav main-nav-column">
                        <a href="<?= base_url('shopping') ?>" class="btn text-light <?= (!empty($type) && $type=='none_position'?'bg-success':'') ?> btn-block rounded-10 p-3 text-center nav-link showNonePosition">خرید آنی</a>
                        <a href="<?= base_url('reserve') ?>" class="btn text-light <?= (!empty($type) && $type=='has_position'?'bg-success':'') ?> btn-block rounded-10 p-3 nav-link text-center showHasPosition">رزرو ها</a>
    				</nav>
    				<hr class="mg-y-10">
					<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
					<div class="">
                        <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="https://www.my-home.ir/wallet">
                		    <i class="bx bx-dollar mx-1"></i>
                			کیف پول
                		</a>
                        <a style="text-align:start;" class="btn btn-block btn-dark-gradient p-1 rounded-10" href="https://www.my-home.ir/">
                		    <i class="la la-home mx-1"></i>
                			خانه
                		</a>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body" style="overflow-y: auto;overflow-x: hidden;max-height: 438px;">
                <?php if(!empty($my_position)){
                    echo (!empty($none_position)?$this->view('users/shop/shop_includes/none_position',['my_position'=>$none_position],true):'') . 
                    (!empty($has_position)?$this->view('users/shop/shop_includes/has_position',['my_position'=>$has_position],true):'');
                } else{ ?>
                    <div class="alert alert-danger rounded-10 text-dark text-center p-3">
                        شما سفارشی در جایگاه ها ندارید
                    </div>	
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if(!empty($calendar)){ ?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">تقویم رزرو ها</h4>
                </div>
                <div class="card-body" style="max-height:350px;overflow-y:auto;overflow-x:hidden;">
                    <?php $this->view('includes/calendar/shop_data',['shop_data'=>$calendar]); ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>