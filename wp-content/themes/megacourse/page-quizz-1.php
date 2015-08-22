<?php get_header('learning'); ?>

<section id="quizz-intro-section" class="quizz-intro-section learn-section">
	<div class="container">

		<div class="title-ct">
			<h3><strong>Quizz 1</strong>Duis vel ullamcorper mauris, eu pretium felis. Duis gravida laoreet velit.</h3>
			<div class="tt-right">
				<a href="#" class="skip"><i class="icon md-arrow-right"></i>Skip quizz</a>
			</div>
		</div>

		<div class="question-content-wrap">
			<div class="row">
				<div class="col-md-8">
					<div class="question-content">
						<h4 class="sm">Question 1 - Multiple choice</h4>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
						<div class="answer">
							<h4 class="sm">Answer</h4>
							<ul class="answer-list">
								<li>
									<input type="radio" name="radio-1" id="radio-1">
									<label for="radio-1">
										<i class="icon icon_radio"></i>
										sed diam nonummy nibh euismod tincidunt ut laoreet
									</label>
								</li>
								<li>
									<input type="radio" name="radio-1" id="radio-2">
									<label for="radio-2">
										<i class="icon icon_radio"></i>
										ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequa
									</label>
								</li>
								<li>
									<input type="radio" name="radio-1" id="radio-3">
									<label for="radio-3">
										<i class="icon icon_radio"></i>
										ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequa
									</label>
								</li>
							</ul>

						</div>
						<a href="#" class="mc-btn btn-style-6">Next question</a>
					</div>
				</div>


				<div class="col-md-4">
					<aside class="question-sidebar">
						<div class="score-sb">
							<h4 class="title-sb sm bold">Total score<span>100</span></h4>
							<ul>
								<li class="active"><i class="icon"></i>Question 1<span>20</span></li>
								<li><i class="icon"></i>Question 2<span>20</span></li>
								<li><i class="icon"></i>Question 3<span>20</span></li>
								<li><i class="icon"></i>Question 4<span>20</span></li>
								<li><i class="icon"></i>Question 5<span>20</span></li>
							</ul>
						</div>
						<input type="submit" value="Submit all answer" class="submit mc-btn btn-style-1">
					</aside>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer('learning'); ?>