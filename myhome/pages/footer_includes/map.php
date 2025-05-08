<?php if(!empty($map)){
    if(!empty($map_page) && $map_page){ ?>
        <div id="map" class="map-page"></div>
    <?php }else{ ?>
        <div class="modal" id="modalMap" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
            	    <div class="modal-header">
            		    <h6 class="modal-title">موقعیت جغرافیایی</h6>
            			<button aria-label="بستن" class="close"
            			onclick="hideMapModal();">
            			    <span aria-hidden="true">×</span>
            			</button>
            		</div>
            		<div class="modal-body" id="all-marker-list">
            		    <div class="row">
    					    <?php if(!empty($add_map)){ ?>
    						    <div class="col-12">
    							    <p>
    							        شما با کلیک روی نقشه می توانید مکان مورد نظر را انتخاب کنید
    							    </p>
    						    </div>
                				<div class="col-3 p-0" id="map-list-shower">
                				    <div class="list-group text-center" style="max-height:400px;overflow-y:auto;overflow-x:hidden;">
        							</div>
                				</div>
                				<div class="col-9 p-0">
                                    <div id="map"></div>
                				</div>
                    		<?php }else{ ?>
                        	    <div class="col-md-10 mx-auto">
                                    <div id="map"></div>
                				</div>
                			<?php } ?>
            			</div>
            		</div>
            		<?php if(!empty($add_map)){ ?>
                	    <div class="modal-body d-none" id="add-marker-access">
                		    <div class="row">
                			    <div class="col-12">
                        		    شما این محل را انتخاب کرده اید حال برای اینجا نامی را اختصاص دهید
                				</div>
                			</div>
                			<div class="row my-4">
                			    <div class="col-4">
                				    اسم محل
                				</div>
                				<div class="col-8">
                        		    <input class="shadow-light rounded-10 form-control" id="add-map-title" placeholder="اسم محل">
                				</div>
                			</div>
            				<div class="row">
                			    <div class="col-6">
                        		    <a class="btn btn-block btn-success-gradient rounded-10" onclick="addNewLocation();">
                                        تایید
                                    </a>
                				</div>
                			    <div class="col-6">
                				    <a class="btn btn-block btn-danger-gradient rounded-10" onclick="cancleNewLocation(this);">
                                        انصراف
                                    </a>
                				</div>
                			</div>
                		</div>
            		<?php } ?>
            	</div>
            </div>
        </div>
    <?php }
} ?> 