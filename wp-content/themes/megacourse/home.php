<?php get_header(); ?>

<!-- HOME SLIDER -->
<section class="slide" style="background-image: url(images/homeslider/bg.jpg)">
	<div class="container">
		<div class="slide-cn" id="slide-home">
			<!-- SLIDE ITEM -->
			<?php foreach(get_posts('tag=首页推荐') as $post){ ?>
			<div class="slide-item">
				<div class="item-inner">
					<div class="text">
						<h2><?=$post->post_title?></h2>
						<?=wpautop($post->post_excerpt)?>
						<div class="group">
							<a href="<?=get_the_permalink($post->ID)?>" class="mc-btn btn-style-1">查看</a>
						</div>
					</div>

					<div class="img">
						<?=get_the_post_thumbnail($post->ID, 'home-banner')?>
					</div>
				</div>
			</div>  
			<?php } ?>
			<!-- SLIDE ITEM -->     
		</div>
	</div>
</section>
<!-- END / HOME SLIDER -->


<!-- AFTER SLIDER -->
<section id="after-slider" class="after-slider section">
	<div class="awe-color bg-color-1"></div>
	<div class="after-slider-bg-2"></div>
	<div class="container">

		<div class="after-slider-content tb">
			<div class="inner tb-cell">
				<h4>课程搜索</h4>
				<div class="course-keyword">
					<input type="text" placeholder="输入课程名称">
				</div>
				<div class="mc-select-wrap">
					<div class="mc-select">
						<select class="select" name="" id="all-categories">
							<option value="" selected>所有分类</option>
						</select>
					</div>
				</div>
				<!--<div class="mc-select-wrap">
					<div class="mc-select">
						<select class="select" name="" id="beginner-level">
							<option value="" selected>Beginner level</option>
							<option value="">Beginner level 2</option>
							<option value="">Beginner level 3</option>
						</select>
					</div>
				</div>-->
			</div>
			<div class="tb-cell text-right">
				<div class="form-actions">
					<input type="submit" value="搜索课程" class="mc-btn btn-style-1">
				</div>
			</div>
		</div>

	</div>
</section>
<!-- END / AFTER SLIDER -->

<!-- SECTION 1 -->
<section id="mc-section-1" class="mc-section-1 section">
	<div class="container">
		<div class="row">

			<div class="col-md-5">
				<div class="mc-section-1-content-1"> 
					<h2 class="big">线上线下课程管理</h2>
					<p class="mc-text">我们有网络平台，更有线下教室。</p>
					<a href="<?=site_url()?>/about-us/" class="mc-btn btn-style-1">关于我们</a>
				</div>
			</div>

			<div class="col-md-6 col-lg-offset-1">
				<div class="row">
					<div class="col-sm-6">
						<div class="featured-item">
							<i class="icon icon-featured-1"></i>
							<h4 class="title-box text-uppercase">易于掌握</h4>
							<p>特点描述特点描述，特点描述特点描述，特点描述特点描述特点描述，特点描述特点描述。</p>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="featured-item">
							<i class="icon icon-featured-2"></i>
							<h4 class="title-box text-uppercase">参与教学</h4>
							<p>特点描述特点描述，特点描述特点描述，特点描述特点描述特点描述，特点描述特点描述。</p>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="featured-item">
							<i class="icon icon-featured-3"></i>
							<h4 class="title-box text-uppercase">社区支持</h4>
							<p>特点描述特点描述，特点描述特点描述，特点描述特点描述特点描述，特点描述特点描述。</p>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="featured-item">
							<i class="icon icon-featured-4"></i>
							<h4 class="title-box text-uppercase">效果跟踪</h4>
							<p>特点描述特点描述，特点描述特点描述，特点描述特点描述特点描述，特点描述特点描述。</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- END / SECTION 1 -->



<!-- SECTION 2 -->
<section id="mc-section-2" class="mc-section-2 section">
	<div class="awe-parallax bg-section1-demo"></div>
	<div class="overlay-color-1"></div>
	<div class="container">
		<div class="section-2-content">
			<div class="row">

				<div class="col-md-5">
					<div class="ct">
						<h2 class="big">在线学习从未如此简单</h2>
						<p class="mc-text">特点描述特点描述，特点描述特点描述，特点描述特点描述特点描述，特点描述特点描述。</p>

						<a href="<?=site_url()?>/tutorial/" class="mc-btn btn-style-3">学习如何使用</a>
					</div>
				</div>

				<div class="col-md-7">
					<div class="image">
						<img src="<?=get_stylesheet_directory_uri()?>/images/image.png" alt="">
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<!-- END / SECTION 2 -->


<!-- SECTION 3 -->
<section id="mc-section-3" class="mc-section-3 section">
	<div class="container">
		<!-- FEATURE -->
		<div class="feature-course">
			<h4 class="title-box text-uppercase">热门课程</h4>
			<a href="categories.html" class="all-course mc-btn btn-style-1">查看全部</a>
			<div class="row">
				<div class="feature-slider">
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
								<span class="price-old">$134</span>
							</div>
						</div>
					</div>
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
								<span>By <a href="#">Name of Mr or Mrs</a></span>
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
								Free
							</div>
						</div>
					</div>
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
								<span>By <a href="#">Name of Mr or Mrs</a></span>
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
								<span class="price-old">$134</span>
							</div>
						</div>
					</div>

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
								<span>By <a href="#">Name of Mr or Mrs</a></span>
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
							</div>
						</div>
					</div>

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
								<span>By <a href="#">Name of Mr or Mrs</a></span>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END / FEATURE -->
	</div>
</section>
<!-- END / SECTION 3 -->



<!-- BEFORE FOOTER -->
<section id="before-footer" class="before-footer">
	<div class="container">
		<div class="row">

			<div class="col-lg-8">
				<div class="mc-count-item">
					 <h4>总课程</h4>
					 <p><span class="countup">0</span></p>
				 </div>
				<div class="mc-count-item">
					 <h4>课程总学习数</h4>
					 <p><span class="countup">0</span></p>
				 </div>
				 <div class="mc-count-item">
					 <h4>学员总数</h4>
					 <p><span class="countup">0</span></p>
				 </div>
				 <div class="mc-count-item">
					 <h4>已支付学费</h4>
					 <p>¥ <span class="countup">0</span></p>
				 </div>
			</div>

			<div class="col-lg-4">
				<div class="before-footer-link">
					<a href="<?=site_url()?>/login/" class="mc-btn btn-style-2">马上注册</a>
					<!--<a href="#" class="mc-btn btn-style-1">Become a teacher</a>-->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END / BEFORE FOOTER -->

<?php get_footer(); ?>
