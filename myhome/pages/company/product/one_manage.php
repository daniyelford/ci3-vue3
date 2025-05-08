<?php if(!empty($data) && !empty($data['0']) && !empty($product_id) && intval($product_id)>0){ 
    $category_selected=(!empty($category_selected) && !empty($category_selected['0']) && !empty($category_selected['0']['category_id']) && intval($category_selected['0']['category_id'])>0?intval($category_selected['0']['category_id']):0); ?>
    <link href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/plugins/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/includes/format_number.js') ?>"></script>
    <style>td {padding: 5px !important;font-size: 9px !important;}.select2-selection__rendered,.select2.select2-container.select2-container--default,span.select2.select2-container.select2-container--default.select2-container--below,span.select2.select2-container.select2-container--default.select2-container--focus,.select2-selection.select2-selection--single{width:100% !important;height:50px !important;}</style>
    <div class="row row-sm mt-3">
    	<div class="col-lg-4">
    	    <div class="card mg-b-20">
    		    <div class="card-body text-center">
    			    <div class="pl-0">
    				    <div class="main-profile-overview">
    					    <div class="main-img-user profile-user">
    						    <img alt="product profile" src="<?= base_url('assets/svg/product/'.(!empty($data['0']['icon'])?$data['0']['icon']:'product.svg')) ?>">
    						</div>
    						<div class="text-center mg-b-20">
    							<div id="profile-user-picture-upload">
    							    <?= (!empty($uploader)?$uploader:'') ?>
    							</div>
    						</div>
    						<hr class="mg-y-10">
							<label class="main-content-label tx-13 mg-b-20">دسترسی سریع</label>
							<div class="row">
							    <?php if(!empty($ty)){ ?>
                                    <div class="col-12 mt-1">
                                        <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('all_product_manager') ?>">
                    					    <i class="si si-basket-loaded mx-1"></i>
                    					    همه ی محصولات
                    				    </a>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('all_company_manager') ?>">
                    					    <i class="bx bx-slider-alt mx-1"></i>
                    					    همه کسب و کارها
                    				    </a>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-12 mt-1">
                                        <a style="text-align:start;" class="btn btn-dark-gradient btn-block p-1 rounded-10" href="<?= base_url('product_company_manager') ?>">
                    					    <i class="si si-basket-loaded mx-1"></i>
                    					    محصولات مربوط
                    				    </a>
                                    </div>
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
                                <?php } ?>
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
    	    <div class="card">
    		    <div class="card-body pb-0">
    				<form class="form-horizontal">
        			    <div class="mb-4 main-content-label">اطلاعات محصول</div>
    					<div class="form-group">
    					    <div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">کد محصول</label>
    							</div>
    							<div class="col-md-9">
    							    <input readonly="" value="<?= (!empty($data['0']['key'])?$data['0']['key']:'') ?>" type="text" class="shadow-light rounded-10 form-control" placeholder="کد محصول">
    							</div>
    						</div>
    					</div>
    					<div class="form-group">
    					    <div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">عنوان</label>
    							</div>
    							<div class="col-md-9">
    							    <input id="product-title" value="<?= (!empty($data['0']['title'])?$data['0']['title']:'') ?>" type="text" class="shadow-light rounded-10 form-control" placeholder="نام محصول">
    							</div>
    						</div>
    					</div>
    					<div class="form-group">
    						<div class="row">
    						    <div class="col-md-3">
    							    <label class="form-label">
                                        توضیحات
							        </label>
    							</div>
    							<div class="col-md-9">
    							    <textarea id="product-des" class="shadow-light rounded-10 form-control" name="example-textarea-input" rows="4" placeholder="توضیحات محصول"><?= (!empty(trim($data['0']['description']))?trim($data['0']['description']):'') ?></textarea>
    							</div>
    						</div>
    					</div>
    				    <div class="mb-4 main-content-label">دسته بندی محصول</div>
        			    <?php if(!empty($category)){ ?>
            			    <div class="form-group">
            			        <div class="row my-2">
            						<div class="col-12 text-center">
                                        <select id="product-category" class="form-control SlectBox SumoUnder shadow-light rounded-10" tabindex="-1">
                                            <option value="0">متفرقه</option>
                                            <?php foreach($category as $a){ 
                                                if(!empty($a) && !empty($a['id']) && intval($a['id'])>0){ ?>
                                                    <option <?= (intval($a['id'])===intval($category_selected)?'selected':'') ?> value="<?= intval($a['id']) ?>"><?= (!empty($a['title'])?$a['title']:'') ?></option>
                                            <?php } 
                                            } ?>
                                        </select>
                                    </div>
            					</div>
            			    </div>
        			    <?php } ?>
        			    <span class="<?= (!empty($relations) && array_search('1',array_column($relations,'status'))!==false?'d-none':'') ?>" id="custom-price">
            			    <div class="mb-4 main-content-label">قیمت محصول به تومان</div>
        					<div class="form-group">
        					    <div class="row">
            						<div class="col-6">
            							<div class="input-group shadow-light rounded-10 overflow-hidden">
                            				<div class="input-group-prepend">
                            					<div class="input-group-text">
                            						<label class="rdiobox wd-16 mg-b-0">
                            							<input onclick="changePrice(this);" class="radio-type" value="" name="data[]" type="radio" <?= (!empty($data['0']['price']) && intval($data['0']['price'])>0?'':'checked') ?>>
                            						    <span></span>
                            					    </label>
                            				    </div>
                            				</div>
                            			    <input class="form-control" readonly="" placeholder="محصول رایگان است">
                            		    </div>
            						</div>
            						<div class="col-6">
            							<div class="input-group shadow-light rounded-10 overflow-hidden">
                            				<div class="input-group-prepend">
                            					<div class="input-group-text">
                            						<label class="rdiobox wd-16 mg-b-0">
                            							<input onclick="changePrice(this);" class="radio-type" value="p" name="data[]" type="radio" <?= (!empty($data['0']['price']) && intval($data['0']['price'])>0?'checked':'') ?>>
                            						    <span></span>
                            					    </label>
                            				    </div>
                            				</div>
                                            <input type="number" onkeyup="addTax(this);" step="1000" class="form-control" id="product-price" <?= (!empty($data['0']['price']) && intval($data['0']['price'])>0?'value="'.intval($data['0']['price']*10/11).'"':'readonly=""') ?> placeholder="قیمت محصول به تومان">
                            		    </div>
            					    </div>
            					</div>
        					</div>
        			    </span>
        				<?php if(empty($ty) && !empty($other_product_price)){ ?>
                            <label class="ckbox mb-3">
                				<input type="checkbox" id="combine-price" onchange="combinePrice(this);" <?= (!empty($relations) && array_search('1',array_column($relations,'status'))!==false?'checked':'') ?>>
                                <span>
                                    قیمت گذاری آنلاین
                                </span>
                            </label>
            				<div class="row <?= (!empty($relations) && array_search('1',array_column($relations,'status'))!==false?'':'d-none') ?>" id="online-price">
                			    <div class="col-12">
                                    <div class="card mb-0 <?= (!empty($relations)?'':'d-none') ?>" id="online-price-table">
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
                								    <tbody id="online-price-tbody">
                                                        <?php if(!empty($relations)){
                                                            $number=-1;
                                                            foreach($relations as $a){ 
                                                                if(!empty($a) && !empty($a['zarib']) && !empty($a['id']) && intval($a['id'])>0){ ?>
                                                                    <tr>
                                                                        <?php if(!empty($a['product_price_id']) && intval($a['product_price_id'])>0 && !empty($a['auto_change']) && intval($a['auto_change'])>0 && 
                                                                        array_search(intval($a['product_price_id']),array_column(array_column($other_product_price,'product_info'),'id'))!==false && ($b=$other_product_price[array_search(intval($a['product_price_id']),array_column(array_column($other_product_price,'product_info'),'id'))]['product_info']['info'])!==false && 
                                                                        !empty($b)){ ?>
                                                                            <td>قیمت آنلاین <?= (!empty($b['title'])?$b['title']:(!empty($b['key'])?$b['key']:'')) ?></td>
                                                                            <td title="<?= (!empty($a['description'])?$a['description']:'') ?>"><?= (!empty($a['description'])?$a['description']:'') ?></td>
                                                                            <td><?= (!empty($a['zarib'])?$a['zarib']:'') ?></td>
                                                                            <td><?= (!empty($b['price'])?number_format($b['price']).' تومان':'') ?></td>
                                                                            <td><?= (!empty($b['price'])?number_format($b['price']*$a['zarib']).' تومان':'') ?></td>
                                                                        <?php $number++;}elseif(!empty($a['price'])){ ?>
                                                                            <td>قیمت ثابت</td>
                                                                            <td title="<?= (!empty($a['description'])?$a['description']:'') ?>"><?= (!empty($a['description'])?$a['description']:'') ?></td>
                                                                            <td><?= (!empty($a['zarib'])?$a['zarib']:'') ?></td>
                                                                            <td><?= (!empty($a['price'])?number_format($a['price']).' تومان':'') ?></td>
                                                                            <td><?= (!empty($a['price'])?number_format($a['price']*$a['zarib']).' تومان':'') ?></td>
                                                                        <?php $number++;} ?>
                                                                        <td>
                                                                            <a class="<?= (!empty($a['status']) && intval($a['status'])>0?'':'d-none') ?> dis" onclick="disablePriceRelationAction(this,<?= $number ?>);">
                                                                                <i class="fas fa-ban tx-15-f text-danger"></i>
                                                                            </a>
                                                                            <a class="<?= (!empty($a['status']) && intval($a['status'])>0?'d-none':'') ?> en" onclick="enablePriceRelationAction(this,<?= $number ?>);">
                                                                                <i class="far fa-check-circle tx-15-f text-success"></i>
                                                                            </a>
                                                                            <a class="del" onclick="deletePriceRelationAction(this,<?= $number ?>);">
                                                                                <i class="fa fa-trash tx-15-f text-pink"></i>
                                                                            </a>
                                		                                </td>
                                                                    </tr>
                                                                <?php } 
                                                            } 
                                                        } ?> 
                								    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-12">
                                                <select id="productPriceList" class="form-control w-100" onchange="productPriceListChange(this);"></select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <textarea class="form-control" id="description" placeholder="توضیحات"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-4">
                                                <input class="form-control" type="number" step='any' id="zarib" placeholder="ضریب">
                                            </div>
                                            <div class="col-4">
                                                <input type="number" id="price" class="form-control" placeholder="قیمت به تومان">
                                            </div>
                                            <div class="col-4">
                                                <a class="btn btn-success btn-block" id="addCustomPrice" onclick="addCustomPriceAction();">
                                                    افزودن 
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                				</div>
            				</div>
        				<?php } ?>
        			    <div class="row">
        				    <div class="col-12">
                        	    <div class="alert alert-warning text-center p-4 mt-4 rounded-10">
                        		    قیمت با احتساب مالیات:
                        		    <span id="newPrice"><?= (!empty($data['0']['price']) && intval($data['0']['price'])>0?number_format($data['0']['price']).' تومان':'رایگان') ?></span>
                        		        
                        	    </div>
        					</div>
        				</div>
    				</form>
    			</div>
    			<div class="card-footer text-left">
    			    <button type="button" onclick="saveEditProduct();" class="btn btn-success-gradient btn-block">بروزرسانی محصول</button>
    			</div>
    		</div>
    	</div>
    </div>
    <script>
        let pricesArray=[],countId=[],num=0,allTotalPrice=0,statusArray=[];
        <?php if(!empty($relations)){
            foreach($relations as $a){ 
                if(!empty($a) && !empty($a['zarib']) && !empty($a['id']) && intval($a['id'])>0){ 
                    if(!empty($a['product_price_id']) && intval($a['product_price_id'])>0 && !empty($a['auto_change']) && intval($a['auto_change'])>0 && 
                    array_search(intval($a['product_price_id']),array_column(array_column($other_product_price,'product_info'),'id'))!==false && ($b=$other_product_price[array_search(intval($a['product_price_id']),array_column(array_column($other_product_price,'product_info'),'id'))]['product_info']['info'])!==false && 
                    !empty($b)){ ?>
                        countId[num]=<?= intval($a['id']) ?>;
                        pricesArray[num]=[
                            <?= intval($a['product_price_id']) ?>,
                            <?= (!empty($b['price'])?$b['price']:0) ?>,
                            "<?= (!empty($a['description'])?$a['description']:'') ?>",
                            <?= (!empty($a['zarib'])?$a['zarib']:'') ?>,
                            <?= (!empty($b['price'])?$b['price']*$a['zarib']:0) ?>
                        ];
                        <?php if(!empty($a['status']) && intval($a['status'])>0){ ?>
                            allTotalPrice+=<?= (!empty($b['price'])?$b['price']*$a['zarib']:0) ?>;
                            statusArray.push(num);
                        <?php } ?>
                        num++;
                    <?php }elseif(!empty($a['price'])){ ?>
                        countId[num]=<?= intval($a['id']) ?>;
                        pricesArray[num]=[
                            0,
                            <?= (!empty($a['price'])?$a['price']:0) ?>,
                            "<?= (!empty($a['description'])?$a['description']:'') ?>",
                            <?= (!empty($a['zarib'])?$a['zarib']:'') ?>,
                            <?= (!empty($a['price'])?$a['price']*$a['zarib']:0) ?>
                        ];
                        <?php if(!empty($a['status']) && intval($a['status'])>0){ ?>
                            allTotalPrice+=<?= (!empty($a['price'])?$a['price']*$a['zarib']:0) ?>;
                            statusArray.push(num);
                        <?php } ?>
                        num++;
                    <?php } 
                } 
            } 
        } ?>
        function disablePriceRelationAction(el,id){
            $(el).addClass('d-none');
            $(el).parent().find('.en').removeClass('d-none');
            let newPrice=0;
            if(!isNaN(parseInt(countId[id]))){
                sendAjax({id:parseInt(countId[id])},baseUrl('company/product/product/disable_product_relation'),'');
                statusArray = jQuery.grep(statusArray, function(value) {
                    return value != id;
                });
                allTotalPrice-=pricesArray[id][4];
                if(parseFloat(allTotalPrice)>0 && statusArray.length>0){
            	    newPrice=allTotalPrice+(allTotalPrice/10);
            	    $('#newPrice').text($.number_format(newPrice)+' تومان');
        	       // $('#combine-price').click();
        	    }else{
        	        $('#newPrice').text('رایگان');
        	    }
            }else{
                return not1();
            }
        }
        function enablePriceRelationAction(el,id){
            $(el).addClass('d-none');
            $(el).parent().find('.dis').removeClass('d-none');
            let newPrice=0;
            if(!isNaN(parseInt(countId[id]))){
                sendAjax({id:parseInt(countId[id])},baseUrl('company/product/product/enable_product_relation'),'');
                allTotalPrice+=pricesArray[id][4];
                newPrice=allTotalPrice+(allTotalPrice/10);
            	$('#newPrice').text($.number_format(newPrice)+' تومان');
                statusArray.push(id);
            }else{
                return not1();
            }
        }
        function deletePriceRelationAction(el,id){
            $(el).parent().parent().remove();
            let newPrice=0;
            if(!isNaN(parseInt(countId[id]))){
                sendAjax({id:parseInt(countId[id])},baseUrl('company/product/product/remove_product_relation'),'');
                if(jQuery.inArray(id, statusArray) !== -1){
                    statusArray = jQuery.grep(statusArray, function(value) {
                        return value != id;
                    });
                    allTotalPrice-=pricesArray[id][4];
                    if(parseFloat(allTotalPrice)>0){
                	    newPrice=allTotalPrice+(allTotalPrice/10);
                	    $('#newPrice').text($.number_format(newPrice)+' تومان');
            	    }else{
            	        $('#online-price-table').addClass('d-none');
            	        $('#newPrice').text('رایگان');
            	        allTotalPrice=0;
            	    }
                }else{
                	if($('#online-price-tbody').children().length===0){
            	        $('#online-price-table').addClass('d-none');
            	       // $('#combine-price').click();
                    // }
                // 	if(statusArray.length===0){
                // 	    $('#combine-price').click();
                	}
                }
            }else{
                return not1();
            }
        }
        function addCustomPriceAction(){
            let newPrice=0,a=parseInt($('#productPriceList').val()),valid=true,type="",total=0,price=parseFloat($('#priceSelected').val()),zarib=parseFloat($('#zarib').val());
            if(isNaN(a)){a=0;}
            if(isNaN(zarib)){zarib=0;}
            if(isNaN(price)){price=0;}
            if(a===0){type="قیمت ثابت";}else{type=$('#titleSelected').val();}
            if(zarib===0){
                $('#zarib').css('border','1px solid red');
                valid=false;
            }
            if(a==0 && $('#price').val()==''){
                $('#price').css('border','1px solid red');
                valid=false;
            }
            if(valid && price===0){price=parseFloat($('#price').val());}
            if(valid){
                if($('#online-price-table').hasClass('d-none')){
                   $('#online-price-table').removeClass('d-none');
                }
                total=zarib*price;
                pricesArray[num]=[
                    a,
                    price,
                    $('#description').val(),
                    zarib,
                    total
                ];
                $('#online-price-tbody').html($('#online-price-tbody').html()+"<tr><td>"+type+"</td><td title='"+$('#description').val()+"'>"+$('#description').val()+"</td><td>"+zarib+"</td><td>"+$.number_format(price)+" تومان</td><td>"+$.number_format(total)+" تومان</td><td><a class='dis' onclick='disablePriceRelationAction(this,"+num+");'><i class='fas fa-ban tx-15-f text-danger'></i></a><a class='d-none en' onclick='enablePriceRelationAction(this,"+num+");'><i class='far fa-check-circle tx-15-f text-success'></i></a><a class='del' onclick='deletePriceRelationAction(this,"+num+");'><i class='fa fa-trash tx-15-f text-pink'></i></a></td></tr>");
                sendAjax({num:num,productPriceId:a,price:$('#price').val(),description:$('#description').val(),zarib:$('#zarib').val()},baseUrl('company/product/product/add_product_relation'),'#scriptCount'+num);
                var script=document.createElement('script');
                script.type='text/javascript';
                script.id='scriptCount'+num;
                $("body").append(script);
                statusArray.push(num);
                allTotalPrice+=total;
                newPrice=allTotalPrice+allTotalPrice*0.1;
                $('#newPrice').text($.number_format(newPrice)+' تومان');
                $('#productPriceList').val('0');
                $('#productPriceList').trigger('change');
                $('#priceSelected').val('');
                $('#zarib').val('');
                $('#description').val('');
                $('#price').val('');
                num++;
            }else{
                return not1();
            }
        }
        function productPriceListChange(el){
            let a=parseInt($(el).val());
            if(isNaN(a)) a=0;
            if(a>0){
                $('#price').val('');
                $('#price').parent().addClass('d-none');
                $('#addCustomPrice').parent().addClass('col-8');
                $('#addCustomPrice').parent().removeClass('col-4');
            }else{
                $('#price').parent().removeClass('d-none');
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
                            title: "<?= (!empty($a['product_info']['info']['title'])?$a['product_info']['info']['title']:(!empty($a['product_info']['info']['key'])?$a['product_info']['info']['key']:'')) ?>",
                            text: "<?= (!empty($a['product_info']['info']['price'])?number_format($a['product_info']['info']['price']).' تومان':'') ?>",
                            price:<?= (!empty($a['product_info']['info']['price'])?$a['product_info']['info']['price']:0) ?>
                        },
                <?php }
                } 
            } ?>
        ];
        $('#productPriceList').select2({
            data:selectData,
            width: 'resolve',
            templateResult: selectBoxFormatState,
            templateSelection: selectBoxSelectedFormatState
        });
        function selectBoxSelectedFormatState (state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $('<div style="direction: rtl;height: 50px;padding:5px;"><input type="hidden" id="titleSelected"><input type="hidden" id="priceSelected"><img class="img-flag" style="height:40px;width:50px;border-radius:10px;float:right;margin-left:7px" /><span style="font-size: 12px;margin-top: 5px;display: inline-block;margin-right: 5px;"></span><small style="color: #2bff1f;float: left;margin: 5px;"></small></div>');
            $state.find("span").text(state.title);
            if(parseFloat(state.price)!==0){
                $state.find("small").text(state.text);
            }
            $state.find("#titleSelected").val(state.title);
            $state.find("#priceSelected").val(state.price);
            $state.find("img").attr("src", baseUrl('assets/svg/product/'+state.icon));
            return $state;
        };
        function selectBoxFormatState (state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $('<div style="direction: rtl;height: 50px;padding:5px;"><img src="' + baseUrl('assets/svg/product/'+state.icon) + '" style="height:40px;width:50px;border-radius:10px;float:right;margin-left:7px" class="img-flag" /><span style="font-size: 12px;margin-top: 10px;display: inline-block;">' + state.title + '</span><small style="color: #2bff1f;float: left;margin-top: 11px;margin-left: 4px;"></small></div>');
            if(parseFloat(state.price)!==0){
                $state.find("small").text(state.text);
            }
            return $state;
        };
        function combinePrice(el) {
            if(el.checked) {
                $('#custom-price').addClass('d-none');
                $('#online-price').removeClass('d-none');
            }else{
                $('#online-price').addClass('d-none');
                $('#custom-price').removeClass('d-none');
                $('#online-price-tbody').find('.dis').click();
                allTotalPrice=0;
            }
            $('#product-price').val('');
            $('#newPrice').text('رایگان');
        }
        function addTax(el){
            let a = parseFloat($(el).val()),tax=0,newPrice=0;
            if(!isNaN(a) && a>0){
                tax=(a/10);
                newPrice=a+tax;
                $('#newPrice').text($.number_format(newPrice)+' تومان');
            }else{
                $('#newPrice').text('رایگان');
            }
            return true;
        }
        function saveEditProduct(){
            if($('#product-title').val()!=='' && $('#product-des').val()!==''){
                $('#product-title').removeClass('border-danger');
                $('#product-des').removeClass('border-danger');
                let a = parseFloat($('#product-price').val());
                if (isNaN(a) || allTotalPrice>0) a=allTotalPrice;
                if (a>0) a=a+(a/10); else a='';
                sendAjax({
                    id:<?= intval($product_id) ?>,
                    c:$('#product-category').val(),
                    t:$('#product-title').val(),
                    d:$('#product-des').val(),
                    p:a,
                    i:$('#profile-user-picture-upload').find('.file-name').val()
                },<?= (!empty($ty)?"baseUrl('product/product/edit_product')":"baseUrl('company/product/product/edit')") ?>,"");
                return not10();
            }else{
                if($('#product-title').val()!==''){
                    $('#product-title').removeClass('border-danger');
                }else{
                    $('#product-title').addClass('border-danger');
                }
                if($('#product-des').val()!==''){
                    $('#product-des').removeClass('border-danger');
                }else{
                    $('#product-des').addClass('border-danger');
                }
                return not1();
            }
        }
        function changePrice(el){
            if($(el).val()=='p'){
                $('#product-price').prop('readonly', false);
            }else{
                $('#product-price').prop('readonly', true);
                $('#product-price').val('');
                $('#newPrice').text('رایگان');
            }
        }
    </script>
    
<?php } ?>