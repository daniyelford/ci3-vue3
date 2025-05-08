function checkManagerRequests(){
    if($('#all-reserves-info').length>0){
        sendAjax({send:'ok'},baseUrl('company/position/position/all_reserves_info'),'#all-reserves-info');
    }
    return true;
}
function showCalenderPosition(el){
    $(el).parent().parent().children().addClass('d-none');
    $(el).parent().parent().find('.calender-position').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position&action=calender&count='+$(el).parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function showCalenderPositionTwo(el){
    $(el).parent().parent().parent().parent().children().addClass('d-none');
    $(el).parent().parent().parent().parent().find('.calender-position').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position&action=calender&count='+$(el).parent().parent().parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function hideCalenderPosition(el){
    $(el).parent().parent().parent().parent().children().addClass('d-none');
    $(el).parent().parent().parent().parent().children('.inf').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position'));
    return true;
}
function showPositionOrder(el){
    $(el).parent().parent().children().addClass('d-none');
    $(el).parent().parent().find('.order').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position&action=menu&count='+$(el).parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function hidePositionOrder(el){
    $(el).parent().parent().parent().children().addClass('d-none');
    $(el).parent().parent().parent().children('.inf').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position'));
    return true;
}
function showCompanyOtherProductHas(el){
    $(el).parent().parent().children().addClass('d-none');
    $(el).parent().parent().find('.company-other-product').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position&action=menu&call=list&count='+$(el).parent().parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function showCompanyOtherProduct(el){
    $(el).parent().parent().children().addClass('d-none');
    $(el).parent().parent().find('.company-other-product').removeClass('d-none');
    let scrollableDiv = document.getElementById('nonePositionUserId'+$(el).parent().parent().parent().find('.userPositionIdInput').val());
    scrollableDiv.scrollIntoView({ behavior: 'smooth', block: 'end' });
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=none-position&call=menu&count='+$(el).parent().parent().parent().find('.userPositionIdInput').val()+'#nonePositionUserId'+$(el).parent().parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function hideCompanyOtherProductHas(el){
    $(el).parent().parent().parent().parent().children().removeClass('d-none');
    $(el).parent().parent().parent().parent().find('.company-other-product').addClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position&action=menu&count='+$(el).parent().parent().parent().parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function hideCompanyOtherProduct(el){
    $(el).parent().parent().parent().parent().children().removeClass('d-none');
    $(el).parent().parent().parent().parent().find('.company-other-product').addClass('d-none');
    let scrollableDiv = document.getElementById('nonePositionUserId'+$(el).parent().parent().parent().parent().parent().find('.userPositionIdInput').val());
    scrollableDiv.scrollIntoView({ behavior: 'smooth', block: 'end' });
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=none-position&count='+$(el).parent().parent().parent().parent().parent().find('.userPositionIdInput').val()+'#nonePositionUserId'+$(el).parent().parent().parent().parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function showAccessReservePositionTime(el){
    $(el).parent().parent().children().addClass('d-none');
    $(el).parent().parent().find('.factor-position-order').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position&action=buy&count='+$(el).parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function hidAccessReservePositionTime(el){
    $(el).parent().parent().parent().parent().parent().parent().parent().children().addClass('d-none');
    $(el).parent().parent().parent().parent().parent().parent().parent().children('.inf').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position'));
    return true;
}
function showTimeReservePositionTime(el){
    $(el).parent().parent().children().addClass('d-none');
    $(el).parent().parent().find('.reserve-timer').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position&action=reserve&count='+$(el).parent().parent().find('.userPositionIdInput').val()));
    return true;
}
function hideTimeReservePositionTime(el){
    $(el).parent().parent().parent().parent().children().addClass('d-none');
    $(el).parent().parent().parent().parent().children('.inf').removeClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position'));
    return true;
}
function showPayProduct(el,price){
    $(el).parent().parent().children().addClass('d-none');
    let a=$(el).parent().find('.product-count').val(),b,c,d;
    a=parseInt(a);
    price=parseInt(price);
    b=a*price;
    // c=b/10;
    // d=b+c;
    $(el).parent().parent().find('.factor-product-position-order').removeClass('d-none');
    $(el).parent().parent().children('.factor-product-position-order').find('.product-count-result').html(a);
    $(el).parent().parent().children('.factor-product-position-order').find('.product-total-result').html(new Intl.NumberFormat().format(b)+' تومان');
    // $(el).parent().parent().children('.factor-product-position-order').find('.product-total-result-tax').html(new Intl.NumberFormat().format(d)+' تومان');
    return true;
}
function hidePayProduct(el){
    $(el).parent().parent().parent().parent().parent().parent().parent().children().removeClass('d-none');
    $(el).parent().parent().parent().parent().parent().parent().parent().children('.factor-product-position-order').addClass('d-none');
    return true;
}
function accessTimePositionUser(el,posUserId){
    $(el).addClass('d-none')
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position'));
    let h=$(el).parent().parent().parent().find('.hour').val(),
    d=$(el).parent().parent().parent().find('.day').val(),
    m=$(el).parent().parent().parent().find('.month').val(),
    y=$(el).parent().parent().parent().find('.year').val();
    if(h!==''&&d!==''&&m!==''&&y!==''){
        $(el).addClass('d-none');
        sendAjax({h:h,d:d,m:m,y:y,posUserId:posUserId},baseUrl('company/position/position/access_time_position'),'#side2');
        checkManagerRequests();
    }
    return true;
}
function accessServiceTimerPositionUser(el,posUserId){
    $(el).addClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position'));
    let h=$(el).parent().parent().parent().find('.hour').val(),
    d=$(el).parent().parent().parent().find('.day').val(),
    m=$(el).parent().parent().parent().find('.month').val(),
    y=$(el).parent().parent().parent().find('.year').val();
    if(h!==''&&d!==''&&m!==''&&y!==''){
        $(el).parent().parent().parent().find('.TimerPositionUser').removeClass('border-danger');
        sendAjax({h:h,d:d,m:m,y:y,posUserId:posUserId},baseUrl('company/position/position/access_service_time_position'),'#side2');
        checkManagerRequests();
    }
    return true;
}
function payPositionReserveNow(el,userPosId,posId){
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position'));
    sendAjax({userPosId:userPosId,posId:posId},baseUrl('company/position/position/pay_position_reserve'),'');
    return true;
}
function payProduct(posProOrderId){
    sendAjax({posProOrderId:posProOrderId},baseUrl('company/position/position/pay_product_position_order'),'');
    return true;
}
function reserveProductInPositionUser(el,userPosId,proId){
    $(el).addClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position&action=menu&count='+userPosId));
    sendAjax({userPosId:userPosId,proId:proId,count:$(el).parent().find('.product-count').val()},baseUrl('company/position/position/reserve_product_in_position_user'),'');
    // checkManagerRequests();
    return true;
}
function changeCountOrder(el,oId){
    sendAjax({oId:oId,count:$(el).val()},baseUrl('company/position/position/change_count_order'),'');
    if(!($(el).val()>0)){
        $(el).parent().parent().parent().remove();
    }
}
function showHasPosition(el){
    $(el).parent().find('.bg-success').removeClass('bg-success');
    $(el).addClass('bg-success');
    $(el).parent().parent().parent().parent().parent().parent().find('.has-position').removeClass('d-none');
    $(el).parent().parent().parent().parent().parent().parent().find('.none-position').addClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=has-position'));
    return true;
}
function showNonePosition(el){
    $(el).parent().find('.bg-success').removeClass('bg-success');
    $(el).addClass('bg-success');
    $(el).parent().parent().parent().parent().parent().parent().find('.none-position').removeClass('d-none');
    $(el).parent().parent().parent().parent().parent().parent().find('.has-position').addClass('d-none');
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=none-position'));
    return true;
}
function showPositionOrderNonePosition(el){
    // $(el).parent().parent().children().removeClass('bg-dark');
    $(el).parent().addClass('bg-dark');
    // $(el).parent().parent().find('.order').addClass('d-none');
    // $(el).parent().find('.order').children().removeClass('d-none');
    // $(el).parent().find('.order').children('.company-other-product').addClass('d-none');
    $(el).parent().find('.order').removeClass('d-none');
    // let scrollableDiv = document.getElementById('nonePositionUserId'+$(el).parent().find('.userPositionIdInput').val());
    // scrollableDiv.scrollIntoView({ behavior: 'smooth', block: 'end' });
    processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=none-position&count='+$(el).parent().find('.userPositionIdInput').val()+'#nonePositionUserId'+$(el).parent().find('.userPositionIdInput').val()));
    return true;
}
function hidePositionOrderNonePosition(el){
    $(el).parent().parent().addClass('d-none');
    $(el).parent().parent().parent().removeClass('bg-dark');
    let urlQuery= changeUrlQueryToArray(),a=$(el).parent().parent().parent().find('.userPositionIdInput').val();
    if(typeof(urlQuery.count)!=='undefined' && urlQuery.count==a){
        processAjaxData(document.title,$('#content').html(),baseUrl('shopping?type=none-position'));
    }
    return true;
}