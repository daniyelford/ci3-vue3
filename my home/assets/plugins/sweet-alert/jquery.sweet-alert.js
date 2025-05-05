$(function(e) {
	
	//Basic
	$('#swal-basic').on('click', function () {
		swal('به صفحه مدیر  خوش آمدید')
	});
	
	//A title with a text under
	$('#swal-title').click(function () {
		swal(
			{
				title: 'این یک عنوان است!',
				text: 'همه در الگو موجود است',
			}
		)
	});
	
	//Success Message
	$('#swal-success').click(function () {
		swal(
			{
				title: 'آفرین!',
				text: 'شما روی دکمه کلیک کردید!',
				type: 'success',
				confirmButtonColor: '#57a94f'
			}
		)
	});
	
	//Warning Message
	$('#swal-warning').click(function () {
		swal({
		  title: "شما مطمئن هستید؟",
		  text: "شما قادر به بازیابی این پرونده خیالی نخواهید بود!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn btn-danger",
		  confirmButtonText: "بله حذف کن!",
		  closeOnConfirm: false
		},
		function(){
		  swal("حذف!", "پرونده خیالی شما حذف شده است.", "success");
		});
	});
	
	//Parameter
	$('#swal-parameter').click(function () {
		swal({
		  title: "شما مطمئن هستید؟",
		  text: "شما نمی توانید این پرونده خیالی را بازیابی کنید!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: " بله حذف کن!",
		  cancelButtonText: "نه کنسل کن!",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
			swal("حذف شد!", "پرونده خیالی شما حذف شده است.", "success");
		  } else {
			swal("کنسل شد", "پرونده خیالی شما بی خطر است :)", "error");
		  }
		});
	});
	
	//Custom Image
	$('#swal-image').click(function () {
		swal({
			title: 'دوستداشتنی!',
			text: 'تصویر شما بارگذاری می شود.',
			imageUrl: 'assets/img/brand/logo.png',
			animation: false
		})
	});
	
	//Auto Close Timer
	$('#swal-timer').click(function () {
		swal({
			title: 'هشدار بستن خودکار!',
			text: '1 ثانیه دیگر می بندم.',
			timer: 1000
		}).then(
			function () {
			},
			// handling the promise rejection
			function (dismiss) {
				if (dismiss === 'timer') {
					console.log('با تایمر بسته شدم')
				}
			}
		)
	});
	
	
	//Ajax with Loader Alert
	$('#swal-ajax').click(function () {
		swal({
		  title: "نمونه درخواست آژاکس",
		  text: "برای اجرای درخواست ajax ارسال کنید",
		  type: "info",
		  showCancelButton: true,
		  closeOnConfirm: false,
		  showLoaderOnConfirm: true
		}, function () {
		  setTimeout(function () {
			swal("درخواست ایجکس پایان یافت");
		  }, 2000);
		});
	});
	
});