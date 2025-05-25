function diableProduct(el,id){
    $(el).addClass('d-none');
    $(el).parent().find('.enable').removeClass('d-none');
    sendAjax({id:id},baseUrl('product/product/valex_disable_product'),'');
    return true; 
}
function enableProduct(el,id){
    $(el).addClass('d-none');
    $(el).parent().find('.disable').removeClass('d-none');
    sendAjax({id:id},baseUrl('product/product/valex_enable_product'),'');
    return true;
}
function diableManagerProduct(el,id){
    $(el).addClass('d-none');
    $(el).parent().find('.enableDelete').removeClass('d-none');
    sendAjax({id:id},baseUrl('product/product/manager_disable_product'),'');
    return true; 
}
function enableManagerProduct(el,id){
    $(el).addClass('d-none');
    $(el).parent().find('.disableDelete').removeClass('d-none');
    sendAjax({id:id},baseUrl('product/product/manager_enable_product'),'');
    return true;
}