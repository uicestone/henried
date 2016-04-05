<?php

add_filter('wpjam-qiniutek_defaults', 'wpjam_qiniutek_get_defaults');
function wpjam_qiniutek_get_defaults($defaults){
	return wpjam_qiniutek_get_option_defaults();	
}

function wpjam_qiniutek_get_option_defaults(){
	global $content_width;
 	$defaults = array(
		'exts'		=> 'js|css|png|jpg|jpeg|gif|ico', 
		'dirs'		=> 'wp-content|wp-includes',
		'local'		=> home_url(),
		'wdith'		=> $content_width,
		'disslove'	=> '100',
		'dx'		=> '10',
		'dy'		=> '10',
	);

	return  apply_filters('qiniutek_defaults',$defaults);
}