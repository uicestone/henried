<?php get_header(); ?>

<!-- BANNER CREATE COURSE -->
<section class="sub-banner sub-banner-create-course">
	<div class="awe-color bg-color-1"></div>
	<div class="container">
		<h2 class="md ilbl">Title of the course goes here</h2>
		<i class="icon md-pencil"></i>
	</div>
</section>
<!-- END / BANNER CREATE COURSE -->

<!-- CREATE COURSE CONTENT -->
<section id="create-course-section" class="create-course-section">
	<div class="container">
		<div class="row">
				<div class="col-md-3">
					<div class="create-course-sidebar">
						<ul class="list-bar">
							<li><span class="count">1</span>Basic Information</li>
							<li><span class="count">2</span>Design Course</li>
							<li class="active"><span class="count">3</span>Publish Course</li>
						</ul>
						<div class="support">
							<a href="#"><i class="icon md-camera"></i>See how it work short tutorial</a>
							<a href="#"><i class="icon md-flash"></i>Instant Support</a>
						</div>
					</div>
				</div>

			<div class="col-md-9">
				<div class="create-course-content">

					<!-- PUBLISH COURSE -->
					<div class="publish-course">
						<h3 class="md black">Course summary</h3>
						<div class="row">
							<div class="col-md-5">
								<div class="mc-item mc-item-1">
									<div class="image-heading">
										<img src="<?=get_stylesheet_directory_uri()?>/images/feature/img-1.jpg" alt="">
									</div>
									<div class="meta-categories"><a href="#">Web design</a></div>
									<div class="content-item">
										<div class="image-author">
											<img src="<?=get_stylesheet_directory_uri()?>/images/avatar-1.jpg" alt="">
										</div>
										<h4><a href="course-intro.html">The Complete Digital Photography Course Amazon Top Seller</a></h4>
										<div class="name-author">
											By <a href="#">Name of Mr or Mrs</a>
										</div>
									</div>
									<div class="ft-item">
										<div class="rating">
											<a href="#" class="active"></a>
											<a href="#" class="active"></a>
											<a href="#" class="active"></a>
											<a href="#"></a>
											<a href="#"></a>
										</div>
										<div class="view-info">
											<i class="icon md-users"></i>
											2568
										</div>
										<div class="comment-info">
											<i class="icon md-comment"></i>
											25
										</div>
										<div class="price">
											$190
											<span class="price-old">$145</span>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-7">
								<h2 class="big black">Title of the course goes here</h2>

								<div class="new-course">
									<div class="item course-code">
										<i class="icon md-barcode"></i>
										<h4><a href="#">Course Code</a></h4>
										<p class="detail-course"># A 15273</p>
									</div>
									<div class="item course-code">
										<i class="icon md-time"></i>
										<h4><a href="#">Duration</a></h4>
										<p class="detail-course">3 weeks</p>
									</div>
									<div class="item course-code">
										<i class="icon md-img-check"></i>
										<h4><a href="#">Open Date</a></h4>
										<p class="detail-course">25 May 2014</p>
									</div>
								</div>

								<hr class="line">
								<div class="about-instructor">
									<h4 class="xsm black">About Instructor</h4>
									<ul>
										<li>
											<div class="image-instructor text-center">
												<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
											</div>
											<div class="info-instructor">
												<cite class="sm black"><a href="#">Anna Molly</a></cite>
												<p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero</p>
											</div>
										</li>
										<li>
											<div class="image-instructor">
												<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
											</div>
											<div class="info-instructor">
												<cite class="sm black"><a href="#">Anna Molly</a></cite>
												<p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero</p>
											</div>
										</li>
									</ul>
								</div>
								<hr class="line">
								<div class="widget widget_equipment">
									<i class="icon md-config"></i>
									<h4 class="xsm black">Equipment</h4>
									<div class="equipment-body">
										<a href="#">Photoshop CC</a>,
										<a href="#">Illustrator CC</a>
									</div>
								</div>

								<div class="widget widget_tags">
									<i class="icon md-download-2"></i>
									<h4 class="xsm black">Tag</h4>
									<div class="tagCould">
										<a href="#">Design</a>, 
										<a href="#">Photoshop</a>, 
										<a href="#">Illustrator</a>, 
										<a href="">Art</a>, 
										<a href="">Graphic Design</a>
									</div>
								</div>

								<hr class="line">

								<div class="current-wrapper">
									<h4 class="xsm black">Current outline</h4>
									<ul class="current-outline">
										<li><span>4</span>section</li>
										<li><span>1</span>quizzes</li>
										<li><span>30</span>units</li>
										<li><span>5</span>assignments</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- END / PUBLISH COURSE -->

					<div class="form-action confirm-save">
						<input type="submit" value="Confirm And Send Request" class="submit mc-btn-3 btn-style-1">
						<input type="submit" value="Save Draft" class="submit mc-btn-3 btn-style-6">
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END / CREATE COURSE CONTENT -->

<?php get_footer(); ?>
