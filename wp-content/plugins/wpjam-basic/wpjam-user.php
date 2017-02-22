<?php 
//添加用户注册时间和其他字段
add_filter('manage_users_columns','wpjam_manage_users_columns');
function wpjam_manage_users_columns($column_headers){
	unset($column_headers['name']);  //隐藏姓名

	//先移除
	unset($column_headers['email']);  
	unset($column_headers['role']);  
	unset($column_headers['posts']); 

	$column_headers['display_name'] = '昵称';
	
	//再插入，这样调整了位置。
	$column_headers['email']		= '电子邮件';
	$column_headers['role']			= '角色';  
	$column_headers['posts']		= '文章'; 

	$column_headers['registered']	= '注册时间';

	return $column_headers;
}

//显示用户注册时间和其他字段
add_filter('manage_users_custom_column', 'wpjam_manage_users_custom_column',11,3);
function wpjam_manage_users_custom_column($value, $column_name, $user_id){
	if($column_name=='registered'){
		$user = get_userdata($user_id);
		return get_date_from_gmt($user->user_registered);
	}elseif($column_name=='display_name'){
		$user = get_userdata($user_id);
		return $user->display_name;
	}else{
		return $value;
	}
}

//设置注册时间为可排序列.
add_filter( "manage_users_sortable_columns", 'wpjam_manage_users_sortable_columns' );
function wpjam_manage_users_sortable_columns($sortable_columns){
	$sortable_columns['registered'] = 'registered';
	return $sortable_columns;
}

//按注册时间排序.
if(wpjam_basic_get_setting('order_by_registered')){
	add_action( 'pre_user_query', 'wpjam_pre_user_query_order_by_registered' );
	function wpjam_pre_user_query_order_by_registered($query){
		if(!isset($_REQUEST['orderby'])){
			if( empty($_REQUEST['order']) || !in_array($_REQUEST['order'],array('asc','desc')) ){
				$_REQUEST['order'] = 'desc';
			}
			$query->query_orderby = "ORDER BY user_registered ".$_REQUEST['order'];
		}
	}
}

// 后台可以根据显示的名字来搜索用户 
add_filter('user_search_columns','wpjam_user_search_columns',10,3);
function wpjam_user_search_columns($search_columns, $search, $query){
	return array( 'ID', 'user_login', 'user_email', 'user_url', 'user_nicename', 'display_name' );
}

//移除不必要的用户联系信息
add_filter('user_contactmethods', 'wpjam_remove_user_contactmethods', 10, 1 ); 
function wpjam_remove_user_contactmethods( $contactmethods ) {
	
	unset($contactmethods['aim']);
	unset($contactmethods['yim']);
	unset($contactmethods['jabber']);
	
	//也可以自己增加
	//$contactmethods['user_mobile'] = '手机号码';
	//$contactmethods['user_contact'] = '收货联系人';
	//$contactmethods['user_address'] = '收货地址';

	return $contactmethods;
}
 

if(wpjam_basic_get_setting('strict_user')){   
	add_filter( 'sanitize_user', 'wpjam_sanitize_user',3,3);
	function wpjam_sanitize_user($username, $raw_username, $strict){
		// 设置用户名只能大小写字母和 - . _
		$username = preg_replace( '|[^a-z0-9_.\-]|i', '', $username );
		
		//检测待审关键字和黑名单关键字
		if(wpjam_blacklist_check($username)){
			$username = '';
		}

		return $username;
	}

	/* 在后台修改用户昵称的时候检查是否重复 */
	add_action('user_profile_update_errors', 'wpjam_user_profile_update_errors',10,3 );
	function wpjam_user_profile_update_errors($errors, $update, $user){
		if(!$user->ID) return;

		if($user->display_name && $check = wpjam_check_nickname($user->display_name,$user->ID)){
			if($check == 'name_too_long'){
				$errors->add( 'display_name_invalid', '<strong>错误</strong>：公开显示的名称不能超过12个字符。', array( 'form-field' => 'display_name' ) );
			}elseif($check == 'illegal_name'){
				$errors->add( 'display_name_invalid', '<strong>错误</strong>：公开显示的名称含有非法字符。', array( 'form-field' => 'display_name' ) );
			}elseif($check == 'invalid_name'){
				$errors->add( 'display_name_invalid', '<strong>错误</strong>：公开显示的名称只能含有中文汉字、英文字母、数字、下划线、中划线和点。', array( 'form-field' => 'display_name' ) );
			}elseif($check == 'duplicate_name'){
				$errors->add( 'display_name_duplicate', '<strong>错误</strong>：公开显示的名称重复。', array( 'form-field' => 'display_name' ) );
			}
			return;
		}

		if($user->nickname && $check = wpjam_check_nickname($user->nickname,$user->ID)){
			if($check == 'name_too_long'){
				$errors->add( 'nickname_invalid', '<strong>错误</strong>：昵称不能超过12个字符。', array( 'form-field' => 'nickname' ) );
			}elseif($check == 'illegal_name'){
				$errors->add( 'nickname_invalid', '<strong>错误</strong>：昵称含有非法字符。', array( 'form-field' => 'nickname' ) );
			}elseif($check == 'invalid_name'){
				$errors->add( 'nickname_invalid', '<strong>错误</strong>：昵称只能含有中文汉字、英文字母、数字、下划线、中划线和点。', array( 'form-field' => 'nickname' ) );
			}elseif($check == 'duplicate_name'){
				$errors->add( 'nickname_duplicate', '<strong>错误</strong>：昵称重复。', array( 'form-field' => 'nickname' ) );
			}
			return;
		}
	}
}

function wpjam_check_nickname($nickname, $user_id=0 ){
	
	if($nickname){
		if(mb_strwidth($nickname)>12){
			return 'name_too_long';
		}

		if(wpjam_blacklist_check($nickname)){
			return 'illegal_name';
		}

		if(!wpjam_validate_nickname($nickname)){
			return 'invalid_name';
		}

		if(wpjam_duplicate_nickname($nickname,$user_id)){
			return 'duplicate_name';
		}
	} 
}

function wpjam_duplicate_nickname($nickname,$user_id=0){
	global $wpdb;

	$sql = $wpdb->prepare("SELECT U.ID, U.display_name, UM.meta_value AS nickname FROM {$wpdb->users} as U LEFT JOIN {$wpdb->usermeta} UM ON ( U.ID = UM.user_id ) WHERE U.ID<>%d AND UM.meta_key = 'nickname' AND ( user_login = %s OR user_nicename = %s OR display_name = %s OR UM.meta_value = %s ) LIMIT 1", $user_id, $nickname, $nickname, $nickname, $nickname);
	
	if($wpdb->get_row($sql)){
		return true;
	}else{
		return false;
	}
}

function wpjam_validate_nickname($raw_nickname){

	$nickname = wpjam_get_validated_nickname($raw_nickname);
	
	if($raw_nickname==$nickname)
		return true;
	else
		return false;
}

function wpjam_get_validated_nickname($nickname){

	$nickname = remove_accents( $nickname );
	$nickname = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $nickname);
	$nickname = preg_replace('/&.+?;/', '', $nickname); // Kill entities
	
	//限制不能使用特殊的中文
	$nickname = preg_replace('/[^A-Za-z0-9_.\-\x{4e00}-\x{9fa5}]/u', '', $nickname);

	//检测待审关键字和黑名单关键字
	if(wpjam_blacklist_check($nickname)){
		$nickname = '';
	}
	
	$nickname = trim( $nickname );
	// Consolidate contiguous whitespace
	$nickname = preg_replace( '|\s+|', ' ', $nickname );
	
	return $nickname;
}
