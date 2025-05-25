<?php if(!empty($data) && !empty($data['products']) && !empty($role_id) && intval($role_id)>0){ ?>
    <link href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/plugins/select2/js/select2.min.js') ?>"></script>
    <style>td {padding: 5px !important;font-size: 9px !important;}.select2-selection__rendered,.select2.select2-container.select2-container--default,span.select2.select2-container.select2-container--default.select2-container--below,span.select2.select2-container.select2-container--default.select2-container--focus,.select2-selection.select2-selection--single{width:100% !important;height:50px !important;}</style>
    <script src="<?= base_url('assets/js/home/product.js') ?>"></script>
    <script src="<?= base_url('assets/js/includes/format_number.js') ?>"></script>
	<div class="row row-sm mt-2">
	    <div class="col-lg-4">
			<div class="card mg-b-20">
			    <div class="card-body text-center">
				    <div class="pl-0">
					    <div class="main-profile-overview">
					        <a class="btn btn-primary btn-compose btn-block" onclick="showAddProduct();">
						        ایجاد محصول
						    </a>
							<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
							<div class="row">
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('company_one') ?>">
                					    <i class="bx bx-folder-open mx-1"></i>
                					    کسب و کار مربوط
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('company_manager') ?>">
                					    <i class="bx bx-slider-alt mx-1"></i>
                					    همه کسب و کارها
                				    </a>
                                </div>
                                <div class="col-12 mt-1">
                                    <a style="text-align:start;" class="btn btn-block btn-dark-gradient p-1 rounded-10" href="<?= base_url() ?>">
                			            <i class="la la-home mx-1"></i>
                					    خانه
                				    </a>
                                </div>
							</div>
					    </div>
				    </div>
			    </div>
		    </div>
		</div>
		<div class="col-lg-8">
    	   <div class="row row-sm mb-2">
    		    <div class="col-12 text-center">
        	        <div class="text-right btn btn-success btn-block rounded-10">
        	            <i class="si si-basket-loaded tx-50 pr-2"></i>
            		    <h3 class="f-left ml-3 mb-3 mt-2 pt-1">
            		        مدیریت محصولات
            		    </h3>
        	        </div>
    		    </div>
		    </div>
		    <span id="position-control">
        		<div class="row row-sm">
        		    <div class="col-12">
        			    <div class="card">
        				    <div class="card-body bg-warning-gradient rounded-10">
        					    <div class="counter-status d-flex md-mb-0">
        						    <div class="counter-icon bg-primary-transparent px-2 pt-1">
        							    <i class="icon ion-md-cube tx-50-f text-primary"></i>
        						    </div>
        							<div class="mr-auto">
        							    <h5 class="tx-13 tect-center">محصولات تحت پوشش</h5>
        								<h2 class="mb-0 tx-22 mb-1 mt-1 tect-center" id="product-count"></h2>
        								<p class="text-primary mb-0 tx-11">
        								    <i class="si si-arrow-up-circle text-success mx-1"></i>محصولات دارای تخصص</p>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        		<div class="card">
        		    <div class="card-header pb-0">
        			    <h5>
        			        محصولات من
        			    </h5>
        			    <p>
        			        شما در این بخش محصولاتی را برای کارشناسی دقیق تر در اختیار دارید تا برای نمایش اطلاعات آن را واضح کنید
        			    </p>
        		    </div>
        			<div class="card-body pt-1">
        			    <?php
        			    if(intval($role_id)==1||intval($role_id)==8){
        			        if(!empty($data['products']['all'])){ ?>
        				        <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
            					    <?php
            					    foreach($data['products']['all'] as $a){
            					        if(!empty($a) && !empty($a['company_category_product_position_id']) && intval($a['company_category_product_position_id'])>0 && !empty($a['product_info']) && !empty($a['product_info']['info']) && empty($a['product_info']['info']['deleted_at'])){ 
            					            $product_info=$a['product_info']['info'];?>
            					            <div class="main-mail-item" style="padding-right: 27px;" title="<?= (!empty($product_info['description'])?$product_info['description']:'') ?>">
            									<div class="main-mail-star" style="display: flex;flex-direction: column;flex-wrap: nowrap;align-items: center;">
            									    <a class="text-white bg-dark rounded-10 my-1" onclick="productAction('m',<?= intval($product_info['id']) ?>);"><i class="fa fa-cog fa-spin"></i></a>
            									</div>
            									<div class="main-img-user">
            									    <img alt="product icon" src="<?= base_url('assets/svg/product/'.(!empty($product_info['icon'])?$product_info['icon']:'product.svg')) ?>">
            									</div>
            									<div class="">
            										<div class="main-mail-from">
            										    <?= (!empty($product_info['title'])?$product_info['title']:(!empty($product_info['key'])?$product_info['key']:'')) ?>
            									    </div>
            										<div class="main-mail-subject tx-10-f" style="max-width: 123px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" title="<?= (!empty($product_info['description'])?$product_info['description']:'') ?>">
            										    <small class="exists <?= (!empty($product_info['status']) && intval($product_info['status'])>0?'':'d-none') ?> text-warning">
                        								    قیمت:
                        									<?= (!empty($product_info['price'])?number_format($product_info['price']).'تومان':'رایگان') ?>
                    								    </small>
                									    <small class="notExists <?= (!empty($product_info['status']) && intval($product_info['status'])>0?'d-none':'') ?> badge bg-danger-transparent text-danger mr-auto ml-1">
                									        ناموجود
                									    </small>
            										</div>
            									</div>
            									<div class="main-mail-date pt-2">
            									    <a class="disable <?= (!empty($product_info['status']) && intval($product_info['status'])>0?'':'d-none') ?>" onclick="diableProductRequest(this,<?= intval($product_info['id']) ?>);">
                                                        <i class="fas fa-ban tx-20-f text-danger"></i>
                                                    </a>
                                                    <a class="enable <?= (!empty($product_info['status']) && intval($product_info['status'])>0?'d-none':'') ?>" onclick="enableProductRequest(this,<?= intval($product_info['id']) ?>);">
                                                        <i class="far fa-check-circle tx-20-f text-success"></i>
                                                    </a>
                									<a class="text-white rounded-10 mb-1" onclick="productAction('d',<?= intval($product_info['id']) ?>);"><i class="fa fa-pen tx-20"></i></a>
                                                    <a class="disableDelete" onclick="deleteManagerProduct(this,<?= intval($product_info['id']) ?>);">
                                                        <i class="fas fa-trash tx-20-f text-danger"></i>
                                                    </a>
            									</div>
            								</div>
            					    <?php } 
            					    } ?>
        					    </div>
        				<?php }else{ ?>
        				    <div class="alert alert-danger text-center p-3 rounded-10">
            				    شما محصولی در کسب و کار خود ندارید یکی اضافه کنید
            				</div>
        			    <?php }
        			    }else{
        			        if(!empty($data['products']['access'])){ ?>
        			            <div class="main-content-body main-content-body-mail" style="max-height:250px;overflow-y:auto">
            					    <?php foreach($data['products']['access'] as $a){
            					        if(!empty($a) && !empty($a['company_category_product_position_id']) && intval($a['company_category_product_position_id'])>0 &&
            					        !empty($a['product_info']) && !empty($a['product_info']['info']) && empty($a['product_info']['info']['deleted_at'])){ 
                					        $product_information=$a['product_info']['info']; ?>
            					            <div class="main-mail-item" title="<?= (!empty($product_information['description'])?$product_information['description']:'') ?>">
            									<div class="main-mail-star" style="display: flex;flex-direction: column;flex-wrap: nowrap;align-items: center;">
            									    <a class="text-white bg-dark rounded-10 my-1" onclick="productAction('m',<?= intval($product_information['id']) ?>);"><i class="fa fa-cog fa-spin"></i></a>
            									</div>
            									<div class="main-img-user">
            									    <img alt="product icon" src="<?= base_url('assets/svg/product/'.(!empty($product_information['icon'])?$product_information['icon']:'product.svg')) ?>">
            									</div>
            									<div class="">
            										<div class="main-mail-from">
            										    <?= (!empty($product_information['title'])?$product_information['title']:(!empty($product_information['key'])?$product_information['key']:'')) ?>
            									    </div>
            										<div class="main-mail-subject tx-10-f" style="max-width: 123px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                									    <small class="exists <?= (!empty($product_information['status']) && intval($product_information['status'])>0?'':'d-none') ?> text-warning">
                        								    قیمت:
                									        <?= (!empty($product_information['price'])?number_format($product_information['price']).'تومان':'رایگان') ?>
                        								</small>
                    									<small class="notExists <?= (!empty($product_information['status']) && intval($product_information['status'])>0?'d-none':'') ?> badge bg-danger-transparent text-danger mr-auto ml-1 float-left">
                    									    ناموجود
                    									</small>
            										</div>
            									</div>
            									<div class="main-mail-date pt-2">
            									    <a class="disable <?= (!empty($product_information['status']) && intval($product_information['status'])>0?'':'d-none') ?>" onclick="diableProductRequest(this,<?= intval($product_information['id']) ?>);">
                                                        <i class="fas fa-ban tx-20-f text-danger"></i>
                                                    </a>
                                                    <a class="enable <?= (!empty($product_information['status']) && intval($product_information['status'])>0?'d-none':'') ?>" onclick="enableProductRequest(this,<?= intval($product_information['id']) ?>);">
                                                        <i class="far fa-check-circle tx-20-f text-success"></i>
                                                    </a>
                									<a class="text-white bg-dark rounded-10 mb-1" onclick="productAction('d',<?= intval($product_information['id']) ?>);"><i class="fa fa-pen tx-20"></i></a>
            									</div>
            								</div>
            					    <?php } 
            					    } ?>
        					    </div>
        			        <?php }else{ ?>
        			            <div class="alert alert-danger text-center p-3 rounded-10">
            				        شما محصولی در کسب و کار خود ندارید یکی اضافه کنید
            				    </div>
        			    <?php }
        			    } ?>
        		    </div>
        	    </div>
    	    </span>
		</div>
	</div>
	<div class="d-none" id="add-product">
        <div class="modal d-block" id="myModal" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">افزودن محصول</h6>
                        <button onclick="hideAddProduct();" class="close">
                            <span>×</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 500px;overflow: auto;">
                        <div class="card mb-0">
                            <div class="card-header">
                                <div class="row mt-2">
                                    <div class="col-12 text-center">
                                        عکس اصلی محصول را بارگذاری کنید
                                    </div>
                                    <div class="col-md-6 mt-2 mx-auto text-center">
                                        <?= (!empty($product_logo_uploader)?$product_logo_uploader:'') ?>
                                    </div>
                                </div>
                            </div>    
                            <div class="card-body py-0">
                                <hr>
                                <div class="row my-2">
                                    <div class="col-md-6 my-2">
        								<label>
        								    نام محصول
        								</label>
        								<input class="form-control shadow-light rounded-10" id="product-title" placeholder="اسم مورد نظر" type="text">
        							</div>
        							<div class="col-md-6 my-2">
                                        <?php if(!empty($category)){ ?>
                                            <label for="role-chooser">
                                                دسته بندی محصول خود را تعیین کنید
                                            </label>
                                            <select id="product-category" class="form-control text-center SlectBox SumoUnder shadow-light rounded-10" tabindex="-1">
                                                <option value="0">متفرقه</option>
                                                <?php foreach($category as $a){ 
                                                    if(!empty($a) && !empty($a['id']) && !empty($a['title'])){ ?>
                                                        <option value="<?= $a['id'] ?>"><?= $a['title'] ?></option>
                                                <?php } 
                                                } ?>
            					    		</select>
                                        <?php } ?>
                                    </div>
        						</div>
        						<div class="row my-2">
        							<div class="col-12">
        								<label>
        								    توضیحات کامل
        								</label>
        								<textarea row="4" class="form-control shadow-light rounded-10" id="product-description" placeholder="توضیحات کامل"></textarea>
        							</div>
        						</div>
        						<div class="row my-2">
        							<div class="col-12" id="custom-price">
            							<label>
            							    قیمت به تومان 
            							</label>
        								<div class="row">
        								    <div class="col-md-6">
        								        <div class="input-group shadow-light rounded-10 overflow-hidden">
                        							<div class="input-group-prepend">
                        								<div class="input-group-text">
                        									<label class="rdiobox wd-16 mg-b-0">
                        									    <input onclick="changePrice(this);" class="radio-type" value="" name="data[]" type="radio" checked>
                        									    <span></span>
                        								    </label>
                        								</div>
                        							</div>
                        						    <input class="form-control" readonly="" placeholder="هدیه است">
                        						</div>
        								    </div>
        								    <div class="col-md-6">
        								        <div class="input-group shadow-light rounded-10 overflow-hidden">
                        							<div class="input-group-prepend">
                        								<div class="input-group-text">
                        									<label class="rdiobox wd-16 mg-b-0">
                        									    <input onclick="changePrice(this);" class="radio-type" value="p" name="data[]" type="radio">
                        									    <span></span>
                        								    </label>
                        								</div>
                        							</div>
                                                    <input type="number" onkeyup="addTax(this);" step="1000" class="form-control" id="product-price" readonly="" placeholder="قیمت محصول">
        								            <input type="hidden" class="form-control" id="product-price-total">
                        						</div>
        								    </div>
        								</div>
        						    </div>
            						<div class="col-12">
            						    <?php if(!empty($other_product_price)){ ?>
                                            <label class="ckbox my-3">
                                    			<input type="checkbox" onchange="combinePrice(this);" <?= (!empty($relations) && array_search('1',array_column($relations,'status'))!==false?'checked':'') ?>>
                                                <span>
                                                    قیمت گذاری آنلاین
                                                </span>
                                            </label>
                                			<div class="row d-none" id="online-price">
                                    		    <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <select id="productPriceList" class="form-control w-100" onchange="productPriceListChange(this);"></select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-12">
                                                            <textarea class="form-control" id="onlineProductDescription" placeholder="توضیحات"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-4">
                                                            <input class="form-control" type="number" step='any' id="zarib" placeholder="ضریب">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="number" id="onlineProductPrice" class="form-control" placeholder="قیمت به تومان">
                                                        </div>
                                                        <div class="col-4">
                                                            <a class="btn btn-success btn-block" id="addCustomPrice" onclick="addCustomPriceAction();">
                                                                افزودن 
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="card mb-0 d-none" id="create-prices">
                                                        <div class="card-body pb-0">
                                            			    <div class="table-responsive">
                                            				    <table class="table text-md-nowrap" id="example1">
                                            					    <thead>
                                            						    <tr>
                                            							    <th class="wd-lg-40p">نوع</th>
                                            								<th class="wd-lg-40p">توضیحات</th>
                                            								<th class="wd-lg-5p">ضریب</th>
                                            								<th class="wd-lg-20p">قیمت</th>
                                            								<th class="wd-lg-20p">جمع</th>
                                            								<th class="wd-lg-30p">عملیات</th>
                                            							</tr>
                                            						</thead>
                                        							<tbody id="priceLists">
                                        							</tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    		</div>
                                		<?php } ?>
            					    </div>
        						    <div class="col-12" id="newPriceInner">
                                    	<div class="alert alert-warning text-center p-4 mt-4 rounded-10">
                                    	    قیمت با احتساب مالیات:
                                    		<span id="newPrice">رایگان</span>
                                        </div>
                    				</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="addProductAction();">
                            ایجاد محصول  
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script>
	    let pricesArray=[],num=0,allTotals=0;
	    function removePriceRow(el,num){
	        let newPrice=0,a;
	        $(el).parent().parent().remove();
	        allTotals-=parseFloat(pricesArray[num]['4']);
	        a=pricesArray.indexOf(pricesArray[num]);
    	    delete pricesArray[a];
	        if($('#priceLists').children().length===0){
    	        $('#create-prices').addClass('d-none');
    	        $('#newPrice').text('رایگان');
    	        allTotals=0;
    	    }else{
        	    newPrice=allTotals+(allTotals/10);
        	    $('#newPrice').text($.number_format(newPrice)+' تومان');
    	    }
	        
	    }
	    function addCustomPriceAction(){
            let a=parseInt($('#productPriceList').val()),valid=true,newPrice=0,total=0,type='',price=parseFloat($('#priceSelected').val()),zarib=parseFloat($('#zarib').val());
            if(isNaN(a)){a=0;}
            if(isNaN(zarib)){zarib=0;}
            if(isNaN(price)){price=0;}
            if(a===0){type="قیمت ثابت";}else{type=$('#titleSelected').val();}
            if(zarib===0){
                $('#zarib').css('border','1px solid red');
                valid=false;
            }
            if(a==0 && $('#onlineProductPrice').val()==''){
                $('#onlineProductPrice').css('border','1px solid red');
                valid=false;
            }
            if(valid && price===0){price=$('#onlineProductPrice').val();}
            if(valid){
                total=zarib*price;
                allTotals+=total;
                pricesArray[num]=[
                    a,
                    price,
                    $('#onlineProductDescription').val(),
                    $('#zarib').val(),
                    total,
                ];
                $('#zarib').css('border','none');
                $('#onlineProductPrice').css('border','none');
                $('#priceLists').html($('#priceLists').html()+"<tr><td>"+type+"</td><td>"+$('#onlineProductDescription').val()+"</td><td>"+zarib+"</td><td>"+$.number_format(price)+" تومان"+"</td><td>"+$.number_format(total)+" تومان"+"</td><td><a onclick='removePriceRow(this,"+num+");'><i class='fas fa-trash tx-20-f text-danger'></i></a></td></tr>");
                if($('#create-prices').hasClass('d-none')){
                    $('#create-prices').removeClass('d-none');
                }
                $('#onlineProductPrice').val('');
                $('#onlineProductDescription').val('');
                $('#zarib').val('');
                $('#productPriceList').val('0');
                $('#productPriceList').trigger('change');
                newPrice=allTotals+(allTotals/10);
                $('#newPrice').text($.number_format(newPrice)+' تومان');
                num++;
            }else{
                return not1();
            }
        }
	    function productPriceListChange(el){
            let a=parseInt($(el).val());
            if(isNaN(a))a=0;
            if(a>0){
                $('#onlineProductPrice').val('');
                $('#onlineProductPrice').parent().addClass('d-none');
                $('#addCustomPrice').parent().addClass('col-8');
                $('#addCustomPrice').parent().removeClass('col-4');
            }else{
                $('#onlineProductPrice').parent().removeClass('d-none');
                $('#addCustomPrice').parent().removeClass('col-8');
                $('#addCustomPrice').parent().addClass('col-4');
            }
        }
	    let selectData=[
            {
                id:0,
                icon:'product.svg',
                title:'قیمت ثابت',
                text:'قیمت ثابت',
                price:"0"
            },
            <?php if(empty($ty) && !empty($other_product_price)){ 
                foreach($other_product_price as $a){
                    if(!empty($a) && !empty($a['product_info']) && !empty($a['product_info']['info']) && !empty($a['product_info']['id']) && intval($a['product_info']['id'])>0){ ?>
                        {
                            id: <?= intval($a['product_info']['id']) ?>,
                            icon:"<?= (!empty($a['product_info']['info']['icon'])?$a['product_info']['info']['icon']:'') ?>",
                            title:"<?= (!empty($a['product_info']['info']['title'])?$a['product_info']['info']['title']:(!empty($a['product_info']['info']['key'])?$a['product_info']['info']['key']:'')) ?>",
                            text: "<?= (!empty($a['product_info']['info']['price'])?number_format($a['product_info']['info']['price']).' تومان':'') ?>",
                            price: "<?= (!empty($a['product_info']['info']['price'])?$a['product_info']['info']['price']:0)?>"
                        },
                <?php }
                } 
            } ?>
        ];
        $('#productPriceList').select2({
            data:selectData,
            width: 'resolve',
            dropdownParent: $('#myModal'),
            templateResult: selectBoxFormatState,
            templateSelection: selectBoxSelectedFormatState
        });
        function selectBoxSelectedFormatState (state) {
            if (!state.id) {
                return state.title + ' ' + state.text;
            }
            var $state = $('<div style="direction:rtl;height: 50px;padding:5px;"><input type="hidden" id="titleSelected"><input type="hidden" id="priceSelected"><img class="img-flag" style="height:40px;width:50px;border-radius:10px;float:right;margin-left:7px" /><span style="font-size: 12px;margin-top: 5px;display: inline-block;margin-right: 5px;"></span><small style="color: #2bff1f;float: left;margin: 5px;"></small></div>');
            $state.find("span").text(state.title);
            if(parseFloat(state.price)!==0){
                $state.find("small").text(state.price+' تومان');
            }
            $state.find("#titleSelected").val(state.title);
            $state.find("#priceSelected").val(state.price);
            $state.find("img").attr("src", baseUrl('assets/svg/product/'+state.icon));
            return $state;
        };
        function selectBoxFormatState (state) {
            if (!state.id) {
                return state.title + ' ' + state.text;
            }
            var $state = $('<div style="direction:rtl;height: 50px;padding:5px;"><img src="' + baseUrl('assets/svg/product/'+state.icon) + '" style="height:40px;width:50px;border-radius:10px;float:right;margin-left:7px" class="img-flag" /><span style="font-size: 12px;margin-top: 10px;display: inline-block;">' + state.title +'</span><small style="color: #2bff1f;float: left;margin-top: 11px;margin-left: 4px;"></small></div>');
            if(parseFloat(state.price)!==0){
                $state.find("small").text(state.price+' تومان');
            }
            return $state;
        };
        function combinePrice(el) {
            if(el.checked) {
                $('#custom-price').addClass('d-none');
                $('#product-price').val('');
                $('#product-price-total').val('');
                $('#newPrice').text('رایگان');
                $('#online-price').removeClass('d-none');
            }else{
                $('#online-price').addClass('d-none');
                $('#custom-price').removeClass('d-none');
            }
        }
	    $(function(){
    	    $('#product-count').text($('.main-content-body.main-content-body-mail').children().length);
	    })
	    function deleteManagerProduct(el,id){
	        $(el).parent().parent().remove();
	        sendAjax({id:id},baseUrl('product/product/manager_disable_product'),'');
	        $('#product-count').text($('.main-content-body.main-content-body-mail').children().length);
	    }
	    function addTax(el){
            let a = parseFloat($(el).val()),tax=0,newPrice=0;
            if(a !== 'NaN' && a>0){
                tax=(a/10);
                newPrice=a+tax;
                $('#newPrice').text($.number_format(newPrice)+' تومان');
            }else{
                $('#newPrice').text('رایگان');
            }
            $('#product-price-total').val(newPrice);
            return true;
        }
        function showAddProduct(){
            $('#add-product').removeClass('d-none');
            return true;
        }
        function hideAddProduct(){
            $('#add-product').addClass('d-none');
            return true;
        }
        function productAction(t,i){
            sendAjax({t:t,i:i},baseUrl('company/product/product/management'),'');
        }
        function addProductAction(){
            let newPrice=0;
            if($('#product-title').val()!=='' && $('#product-description').val()!==''){
                $('#product-title').removeClass('border-danger');
                $('#product-description').removeClass('border-danger');
                newPrice=allTotals+(allTotals/10);
                sendAjax({
                    t:$('#product-title').val(),
                    c:$('#product-category').val(),
                    d:$('#product-description').val(),
                    p:$('#product-price-total').val(),
                    prp:newPrice,
                    rp:pricesArray,
                    i:$('#add-product').find('.file-name').val()
                },baseUrl('company/product/product/add'),'');
            }else{
                if($('#product-title').val()!==''){
                    $('#product-title').removeClass('border-danger');
                }else{
                    $('#product-title').addClass('border-danger');
                }
                if($('#product-description').val()!==''){
                    $('#product-description').removeClass('border-danger');
                }else{
                    $('#product-description').addClass('border-danger');
                }
                return not1();
            }
        }
        function changePrice(el){
            if($(el).val()=='p'){
                $('#product-price').prop('readonly', false);
                // $('#newPriceInner').removeClass('d-none');
            }else{
                $('#product-price').prop('readonly', true);
                $('#product-price').val('');
                // $('#newPriceInner').addClass('d-none');
            }
        }
        function diableProductRequest(el,id){
            $(el).parent().parent().find('.exists').addClass('d-none');
            $(el).parent().parent().find('.notExists').removeClass('d-none');
            return diableProduct(el,id);
        }
        function enableProductRequest(el,id){
            $(el).parent().parent().find('.notExists').addClass('d-none');
            $(el).parent().parent().find('.exists').removeClass('d-none');
            return enableProduct(el,id);
        }
	</script>
<?php } ?>