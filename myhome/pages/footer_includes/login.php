<!--
<div class="modal" id="select2modal" data-select2-id="select2modal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document" data-select2-id="7">
        <div class="modal-content modal-content-demo" data-select2-id="6">
            <div class="modal-header">
        	    <h6 class="modal-title">
        		    ورود به ناحیه کاربری
        		</h6>
        		<button aria-label="بستن" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
        	</div>
            <form id="auth">
        	    <div class="modal-body" data-select2-id="5">
        		    <div class="form-group">
        			    <label>نام کاربری</label> 
        				<input id="username" class="form-control" autocomplete="on" placeholder=" نام کاربری خود را وارد کنید" type="text">
        			</div>
        			<div class="form-group">
        			    <label>کلمه عبور</label>
        				<input id="password" class="form-control" autocomplete="on" placeholder="رمز ورود خود را وارد کنید" type="password">
        			</div>
        	    </div>
        		<div class="modal-footer">
        		    <button onclick="authAction(event);" class="btn btn-success-gradient btn-block">ورود به حساب</button>
        		</div>
        	</form>	
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/users/login.js') ?>"></script>
-->
<div class="modal" id="select9modal" data-select2-id="select9modal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document" data-select2-id="7">
        <div class="modal-content modal-content-demo" data-select2-id="6">
            <div class="modal-header">
        	    <h6 class="modal-title">
        		    ورود با شماره همراه
        		</h6>
        		<button aria-label="بستن" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
        	</div>
        	<form id="phone-auth">
        	    <div class="modal-body" data-select2-id="5">
        		    <div class="form-group phone-inner">
        			    <label>شماره همراه</label> 
        				<input id="phone-number" class="phone form-control" maxlength="11" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required autocomplete="on" placeholder="0912 000 0000" type="tel">
        			</div>
        		    <div class="form-group code d-none">
        			    <label>کد ارسالی</label>
        				<input id="sms-code" class="form-control" placeholder="کد ارسالی را وارد کنید" type="password">
        			</div>
        		</div>
        		<div class="modal-footer">
        		    <button onclick="sendSmsLogin(this,event);" class="btn btn-success-gradient btn-block">ارسال پیام</button>
        			<button onclick="changePhoneNumber(this,event);" class="btn btn-danger-gradient edit-code btn-block d-none">ویرایش شماره</button>
        			<a onclick="sendSmsLoginAgain(this,event);" class="disabled btn btn-warning-gradient retry-code btn-block d-none">
        			    <span class="">
        				    <b id="minutes"></b>:<b id="seconds"></b>
        				</span>
        			ارسال مجدد</a>
        			<button onclick="smsLogin(this,event);" class="btn btn-success-gradient btn-block acept-code d-none">ورود</button>
        		</div>
        	</form>	
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/users/sms-login.js') ?>"></script>