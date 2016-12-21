<?php
global $title;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<!-- Css -->
		<link rel="stylesheet" type="text/css" href="<?=get_stylesheet_directory_uri()?>/css/library/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=get_stylesheet_directory_uri()?>/css/library/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?=get_stylesheet_directory_uri()?>/css/library/owl.carousel.css">
		<link rel="stylesheet" type="text/css" href="<?=get_stylesheet_directory_uri()?>/css/md-font.css">
		<link rel="stylesheet" type="text/css" href="<?=get_stylesheet_directory_uri()?>/style.css">
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		<title><?=$title?> - Henried Finance</title>
	</head>
	<body id="page-top">

	<!-- PAGE WRAP -->
	<div id="page-wrap">

		<div class="top-nav">

			<h4 class="sm black bold"><?=$title?></h4>

			<ul class="top-nav-list">
				<li class="prev-course"><a href="<?=site_url()?>/learning/?course_id=<?=$_GET['course_id']?>&section_id=<?=$_GET['section_id'] - 1?>"><i class="icon md-angle-left"></i><span class="tooltip">上一章</span></a></li>
				<li class="next-course"><a href="<?=site_url()?>/learning/?course_id=<?=$_GET['course_id']?>&section_id=<?=$_GET['section_id'] + 1?>"><i class="icon md-angle-right"></i><span class="tooltip">下一章</span></a></li>
				<li class="back"><a href="<?=get_the_permalink($_GET['course_id'])?>"><i class="icon md-back"></i><span class="tooltip">返回</span></a></li>
				<li class="autoload"><a href="#"><i class="icon md-download-1"></i> <span class="percentage" style="display:none"></span><span class="tooltip">缓存</span></a></li>
			</ul>

		</div>