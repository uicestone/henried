<?php get_header(); ?>

<!-- PROFILE FEATURE -->
<section class="profile-feature">
	<div class="awe-parallax bg-profile-feature"></div>
	<div class="awe-overlay overlay-color-3"></div>
	<div class="container">
		<div class="info-author">
			<div class="image">
				<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
			</div>	
			<div class="name-author">
				<h2 class="big">Anna Molly</h2>
			</div>	 
			<div class="address-author">
				<i class="fa fa-map-marker"></i>
				<h3>Hanoi, Vietnam</h3>
			</div>
		</div>
		<div class="info-follow">
			<div class="trophies">
				<span>12</span>
				<p>Trophies</p>
			</div>
			<div class="trophies">
				<span>12</span>
				<p>Follower</p>
			</div>
			<div class="trophies">
				<span>20</span>
				<p>Following</p>
			</div>
			<div class="trophies">
				<span>$ 149,902</span>
				<p>Balance</p>
			</div>
		</div>
	</div>
</section>
<!-- END / PROFILE FEATURE -->


<!-- CONTEN BAR -->
<section class="content-bar">
	<div class="container">
		<ul>
			<li>
				<a href="account-learning.html">
					<i class="icon md-book-1"></i>
					Learning
				</a>
			</li>
			<li>
				<a href="account-teaching.html">
					<i class="icon md-people"></i>
					Teaching
				</a>
			</li>
			<li>
				<a href="account-assignment.html">
					<i class="icon md-shopping"></i>
					Assignment
				</a>
			</li>
			<li class="current">
				<a href="account-profile-guest-view.html">
					<i class="icon md-user-minus"></i>
					Profile
				</a>
			</li>
			<li>
				<a href="account-inbox.html">
					<i class="icon md-email"></i>
					Inbox
				</a>
			</li>
		</ul>
	</div>
</section>
   <!-- END / CONTENT BAR -->




<!-- PROFILE -->

<section class="profile">
	<div class="container">
		
		<h3 class="md black">Profile</h3>
		<div class="row">
			<div class="col-md-9">
				<div class="avatar-acount">
					<div class="changes-avatar">
						<div class="img-acount">
							<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
						</div>
					</div>   
					<div class="info-acount">
						<h3 class="md black">Anna Molly</h3>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
						<div class="profile-email-address">
							<div class="profile-email">
								<h5>Email</h5>
								<p>annamolly@email.com</p>
							</div>
							<div class="profile-address">
								<h5>Password</h5>
								<p>Hanoi , Vietnam</p>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-3">
				<div class="social-connect">
					<h5>Social connect</h5>
					<ul>
						<li>
							<a href="#" class="twitter">
								<i class="icon md-twitter"></i>
								<p>https://www.facebook.com/</p>
							</a>
						</li>
						<li>
							<a href="#" class="facebook">
								<i class="icon md-facebook-1"></i>
								<p>https://www.facebook.com/</p>
							</a>
						</li>
						<li>
							<a href="#" class="gg-plus">
								<i class="icon md-google-plus"></i>
								<p>https://www.facebook.com/</p>
							</a>
						</li>
						<li>
							<a href="#" class="printerest">
								<i class="icon md-pinterest-1"></i>
								<p>https://www.facebook.com/</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>	
	</div>
</section>

<!-- END / PROFILE -->

<?php get_footer(); ?>
