<?php
$favicon = 'icon.png';
$description = 'description';
$keyword = "keywords";
$page_title = "home page";
$screenMode='dark-theme';
//$screenMode='light-theme';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="Description" content="<?= $description ?>">
	<meta name="Author" content="DanialFrd">
	<meta name="Keywords" content="<?= $keyword ?>"/>
	<!-- Title -->
	<title><?= $page_title ?> </title>
	<!-- Favicon -->
	<link rel="icon" href="<?= base_url() ?>assets/img/brand/<?= $favicon ?>" type="image/x-icon"/>
	<!-- Icons css -->
	<link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet">
	<!--  Custom Scroll bar-->
	<link href="<?= base_url() ?>assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>
	<!--  Sidebar css -->
	<link href="<?= base_url() ?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">
	<!-- Sidemenu css -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css-rtl/sidemenu.css">
	<!--  Owl-carousel css-->
	<link href="<?= base_url() ?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet"/>
	<!-- Maps css -->
	<link href="<?= base_url() ?>assets/plugins/jqvmap/jqvmap.min.css" rel="stylesheet">
	<!--- Style css -->
	<link href="<?= base_url() ?>assets/css-rtl/style.css" rel="stylesheet">
	<!--- Dark-mode css -->
	<link href="<?= base_url() ?>assets/css-rtl/style-dark.css" rel="stylesheet">
	<!---Skinmodes css-->
	<link href="<?= base_url() ?>assets/css-rtl/skin-modes.css" rel="stylesheet">

	<!---Switcher css-->
	<link href="<?= base_url() ?>assets/switcher/css/switcher-rtl.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/switcher/demo.css" rel="stylesheet">
</head>
<body class="main-body app sidebar-mini <?= $screenMode ?>">
