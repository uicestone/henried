<?php

if(isset($_GET['mark-learned'])){
	if(!get_current_user_id()){
		header('HTTP/1.1 401 Unauthorized');
		exit;
	}
	add_user_meta(get_current_user_id(), 'learned_section', $_GET['mark-learned']);
	exit;
}

if(isset($_GET['mark-unlearned'])){
	if(!get_current_user_id()){
		header('HTTP/1.1 401 Unauthorized');
		exit;
	}
	delete_user_meta(get_current_user_id(), 'learned_section', $_GET['mark-learned']);
	exit;
}

$course = get_post($_GET['course_id']);

if(!$course)
{
	exit('Invalid course ID.');
}

global $title; $title = $course->post_title;

$sections = preg_split('/\n+/', get_post_meta($_GET['course_id'], 'sections', true));

foreach($sections as &$s){
	$data = preg_split('/\s*\|\s*/', $s);
	$s = (object) array('title'=>$data[0], 'videos'=>array_slice($data, 1));
}

$section = $sections[$_GET['section_id']];

get_header('learning');
?>

<section id="learning-section" class="learning-section learn-section">
	<div class="container">
		<div class="title-ct">
			<h3><?=$section->title?></h3>
			<div class="tt-right">
				<input type="checkbox" id="markaslearned" value="<?=$course->ID?>-<?=$_GET['section_id']?>"<?php if(current_user_has_learned($course->ID . '-' . $_GET['section_id'])){ ?> checked="checked"<?php } ?>>
				<label for="markaslearned">
					标记为已学
					<i class="icon md-check-2"></i>
				</label>
			</div>
		</div>
		<div class="abc">
		<div class="video embed-responsive embed-responsive-16by9">
			<?php if(!$section->videos[0]){ ?>
			You have no authority to access this video
			<?php }elseif(get_post_meta($course->ID, 'price', true) ==  0 || $_GET['section_id'] < 2 || current_user_ordered($course->ID)){ ?>
			<video controls src="<?=qiniu_get_real_download_url($section->videos[0])?>" class="embed-responsive-item"></video>
			<?php }else{ ?>
			<h2 class="text-center"><i class="fa fa-exclamation-triangle"></i> 尚未购买该课程</h2>
			<?php } ?>
		</div>
		</div>
	</div>
</section>

<?php get_footer('learning'); ?>