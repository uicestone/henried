<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<title><?php wp_title('-', true, 'right'); bloginfo('name');?></title>
		<!-- Css -->
		<?php wp_head(); ?>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
	</head>
	<body id="page-top">

		<!-- PAGE WRAP -->
		<div id="page-wrap">

			<!-- PRELOADER -->
			<div id="preloader">
				<div class="pre-icon">
					<div class="pre-item pre-item-1"></div>
					<div class="pre-item pre-item-2"></div>
					<div class="pre-item pre-item-3"></div>
					<div class="pre-item pre-item-4"></div>
				</div>
			</div>
			<!-- END / PRELOADER -->

			<!-- HEADER -->
			<header id="header" class="header">
				<div class="container">

					<!-- LOGO -->
					<div class="logo"><a href="<?=site_url()?>"><img src="<?=get_stylesheet_directory_uri()?>/images/logo.png"></a></div>
					<!-- END / LOGO -->

					<!-- NAVIGATION -->
					<nav class="navigation">

						<div class="open-menu">
							<span class="item item-1"></span>
							<span class="item item-2"></span>
							<span class="item item-3"></span>
						</div>

						<!-- MENU -->
						<?=wp_nav_menu(array('theme_location'=>'main', 'container'=>null))?>
						
						<!-- END / MENU -->

						<!-- LIST ACCOUNT INFO -->
						<ul class="list-account-info">

							<li class="list-item account">
								<div class="account-info item-click">
									<?php if(is_user_logged_in()){ ?>
									<a><?=wp_get_current_user()->display_name?></a>
									<?php }else{ ?>
									<a href="<?=site_url()?>/register/" style="border-right:1px #7d3d3d solid; padding-right:5px">注册</a>
									<a href="<?=site_url()?>/login/">登录</a>
									<?php } ?>
								</div>
								<?php if(is_user_logged_in()){ ?>
								<div class="toggle-account toggle-list">
									<ul class="list-account">
										<li><a href="<?=site_url()?>/login/?logout=true"><i class="icon md-arrow-right"></i>退出登录</a></li>
									</ul>
								</div>
								<?php } ?>
							</li>

						</ul>
						<!-- END / LIST ACCOUNT INFO -->

					</nav>
					<!-- END / NAVIGATION -->

				</div>
			</header>
			<!-- END / HEADER -->
