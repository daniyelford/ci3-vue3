<!DOCTYPE html>
<html lang="<?= (!empty($lang)?$lang:'fa') ?>">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1,user-scalable=1'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="my home">
    <meta name="Author" content="DanialFrd">
    <meta name="Keywords" content="easier management companies"/>
    <?php if(isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']!=='localhost'){ ?>
        <meta name="enamad" content="125152"/>
    <?php } ?>
    <!--    Title -->
    <title><?= (!empty($title) ? $title : '') ?></title>
    <!--    Favicon -->
    <link id="favicon" rel="shortcut icon" type="image/png" href="<?= base_url('assets/pic/fav/'. (!empty($fav_icon) && $fav_icon != '-' ? $fav_icon : 'myHome.jpeg')) ?>" />
    <!--	sweet alert-->
    <script src="<?= base_url('assets/inc/sweet_alert.js') ?>"></script>
    <!--translate-->
    <script src="<?= base_url('assets/inc/translate.js') ?>"></script>
    <!--my style library-->
    <link href="<?= base_url('assets/inc/my_library.css') ?>" rel="stylesheet">
    <!--	costume style-->
    <link href="<?= base_url('assets/css/all_style.css') ?>" rel="stylesheet">
    <!--	responsive style-->
    <link href="<?= base_url('assets/css/responsive.css') ?>" rel="stylesheet">
    <!--	recaptca-->
    <script src="https://www.google.com/recaptcha/api.js?render=<?= SITE_KEY ?>"></script>
    <!--jquery js-->
    <script src="<?= base_url('assets/inc/jquery.js') ?>"></script>
    <!--costum js-->
    <script src="<?= base_url('assets/js/functions.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <!--chart-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <!-- Icons css -->
	<link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
	<!--  Custom Scroll bar-->
	<link href="<?= base_url('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') ?>" rel="stylesheet"/>
	<!--  Sidebar css -->
	<link href="<?= base_url('assets/plugins/sidebar/sidebar.css') ?>" rel="stylesheet">
	<!-- Sidemenu css -->
	<link rel="stylesheet" href="<?= base_url('assets/css-rtl/sidemenu.css') ?>">
	<!--  Owl-carousel css-->
	<link href="<?= base_url('assets/plugins/owl-carousel/owl.carousel.css') ?>" rel="stylesheet" />
	<!--- Style css -->
	<link href="<?= base_url('assets/css-rtl/style.css') ?>" rel="stylesheet">
	<!--- Dark-mode css -->
	<link href="<?= base_url('assets/css-rtl/style-dark.css') ?>" rel="stylesheet">
	<!---Skinmodes css-->
	<link href="<?= base_url('assets/css-rtl/skin-modes.css') ?>" rel="stylesheet">
	<!---Switcher css-->
	<link href="<?= base_url('assets/switcher/css/switcher-rtl.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/switcher/demo.css') ?>" rel="stylesheet">
	<!-- notify -->
	<link href="<?= base_url('assets/plugins/notify/css/notifIt.css') ?>" rel="stylesheet">
	<!-- treeview -->
    <link href="<?= base_url('assets/plugins/treeview/treeview-rtl.css') ?>" rel="stylesheet" type="text/css" />
	<!--map-->
    <script src="<?= base_url('assets/inc/map/maptiler.js') ?>"></script>
    <link href="<?= base_url('assets/inc/map/maptiler.css') ?>" rel="stylesheet" />
	<script>
        const geojson={'company':{},'position':{},'product':{}};
        const chartMain=[];
        const companyInfo=[];
        const productInfo=[];
        const positionInfo=[];
        let markerNumber=0;
    </script>
    <!--pagination-->
    <script>
        function tblPagination(el,pagerId){
            let allChildren = $(el).find('.column-number-td'),pager=$(pagerId),curr=1,perPage=5,numItems,numPages;
            numItems = allChildren.length;
            numPages = Math.ceil(numItems/perPage);
            while(numPages > curr){
                $('<li><a onclick="paginationCick(this,'+"'"+el+"'"+','+curr+','+perPage+');" class="page_link">'+curr+'</a></li>').appendTo(pager);
                curr++;
            }
            pager.find('.page_link:first').addClass('active');
            allChildren.slice(0, perPage).removeClass('d-none');
            return true;
        }
        function paginationCick(el,tbl,page,perPage){
            var n=page-1,startAt = n * perPage,
                pager=$(el).parent().parent(),
                endOn,
                allChildren;
            allChildren=$(tbl).find('.column-number-td'),
            endOn = startAt + perPage;
            allChildren.addClass('d-none');
            allChildren.slice(startAt, endOn).removeClass('d-none');
            pager.children().removeClass("active");
            $(el).addClass("active");
            return true;
        }
    </script>
    <!--pagination-->
    <style>
        table span.product-info {
            display: list-item;
        }
        a.see-profile-btn {
            display: block;
            text-align: center;
            color: #0eebeb !important;
        }
        .mark-description-style{
            padding-top:10px;
            display:inline-block;
            word-break: break-all;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body id="body" class="main-body app sidebar-mini dark-theme pink-theme">
    <!-- Loader -->
	<div id="global-loader" class="loaderIcon">
		<img src="<?= base_url('assets/img/loader.svg') ?>" class="loader-img" alt="لودر">
	</div>
	<!-- /Loader -->
	<!--sidebar-->
	<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
	    <?php $this->view('header_includes/category') ?>
	    <!--sidebar-->
        <div class="main-content app-content">
            <div class="main-header sticky side-header nav nav-item">
    			<?php $this->view('header_includes/nav') ?>
    		</div>
    		<!-- /main-header -->
    		<div class="container-fluid" id="content">
    		    
    		    
    		    
    		    
    		    
    		    	<!-- main-sidebar -->
    <!--<video autoplay muted loop id="myVideo">
        <source src="<?= base_url() ?>assets/video/1.mp4" type="video/mp4">
    </video>
    <div class="loaderIcon" id="loaderIcon">
        <img src="<?= base_url() ?>assets/svg/loader.svg">
    </div>-->
    