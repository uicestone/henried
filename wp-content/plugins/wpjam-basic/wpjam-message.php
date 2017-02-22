<?php
global $wpdb;
$wpdb->messages		= $wpdb->base_prefix . 'messages';

wp_cache_add_global_groups(array('wpjam-messages-count'));

function wpjam_send_message($data=array()){
	global $wpdb;

	$data = wp_parse_args($data, array(
		'sender'	=> get_current_user_id(),
		'receiver'	=> '',
		'content'	=> '',
		'status'	=> 0,
		'time'		=> time()
	));

	wp_cache_delete($data['receiver'], 'wpjam-messages-count');

	$data['content'] = wp_strip_all_tags($data['content']);

	$wpdb->insert($wpdb->messages, $data);
}

function wpjam_update_messages_status($data){
	global $wpdb;

	$data = wp_parse_args($data, array(
		'sender'	=> '',
		'receiver'	=> get_current_user_id(),
	));

	if($wpdb->query($wpdb->prepare("SELECT * FROM {$wpdb->messages} WHERE status=0 AND sender=%d AND receiver=%d",$data['sender'],$data['receiver']))){
		$wpdb->update($wpdb->messages, array('status'=>1), $data);	
	}

	wp_cache_delete($data['receiver'], 'wpjam-messages-count');	
}

function wpjam_get_current_user_messages_count(){
	global $wpdb;
	$current_user_id = get_current_user_id();

	$wpjam_messages_count = wp_cache_get($current_user_id, 'wpjam-messages-count');
	if($wpjam_messages_count === false){
		$wpjam_messages_count = $wpdb->get_var($wpdb->prepare("SELECT count(*) FROM {$wpdb->messages} WHERE receiver=%d AND status=0",$current_user_id));
		wp_cache_set($current_user_id, $wpjam_messages_count, 'wpjam-messages-count', DAY_IN_SECONDS);
	}

	return $wpjam_messages_count;
}