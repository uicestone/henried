<?php
/*
Plugin Name: PostViews
Plugin URI: http://wpjam.net/item/wpjam-basic/
Description: 统计日志阅读数以及Feed在RSS或者客户端中的阅读数。
Version: 1.0
*/

//显示浏览次数
function the_views() {
	$post_views			= wpjam_get_post_views(get_the_ID());
	$post_feed_views	= wpjam_get_post_feed_views(get_the_ID());

	if(is_single()){	//因为累加的过程在 footer，所以显示的时候先+1
		$post_views = $post_views+1;
	}

	if(current_user_can('manage_options')){
		echo '<span class="view">浏览：'.$post_views.' | '.$post_feed_views.'</span>'; 
	}else{
		$views = $post_views + $post_feed_views;
		echo '<span class="view">浏览：'.$views.'</span>'; 
	}
}

function wpjam_get_post_total_view($post_id){
	return wpjam_get_post_views($post_id) + wpjam_get_post_feed_views($post_id) + apply_filters('wpjam_post_views_addon', 0);
}

function wpjam_get_post_views($post_id, $type='views'){
	$post_views = wp_cache_get($post_id, $type);
	if($post_views === false){
		$post_views = get_post_meta($post_id, $type, true);
		if(!$post_views) $post_views = 0;
	}
	return $post_views;
}

function wpjam_get_post_feed_views($post_id){
	return wpjam_get_post_views($post_id, 'feed_views');
}

function wpjam_update_post_views($pos_id, $type='views'){
	$post_views = wpjam_get_post_views($pos_id, $type)+1;

	if(wp_using_ext_object_cache()){
		wp_cache_set($pos_id, $post_views, $type);
		if($post_views%10 == 0){
			update_post_meta($pos_id, $type, $post_views);   
		}
	}else{
		update_post_meta($pos_id, $type, $post_views);
	}
}

function wpjam_update_post_feed_views($post_id){
	return wpjam_update_post_views($post_id, 'feed_views');
}

add_action('wp_footer','wpjam_post_view_footer');
function wpjam_post_view_footer(){
	if(is_single()){ //只统计日志的浏览次数
		wpjam_update_post_views(get_the_ID());
	}
}

add_filter('wpjam_rewrite_rules', 'wpjam_post_views_rewrite_rules');
function wpjam_post_views_rewrite_rules($wpjam_rewrite_rules){
	$wpjam_rewrite_rules['views/([0-9]+)\.png$']	= 'index.php?module=postviews&action=feed&p=$matches[1]';
	$wpjam_rewrite_rules['views/([0-9]+)\.js$']		= 'index.php?module=postviews&action=post&p=$matches[1]';
	$wpjam_rewrite_rules['views.js$']				= 'index.php?module=postviews&action=posts';
	return $wpjam_rewrite_rules;
}

add_filter('wpjam_template', 'wpjam_post_views_template', 10, 3);
function wpjam_post_views_template($wpjam_template, $module, $action){
	if($module == 'postviews'){
		return WPJAM_BASIC_PLUGIN_DIR.'template/postviews.php';
	}
	return $wpjam_template;
}

add_action('pre_get_posts', 'wpjam_post_views_pre_get_posts');
function wpjam_post_views_pre_get_posts(&$wp_query){
	$module = get_query_var('module');
	if($module == 'postviews'){	// 不指定 post_type ，默认查询 post，这样custom post type 的文章页面就会显示 404
		$wp_query->set('post_type', 'any');
	}
}
