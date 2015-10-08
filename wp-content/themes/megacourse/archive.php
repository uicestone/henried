<?php get_header(); ?>

<!-- SUB BANNER -->
<section class="sub-banner sub-banner-course">
	<div class="awe-static bg-sub-banner-course"></div>
	<div class="container">
		<div class="sub-banner-content">
			<h2 class="text-center"><?php single_cat_title(); ?></h2>
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
				<div class="blog-list-content">
					<?php while(have_posts()): the_post(); ?>
					<!-- POST -->
					<div class="post">
						<!-- POST MEDIA -->
						<div class="post-media">
							<div class="image-thumb">
								<?php the_post_thumbnail('medium-thumbnail'); ?>
							</div>
						</div>
						<!-- END / POST MEDIA -->

						<!-- POST BODY -->
						<div class="post-body">
							<div class="post-title">
								<h3 class="md"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
							<div class="post-meta">
								<?php the_author(); ?>, <?php the_date(); ?>
							</div>
							<div class="post-content">
								<?php the_excerpt(); ?>
							</div>
							<div class="post-link">
								<a href="<?php the_permalink(); ?>">
									<i class="fa fa-play-circle-o"></i>
									查看全文
								</a>
							</div>
						</div>
						<!-- END / POST BODY -->
					</div>
					<!-- END / POST -->
					<?php endwhile; ?>
					<div class="pager">
						<?=paginate_links(array('type'=>'list', 'prev_text'=>'<', 'next_text'=>'>'))?>
					</div>
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
						<h4 class="sm">课程分类</h4>
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

				</aside>
			</div>
			<!-- END / SIDEBAR -->

		</div>
	</div>

</section>
<!-- END / BLOG -->

<?php get_footer(); ?>
