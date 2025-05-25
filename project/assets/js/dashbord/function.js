function productManagerSetting(el,type,pId){
    switch(type){
        case 'key_value':
            break;
        case 'image':
            
            break;
        case 'video':
            
            break;
        case 'map':
            
            break;
        case 'tel':
            
            break;
        default:
            break;
    }
    return true;
}
function showParentChild(el){
    $(el).addClass('d-none');
    $(el).parent().find('.child').removeClass('d-none');
    return true;
}
function hideChild(el){
    let a= $(el).parents('.child');
    a.addClass('d-none');
    a.parent().children('.event-parent-child').removeClass('d-none');
    return true;
}
function hideParent(el){
    $(el).parent().addClass('d-none');
    return true;
}
function changeSend(url,data){
    let siteKey=$('#site-key').val();
    grecaptcha.ready(function() {
        grecaptcha.execute(siteKey, {action: 'send'}).then(function(token) {
    		$('#send').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
    		$.post(url,{data:data, token: token}, function(result) {
    			if(result !== 0){
    			    swal('عملیات موفق','تفییرات ثبت شد','success',{button:false}).then(function(){
        			    return true;
    			    });
    			}else{
                    swal('اتصال ناموفق','اینترنت خود را بررسی کنید','error',{button:false}).then(function(){window.location.reload()});
    			    return false;
    			}
    		});
    	});
    });
    return true;
}
// category
function changeParentIdVal(el,id){
    $('#edit-category-manager').find().val(id);
    $(el).parents('.parentsInner').find('.active').removeClass('active');
    $(el).addClass('active');
    return true;
}
function addCategoryIn(pId){
    $('#add-category-manager').removeClass('d-none');
    $('#parent-category-id').val(pId);
    return true;
}
function showInnerCategory(el,id,pId){
    if($('#manager-category-parent-id-'+id).length>0){
        $('#manager-category-parent-id-'+pId).addClass('d-none');
        $('#manager-category-parent-id-'+id).removeClass('d-none');
    }else{
        $(el).addClass('d-none');
    }
    return true;
}
function showParentCategory(id){
    $('#manager-category-parent-id-'+id).addClass('d-none');
    $('tr.tr-category-id-'+id).parent().parent().removeClass('d-none');
    return true;
}
function editCategory(el,id,pId){
    let a=$(el).parent().parent().children('td').first().children('img').attr('src'),b=$(el).parent().parent().children('td').eq(1).text(),c=$.trim(b),d,e='';
    $('#edit-category-manager').find('#category-title-edit').val(c);
    $('#edit-category-manager').removeClass('d-none');
    $('#edit-category-manager').find('.id').val(id);
    $('#edit-category-manager').find('.parentId').val(pId);
    $('#edit-category-manager').find('.parentsInner').find('.active').removeClass('active');
    $('#edit-category-manager').find('.parentsInner').find('.p-id-'+pId).addClass('active');
    $('#edit-category-manager').find('.parentsInner').find('.d-none').removeClass('d-none');
    $('#edit-category-manager').find('.parentsInner').find('.p-id-'+id).parent().addClass('d-none');
    if(typeof(a)!=='undefined'){
        d = a.split('/');
        e=d[d.length-1];
        $('#edit-category-manager').find('.file-name').val(e);
        $('#edit-category-manager').find('.imageuploadform').addClass('d-none');
        $('#edit-category-manager').find('.media').html('<img src="'+a+'"><a onclick="removeMedia(this);">remove pic</a>');
        $('#edit-category-manager').find('.media').removeClass('d-none');
    }else{
        $('#edit-category-manager').find('.file-name').val('');
        $('#edit-category-manager').find('.imageuploadform').removeClass('d-none');
        $('#edit-category-manager').find('.media').addClass('d-none');
        $('#edit-category-manager').find('.media').html('');
    }
    return true;
}
// category
// company
function editCompany(event,el,id){
    event.preventDefault();
    let c,e,edit=$(el).parents('table').parent().find('#edit-company-manager'),
    b=$(el).parent().parent().children('td'),
    img=b.eq(0).children('img').attr('src'),
    title=b.eq(1).text(),
    url=b.eq(2).text(),
    description=b.eq(3).text(),
    type=$(el).parent().find('.company-type-number').val();
    edit.removeClass('d-none');
    edit.find('.companyId').val(id);
    edit.find('#company-title').val($.trim(title));
    edit.find('#company-description').val($.trim(description));
    edit.find('#company-url').val($.trim(url));
    if(typeof(img)!=='undefined' && $.trim(img)!==''){
        c=$.trim(img).split('/');
        d=edit.find('.url').val();
        d=d.replaceAll('---','/');
        e=window.location.origin+"/"+d+"/"+c[c.length-1];
        edit.find('.file-name').val(c[c.length-1]);
        edit.find('.media').html('<img width="100%" height="100%" src="'+e+'"><a onclick="removeMedia(this);">حذف عکس</a>');
        edit.find('.media').removeClass('d-none');
        edit.find('.imageuploadform').addClass('d-none');
    }
    if(typeof(type)=='undefined'||type==0||type==''){
        edit.find('#team').prop("checked", false);
        edit.find('#one').prop("checked", true); 
    }else{
        if(type==1){
            edit.find('#team').prop("checked", true);
            edit.find('#one').prop("checked", false); 
        }else{
            return false;
        }
    }
    return true;
}
// company
//product
function editProduct(el,id){
    $('#edit-product').removeClass('d-none');
    $('#edit-product').find('.productId').val(id);
    return true;
}
function addProductToCategory(id){
    $('#add-product').removeClass('d-none');
    $('#add-product').find('.categoryId').val(id);
    return true;
}
//product
// upload
//upload
//btn handler
// setting
function btnTypeAction(method,type,el,event,id=0){
    event.preventDefault();
    switch(method){
        case 'add':
            addActions(type,el);
            break;
        case 'edit':
            editAction(type,el);
            break;
        case 'delete':
            deleteAction(type,el,id);
            break;
        case 'disable':
            disableAction(type,el,id);
            break;
        case 'enable':
            enableAction(type,el,id);
            break;
            
        default:
            break;
    }
    return true;
}
function addActions(type,el){
    switch(type){
        case 'category':
            addCategoryAction(el);
            break;
        case 'company':
            addCompanyAction(el);
            break;
        case 'product':
            // addProductAction(el);
            break;
        default:
            break;
    }
    return true
}
function editAction(type,el){
    switch(type){
        case 'category':
            editCategoryAction(el);
            break;
        case 'company':
            editCompanyAction(el);
            break;
        case 'product':
            editProductAction(el);
            break;
        default:
            break;
    }
    return true;
}
function deleteAction(type,el,id){
    switch(type){
        case 'category':
            deleteCategoryAction(el,id);
            break;
        case 'company':
            deleteCompanyAction(el,id);
            break;
        case 'product':
            
            break;
        case 'product_chat':
            
            break;
        default:
            break;
    }
    return true
}
function disableAction(type,el,id){
    switch(type){
        case 'category':
            diableCategoryAction(el,id);
            break;
        case 'company':
            diableCompanyAction(el,id);
            break;
        default:
            break;
    }
    return true
}
function enableAction(type,el,id){
    switch(type){
        case 'category':
            enableCategoryAction(el,id);
            break;
        case 'company':
            enableCompanyAction(el,id);
            break;
        default:
            break;
    }
    return true;
}

// setting
//action
// category
function addCategoryAction(el){
    let file=$(el).parent().find('.file-name').val(),
    title=$(el).parent().find('#category-title').val(),
    des=$(el).parent().find('#category-description').val(),
    parentId=$(el).parent().find('#parent-category-id').val(),
    mode=$('#all-category-manager').find('.mode').val();
    if(title !== '' && parentId !== '' && mode !== '')
        sendAjax({f:file,t:title,p:parentId,m:mode,d:des},window.location.origin+'/category/category/add_category','#company-category');
    else
        swal('مقادیر نامناسب','مقادیر را پر کنید','error',{button:false});
    return true;
}
function editCategoryAction(el){
    let id=$(el).parent().find('.id').val(),
    file=$(el).parent().find('.file-name').val(),
    title=$(el).parent().find('#category-title-edit').val(),
    des=$(el).parent().find('#category-description-edit').val(),
    mode=$('#all-category-manager').find('.mode').val(),
    parentId=$('#all-category-manager').find('.parentId').val();
    if(id!=='' && title!=='' && mode!=='')
        sendAjax({i:id,f:file,t:title,m:mode,d:des,pi:parentId},window.location.origin+'/category/category/edit_category','#company-category');
    else
        swal('مقادیر نامناسب','مقادیر را پر کنید','error',{button:false});
    return true;
}
function enableCategoryAction(el,id){
    $(el).addClass('d-none');
    $(el).parent().find('.disable').removeClass('d-none');
    changeSend(window.location.origin+'/category/category/enable_category',{id:id});
    return true;
}
function diableCategoryAction(el,id){
    $(el).addClass('d-none');
    $(el).parent().find('.enable').removeClass('d-none');
    changeSend(window.location.origin+'/category/category/disable_category',{id:id});
    return true;
}
function deleteCategoryAction(el,id){
    swal(
        "پیام",
        "آیا از این کار اطمینان دارید؟",
        "warning",
        {
            buttons: {
                cancel: "خیر",
                catch: {
                    text: "بله",
                    value: "catch",
                }
            }
    }).then((value) => {
        if (value=='catch') {
            sendAjax({id:id,m:$('#all-category-manager').find('.mode').val()},window.location.origin+'/category/category/remove_category','#company-category');
            return true;
        } else {
            return false;
        }
    });
    return true;
}
// category
// company

function editCompanyAction(el){
    let n=$(el).parent().find('#company-title').val(),
    d=$(el).parent().find('#company-description').val(),
    u=$(el).parent().find('#company-url').val(),
    f=$(el).parent().find('.file-name').val(),
    url=$(el).parent().find('.url').val(),
    t=$(el).parent().children('input[name=type]:checked').val(),
    cId=$(el).parent().find('.companyId').val(),
    mode=$('#all-category-manager').find('.mode').val(),
    a=$('#company-manager').find('table').children('tbody').find('.trId-'+cId).children('td'),img=window.location.origin+'/';
    img+=url.replaceAll('---','/');
    if(typeof(t)=="undefined"){
        t=0;
    }
    if(n!==''&&t!==''&&d!==''&&cId!==''&&mode!==''){
        if(a.eq(0).children('img').length>0){
            if(typeof(f)!=='undefined'&&f!==''){
                a.eq(0).children('img').attr('src',img+'/'+f);
            }else{
                a.eq(0).children('img').remove();
            }    
        }else{
            if(typeof(f)!=='undefined'&&f!==''){
                a.eq(0).children('img').html('<img src="'+img+'/'+f+'">');
            } 
        }
        a.eq(1).text(n);
        a.eq(2).text(u);
        a.eq(3).text(d);
        a.eq(4).find('.company-type-number').val($.trim(t));
        changeSend(window.location.origin+'/company/dashbord/edit',{mode:mode,file:f,title:n,url:u,type:t,des:d,companyId:cId});
        $(el).parent().addClass('d-none');
        return true;
    }else{
        return false;
    }
}
function deleteCompanyAction(el,id){
    swal(
        "پیام",
        "آیا از این کار اطمینان دارید؟",
        "warning",
        {
            buttons: {
                cancel: "خیر",
                catch: {
                    text: "بله",
                    value: "catch",
                }
            }
    }).then((value) => {
        if (value=='catch') {
            changeSend(window.location.origin+'/company/dashbord/remove',{id:id});
            $(el).parent().parent().remove();
            return true;
        } else {
            return false;
        }
    });
    return true;
}
function diableCompanyAction(el,id){
    $(el).addClass('d-none');
    $(el).parent().find('.enable').removeClass('d-none');
    changeSend(window.location.origin+'/company/dashbord/disable',{id:id});
    return true;
}
function enableCompanyAction(el,id){
    $(el).addClass('d-none');
    $(el).parent().find('.disable').removeClass('d-none');
    changeSend(window.location.origin+'/company/dashbord/enable',{id:id});
    if($('#company-manager-selector').find('.li-'+id).length>0){
        $('#company-manager-selector').find('.li-'+id).remove();
    }
    return true;
}
// company
// product
// function addProductAction(el){
    
// }
// function editProductAction(el){
    
// }
// product
// action
//btn handler
function clickShowOtherProductWithType(type,id){
    
}
function backToShowProduct(type,id){
    
}
