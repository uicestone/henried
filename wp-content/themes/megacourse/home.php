<?php get_header(); ?>

<!-- HOME SLIDER -->
<section class="slide" style="background-image: url('<?=get_stylesheet_directory_uri()?>/images/homeslider/bg.jpg')">
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
		<form action="<?=site_url()?>/categories/">
			<div class="after-slider-content tb">
				<div class="inner tb-cell">
					<h4>课程搜索</h4>
					<div class="course-keyword">
							<input type="text" name="course_name" placeholder="输入课程名称">
					</div>
					<div class="mc-select-wrap">
						<div class="mc-select">
							<select class="select" name="course_category" id="all-categories">
								<option value="" selected>证书分类</option>
								<option value="cima">CIMA</option>
								<option value="acca">ACCA</option>
								<option value="cma">CMA</option>
							</select>
						</div>
					</div>
				</div>
				<div class="tb-cell text-right">
					<div class="form-actions">
						<input type="submit" value="搜索课程" class="mc-btn btn-style-1">
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
<!-- END / AFTER SLIDER -->

<!-- SECTION 1 -->
<section id="mc-section-1" class="mc-section-1 section">
	<div class="container">
		<div class="row">

			<?php $headline = get_posts('category_name=news&posts_per_page=1')[0]; ?>
			<div class="col-md-5">
				<div class="mc-section-1-content-1"> 
					<h2 class="big"><?=$headline->post_title?></h2>
					<p class="mc-text"><?=wp_trim_words(strip_tags($headline->post_content), 150)?></p>
					<a href="<?=site_url()?>/news/" class="mc-btn btn-style-1">更多动态</a>
				</div>
			</div>

			<div class="col-md-6 col-lg-offset-1">
				<div class="row">
					<?php foreach(get_posts('category_name=news&posts_per_page=4&offset=1') as $index => $news){ ?>
					<div class="col-sm-6">
						<div class="featured-item">
							<i class="icon icon-featured-<?=$index + 1?>"></i>
							<h4 class="title-box text-uppercase"><?=$news->post_title?></h4>
							<p><?=wp_trim_words(strip_tags($news->post_content), 55)?></p>
						</div>
					</div>
					<?php } ?>
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
			<a href="<?=site_url()?>/categories/" class="all-course mc-btn btn-style-1">查看全部</a>
			<div class="row">
				<div class="feature-slider">
					<?php foreach(get_posts('post_type=course&tag=featured') as $course){ ?>
					<div class="mc-item mc-item-1">
						<div class="image-heading">
							<a href="<?=get_the_permalink($course->ID)?>"><?=get_the_post_thumbnail($course->ID, 'course-list')?></a>
						</div>
						<div class="meta-categories"><a href="#"><?=get_the_category($course->ID)[0]->name?></a></div>
						<div class="content-item">
							<div class="image-author"></div>
							<h4><a href="<?=get_the_permalink($course->ID)?>"><?=get_the_title($course->ID)?></a></h4>
							<div class="name-author">
								主讲：<a href="#"><?=get_userdata($course->post_author)->display_name;?></a>
							</div>
						</div>
						<div class="ft-item">
							<div class="rating">
								<?php for($i = 0; $i < 5; $i ++){ ?>
								<a href="#"<?php if($course->stars > $i) { ?> class="active"<?php } ?>></a>
								<?php } ?>
							</div>
							<div class="view-info">
								<i class="icon md-users"></i>
								<?=$course->sells?>
							</div>
							<div class="comment-info">
								<i class="icon md-comment"></i>
								<?=$course->comments?>
							</div>
							<div class="price">
								¥<?=$course->price?>
								<span class="price-old">¥<?=$course->price_origin?></span>
							</div>
						</div>
					</div>
					<?php } ?>
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
					 <p><span class="countup"><?=count(get_posts('type=course')) + 14?></span></p>
				 </div>
				<div class="mc-count-item">
					 <h4>课程总学习数</h4>
					 <p><span class="countup">2934</span></p>
				 </div>
				 <div class="mc-count-item">
					 <h4>学员总数</h4>
					 <p><span class="countup"><?=count(get_users()) + 468?></span></p>
				 </div>
			</div>

			<div class="col-lg-4">
				<div class="before-footer-link">
					<a href="<?=site_url()?>/register/" class="mc-btn btn-style-2">马上注册</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END / BEFORE FOOTER -->

<?php get_footer(); ?>
