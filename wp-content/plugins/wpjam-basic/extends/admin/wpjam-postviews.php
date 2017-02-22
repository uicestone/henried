<?php
add_filter('manage_posts_columns', 'wpjam_postviews_admin_add_column',10,2);
function wpjam_postviews_admin_add_column($posts_columns, $post_type){
	$post_type_object = get_post_type_object($post_type);
	if(!empty($post_type_object->postviews_column) || $post_type == 'post'){
		$posts_columns['views'] = '浏览';
	}
	return $posts_columns;
}
add_action('manage_posts_custom_column','wpjam_postviews_admin_show',10,2);
function wpjam_postviews_admin_show($column_name,$id){
	if ($column_name != 'views') return;
	echo "<span style='color:red;'>".wpjam_get_post_views($id)."</span> | ".wpjam_get_post_feed_views($id)."";
}

add_filter('wpjam_post_type_args', 'wpjam_postviews_post_type_args');
function wpjam_postviews_post_type_args($post_type_args){
	$post_type_args['postviews_column'] = isset($post_type_args['postviews_column'])?$post_type_args['postviews_column']:true;
	return $post_type_args;
}