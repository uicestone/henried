<?php
add_action('wp_head','wpjam_ogp_head');
function wpjam_ogp_head(){
	if(is_single()){
		//global $post;
?>
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:description" content="<?php echo get_post_excerpt();?>" />
<?php 
if(function_exists('wpjam_get_post_thumbnail_uri')){
	$thumb = wpjam_get_post_thumbnail_uri();
}else{
	$thumb = get_post_thumbnail();
}
?>
<?php if($thumb){?><meta property="og:image" content="<?php echo $thumb; ?>" /><?php } ?>

<?php /*
<meta name="weibo: article:create_at" content="<?php echo $post->post_date; ?>" />
<meta name="weibo: article:update_at" content="<?php echo $post->post_modified; ?>" />
*/?>
<?php   
	}     
}

// 微博赞以后再加。to do
/*
//add_filter('language_attributes','wpjam_wb_open_graph_language_attributes');
function wpjam_wb_open_graph_language_attributes($text){
	if(is_single()){
		return $text . ' xmlns:wb="http://open.weibo.com/wb"';
	}
}

//add_action('wp_footer','wpjam_wb_open_graph_footer');
add_action( 'wp_enqueue_scripts', 'wpjam_wb_open_graph_footer' );

function wpjam_wb_open_graph_footer(){
	if(is_single()){
	    wp_enqueue_script( 'wb-open-graph', 'http://tjs.sjs.sinajs.cn/open/api/js/wb.js', array('jquery'), '', true ); 
	}
}

function wb_like(){
?>
<wb:like></wb:like>
<?php 
}

function wb_praise(){
	wb_like();
}*/