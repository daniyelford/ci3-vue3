let intervalEventRegister,oldNumberSendSmsRegister='';
function showClockRegister(target) {
    let distance = target - new Date().getTime(),
    mins = distance < 0 ? 0: Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
    secs = distance < 0 ? 0: Math.floor((distance % (1000 * 60)) / 1000);        
    $('#minutes-register-code').html(mins);
    $('#seconds-register-code').html(secs);
    return true;
}
function timerRiverceRegister(el){
    $(el).addClass('disabled');
    $(el).children().removeClass('d-none');
    var countDownTarget = new Date().getTime() + 5 * 60 * 1000;
    intervalEventRegister = setInterval(function() {
        showClockRegister(countDownTarget);
        if (countDownTarget - new Date().getTime() < 0) {
            clearInterval(intervalEventRegister);
            el.classList.remove("disabled");
            el.children[0].classList.add("d-none");
        }
    }, 1000);
}
function register() {
    let siteKey=$('#site-key').val(),name=$('#name').val(),family=$('#family').val(),phone=$('#phone').val();
    if(name!==''&&family!==''&&phone!==''){
        if(oldNumberSendSmsRegister!==phone){
            grecaptcha.ready(function() {
                grecaptcha.execute(siteKey, {action: 'register'}).then(function(token) {
            		$('#register').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
            		$.post(baseUrl('users/users/check_add_user'),{phone:phone,token:token}, function(result) {
            			if(result==1){
            			    clearInterval(intervalEventRegister);
            			    $('#register-info').addClass('d-none');
                            $('#register-auth').removeClass('d-none');
                            $('#register-perv-btn').removeClass('d-none');
                            $('#register-next-btn').addClass('d-none');
                            $('#register-end-btn').removeClass('d-none');
            			    timerRiverceRegister($('#minutes-register-code').parent().parent().get(0));
                            return true;
            			}else{
            			    if(result==0){
                			    return not2();
            			    }else{
            			        if(result==2){
            			            return not3();
            			        }else{
            			            if(result==3){
            			                return not38();
            			            }else{
                			            console.log(result);
                			            return not8();
            			            }
            			        }
            			    }
            			}
            		});
            	});
            });
        }else{
            $('#register-info').addClass('d-none');
            $('#register-auth').removeClass('d-none');
            $('#register-perv-btn').removeClass('d-none');
            $('#register-next-btn').addClass('d-none');
            $('#register-end-btn').removeClass('d-none');
            return true;
        }
    }else{
        return not1();
    }
    return true;
}
function resendPhoneCode(el){
    $(el).addClass('disabled');
    timerRiverceRegister(el);
    sendAjax({phone:$('#phone').val()},'users/users/change_phone_code','');
}
function authRegister() {
    $('#register-end-btn').find('a').addClass('d-none');
    let siteKey=$('#site-key').val(),
    code=$('#phone-code').val(),
    phone=$('#phone').val(),
    day=$('#day').val(),month=$('#month').val(),year=$('#year').val(),
    name=$('#name').val(),family=$('#family').val();
    if(name!==''&&family!==''&&code!==''&&phone!==''){
        grecaptcha.ready(function() {
            grecaptcha.execute(siteKey, {action: 'registerAuthInfo'}).then(function(token) {
        		$('#registerAuthInfo').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
        		$.post(baseUrl('users/users/check_add_user_auth'),{name:name,family:family,phone:phone,code:code,day:day,month:month,year:year,token:token}, function(result) {
        			if(result==2){
        			    $('#register-end-btn').find('a').removeClass('d-none');
        			    return not3();
        			}else{
        			    if(result==1){
        			        window.location.replace(baseUrl(''));
                		    return not5();
        			    }else{
        			        $('#register-end-btn').find('a').removeClass('d-none');
        			        return not2();
        			    }
        			}
        		});
        	});
        });
    }else{
        return not1();
    }
}
function registerPerv(){
    oldNumberSendSmsRegister=$('#phone').val();
    $('#register-info').removeClass('d-none');
    $('#register-auth').addClass('d-none');
    $('#register-perv-btn').addClass('d-none');
    $('#register-next-btn').removeClass('d-none');
    $('#register-end-btn').addClass('d-none');
    return true;
}