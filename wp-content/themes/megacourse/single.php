<?php get_header(); ?>

<!-- SUB BANNER -->
<section class="sub-banner sub-banner-course">
	<div class="awe-static bg-sub-banner-course"></div>
	<div class="container">
		<div class="sub-banner-content">
			<h2 class="text-center"><?=get_the_category()[0]->name?></h2>
		</div>
	</div>
</section>
<!-- END / SUB BANNER -->


<!-- BLOG -->
<section class="blog">

	<div class="container">
		<div class="row">

			<!-- BLOG LIST -->
			<div class="col-md-8">
				<div class="blog-single-content">
					<!-- POST -->
					<div class="post post-single">
						<div class="post-title">
							<h1 class="big"><?php the_title(); ?></h1>
						</div>
						<div class="post-meta">
							<?php echo the_author() ?> 发布于 <?php the_date() ?>
						</div>

						<div class="post-content">
							<?php the_content(); ?>
						</div>

					</div>
					<!-- END / POST -->

				</div>
			</div>
			<!-- END / BLOG LIST -->

			<!-- SIDEBAR -->
			<div class="col-md-3 col-md-offset-1">
				<aside class="blog-sidebar">

					<!-- WIDGET SEARCH -->
					<div class="widget widget_search">
						<h4 class="sm">搜索课程</h4>
						<form>
							<div class="form-item">
								<input type="text">
							</div>
							<div class="form-actions">
								<input type="submit">
							</div>
						</form>
					</div>
					<!-- END / WIDGET SEARCH -->

					<!-- WIDGET CATEGORIES -->
					<div class="widget widget_categories">
						<h4 class="sm">分类</h4>
						<ul>
							<li><a href="#">All</a></li>
							<li><a href="#">Uncategorized</a></li>
							<li><a href="#">Popular</a></li>
							<li><a href="#">New</a>
							</li>
							<li><a href="#">Uncategorized</a></li>
						</ul>
					</div>
					<!-- END / WIDGET CATEGORIES -->

					<!-- WIDGET RECENT POST -->
					<div class="widget widget_recent_post">
						<h4 class="sm">新闻动态</h4>
						<ul>
							<?php foreach(get_posts('category_name=news') as $post){ ?>
							<li>
								<a href="<?=get_the_permalink($post->ID)?>"><?=$post->title?></a>
							</li>
							<?php } ?>
						</ul>
					</div>
					<!-- END / WIDGET RECENT POST -->

				</aside>
			</div>
			<!-- END / SIDEBAR -->


		</div>
	</div>

</section>
<!-- END / BLOG -->

<?php get_footer(); ?>
