<?php get_header('learning'); ?>

<section id="quizz-intro-section" class="quizz-intro-section learn-section">
	<div class="container">

		<div class="title-ct">
			<h3><strong>Assignment 1</strong>Duis vel ullamcorper mauris, eu pretium felis. Duis gravida laoreet velit.</h3>
		</div>

		<div class="question-content-wrap">
			<div class="row">
				<div class="col-md-8">
					<div class="question-content">
						<h4 class="sm bold">Introduction</h4>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>

						<div class="quest-list">
							<h4 class="sm bold">Requirement</h4>
							<ul class="list-disc">
								<li>sed diam nonummy nibh euismod tincidunt ut laoreet</li>
								<li>ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequa</li>
							</ul>
						</div>

						<div class="submityourwork">
							<h4 class="sm bold">Submit your work</h4>

							<div class="text-form-editor">
								<img src="<?=get_stylesheet_directory_uri()?>/images/editor-demo-1.jpg" alt="">
								<input type="text" placeholder="Title of text">
								<textarea placeholder="Your content start here"></textarea>
							</div>
						</div>
						
						
						<div class="form-action">
							<input type="submit" value="Upload file"  class=" submit mc-btn-3 btn-style-1">
							<input type="submit" value="Submit"  class=" submit mc-btn-3 btn-style-1">
						</div>
					</div>
				</div>


				<div class="col-md-4">
					<aside class="question-sidebar">
						<div class="download-file-learn">
							<a href="#" class="mc-btn btn-style-1">
								<i class="icon md-download-1"></i>
								Full instruction.zip (12mb)
							</a>
						</div>
						<div class="score-sb">
							<h4 class="title-sb sm bold">Total score<span>60</span></h4>
							<ul>
								<li>Criteria 1<span>20</span></li>
								<li class="err">Criteria 2<span>20</span></li>
								<li class="active">Criteria 3<span>20</span></li>
								<li class="active">Criteria 4<span>20</span></li>
								<li class="active">Criteria 5<span>20</span></li>
							</ul>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer('learning'); ?>