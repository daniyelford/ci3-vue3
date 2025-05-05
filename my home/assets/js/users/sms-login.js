let oldNumberSendSms='',intervalEvent;
function showClock(target) {
    let distance = target - new Date().getTime(),
    mins = distance < 0 ? 0: Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
    secs = distance < 0 ? 0: Math.floor((distance % (1000 * 60)) / 1000);        
    $('#minutes').html(mins);
    $('#seconds').html(secs);
    return true;
}
function timerRiverce(el){
    $(el).addClass('disabled');
    $(el).children().removeClass('d-none');
    var countDownTarget = new Date().getTime() + 5 * 60 * 1000;
    intervalEvent = setInterval(function() {
        showClock(countDownTarget);
        if (countDownTarget - new Date().getTime() < 0) {
            clearInterval(intervalEvent);
            el.classList.remove("disabled");
            el.children[0].classList.add("d-none");
        }
    }, 1000);
}
function sendSmsLogin(el,e){
    e.preventDefault();
    let phone=$(el).parent().parent().find('.phone').val(),siteKey=$('#site-key').val();
    if(phone!=='' && phone.length===11){
        if(oldNumberSendSms!==phone){
            grecaptcha.ready(function() {
                grecaptcha.execute(siteKey, {action: 'auth'}).then(function(token) {
            		$('#phone-auth').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
            		$.post(baseUrl('users/users/send_sms_login'),{phone:phone, token: token}, function(result) {
                		if(result==1){
                            clearInterval(intervalEvent);
                		    $(el).parent().parent().find('.phone-inner').addClass('d-none');
                            $(el).parent().parent().find('.code').removeClass('d-none');
                            $(el).parent().children().removeClass('d-none');
                            $(el).addClass('d-none');
                            timerRiverce($(el).parent().find('.retry-code').get(0));
            			}else{
            			    if(result==2){
            			        return not38();
            			    }else{
            			        if(result==40){
                			        return not40();
                			    }else{
                    			    return not2();
                			    }
            			    }
                		}
            		});
            	});
            });
        }else{
            $(el).parent().parent().find('.phone-inner').addClass('d-none');
            $(el).parent().parent().find('.code').removeClass('d-none');
            $(el).parent().children().removeClass('d-none');
            $(el).addClass('d-none');
        }
        return true;
    }else{
        return not1();
    }
}
function sendSmsLoginAgain(el,e){
    e.preventDefault();
    timerRiverce(el);
    sendAjax({phone:$(el).parent().parent().find('.phone').val()},baseUrl('users/users/send_sms_login_again'),'');
    return true;
}
function changePhoneNumber(el,e){
    e.preventDefault();
    oldNumberSendSms=$(el).parent().parent().find('.phone').val();
    $(el).parent().parent().find('.phone-inner').removeClass('d-none');
    $(el).parent().parent().find('.code').addClass('d-none');
    $(el).parent().children().addClass('d-none');
    $(el).parent().children().first().removeClass('d-none');
    return true;
}
function smsLogin(el,e){
    e.preventDefault();
    let code=$(el).parent().parent().find('#sms-code').val();
    if(code!=='' ){
        sendAjax({code:code},baseUrl('users/users/sms_login'),'');
        return true;
    }else{
        return not1();
    }
}