<script src="<?= base_url('assets/js/users/dashbord/chat_includes/user.js') ?>"></script>
<script>let liveChat;</script>
<div class="col-md-4 col-sm-6">
    <div class="card">
        <div class="card-body p-0" style="max-height:180px;overflow-y:auto;overflow-x:hidden;">
		    <div class="main-chat-list" id="templateCreatorUserList"></div>
    	</div>
    </div>
</div>
<div class="col-md-8 col-sm-6" id="templateCreatorUserChatList"></div>
<script>
    $(function (){
        $('#templateCreatorUserList').html(templateCreatorUserList());
        $('#templateCreatorUserChatList').html(templateCreatorUserChatList());
        checkUrlCurect();
        if($('#templateCreatorUserList').children().length>0){
            $('#noneChatUserError').addClass('d-none');
        }else{
            $('#noneChatUserError').removeClass('d-none');
        }
    })
    liveChat=setInterval(checkUserChat,6000);
</script>
<div class="col-10 mx-auto d-none" id="noneChatUserError">
    <div class="alert alert-danger text-center rounded-10 mt-2 p-5">
        شما هیچ پیامی از این بخش دریافت نکردید
    </div>
</div>
