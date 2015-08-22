<?php get_header(); ?>

<!-- LOGIN -->
<section id="login-content" class="login-content">
	<div class="awe-parallax bg-login-content"></div>
	<div class="awe-overlay"></div>
	<div class="container">
		<div class="row">


			
			<!-- FORM -->
			<div class="col-lg-4 pull-right">
				<div class="form-login">
					<form>
						<h2 class="text-uppercase">sign up</h2>
						<div class="form-fullname">
							<input class ="first-name"type="text" placeholder="First name">
							<input class="last-name" type="text" placeholder="Last name">
						</div>
						<div class="form-datebirth">
							<input type="text" placeholder="Date of Birth">
						</div>
						<div class="form-email">
							<input type="text" placeholder="Email">
						</div>
						<div class="form-password">
							<input type="password" placeholder="Password">
						</div>
						
						<div class="form-submit-1">
							<input type="submit" value="Become a member" class="mc-btn btn-style-1">
						</div>
						<div class="link">
							<a href="login.html">
								<i class="icon md-arrow-right"></i>Already have account ? Log in
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
