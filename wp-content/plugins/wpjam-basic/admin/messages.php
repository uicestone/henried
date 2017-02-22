<?php
add_filter('wpjam_pages', 'wpjam_add_messages_page');
function wpjam_add_messages_page($wpjam_pages){
	$wpjam_pages['users']['subs']['messages'] = array('menu_title'=>'站内消息','capability'=>'read','function'=>'wpjam_messages_page');
	return $wpjam_pages;
}

add_filter('messages_fields', 'wpjam_messages_fields');
function wpjam_messages_fields($fields){
	return array(
		'sender'	=> array('title'=>'发送人',	'type'=>'text',		'show_admin_column'=>'only'),
		'receiver'	=> array('title'=>'发送给',	'type'=>'select',	'show_admin_column'=>true,	'required'),
		'content'	=> array('title'=>'内容',	'type'=>'textarea',	'show_admin_column'=>true,	'style'=>'max-width:640px;')
	);
}

add_action('messages_page_load','wpjam_messages_page_load');
function wpjam_messages_page_load(){
	global $wpjam_list_table, $current_tab;

	$action = isset($_GET['action'])?$_GET['action']:'';

	if($action =='view' || $action =='send'){
		return;
	}

	$style = '
	th.column-sender,th.column-receiver {width:120px;}
	';

	$wpjam_list_table = wpjam_list_table( array(
		'plural'		=> 'wpjam-messages',
		'singular' 		=> 'wpjam-message',
		'item_callback'	=> 'wpjam_messages_item',
		'per_page'		=> '20',
		'views'			=> 'wpjam_messages_views',
		'style'			=> $style,
	) );
}

function wpjam_messages_page(){
	$action = isset($_GET['action'])?$_GET['action']:'';

	if($action == 'send' || $action == 'add' ){
		wpjam_message_send_page();
	}elseif($action == 'view' ){
		wpjam_message_view_page();
	}else{
		wpjam_message_list_page();
	}
}

function wpjam_messages_views($views){
	global $wpdb, $current_admin_url;

	$current_type = isset($_GET['type'])?$_GET['type']:'inbox';

	$type_list = array('inbox'=>'收件箱', 'send'=>'已发送');

	foreach ($type_list as $type=>$name) {
		$class = ($current_type  == $type) ? 'class="current"':'';
		$views[$type] = '<a href="'.$current_admin_url.'&type='.$type.'" '.$class.'>'.$name.'</a>';
	}

	return $views;
}

function wpjam_message_list_page(){
	global $wpdb, $current_admin_url, $wpjam_list_table;
	?>
	<h1>站内消息 <a title="发送站内消息" class="add-new-h2 thickbox" href="<?php echo $current_admin_url.'&action=send&TB_iframe=true&width=780&height=340'; ?>">发送</a></h1>	
	<?php

	$action	= $wpjam_list_table->current_action();

	$current_user_id	= get_current_user_id();

	$search_term	= isset($_GET['s'])?$_GET['s']:'';
	$current_type 	= isset($_GET['type'])?$_GET['type']:'inbox';

	$where			= "1=1";

	if($current_type == 'inbox'){
		$where		.= ' AND receiver='.$current_user_id;
	}else{
		$where		.= ' AND sender='.$current_user_id;
	}

	if($search_term){
		$where		.= " AND ( title like '%{$search_term}%' or content like '%{$search_term}%')";
	}
	
	$sql_orderby	= "`status` ASC, `time` DESC";
	

	$limit		= $wpjam_list_table->get_limit();
	$messages	= $wpdb->get_results("SELECT SQL_CALC_FOUND_ROWS * FROM {$wpdb->messages} WHERE {$where} ORDER BY {$sql_orderby} LIMIT {$limit};", ARRAY_A);
	$total		= $wpdb->get_var("SELECT FOUND_ROWS();");

	$wpjam_list_table->prepare_items($messages, $total);
	$wpjam_list_table->display(array('search'=>false));
}

function wpjam_messages_item($item){
	global $current_admin_url;

	$current_user_id	= get_current_user_id();
	$user_id			= ($current_user_id == $item['sender'])?$item['receiver']:$item['sender'];

	$item['content']	= '<a href="'.$current_admin_url.'&action=view&user_id='.$user_id.'#id'.$item['id'].'">'.mb_strimwidth($item['content'],0,60,'...','utf-8').'</a>';

	if($item['status'] == 0){
		$item['style']	= 'font-size:large; font-weight:bold;';
	}

	$sender_user	= get_user_by('id', $item['sender']);
	$receiver_user	= get_user_by('id', $item['receiver']);

	$item['sender']		= $sender_user->display_name;
	$item['receiver']	= $receiver_user->display_name;

	return $item;
}

function wpjam_message_send_page(){
	global $wpdb, $current_admin_url;
	$receiver	= isset($_GET['receiver'])?$_GET['receiver']:'';
	$action		= isset($_GET['action'])?$_GET['action']:'';

	$nonce_action	= 'send-message';
	$form_fields	= wpjam_get_form_fields();

	$receiver_options = array(''=>' ');

	$args = array('orderby'=>'registered', 'order'=>'ASC', 'exclude'=>array(get_current_user_id()));
	if(is_multisite()){
		$args['blog_id']=get_current_blog_id();
	}
	$receiver_users	= get_users($args);
	foreach ($receiver_users as $receiver_user) {
		$receiver_options[$receiver_user->ID]	= $receiver_user->display_name;	
	}

	$form_fields['receiver']['options']	= $receiver_options;

	if($receiver){
		$receiver_user = get_user_by('id', $receiver);
		$form_fields['receiver']['value']	=$receiver_user->ID;
	}

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		$data = wpjam_get_form_post($form_fields, $nonce_action, 'read');

		if(!$data['content']){
			wpjam_admin_add_error('内容不能为空', 'error');
		}else{

			if($receiver){
				$data['receiver'] = $receiver;
			}

			wpjam_send_message($data);

			wpjam_admin_add_error('发送成功');
		}

		$form_fields['receiver']['value']	= $data['receiver'];
	}

	$form_url		= $current_admin_url.'&action=send';
	$action_text	= '发送';

	?>
	<h1><?php echo $action_text;?>站内消息</h1>

	<?php wpjam_form($form_fields, $form_url, $nonce_action, $action_text); ?>

	<?php
}

function wpjam_message_view_page(){
	global $wpdb, $current_admin_url;

	$user_id	= isset($_GET['user_id'])?$_GET['user_id']:'';
	$user		= get_user_by('id',$user_id);

	$current_user_id	= get_current_user_id();
	$current_user		= get_user_by('id',$current_user_id);

	if(!$user){
		wp_die('该用户不存在');
	}

	$nonce_action	= 'send-message';
	$form_fields	= wpjam_get_form_fields();
	unset($form_fields['receiver']);
	$form_fields['content']['title']	= '';

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		$data = wpjam_get_form_post($form_fields, $nonce_action, 'read');

		if(!$data['content']){
			wpjam_admin_add_error('内容不能为空', 'error');
		}else{
			$data['receiver'] = $user_id;
			wpjam_send_message($data);
			wpjam_admin_add_error('回复成功');
		}
	}else{
		wpjam_update_messages_status(array('sender'=>$user_id,'receiver'=>$current_user_id));
	}

	echo '<h1>站内消息</h1>';

	$form_url		= $current_admin_url.'&action=view&user_id='.$user_id;
	$action_text	= '回复';
	
	wpjam_form($form_fields, $form_url, $nonce_action, $action_text); 

	$messages		= $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->messages} WHERE (sender=%d AND receiver=%d) OR (sender=%d AND receiver=%d) ORDER BY time DESC",$user_id,$current_user_id,$current_user_id,$user_id));

	if(!$messages){
		echo '<p>暂无站内消息</p>';
	}
	?>
	<style type="text/css">
	div.message { padding:1px 1em; margin:1em 0; background: #fff;}
	div.message.alternate{background: #f9f9f9;}
	.meta, .content{margin:1em 0;}
	.avatar{float:left; margin-right:1em;}
	p.submit{margin-top:0;    padding-top: 0;}
	</style>
	<div style="max-width:640px; margin:1em 0">
	<?php foreach ($messages as $message) { $alternate = empty($alternate)?'alternate':'';?>
		<div id="id-<?php echo $message->id;?>" class="message <?php echo $alternate;?>">
			<div class ="meta">
				<span class="avatar"><img src="<?php echo get_avatar_url($message->sender, 96);?>" width="48"></span>
				<?php if($message->sender == $user_id){ ?>
				<span class="sender"><?php echo $user->display_name;?></span>
				<?php }else{ ?>
				<span class="sender"><?php echo $current_user->display_name;?></span>
				<?php } ?>
				 - <span class="time"><?php echo human_time_diff($message->time); ?>前</span>
			</div>
			<div class="content">
				<?php echo wpautop($message->content);?>
			</div>
		</div>
	<?php } ?>
	</div>
	<?php
}

add_action( 'admin_notices', 'wpjam_add_message_admin_notices' );
function wpjam_add_message_admin_notices() {
	global $plugin_page;

	if($plugin_page != 'messages'){
		if($wpjam_messages_count = wpjam_get_current_user_messages_count()){
			echo '<div class="updated"><p>你有<strong>'.$wpjam_messages_count.'</strong>条未读站内消息，请<a href="'.admin_url('users.php?page=messages').'">点击查看</a>！</p></div>';
		}
	}
}

// add_filter('ms_user_row_actions','wpjam_user_row_actions_add_message',10,2);
add_filter('user_row_actions', 'wpjam_user_row_actions_add_message', 10, 2);
function wpjam_user_row_actions_add_message($actions, $user){
	wpjam_array_push($actions, array('message'=>'<a class="thickbox" title="发送站内消息" href="'.admin_url('users.php?page=messages&action=send&receiver='.$user->ID.'&TB_iframe=true&width=780&height=340').'">发送站内消息</a>'),'remove');
	return $actions;
}


