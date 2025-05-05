<script>let liveSupportChat;</script>
<script src="<?= base_url('assets/js/users/dashbord/chat_includes/support.js') ?>"></script>
<input type="hidden" value='<?= (!empty($data["data"]["support"])?json_encode($data["data"]["support"]):"") ?>' id="liveInputSupport">
<div class="col-12">
    <div class="card chat-support">
        <div class="card-body p-0">
            <div class="main-chat-header">
                <div class="main-img-user">
            	    <img alt="user image" src="<?= base_url('assets/img/brand/logo-white.png') ?>">
            	</div>
            	<div class="main-chat-msg-name">
            	    <h6>پشتیبانی</h6>
            	</div>
            	<nav class="nav">
                    <a href="tel:<?= SUPPORT_PHONE_NUMBER ?>" title="زنگ زدن">
                	    <i class="icon ion-ios-call text-success"></i>
                	</a>
            	</nav>
            </div>
            <div class="main-chat-body p-0" style="overflow: hidden;">
                <div class="content-inner" id="templateCreatorUserSupportChatList" style="height:260px;overflow-y:auto;overflow-x:hidden;"></div>
            </div>
        </div>
        <div class="card-footer">
            <input class="form-control chat-box" onkeypress="enterInputChatUser(this,event);" placeholder="پیام خود را اینجا بنویسید ..." type="text">
            <a onclick="sendUserChatSupport(this,liveSupportChat);" style="position: absolute;bottom: 20px;left: 30px;"><i class="far fa-paper-plane"></i></a>
        </div>
    </div>
</div>
<script>
    $(function (){
        $('#templateCreatorUserSupportChatList').html(templateCreatorUserSupportChatList());
    })
    
    liveSupportChat=setInterval(checkUserChatSupport,6000);
</script>