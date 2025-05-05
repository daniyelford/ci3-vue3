function cancleNewLocation(){
    nLt='';
    nLn='';
    $('#add-marker-access').addClass('d-none');
    $('#all-marker-list').removeClass('d-none');
    return true;
}
function delMarker(el,id){
    let t = $(el).find('.type').val(),x='';
    if(t=='company'){
        x='company/company/remove_map';
    }else{
        if(t=='position'){
            x='company/position/position/remove_map';
        }else{
            if(t=='product'){
                x='company/product/product/remove_map';
            }else{
                return not8();
            }
        }
    }
    sendAjax({id:id},baseUrl(x),'');
}