function showWalletDetails(el){
    $(el).parent().parent().find('.details').removeClass('d-none');
	$(el).addClass('d-none');
	$(el).parent().find('.hWd').removeClass('d-none');
	return true;
}
function hideWalletDetails(el){
    $(el).parent().parent().find('.details').addClass('d-none');
	$(el).addClass('d-none');
	$(el).parent().find('.sWd').removeClass('d-none');
	return true;
}
function enterInputChatUser(el,e) {
    if(e.which == 13) {
        $(el).parent().find('a').click();
    }
}
function productElementsToolsNumber(el,id){
    $('#chatmodelproduct'+id).removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('chat?type=product&count='+id+'#chatmodelproduct'+id));
    return true;
}
function positionElementsToolsNumber(el,id){
    $('#chatmodelposition'+id).removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('chat?type=position&count='+id+'#chatmodelposition'+id));
    return true;
}
function showUserChatInChatPage(el){
    $('#user-chat-in-chat-page').removeClass('d-none');
    $('#support-chat-in-chat-page').addClass('d-none');
    $('#position-chat-in-chat-page').addClass('d-none');
    $('#product-chat-in-chat-page').addClass('d-none');
    $('#notification-page').addClass('d-none');
    $(el).parent().find('.btn').removeClass('btn-success-gradient');
    $(el).parent().find('.btn').addClass('btn-dark-gradient');
    $(el).addClass('btn-success-gradient');
    $(el).removeClass('btn-dark-gradient');
    processAjaxData(document.title,$('#content').html(),baseUrl('chat?type=users'));
    return true;
}
function showSupportChatInChatPage(el){
    $('#support-chat-in-chat-page').removeClass('d-none');
    $('#user-chat-in-chat-page').addClass('d-none');
    $('#position-chat-in-chat-page').addClass('d-none');
    $('#product-chat-in-chat-page').addClass('d-none');
    $('#notification-page').addClass('d-none');
    $(el).parent().find('.btn').removeClass('btn-success-gradient');
    $(el).parent().find('.btn').addClass('btn-dark-gradient');
    $(el).addClass('btn-success-gradient');
    $(el).removeClass('btn-dark-gradient');
    processAjaxData(document.title,$('#content').html(),baseUrl('chat?type=support'));
    return true;
}
function showPositionChatInChatPage(el){
    $('#position-chat-in-chat-page').removeClass('d-none');
    $('#user-chat-in-chat-page').addClass('d-none');
    $('#support-chat-in-chat-page').addClass('d-none');
    $('#product-chat-in-chat-page').addClass('d-none');
    $('#notification-page').addClass('d-none');
    $(el).parent().find('.btn').removeClass('btn-success-gradient');
    $(el).parent().find('.btn').addClass('btn-dark-gradient');
    $(el).addClass('btn-success-gradient');
    $(el).removeClass('btn-dark-gradient');
    processAjaxData(document.title,$('#content').html(),baseUrl('chat?type=position'));
    return true;
}
function showProductChatInChatPage(el){
    $('#product-chat-in-chat-page').removeClass('d-none');
    $('#user-chat-in-chat-page').addClass('d-none');
    $('#support-chat-in-chat-page').addClass('d-none');
    $('#position-chat-in-chat-page').addClass('d-none');
    $('#notification-page').addClass('d-none');
    $(el).parent().find('.btn').removeClass('btn-success-gradient');
    $(el).parent().find('.btn').addClass('btn-dark-gradient');
    $(el).addClass('btn-success-gradient');
    $(el).removeClass('btn-dark-gradient');
    processAjaxData(document.title,$('#content').html(),baseUrl('chat?type=product'));
    return true;
}
function showNotificationPage(el){
    $('#notification-page').removeClass('d-none');
    $('#product-chat-in-chat-page').addClass('d-none');
    $('#support-chat-in-chat-page').addClass('d-none');
    $('#user-chat-in-chat-page').addClass('d-none');
    $('#position-chat-in-chat-page').addClass('d-none');
    $(el).parent().find('.btn').removeClass('btn-success-gradient');
    $(el).parent().find('.btn').addClass('btn-dark-gradient');
    $(el).addClass('btn-success-gradient');
    $(el).removeClass('btn-dark-gradient');
    processAjaxData(document.title,$('#content').html(),baseUrl('chat?type=system'));
    return true;
}