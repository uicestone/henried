<?php get_header(); ?>

<?php @$banner = get_posts('post_type=course&category_name=课程中心推荐')[0]; if($banner){ ?>
<!-- SUB BANNER -->
<section class="sub-banner section">
	<div class="awe-parallax bg-profile-feature"></div>
	<div class="awe-overlay overlay-color-3"></div>
	<div class="container">
		<div class="sub-banner-content">
			<h2 class="big"><?=$banner->post_title?></h2>
			<p><?=$banner->post_excerpt?></p>
			<a href="<?=get_permalink($banner-ID)?>" class="mc-btn btn-style-3">查看课程</a>
		</div>
	</div>
</section>
<!-- END / SUB BANNER -->
<?php } ?>

<!-- PAGE CONTROL -->
<section class="page-control">
	<div class="container">
		<div class="page-info">
			<a href="<?=site_url()?>"><i class="icon md-arrow-left"></i>返回首页</a>
		</div>
		<div class="page-view">
			查看方式
			<span class="page-view-info view-grid" title="平铺"><i class="icon md-ico-2"></i></span>
			<span class="page-view-info view-list active" title="列表"><i class="icon md-ico-1"></i></span>
			<!--<div class="mc-select">
				<select class="select" name="" id="all-categories">
					<option value="">All level</option>
					<option value="">2</option>
				</select>
			</div>-->
		</div>
	</div>
</section>
<!-- END / PAGE CONTROL -->

<!-- CATEGORIES CONTENT -->
<section id="categories-content" class="categories-content">
	<div class="container">
		<div class="row">

			<div class="col-md-9 col-md-push-3">
				<div class="content list">
					<div class="row">
						<!-- ITEM -->
						<?php
						$course_args = array('post_type'=>'course', 'posts_per_page'=>-1);
						if(isset($_GET['course_category'])){
							$course_args['category_name'] = $_GET['course_category'];
						}
						if(isset($_GET['course_name'])){
							$course_args['s'] = $_GET['course_name'];
						}
						if(isset($_GET['course_tag'])){
							$course_args['tag'] = $_GET['tag'];
						}
						foreach(get_posts($course_args) as $course){ ?>
						<div class="col-sm-6 col-md-4">
							<div class="mc-item mc-item-2">
								<div class="image-heading">
									<a href="<?=get_the_permalink($course->ID)?>"><?=get_the_post_thumbnail($course->ID, 'course-list')?></a>
								</div>
								<div class="meta-categories"><a href="#"><?=get_the_category($course->ID)[0]->name?></a></div>
								<div class="content-item">
									<h4><a href="<?=get_the_permalink($course->ID)?>"><?=get_the_title($course->ID)?></a></h4>
									<div class="name-author">
										主讲：<a href="#"><?=get_userdata($course->post_author)->display_name?></a>
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
									<!--<div class="price">
										¥<?=$course->price?>
										<span class="price-old">¥<?=$course->price_origin?></span>
									</div>-->
								</div>
							</div>
						</div>
						<?php } ?>
						<!-- END / ITEM -->
					</div>
				</div>
			</div>

			<!-- SIDEBAR CATEGORIES -->
			<div class="col-md-3 col-md-pull-9">
				<aside class="sidebar-categories">
					<div class="inner">

						<!-- WIDGET TOP -->
						<div class="widget">
							<ul class="list-style-block">
								<?php foreach(array('热门课程') as $tag){ ?>
								<li<?php if(isset($_GET['course_tag']) && $_GET['course_tag'] === $tag){ ?> class="current"<?php } ?>><a href="<?=site_url()?>/categories/?course_tag=<?=$tag?>"><?=$tag?></a></li>
								<?php } ?>
							</ul>
						</div>
						<!-- END / WIDGET TOP -->

						<!-- WIDGET CATEGORIES -->
						<div class="widget widget_categories">
							<ul class="list-style-block">
								<?php foreach(array('CMA', 'ACCA') as $course_category){ ?>
								<li<?php if(isset($_GET['course_category']) && $_GET['course_category'] === $course_category){ ?> class="current"<?php } ?>><a href="<?=site_url()?>/categories/?course_category=<?=$course_category?>"><?=$course_category?></a></li>
								<?php } ?>
							</ul>
						</div>
						<!-- END / WIDGET CATEGORIES -->

					</div>
				</aside>
			</div>
			<!-- END / SIDEBAR CATEGORIES -->

		</div>
	</div>
</section>
<!-- END / CATEGORIES CONTENT -->

<?php get_footer(); ?>
