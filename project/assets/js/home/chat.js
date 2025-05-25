function templateCreatorUserList(){
    let template='',selected=false,urlQuery= changeUrlQueryToArray(),chatData=jQuery.parseJSON($('#liveInput').val());
    $.each(chatData,function(a,b) {
        if(Math.floor(a) == a && $.isNumeric(a)){
            template+='<div onclick="changeChatSupport(this,'+ a +');" class="media chat-user-id-'+a;
            if(typeof(urlQuery.count)!=='undefined' && Math.floor(urlQuery.count) == urlQuery.count && $.isNumeric(urlQuery.count)){
                if(urlQuery.count===a){
                    template+=' selected';
                }
            }else{
                if(!selected){
                    selected=true;
                    template+=' selected';
                }
            }
            template+='"><div class="main-img-user online"><img alt="user image" src="';
            if(typeof(b.user_info.image)!=='undefined' && b.user_info.image!==''){
                template+=b.user_info.image;
            }else{
                template+=baseUrl('assets/svg/user/user.svg');
            }
            template+='"></div><div class="media-body"><div class="media-contact-name mt-2 p-1"><span>';
            if(typeof(b.user_info.name)!=='undefined' && b.user_info.name!==''){
                template+=b.user_info.name+' ';
            }
            if(typeof(b.user_info.family)!=='undefined' && b.user_info.family!==''){
                template+=b.user_info.family;
            }
            template+='</span></div></div></div>';
        }
    })
    return template;
}
function templateCreatorUserChatList(){
    let template='',selected=false,urlQuery=changeUrlQueryToArray(),chatData=jQuery.parseJSON($('#liveInput').val());
    $.each(chatData,function(a,b) {
        if(Math.floor(a) == a && $.isNumeric(a)){
		    template+='<div class="card chat-for-user chat-for-user-id-'+a;
            if(typeof(urlQuery.count)!=='undefined' && Math.floor(urlQuery.count) == urlQuery.count && $.isNumeric(urlQuery.count)){
                if(urlQuery.count!==a){
                    template+=' d-none';
                }
            }else{
                if(!selected){
                    selected=true;
                }else{
                    template+=' d-none';
                }
            }
		    template+='"><div class="card-body p-0"><div class="main-chat-header"><div class="main-img-user"><img alt="user image" src="';
		    if(typeof(b.user_info.image)!=='undefined' && b.user_info.image!==''){
                template+=b.user_info.image;
            }else{
                template+=baseUrl('assets/svg/user/user.svg');
            } 
		    template+='"></div><div class="main-chat-msg-name"><h6>';
		    if(typeof(b.user_info.name)!=='undefined' && b.user_info.name!==''){
                template+=b.user_info.name+' ';
            }
            if(typeof(b.user_info.family)!=='undefined' && b.user_info.family!==''){
                template+=b.user_info.family;
            }
		    template+='</h6></div><nav class="nav">';
		    if(typeof(b.user_info.phone)!=='undefined' && b.user_info.phone!==''){
                template+='<a href="tel:'+b.user_info.phone;
                template+='" title="زنگ زدن"><i class="icon ion-ios-call text-success"></i></a>';
            }
            template+='</nav></div><div class="main-chat-body p-0" style="overflow: hidden;"><div class="content-inner" id="templateCreatorUserChatListId'+a+'" style="height:260px;overflow-y:auto;overflow-x:hidden;">';
            template+=templateCreatorUserChatOneList(a,b);
            template+='</div></div></div><div class="card-footer"><input class="form-control chat-box" onkeypress="enterInputChatUser(this,event);" placeholder="پیام خود را اینجا بنویسید ..." type="text"><a onclick="sendUserChatSupportTo(this,'+a+',liveChat);" style="position: absolute;bottom: 20px;left: 30px;"><i class="far fa-paper-plane"></i></a></div></div>';
        }
    })
    return template;
}
function templateCreatorUserChatOneList(a,b){
    let template='';
    $.each(b.msg,function(c,d) {
        template+=templateCreatorUserChatOne(a,c,d);
    });
    return template; 
}
function templateCreatorUserChatOne(userId,b,c){
    let template='';
    if(typeof(c.id)!=='undefined' && Math.floor(c.id) == c.id && $.isNumeric(c.id) && typeof(c.text)!=='undefined' && c.text!==''){
        template+='<div class="media ';
        if(typeof(c.send)!=='undefined' && !c.send){
            template+='flex-row-reverse';
        }
        template+='"><div class="media-body"><div class="main-msg-wrapper mb-0 ';
        if(typeof(c.send)!=='undefined' && !c.send){
            template+='right';
        }
        template+='">'+c.text+'</div><div>';
        if(typeof(c.send)!=='undefined' && c.send){
            template+='<a onclick="deleteUserChat(this,'+c.id+','+userId+',liveChat);" class="wd-25 d-inline-block"><img src="'+baseUrl('assets/svg/icon/delete.svg')+'"></a>';
        }
        template+='</div></div></div>';
    }
    return template;
}
function sendUserChatSupportTo(el,uId,liveChat){
    clearInterval(liveChat);
    let t=$(el).parent().find('.chat-box').val();
    if(t!==''){
        $.ajax({
            data:{t:t,i:uId,ty:'su'},
            method:'post',
            url:baseUrl('chat/chat/add_massage'),
            success:function(e){
                if(e==0){
                    return not8();
                }else{
                    if(e=='no'){
                        window.location.reload(baseUrl());
                    }else{
                        let chatData=jQuery.parseJSON($('#liveInput').val());
                        $('.chat-for-user-id-'+uId).find('.content-inner').append('<div class="media"><div class="media-body"><div class="main-msg-wrapper mb-0">'+t+'</div><div><a onclick="deleteUserChat(this,'+e+','+uId+',liveChat);" class="wd-25 d-inline-block"><img src="'+baseUrl('assets/svg/icon/delete.svg')+'"></a></div></div></div>');
                        chatData[uId].msg.push({id:parseInt(e),text:t,send:true});
                        $('#liveInput').val(JSON.stringify(chatData));
                        liveChat=setInterval(checkUserChat,6000);
                        return true;
                    }
                }
            }
        })
        $(el).parent().find('.chat-box').val('');
    }else{
        return not1();
    }
}
function deleteUserChat(el,id,userId,liveChat){
    clearInterval(liveChat);
    $.ajax({
        data:{i:id},
        method:'post',
        url:baseUrl('chat/chat/remove_massage'),
        success:function(e){
            if(e==1){
                let chatData=jQuery.parseJSON($('#liveInput').val());
                $(el).parent().parent().parent().remove();
                chatData[userId].msg= jQuery.grep(chatData[userId].msg, function(value) {
                    return value.id != id;
                });
                $('#liveInput').val(JSON.stringify(chatData));
                liveChat=setInterval(checkUserChat,6000);
                return true;
            }else{
                return not8();
            }
        },error:function (){
            window.locarion.reload();
            return not13();
        }
    });
}
function changeChatSupport(el,id){
    $(el).parent().children().removeClass('selected');
    $(el).addClass('selected');
    $('.chat-for-user').addClass('d-none');
    $('.chat-for-user-id-'+id).removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('all_support_manager?count='+id));
    return true;
}
function enterInputChatUser(el,e) {
    if(e.which == 13) {
        $(el).parent().find('a').click();
    }
}
function checkUserChat(){
    $.ajax({
        method:'GET',
        url:baseUrl('all_support'),
        success:function(e){
            let a,chatData;
            if(e!=='undefined'&&e!==''){
                a=jQuery.parseJSON(e);
            }
            if($('#liveInput').val()){
                chatData=jQuery.parseJSON($('#liveInput').val());
            }
            if(typeof(a)!=='undefined'){
                $('#liveInput').val(JSON.stringify(a));
                if(typeof(chatData)==='undefined'){
                    $('#templateCreatorUserList').html(templateCreatorUserList());
                    $('#templateCreatorUserChatList').html(templateCreatorUserChatList());
                }else{
                    if(JSON.stringify(chatData) !== JSON.stringify(a)){
                        if(JSON.stringify(Object.keys(a)) !== JSON.stringify(Object.keys(chatData))){
                            $('#templateCreatorUserList').html(templateCreatorUserList());
                            $('#templateCreatorUserChatList').html(templateCreatorUserChatList());
                        }else{
                            $.each(a,function(b,c) {
                                if(JSON.stringify(c.msg) !== JSON.stringify(chatData[b].msg)){
                                    $('#templateCreatorUserChatListId'+b).html(templateCreatorUserChatOneList(b,c));
                                    let scrollableDiv = document.getElementById('templateCreatorUserChatListId'+b);
                                    scrollableDiv.scrollIntoView({ behavior: 'smooth', block: 'end' });
                                }
                            });
                        }
                    }
                }
            }else{
                $('#templateCreatorUserList').html(templateCreatorUserList());
                $('#templateCreatorUserChatList').html(templateCreatorUserChatList());
            }
            if($('#templateCreatorUserList').children().length>0){
                $('#noneChatUserError').addClass('d-none');
            }else{
                $('#noneChatUserError').removeClass('d-none');
            }
        }
    });
    checkUrlCurect();
}
function checkUrlCurect(){
    let urlQuery= changeUrlQueryToArray(),chatData=jQuery.parseJSON($('#liveInput').val());
    if(typeof(urlQuery.count)!=='undefined' && Math.floor(urlQuery.count) == urlQuery.count && jQuery.inArray(urlQuery.count, Object.keys(chatData))===-1){
        $('#templateCreatorUserList').children().first().click();
    }
}