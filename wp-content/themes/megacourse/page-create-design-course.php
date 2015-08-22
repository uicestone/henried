<?php get_header(); ?>

<!-- BANNER CREATE COURSE -->
<section class="sub-banner sub-banner-create-course">
	<div class="awe-parallax bg-profile-feature"></div>
	<div class="awe-overlay overlay-color-3"></div>
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
						<li class="active"><span class="count">2</span>Design Course</li>
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
					<ul class="design-course-tabs" role="tablist">
						<li class="active">
							<a href="#design-outline" role="tab" data-toggle="tab"><i class="icon md-list"></i>Outline (30 units)</a>
						</li>
						<li>
							<a href="#design-question" role="tab" data-toggle="tab"><i class="fa fa-question-circle"></i>Questions (5)</a>
						</li>
						<li>
							<a href="#design-assignment" role="tab" data-toggle="tab"><i class="icon md-book-1"></i>Assignments (3)</a>
						</li>
					</ul>
					<div class="tab-content">
						<!-- DESIGN OUTLINE -->
						<div class="tab-pane fade in active" id="design-outline">
							<div class="current-wrapper">
								<h4 class="sm black">Current outline</h4>
								<ul class="current-outline">
									<li><span>4</span>section</li>
									<li><span>1</span>quizzes</li>
									<li><span>30</span>units</li>
									<li><span>5</span>assignments</li>
								</ul>
							</div>

							<!-- SECTIONS -->
							<div class="dc-sections">
								<!-- DC SECTION INFO -->
								<div class="dc-section-info">
									<div class="title-section">
										<h4 class="xsm">Section 1 : <span contenteditable="true">This is title of the section</span></h4>
										<div class="course-region-tool">
											<a href="#" class="edit" title="edit"><i class="icon md-pencil"></i></a>
											<a href="#" class="drag" title="drag"><i class="fa fa-arrows"></i></a>
											<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
											<a href="#" class="toggle-section active"><i class="fa fa-caret-right"></i></a>
										</div>
									</div>

									<!-- DC SECTION BODY -->
									<div class="dc-section-body">

										<!-- DC UNIT -->
										<div class="dc-unit-info dc-course-item">
											<div class="dc-content-title">
												<h5 class="xsm black">Unit 1 : title of unit</h5>
												<div class="course-region-tool">
													<a href="#" class="edit" title="edit"><i class="icon md-pencil"></i></a>
													<a href="#" class="drag" title="drag"><i class="fa fa-arrows"></i></a>
													<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
													<a href="#" class="save" title="save"><i class="fa fa-save"></i></a>
												</div>
											</div>

											<div class="unit-body dc-item-body">
												<table class="tb-course">
													<tbody>
														<tr class="tb-unit-title">
															<td class="label-info">
																<label for="">Title</label>
															</td>
															<td class="td-form-item">
																<div class="form-item">
																	<input type="text">
																</div>
															</td>
														</tr>

														<tr class="tb-desc">
															<td class="label-info">
																<label for="">Description</label>
															</td>
															<td class="td-form-item">
																<div class="form-textarea-wrapper">
																	<textarea></textarea>
																</div>
															</td>
														</tr>

														<tr class="tb-upload-content">
															<td class="label-info">
																<label for="">Content</label>
															</td>
															<td class="td-form-item">
																<div class="row">
																	<div class="col-md-6">
																		<div class="upload-drag">
																			<h5 class="sm black">Upload file Here</h5>
																			<span>Drag to upload Your file from computer</span>
																			<p class="or">Or</p>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="paste-link">
																			<h5 class="sm black">Paste Link Video</h5>
																			<span>Youtube or Vimeo only</span>
																			<input type="text">
																		</div>
																	</div>
																</div>
															</td>
														</tr>

														<tr class="tb-upload-content">
															<td class="label-info">
																<label for="">Content</label>
															</td>
															<td class="td-form-item">
																<div class="uploading text-center tb">
																	<div class="add-thumb-wrap tb-cell">
																		<a href="#" class="add-thumb">
																			<i class="icon md-plus"></i>
																			Add Thumbnail
																		</a>
																	</div>
																	<div class="tb-cell">
																		<div class="progressbar">
																			<div class="up-progress" style="left: 40%"></div>
																		</div>
																	</div>
																	<div class="cancel-wrap tb-cell">
																		<a href="#" class="cancel">Cancel</a>
																	</div>
																</div>
															</td>
														</tr>

														<tr class="tb-upload-content">
															<td class="label-info">
																<label for="">Content</label>
															</td>
															<td class="td-form-item">
																<div class="content-item-info">

																	<div class="uploading upload-info text-center tb">
																		<div class="add-thumb-wrap tb-cell">
																			<a href="#" class="add-thumb">
																				<i class="icon md-plus"></i>
																				Add Thumbnail
																			</a>
																		</div>
																		<div class="tb-cell">
																			<div class="title-file">
																				<span class="name-file">Name of Material.filetypes</span>
																				<span class="size-file">( 12mb )</span>
																				<a href="#" class="close-file">
																					<i class="icon md-close-2"></i>
																				</a>
																			</div>
																			<div class="upload-meta">
																				<span>Uploaded by Admin . 30, May,2014</span>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
														</tr>

														<tr class="tr-file">
															<td class="label-info">
																<label for="">Reference file</label>
															</td>
															<td class="td-form-item">
																<div class="form-item">
																	<input type="file" class="upload-file">
																</div>
																<a href="#" class="trigger-file">
																	<i class="icon md-upload"></i>
																	<span class="name-file">
																	Upload file</span>
																	<span class="size-file"></span>
																	<input type="hidden">
																</a>
															</td>
														</tr>

														<tr class="tr-file">
															<td class="label-info">
																<label for="">Reference file</label>
															</td>
															<td class="td-form-item">
																<div class="progress-reference progressbar">
																	<div class="up-progress" style="left: 40%"></div>
																</div>
																<a href="#" class="cancel">Cancel</a>
															</td>
														</tr>

														<tr class="tr-file">
															<td class="label-info">
																<label for="">Reference file</label>
															</td>
															<td class="td-form-item">
																<div class="form-item">
																	<input type="file" class="upload-file">
																</div>
																<a href="#" class="trigger-file">
																	<i class="icon md-upload"></i>
																	<span class="name-file">abc.mp4</span>
																	<span class="size-file">( 12 mb )</span>
																	<input type="hidden">
																</a>
																<a href="#" class="close-file">
																	<i class="icon md-close-2"></i>
																</a>
															</td>
														</tr>

														<tr>
															<td></td>
															<td>
																<div class="form-item form-checkbox checkbox-style">
																	<input type="checkbox" id="make">
																	<label for="make">
																		<i class="icon-checkbox icon md-check-1"></i>
																		Make this Unit as Free
																	</label>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
												
											</div>
										</div>
										<!-- END / DC UNIT -->

										<!-- DC UNIT -->
										<div class="dc-unit-info dc-course-item">
											<div class="dc-content-title">
												<h5 class="xsm black">Unit 1 : title of unit</h5>
												<div class="course-region-tool">
													<a href="#" class="edit" title="edit"><i class="icon md-pencil"></i></a>
													<a href="#" class="drag" title="drag"><i class="fa fa-arrows"></i></a>
													<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
													<a href="#" class="save" title="save"><i class="fa fa-save"></i></a>
												</div>
											</div>

											<div class="unit-body dc-item-body">
												<div class="content-item-info">
													<div class="upload-thumb">
														<img src="<?=get_stylesheet_directory_uri()?>/images/video-upload.jpg" alt="">
													</div>
													<div class="upload-cnt">
														<div class="title-file">
															<span class="name-file">Name of Material.filetypes</span>
															<span class="size-file">( 12mb )</span>
														</div>
														<div class="upload-meta">
															<span>Uploaded by Admin . 30, May,2014</span>
														</div>
														<div class="upload-footer">
															<a href="#">Edit</a>
															<a href="#">Preview</a>
															<a href="#">Delete</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- END / DC UNIT -->


										<!-- DC QUIZZ -->
										<div class="dc-quizz-info dc-course-item">
											<div class="dc-content-title">
												<h5 class="xsm black">Quizz 1 : title of quizz</h5>
												<div class="course-region-tool">
													<a href="#" class="edit" title="edit"><i class="icon md-pencil"></i></a>
													<a href="#" class="drag" title="drag"><i class="fa fa-arrows"></i></a>
													<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
													<a href="#" class="save" title="save"><i class="fa fa-save"></i></a>
												</div>
											</div>

											<div class="quizz-body dc-item-body">
												<div class="btn-add">
													<a href="#addquestion" class="popup-with-zoom-anim">
														<i class="icon md-plus"></i>
														Add Question
													</a>
												</div>

												<div class="form-item form-checkbox checkbox-style">
													<input type="checkbox" id="showanswer">
													<label for="showanswer">
														<i class="icon-checkbox icon md-check-1"></i>
														Show Answer
													</label>
												</div>

												<div class="form-item form-checkbox checkbox-style">
													<input type="checkbox" id="limittime">
													<label for="limittime">
														<i class="icon-checkbox icon md-check-1"></i>
														Limit time
													</label>
												</div>

												<div class="time">
													<div class="form-item">
														<input type="text">
														<label for="">mins</label>
													</div>
												</div>

												<div class="form-item">
													<input type="text" placeholder="Short introduction ( optional)" class="fullwidth">
												</div>

												<div class="form-item-wrap">
													<div class="form-items">
														<div class="quest">
															<span>Question 1 : Lorem ipsum Donor de blah blah blahahshshsh js</span>
															</div>
														<div class="form-item">
															<input type="text" placeholder="score">
														</div>
													</div>
													<div class="form-items">
														<div class="quest">
															<span>Question 2 : Lorem ipsum Donor de blah blah blahahshshsh js</span>
														</div>
														<div class="form-item">
															<input type="text" placeholder="score">
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- END / DC QUIZZ -->


										<!-- DC ASSIGNMENT -->
										<div class="dc-assignment-info dc-course-item">
											<div class="dc-content-title">
												<h5 class="xsm black">Assignment 1 : title of assignment </h5>
												<div class="course-region-tool">
													<a href="#" class="edit" title="edit"><i class="icon md-pencil"></i></a>
													<a href="#" class="drag" title="drag"><i class="fa fa-arrows"></i></a>
													<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
													<a href="#" class="save" title="save"><i class="fa fa-save"></i></a>
												</div>
											</div>

											<div class="assignment-body dc-item-body">
												<table class="tb-course">
													<tbody>
														<tr class="tb-unit-title">
															<td class="label-info">
																<label for="">Title</label>
															</td>
															<td class="td-form-item">
																<div class="form-item">
																	<input type="text">
																</div>
															</td>
														</tr>

														<tr class="tb-desc">
															<td class="label-info">
																<label for="">Description</label>
															</td>
															<td class="td-form-item">
																<div class="form-textarea-wrapper">
																	<textarea></textarea>
																</div>
															</td>
														</tr>

														<tr class="tb-upload-content">
															<td class="label-info">
																<label for="">Content</label>
															</td>
															<td class="td-form-item">
																<div class="upload-drag">
																	<h5 class="sm black">Upload file Here</h5>
																	<span>Drag to upload Your file from computer</span>
																</div>
															</td>
														</tr>

														<tr class="tb-upload-content">
															<td class="label-info">
																<label for="">Content</label>
															</td>
															<td class="td-form-item">
																<div class="uploading text-center tb">
																	<div class="add-thumb-wrap tb-cell">
																		<a href="#" class="add-thumb">
																			<i class="icon md-plus"></i>
																			Add Thumbnail
																		</a>
																	</div>
																	<div class="tb-cell">
																		<div class="progressbar">
																			<div class="up-progress" style="left: 40%"></div>
																		</div>
																	</div>
																	<div class="cancel-wrap tb-cell">
																		<a href="#" class="cancel">Cancel</a>
																	</div>
																</div>
															</td>
														</tr>

														<tr class="tb-upload-content">
															<td class="label-info">
																<label for="">Content</label>
															</td>
															<td class="td-form-item">
																<div class="content-item-info">

																	<div class="uploading upload-info text-center tb">
																		<div class="add-thumb-wrap tb-cell">
																			<a href="#" class="add-thumb">
																				<i class="icon md-plus"></i>
																				Add Thumbnail
																			</a>
																		</div>
																		<div class="tb-cell">
																			<div class="title-file">
																				<span class="name-file">Name of Material.filetypes</span>
																				<span class="size-file">( 12mb )</span>
																				<a href="#" class="close-file">
																					<i class="icon md-close-2"></i>
																				</a>
																			</div>
																			<div class="upload-meta">
																				<span>Uploaded by Admin . 30, May,2014</span>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
														</tr>

														<tr class="tr-file">
															<td class="label-info">
																<label for="">Package file</label>
															</td>
															<td class="td-form-item">
																<div class="form-item">
																	<input type="file" class="upload-file">
																</div>
																<a href="#" class="trigger-file">
																	<i class="icon md-upload"></i>
																	<span class="name-file">
																	Upload file</span>
																	<span class="size-file"></span>
																	<input type="hidden">
																</a>
															</td>
														</tr>

														<tr class="tr-file">
															<td class="label-info">
																<label for="">Package file</label>
															</td>
															<td class="td-form-item">
																<div class="progress-reference progressbar">
																	<div class="up-progress" style="left: 40%"></div>
																</div>
																<a href="#" class="cancel">Cancel</a>
															</td>
														</tr>

														<tr class="tr-file">
															<td class="label-info">
																<label for="">Package file</label>
															</td>
															<td class="td-form-item">
																<div class="form-item">
																	<input type="file" class="upload-file">
																</div>
																<a href="#" class="trigger-file">
																	<i class="icon md-upload"></i>
																	<span class="name-file">abc.mp4</span>
																	<span class="size-file">( 12 mb )</span>
																	<input type="hidden">
																</a>
																<a href="#" class="close-file">
																	<i class="icon md-close-2"></i>
																</a>
															</td>
														</tr>

														<tr>
															<td class="label-info">
																<label for="">Duration</label>
															</td>
															<td class="td-form-item">
																<div class="form-item-wrap">
																	<div class="form-item">
																		<input type="text" placeholder="">
																	</div>
																	<span>days from</span>
																</div>
															</td>
														</tr>

														<tr>
															<td class="label-info">
																<label for="">Mark band</label>
															</td>
															<td class="td-form-item">
																<div class="form-item-wrap">
																	<div class="form-item">
																		<input type="text" placeholder="Title 1 : Consistency">
																	</div>
																	<div class="form-item">
																		<input type="text" placeholder="Score">
																	</div>
																	<div class="course-region-tool">
																		<a href="#" class="edit" title="edit"><i class="icon md-pencil"></i></a>
																		<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
																	</div>
																</div>
																<div class="btn-add">
																	<a href="#">
																		<i class="icon md-plus"></i>
																		Add Criteria
																	</a>
																</div>
															</td>
														</tr>

													</tbody>
												</table>
												
											</div>
										</div>
										<!-- END / DC ASSIGNMENT -->

										<!-- DC ASSIGNMENT -->
										<div class="dc-assignment-info dc-course-item">
											<div class="dc-content-title">
												<h5 class="xsm black">Assignment 1 : title of assignment</h5>
												<div class="course-region-tool">
													<a href="#" class="edit" title="edit"><i class="icon md-pencil"></i></a>
													<a href="#" class="drag" title="drag"><i class="fa fa-arrows"></i></a>
													<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
													<a href="#" class="save" title="save"><i class="fa fa-save"></i></a>
												</div>
											</div>

											<div class="assignment-body dc-item-body">
												<div class="content-item-info">
													<div class="upload-thumb">
														<img src="<?=get_stylesheet_directory_uri()?>/images/video-upload.jpg" alt="">
													</div>
													<div class="upload-cnt">
														<div class="title-file">
														   <span>Title of assignment</span>
														</div>
														<div class="upload-meta">
															<span>Uploaded by Admin . 30, May,2014</span>
														</div>
														<div class="upload-footer">
															<a href="#">Edit</a>
															<a href="#">Preview</a>
															<a href="#">Delete</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- END / DC ASSIGNMENT -->

										<ul class="dc-btn">
											<li>
												<a href="#" class="mc-btn-3 btn-style-7"><i class="icon md-plus"></i>Add Unit</a>
											</li>
											<li>
												<a href="#" class="mc-btn-3 btn-style-7"><i class="icon md-plus"></i>Add quizz</a>
											</li>
											<li>
												<a href="#" class="mc-btn-3 btn-style-7"><i class="icon md-plus"></i>Add Assignment</a>
											</li>
										</ul>

									</div>
									<!-- END / DC SECTION BODY -->

								</div>
								<!-- END / DC SECTION INFO -->

								<!-- BUTTON ADD AND POPUP SECTION -->
								<div class="add-section">
									<a href="#addsection" class="mc-btn-3 btn-style-1 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Section</a>
									<div id="addsection" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">
										<label for="">Section title</label>
										<div class="form-item">
											<input type="text">
										</div>
										<div class="pp-footer">
											<input type="submit" class="mc-btn-3 btn-style-1" value="Save Section">
											<a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>
										</div>
									</div>
								</div>
								<!-- END / BUTTON ADD AND POPUP SECTION -->

							</div>
							<!-- END / SECTIONS -->


							<!-- ADD QUESTION POPUP -->
							<div id="addquestion" class="design-course-popup zoom-anim-dialog mfp-hide">
								<table class="pp-table">
									<tbody>
										<tr class="tr-title">
											<td class="label-info">
												<label for="">Question title</label>
											</td>
											<td class="td-form-item">
												<div class="form-item">
													<input type="text" placeholder="Get your job done">
												</div>
											</td>
										</tr>
							
										<tr class="tr-type">
											<td class="label-info">
												<label for="">Type of question</label>
											</td>
											<td class="td-form-item">
												<div class="mc-select">
													<select class="select" name="" id="all-categories">
														<option value="" selected>Multiple Choice</option>
														<option value="">Multiple Choice</option>
													</select>
												</div>
											</td>
										</tr>
							
										<tr class="tr-desc">
											<td class="label-info">
												<label for="">Content</label>
											</td>
											<td class="td-form-item">
												<div class="form-textarea-wrapper">
													<textarea id="" placeholder="Description here"></textarea>
												</div>
											</td>
										</tr>
							
										<tr>
											<td class="label-info">
												<label for="">Answer</label>
											</td>
											<td class="td-form-item">
												<div class="form-item-wrap">
													<div class="form-item">
														<input type="text" placeholder="#1 Write answer here">
													</div>

													<div class="course-region-tool">
														<a href="#" class="drag" title="drag"><i class="fa fa-arrows"></i></a>
														<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
													</div>
												</div>
												<div class="btn-add">
													<a href="#">
														<i class="icon md-plus"></i>
														Add Answer
													</a>
												</div>
											</td>
										</tr>

										<tr class="tr-footer">
											<td></td>
											<td>
												<input type="submit" class="mc-btn-3 btn-style-1" value="Save question">
												<a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- END / ADD QUESTION POPUP -->
							
							
						</div>
						<!-- END / DESIGN OUTLINE -->

						<!-- DESIGN QUESTION -->
						<div class="tab-pane fade" id="design-question">
							<div class="total-quest">
								<h4 class="sm black">Total Questions</h4>
								<div class="count"><span>5</span> questions</div>
								<div class="new-question">
									<a href="#" class="mc-btn-3 btn-style-7">
										<i class="icon md-plus"></i>New question
									</a>
								</div>
							</div>
							<table class="table-quest">
								<thead>
									<tr>
										<th>Title <span class="caret"></span></th>
										<th>Type <span class="caret"></span></th>
										<th>Description</th>
										<td class="course-region-tool"></th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>Anna Molly 268</td>
										<td>Multiple Choice</td>
										<td>Lorem ipsum dolor sit amet, consectetur</td>
										<td class="course-region-tool">
											<a href="#"><i class="icon md-pencil"></i></a>
											<a href="#"><i class="icon md-recycle"></i></a>
										</td>
									</tr>

									<tr>
										<td>Anna Molly 268</td>
										<td>Multiple Choice</td>
										<td>Lorem ipsum dolor sit amet, consectetur</td>
										<td class="course-region-tool">
											<a href="#"><i class="icon md-pencil"></i></a>
											<a href="#"><i class="icon md-recycle"></i></a>
										</td>
									</tr>

									<tr>
										<td>Anna Molly 268</td>
										<td>Multiple Choice</td>
										<td>Lorem ipsum dolor sit amet, consectetur</td>
										<td class="course-region-tool">
											<a href="#"><i class="icon md-pencil"></i></a>
											<a href="#"><i class="icon md-recycle"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- END / DESIGN QUESTION -->

						<!-- DESIGN ASSIGNMENT -->
						<div class="tab-pane fade" id="design-assignment">
							<div class="total-assignment">
								<h4 class="sm black">Total Assignments</h4>
								<div class="count"><span>3</span> assignments</div>
								<div class="new-question">
									<a href="#" class="mc-btn-3 btn-style-7">
										<i class="icon md-plus"></i>New Assignment
									</a>
								</div>
							</div>
							<table class="table-assignment">
								<thead>
									<tr>
										<th class="count"></th>
										<th>Title</th>
										<td class="course-region-tool"></th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td class="count">1</td>
										<td>Lorem ipsum dolor sit amet, consectetur</td>
										<td class="course-region-tool">
											<a href="#"><i class="icon md-pencil"></i></a>
											<a href="#"><i class="fa fa-arrows"></i></a>
											<a href="#"><i class="icon md-recycle"></i></a>
										</td>
									</tr>

									<tr>
										<td class="count">2</td>
										<td>Lorem ipsum dolor sit amet, consectetur</td>
										<td class="course-region-tool">
											<a href="#"><i class="icon md-pencil"></i></a>
											<a href="#"><i class="fa fa-arrows"></i></a>
											<a href="#"><i class="icon md-recycle"></i></a>
										</td>
									</tr>

									<tr>
										<td class="count">3</td>
										<td>Lorem ipsum dolor sit amet, consectetur</td>
										<td class="course-region-tool">
											<a href="#"><i class="icon md-pencil"></i></a>
											<a href="#"><i class="fa fa-arrows"></i></a>
											<a href="#"><i class="icon md-recycle"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- END / DESIGN ASSIGNMENT -->


					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END / CREATE COURSE CONTENT -->

<?php get_footer(); ?>
