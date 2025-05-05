<?php if(!empty($role_id) && intval($role_id)>0 && !empty($company_info) && !empty($company_info['0'])){ $company_info=$company_info['0']; ?>
    <div class="row row-sm mt-3">
    	<div class="col-lg-4">
    	    <div class="card mg-b-20">
    		    <div class="card-body text-center">
    			    <div class="pl-0">
    				    <div class="main-profile-overview">
    					    <div class="main-img-user profile-user">
    					        <img src="<?= base_url('assets/svg/company/'.(!empty($company_info['icon'])?$company_info['icon']:'company.svg')) ?>">
        					</div>
        				    <h5 class="main-profile-name mg-b-20 text-center">
        					        <?= (!empty($company_info['title'])?$company_info['title']:'') ?>
        				    </h5>
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
        					<hr class="mg-y-10">
                    		<div class="row row-sm mt-2">
                        	    <div class="col-md-7 mx-auto">
                                    <?php if(!empty($company_info['qr_code'])){ ?>
                    					<img class="w-100 rounded-10" src="<?= base_url('assets/qrcode/'.$company_info['qr_code']) ?>">
                					<?php } ?>
                                </div>
                            </div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-8">
    	    <div class="card">
    	        <div class="card-header">
    	            <h4 class="text-center">
        	            رزرو جایگاه ها
    	            </h4>
    	        </div>
    	        <div class="card-body" style="overflow-x:hidden;overflow-y:auto;max-height:437px;">
            	    <?php $calendar=[];
            	    if(!empty($data)){ ?>
                        <div class="row row-sm">
                	        <?php foreach($data as $b){
                	            if(!empty($b) && !empty($b['info']) && !empty($b['info']['id']) && intval($b['info']['id'])>0){
                    	            if(!empty($b['reserve_time'])){
                    	                $calendar_id=intval($b['info']['id']);
                    	                $calendar_title=(!empty($b['info']['title'])?$b['info']['title']:'');
                    	                foreach($b['reserve_time'] as $reserve_time_key=>$reserve_time_value){
                    	                    if(is_int($reserve_time_key) && !empty($reserve_time_value['date_reserve'])){
                            	                $calendar[]=[
                                	                'position_id'=>$calendar_id,
                                	                'position_title'=>$calendar_title,
                                	                'position_user_status'=>$reserve_time_value['position_user_status'],
                                	                'position_user_id'=>$reserve_time_value['position_user_id'],
                                	                'background_color'=> "#".random_int(100000,999999),
                                	                'start'=>$reserve_time_value['date_reserve'],
                                	                'end'=>(!empty($reserve_time_value['exiting_time'])?$reserve_time_value['exiting_time']:0),
                                	                'user'=>(!empty($reserve_time_value['user_reserve_info']['0'])?$reserve_time_value['user_reserve_info']['0']:[]),
                            	                ];
                    	                        
                    	                    }
                    	                }
                    	            } ?>
                        		    <div class="col-6 text-center px-1">
                        		        <span class="<?= (!empty($b['info']['deleted_at'])?'bg-danger':'bg-success') ?> d-block px-2 rounded-10 pt-2">
                            			    <span onclick="showReserveClick(this,<?= intval($b['info']['id']) ?>);">
                                			    <img class="ht-150 rounded-10" alt="position profile" 
                                			    src="<?= base_url((!empty($b['info']['icon'])?'assets/svg/position/'.$b['info']['icon']:(!empty($b['info']['qr_code'])?'assets/qrcode/'.$b['info']['qr_code']:'assets/svg/position/position.svg'))) ?>">
                                			    <br>
                                			    <span style="padding: 6px;display:inline-block;max-width: 90%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                                    			    <?= (!empty($b['info']['title'])?$b['info']['title']:'') ?>
                                			    </span>
                            			    </span>
                        		        </span>
                    			        <div class="show-div-setting col-12">
                            				<div class="reserve <?= (!empty($_GET['count']) && intval($_GET['count'])>0 && intval($b['info']['id'])===intval($_GET['count'])?'':'d-none') ?>">
                            				     <div class="modal d-block">
                                                	<div class="modal-dialog modal-lg modal-dialog-scrollable w-100" role="document" style="position: fixed;top: 0;bottom: 0;left: 0;right: 0;">
                                                		<div class="modal-content border-0">
                                                		    <div class="modal-header">
                                                    		    <a class="btn back-to-product-show-index wd-30 p-0 hd-30" onclick="backShowReserveClick(this);">
                                                    		        <img class="w-100d h-100d" src="<?= base_url('assets/svg/back.svg') ?>">
                                                    		    </a>
                                                            </div>
                                                			<div class="modal-body text-center p-7 ">
                                                			    <div class="row innercalendarandmanager">
                                                			        <div class="col-12">
                                            					        <div class="card">
                                                            			    <div class="card-header pb-0">
                                                            			        <h5>
                                                            			            مدیریت رزرو ها
                                                            			        </h5>
                                                            			        <p>
                                                            			            شما می توانید درخواست های رزرو توسط مشتریان برای این جایگاه را مدیریت کنید
                                                            			        </p>
                                                            			    </div>
                                    				                        <div class="card-body pt-1" id="all-reserves-info" style="max-height: 350px;overflow: auto;">
                                        					        		    <?php if(!empty($reserve) && !empty($reserve[intval($b['info']['id'])])){ 
                                        					        		        echo $reserve[intval($b['info']['id'])];
                                        					        		    }else{ ?>
                                				                                    <div class="alert alert-danger text-center rounded-10 p-3">
                                				                                        شما هیچ رزروی در این جایگاه ندارید
                                				                                    </div>
                                				                                <?php } ?>
                                				                            </div>
                                				                        </div>
                                                			        </div>
                                                			        <div class="col-12 onceCal"></div>
                            				                    </div>
                            				                </div>
                            				            </div>
                            				        </div>
                            				    </div>
                            				</div>
                        				</div>
                        			</div>
                		    <?php }
                		    } ?>
                        </div>
                    <?php }else{ ?>
                        <div class="alert alert-danger text-center p-4 rounded-10">
                            جایگاهی برای این کسب و کار وجود ندارد
                        </div>
                    <?php } ?>
                </div>
    	    </div>
    	</div>
    	<div class="col-12">
    	    <div class="card">
    	        <div class="card-header">
    	            <h4 class="text-center">تقویم رزرو مشتری</h4>
    	        </div>
    	        <div class="card-body" id="calendarInfo" style="max-height:300px;overflow-y:auto;overflow-x:hidden;">
            	    <?php $this->view('includes/calendar/reserve_manager_data',['reserve_manager_data'=>$calendar]) ?>
    	        </div>
    	    </div>
    	</div>
    </div>
    <script>
        function showReserveClick(el,id){
	        let parentEl=$(el).parent().parent().find('.show-div-setting'),calendar=$(el).parent().parent().find('.onceCal');
	        $('.show-div-setting').children().addClass('d-none');
	        parentEl.find('.reserve').removeClass('d-none');
	        $('#calendarInfo').find('.positionCalendarList').children().addClass('d-none');
	        $('#calendarInfo').find('.CalendarPositionId'+id).removeClass('d-none');
	        calendar.html($('#calendarInfo').html());
	        processAjaxData(document.title,$('#content').html(),baseUrl('position_company_reserve_manager?count='+id));
        }
        function backShowReserveClick(el){
            $('.show-div-setting').children().addClass('d-none');
            $('#calendarInfo').find('.positionCalendarList').children().removeClass('d-none');
            processAjaxData(document.title,$('#content').html(),baseUrl('position_company_reserve_manager'));
        }
        function savePositionReserveTime(el,positionUserId){
            let h=$(el).parent().find('.hour').val(),d=$(el).parent().find('.day').val(),m=$(el).parent().find('.month').val(),y=$(el).parent().find('.year').val();
            if(h!==''&&d!==''&&m!==''&&y!==''){
                $(el).addClass('d-none');
                sendAjax({h:h,d:d,m:m,y:y,positionUserId:positionUserId},baseUrl('company/position/position/change_reserve_time'),'');
                // sendAjax({h:h,d:d,m:m,y:y,positionUserId:positionUserId},baseUrl('company/position/position/change_reserve_time'),'#all-reserves-info');
                // sendAjax({send:'ok'},baseUrl('company/position/position/side'),'#side2');
            }else{
                return not8();
            }
            return true;
        }
        function arrivedPersent(positionId,id){
            sendAjax({positionId:positionId,id:id},baseUrl('company/position/position/arrived_persent'),'');
            // sendAjax({positionId:positionId,id:id},baseUrl('company/position/position/arrived_persent'),'#all-reserves-info');
            // sendAjax({send:'ok'},baseUrl('company/position/position/side'),'#side2');
            return true;
        }
        function endService(positionId,id){
            sendAjax({positionId:positionId,id:id},baseUrl('company/position/position/end_service'),'');
            // sendAjax({positionId:positionId,id:id},baseUrl('company/position/position/end_service'),'#all-reserves-info');
            // sendAjax({send:'ok'},baseUrl('company/position/position/side'),'#side2');
            return true;
        }
        function showOrderProduct(el){
            $(el).addClass('d-none');
            $(el).parent().find('.hideOrderProduct').removeClass('d-none');
            $(el).parent().parent().children('.showOrderProduct').removeClass('d-none');
        }
        function hideOrderProduct(el){
            $(el).addClass('d-none');
            $(el).parent().find('.showOrderProduct').removeClass('d-none');
            $(el).parent().parent().children('.showOrderProduct').addClass('d-none');
        }
        function showPositionForm(el){
            $(el).addClass('d-none');
            $(el).parent().find('.hidePositionForm').removeClass('d-none');
            $(el).parent().parent().children('.showPositionForm').removeClass('d-none');
        }
        function hidePositionForm(el){
            $(el).addClass('d-none');
            $(el).parent().find('.showPositionForm').removeClass('d-none');
            $(el).parent().parent().children('.showPositionForm').addClass('d-none');
        }
        function showPositionReserveTime(el){
            $(el).addClass('d-none');
            $(el).parent().find('.hidePositionReserveTime').removeClass('d-none');
            $(el).parent().parent().children('.showPositionReserveTime').removeClass('d-none');
        }
        function hidePositionReserveTime(el){
            $(el).addClass('d-none');
            $(el).parent().find('.showPositionReserveTime').removeClass('d-none');
            $(el).parent().parent().children('.showPositionReserveTime').addClass('d-none');
        }
        function showReserveInfo(el,id,usrId){
            $(el).parent().parent().children().removeClass('bg-secondary');
            $(el).parent().addClass('bg-secondary');
            $(el).parents('.all-reserves-info').children('.re-info').addClass('d-none');
            $(el).parents('.all-reserves-info').find('.re-count-'+id).removeClass('d-none');
            $('#calendarInfo').find('.positionCalendarList').children().addClass('d-none');
	        $('#calendarInfo').find('.CalendarPositionUserId'+usrId+'.CalendarPositionId'+$(el).parent().find('.pIds').val()).removeClass('d-none');
	        $(el).parents('.innercalendarandmanager').find('.onceCal').html($('#calendarInfo').html());
            processAjaxData(document.title,$('#content').html(),baseUrl('position_company_reserve_manager?count='+$(el).parent().find('.pIds').val()+'&user='+usrId));
            return true;
        }
        function setAccessPP(el,posId,proId,cId){
            let s=0;
            if(el.checked) s=1;
            sendAjax({s:s,posId:posId,proId:proId,cId:cId},baseUrl('company/position/position/position_products'),'');
        }
        <?php if(!empty($_GET) && !empty($_GET['count']) && intval($_GET['count'])>0 && !(!empty($_GET['user']) && intval($_GET['user'])>0)){ ?>
            $(function(){
                for(let i=0;i<$('.pIds').length;i++){
                    if(parseInt($('.pIds')[i].value)===<?= intval($_GET['count']) ?>){
                        $($('.pIds')[i]).parent().find('.firstClick').click();
                        break;
                    }
                    
                }
                // $('.onceCal').html($('#calendarInfo').html());
            })
        <?php } ?>
    </script>
<?php } ?>