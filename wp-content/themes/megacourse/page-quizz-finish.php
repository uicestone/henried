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
						<h4 class="sm">You got 3/5 Questions right</h4>
						
						<table class="table-question">
							<thead>
								<tr>
									<th colspan="2">Correction</th>
									<th class="right-answer">% Right Answer</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td class="td-quest">1. What is this thing ? just quote a limit character of ...</td>
									<td class="td-right-answer">10%</td>
								</tr>
								<tr>
									<td><i class="icon icon-err md-close-2"></i></td>
									<td class="td-quest">2. What is number limit character of full question quoted?</td>
									<td class="td-right-answer">99%</td>
								</tr>
								<tr>
									<td><i class="icon icon-val md-check-2"></i></td>
									<td class="td-quest">3. What is number limit character of full question quoted?</td>
									<td class="td-right-answer">30%</td>
								</tr>
								<tr>
									<td><i class="icon icon-val md-check-2"></i></td>
									<td class="td-quest">4. What is this thing ? just quote a limit character of ...</td>
									<td class="td-right-answer">48%</td>
								</tr>
								<tr>
									<td><i class="icon icon-val md-check-2"></i></td>
									<td class="td-quest">5. What is this thing ? just quote a limit character of ...</td>
									<td class="td-right-answer">19%</td>
								</tr>
							</tbody>
						</table>
							
						<div class="form-action">
							<input type="submit" value="Redo quizz" class="mc-btn btn-style-6">
							<input type="submit" value="Next Unit" class="mc-btn btn-style-6">
						</div>
					</div>
				</div>


				<div class="col-md-4">
					<aside class="question-sidebar">
						<div class="score-sb">
							<h4 class="title-sb sm bold">Total score<span>60</span></h4>
							<ul>
								<li><i class="icon"></i>Question 1<span>20</span></li>
								<li class="err"><i class="icon"></i>Question 2<span>20</span></li>
								<li class="active"><i class="icon"></i>Question 3<span>20</span></li>
								<li class="active"><i class="icon"></i>Question 4<span>20</span></li>
								<li class="active"><i class="icon"></i>Question 5<span>20</span></li>
							</ul>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer('learning'); ?>