function btnUploadClick(el,event){
    $(el).parent().parent().children('.fileupload').click();
    event.preventDefault();
    return true;
}
function changeFileUplod(el,event){
    $(el).parent().parent().find('form').submit();
    event.preventDefault();
    return true;
}
function uploadSubmit(el,fId,event){
    event.preventDefault();
    if ($(el).find('.fileupload').val() != '') {
        $(el).addClass('d-none');
        let p=$(el).parent().find('.type').val(),t=$(el).parent().find('.url').val(),formData = new FormData(el);
        $.ajax({
            type:'POST',
            url: '/includes/upload_media/handler/'+t+'/'+p,
            data:formData,
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',function (e){
                        if(e.lengthComputable){
                            var max = e.total,current = e.loaded,Percentage = (current * 100)/max;
                            if(Percentage <= 100){
                                Percentage=Math.ceil(Percentage)+'%';
                                $('#progress-'+fId).find(".file-progress-bar").text(Percentage);
                                $('#progress-'+fId).width(Percentage);
                            }
                        } 
                    }, false);
                }
                return myXhr;
            },
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                let d = JSON.parse(data);
                if(d.success){
                    let r,u=window.location.origin+'/'+d.url.split('---').join('/');
                    if(d.type=='video'){
                        r='<a style="position: relative;top: 32px;text-align: center;color: red;padding: 10px;background: #ffffffb3;border-radius: 10px;" onclick="removeMedia(this);">پاک کردن</a><video style="width: 100%;height: auto;border-radius: 10px;" controls><source src="'+ u +'" type="'+d.t+'"></video>';
                    }else{
                        r='<a style="position: relative;top: 32px;text-align: center;color: red;padding: 10px;background: #ffffffb3;border-radius: 10px;" onclick="removeMedia(this);">پاک کردن</a><img style="width: 100%;height: auto;border-radius: 10px;" src="'+u+'">';
                    }
                    $('#'+fId).addClass('d-none');
                    $('#'+fId).parent().find('.mediaType').val(d.type);
                    $('#'+fId).parent().find(".file-name").val(d.name);
                    $('#progress-'+fId).addClass('d-none');
                    $('#media-'+fId).html(r);
                    $('#media-'+fId).removeClass('d-none');
                    return not10();
                }else{
                    $('#'+fId).removeClass('d-none');
                    // $('#progress-'+fId).addClass('d-none');
                    $('#progress-'+fId).find(".file-progress-bar").removeClass('bg-success');
                    $('#progress-'+fId).find(".file-progress-bar").addClass('bg-danger');
                    return not9(d.error);
                }
            },error: function(data){
                $('#'+fId).removeClass('d-none');
                // $('#progress-'+fId).addClass('d-none');
                $('#progress-'+fId).find(".file-progress-bar").removeClass('bg-success');
                $('#progress-'+fId).find(".file-progress-bar").addClass('bg-danger');
                return not13();
            }
        });
    }
}
function removeMedia(el){
    $(el).parent().addClass('d-none');
    sendAjax({
        url:$(el).parent().parent().find('.url').val(),
        file:$(el).parent().parent().find('.file-name').val(),
        type:$(el).parent().parent().find('.type').val()
    },baseUrl('includes/upload_media/remove_media'),'');
    $(el).parent().parent().find('.file-name').val('');
    $(el).parent().parent().find('.imageuploadform').removeClass('d-none');
    $(el).parent().html('');
    return true;
}