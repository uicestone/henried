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
							<li class="active"><span class="count">1</span>Basic Information</li>
							<li><span class="count">2</span>Design Course</li>
							<li><span class="count">3</span>Publish Course</li>
						</ul>
						<div class="support">
							<a href="#"><i class="icon md-camera"></i>See how it work short tutorial</a>
							<a href="#"><i class="icon md-flash"></i>Instant Support</a>
						</div>
					</div>
				</div>

			<div class="col-md-9">
				<div class="create-course-content">

					<!-- COURSE BANNER -->
					<div class="course-banner create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>Course Banner</h4>
							</div>
							<div class="col-md-9">
								<div class="image-info">
									<img src="<?=get_stylesheet_directory_uri()?>/images/img-upload.jpg" alt="">
								</div>
								<div class="upload-recrop">
									<div class="upload-image up-file">
										<a href="#"><i class="icon md-upload"></i>Upload image</a>
										<input type="file">
									</div>
									<div class="recrop">
										<a href="#"><i class="icon md-crop"></i>Recrop</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END / COURSE BANNER -->

					<!-- PROMO VIDEO -->
					<div class="promo-video create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>Promo Video</h4>
							</div>
							<div class="col-md-9">
								<div class="form-item">
									<input type="text" placeholder="Paste URL">
								</div>
								<div class="upload-video up-file">
									or
									<a href="#"><i class="icon md-upload"></i>Upload video</a>
									<input type="file">
								</div>
							</div>
						</div>
					</div>
					<!-- END / PROMO VIDEO -->

					<!-- DESCRIPTION -->
					<div class="description create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>Description</h4>
							</div>
							<div class="col-md-9">
								<div class="description-editor text-form-editor">
									<textarea placeholder="Discussion content"></textarea>
								</div>
							</div>
						</div>
					</div>
					<!-- END / DESCRIPTION -->

					<!-- INSTRUCTORS -->
					<div class="instructors create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>Instructors</h4>
							</div>
							<div class="col-md-9">
								<div class="author">
									<div class="image-author">
										<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
									</div>
									<cite>Tyrion Lanister ( Author )</cite>
								</div>
								<div class="author">
									<div class="image-author">
										<img src="<?=get_stylesheet_directory_uri()?>/images/team-13.jpg" alt="">
									</div>
									<cite>Anna Molly</cite>
									<div class="remove">
										<a href="#"><i class="icon md-close-2"></i></a>
									</div>
								</div>
								<a href="#" class="add-instructor"><i class="icon md-plus"></i>Add Instructor</a>
							</div>
						</div>
					</div>
					<!-- END / INSTRUCTORS -->

					<!-- OPEN DATE -->
					<div class="open-date create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>Open date</h4>
							</div>
							<div class="col-md-9">
								<div class='input-group date' id='datetimepicker'>
									<div class="form-item">
										<input type="text" placeholder="Select date">
									</div>
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>
						
					</div>
					<!-- END / OPEN DATE -->

					<!-- DURATION -->
					<div class="duration create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>Duration</h4>
							</div>
							<div class="col-md-9">
							   <div class="duration-ct">
									<div class="form-item">
										<input type="text">
									</div>
									<span class="day">days</span>
								</div>
							</div>
						</div>
					</div>
					<!-- END / DURATION -->

					<!-- TUITION FREE -->
					<div class="tuition-fee create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>Tuition fee</h4>
							</div>
							<div class="col-md-9">
								<div class="form-item form-radio radio-style">
									<input type="radio" id="free" name="tuition">
									<label for="free">
										<i class="icon-radio"></i>
										Free
									</label>
								</div>
								<div class="form-item form-radio radio-style">
									<input type="radio" id="pain"  name="tuition">
									<label for="pain">
										<i class="icon-radio"></i>
										Pain
									</label>
								</div>
								<div class="form-item">
									<input type="text" placeholder="amount">
									<span class="dl">$</span>
								</div>
							</div>
						</div>							
					</div>
					<!-- END / TUITION FREE -->

					<!-- FOR LEVEL FROM -->
					<div class="for-level-from create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>For level from</h4>
							</div>
							<div class="col-md-9">
								<div class="form-item form-radio radio-style">
									<input type="radio" id="beginer" name="for-level-from">
									<label for="beginer">
										<i class="icon-radio"></i>
										Beginer
									</label>
								</div>

								<div class="form-item form-radio radio-style">

									<input type="radio" id="intermediate"  name="for-level-from">
									<label for="intermediate">
										<i class="icon-radio"></i>
										Intermediate
									</label>
								</div>

								<div class="form-item form-radio radio-style">

									<input type="radio" id="professional"  name="for-level-from">
									<label for="professional">
										<i class="icon-radio"></i>
										Professional
									</label>
								</div>
							</div>
						</div>							
					</div>
					<!-- END / FOR LEVEL FROM -->

					<!-- CATEGORIES -->
					<div class="categories-item create-item">
						<div class="row">
							<div class="col-md-3">
								<h4 class="err">Categories</h4>
								<span class="text-err">choose at least one</span>
							</div>
							<div class="col-md-9">
								<table class="table-categories">
									<tr>
										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="business">
												<label for="business">
													<i class="icon-checkbox icon md-check-1"></i>
													Business
												</label>
											</div>
										</td>

										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="lifestyle">
												<label for="lifestyle">
													<i class="icon-checkbox icon md-check-1"></i>
													Lifestyle
												</label>
											</div>
										</td>

										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="game">
												<label for="game">
													<i class="icon-checkbox icon md-check-1"></i>
													Game
												</label>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="design">
												<label for="design">
													<i class="icon-checkbox icon md-check-1"></i>
													Design
												</label>
											</div>
										</td>

										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="math-and-science">
												<label for="math-and-science">
													<i class="icon-checkbox icon md-check-1"></i>
													Math and Science
												</label>
											</div>
										</td>

										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="crafts-and-hobbies">
												<label for="crafts-and-hobbies">
													<i class="icon-checkbox icon md-check-1"></i>
													Crafts and Hobbies
												</label>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="photography">
												<label for="photography">
													<i class="icon-checkbox icon md-check-1"></i>
													Art and Photography
												</label>
											</div>
										</td>

										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="education">
												<label for="education">
													<i class="icon-checkbox icon md-check-1"></i>
													Education
												</label>
											</div>
										</td>

										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="music">
												<label for="music">
													<i class="icon-checkbox icon md-check-1"></i>
													Music
												</label>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="health">
												<label for="health">
													<i class="icon-checkbox icon md-check-1"></i>
													Health and Fitness 
												</label>
											</div>
										</td>

										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="social-science">
												<label for="social-science">
													<i class="icon-checkbox icon md-check-1"></i>
													Social Science
												</label>
											</div>
										</td>

										<td>
											<div class="form-item form-checkbox checkbox-style">
												<input type="checkbox" id="sports">
												<label for="sports">
													<i class="icon-checkbox icon md-check-1"></i>
													Sports
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>							
					</div>
					<!-- END / CATEGORIES -->

					<!-- TOOL REQUIREMENT -->
					<div class="tool-requirement create-item">
						<div class="row">
							<div class="col-md-3">
								<h4 class="err">Tool requirement</h4>
								<span class="text-err">not filled yet</span>
							</div>
							<div class="col-md-9">
								<div class="form-item">
									<input type="text" class="error">
									<span>type your tool, separated by comma or space</span>
								</div>
							</div>
						</div>
					</div>
					<!-- END / TOOL REQUIREMENT -->

					<!-- TAG -->
					<div class="tag-item create-item">
						<div class="row">
							<div class="col-md-3">
								<h4>Tag</h4>
							</div>
							<div class="col-md-9">
								<div class="form-item">
									<input type="text">
									<span>type your tool, separated by comma or space</span>
								</div>
							</div>
						</div>
					</div>
					<!-- END / TAG -->

					<div class="form-action">
						<input type="submit" value="Save and Next" class="submit mc-btn-3 btn-style-1">
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END / CREATE COURSE CONTENT -->

<?php get_footer(); ?>
