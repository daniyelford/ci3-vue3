function not1() {
	notif({
		type: "error",
		msg: "مقادیر را پر کنید",
		position: "bottom",
		bottom: '10',
		width: 150,
	});
}
function notLogin() {
	notif({
		type: "error",
		msg: "ابتدا وارد حساب کاربری خود شوید",
		position: "bottom",
		bottom: '10',
		width: 250,
	});
}
function not2() {
	notif({
		type: "error",
		msg: "اطلاعات اشتباه است",
		position: "bottom",
		bottom: '10',
		width: 150,
	});
}
function not3() {
	notif({
		type: "error",
		msg: "اطلاعات قبلآ استفاده شده",
		position: "bottom",
		bottom: '10',
		width: 200,
	});
}
function not4() {
	notif({
		msg: 'ثبت نام شما با موفقیت انجام شد',
		type: "success",
		position: "bottom",
		fade:true,
		bottom: '10',
		width: 250,
	});
}
function not5() {
	notif({
		msg: 'ورود شما با موفقیت انجام شد',
		type: "success",
		position: "bottom",
		fade:true,
		bottom: '10',
		width: 250,
	});
}
function not6() { 
	notif({
		type: "error",
		msg: "اطلاعات شما یافت نشد",
		position: "bottom",
		bottom: '10',
		width: 250,
	});
}
function not7() {
	notif({
		msg: 'ثبت نام شما با موفقیت انجام شد',
		type: "success",
		fade:true,
		position: "bottom",
		bottom: '10',
		width: 270,
	});
}
function not8() {
	notif({
		msg: 'ارتباط با سرور قطع است',
		type: "error",
		position: "bottom",
		bottom: '10',
		width: 250,
	});
}
function not9(x) {
	notif({
		msg: 'خطای '+x,
		type: "error",
		position: "bottom",
		bottom: '10',
		width: 250,
	});
}
function not10() {
	notif({
		type: "success",
		msg: 'عملیات موفق بود',
		position: "bottom",
		bottom: '10',
		width: 200,
		fade:true
	});
}
function not11() {
	notif({
		type: "error",
		msg: "مقادیر نامناسب",
		position: "bottom",
		bottom: '10',
		width: 150,
	});
}
function not12() {
	notif({
		type: "error",
		msg: "اختلال در سرور",
		position: "bottom",
		bottom: '10',
		width: 150,
	});
}
function not13() {
	notif({
		type: "error",
		msg: "اختلال در ارتباط با سرور",
		position: "bottom",
		bottom: '10',
		width: 250,
	});
}
function not14() {
	notif({
		type: "success",
		msg: 'عملیات موفق بود',
		position: "right",
		fade: true
	});
}
function not15() {
	notif({
		type: "error",
		msg: "مبلغ صحیح نیست",
		position: "bottom",
		bottom: '10',
		width: 250,
	});
}
function not16() {
	notif({
		type: "error",
		msg: "کسب و کار خود را  مشخص کنید",
		position: "bottom",
		bottom: '10',
		width: 250,
	});
}
function not17() {
	notif({
		type: "error",
		msg: "کسب و کار خود را ارتقا دهید",
		position: "bottom",
		bottom: '10',
		width: 250,
	});
}
function not18() {
	notif({
		type: "error",
		msg: "شما حسابی را برای برداشت مشخص نکردید",
		position: "bottom",
		bottom: '10',
		width: 300,
	});
}
function not19() {
	notif({
		type: "error",
		msg: "مبلغ پرداختی بیشتر از موجودی شماست",
		position: "bottom",
		bottom: '10',
		width: 300,
	});
	window.location.replace(baseUrl('add_wallet_value'));
}
function not20() {
	notif({
		type: "error",
		msg: "این کارت بانکی هنوز تایید نشده است",
		position: "bottom",
		bottom: '10',
		width: 300,
	});
}
function not21() {
	notif({
		type: "error",
		msg: "شماره تماس در سیستم ثبت نشده،شما میتوانید برای شخص مورد نظر حساب کاربری درست کنید ابتدا از حساب کاربری خود خارج شوید",
		position: "bottom",
		bottom: '10',
		width: 600,
	});
}
function not22() {
	notif({
		type: "error",
		msg: "شما قبلا برای این شخص درخواست همکاری در بخش مربوطه را ارسال کردید",
		position: "bottom",
		bottom: '10',
		width: 300,
	});
}
function not23() {
	notif({
		type: "error",
		msg: "شما به این کسب و کار نمیتوانید وارد شوید",
		position: "bottom",
		bottom: '10',
		width: 300,
	});
}
function not24() {
	notif({
		type: "error",
		msg: "نام انتخاب شده برای کسب و کار شما قبلآ انتخاب شده لطفا بعدی را امتحان کنید",
		position: "bottom",
		bottom: '10',
		width: 500,
	});
}
function not25() {
	notif({
		type: "success",
		msg:'شما این بسته را قبلا خریداری کردید و برای شما فعال است',
		position: "bottom",
		bottom: '10',
		width: 400,
	});
}
function not26() {
	notif({
		type: "error",
		msg: "این بسته را قبلآ تهیه کردید که منقضی شده آن را از سفارشات خود دنبال کنید",
		position: "bottom",
		bottom: '10',
		width: 450,
	});
	$('#alertBuyLogError').removeClass('d-none');
}
function not27() {
	notif({
		type: "error",
		msg: "این بسته قبلا سفارش داده شده از بخش سفارشات آن را مشاهده کنید",
		position: "bottom",
		bottom: '10',
		width: 450,
	});
    $('#alertBuyLog').removeClass('d-none');
}
function not28() {
	notif({
		type: "error",
		msg: "موجودی شما برای خرید کافی نیست کیف پول خود را شارژ کنید",
		position: "bottom",
		bottom: '10',
		width: 450,
	});
	$('#addValueLogError').removeClass('d-none');
}
function not29() {
	notif({
		type: "success",
		msg:'خرید انجام شد',
		position: "bottom",
		bottom: '10',
		width: 150,
	});
}
function not30() {
	notif({
		type: "error",
		msg: "شما هنوز برای کسب و کار خود بسته فعال دارید",
		position: "bottom",
		bottom: '10',
		width: 350,
	});
}
function not31() {
	notif({
		type: "error",
		msg: "نام کاربری نباید کمتر از 8 کاراکتر باشد",
		position: "bottom",
		bottom: '10',
		width: 350,
	});
}
function not32() {
	notif({
		type: "error",
		msg: "رمز عبور نباید کمتر از 8 کاراکتر باشد",
		position: "bottom",
		bottom: '10',
		width: 350,
	});
}
function not33() {
	notif({
		type: "success",
		msg: 'رزرو انجام شد از منوی کاربری آن را مدیریت کنید',
		position: "bottom",
		bottom: '10',
		width: 400,
		fade:true
	});
}
function not34() {
	notif({
		type: "error",
		msg: 'این محصول جایگاه ارائه معتبر ندارد',
		position: "bottom",
		bottom: '10',
		width: 400,
		fade:true
	});
}
function not35() {
	notif({
		type: "error",
		msg: 'شما نقص اطلاعات دارید',
		position: "bottom",
		bottom: '10',
		width: 400,
		fade:true
	});
}
function not36() {
	notif({
		type: "error",
		msg: "هنوز همگی ساعت جلسه را تایید نکرده اند",
		position: "bottom",
		bottom: '10',
		width: 550,
	});
}
function not37() {
	notif({
		type: "error",
		msg:"زمان اتمام باید بیشتر از یک ساعت باشد",
		position: "bottom",
		bottom: '10',
		width: 550,
	});
}
function not38() {
	notif({
		type: "error",
		msg:"پیامک ارسال نشد",
		position: "bottom",
		bottom: '10',
		width: 350,
	});
}
function not39() {
	notif({
		type: "error",
		msg:"نام کاربری و رمز عبور باهم وارد شود",
		position: "bottom",
		bottom: '10',
		width: 450,
	});
}
function not40() {
	notif({
		type: "error",
		msg:"شما با این شماره ثبت نام نکردید",
		position: "bottom",
		bottom: '10',
		width: 300,
	});
}
function not41() {
	notif({
		type: "error",
		msg: "شماره تماس قبلآ استفاده شده",
		position: "bottom",
		bottom: '10',
		width: 300,
	});
}
function not42() {
	notif({
		type: "error",
// 		msg: "بعد از زمان اتمام خدمات تلاش کنید",
		msg: "اتمام خدمات جایگاه باید بعد از زمان خروج تنظیم شده باشد",
		position: "bottom",
		bottom: '10',
		width: 500,
	});
}
function not43() {
	notif({
		type: "error",
		msg: "زمان انتخابی باید از الان به بعد باشد",
		position: "bottom",
		bottom: '10',
		width: 400,
	});
}
// function not13() {
// 	notif({
// 		type: "info",
// 		msg: "در حال آزمایش متن چند خطی. تست کردن ، یک ، دو ... بیشتر.",
// 		position: "center",
// 		width: 150,
// 		autohide: false,
// 		multiline: true
// 	});
// }
// function not16() {
// 	notif({
// 		msg: "مهلت زمانی را سفارشی کنید!",
// 		position: "left",
// 		time: 1000
// 	});
// }
// function notChatDel(el,id,type) {
// 	var myCallback = function(choice){
// 		if(choice){
// 			notif({
// 				'type': 'success',
// 				'msg': '',
// 				'position': 'center'
// 			})
// 		}else{
// 			notif({
// 				'type': 'error',
// 				'msg': '<i class="far fa-sad-tear"></i>',
// 				'position': 'center'
// 			})
// 		}
// 	}

// 	notif_confirm({
// 		'textaccept': 'بله',
// 		'textcancel': 'خیر',
// 		'message': 'آیا از این کار اطمینان دارید؟',
// 		'callback': myCallback
// 	})
// }
// function not18() {
// 	var myCallback = function(input){
// 		if(input){
// 			notif({
// 				'type': 'success',
// 				'msg': input,
// 				'position': 'center'
// 			})
// 		}else{
// 			notif({
// 				'type': 'error',
// 				'msg': 'خالی یا کنسل',
// 				'position': 'center'
// 			})
// 		}
// 	}

// 	notif_confirm({
// 		'textaccept': 'خودشه!',
// 		'textcancel': 'حیوان خانگی ندارم :(',
// 		'message': 'نام حیوان خانگی شما چیست؟',
// 		'callback': myCallback
// 	})
// }