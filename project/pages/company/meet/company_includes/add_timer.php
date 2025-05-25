<div class="row d-none" id="add-timer">
    <div class="modal d-block" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">درخواست جلسه ی جدید</h6>
                    <button onclick="hideAddMeet();" aria-label="بستن" class="close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5 pl-0">
                            <div class="card">
                                <div class="card-body py-1 px-0 rounded-10" id="user-list-meet">
                                    <div class="main-content-body main-content-body-mail" style="overflow-y: auto;overflow-x: hidden;max-height: 340px;">
                                        <?php if(!empty($company_users) && is_array($company_users)){ 
                                            foreach($company_users as $a) {
                                                if(!empty($a) && !empty($a['status']) && intval($a['status'])>0 && !empty($a['company_user_id']) && intval($a['company_user_id'])>0 && !empty($company_user_id) && intval($company_user_id)!== intval($a['company_user_id'])){ ?>
                        						    <div class="main-mail-item">
                        							    <div>
                        								    <label class="ckbox">
                        									    <input type="checkbox" onclick="checkUserList(this,<?= intval($a['company_user_id']) ?>);">
                        										<span></span>
                        								    </label>
                        								</div>
                        								<div class="main-img-user">
                        								    <img alt="user image" src="<?= (!empty($a["user_info"]["image"])?$a["user_info"]["image"]:base_url('assets/svg/user/user.svg')) ?>">
                        								</div>
                        								<div class="main-mail-body" style="cursor: context-menu;min-width:50px">
                        									<div class="main-mail-from">
                        										<?= (!empty($a["user_info"]["name"])?$a["user_info"]["name"]:'').' '.(!empty($a["user_info"]["family"])?$a["user_info"]["family"]:'') ?>
                        									</div>
                        									<div class="main-mail-subject tx-10-f">
                    										    <?= (!empty($a['role'])?$a['role']:'') ?>
                    										</div>
                    									</div>
                    								</div>
    							            <?php } 
                                            }
        							    }else{ ?>
        							        <div class="alert alert-danger rounded-10 p-3 text-center">
        							            شما هیچ کارمندی در کسب و کار خود ندارید
        							        </div>
        							    <?php } ?>
        						    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card">
        						<div class="card-body">
    								<div class="form-group">
        								<div class="row align-items-center">
        									<label class="col-sm-2">موضوع</label>
        									<div class="col-sm-10">
        										<input type="text" id="meet-title" class="form-control">
        									</div>
        								</div>
        							</div>
        							<div class="form-group">
        								<div class="row ">
    										<label class="col-sm-2">توضیحات</label>
    										<div class="col-sm-10">
        										<textarea rows="10" id="meet-des" class="form-control"></textarea>
        									</div>
        								</div>
        							</div>
            					</div>
            				</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="saveAddMeet(this);">
                        ثبت درخواست  
                    </a>
                    <input type="hidden" id="mT">
                </div>
            </div>
        </div>
    </div>
</div>