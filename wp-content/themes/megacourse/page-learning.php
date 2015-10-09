<?php

$course = get_post($_GET['course_id']);

if(!$course)
{
	exit('Invalid course ID.');
}

global $title; $title = $course->post_title;

$sections = preg_split('/\n+/', get_post_meta($_GET['course_id'], 'sections', true));

foreach($sections as &$s){
	$data = preg_split('/\s*\|\s*/', $s);
	$s = (object) array('title'=>$data[0], 'video'=>$data[1]);
}

$section = $sections[$_GET['section_id']];

get_header('learning');
?>

<section id="learning-section" class="learning-section learn-section">
	<div class="container">
		<div class="title-ct">
			<h3><?=$section->title?></h3>
			<div class="tt-right">
				<input type="checkbox" id="markaslearned">
				<label for="markaslearned">
					标记为已学
					<i class="icon md-check-2"></i>
				</label>
			</div>
		</div>
		<div class="abc">
		<div class="video embed-responsive embed-responsive-16by9">
			<iframe src="<?=qiniu_get_real_download_url($section->video)?>" class="embed-responsive-item"></iframe>
		</div>
		</div>
	</div>
</section>

<?php get_footer('learning'); ?>