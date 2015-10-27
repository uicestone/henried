<?php
global $title;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<!-- Google font -->
		<link href='http://fonts.useso.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.useso.com/css?family=Raleway:300,400,700,900' rel='stylesheet' type='text/css'>
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
				<!--<li class="outline-learn">
					<a href="#"><i class="icon md-list"></i></a>
					<div class="list-item-body outline-learn-body">
						<div class="section-learn-outline">
							<h5 class="section-title">Sect 1 : Introduction</h5>
							<ul class="section-list">
								<li>
									<div class="list-body">
										<a href="#">
											<h6>Unit 1</h6>
											<p>Duis vel ullamcorper mauris, eu pretium felis. Duis gravida laoreet velit.</p>
										</a>
									</div>
									<div class="download">
										<a href="#"><i class="icon md-download-1"></i></a>
										<div class="download-ct">
											<span>Reference 12 mb</span>
										</div>
									</div>
									<div class="div-x"><i class="icon md-check-2"></i></div>
								</li>
							</ul>
						</div>
					</div>-->
				</li>

			</ul>

		</div>