<div class="modal" id="modaldemo6" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
        	    <h6 class="modal-title">افزودن حساب کاربری</h6>
        		<button aria-label="بستن" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
        	</div>
            <div class="modal-body">
                <div id="wizard3" role="application" class="wizard clearfix vertical">
            	    <div class="steps clearfix">
            		    <ul role="tablist">
            			    <li role="tab" class="first current" aria-disabled="false" aria-selected="true">
            				    <a id="wizard3-t-0" href="#wizard3-h-0" aria-controls="wizard3-p-0">
            					    <span class="current-info audible">current step: </span>
            						<span class="number">1</span> 
            						<span class="title">اطلاعات شخصی</span>
            					</a>
            				</li>
            				<li role="tab" class="done" aria-disabled="false" aria-selected="false">
            				    <a id="wizard3-t-1" href="#wizard3-h-1" aria-controls="wizard3-p-1">
            					    <span class="number">2</span> 
            						<span class="title">تکمیل اطلاعات</span>
            					</a>
            				</li>
            			</ul>
            		</div>
            		<div class="content clearfix" style="height: 360px;overflow: auto;">
            		    <input type="hidden" id="register-user-id">
            			<h3 id="wizard3-h-0" tabindex="-1" class="title current">اطلاعات شخصی</h3>
            			<section id="register-info" role="tabpanel" aria-labelledby="wizard3-h-0" class="body current" aria-hidden="false" style="">
            			    <form id="register">
            				    <div class="control-group form-group">
            					    <label class="form-label">نام</label>
            						<input type="text" id="name" class="form-control" autocomplete="on" placeholder="نام">
            					</div>
            					<div class="control-group form-group">
            					    <label class="form-label">نام خانوادگی</label>
            						<input type="text" id="family" class="form-control" autocomplete="on" placeholder="نام خانوادگی">
            					</div>
            					<div class="control-group form-group">
            					    <label class="form-label">شماره همراه</label>
            						<input type="tel" id="phone" class="phone form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required maxlength="11" autocomplete="on" placeholder="0912 000 0000">
            					</div>
            				</form>
            			</section>
            		    <h3 id="wizard3-h-1" tabindex="-1" class="title">تکمیل اطلاعات</h3>
            			<section id="register-auth" role="tabpanel" aria-labelledby="wizard3-h-1" class="body d-none" aria-hidden="true">
            			    <form id="registerAuthInfo">
            				    <div class="control-group form-group">
            					    <label class="form-label">تاریخ تولد</label>
            						<?= (!empty($timer)?$timer:'') ?>
            					</div>
            					<div class="control-group form-group">
            					    <label class="form-label">کد ارسال شده</label>
            						<input type="password" id="phone-code" class="form-control w-50 d-inline" placeholder="********">
            					    <a class="btn btn-danger"  onclick="resendPhoneCode(this);">
                            		    <span class="">
                            			    <b id="minutes-register-code"></b>:<b id="seconds-register-code"></b>
                            			</span>
                            			درخواست مجدد کد
                            		</a>
            					</div>
            				</form>
            			</section>
            		</div>
            		<div class="actions clearfix">
            		    <ul role="menu" aria-label="Pagination">
            			    <li class="w-100 d-none" id="register-perv-btn">
            				    <a onclick="registerPerv();" class="btn btn-danger-gradient">قبلی</a>
            				</li>
            				<li class="w-100 " id="register-next-btn">
            				    <a class="btn btn-success-gradient" onclick="register();">بعدی</a>
            				</li>
            				<li class="w-100 d-none" id="register-end-btn">
            				    <a class="btn btn-success-gradient" onclick="authRegister();">پایان</a>
            				</li>
            			</ul>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/users/register.js') ?>"></script>