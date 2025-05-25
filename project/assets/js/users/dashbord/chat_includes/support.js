function templateCreatorUserSupportChatList(){
    let template='',chatData;
    if($('#liveInputSupport').val()!==''){
        chatData=jQuery.parseJSON($('#liveInputSupport').val());
        $.each(chatData,function (b,c){
            if(typeof(c)!=='undefined' && Math.floor(c.id) == c.id && $.isNumeric(c.id) && typeof(c.text)!=='undefined' && c.text!==''){
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
                    template+='<a onclick="deleteUserSupportChat(this,'+c.id+',liveSupportChat);" class="wd-25 d-inline-block"><img src="'+baseUrl('assets/svg/icon/delete.svg')+'"></a>';
                } 
                template+='</div></div></div>';
            }
        })
    }
    return template;
}
function sendUserChatSupport(el,liveSupportChat){
    clearInterval(liveSupportChat);
    let t=$(el).parent().find('.chat-box').val();
    if(t!==''){
        $.ajax({
            data:{t:t,ty:'s'},
            method:'post',
            url:'chat/chat/add_massage',
            success:function(e){
                if(e==0){
                    return not8();
                }else{
                    if(e=='no'){
                        window.location.reload(baseUrl());
                    }else{
                        $('.chat-support').find('.content-inner').append('<div class="media"><div class="media-body"><div class="main-msg-wrapper mb-0">'+t+'</div><div><a onclick="deleteUserSupportChat(this,'+e+',liveSupportChat);" class="wd-25 d-inline-block"><img src="'+baseUrl('assets/svg/icon/delete.svg')+'"></a></div></div></div>');
                        let chatData=[];
                        if($('#liveInputSupport').val()!==''){
                            chatData=jQuery.parseJSON($('#liveInputSupport').val());
                        }
                        chatData.push({id:parseInt(e),text:t,send:true});
                        $('#liveInputSupport').val(JSON.stringify(chatData));
                        liveSupportChat=setInterval(checkUserChatSupport,6000);
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
function deleteUserSupportChat(el,id,liveSupportChat){
    clearInterval(liveSupportChat);
    $.ajax({
        data:{i:id},
        method:'post',
        url:'chat/chat/remove_massage',
        success:function(e){
            if(e==1){
                let chatData=jQuery.parseJSON($('#liveInputSupport').val());
                $(el).parent().parent().parent().remove();
                chatData= jQuery.grep(chatData, function(value) {
                    return value.id != id;
                });
                $('#liveInputSupport').val(JSON.stringify(chatData));
                liveSupportChat=setInterval(checkUserChatSupport,6000);
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
function checkUserChatSupport(){
    $.ajax({
        method:'GET',
        url:'chat/chat/new_massage',
        success:function(e){
            let a,chatData;
            if(e!=='undefined'&&e!==''){
                a=jQuery.parseJSON(e);
            }
            if($('#liveInputSupport').val()!==''){
                chatData=jQuery.parseJSON($('#liveInputSupport').val());
            }
            if(typeof(a)!=='undefined' && typeof(a['support'])!=='undefined'){
                a=a['support'];
                $('#liveInputSupport').val(JSON.stringify(a));
                if(typeof(chatData)!=='undefined'){
                    if(JSON.stringify(chatData) !== JSON.stringify(a)){
                        $('#templateCreatorUserSupportChatList').html(templateCreatorUserSupportChatList());
                    }else{
                        return true;
                    }
                }else{
                    $('#templateCreatorUserSupportChatList').html(templateCreatorUserSupportChatList());
                }
            }else{
                $('#templateCreatorUserSupportChatList').html('');
                $('#liveInputSupport').val('');
            }
        }
    });

}