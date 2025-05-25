// function authAction (event) {
// 	event.preventDefault();
//     let siteKey=$('#site-key').val(),username=$('#username').val(),password=$('#password').val();
//     if(username!==''&&password!==''){
//         if(username.length<8){
//             return not31();
//         }
//         if(password.length<8){
//             return not32();
//         }
//         grecaptcha.ready(function() {
//             grecaptcha.execute(siteKey, {action: 'auth'}).then(function(token) {
//         		$('#auth').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
//         		$.post(baseUrl('users/users/check_auth_costom'),{username:username,password:password, token: token}, function(result) {
//             		if(result==1){
//             		    window.location.replace(baseUrl(''));
//             		    return not5();
//         			}else{
//         			    return not2();
//             		}
//         		});
//         	});
//         });
//     }else{
//         return not1();
//     }
//     return true;
// }