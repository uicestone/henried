<?php

$sections = explode("\n", get_post_meta(get_the_ID(), 'sections', true));

foreach($sections as &$s){
	$data = preg_split('/\s*\|\s*/', $s);
	$s = (object) array('title'=>$data[0], 'videos'=>array_slice($data, 1));
}

get_header(); the_post();
?>

 <!-- SUB BANNER -->
<section class="sub-banner sub-banner-course">
	<div class="awe-static bg-sub-banner-course"></div>
	<div class="container">
		<div class="sub-banner-content">
			<h2 class="text-center"><?php the_title(); ?></h2>
		</div>
	</div>
</section>
<!-- END / SUB BANNER -->


<!-- COURSE -->
<section class="course-top">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="sidebar-course-intro">
					<!-- CURRENT PROGRESS -->
					<div class="current-progress">
						<h4 class="sm black">学习进度</h4>
						<div class="percent">完成了 <span class="count"><?=round(count(current_user_learned_sections(get_the_ID())) / count($sections) * 100, 1)?>%</span></div>
						<div class="progressbar">
							<div class="progress-run"></div>
						</div>
						<ul class="current-outline">
							<li><span><?=count($sections)?></span>章节</li>
							<!--<li><span>1</span>quizzes</li>
							<li><span>30</span>units</li>
							<li><span>5</span>assignments</li>-->
						</ul>
					</div>
					<!-- END / CURRENT PROGRESS -->
					<?php if($sections[0]->videos[0]){ ?>
					<div class="video-course-intro">
						<div class="video embed-responsive embed-responsive-16by9">
							<video controls controlsList="nodownload" src="<?=qiniu_get_real_download_url($sections[0]->videos[0])?>" class="embed-responsive-item"></video>
						</div>
					</div>
					<?php } ?>
					<div class="new-course">
						<div class="item course-code">
							<i class="icon md-barcode"></i>
							<h4><a href="#">课程编号</a></h4>
							<p class="detail-course"># <?=get_post_meta(get_the_ID(), 'code', true)?></p>
						</div>
						<div class="item course-code">
							<i class="icon md-time"></i>
							<h4><a href="#">学习周期</a></h4>
							<p class="detail-course"><?=get_post_meta(get_the_ID(), 'duration', true)?></p>
						</div>
<!--						<div class="item course-code">
							<i class="icon md-img-check"></i>
							<h4><a href="#">开放时间</a></h4>
							<p class="detail-course">25 May 2014</p>
						</div>-->
					</div>
					<hr class="line">
					<div class="about-instructor">
						<h4 class="xsm black bold">讲师介绍</h4>
						<ul>
							<li>
								<div class="image-instructor text-center">
									<?=do_shortcode('[avatar user=' . get_the_author()->ID . ']')?>
								</div>
								<div class="info-instructor">
									<cite class="sm black"><a href="#"><?php the_author(); ?></a></cite>
									<!--<a href="#"><i class="fa fa-star"></i></a>-->
									<a href="<?=get_the_author_meta('user_email')?>"><i class="fa fa-envelope"></i></a>
									<a href="#"><i class="fa fa-check-square"></i></a>
									<?=wpautop(get_the_author_meta('description'))?>
								</div>
							</li>
						</ul>
					</div>
					<hr class="line">
					<!--<div class="widget widget_equipment">
						<i class="icon md-config"></i>
						<h4 class="xsm black bold">Equipment</h4>
						<div class="equipment-body">
							<a href="#">Photoshop CC</a>,
							<a href="#">Illustrator CC</a>
						</div>
					</div>-->
					<!--	<div class="widget widget_tags">
						<i class="icon md-download-2"></i>
						<h4 class="xsm black bold">涉及知识点</h4>
						<div class="tagCould">
							<a href="#">Design</a>, 
							<a href="#">Photoshop</a>, 
							<a href="#">Illustrator</a>, 
							<a href="">Art</a>, 
							<a href="">Graphic Design</a>
						</div>
					</div>
					<div class="widget widget_share">
						<i class="icon md-forward"></i>
						<h4 class="xsm black bold">分享课程</h4>
						<div class="share-body">
							<a href="#" class="twitter" title="微博">
								<i class="icon md-twitter"></i>
							</a>
							<a href="#" class="pinterest" title="微信">
								<i class="icon md-pinterest-1"></i>
							</a>
						</div>
					</div>-->
				</div>
			</div>	
			<div class="col-md-7">
				<div class="tabs-page">
					<!--<ul class="nav-tabs" role="tablist">
						<li class="active"><a href="#introduction" role="tab" data-toggle="tab">课程简介</a></li>
						<li><a href="#outline" role="tab" data-toggle="tab">章节大纲</a></li>
					</ul>-->
					<!-- Tab panes -->
					<div class="tab-content">
						
						<!-- INTRODUCTION -->
						<div class="tab-pane fade in active" id="introduction">
							<h4 class="sm black bold">Introduction</h4>
							<?php the_excerpt(); ?>
						</div>
						<!-- END / INTRODUCTION -->

						<!-- OUTLINE -->
						<div class="tab-pane fade in active" id="outline">

							<div class="section-outline">
								<h4 class="tit-section xsm"><?php the_title(); ?></h4>
								<ul class="section-list">
									<?php foreach($sections as $index => $section){ ?>
									<li<?php if(current_user_has_learned(get_the_ID() . '-' . $index)){ ?> class="o-view"<?php } ?>>
										<div class="count"><span><?=$index + 1?></span></div>
										<div class="list-body">
											<i class="icon md-camera"></i>
											<p><a href="<?=site_url()?>/learning/?course_id=<?=get_the_ID()?>&section_id=<?=$index?>"><?=$section->title?></a></p>
											<div class="data-lessons">
												<span><?=$section->duration?></span>
											</div>
											<!--<div class="download">
												<a href="#"><i class="icon md-download-1"></i></a>
												<div class="download-ct">
													<span>Reference 12 mb</span>
												</div>
											</div>-->
											<div class="div-x"><i class="icon md-check-2"></i></div>
											<div class="line"></div>
										</div>
									</li>
									<?php } ?>
								</ul>
							</div>

						</div>
						<!-- END / OUTLINE -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END / COURSE TOP -->

<?php get_footer(); ?>
