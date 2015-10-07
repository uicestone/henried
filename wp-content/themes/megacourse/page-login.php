<?php

if(isset($_POST['submit'])){
	$user = wp_authenticate($_POST['username'], $_POST['password']);
	
	if(is_a($user, 'WP_Error')){
		exit(array_values($user->errors)[0][0]);
	}
	
	wp_set_auth_cookie($user->ID, isset($_POST['remember']));
	wp_set_current_user($user->ID);
	header('Location: ' . site_url());
}

if(isset($_GET['logout'])){
	wp_logout();
	header('Location: ' . site_url());
}

get_header(); ?>

<!-- LOGIN -->
<section id="login-content" class="login-content">
	<div class="awe-parallax bg-login-content"></div>
	<div class="awe-overlay"></div>
	<div class="container">
		<div class="row">

			<!-- FORM -->
			<div class="col-xs-12 col-lg-4 pull-right">
				<div class="form-login">
					<form method="post">
						<h2 class="text-uppercase">登录</h2>
						<div class="form-email">
							<input type="text" name="username" placeholder="用户名或Email">
						</div>
						<div class="form-password">
							<input type="password" name="password" placeholder="Password">
						</div>
						<div class="form-check">
							<input type="checkbox" name="remember" id="check">
							<label for="check">
							<i class="icon md-check-2"></i>
							记住登录</label>
							<!--<a href="#">Forget password?</a>-->
						</div>
						<div class="form-submit-1">
							<input type="submit" name="submit" value="登录" class="mc-btn btn-style-1">
						</div>
						<div class="link">
							<a href="<?=site_url()?>/register/">
								<i class="icon md-arrow-right"></i>还没账号？马上注册
							</a>
						</div>
					</form>
				</div>
			</div>
			<!-- END / FORM -->

			<div class="image">
				<img src="<?=get_stylesheet_directory_uri()?>/images/homeslider/img-thumb.png" alt="">
			</div>

		</div>
	</div>
</section>
<!-- END / LOGIN -->

<?php get_footer(); ?>
