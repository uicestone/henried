<?php get_header(); ?>

<!-- SETTING -->
<section class="setting">
	<div class="container">
		<div class="content-setting">
			<h3 class="big black text-center">Settings</h3>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="notification-setting setting-box">
						<h4 class="sm black bold">Notification</h4>
						<ul>
							<li>
								<input type="checkbox" class="inputcheck" id="following-user">
								<label for="following-user">
									Following user
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="following-topic">
								<label for="following-topic">
									Following  topic
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="teaching-course">
								<label for="teaching-course">
									Teaching course
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="promotion-annoucement">
								<label for="promotion-annoucement">
									Promotion and Annoucement
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="new-user-following-you">
								<label for="new-user-following-you">
									New user following you
									<i class="icon md-check-1"></i>
								</label>
							</li>

						</ul>
					</div>
					<div class="setting-box">
						<h4 class="sm black bold">Email subscribe </h4>
						<ul>
							<li>
								<input type="checkbox" class="inputcheck" id="Finish-course">
								<label for="Finish-course">
									Finish a course
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="Receive-new-notification">
								<label for="Receive-new-notification">
									Receive new notification
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="have-new-message">
								<label for="have-new-message">
									Have new message
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="new-promotion-sales">
								<label for="new-promotion-sales">
									New promotion and sales
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="confirm-password">
								<label for="confirm-password">
									Confirm password
									<i class="icon md-check-1"></i>
								</label>
							</li>

						</ul>
					</div>
					<div class="setting-box">
						<h4 class="sm black bold">Profile privacy</h4>
						<ul>
							<li>
								<input type="checkbox" class="inputcheck" id="show-my-location">
								<label for="show-my-location">
									Show my location
									<i class="icon md-check-1"></i>
								</label>
							</li>
							<li>
								<input type="checkbox" class="inputcheck" id="show-my-email">
								<label for="show-my-email">
									Show my email
									<i class="icon md-check-1"></i>
								</label>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="input-save">   
				<input type="submit" value="Save changes" class="mc-btn btn-style-1">
			 </div>   
		</div>
	</div>	
</section>
<!-- END / SETTING -->

<?php get_footer(); ?>
