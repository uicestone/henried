<?php

if(isset($_POST['submit'])){
	$user_id = wp_insert_user(array(
		'user_pass'=>$_POST['password'],
		'user_login'=>$_POST['username'],
		'user_email'=>$_POST['email'],
		'last_name'=>$_POST['last_name'],
		'first_name'=>$_POST['first_name'],
		'display_name'=>$_POST['last_name'] . ' ' . $_POST['first_name'],
		'user_registered'=>date('Y-m-d H:i:s'),
		'show_admin_bar_front'=>false
	));
	
	if(is_a($user_id, 'WP_Error')){
		exit(array_values($user_id->errors)[0][0]);
	}
	update_user_meta($user_id, 'mobile', $_POST['mobile']);
	wp_set_auth_cookie($user_id, true);
	wp_set_current_user($user_id);
	header('Location: ' . site_url());
	exit;
}

get_header(); ?>

<!-- LOGIN -->
<section id="login-content" class="login-content">
	<div class="awe-parallax bg-login-content"></div>
	<div class="awe-overlay"></div>
	<div class="container">
		<div class="row">

			<!-- FORM -->
			<div class="col-lg-4 pull-right">
				<div class="form-login">
					<form method="post">
						<h2 class="text-uppercase">注册</h2>
						<div class="form-item">
							<input type="text" name="username" placeholder="用户名">
						</div>
						<div class="form-password">
							<input type="password" name="password" placeholder="密码">
						</div>
						<div class="form-fullname">
							<input class="last-name" type="text" name="last_name" placeholder="姓">
							<input class ="first-name" type="text" name="first_name" placeholder="名">
						</div>
						<div class="form-email">
							<input type="email" name="email" placeholder="Email">
						</div>
						<div class="form-email">
							<input type="number" name="mobile" placeholder="手机">
						</div>
						<div class="form-submit-1">
							<input type="submit" name="submit" value="加入Henried" class="mc-btn btn-style-1">
						</div>
						<div class="link">
							<a href="<?=site_url()?>/login/">
								<i class="icon md-arrow-right"></i>已有账号？登录
							</a>
						</div>
					</form>
				</div>
			</div>
			<!-- END / FORM -->

			<div class="image">
				<!--<img src="<?=get_stylesheet_directory_uri()?>/images/homeslider/img-thumb.png" alt="">-->
			</div>

		</div>
	</div>
</section>
<!-- END / LOGIN -->

<?php get_footer(); ?>
