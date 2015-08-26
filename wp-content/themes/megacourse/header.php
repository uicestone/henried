<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<title><?php bloginfo('sitename'); ?></title>
		<!-- Google font -->
		<link href="http://fonts.useso.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
		<link href="http://fonts.useso.com/css?family=Raleway:300,400,700,900" rel="stylesheet" type="text/css">
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
					<div class="logo"><a href="<?=site_url()?>"><img src="<?=get_stylesheet_directory_uri()?>/images/logo.png" alt=""></a></div>
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

						<!-- SEARCH BOX -->
						<div class="search-box">
							<i class="icon md-search"></i>
							<div class="search-inner">
								<form>
									<input type="text" placeholder="key words">
								</form>
							</div>
						</div>
						<!-- END / SEARCH BOX -->

						<!-- LIST ACCOUNT INFO -->
						<ul class="list-account-info">

							<!-- MESSAGE INFO -->
							<li class="list-item messages">
								<div class="message-info item-click">
									<i class="icon md-email"></i>
									<span class="itemnew"></span>
								</div>
								<div class="toggle-message toggle-list">
									<div class="list-profile-title">
										<h4>Inbox message</h4>
										<span class="count-value">3</span>
										<a href="#" class="new-message"><i class="icon md-pencil"></i></a>
									</div>
									<ul class="list-message">

										<!-- LIST ITEM -->
										<li class="ac-new">
											<a href="#">
												<div class="image">
													<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
												</div>
												<div class="list-body">
													<div class="author">
														<span>Megacourse</span>
														<div class="div-x"></div>
													</div>
													<p>Welcome message</p>
													<div class="time">
														<span>12:53</span>
													</div>
													<div class="indicator">
														<i class="icon md-paperclip"></i>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li class="ac-new">
											<a href="#">
												<div class="image">
													<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
												</div>
												<div class="list-body">
													<div class="author">
														<span>Name of sender</span>
														<div class="div-x"></div>
													</div>
													<p>Message title</p>
													<div class="time">
														<span>5 days ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li class="ac-new">
											<a href="#">
												<div class="image">
													<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
												</div>
												<div class="list-body">
													<div class="author">
														<span>Sasha Grey</span>
														<div class="div-x"></div>
													</div>
													<p>Maecenas sodales, nisl eget dign...</p>
													<div class="time">
														<span>5 days ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li>
											<a href="#">
												<div class="image">
													<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
												</div>
												<div class="list-body">
													<div class="author">
														<span>Amanda Gleam</span>
														<div class="div-x"></div>
													</div>
													<p>Message title</p>
													<div class="time">
														<span>5 days ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li>
											<a href="#">
												<div class="image">
													<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
												</div>
												<div class="list-body">
													<div class="author">
														<span>Amanda Gleam</span>
														<div class="div-x"></div>
													</div>
													<p>Message title</p>
													<div class="time">
														<span>5 days ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li>
											<a href="#">
												<div class="image">
													<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
												</div>
												<div class="list-body">
													<div class="author">
														<span>Amanda Gleam</span>
														<div class="div-x"></div>
													</div>
													<p>Message title</p>
													<div class="time">
														<span>5 days ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

									</ul>
									<div class="viewall">
										<a href="#">view all 80 messages</a>
									</div>
								</div>
							</li>
							<!-- END / MESSAGE INFO -->

							<!-- NOTIFICATION -->
							<li class="list-item notification">
								<div class="notification-info item-click">
									<i class="icon md-bell"></i>
									<span class="itemnew"></span>
								</div>
								<div class="toggle-notification toggle-list">
									<div class="list-profile-title">
										<h4>Notification</h4>
										<span class="count-value">2</span>
									</div>

									<ul class="list-notification">

										<!-- LIST ITEM -->
										<li class="ac-new">
											<a href="#">
												<div class="list-body">
													<div class="author">
														<span>Megacourse</span>
														<div class="div-x"></div>
													</div>
													<p>attend Salary for newbie course</p>
													<div class="image">
														<img src="<?=get_stylesheet_directory_uri()?>/images/feature/img-1.jpg" alt="">
													</div>
													<div class="time">
														<span>5 minutes ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li class="ac-new">
											<a href="#">
												<div class="list-body">
													<div class="author">
														<span>Megacourse</span>
														<div class="div-x"></div>
													</div>
													<p>attend Salary for newbie course</p>
													<div class="image">
														<img src="<?=get_stylesheet_directory_uri()?>/images/feature/img-1.jpg" alt="">
													</div>
													<div class="time">
														<span>5 minutes ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li>
											<a href="#">
												<div class="list-body">
													<div class="author">
														<span>Megacourse</span>
														<div class="div-x"></div>
													</div>
													<p>attend Salary for newbie course</p>
													<div class="image">
														<img src="<?=get_stylesheet_directory_uri()?>/images/feature/img-1.jpg" alt="">
													</div>
													<div class="time">
														<span>5 minutes ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li>
											<a href="#">
												<div class="list-body">
													<div class="author">
														<span>Megacourse</span>
														<div class="div-x"></div>
													</div>
													<p>attend Salary for newbie course</p>
													<div class="image">
														<img src="<?=get_stylesheet_directory_uri()?>/images/feature/img-1.jpg" alt="">
													</div>
													<div class="time">
														<span>5 minutes ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li>
											<a href="#">
												<div class="list-body">
													<div class="author">
														<span>Megacourse</span>
														<div class="div-x"></div>
													</div>
													<p>attend Salary for newbie course</p>
													<div class="image">
														<img src="<?=get_stylesheet_directory_uri()?>/images/feature/img-1.jpg" alt="">
													</div>
													<div class="time">
														<span>5 minutes ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->

										<!-- LIST ITEM -->
										<li>
											<a href="#">
												<div class="list-body">
													<div class="author">
														<span>Megacourse</span>
														<div class="div-x"></div>
													</div>
													<p>attend Salary for newbie course</p>
													<div class="image">
														<img src="<?=get_stylesheet_directory_uri()?>/images/feature/img-1.jpg" alt="">
													</div>
													<div class="time">
														<span>5 minutes ago</span>
													</div>
												</div>
											</a>
										</li>
										<!-- END / LIST ITEM -->



									</ul>
								</div>
							</li>
							<!-- END / NOTIFICATION -->

							<li class="list-item account">
								<div class="account-info item-click">
									<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
								</div>
								<div class="toggle-account toggle-list">
									<ul class="list-account">
										<li><a href="<?=site_url()?>/setting/"><i class="icon md-config"></i>Setting</a></li>
										<li><a href="<?=site_url()?>/login/"><i class="icon md-arrow-right"></i>Sign Out</a></li>
									</ul>
								</div>
							</li>


						</ul>
						<!-- END / LIST ACCOUNT INFO -->

					</nav>
					<!-- END / NAVIGATION -->

				</div>
			</header>
			<!-- END / HEADER -->
