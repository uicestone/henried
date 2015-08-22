<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<title>Mega Course - Learning and Courses HTML5 Template</title>
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
					<div class="logo"><a href="index.html"><img src="<?=get_stylesheet_directory_uri()?>/images/logo.png" alt=""></a></div>
					<!-- END / LOGO -->

					<!-- NAVIGATION -->
					<nav class="navigation">

						<div class="open-menu">
							<span class="item item-1"></span>
							<span class="item item-2"></span>
							<span class="item item-3"></span>
						</div>

						<!-- MENU -->
						<ul class="menu">
							<li><a href="index.html">Home</a></li>
							<li class="menu-item-has-children current-menu-item megamenu col-4">
								<a href="#">Pages</a>
								<ul class="sub-menu">
									<li class="menu-item-has-children">
										<a href="#">Account 1</a>
										<ul class="sub-menu">
											<li><a href="account-assignment.html">Account Assignment</a></li>
											<li class="current-menu-item"><a href="account-inbox.html">Account Inbox</a></li>
											<li><a href="account-learning.html">Account Learning</a></li>
											<li><a href="account-profile-owner-view.html">Account Profile Owner</a></li>
											<li><a href="account-profile-guest-view.html">Account Profile Guest</a></li>
											<li><a href="account-teaching.html">Account Teaching</a></li>
											<li><a href="setting.html">Setting</a></li>
										</ul>
									</li>

									<li class="menu-item-has-children">
										<a href="#">Asignment 2</a>
										<ul class="sub-menu">
											<li><a href="asignment-after-submit.html">Asignment After Submit</a></li>
											<li><a href="asignment-list.html">Asignment List</a></li>
											<li><a href="asignment-marking.html">Asignment Marking</a></li>
											<li><a href="asignment-received.html">Asignment Received</a></li>
											<li><a href="asignment-submit.html">Asignment Submit</a></li>
											<li><a href="become-teacher.html">Become Teacher</a></li>
											<li><a href="categories.html">Categories</a></li>
										</ul>
									</li>
									<li class="menu-item-has-children">
										<a href="#">Course 3</a>
										<ul class="sub-menu">
											<li><a href="course-intro.html">Course Intro</a></li>
											<li><a href="course-learn.html">Course Learn</a></li>
											<li><a href="create-basic-information.html">Create Basic Information</a></li>
											<li><a href="create-design-course.html">Create Design Course</a></li>
											<li><a href="create-publish-course.html">Create Publish Course</a></li>
											<li><a href="request-teacher.html">Request Teacher</a></li>
											<li><a href="search-result-found.html">Search Result Found</a></li>
											<li><a href="search-result-not-found.html">Search Result Found</a></li>
										</ul>
									</li>
									<li class="menu-item-has-children">
										<a href="#">Learn 3</a>
										<ul class="sub-menu">
											<li><a href="learning.html">Learning</a></li>
											<li><a href="quizz-1.html">Quizz 1</a></li>
											<li><a href="quizz-2.html">Quizz 2</a></li>
											<li><a href="quizz-3.html">Quizz 3</a></li>
											<li><a href="quizz-5.html">Quizz 5</a></li>
											<li><a href="quizz-20.html">Quizz 20</a></li>
											<li><a href="quizz-finish.html">Quizz Finish</a></li>
											<li><a href="quizz-intro.html">Quizz Intro</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="menu-item-has-children">
								<a href="blog-list.html">Blog</a>
								<ul class="sub-menu">
									<li><a href="blog-list.html">Blog list</a></li>
									<li><a href="blog-single.html">Blog single</a></li>
								</ul>
							</li>
							<li class="menu-item-has-children">
								<a href="#">Login</a>
								<ul class="sub-menu">
									<li><a href="login.html">Login</a></li>
									<li><a href="register.html">Register</a></li>
								</ul>
							</li>
							<li>
								<a href="categories.html">Course</a>
							</li>
						</ul>
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
										<li><a href="setting.html"><i class="icon md-config"></i>Setting</a></li>
										<li><a href="login.html"><i class="icon md-arrow-right"></i>Sign Out</a></li>
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
