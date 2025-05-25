<?php  ?>
<!-- content -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
	    <div>
    	    <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
    		    مدیریت کسب و کار خانه من
    		</h2>
    		<p class="mg-b-0">
    		    همه چیز در منزل من برای شما محیاست کافیست 
    		    <strong>
        		    <?= (!empty($id) && intval($id)>0?'كاسب و كار خود را با  '."<img class='wd-25' src='".base_url('assets/svg/icon/menu.svg')."'>".'مديريت كنيد':'وارد شوید') ?>
    		    </strong>
    		</p>
		</div>
	</div>
	<div class="main-dashboard-header-right">
	    <?php if(!empty($wallet)){ ?>
	        <div class="row">
    		    <div class="col-8">
    			    <input type="hidden" value="<?= (!empty($wallet['id']) && intval($wallet['id'])>0?intval($wallet['id']):'') ?>" id='wallet-id'>
    				<div class="main-star">
    				    <a href="<?= base_url('add_wallet_value') ?>" class="hd-50 wd-150 tx-13 btn btn-dark-gradient rounded-10 p-0">
    					    <img class="wd-50 hd-50" src="<?= base_url('assets/svg/icon/wallet.svg') ?>" alt="pay">
    						افزودن موجودی
    					</a>
    				</div>
    			</div>
    			<div class="col-4 text-left">
                    <h5 class="tx-10-f pt-3">موجودی:<?= (!empty($wallet['value'])?number_format($wallet['value']):0) ?><i class="tx-8-f">تومان</i></h5>
    			</div>
    	    </div>
		<?php } ?>
	</div>
</div>
<!-- content -->
<!-- tablighat -->
<div class="row row-sm">
	<div class="col-12">
	    <div class="card overflow-hidden sales-card rounded-20">
		    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
			    <a href="<?= base_url('map') ?>">
    			    <img style="width:100%;opacity:0.8;position: absolute;top: -40px;left: 0;right: 0;bottom: 0;min-height:300px;" src="<?= base_url('assets/pic/geoPos.jpg') ?>">
    				<div class="text-center">
                        <h3 class="tx-30-f text-white ht-150 pt-5" style="position: relative;text-shadow: 1px 1px 3px #0400ff;">نقشه</h3>
    				</div>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- tablighat -->
<!-- product & position -->
<div class="row row-sm mb-2" id="app">
	<?php $this->view('index_includes/company_position_product'); 
	$this->view('index_includes/position');
    $this->view('index_includes/company_product'); 
    //$this->view('index_includes/product'); ?>
</div>
<!-- product & position -->
<div class="row">
    <div class="col-12">
		<div class="card ">
		    <div class="card-body">
				<div>
    				<h6 class="card-title mb-1">
    				    به My-Home.ir - فضای دفتر مجازی شما خوش آمدید
    				</h6>
				    <p class="text-muted card-sub-title">
    				    ما در My-Home.ir اهمیت انعطاف پذیری و راحتی را در دنیای پر سرعت امروز درک می کنیم.به همین دلیل است که ما مشتاقیم پلتفرم آنلاین خود را معرفی کنیم، که برای کمک به مدیریت کسب و کار و فروش محصولات یا خدمات خود به راحتی طراحی شده است.
				    </p>
				</div>
				<div aria-multiselectable="true" class="accordion accordion-dark" id="accordion2" role="tablist">
				    <div class="card mb-0">
					    <div class="card-header" id="headingOne2" role="tab">
						    <a aria-controls="collapseOne2" aria-expanded="false" data-toggle="collapse" href="#collapseOne2">
						        My-Home.ir چیست؟
						    </a>
						</div>
						<div aria-labelledby="headingOne2" class="collapse show" data-parent="#accordion2" id="collapseOne2" role="tabpanel">
						    <div class="card-body">
    							<strong>
                                    My-Home.ir
                			    </strong>
                                یک پلتفرم آنلاین منحصر به فرد است که به شما امکان می دهد یک فضای اداری مجازی ایجاد کنید که در آن بتوانید کسب و کار خود را مدیریت کنید، محصولات خود را بفروشید و زمان را برای رزرو خدمات خود در فضای جایگاه مدیریت کنید. فرقی نمی کند کارآفرین، فریلنسر یا صاحب کسب وکار کوچک باشید، پلتفرم ما برای کمک به شما در ساده سازی عملیات و افزایش بهره وری طراحی شده است. 
							</div>
						</div>
					</div>
					<div class="card mb-0">
					    <div class="card-header" id="headingTwo2" role="tab">
						    <a aria-controls="collapseTwo2" aria-expanded="true" class="collapsed" data-toggle="collapse" href="#collapseTwo2">
						        ویژگی های کلیدی My-Home.ir
						    </a>
						</div>
						<div aria-labelledby="headingTwo2" class="collapse" data-parent="#accordion2" id="collapseTwo2" role="tabpanel">
						    <div class="card-body">
                                یک فضای اداری مجازی ایجاد کنید که در آن بتوانید تجارت و محصولات خود را مدیریت کنید  محصولات یا خدمات خود را مستقیماً به مشتریان بفروشید  زمان رزرو مکان های خدمات و مدیریت قرار ملاقات ها وظایف را به اعضای تیم محول کنید و جلسات را به راحتی برگزار کنید 
					    	</div>
						</div>
					</div>
    				<div class="card mb-0">
    				    <div class="card-header" id="headingThree2" role="tab">
    					    <a aria-controls="collapseThree2" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseThree2">
    					        طرحهای تک مالکی در مقابل چند مالکی
    					    </a>
    					</div>
    				    <div aria-labelledby="headingThree2" class="collapse" data-parent="#accordion2" id="collapseThree2" role="tabpanel">
    					    <div class="card-body">
                                ما دو طرح را متناسب با نیازهای تجاری شما ارائه می دهیم:
                                <h5>
                                    طرح تک مالک
                                </h5>
                                طرح رایگان برای کارآفرینان انفرادی و مشاغل کوچک با نیازهای محدود. شما می توانید یک فضای اداری مجازی ایجاد کنید، محصولات را بفروشید، و محل های زمانی را برای مکان های خدمات رزرو کنید.
                                <h5>
                                    طرح چند مالک 
                                </h5>
                                طرح پولی برای مشاغل بزرگتر با اعضای تیم متعدد. می توانید وظایفی را به اعضای تیم محول کنید، جلساتی را برگزار کنید و قرار ملاقات ها را به طور موثرتری مدیریت کنید.
                                <h6>
                                    فواید
                                </h6>
                                <ol>
                                    <li>
                                        بهره وری و کارایی خود را افزایش دهید 
                                    </li>
                                    <li>
                                        پایگاه مشتریان خود را گسترش دهید و فروش را افزایش دهید 
                                    </li>
                                    <li>
                                        عملیات تجاری خود را ساده کنید و هزینه ها را کاهش دهید 
                                    </li>
                                    <li>
                                        همکاری و ارتباط با تیم خود را افزایش دهید
                                    </li>
                                </ol>
    						</div>
    					</div>
    				</div>
    			</div>
			</div>
    		<div class="card-footer">
    			<div class="alert alert-warning rounded-10 text-center">
                    امروز شروع کنید!
                </div>
                <div>
                    همین حالا ثبت نام کنید و از مزایای My-Home.ir استفاده کنید! طرحی را انتخاب کنید که متناسب با نیازهای کسب و کار شما باشد و همین امروز شروع به ساخت فضای اداری مجازی خود کنید. 
                </div>
                <div class="text-center">
            		<a href="https://t.me/my_home0ir" class="card-link text-white"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0,0,256,256"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="none" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><circle cx="24" cy="24" r="21" fill="#59e8ed" stroke="none" stroke-linejoin="miter"></circle><path d="M45.051,24c0,3.826 -1.069,7.415 -2.857,10.504c-1.844,3.187 -4.305,6.189 -7.492,8.033c-3.089,1.787 -6.877,2.871 -10.702,2.871c-3.826,0 -7.567,-1.165 -10.656,-2.952c-3.187,-1.844 -5.847,-4.677 -7.69,-7.864c-1.787,-3.089 -2.276,-6.766 -2.276,-10.592c0,-3.826 0.68,-7.393 2.467,-10.482c1.844,-3.187 4.366,-6.038 7.553,-7.882c3.089,-1.787 6.776,-2.448 10.602,-2.448c3.826,0 7.371,0.906 10.46,2.694c3.187,1.844 5.545,4.627 7.389,7.814c1.787,3.089 3.202,6.478 3.202,10.304z" fill="none" stroke="#010101" stroke-linejoin="miter"></path><path d="M17.689,26.814c0.492,1.906 1.089,3.785 1.785,5.626c0.151,0.399 0.366,0.85 0.782,0.946c0.367,0.084 0.725,-0.152 1.02,-0.386c0.846,-0.672 1.616,-1.439 2.292,-2.282c1.123,0.936 2.304,1.808 3.427,2.744c0.437,0.364 0.884,0.734 1.414,0.94c0.53,0.205 1.168,0.22 1.635,-0.104c0.321,-0.222 0.525,-0.574 0.692,-0.927c0.364,-0.765 0.633,-1.572 0.833,-2.395c0.8,-3.306 0.851,-6.256 2.324,-9.936c0.473,-1.182 0.572,-2.491 0.653,-3.76c0.048,-0.748 -0.541,-1.378 -1.289,-1.408c-0.89,-0.036 -1.761,0.193 -2.619,0.451c-6.127,1.842 -11.582,4.246 -17.015,6.668c-0.505,0.225 -1.044,0.413 -1.436,0.803c-0.221,0.22 -0.397,0.518 -0.365,0.828c0.058,0.568 0.716,0.837 1.268,0.98c1.537,0.398 3.043,0.915 4.599,1.212z" fill="#d6e5e5" stroke="none" stroke-linejoin="miter"></path><path d="M20.843,28.309l-0.304,4.904l3.03,-2.496z" fill="#bcbcbc" stroke="none" stroke-linejoin="miter"></path><path d="M20.721,28.01c1.109,1.117 2.262,2.191 3.455,3.219" fill="none" stroke="#010101" stroke-linejoin="round"></path><path d="M18.264,26.388l11.376,-7.433l0.506,0.455l-8.949,8.242l-0.405,1.264l-0.657,4.247l-2.377,-5.966z" fill="#bcbcbc" stroke="none" stroke-linejoin="miter"></path><path d="M17.689,26.814c0.492,1.906 1.089,3.785 1.785,5.626c0.151,0.399 0.366,0.85 0.782,0.946c0.367,0.084 0.725,-0.152 1.02,-0.386c0.846,-0.672 1.616,-1.439 2.292,-2.282c1.123,0.936 2.304,1.808 3.427,2.744c0.437,0.364 0.884,0.734 1.414,0.94c0.53,0.205 1.168,0.22 1.635,-0.104c0.321,-0.222 0.525,-0.574 0.692,-0.927c0.364,-0.765 0.633,-1.572 0.833,-2.395c0.8,-3.306 0.851,-6.256 2.324,-9.936c0.473,-1.182 0.572,-2.491 0.653,-3.76c0.048,-0.748 -0.541,-1.378 -1.289,-1.408c-0.89,-0.036 -1.761,0.193 -2.619,0.451c-6.127,1.842 -11.582,4.246 -17.015,6.668c-0.505,0.225 -1.044,0.413 -1.436,0.803c-0.221,0.22 -0.397,0.518 -0.365,0.828c0.058,0.568 0.716,0.837 1.268,0.98c1.537,0.398 3.043,0.915 4.599,1.212z" fill="none" stroke="#010101" stroke-linejoin="round"></path><path d="M17.689,26.814c3.357,-2.222 6.437,-4.187 9.794,-6.409c0.695,-0.46 2.562,-1.753 2.87,-1.262c0.411,0.654 -6.383,5.935 -9.624,8.879c-0.164,1.727 -0.287,3.459 -0.37,5.192" fill="none" stroke="#010101" stroke-linejoin="round"></path></g></g></svg></a>
                </div>
    		</div>
		</div>
	</div>
</div>