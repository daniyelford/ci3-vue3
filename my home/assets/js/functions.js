function changeUrlQueryToArray() {
    var pairs = window.location.search.substring(1).split("&"),obj = {},pair,i;
    for ( i in pairs ) {
        if ( pairs[i] === "" ) continue;
        pair = pairs[i].split("=");
        obj[ decodeURIComponent( pair[0] ) ] = decodeURIComponent( pair[1] );
    }
    return obj;
}
$(function(){
    $('.phone').keyup(function(e){
        var charCode = (e.which) ? e.which : e.keyCode;
        $(this).val(phoneFormat($(this).val()));
    });
    
})
function phoneFormat(input){
    input = input.replace(/\D/g,'');
    input = input.substring(0,11);
    return input; 
}
function downloadImage(el){
    var a = $("<a>").attr("href", $(el).attr('src')).attr("download", "img.png").appendTo("body");
    a[0].click();
    a.remove();
}
function visitCompanyProfile(cId){
    let siteKey=$('#site-key').val(),data={cId:cId},url=baseUrl('company/company/show_profile_id');
    grecaptcha.ready(function() {
        grecaptcha.execute(siteKey, {action: 'send'}).then(function(token) {
    		$('#send').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
    		$.post(url,{data:data, token: token}, function(result) {
    		    if(result==0){
    		        return not1();
    		    }else{
    		        window.location.replace(baseUrl('show_company/'+result));
    		    }
            });
    	});
    });
    return true;
}
function sendGetMethod(url,id){
    if(url!==''){
        $.get(url, function( data ) {
            if(id!==''){
                $(id).html(data);
                return true;
            }else{
                console.log(data);
            }
        });
    }
    return false;
}
function reserveProductInPosition(el,positionId,productId){
    $(el).addClass('d-none');
    sendAjax({positionId:positionId,productId:productId},baseUrl('company/position/position/reserve_product_in_position'),'');
    // return changeSideContent();
}
// function changeSideContent(){
//     sendAjax({send:'ok'},baseUrl('company/position/position/side'),'#side2');
// }
function reloadPage(){
    window.location.reload();
}
function reloadAfterSecounds(x){
    var handle = setInterval(reloadPage, x);
    clearInterval(handle);
    handle = 0;
}
function reservePosition(el,positionId){
    $(el).addClass('d-none');
    sendAjax({positionId:positionId},baseUrl('company/position/position/reserve_position'),'');
    // reloadAfterSecounds(4);
    // return changeSideContent();
}
function setupBtnsClick(el){
    $(el).parent().children('.setup-btns-event').removeClass('d-none');
    $(el).addClass('d-none');
}
function showPayInfo(el){
    $(el).parent().parent().children().addClass('d-none');
    $(el).parent().parent().find('.pay-info').removeClass('d-none');
    return true;
}
function hidePayInfo(el){
    $(el).parent().parent().parent().children().removeClass('d-none');
    $(el).parent().parent().parent().find('.pay-info').addClass('d-none');
    return true;
}
function companyManagerShowError(){
    $('.companyManagerShowErrorLog').removeClass('d-none');
    return not16();
}
function companyManager(el){
    let crid=$(el).find('.company-role-id').val(),
    crpid=$(el).find('.company-role-parent-id').val(),
    rid=$(el).find('.role-id').val(),
    cid=$(el).find('.company-id').val(),
    cuid=$(el).find('.company-user-id').val();
    sendAjax({cuid:cuid,crid:crid,crpid:crpid,rid:rid,cid:cid},baseUrl('company/company/choose_one'),'');
    $('.sidebar-remove').trigger('click');
    return true;
}
function addCompany(el){
    let n=$('#company-title').val(),
    d=$('#company-description').val(),
    u=$('#company-url').val(),
    f=$(el).parent().parent().parent().find('.file-name').val(),
    t=$(el).parent().parent().find('input[name=type]:checked').val(),
    uId=$('#user-id').val();
    if(typeof(f)=="undefined"){
        f='';
    }
    if(n!==''&&typeof(n)!=='undefined'&&
    d!==''&&typeof(d)!=='undefined'&&
    t!==''&&typeof(t)!=='undefined'&&
    uId!==''&&typeof(uId)!=='undefined'){
        sendAjax({file:f,title:n,url:u,type:t,des:d,user:uId},baseUrl('company/company/add'),'');
    }else{
        return not1();
    }
    return true;
}
// general
function hideLoader(){
    $('#global-loader').addClass('d-none');
    // $('#content').removeClass('d-none');
    // $('#map').removeClass('v-hidden');
    return true;
}
function showLoader(){
    // $('#content').addClass('d-none');
    // // $('#map').addClass('v-hidden');
    $('#global-loader').attr('style', '');
    $('#global-loader').removeClass('d-none');
    return true;
}
function processAjaxData(title,html,urlPath){
    document.getElementById("content").innerHTML = html;
    document.title = title;
    window.history.pushState({"html":html,"pageTitle":title},"", urlPath);
    hideLoader();
}
window.onpopstate = function(e){
    if(e.state){
        document.getElementById("content").innerHTML = e.state.html;
        document.title = e.state.pageTitle;
    }
};
function baseUrl(url){
    let u='';
    if(url!==''){
        u='/'+url;
    }
    return "https://" + document.domain+u;
}
function sendJson(url,data){
    let siteKey=$('#site-key').val();
    grecaptcha.ready(function() {
        grecaptcha.execute(siteKey, {action: 'send'}).then(function(token) {
    		$('#send').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
    		$.post(url,{data:data, token: token}, function(result) {
    			if(result == 0){
                    return not8();
                }else{
    			    if(result == 'no'){
    			        return not12();
    			    }else{
        			    result=JSON.parse(result);
        			    if(result['status']){
        			        processAjaxData(result['title'],$('#content').html(),result['url']);
        			    }else{
        			        window.location.reload();
        			        return not13();
        			    }
    			    }
    			}
    		});
    	});
    });
    return true;
}
function clickAction(p,v=''){
    if($('#loaderIcon').hasClass('d-none')){
        showLoader();
    }
    let a=p;
    if(v!==''){
        a+=':'+v
    }
    sendJson(baseUrl('role/click_action'),a);
    return true;
}
function sendAjax(data,url,tag=''){
    let siteKey=$('#site-key').val();
    grecaptcha.ready(function() {
        grecaptcha.execute(siteKey, {action: 'send'}).then(function(token) {
    		$('#send').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
    		$.post(url,{data:data, token: token}, function(result) {
    			if(result == 0){
        		    hideLoader();
            		return not8();
        		}else{
    			    if(tag!==''){
            		    if($.trim(result)!==''){
                		    $(tag).html(result);
                            hideLoader();
            			}else{
            			    $(tag).html('<div class="alert alert-danger text-dark rounded-10 text-center p-5">هیچ اطلاعاتی موجود نیست</div>');
            			    hideLoader();
            			}
            	    }else{
            	        switch(result){
            	            case '1':
            	                window.location.replace(baseUrl(''));
            	                break;
            	            case '11':
            	                return not10();
            	                break;
            	            case '111':
                		        window.location.reload();
                		        return not10();
                		        break;
                		    case '1111':
                		        window.location.replace(baseUrl('company_one'));
            	                break;
            	            case '11111':
            	                window.location.replace(baseUrl(''));
                        		return not10();
            	                break;
            	            case '111111':
            	                window.location.replace(baseUrl('user_in_company'));
            	                break;
            	            case '1111111':
            	                window.location.replace(baseUrl('company_users'));
            	                return not10();
            	                break;
            	            case '11111111':
            	                window.location.replace(baseUrl('company_manager'));
            	                return not10();
            	                break;
            	            case '111111111':
            	                window.location.replace(baseUrl('company_promotion_order'));
            	                return not10();
            	                break;
            	            case '1111111111':
            	                window.location.replace(baseUrl('company_position_one'));
            	                break;
            	            case '11111111111':
            	                window.location.replace(baseUrl('company_position_setting'));
            	                break;
            	            case '111111111111':
            	                window.location.replace(baseUrl('company_product_one'));
            	                break;
            	            case '1111111111111':
            	                window.location.replace(baseUrl('company_product_setting'));
            	                break;
            	            case '11111111111111':
            	                window.location.replace(baseUrl('reserve'));
            	               // $('#reserveManagerShowErrorLog').removeClass('d-none');
                                return not33();
            	                break;
            	            case '111111111111111':
                		        window.location.reload();
                		        break;
                		    case '1111111111111111':
                		        window.location.replace(baseUrl('product_company_manager'));
                		        return not10();
                		        break;
                		    case '11111111111111111':
                		        window.location.replace(baseUrl('position_company_manager'));
                		        return not10();
                		        break;
                		  //  case '111111111111111111':
                		  //      window.location.reload();
                		  //      history.back();
                		  //      return not10();
                		  //      break;
            	            case '2':
            	                return not3();
            	                break;
            	            case '20':
            	                return not2();
            	                break;
            	            case '21':
            	                return not21();
            	                break;
            	            case '22':
            	                return not22();
            	                break;
            	            case '23':
            	                return not24();
            	                break;
            	            case '25':
            	                return not25();
            	                break;
            	            case '26':
            	                return not26();
            	                break;
            	            case '27':
            	                return not27();
            	                break;
            	            case '28':
            	                return not28();
            	                break;
            	            case '30':
            	                return not30();
            	                break;
        	                case '34':
            	                return not34();
            	                break;
            	            case '36':
            	                return not36();
            	                break;
            	            case '37':
            	                return not37();
            	                break;
            	            case '38':
            	                return not38();
            	                break;
            	            case '39':
            	                return not39();
            	                break;
            	            case '40':
            	                return not40();
            	                break;
            	            case '41':
            	                return not41();
            	                break;
            	            case '42':
            	                return not42();
            	                break;
            	            case '43':
            	                return not43();
            	                break;
            	            case '19':
            	                return not19();
            	                break;
            	            case '10':
            	                window.location.reload();
            	                return not8();
            	                break;
            	            case 'ok':
            	                break;
            	            default:
            	                console.log(result);
            	                break;
            	        }
        			}
                }
        	});
        });
    });
    return true;
}
// general
function checkBackUrlFunction(){}
function showVideoBigger(el){
    $(el).parent().parent().parent().find('video').removeClass('active');
    $(el).parent().parent().find('video').addClass('active');
    return true;
}
function hideVideo(){
    $('.show-div-setting').children().addClass('d-none');
    checkBackUrlFunction();
    return true;
}
function hideImage(){
    $('.show-div-setting').children().addClass('d-none');
    checkBackUrlFunction();
    return true;
}
function hideChat(){
    $('.show-div-setting').children().addClass('d-none');
    checkBackUrlFunction();
    return true;
}
function showChatChildrens(el,type,id){
    $(el).parent().parent().parent().parent().children().removeClass('d-none');
    $(el).addClass('d-none');
    $(el).parent().children('.hide-chat-childrens').removeClass('d-none');
    return true;
}
function hideChatChildrens(el,type,id){
    $(el).parent().parent().parent().parent().children('.child').addClass('d-none');
    $(el).addClass('d-none');
    $(el).parent().children('.show-chat-childrens').removeClass('d-none');
    return true;
}
function loginError(el){
    $(el).addClass('text-muted');
    // $('.profile-user').trigger('click');
    // $('.main-profile-menu').addClass('show');
    $('.loginErrorLog').removeClass('d-none');
    return notLogin();
}
function showProductValue(el){
    $(el).parent().children('.product-value').children().removeClass('d-none');
    return true;
}

function productElementsTools(el,type,id){
	$('.show-div-setting').addClass('d-none');
	let parentEl=$(el).parent().parent().find('.show-div-setting');
	parentEl.removeClass('d-none');
	$('.show-div-setting').children().addClass('d-none');
	parentEl.find('.'+type).removeClass('d-none');
	return true;
}
function backproductElementsTools(el,type,id){
    // $(el).parent().addClass('d-none');
    checkBackUrlFunction();
    $('.show-div-setting').children().addClass('d-none');
    return true;
}
function hideChatBox(el){
    $(el).parent().parent().find('.parentId').val(0);
    $('.chat-item-div').removeClass('bg-success');
    $(el).parent().html('');
    return true;
}
function deleteChatId(el,type,id){
    $(el).parents('.chat-item-id-'+id).parent().remove();
    sendAjax({t:type,i:id},baseUrl('chat/chat/remove'),'');
    return true;
}
function sendChat(el){
    let p=$(el).parent().parent().find('.pId').val(),
    pp=$(el).parent().parent().find('.parentId').val(),
    i=$(el).parent().parent().find('.userId').val(),
    t=$(el).parent().parent().find('.type').val(),
    c=$(el).parent().parent().find('.chat-box-text').val();
    if(typeof(pp)=='undefined'){
        pp=0;
    }
    if(c!==''){
        $('.chat-replay').html('');
        $(el).parent().parent().find('.parentId').val(0);
        $(el).parent().parent().find('.chat-box-text').val('');
        sendAjax({type:t,uId:i,text:c,pId:p,parentId:pp},baseUrl('chat/chat/add'),'#chatmodel'+t+p);
        return true;
    }else{
        return not1();
    }
}
function showChatBox(el,id,name){
    $('.chat-item-div').removeClass('bg-success');
    $(el).parent().parent().addClass('bg-success');
    $(el).parents('.chatmodel').find('.parentId').val(id);
    $(el).parents('.chatmodel').find('.chat-replay').html('<a class="btn btn-danger-gradient rounded-5 py-1 px-2 m-1" onclick="hideChatBox(this);">x</a>'+name);
    return true;
}
// page
function changePage(page){
    switch (page) {
    //     case 'dashbord':
    //         dashbordPage();
    //         break;
            
    //     case 'company-info':
    //         companyPage();
    //         break;
            
    //     case 'add-company':
    //         addCompany();
    //         break;
    
        case 'user-setting':
            userSetting();
            break;
            
        default:
    //         showHome();
            break;
    }
    return true;
}
// function addCompany(){
//     $('#add-company-btn-show').addClass('d-none');
//     $('#content').children('section').addClass('d-none');
//     $('#content').children('#add-company').removeClass('d-none');
//     return true;
// }
function dashbordPage(){
    // if($('#content').children('section').length>1){
    //     $('#company-manager-btn-show').removeClass('d-none');
    //     $('#content').children('section').first().removeClass('d-none');
    //     $('#content').children('#add-company').addClass('d-none');
    //     $('#content').children('section').last().addClass('d-none');
    // }else{
    //     $('#content').children('section').first().removeClass('d-none');
    //     $('#content').children('#add-company').addClass('d-none');
    // }
    // $('#add-company-btn-show').removeClass('d-none');
    // $('#nav').find('.category-nav-menu').first().trigger('click');
    return true;
}
function companyPage(){
    $('#company-manager-btn-show').addClass('d-none');
    $('#content').children('section').addClass('d-none');
    $('#content').children('#add-company').addClass('d-none');
    $('#content').children('section.company').removeClass('d-none');
    return true;
}
function userSetting(){
    showLoader();
    sendAjax({},baseUrl('users/dashbord/setting'),'#content');
    // $('#login').removeClass('d-none');
    // $('#login').children('#costum-login').addClass('d-none');
    // $('#login').children('#add-user').addClass('d-none');
    // $('#login').children('#user-setting').removeClass('d-none');
    // $('#app').addClass('d-none');
    return true;
}
function addUser(){
    $('#login').removeClass('d-none');
    $('#login').children('#user-setting').addClass('d-none');
    $('#login').children('#add-user').removeClass('d-none');
    $('#login').children('#costum-login').addClass('d-none');
    // $('#app').addClass('d-none');
    return true;
}
function costumLogin(){
    $('#login').removeClass('d-none'); 
    $('#login').children('#user-setting').addClass('d-none');
    $('#login').children('#add-user').addClass('d-none');
    $('#login').children('#costum-login').removeClass('d-none');
    // $('#app').addClass('d-none');
    return true;
}
function showHome(){
    return true;
}
function changePageClick(page){
    changePage(page);
    clickAction('changePageClick',page);
    return true;
}
function showParentChild(el){
    $(el).parent().children().removeClass('d-none');
    return true;
}
// page
// category
// nav category
function changeCategory(id){
    showLoader();
    sendAjax({id:id},baseUrl('category/category/index'),'#content');
    clickAction('changeCategory',id);
}
function showCategory(id){
    if($('.category-id-'+id).length>0){
        $('.category-id-'+id).parents('.sub-slide').addClass('is-expanded');
    }
    if($('.p-category-id-'+id).length>0){
        $('.p-category-id-'+id).parents('.sub-slide').addClass('is-expanded');
        $('.p-category-id-'+id).trigger('click');
    }
    sendAjax({id:id},baseUrl('category/category/index'),'#content');
    return true;
}
function changeCategoryInMap(id){
    window.location.replace(baseUrl('map_category/'+id));
    return true;
}
// function changeCategory(id){
//     showCategory(id);
//     showCompanyInCategory(id);
//     showProductInCategory(id);
//     clickAction('changeCategory',id);
//     return true;
// }

// function showCategory(id){
//     mapMarkerChangeLocationImage('position',false,0,id,0,0);
//     mapMarkerChangeLocationImage('product',false,0,id,0,0);
//     if($('#company').hasClass('d-none')){
//         $('#company').removeClass('d-none');
//     }
//     if($('#nav').find('#category-nav-menu-option-'+id).length>0){
//         $('#nav').find('.category-nav-menu').removeClass('active');
//         $('#nav').find('#category-nav-menu-option-'+id).addClass('active');
//         $('#category-show').find('.children-category-nav-menu').addClass('d-none');
//         $('#category-show').find('.parent-id-'+id).removeClass('d-none');
//         showProductInCategory(id);
//         showCompanyInCategory(id);
//     }
//     return true;
// }
//nav category
// other category
function changeCategoryInnerCategory(el,id){
    $(el).parent().parent().children('li').children('a').removeClass('active');
    
    $(el).addClass('active');
    let pId=$(el).parents('.children-category-nav-menu').find('.category-parent-id').val(),a=$('#category').children('#category-show'),b=a.find('.parent-id-'+id);
    if(b.length>0){
        a.find('.children-category-nav-menu').addClass('d-none');
        b.children('.back-to-parent').removeClass('d-none');
        b.removeClass('d-none');
        b.children('.category-parent-parent-id').val(pId);
        showCompanyInCategory(id);
        showProductInCategory(id);
        clickAction('changeCategoryInnerCategory',pId+'|'+id);
    }
    return true;
}
function showCategoryInnerCategory(id,parentId){
    if(parentId!==''){
        showCategory(parentId);
        $('#category-show').find('.children-category-nav-menu').addClass('d-none');
        $('#category-show').find('.parent-id-'+id).children('.back-to-parent').removeClass('d-none');
        $('#category-show').find('.parent-id-'+id).removeClass('d-none');
        $('#category-show').find('.parent-id-'+id).children('.category-parent-parent-id').val(parentId);
        if($('#nav').find('#category-nav-menu-option-'+parentId).length>0){
            $('#nav').find('#category-nav-menu-option-'+parentId).addClass('active');
        }
        showCompanyInCategory(id);
        showProductInCategory(id);
        return true;
    }
}
function backToParentCategory(el){
    let parentId=$(el).parent().find('.category-parent-parent-id').val(),id=$(el).parent().find('.category-parent-id').val();
    if(parentId!==''){
        $('#category-show').find('.children-category-nav-menu').addClass('d-none');
        $('#category-show').find('.parent-id-'+parentId).removeClass('d-none');
        showCompanyInCategory(parentId);
        showProductInCategory(parentId);
        clickAction('changeCategory',parentId);
    }
    return true;
}
// other category
// category
// costum company
function showCompanyInCategory(id){
    $('#company').removeClass('d-none');
    $('#company').children('.all-company-in-category').addClass('d-none');
    if($('#company').children('.company-category-'+id).length>0){
        $('#company').children('.company-category-'+id).removeClass('d-none');
    }else{
       $('#company').addClass('d-none'); 
    }
    return true;
}
// costum company
// costum product
function showProductInCategory(id){
    $('#category-products').removeClass('d-none');
    $('#category-products').parent().children('h3').removeClass('d-none');
    $('#category-products').children('.all-product-category').addClass('d-none');
    if($('#category-products').find('#product-category-'+id).length>0){
        $('#category-products').find('#product-category-'+id).removeClass('d-none');
    }else{
        $('#category-products').addClass('d-none');
        $('#category-products').parent().children('h3').addClass('d-none');
    }
    return true;
}
function ProductWithTypeSetting(el,child){
    $(el).children().addClass('d-none');
    $(el).children(child).removeClass('d-none');
    return true;
}
function productBtnShower(el,child){
    $(el).find(child).addClass('d-none');
    $(el).find('.pro-btn').removeClass('d-none');
    return true;
}
function productBtnHider(child){
    $(child).removeClass('d-none');
    $('.pro-btn').addClass('d-none');
    return true;
}
// costom product
// company
function clickCompanyDescription(el,id){
    let pId=$(el).parents('.all-company-in-category').find('.company-parent-category').val(),
    ppId=$('#category').children('#category-show').find('.parent-id-'+pId).children('.category-parent-parent-id').val();
    if(typeof(ppId)=='undefined'){
        ppId=0;
    }
    showCompanyDescription(id,pId);
    clickAction('clickCompanyDescription',id+'|'+pId+'|'+ppId);
    return true;
}
function showCompanyDescriptionInCategoryInCategory(cId,pId,ppId){
    if(pId==0){
        showCategory(ppId);
        showCompanyDescription(cId,ppId);
    }else{
        showCategoryInnerCategory(pId,ppId);
        showCompanyDescription(cId,pId);
    }
    return true;
}
function showCompanyDescription(id,pId){
    let a = $('#company').find('.company-category-'+pId).find('#product-company-'+id).parent().children('.company-info');
    $('.company-description').addClass('d-none');
    a.children('.company-description').removeClass('d-none');
    $('.company-description-shower').removeClass('d-none');
    a.children('.company-description-shower').addClass('d-none');
    return true;
}
//company
//position
function showPositionCompanyHandler(cId,catId){
    if($('#company').find('.company-category-'+catId).find('.companyId'+cId).children('.all-position-in-category').hasClass('d-none')){
       $('#company').find('.company-category-'+catId).find('.companyId'+cId).children('.all-position-in-category').removeClass('d-none'); 
    }
    return true;
}
function PositionCompanyShower(cPId,catId,cId){
    if(cPId==0){
        showCategory(catId);
        showPositionCompanyHandler(cId,catId);
    }else{
        showCategoryInnerCategory(catId,cPId);
        showPositionCompanyHandler(cId,catId);
    }
    return true;
    mapMarkerChangeLocationImage('position',false,cId,catId,0,0);
    // return true;
}
function positionCompanySender(el,cId){
    let pId=$(el).parents('.all-company-in-category').find('.company-parent-category').val(),
    ppId=$('#category').children('#category-show').find('.parent-id-'+pId).children('.category-parent-parent-id').val();
    if(typeof(ppId)=='undefined'){
        ppId=0;
    }
    PositionCompanyShower(ppId,pId,cId);
    clickAction('clickPositionCompany',ppId+'|'+pId+'|'+cId+'|'+'position');
}
function clickPositionCompany(el,cId){
    // company id
    positionCompanySender(el,cId);
    return true;
}
// position
//product
// product company
function clickProductCompany(el,cId){
    backToShowCompanyProductWithTypeandClickProductCompanyFunction(el,cId);
    return true;
}
function showProductCompany(cId,pId,ppId){
    mapMarkerChangeLocationImage('product',false,cId,0,0,0);
    if(pId==0){
        showCategory(ppId);
        showProductCompanyHandler(cId,ppId);
    }else{
        showCategoryInnerCategory(pId,ppId);
        showProductCompanyHandler(cId,pId);
    }
    return true;
}
function showProductCompanyHandler(cId,pId){
    $('#company').find('.company-show').children('.company-info').removeClass('d-none');
    $('#company').find('.company-show').children('.all-product-in-category').addClass('d-none');
    let a=$('#company').find(".company-category-"+pId),b=a.find('#product-company-'+cId);
    a.removeClass('d-none');
    b.removeClass('d-none');
    b.parent().children('.company-info').addClass('d-none');
    return true;
}
function clickShowCompanyProductWithType(el,type,cId,proId){
    let pId=$(el).parents('.all-company-in-category').find('.company-parent-category').val(),
    ppId=$('#category').children('#category-show').find('.parent-id-'+pId).children('.category-parent-parent-id').val();
    if(typeof(ppId)=='undefined'){
        ppId=0;
    }
    showCompanyProductWithType(ppId,pId,cId,proId,type);
    clickAction('clickShowCompanyProductWithType',ppId+'|'+pId+'|'+cId+'|'+proId+'|'+type);
    return true;
}
function showCompanyProductWithType(ppId,pId,cId,proId,type){
    showProductCompany(cId,pId,ppId);
    ProductWithTypeSetting('#company-product-show-'+proId,'.'+type);
    return true;
}
function backToCompanyInfo(el){
    let id = $(el).parents('.all-company-in-category').children('.company-parent-category').val(),
    pId=$('#category').children('#category-show').find('.parent-id-'+id).children('.category-parent-parent-id').val();
    $(el).parent().addClass('d-none');
    $(el).parent().parent().children('.company-info').removeClass('d-none');
    if(typeof(pId)!=='undefined' && pId != 0){
        showCategoryInnerCategory(id,pId);
        clickAction('changeCategoryInnerCategory',pId+'|'+id);
    }else{
        showCategory(id);
        clickAction('changeCategory',id);
    }
    return true;
}
function backToShowCompanyProductWithType(el,cId){
    $(el).parent().addClass('d-none');
    $(el).parent().parent().children('.product-show').removeClass('d-none');
    backToShowCompanyProductWithTypeandClickProductCompanyFunction(el,cId);
    return true;
}
function backToShowCompanyProductWithTypeandClickProductCompanyFunction(el,cId){
    let pId=$(el).parents('.all-company-in-category').find('.company-parent-category').val(),
    ppId=$('#category').children('#category-show').find('.parent-id-'+pId).children('.category-parent-parent-id').val();
    if(typeof(ppId)=='undefined'){
        ppId=0;
    }
    showProductCompany(cId,pId,ppId);
    clickAction('clickProductCompany',cId+'|'+pId+'|'+ppId+'|'+'products');
    return true;
}
// product company
// other products
function hideOtherProductOptions(){
    $('.show-div-setting').children().addClass('d-none');
    hideChart();
    return true;
}
function clickShowOtherProductWithType(type,id){
    hideOtherProductOptions();
    $('#other-products').children('#product-other-id-451').children('.'+type).removeClass('d-none');
    return true;
}
function backToShowProduct(type,id){
    hideOtherProductOptions();
}
// other products
//product
//map
function mapMarkerChangeLocationImage(type,fly,cId,catId,poId,prId){
    $('#modalMap').addClass('d-block');
    $('.all-markers').html('');
    let a= geojson[type],
    bvalue='',
    num=0;
    $('#map-list-shower').children('.list-group').html('');
    for (const k in a) { 
        let b=a[k].mark,
        positionIdArray=[],
        productIdArray=[],
        companyTestIdArray=[],
        companyIconArray=[],
        companyTestInfoArray=[],
        productInfoArray=[],
        positionInfoArray=[],
        iconInfoArray=[];
        for (const v in b){
            let icon=b[v].icon.url,check=false,moreCheck=false;
            iconInfoArray.push(icon);
            if(typeof(icon)=='undefined' || icon==''){
                icon=baseUrl('assets/svg/product/map.svg');
            }
            if(typeof(fly)!=='undefined' && fly){
                // && !(companyTestIdArray.includes(cId))
                // && !(positionIdArray.includes(poId))
                // && !(productIdArray.includes(prId))
                if( (catId != 0 && b[v].categoryId==catId ) || 
                (cId != 0 && b[v].companyId==cId
                ) || 
                (poId != 0 && b[v].positionId==poId 
                ) || 
                (prId != 0 && b[v].productId==prId
                )){
                    // && !(companyTestIdArray.includes(cId))
                    if(cId != 0 && b[v].companyId==cId){
                        companyTestIdArray.push(cId);
                        companyTestInfoArray.push(b[v]);
                        // && !(positionIdArray.includes(poId))
                        if(poId != 0 && b[v].positionId==poId
                        ){
                            positionIdArray.push(poId);
                            positionInfoArray.push(b[v]);
                            // && !(productIdArray.includes(prId))
                            if(prId != 0 && b[v].productId==prId
                            ){
                                moreCheck=true;
                                check=true;
                                productIdArray.push(prId);
                                productInfoArray.push(b[v]);
                                bvalue='<div onclick="map.flyTo({center:['+b[v].coordinates+'], zoom: 16});" class="list-group-item p-1">';
                                bvalue=bvalue+'<div class="row p-0"><div class="col-4 p-0">';
                                bvalue=bvalue+'<img class="ht-50 rounded-20 marker-list-image-style" src="';
                                bvalue=bvalue+icon+'"></div><div class="col-5 p-0 text-right"><p class="mark-description-style">';
                                bvalue=bvalue+b[v].message+'</p></div><div class="col-2 pt-2"><span class="marker-list-option-style">';
                                bvalue=bvalue+b[v].option+'</span></div></div></div>';
                                $('#map-list-shower').children('.list-group').append(bvalue);
                            }
                            if(!moreCheck){
                                moreCheck=true;
                                bvalue='<div onclick="map.flyTo({center:['+b[v].coordinates+'], zoom: 16});" class="list-group-item p-1">';
                                bvalue=bvalue+'<div class="row p-0"><div class="col-4 p-0">';
                                bvalue=bvalue+'<img class="ht-50 rounded-20 marker-list-image-style" src="';
                                bvalue=bvalue+icon+'"></div><div class="col-5 p-0 text-right"><p class="mark-description-style">';
                                bvalue=bvalue+b[v].message+'</p></div><div class="col-2 pt-2"><span class="marker-list-option-style">';
                                bvalue=bvalue+b[v].option+'</span></div></div></div>';
                                $('#map-list-shower').children('.list-group').append(bvalue);
                            }
                        }else{
                            // && !(productIdArray.includes(prId))
                            if(prId != 0 && b[v].productId==prId 
                            ){
                                moreCheck=true;
                                check=true;
                                productIdArray.push(prId);
                                productInfoArray.push(b[v]);
                                bvalue='<div onclick="map.flyTo({center:['+b[v].coordinates+'], zoom: 16});" class="list-group-item p-1">';
                                bvalue=bvalue+'<div class="row p-0"><div class="col-4 p-0">';
                                bvalue=bvalue+'<img class="ht-50 rounded-20 marker-list-image-style" src="';
                                bvalue=bvalue+icon+'"></div><div class="col-5 p-0 text-right"><p class="mark-description-style">';
                                bvalue=bvalue+b[v].message+'</p></div><div class="col-2 pt-2"><span class="marker-list-option-style">';
                                bvalue=bvalue+b[v].option+'</span></div></div></div>';
                                $('#map-list-shower').children('.list-group').append(bvalue);
                            }else{
                                if(!moreCheck){
                                    moreCheck=true;
                                    bvalue='<div onclick="map.flyTo({center:['+b[v].coordinates+'], zoom: 16});" class="list-group-item p-1">';
                                    bvalue=bvalue+'<div class="row p-0"><div class="col-4 p-0">';
                                    bvalue=bvalue+'<img class="ht-50 rounded-20 marker-list-image-style" src="';
                                    bvalue=bvalue+icon+'"></div><div class="col-5 p-0 text-right"><p class="mark-description-style">';
                                    bvalue=bvalue+b[v].message+'</p></div><div class="col-2 pt-2"><span class="marker-list-option-style">';
                                    bvalue=bvalue+b[v].option+'</span></div></div></div>';
                                    $('#map-list-shower').children('.list-group').append(bvalue);
                                }
                            }
                        }
                    }
                    if(prId != 0 && b[v].productId==prId && (!moreCheck||!check)){
                        moreCheck=true;
                        productIdArray.push(prId);
                        productInfoArray.push(b[v]);
                        bvalue='<div onclick="map.flyTo({center:['+b[v].coordinates+'], zoom: 16});" class="list-group-item p-1">';
                        bvalue=bvalue+'<div class="row p-0"><div class="col-4 p-0">';
                        bvalue=bvalue+'<img class="ht-50 rounded-20 marker-list-image-style" src="';
                        bvalue=bvalue+icon+'"></div><div class="col-5 px-1 text-right"><p class="mark-description-style">';
                        bvalue=bvalue+b[v].message+'</p></div><div class="col-2 pt-2"><span class="marker-list-option-style">';
                        bvalue=bvalue+b[v].option+'</span></div></div></div>';
                        $('#map-list-shower').children('.list-group').append(bvalue);
                    }
                    if(poId != 0 && b[v].positionId==poId && (!moreCheck||!check)){
                        positionIdArray.push(poId);
                        positionInfoArray.push(b[v]);
                        moreCheck=true;
                        bvalue='<div onclick="map.flyTo({center:['+b[v].coordinates+'], zoom: 16});" class="list-group-item p-1">';
                        bvalue=bvalue+'<div class="row p-0"><div class="col-4 p-0">';
                        bvalue=bvalue+'<img class="ht-50 rounded-20 marker-list-image-style" src="';
                        bvalue=bvalue+icon+'"></div><div class="col-5 px-1 text-right"><p class="mark-description-style">';
                        bvalue=bvalue+b[v].message+'</p></div><div class="col-2 pt-2"><span class="marker-list-option-style">';
                        bvalue=bvalue+b[v].option+'</span></div></div></div>';
                        $('#map-list-shower').children('.list-group').append(bvalue);
                    }
                }
                if(num===0){
                    map.flyTo({center:b[v].coordinates, zoom: 18});
                    num++;
                }
                $('.'+type+'-marker-count-'+b[v].count).html('<img width="20px" height="20px" src="'+icon+'">');
            }
        }
    }
    return true;
}
function hideMapModal(){
    $('#modalMap').removeClass('d-block');
    checkBackUrlFunction();
}
//scrolls
let myInterval;
function scrollOff(){
    clearInterval(myInterval);
    return true;
}
function scrollMoveLeft(el,div){
    let $this,all,y;
    $this=$(el).parent().children(div);
    all=$this.get(0).scrollWidth;
    y=$this.scrollLeft();
    scrollOffTwo();
    scrollOffType();
    scrollOffTwoType();
    scrollOffComapany();
    scrollOffTwoComapany();
    myInterval = setInterval(function () {
        if(y < 0){
           y = all; 
        }
        $this.scrollLeft(--y);
    },0.3);
    return true;
}
let myIntervalTwo;
function scrollOffTwo(){
    clearInterval(myIntervalTwo);
    return true;
}
function scrollMoveRight(el,div){
    let $this,all,y;
    $this=$(el).parent().children(div);
    all=$this.get(0).scrollWidth;
    y=$this.scrollLeft();
    scrollOff();
    scrollOffType();
    scrollOffTwoType();
    scrollOffComapany();
    scrollOffTwoComapany();
    myIntervalTwo = setInterval(function () {
        if(y > all){
            y = 0;
        }
        $this.scrollLeft(++y);
    },0.3);
    return true;
}
let myIntervalType;
function scrollOffType(){
    clearInterval(myIntervalType);
    return true;
}
function scrollMoveLeftType(el,div){
    let $this,all,y;
    $this=$(el).parent().children(div);
    all=$this.get(0).scrollWidth;
    y=$this.scrollLeft();
    scrollOff();
    scrollOffTwo();
    scrollOffTwoType();
    scrollOffComapany();
    scrollOffTwoComapany();
    myIntervalType = setInterval(function () {
        if(y === 0){
           y = all-40; 
        }
        $this.scrollLeft(--y);
    },0.3);
    return true;
}
let myIntervalTwoType;
function scrollOffTwoType(){
    clearInterval(myIntervalTwoType);
    return true;
}
function scrollMoveRightType(el,div){
    let $this,all,y;
    $this=$(el).parent().children(div);
    all=$this.get(0).scrollWidth;
    y=$this.scrollLeft();
    scrollOff();
    scrollOffTwo();
    scrollOffType();
    scrollOffComapany();
    scrollOffTwoComapany();
    myIntervalTwoType = setInterval(function () {
        if(y > all){
            y = 0;
        }
        $this.scrollLeft(++y);
    },0.3);
    return true;
}
let myIntervalTypeCompany;
function scrollOffComapany(){
    clearInterval(myIntervalTypeCompany);
    return true;
}
function scrollMoveLeftComapany(el,div){
    let $this,all,y;
    $this=$(el).parent().children(div);
    all=$this.get(0).scrollWidth;
    y=$this.scrollLeft();
    scrollOff();
    scrollOffTwo();
    scrollOffType();
    scrollOffTwoType();
    scrollOffTwoComapany();
    myIntervalTypeCompany = setInterval(function () {
        if(y === 0){
           y = all-40; 
        }
        $this.scrollLeft(--y);
    },0.3);
    return true;
}
let myIntervalTwoTypeCompany;
function scrollOffTwoComapany(){
    clearInterval(myIntervalTwoTypeCompany);
    return true;
}
function scrollMoveRightComapany(el,div){
    let $this,all,y;
    $this=$(el).parent().children(div);
    all=$this.get(0).scrollWidth;
    y=$this.scrollLeft();
    scrollOff();
    scrollOffTwo();
    scrollOffType();
    scrollOffTwoType();
    scrollOffComapany();
    myIntervalTwoTypeCompany = setInterval(function () {
        if(y > all){
            y = 0;
        }
        $this.scrollLeft(++y);
    },0.3);
    return true;
}
//scrolls
// chart
function changeChart(chartInfo){
    if(chart) chart.destroy();
    var chart = Highcharts.chart('chartContainer',chartInfo);
    return true;
}
function showChart(el){
    hideOtherProductOptions();
    $('.chart').removeClass('d-none');
    let id=$(el).parent().parent().children('.product-id').val();
    $.each(chartMain, function(k, v) {
        if(v.id==id){
            changeChart(v.info);
        }
    });
    return true;
}
function showChartProductId(id){
    hideOtherProductOptions();
    $('.chart').addClass('d-block');
    $.each(chartMain, function(k, v) {
        if(v.id==id){
            changeChart(v.info);
        }
    });
    return true;
}
function hideChart(){
    $('.chart').removeClass('d-block');
    checkBackUrlFunction();
    return true;
}
// chart