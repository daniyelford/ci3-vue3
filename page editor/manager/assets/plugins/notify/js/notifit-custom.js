function not1() {
	notif({
		msg: "پیشفرض <b>بالا</b> اعلان",
		position: "top",
	});
}

function not2() {
	notif({
		msg: "پیشفرض <b>مرکز</b> اعلان",
		position: "center"
	});
}

function not3() {
	notif({
		msg: "پیشفرض <b>چپ</b> اعلان",
		position: "left"
	});
}

function not4() {
	notif({
		msg: "پیشفرض <b>پهنا کامل</b> اعلان",
		width: "all",
		position: "center"
	});
}

function not5() {
	notif({
		msg: "پیشفرض <b>راست</b> اعلان",
		position: "right",
		bottom:'10'
	});
}
function not51() {
	notif({
		msg: "پیشفرض <b>پایین</b> اعلان",
		position: "bottom",
		bottom:'10'
	});
}
function not6() {
	notif({
		type: "primary",
		msg: "خوش آمدید",
		position: "right",
		bottom:'10'
	});
}
function not7() {
	notif({
		msg: "<b>موفقیت:</b> جزئیات خوب انجام شد ارسال موفقیت آمیز",
		type: "success"
	});
}

function not8() {
	notif({
		msg: "<b>اوپس!</b> خطایی رخ داده است",
		type: "error",
		position: "center"
	});
}

function not9() {
	notif({
		type: "warning",
		msg: "<b>اخطار:</b> مشکلی پیش آمد",
		position: "left"
	});
}

function not10() {
	notif({
		type: "info",
		msg: "<b>اطلاعات: </b>برخی از اطلاعات در اینجا",
		width: "all",
		position: "center"
	});
}

function not11() {
	notif({
		type: "error",
		msg: "<b>خطا: </b>این خطا تا زمانی که روی آن کلیک نکنید در اینجا باقی خواهد ماند.",
		position: "center",
		autohide: false
	});
}

function not12() {
	notif({
		type: "dark",
		msg: "تیرگی سرد است!",
		position: "center",
		opacity: 0.5
	});
}
function not13() {
	notif({
		type: "info",
		msg: "در حال آزمایش متن چند خطی. تست کردن ، یک ، دو ... بیشتر.",
		position: "center",
		width: 150,
		autohide: false,
		multiline: true
	});
}
function not14() {
	notif({
		type: "success",
		msg: "حالت محو شدن فعال شد.",
		position: "right",
		fade: true
	});
}

function not15() {
	notif({
		msg: "با رنگ دلخواه خود سفارشی کنید!",
		position: "left",
		bgcolor: "#8500ff",
		color: "#fff"
	});
}

function not16() {
	notif({
		msg: "مهلت زمانی را سفارشی کنید!",
		position: "left",
		time: 1000
	});
}
function not17() {
	var myCallback = function(choice){
		if(choice){
			notif({
				'type': 'success',
				'msg': 'بله!',
				'position': 'center'
			})
		}else{
			notif({
				'type': 'error',
				'msg': '<i class="far fa-sad-tear"></i>',
				'position': 'center'
			})
		}
	}

	notif_confirm({
		'textaccept': 'این جا بمان',
		'textcancel': 'پنجره را ببند',
		'message': 'آیا مطمئن هستید که می خواهید ببندید؟',
		'callback': myCallback
	})
}
function not18() {
	var myCallback = function(input){
		if(input){
			notif({
				'type': 'success',
				'msg': input,
				'position': 'center'
			})
		}else{
			notif({
				'type': 'error',
				'msg': 'خالی یا کنسل',
				'position': 'center'
			})
		}
	}

	notif_confirm({
		'textaccept': 'خودشه!',
		'textcancel': 'حیوان خانگی ندارم :(',
		'message': 'نام حیوان خانگی شما چیست؟',
		'callback': myCallback
	})
}