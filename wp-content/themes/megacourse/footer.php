		<!-- FOOTER -->
		<footer id="footer" class="footer">
			<div class="first-footer">
				<div class="container">
					<div class="row">

						<div class="col-md-4">
							<div class="widget megacourse">
								<h3 class="md">Henried Finance</h3>
								<p>公司介绍公司介绍公司介绍公司介绍，公司介绍公司介绍，公司介绍公司介绍公司介绍公司介绍。</p>
								<!--<a href="#" class="mc-btn btn-style-1">Get started</a>-->
							</div>
						</div>

						<div class="col-md-4">
							<div class="widget widget_latest_new">
								<h3 class="sm">最新动态</h3>
								<ul>
									<?php foreach(get_posts('category_name=news') as $post){ ?>
									<li>
										<a href="<?=get_the_permalink($post->ID)?>">
											<div class="image-thumb">
												<?=get_the_post_thumbnail($post->ID, 'thumbnail')?>
											</div>
											<span><?=$post->post_title?></span>
										</a>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>

						<div class="col-md-4">
							<div class="widget quick_link">
								<h3 class="sm">Quick Links</h3>
								<ul class="list-style-block">
									<li><a href="#">关于我们</a></li>
									<li><a href="#">使用协议</a></li>
									<li><a href="#">FAQ</a></li>
									<li><a href="#">用户支持</a></li>
									<li><a href="#">联系我们</a></li>
								</ul>
							</div>
						</div>

						<!--	<div class="col-md-4">
							<div class="widget news_letter">
								<div class="awe-static bg-news_letter"></div>
								<div class="overlay-color-3"></div>
								<div class="inner">
									<div class="letter-heading">
										<h3 class="md">News letter</h3>
										<p>Don’t miss a course sale! Join our network today and keep it up!</p>
									</div>
									<div class="letter">
										<form>
											<input class="input-text" type="text">
											<span class="no-spam">* No spam guaranteed</span>
											<input type="submit" value="Submit now" class="mc-btn btn-style-2">
										</form>
									</div>
								</div>
							</div>
						</div>-->

					</div>
				</div>
			</div>

			<div class="second-footer">
				<div class="container">
					<div class="contact">
						<div class="email">
							<i class="icon md-email"></i>
							<a href="#">course@henried.com</a>
						</div>
						<div class="phone">
							<i class="fa fa-mobile"></i>
							<span>021-60000000</span>
						</div>
						<div class="address">
							<i class="fa fa-map-marker"></i>
							<span>上海市黄浦区南京西路</span>
						</div>
					</div>
					<p class="copyright">Copyright © 2015 Henried Finance. All rights reserved.</p>
				</div>
			</div>
		</footer>
		<!-- END / FOOTER -->

		</div>
		<!-- END / PAGE WRAP -->

		<!-- Load jQuery -->
		<?php wp_footer(); ?>
	</body>
</html>