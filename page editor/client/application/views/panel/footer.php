<!-- Footer opened -->
<div class="main-footer ht-40" style="position: absolute;z-index: 20;bottom: 0px;width: 100%;">
	<div class="container-fluid pd-t-0-f ht-100p" style="z-index:20">
		<?= $footer?>
	</div>
</div>
<!-- Footer closed -->
<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="../../../assets/plugins/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>
<!-- Bootstrap Bundle js -->
<script src="../../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ionicons js -->
<script src="../../../assets/plugins/ionicons/ionicons.js"></script>
<!-- Moment js -->
<script src="../../../assets/plugins/moment/moment.js"></script>

<!-- Rating js-->
<script src="../../../assets/plugins/rating/jquery.rating-stars.js"></script>
<script src="../../../assets/plugins/rating/jquery.barrating.js"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="../../../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../../../assets/plugins/perfect-scrollbar/p-scroll.js"></script>
<!--Internal Sparkline js -->
<script src="../../../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- Custom Scroll bar Js-->
<script src="../../../assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- right-sidebar js -->
<script src="../../../assets/plugins/sidebar/sidebar-rtl.js"></script>
<script src="../../../assets/plugins/sidebar/sidebar-custom.js"></script>
<!-- Eva-icons js -->
<script src="../../../assets/js/eva-icons.min.js"></script>
<!--Internal  Chart.bundle js -->
<script src="../../../assets/plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Moment js -->
<script src="../../../assets/plugins/raphael/raphael.min.js"></script>
<!--Internal  Flot js-->
<script src="../../../assets/plugins/jquery.flot/jquery.flot.js"></script>
<script src="../../../assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
<script src="../../../assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
<script src="../../../assets/plugins/jquery.flot/jquery.flot.categories.js"></script>
<script src="../../../assets/js/dashboard.sampledata.js"></script>
<script src="../../../assets/js/chart.flot.sampledata.js"></script>
<!--Internal Apexchart js-->
<script src="../../../assets/js/apexcharts.js"></script>
<!-- Internal Map -->
<script src="../../../assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../../assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="../../../assets/js/modal-popup.js"></script>
<!--Internal  index js -->
<script src="../../../assets/js/index.js"></script>
<script src="../../../assets/js/jquery.vmap.sampledata.js"></script>
<!-- Sticky js -->
<script src="../../../assets/js/sticky.js"></script>
<!-- custom js -->
<script src="../../../assets/js/custom.js"></script><!-- Left-menu js-->
<script src="../../../assets/plugins/side-menu/sidemenu.js"></script>

<!-- Switcher js -->
<script src="../../../assets/switcher/js/switcher-rtl.js"></script>
<script>
	$(document).ready(function () {
		$("#themeL").click(function (e) {
			e.preventDefault();
			$("#tmMode").addClass('light-theme');
			$("#tmMode").removeClass('dark-theme');
		})
		$("#themeD").click(function (e) {
			e.preventDefault();
			$("#tmMode").addClass('dark-theme');
			$("#tmMode").removeClass('light-theme');
		})
	})
</script>
<script>
// $(document).ready(function(){
//     $("#news-paper").html('');
//     let news;
//     $("#news-pointer").click(function(){
//         if(news==''){
//             $("#news-pointer").removeClass('fa-arrow-circle-down');
//             $("#news-pointer").addClass('fa-arrow-circle-up');
//             $.ajax({
//                 url:'https://aseos.ir/admin/news',
//                 method:'post',
//                 data:{news:news},
//                 success:function(value){
//                     news='ok';
//                     $("#news-paper").html(value);
//                 }
//             })
//         }else{
//             $("#news-pointer").removeClass('fa-arrow-circle-up');
//             $("#news-pointer").addClass('fa-arrow-circle-down');
//             $("#news-paper").html('');
//             news='';
//         }
//     })
// })
    
</script>
</body>
</html>
