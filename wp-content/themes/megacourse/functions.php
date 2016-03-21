<?php

add_action('init', function(){

	// 禁止IE10以下版本访问
	preg_match('/MSIE\s*(\S+?);/', $_SERVER['HTTP_USER_AGENT'], $match);

	if($match && $match[1] < 10)
	{
		header('Location: http://windows.microsoft.com/zh-cn/internet-explorer/download-ie');
		exit;
	}

	wp_register_style('bootstrap', get_stylesheet_directory_uri() . '/css/library/bootstrap.min.css', array(), '3.2.0');
	wp_register_style('font-awesome', get_stylesheet_directory_uri() . '/css/library/font-awesome.min.css', array(), '4.2.0');
	wp_register_style('owl.carousel', get_stylesheet_directory_uri() . '/css/library/owl.carousel.css', array(), '1.18');
	wp_register_style('md-font', get_stylesheet_directory_uri() . '/css/md-font.css', array());
	wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', array(), '2016-03-20');
	
	wp_register_script('bootstrap', get_stylesheet_directory_uri() . '/js/library/bootstrap.min.js', array('jquery'), '3.2.0', true);
	wp_register_script('jquery.owl.carousel', get_stylesheet_directory_uri() . '/js/library/jquery.owl.carousel.js', array('jquery'), '1.3.2', true);
	wp_register_script('jquery.appear', get_stylesheet_directory_uri() . '/js/library/jquery.appear.min.js', array('jquery'), null, true);
	wp_register_script('jquery.easing', get_stylesheet_directory_uri() . '/js/library/jquery.easing.min.js', array('jquery'), null, true);
	wp_register_script('perfect-scrollbar', get_stylesheet_directory_uri() . '/js/library/perfect-scrollbar.min.js', array('jquery'), '0.5.6', true);
	wp_register_script('scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '2015-12-17', true);
});

add_action('wp_enqueue_scripts', function(){
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('owl.carousel');
	wp_enqueue_style('md-font');
	wp_enqueue_style('style');
	
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('jquery.owl.carousel');
	wp_enqueue_script('jquery.appear');
	wp_enqueue_script('jquery.easing');
	wp_enqueue_script('perfect-scrollbar');
	wp_enqueue_script('scripts');
});

add_action('after_switch_theme', function(){
	
	if (!$handle = opendir(get_template_directory())){
		return;
	}
	
	while (false !== ($entry = readdir($handle))) {
		preg_match('/^page-(.*).php/', $entry, $matches);
		
		if(!$matches){
			continue;
		}
		
		$page_name = ucwords(str_replace('-', ' ', $matches[1]));
		$results = get_posts(array('name'=>sanitize_title($page_name), 'post_type'=>'page'));
		
		if($results){
			continue;
		}
		
		wp_insert_post(array(
			'post_title'=>$page_name,
			'post_type'=>'page',
			'post_status'=>'publish'
		));
	}
	closedir($handle);
});

register_nav_menu('main', '主导航');

add_image_size('home-banner', 500, 500, true);
add_image_size('course-list', 270, 161, true);
add_image_size('course-intro', 450, 258, true);

add_theme_support('post-thumbnails');

add_action('init', function(){
	register_post_type('course', array(
		'label'=>'课程',
		'labels'=>array(
			'all_items'=>'所有课程',
			'add_new'=>'添加课程',
			'add_new_item'=>'新课程',
		),
		'public'=>true,
		'supports'=>array('title', 'author', 'custom-fields', 'comments', 'thumbnail'),
		'taxonomies'=>array('category', 'post_tag'),
		'menu_icon'=>'dashicons-book-alt',
		'has_archive'=>true
	));

	register_post_type('course_order', array(
		'label'=>'订单',
		'labels'=>array(
			'all_items'=>'所有订单',
			'add_new'=>'添加订单',
			'add_new_item'=>'新订单',
		),
		'show_ui'=>true,
		'show_in_menu'=>true,
		'supports'=>array('title', 'author', 'excerpt', 'custom-fields', 'comments'),
		'taxonomies'=>array('category', 'post_tag'),
		'menu_icon'=>'dashicons-cart',

		// 订单界面可以用名称搜索用户和课程，并保存为ID
	));
});

// 定义后台课程列表展现方式

// 保存课程后，检查是否有未转码合并的章节视频，处理
add_action('save_post_course', function(){
	
});

// 定义后台订单列表展现方式

// 保存订单后，将订单课程同步到用户已购买课程
add_action('save_post_course_order', function($post_id){
	$user_id = get_post_meta($post_id, 'user_id', true);

	$other_orders = get_posts(array('meta_key'=>'user_id', 'meta_value'=>$user_id, 'post_type'=>'course_order'));

	$ordered_course_ids = array();

	foreach($other_orders as $order)
	{
		$ordered_course_ids = array_merge($ordered_course_ids, get_post_meta($order->ID, 'course_id'));
	}

	sync_user_meta($user_id, 'ordered_course_id', $ordered_course_ids);
});


function current_user_has_learned($course_section){
	$learned_sections = get_user_meta(get_current_user_id(), 'learned_section');
	return in_array($course_section, $learned_sections);
}

function current_user_learned_sections($course_id){
	$learned_sections = get_user_meta(get_current_user_id(), 'learned_section');
	return array_filter($learned_sections, function($learned_section) use($course_id){
		return strpos($learned_section, $course_id . '-') === 0;
	});
}

function current_user_ordered($course_id){
	$ordered_course_ids = get_user_meta(get_current_user_id(), 'ordered_course_id');
	return in_array($course_id, $ordered_course_ids);
}

/**
 *
 * Synchronize a set of user meta value.
 * Will only add and remove the difference.
 *
 * @param int $user_id
 * @param string $meta_key
 * @param array $new_values
 * @param array $old_values optional
 */
function sync_user_meta($user_id, $meta_key, array $new_values, $old_values = null){

	if(is_null($old_values)){
		$old_values = get_user_meta($user_id, $meta_key);
	}
	
	foreach(array_diff($new_values, $old_values) as $value_to_add){
		add_user_meta($user_id, $meta_key, $value_to_add);
	}
	foreach(array_diff($old_values, $new_values) as $value_to_delete){
		delete_user_meta($user_id, $meta_key, $value_to_delete);
	}

}

