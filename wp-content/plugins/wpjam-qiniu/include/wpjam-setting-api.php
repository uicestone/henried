<?php
// 设置菜单
add_action('network_admin_menu', 'wpjam_admin_menu');
add_action('admin_menu', 'wpjam_admin_menu');
function wpjam_admin_menu() {
	global $plugin_page;

	$wpjam_pages = wpjam_get_admin_pages();
	if(!$wpjam_pages) return;

	$builtin_parent_pages = wpjam_get_builtin_parent_pages();

	foreach ($wpjam_pages as $menu_slug=>$wpjam_page) {
		if(isset($builtin_parent_pages[$menu_slug])){
			$parent_slug = $builtin_parent_pages[$menu_slug];
		}else{
			extract( wpjam_parse_admin_page($wpjam_page) );
			
			$function	= ($function !== '')?'wpjam_admin_page':'';
			$page_hook	= add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon, $position);

			if($plugin_page == $menu_slug){
				add_action('load-'.$page_hook, 'wpjam_admin_page_load');
			}

			$parent_slug	= $menu_slug;
		}
		if(!empty($wpjam_page['subs'])){
			foreach ($wpjam_page['subs'] as $menu_slug => $wpjam_page) {
				extract( wpjam_parse_admin_page($wpjam_page));

				$function	= ($function !== '')?'wpjam_admin_page':'';
				$page_hook	= add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
				
				if($plugin_page == $menu_slug){
					add_action('load-'.$page_hook, 'wpjam_admin_page_load');
				}
			}
		}
	}
}

// 如果是通过 wpjam_pages filter 定义的后台菜单，就需要设置 $current_screen->id=$plugin_page
// 否则隐藏列功能就会出问题。	
add_action('current_screen', 'wpjam_current_screen');
function wpjam_current_screen($current_screen){
	global $current_screen, $plugin_page;
	if($plugin_page && wpjam_get_admin_page($plugin_page)){
		$current_screen->id = $current_screen->base = $plugin_page;
	}
}

// 加载页面之前执行的函数
function wpjam_admin_page_load(){
	global $plugin_page, $current_tab;

	if($tabs = wpjam_get_admin_page_tabs()){
		$tab_keys		= array_keys($tabs);
		$current_tab	= isset($_GET['tab'])?$_GET['tab']:$tab_keys[0];
	}

	$action	= isset($_GET['action'])?$_GET['action']:'';
	if(in_array($action, array('add','edit','set','bulk-edit'))) return;

	do_action($plugin_page.'_page_load');
}

// 获取后台菜单
function wpjam_get_admin_pages(){
	if(is_multisite() && is_network_admin()){
		return apply_filters('wpjam_network_pages', array());
	}else{
		return apply_filters('wpjam_pages', array());
	}
}

// 获取指定 menu_slug 的后台菜单
function wpjam_get_admin_page($menu_slug){
	$wpjam_pages = wpjam_get_admin_pages();
	if(isset($wpjam_pages[$menu_slug])){
		return wpjam_parse_admin_page($wpjam_pages[$menu_slug]);
	}

	foreach ($wpjam_pages as $parent_slug => $wpjam_page){
		if(isset($wpjam_page['subs'][$menu_slug])){
			$wpjam_page['subs'][$menu_slug]['parent_slug'] = $parent_slug;
			return wpjam_parse_admin_page($wpjam_page['subs'][$menu_slug]);
		}
	}

	return false;
}

// 获取内置的后台一级菜单
function wpjam_get_builtin_parent_pages(){
	if(is_multisite() && is_network_admin()){
		return array(
			'settings'	=> 'settings.php',
			'theme'		=> 'themes.php',
			'themes'	=> 'themes.php',
			'plugins'	=> 'plugins.php',
			'users'		=> 'users.php',
			'sites'		=> 'sites.php',
		);
	}else{
		$parent_pages = array(
			'management'=> 'tools.php',
			'options'	=> 'options-general.php',
			'theme'		=> 'themes.php',
			'themes'	=> 'themes.php',
			'plugins'	=> 'plugins.php',
			'posts'		=> 'edit.php',
			'media'		=> 'upload.php',
			'links'		=> 'link-manager.php',
			'pages'		=> 'edit.php?post_type=page',
			'comments'	=> 'edit-comments.php',
			'users'		=> current_user_can('edit_users')?'users.php':'profile.php',
		);

		if($custom_post_types = get_post_types( array( '_builtin' => false, 'show_ui' => true ))){
			foreach ($custom_post_types as $custom_post_type) {
				$parent_pages[$custom_post_type.'s'] = 'edit.php?post_type='.$custom_post_type;
			}
		}

		return $parent_pages;
	}
}

// 菜单处理函数
function wpjam_parse_admin_page($wpjam_page){
	$wpjam_page = wp_parse_args( $wpjam_page, array(
		'menu_title'	=> '',
		'page_title'	=> '',
		'function'		=> null,
		'capability'	=> 'manage_options',
		'icon'			=> '',
		'position'		=> null,
		'load'			=> '',
		'fields'		=> ''
	) );

	if(!$wpjam_page['page_title']){
		$wpjam_page['page_title'] = $wpjam_page['menu_title'];
	}

	return $wpjam_page;
}

// 后台页面处理函数
function wpjam_admin_page(){
	global $plugin_page, $current_admin_url;
	?>
	<div class="wrap">
	<?php

	if($wpjam_page 	= wpjam_get_admin_page($plugin_page)){

		$builtin_parent_pages	= wpjam_get_builtin_parent_pages();
		$parent_slug 			= isset($wpjam_page['parent_slug'])?$wpjam_page['parent_slug']:'';

		if($parent_slug && isset($builtin_parent_pages[$parent_slug])){
			$current_admin_url 	= $builtin_parent_pages[$parent_slug].'?page='.$plugin_page;
		}else{
			$current_admin_url	= 'admin.php?page='.$plugin_page;
		}

		$current_admin_url	= (is_network_admin())?network_admin_url($current_admin_url):admin_url($current_admin_url);
		$function			= $wpjam_page['function'];

		if($function == 'option'){
			$option_name 	= isset($wpjam_page['option_name'])?$wpjam_page['option_name']:$plugin_page;
			$page_type		= isset($wpjam_page['page_type'])?$wpjam_page['page_type']:'tab';
			call_user_func('wpjam_option_page', $option_name, array('page_type'=>$page_type,'page_title'=>$wpjam_page['page_title']));
		}elseif($function == 'tab'){
			call_user_func('wpjam_admin_tab_page');
		}else{
			$function	= ($function)?$function:str_replace('-','_',$plugin_page).'_page';
			call_user_func($function);
		}
	}
	?>
	</div>
	<?php
}

// Tab 后台页面
function wpjam_admin_tab_page($args=array()){
	global $plugin_page, $current_tab, $current_admin_url;

	$tabs = wpjam_get_admin_page_tabs();

	if(!$tabs) return;
	
	// $tab_keys		= array_keys($tabs);
	// $current_tab	= isset($_GET['tab'])?$_GET['tab']:$tab_keys[0];

	if(empty($tabs[$current_tab])){
		wp_die('无此Tab');
	}

	$current_admin_url = $current_admin_url.'&tab='.$current_tab;

	if($args) $current_admin_url = add_query_arg($args, $current_admin_url);

	if(count($tabs) == 1){ ?>
	<?php call_user_func($tabs[$current_tab]['function']); ?>
	<?php }else{ ?>
	<h2 class="nav-tab-wrapper">
	<?php foreach ($tabs as $tab_key => $tab) { ?>
		<?php 
		$tab_url = admin_url('admin.php?page='.$plugin_page.'&tab='.$tab_key);
		if($args) $tab_url = add_query_arg($args, $tab_url);	// 支持全局的参数
		if(isset($tab['args'])) $tab_url = add_query_arg($tab['args'], $tab_url);	// 支持单个参数
		?>
		<a class="nav-tab <?php if($current_tab == $tab_key){ echo 'nav-tab-active'; } ?>" href="<?php echo $tab_url;?>"><?php echo $tab['title']; ?></a>
	<?php }?>
	</h2>
	<?php call_user_func($tabs[$current_tab]['function']); ?>
	<?php }
}

// 获取当前页面的 Tabs
function wpjam_get_admin_page_tabs(){
	global $plugin_page;

	if($tabs =  apply_filters($plugin_page.'_tabs', array())){
		foreach ($tabs as $key => $tab) { 
			if(is_string($tab)){
				$function	= str_replace('-', '_', $plugin_page).'_'.$key.'_page';
				$tabs[$key]	= array('title'=>$tab, 'function'=>$function);
			}
		}
	}

	return $tabs;
}


// 注册设置选项
add_action('admin_init', 'wpjam_register_setting_admin_init');
function wpjam_register_setting_admin_init(){
	// 只有在 options.php 页面的时候才需要注册选项
	$option_name = isset($_POST['option_page'])?$_POST['option_page']:''; // options.php 页面

	if(empty($option_name)) return;

	if($wpjam_setting = wpjam_get_option_setting($option_name)){
		extract($wpjam_setting);
		register_setting($option_group, $option_name, $field_validate);	// 只需注册字段，add_settings_section 和 add_settings_field 可以在具体选项页面添加
	}
}

// 获取某个选项的所有设置
function wpjam_get_option_setting($option_name){
	$wpjam_settings = apply_filters('wpjam_settings', array());
	if(!$wpjam_settings) return false;

	if(empty($wpjam_settings[$option_name])) return false;

	return wp_parse_args($wpjam_settings[$option_name], array(
		'option_group'	=> $option_name, 
		'option_page'	=> $option_name, 
		'sections'		=> false, 
		'fields'		=> false, 
		'field_validate'=> 'wpjam_option_field_validate', 
		'field_callback'=> 'wpjam_option_field_callback',
	) );
}

// section 统一回调函数
function wpjam_option_section_callback($section){
	global $section_summary;
	if(isset($section_summary[$section['id']])){
		echo wpautop($section_summary[$section['id']]);
	}
}

// 后台选项页面
function wpjam_option_page($option_name, $args=array()){
	if(!$option_name) return;

	$wpjam_setting = wpjam_get_option_setting($option_name);
	if(!$wpjam_setting)	return;
	
	extract($wpjam_setting);
	extract(wp_parse_args($args, array('page_title'=>'', 'page_type'=>'tab')));

	if(!$sections) return;

	if(count($sections) == 1){
		$page_type	= 'default';
	}

	do_action($option_name.'_option_page');

	if(is_multisite() && is_network_admin()){	
		if($_SERVER['REQUEST_METHOD'] == 'POST'){	// 如果是 network 就自己保存到数据库		
			$value 	= wpjam_option_field_validate($_POST[$option_name], $option_name);
			update_site_option( $option_name,  $value);
			wpjam_admin_add_error(__( 'Options saved.' ));
			wpjam_admin_errors();
		}
		echo '<form action="'.add_query_arg(array('settings-updated'=>'true'), wpjam_get_current_page_url()).'" method="POST">';
	}else{
		echo '<form action="options.php" method="POST">';
	}

	$wpjam_option = wpjam_get_option($option_name);

	global $section_summary;
	$section_summary = array();

	foreach ($sections as $section_id => $section) {
		$section_title		= isset($section['title'])?$section['title']:'';
		$section_callback	= isset($section['callback'])?$section['callback']:'';
		
		if(isset($section['summary'])){
			$section_summary[$section_id]	= $section['summary'];
			$section_callback				= 'wpjam_option_section_callback';
		}
		
		add_settings_section($section_id, $section_title, $section_callback, $option_page);

		if(!$section['fields']) continue;
		
		foreach ($section['fields'] as $key => $field) {
			$field['key']	= $key;
			$field['name']	= $option_name.'['.$key.']';
			$field_title	= '<label for="'.$key.'">'.$field['title'].'</label>';

			if($field['type'] == 'fieldset'){
				foreach ($field['fields'] as $sub_key => $sub_field) {
					$field['fields'][$sub_key]['value']	= isset($sub_field['value'])?$sub_field['value']:(isset($wpjam_option[$sub_key])?$wpjam_option[$sub_key]:'');
					$field['fields'][$sub_key]['name']	= $option_name.'['.$sub_key.']';
				}
			}else{
				$field['value']	= isset($field['value'])?$field['value']:(isset($wpjam_option[$key])?$wpjam_option[$key]:'');
			}

			add_settings_field($key, $field_title, $field_callback, $option_page, $section_id, $field);	
		}
	}

	settings_fields($option_group);

	if($page_type == 'tab'){
		wpjam_do_settings_sections($option_page);
		if(!empty($_GET['settings-updated'])){
			$wpjam_option	= wpjam_get_option( $option_name );
			echo '<input type="hidden" name="'.$option_name.'[current_tab]" id="current_tab" value="'.$wpjam_option['current_tab'].'" />';
		}else{
			echo '<input type="hidden" name="'.$option_name.'[current_tab]" id="current_tab" value="" />';
		}
	}else{
		echo ($page_title)?((preg_match("/<[^<]+>/",$page_title))?$page_title:'<h2>'.$page_title.'</h2>'):'';// 如 $page_title 里面有 <h2> <h3> 标签，就不再加入 <h2> <h3> 标签了。

		settings_errors();
		do_settings_sections($option_page);
	}
	submit_button();
	echo '</form>'; 
}

// 拷贝自 do_settings_sections 函数，用于选项页面 tab 显示选项。
function wpjam_do_settings_sections($page){
	global $wp_settings_sections, $wp_settings_fields;

	if (!isset($wp_settings_sections[$page])) return;

	$sections = (array)$wp_settings_sections[$page];

	echo '<h2 class="nav-tab-wrapper">';
	foreach ( $sections as $section_id => $section ) {
		echo '<a class="nav-tab" href="javascript:;" id="tab-title-'.$section_id.'">'.$section['title'].'</a>';
	}
	echo '</h2>';

	settings_errors();

	foreach ( $sections as $section_id => $section ) {
		if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section_id] ) ) continue;

		echo '<div id="tab-'.$section_id.'" class="div-tab hidden">';

		if ( $section['title'] ) echo "<h3>{$section['title']}</h3>\n";

		if ( $section['callback'] ) call_user_func( $section['callback'], $section );

		echo '<table class="form-table">';
		do_settings_fields($page, $section_id);
		echo '</table>';
		
		echo '</div>';
	}
}

// 选项字段基本验证函数
function wpjam_option_field_validate($value, $option_name = ''){
	global $plugin_page, $current_tab;

	// 用于下面数据获取时候页面判断
	$referer_origin	= parse_url(wpjam_get_referer());
	wp_parse_str($referer_origin['query'], $referer_args);

	$plugin_page	= isset($referer_args['page'])?$referer_args['page']:'';
	$current_tab	= isset($referer_args['tab'])?$referer_args['tab']:'';

	$option_name	= ($option_name)?$option_name:str_replace('sanitize_option_', '', current_filter()); 
	$wpjam_setting	= wpjam_get_option_setting($option_name);
	$sections 		= $wpjam_setting['sections'];

	if($sections){
		foreach ($sections as $section) {
			if($section['fields']){
				foreach ($section['fields'] as $key => $field) {
					if( $field['type'] == 'checkbox' && empty( $value[$key] ) ){  // 如果是 checkbox，POST 的时候空是没有的。
						$value[$key] = 0;
					}elseif( $field['type'] =='file' && isset($_FILES[$key]) && isset($_FILES[$key]['name'])) {
						if ( $upload_file = wp_handle_upload( $_FILES[$key], array( 'test_form' => false ) ) ) {
							$value[$key] = $upload_file['url'];
						}
					}
				}
			}
		}
	}

	$current	= wpjam_get_option($option_name);;
	$value		= wp_parse_args($value, $current);

	return apply_filters( $option_name.'_field_validate', $value );
}

// 选项的字段回调函数，显示具体 HTML 结构
function wpjam_option_field_callback($field) {
	echo wpjam_get_field_html($field);
}

// 注册自定义日志类型
add_action('init', 'wpjam_post_type_init', 11);
function wpjam_post_type_init(){
	$wpjam_post_types = wpjam_get_post_types();

	if(!$wpjam_post_types) return;

	global $wp_post_types;

	foreach ($wpjam_post_types as $post_type => $post_type_args) {
		$post_type_rewrite = isset($post_type_args['rewrite'])?$post_type_args['rewrite']:(isset($post_type_args['permastruct'])?true:false);

		if (is_array($post_type_rewrite)) {
			$post_type_rewrite	= wp_parse_args($post_type_rewrite, array('slug'=>$post_type, 'with_front'=>false, 'pages'=>true, 'feeds'=>false) );
		}else{
			$post_type_rewrite	= array('slug'=>$post_type, 'with_front'=>false, 'pages'=>true, 'feeds'=>false);
		}

		$post_type_args	= wpjam_parse_post_type_args($post_type, $post_type_args);
		register_post_type($post_type, $post_type_args);

		$wp_post_types[$post_type]->rewrite	= $post_type_rewrite;
	}
}

// 获取要注册自定义日志类型参数
function wpjam_get_post_types(){
	return apply_filters('wpjam_post_types', array());
}

function wpjam_get_post_type_args($post_type){
	$wpjam_post_types = wpjam_get_post_types();
	return isset($wpjam_post_types[$post_type]) ? wpjam_parse_post_type_args($post_type, $wpjam_post_types[$post_type]) : '';
}

// 自定义日志类型参数处理函数
function wpjam_parse_post_type_args($post_type, $post_type_args){

	$labels = isset($post_type_args['labels'])?$post_type_args['labels']:'';
	$label 	= isset($post_type_args['label'])?$post_type_args['label']:'';

	if(!$labels || is_string($labels)){
		$label_name	= ($labels) ? $labels : $label;
		$post_type_args['labels']  	= array(
			'name'					=> $label_name,
			'singular_name'			=> $label_name,
			'add_new'				=> '新增'.$label_name,
			'add_new_item'			=> '新增'.$label_name,
			'edit_item'				=> '编辑'.$label_name,
			'new_item'				=> '添加'.$label_name,
			'all_items'				=> '所有'.$label_name,
			'view_item'				=> '查看'.$label_name,
			'search_items'			=> '搜索'.$label_name,
			'not_found'				=> '找不到相关'.$label_name,
			'not_found_in_trash'	=> '回收站中没有'.$label_name, 
			'parent_item_colon'		=> '父级'.$label_name,
			'menu_name'				=> $label_name
		);
	}
	
	$permastruct	= isset($post_type_args['permastruct'])?$post_type_args['permastruct']:'';

	if($permastruct){
		wpjam_generate_post_type_rewrite_rules($post_type, $post_type_args);
		$post_type_args['rewrite'] = false;
	}

	return  apply_filters('wpjam_post_type_args', $post_type_args);
}

// 设置自定义类型的 Rewrite
function wpjam_generate_post_type_rewrite_rules($post_type, $post_type_args){
	global $wp_rewrite;

	$rewrite		= isset($post_type_args['rewrite'])?$post_type_args['rewrite']:false;
	$rewrite_slug	= isset($rewrite['slug'])?$rewrite['slug']:$post_type;

	$has_archive	= isset($post_type_args['has_archive'])?$post_type_args['has_archive']:false;

	if($has_archive){
		$archive_slug = $has_archive === true ? $rewrite_slug : $has_archive;
		$archive_slug = $wp_rewrite->root . $archive_slug;
		add_rewrite_rule( "{$archive_slug}/?$", "index.php?post_type=$post_type", 'top' );
		add_rewrite_rule( "{$archive_slug}/{$wp_rewrite->pagination_base}/([0-9]{1,})/?$", "index.php?post_type=$post_type" . '&paged=$matches[1]', 'top' );
	}

	$permastruct_args = array(
		'ep_mask' 		=> isset($post_type_args['permalink_epmask'])?$post_type_args['permalink_epmask']:EP_PERMALINK,
		'with_front'	=> false,
		'paged' 		=> false,
		'feed' 			=> false,
		'forcomments'	=> false,
		'walk_dirs'		=> false,
		'endpoints'		=> false,
	);

	$permastruct	= isset($post_type_args['permastruct'])?$post_type_args['permastruct']:'';

	if(strpos($permastruct, "%post_id%") || strpos($permastruct, "%{$post_type}_id%")){
		$permastruct	= str_replace("%post_id%", "%{$post_type}_id%", $permastruct); 
		add_rewrite_tag( "%{$post_type}_id%", '([0-9]+)', "post_type=$post_type&p=" );
	}else{
		$query_var		= isset($post_type_args['query_var'])?$post_type_args['query_var']:'';
		$hierarchical	= isset($post_type_args['hierarchical'])?$post_type_args['hierarchical']:'';

		if ( false !== $query_var ) {
			if ( true === $query_var ){
				$query_var	= $post_type;
			}else{
				$query_var	= sanitize_title_with_dashes( $query_var );
			}
		}

		if ( $hierarchical ){
			add_rewrite_tag( "%$post_type%", '(.+?)', $query_var ? "{$query_var}=" : "post_type=$post_type&pagename=" );
		}else{
			add_rewrite_tag( "%$post_type%", '([^/]+)', $query_var ? "{$query_var}=" : "post_type=$post_type&name=" );
		}
	}

	add_permastruct( $post_type, $permastruct, $permastruct_args);
}

// 设置自定义日志的链接
add_filter('post_type_link', 'wpjam_post_type_link', 1, 2);
function wpjam_post_type_link( $post_link, $post ){

	$post_type	= $post->post_type;
	$post_id	= $post->ID;

	$post_type_args	= wpjam_get_post_type_args($post_type);
	if(!$post_type_args) return $post_link;

	$permastruct	= isset($post_type_args['permastruct'])?$post_type_args['permastruct']:'';
	if(!$permastruct)	return $post_link;

	$post_link	= str_replace( '%'.$post_type.'_id%', $post_id, $post_link );

	$taxonomies = get_taxonomies(array('object_type'=>array($post_type)), 'objects');

	if($taxonomies){
		foreach ($taxonomies as $taxonomy=>$taxonomy_object) {
			if($taxonomy_rewrite = $taxonomy_object->rewrite){
				$terms = get_the_terms( $post_id, $taxonomy );
				if($terms){
					$term = current($terms);
					$post_link	= str_replace( '%'.$taxonomy_rewrite['slug'].'%', $term->slug, $post_link );
				}else{
					$post_link	= str_replace( '%'.$taxonomy_rewrite['slug'].'%', $taxonomy, $post_link );
				}
			}
		}
	}

	return $post_link;
}

// 在后台特色图片下面显示最佳图片大小
add_filter('admin_post_thumbnail_html', 'wpjam_admin_post_thumbnail_html',10,2);
function wpjam_admin_post_thumbnail_html($content, $post_id){
	$post		= get_post($post_id);
	$post_type	= $post->post_type;

	$post_type_args	= wpjam_get_post_type_args($post_type);
	if(!$post_type_args) return $content;

	$thumbnail_size	= isset($post_type_args['thumbnail_size'])?$post_type_args['thumbnail_size']:'';
	if(!$thumbnail_size)	return $content;

	return $content.'<p>大小：'.$thumbnail_size.'</p>';
}



// 注册自定义分类
add_action('init', 'wpjam_taxonomy_init', 11);
function wpjam_taxonomy_init(){
	$wpjam_taxonomies = wpjam_get_taxonomies();

	if(!$wpjam_taxonomies) return;

	foreach ($wpjam_taxonomies as $taxonomy=>$wpjam_taxonomy) {
		$object_type	= $wpjam_taxonomy['object_type'];
		$taxonomy_args	= wpjam_parse_taxonomy_args($taxonomy, $wpjam_taxonomy['args']);

		register_taxonomy( $taxonomy, $object_type, $taxonomy_args );
	}
}

function wpjam_get_taxonomies(){
	return apply_filters('wpjam_taxonomies', array());
}

// 自定义分类参数处理函数
function wpjam_parse_taxonomy_args($taxonomy, $taxonomy_args){

	$labels = isset($taxonomy_args['labels'])?$taxonomy_args['labels']:'';
	$label 	= isset($taxonomy_args['label'])?$taxonomy_args['label']:'';

	if(!$labels || is_string($labels)){
		$label_name	= ($labels) ? $labels : $label;
		$taxonomy_args['labels']  	= array(
			'name'					=> $label_name,
			'singular_name'			=> $label_name,
			'search_items'			=> '搜索'.$label_name,
			'popular_items'			=> '最受欢迎'.$label_name,
			'all_items'				=> '所有'.$label_name,
			'parent_item'			=> '父级'.$label_name,
			'parent_item_colon'		=> '父级'.$label_name,
			'edit_item'				=> '编辑'.$label_name,
			'view_item'				=> '查看'.$label_name,
			'update_item'			=> '更新'.$label_name,
			'add_new_item'			=> '新增'.$label_name,
			'new_item_name'			=> '新'.$label_name.'名',
			'separate_items_with_commas'	=> '多个'.$label_name.'请用英文逗号（,）分开',
			'add_or_remove_items'	=> '新增或者移除'.$label_name,
			'choose_from_most_used'	=> '从最常使用的'.$label_name.'中选择',
			'not_found'				=> '找不到'.$label_name,
			
		);
	}

	return  apply_filters('wpjam_taxonomy_args', $taxonomy_args);
}



// 输出日志自定义字段表单
add_action( 'add_meta_boxes', 'wpjam_post_options_meta_box', 10, 2 );
function wpjam_post_options_meta_box($post_type, $post) {
	global $pagenow;
	if($pagenow != 'post.php' && $pagenow != 'post-new.php') return;	// 只有在 post 编辑页面才添加 Meta Box

	if($wpjam_post_options = wpjam_get_post_options($post_type)){
		foreach($wpjam_post_options as $meta_key => $wpjam_post_option){
			extract($wpjam_post_option);
			add_meta_box($meta_key, $title, $callback, $post_type, $context, $priority, array('context'=>$context, 'fields'=>$fields));
		}
	}
}

// 获取自定义字段设置
function wpjam_get_post_options($post_type=''){
	$wpjam_post_options = apply_filters('wpjam_options', array()); // 逐步放弃
	$wpjam_post_options = apply_filters('wpjam_post_options', $wpjam_post_options);
	
	if(!$post_type){
		return $wpjam_post_options;
	}else{
		$wpjam_post_type_options = array();
		foreach($wpjam_post_options as $meta_key => $wpjam_post_option){
			$wpjam_post_option = wpjam_parse_post_option($wpjam_post_option);
			if( $wpjam_post_option['post_types'] == 'all' || in_array($post_type, $wpjam_post_option['post_types'])){
				$wpjam_post_type_options[$meta_key] = $wpjam_post_option;
			}
		}
		return $wpjam_post_type_options;
	}
}

function wpjam_get_post_fields($post_type=''){
	$wpjam_post_fields = array();
	
	if($wpjam_post_options = wpjam_get_post_options($post_type)) {
		foreach ($wpjam_post_options as $meta_key => $wpjam_post_option) {
			
			if(!$wpjam_post_option['fields']) continue;

			$wpjam_post_fields = array_merge($wpjam_post_fields, $wpjam_post_option['fields']);
		}
	}

	return $wpjam_post_fields;
}

// 获取自定义字段中需要显示到列表页的栏目
function wpjam_get_post_columns($post_type='',$column_type='admin'){
	$wpjam_post_columns = array();

	if($wpjam_post_options = wpjam_get_post_options($post_type)) {
		foreach ($wpjam_post_options as $meta_key => $wpjam_post_option) {
			
			if(!$wpjam_post_option['fields']) continue;

			foreach($wpjam_post_option['fields'] as $key => $field){
				if($column_type == 'sortable'){
					if(!empty($field['show_admin_column']) && !empty($field['sortable_column'])){
						$wpjam_post_columns[$key] = $key;
					}
				}else{
					if(!empty($field['show_admin_column'])){
						$wpjam_post_columns[$key] = $field['title'];
					}
				}
			}
		}
	}

	return $wpjam_post_columns;
}

// 处理和解析自定义字段的 meta_box
function wpjam_parse_post_option($wpjam_post_option){
	return wp_parse_args( $wpjam_post_option, array(
		'context'		=> 'normal',
		'priority'		=> 'high',
		'post_types'	=> 'all',
		'title'			=> ' ',
		'fields'		=> '',
		'callback'		=> 'wpjam_post_options_callback'
	) );
}

// 日志自定义字段的处理函数
function wpjam_post_options_callback($post, $meta_box){
	global $pagenow;

	$fields			= $meta_box['args']['fields'];
	$fields_type	= ($meta_box['args']['context']=='side')?'list':'table';

	foreach ($fields as $key => $field) {
		if($pagenow == 'post-new.php'){
			$fields[$key]['value']	= isset($field['default'])?$field['default']:'';
		}else{
			$fields[$key]['value']	= isset($_REQUEST[$key])?$_REQUEST[$key]:get_post_meta($post->ID, $key, true);
		}
	}
	
	wpjam_form_fields($fields, $fields_type);
}

// 在日志列表页输出自定义字段名
add_filter('manage_posts_columns', 'wpjam_manage_posts_columns', 99, 2);
function wpjam_manage_posts_columns($columns, $post_type){

	if($wpjam_post_columns = wpjam_get_post_columns($post_type)){
		$columns	= array_merge($columns, $wpjam_post_columns); 
	}

	// 把日期移到最后
	unset($columns['date']);
	$columns['date'] = '日期';

	return $columns;
}

// 在日志列表页输出自定义字段的值
add_action('manage_posts_custom_column','wpjam_manage_posts_custom_column',10,2);
function wpjam_manage_posts_custom_column($column_name, $post_id){
	$post		= get_post($post_id);
	$wpjam_post_fields	= wpjam_get_post_fields($post->post_type);

	if($wpjam_post_fields && isset($wpjam_post_fields[$column_name])){
		$column_value = get_post_meta($post_id, $column_name, true);
		if(isset($wpjam_post_fields[$column_name]['options'])){
			$column_options	= $wpjam_post_fields[$column_name]['options'];
			$column_value	= isset($column_options[$column_value])?$column_options[$column_value]:$column_value;
		}
		echo apply_filters('wpjam_manage_posts_'.$column_name.'_column', $column_value , $post_id);
	}
}

// 在日志列表页获取可用于排序的自定义字段
add_action('admin_init', 'wpjam_manage_posts_sortable_columns_init');
function wpjam_manage_posts_sortable_columns_init(){
	global $pagenow;
	if($pagenow != 'edit.php')	return;
	
	foreach (get_post_types(array('show_ui' => true)) as $post_type){
		add_filter('manage_edit-'.$post_type.'_sortable_columns', 'wpjam_manage_posts_sortable_columns');
	}
}

function wpjam_manage_posts_sortable_columns($sortable_columns){
	global $typenow;
	if($wpjam_post_sortable_columns = wpjam_get_post_columns($typenow, 'sortable')){
		$sortable_columns	= array_merge($sortable_columns, $wpjam_post_sortable_columns); 
	}

	return $sortable_columns;
}

// 使得可排序的自定义字段排序功能生效
add_action('pre_get_posts', 'wpjam_pre_get_posts_sortable_columns');
function wpjam_pre_get_posts_sortable_columns($wp_query) {
	if(!is_admin()) return;
	
	global $pagenow;
	if($pagenow != 'edit.php')	return;

	$orderby	= $wp_query->get('orderby');

	if($orderby){
		$post_type	= $wp_query->get('post_type');

		if($wpjam_post_columns = wpjam_get_post_columns($post_type, 'sortable')){
			$wpjam_post_fields = wpjam_get_post_fields($post_type);
			if(isset($wpjam_post_columns[$orderby])){
				$wp_query->set('meta_key', $orderby);
				$orderby_type = ($wpjam_post_fields[$orderby]['sortable_column'] == 'meta_value_num')?'meta_value_num':'meta_value';
				$wp_query->set('orderby', $orderby_type);
			}
		}
	}
}


// 保存日志自定义字段
add_action('save_post', 'wpjam_save_post_options', 999, 2);
function wpjam_save_post_options($post_ID, $post){
	
	if(!is_admin()) return;

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

	global $pagenow;
	if($pagenow != 'post.php' && $pagenow != 'post-new.php') return;

	if($wpjam_post_fields = wpjam_get_post_fields($post->post_type))	{
		foreach ($wpjam_post_fields as $key => $field) {
			wpjam_save_field($key, $field, $post_ID);	
		}
	}
}

// 保存日志自定义字段和 Term Meta
function wpjam_save_field($key, $field, $object_id, $object_type='post'){

	if($field['type'] == 'fieldset'){
		if($field['fields']){
			foreach ($field['fields'] as $sub_key => $sub_field) {
				wpjam_save_field($sub_key, $sub_field, $object_id, $object_type);
			}
		}
		return;
	}

	$value = wpjam_form_field_validate($key, $field);

	if($value === false){
		return;
	}

	$get_function		= 'get_'.$object_type.'_meta';
	$update_function	= 'update_'.$object_type.'_meta';
	$delete_function	= 'delete_'.$object_type.'_meta';

	if($value){
		call_user_func($update_function, $object_id, $key, $value);
	}else{
		if(call_user_func($get_function, $object_id, $key, true)) {
			call_user_func($delete_function, $object_id, $key);
		}
	}
}

// 设置 Term Options
add_action('admin_init', 'wpjam_term_admin_init',99);
function wpjam_term_admin_init(){
	if($wpjam_term_options = wpjam_get_term_options()) {
		$taxonomies = get_taxonomies(array( 'public' => true)); 	// init 之后才能获取 taxonomy 列表
		foreach ($taxonomies as $taxonomy) {
			add_action($taxonomy.'_add_form_fields', 	'wpjam_add_term_form_fields');
			add_action($taxonomy.'_edit_form_fields', 	'wpjam_edit_term_form_fields', 10, 2); 

			add_action('manage_edit-'.$taxonomy.'_columns',			'wpjam_manage_edit_term_columns');
			add_action('manage_edit-'.$taxonomy.'_sortable_columns','wpjam_manage_edit_term_sortable_columns');
			add_filter('manage_'.$taxonomy.'_custom_column',		'wpjam_manage_term_custom_column', 10, 3);
		}

		// 保存
		add_action('edited_term',	'wpjam_save_term_fields',10, 3);  
		add_action('created_term',	'wpjam_save_term_fields',10, 3);
	}
}

// 获取 Term Meta Options 
function wpjam_get_term_options($taxonomy=''){
	$wpjam_term_options = apply_filters('wpjam_term_options', array());

	if(!$taxonomy){
		return $wpjam_term_options;
	}else{
		$wpjam_taxonomy_options = array();
		foreach ($wpjam_term_options as $key => $wpjam_term_option) {
			$taxonomies = isset($wpjam_term_option['taxonomies'])?$wpjam_term_option['taxonomies']:'all';
			if($taxonomies == 'all' || in_array($taxonomy,$taxonomies)){
				$wpjam_term_option['value']		= isset($wpjam_term_option['default'])?$wpjam_term_option['default']:'';
				$wpjam_taxonomy_options[$key]	= $wpjam_term_option;
			}
		}
		return $wpjam_taxonomy_options;
	}
}

// 添加 Term Meta 添加表单
function wpjam_add_term_form_fields($taxonomy){
	if($wpjam_taxonomy_options = wpjam_get_term_options($taxonomy)) {
		wpjam_form_fields($wpjam_taxonomy_options, 'div', 'form-field');
	}
}

// 添加 Term Meta 编辑表单
function wpjam_edit_term_form_fields($term, $taxonomy=''){
	if($wpjam_taxonomy_options = wpjam_get_term_options($taxonomy)) {
		foreach ($wpjam_taxonomy_options as $key => $field) {
			$wpjam_taxonomy_options[$key]['value']	= get_term_meta($term->term_id, $key, true);
		}

		wpjam_form_fields($wpjam_taxonomy_options, 'tr', 'form-field');
	}
}

// Term 列表显示字段
function wpjam_manage_edit_term_columns($columns){
	$taxonomy = str_replace(array('manage_edit-','_columns'), '', current_filter());

	if($wpjam_taxonomy_options = wpjam_get_term_options($taxonomy)) {
		foreach ($wpjam_taxonomy_options as $key => $field) {
			if(!empty($field['show_admin_column'])){
				$columns[$key]	= $field['title'];
			}
		}
	}

	return $columns;
}

function wpjam_manage_term_custom_column($value, $column_name, $term_id){
	$taxonomy = str_replace(array('manage_','_custom_column'), '', current_filter());

	if($wpjam_taxonomy_options = wpjam_get_term_options($taxonomy)){
		if(isset($wpjam_taxonomy_options[$column_name])){
			return apply_filters('wpjam_manage_term_'.$column_name.'_column', get_term_meta($term_id, $column_name, true), $term_id);
		}
	}
}

function wpjam_manage_edit_term_sortable_columns($columns){
	$taxonomy = str_replace(array('manage_edit-','_sortable_columns'), '', current_filter());

	if($wpjam_taxonomy_options = wpjam_get_term_options($taxonomy)) {
		foreach ($wpjam_taxonomy_options as $key => $field) {
			if(!empty($field['show_admin_column']) && !empty($field['sortable_column'])){
				$columns[$key]	= $key;
			}
		}
	}

	return $columns;
}

add_filter("terms_clauses", 'wpjam_admin_terms_clauses', 10,3 );
function wpjam_admin_terms_clauses( $pieces, $taxonomies, $args){
	if(is_admin() && !empty($args['orderby'])){
		$orderby	= $args['orderby'];
		$taxonomy	= $taxonomies[0];

		if($wpjam_taxonomy_options = wpjam_get_term_options($taxonomy)) {

			if(isset($wpjam_taxonomy_options[$orderby])){
				$sortable_column = isset($wpjam_taxonomy_options[$orderby]['sortable_column'])?$wpjam_taxonomy_options[$orderby]['sortable_column']:'';

				if(!$sortable_column) return $pieces;
				
				global $wpdb;
				$pieces['join']	= $pieces['join'] . " LEFT JOIN {$wpdb->prefix}termmeta AS tm ON t.term_id = tm.term_id";
				$pieces['where']= $pieces['where'] ." AND tm.meta_key = '{$orderby}'";

				if($sortable_column == 'meta_value_num'){
					$pieces['orderby']  = "GROUP BY t.term_id ORDER BY (tm.meta_value + 0)";
				}else{
					$pieces['orderby']  = "GROUP BY t.term_id ORDER BY tm.meta_value";
				}
			}
		}
	}
	return $pieces;
}

// 保存 Term Meta
function wpjam_save_term_fields($term_id, $tt_id, $taxonomy) {
	if(!is_admin()) return;

	if(current_filter() == 'edited_term'){	// 防止点击快速编辑删除 meta 的问题
		global $pagenow;
		if($pagenow != 'edit-tags.php') return;
	}

	if($wpjam_taxonomy_options = wpjam_get_term_options($taxonomy)) {
		foreach ($wpjam_taxonomy_options as $key => $field) {
			wpjam_save_field($key, $field, $term_id, 'term');
		}
	}
}



// Dashboard Widget
add_action('wp_dashboard_setup', 'wpjam_dashboard_setup' );
function wpjam_dashboard_setup() {

	$wpjam_dashboard_widgets = apply_filters('wpjam_dashboard_widgets', array());

	if($wpjam_dashboard_widgets){
		foreach ($wpjam_dashboard_widgets as $widget_id => $wpjam_dashboard_widget) {
			extract(wpjam_parse_dashboard_widget($widget_id, $wpjam_dashboard_widget));
			wp_add_dashboard_widget($widget_id, $title, $callback, null, $args);
		}
	}
}

function wpjam_parse_dashboard_widget($widget_id, $wpjam_dashboard_widget){
	return wp_parse_args( $wpjam_dashboard_widget, array(
		'title'		=> '',
		'callback'	=> str_replace('-', '_', $widget_id).'_dashboard_widget_callback',
		'control'	=> null,
		'args'		=> '',
	) );
}



// 后端字段解析函数
function wpjam_parse_field($field,$sub=false){
	$field['key']	= isset($field['key'])?$field['key']:'';
	$field['name']	= isset($field['name'])?$field['name']:$field['key'];
	$field['type']	= isset($field['type'])?$field['type']:'text';
	$field['value']	= isset($field['value'])?$field['value']:'';

	if(is_admin() && $field['type'] == 'file'){
		$field['type'] = 'image';
	}

	if($field['type'] ==  'mulit_image' || $field['type'] == 'multi_image' || $field['type'] == 'mulit-image' || $field['type'] == 'mulit-image'){
		$field['type']	= 'mu-image';
	}elseif($field['type'] == 'mulit_text' || $field['type'] == 'multi_text' || $field['type'] == 'mulit-text' || $field['type'] == 'multi-text'){
		$field['type']	= 'mu-text';
	}elseif($field['type'] == 'br' ){
		$field['type']	= 'view';
	}

	$default_classes = array(
		'textarea'	=> 'large-text',
		'checkbox'	=> '',
		'radio'		=> '',
		'file'		=> '',
		'select'	=> '',
		'color'		=> ''
	);

	$class	= isset($field['class'])?$field['class']:(isset($default_classes[$field['type']])?$default_classes[$field['type']]:'regular-text');
	$field['class']	= 'type-'.$field['type'].' '.$class ;

	$field['description']	= isset($field['description'])?$field['description']:'';

	if($field['description']){
		if($field['type'] == 'view' || $field['type'] == 'hr'){
			$field['description'] = '';
		}elseif($field['type'] == 'checkbox'){
			$field['description']	= ' <label for="'.$field['key'].'">'.$field['description'].'</label>';	
		}else{
			if($sub === false){
				$field['description']	= '<p>'.$field['description'].'</p>';
			}
		}
	}
	
	$datalist = '';
	if(isset($field['list']) && !empty($field['options'])){
		$datalist	.= '<datalist id="'.$field['list'].'">';
		foreach ($field['options'] as $option) {
			if(is_array($option)){
				$datalist	.= '<option label="'.$option['label'].'" value="'.$option['value'].'" />';
			}else{
				$datalist	.= '<option value="'.$option.'" />';
			}
		}
		$datalist	.= '</datalist>';
	}
	
	$field['datalist'] = $datalist;
	
	$extra	= '';
	foreach ($field as $attr_key => $attr_value) {
		if(is_numeric($attr_key)){
			$extra .= $attr_value.' ';
			if(strtolower(trim($attr_value)) == 'readonly'){
				$field['readonly']	= 1;
			}
			if(strtolower(trim($attr_value)) == 'disabled'){
				$field['disabled']	= 1;
			}
		}elseif( !in_array($attr_key, array('fields','type','name','title','key','description','class','value','default','options','show_admin_column','taxonomies','datalist') ) ) {
			$extra .= $attr_key.'="'.$attr_value.'" ';
		}
	}

	$field['extra'] = $extra;

	return $field;
}

// 获取表单 HTML
function wpjam_get_field_html($field, $sub=false){
	extract(wpjam_parse_field($field,$sub));

	switch ($type) {
		case 'image':
			$field_html	= wpjam_get_input_field_html('url', $name, $key, $class, $value, $extra).'<input type="button" class="wpjam_upload button" value="选择图片">';
			break;

		case 'color':
			$extra		.= 'style="padding:0;margin:0;border:0;background:none;box-shadow:none;-webkit-box-shadow:none;height:28px;"';
			$field_html	= wpjam_get_input_field_html($type, $name, $key, $class, $value, $extra);
			break;

		case 'file':
			$value		= ($value)?'<span style="background-color:yellow; padding:2px;margin:0 4px 0 0;">已上传</span>':'';
			if(empty($field['formenctype'])){
				$extra	.= 'formenctype="multipart/form-data" ';
			}
			$field_html	= $value.wpjam_get_input_field_html($type, $key, $key, $class, '', $extra);
			break;

		case 'range':
			$extra		.=	' onchange="jQuery(\'#'.$key.'_span\').html(jQuery(\'#'.$key.'\').val());"';
			$field_html	= wpjam_get_input_field_html($type, $name, $key, $class, $value, $extra).' <span id="'.$key.'_span">'.$value.'</span>';
			break;

		case 'checkbox':
			if(!empty($field['options'])){
				$field_html	= '';
				foreach ($field['options'] as $option_value => $option_title){ 
					if($value && in_array($option_value, $value)){
						$checked	= " checked='checked'";
					}else{
						$checked	= '';
					}
					$field_html .= wpjam_get_input_field_html($type, $name.'[]', '', $class, $option_value, $checked.$extra).$option_title.'&nbsp;&nbsp;&nbsp;';
				}
			}else{
				$extra		.= checked("1", $value, false);
				$field_html	= wpjam_get_input_field_html($type, $name, $key, $class, '1', $extra);
			}
			break;

		case 'textarea':
			$rows = isset($field['rows'])?$field['rows']:6;
			$field_html = '<textarea name="'.$name.'" id="'.$key.'" class="'.$class.' code" rows="'.$rows.'" cols="50" '.$extra.' >'.esc_textarea($value).'</textarea>';
			break;

		case 'select':
			$field_html	= '<select name="'.$name.'" id="'. $key.'" class="'.$class.'" '.$extra.' >';
			if(!empty($field['options'])){
				foreach ($field['options'] as $option_value => $option_title){ 
					$field_html .= '<option value="'.$option_value.'" '.selected($option_value, $value, false).'>'.$option_title.'</option>';
				}
			}
			$field_html .= '</select>';
			break;

		case 'radio':
			$field_html	= '';
			if(!empty($field['options'])){
				if($value == ''){
					$values	= array_keys($field['options']);
					$value	= $values[0];
				}
				foreach ($field['options'] as $option_value => $option_title) {
					$checked	= checked($option_value, $value, false);
					$field_html	.= '<input type="radio" name="'.$name.'" id="'.$key.'_'.$option_value.'" class="'.$class.'" value="'.$option_value.'" '.$extra.$checked.' /><label for="'.$key.'_'.$option_value.'">'.$option_title."</label>&nbsp;&nbsp;&nbsp;";
				}
			}
			break;

		case 'mu-image':
			$field_html  = '';
			if(is_array($value)){
				foreach($value as $image){
					if(!empty($image)){
						$field_html .= '<span><input type="text" name="'.$name.'[]" id="'.$key.'" class="'.$class.'" value="'.esc_attr($image).'"  /><a href="javascript:;" class="button del_item">删除</a><br /></span>';
					}
				}
			}
			$field_html  .= '<span><input type="text" name="'.$name.'[]" id="'.$key.'" value="" class="'.$class.'" /><input type="button" class="wpjam_multi_upload button" value="选择图片[多选]" title="按住Ctrl点击鼠标左键可以选择多张图片"></span>';
			break;

		case 'mu-img':
			$field_html  = '';

			if(is_array($value)){
				$i = 0;
				foreach($value as $img_id){
					if(!empty($img_id)){
						$img	= wp_get_attachment_image_src($img_id,'full');
						$img_src= $img[0];

						if(function_exists('wpjam_get_thumbnail')){
							$img_src = wpjam_get_thumbnail($img_src, 200);
						}

						$field_html .= '<span class="mu_img"><img width="100" src="'.$img_src.'" alt=""><input type="hidden" name="'.$name.'[]" id="'.$key.'" class="'.$class.'" value="'.$img_id.'"  /><a href="javascript:;" class="del_item">—</a></span>';

						$i++;

						if($i%5 == 0){
							$field_html .= '<br />';
						}
					}
				}
			}
			$field_html  .= '<span style="display:block;"><input type="hidden" name="'.$name.'[]" id="'.$key.'" value="" class="'.$class.'" /><input type="button" class="wpjam_multi_upload2 button" value="选择图片[多选]" title="按住Ctrl点击鼠标左键可以选择多张图片"></span>';
			break;

		case 'mu-text':
			$field_html  = '';
			if(is_array($value)){
				foreach($value as $item){
					if(!empty($item)){
						$field_html .= '<span><input type="text" name="'.$name.'[]" id="'. $key.'" value="'.esc_attr($item).'"  class="'.$class.'" /><a href="javascript:;" class="button del_item">删除</a><br /></span>';
					}
				}
			}
			$field_html .= '<span><input type="text" name="'.$name.'[]" id="'.$key.'" value="" class="'.$class.'" /><a class="wpjam_multi_text button">添加选项</a></span>';
			break;

		case 'view':
			if(!empty($field['options'])){
				$value		= ($value)?$value:0;
				$field_html	= isset($field['options'][$value])?$field['options'][$value]:'';
			}else{
				$field_html	= $value;
			}
			
			break;

		case 'hr':
			$field_html	= '<hr />';
			break;

		case 'fieldset':
			$field_html  = '';
			if(!empty($fields)){
				foreach ($fields as $sub_key=>$sub_field) {
					$sub_field['key']	= $sub_key;
					// $sub_field['value']	= isset($sub_field['value'])?$sub_field['value']:(isset($value[$sub_key])?$value[$sub_key]:'');
					$field_title 		= (!empty($sub_field['title']))?'<label class="sub_field_label" for="'.$sub_key.'">'.$sub_field['title'].'</label>':'';
					$field_html			.= '<p id="p_'.$sub_key.'">'.$field_title.wpjam_get_field_html($sub_field,$sub=true).'</p>';
				}
			}
			break;

		case '':
			$field_html	= $value;
			break;
		
		default:
			$field_html = wpjam_get_input_field_html($type, $name, $key, $class, $value, $extra);
			break;
	}

	return apply_filters('wpjam_field_html', $field_html.$datalist.$description, $field);
}

// 获取 input 表单 HTML
function wpjam_get_input_field_html($type, $name, $key, $class, $value, $extra=''){
	$value	= ($value)?'value="'.esc_attr($value).'"':'';
	$class	= ($class)?'class="'.$class.'"':'';
	return '<input type="'.$type.'" name="'.$name.'" id="'.$key.'" '.$class.' '.$value.' '.$extra.' />';
}

// 获取后台自定义 POST 数据
function wpjam_get_form_post($form_fields, $nonce_action='', $capability='manage_options'){
	global $plugin_page;
	$nonce_action	= $nonce_action ? $nonce_action : $plugin_page;

	check_admin_referer($nonce_action);

	if( !current_user_can( $capability )){
		ob_clean();
		wp_die('无权限');
	}

	$data = array();

	foreach ($form_fields as $key => $form_field) {
		if($form_field['type'] == 'fieldset'){
			if($form_field['fields']){
				foreach ($form_field['fields'] as $sub_key => $sub_form_field) {
					$field_value = wpjam_form_field_validate($sub_key, $sub_form_field);
					if($field_value === false){
						continue;
					}else{
						$data[$sub_key] = $field_value;
					}
				}
			}
		}else{
			$field_value = wpjam_form_field_validate($key, $form_field);
			if($field_value === false){
				continue;
			}else{
				$data[$key] = $field_value;
			}
		}
	}

	return $data;
}

function wpjam_form_field_validate($key, $field){
	$field	= wpjam_parse_field($field);
	$type	= $field['type'];

	if($type == 'view' || $type == 'hr'){
		return false;
	}

	if(!empty($field['readonly']) || !empty($field['diabled'])){
		return false;
	}

	if(isset($field['show_admin_column']) && ($field['show_admin_column'] === 'only')){
		return false;
	}

	$value	= isset($_POST[$key])?$_POST[$key]:'';

	if(in_array($type, array('mu-image','mu-text','mu-img'))){
		if(!is_array($value)){
			$value = '';
		}else{
			foreach($value as $item_key =>$item_value){
				$item_value = trim($item_value);
				if(empty($item_value)){
					unset($value[$item_key]);
				}
			}
		}
	}

	if(!is_array($value)){
		$value	= stripslashes(trim($value));	
	}

	if($type == 'textarea'){
		$value	= str_replace("\r\n", "\n",$value);
	}

	return $value;
}

// 设置自定义页面的字段
function wpjam_get_form_fields(){
	global $plugin_page;
	return apply_filters($plugin_page.'_fields', array());
}

// 编辑表单
function wpjam_form($form_fields, $form_url, $nonce_action='', $submit_text=''){
	global $plugin_page;
	$nonce_action	= $nonce_action ? $nonce_action : $plugin_page;

	wpjam_admin_errors();	// 显示错误
	?>
	<form method="post" action="<?php echo $form_url; ?>" enctype="multipart/form-data" id="form">
		<?php wpjam_form_fields($form_fields); ?>
		<?php wp_nonce_field($nonce_action);?>
		<?php wp_original_referer_field(true, 'previous');?>
		<?php if($submit_text!==false){ submit_button($submit_text); } ?>
	</form>
	<?php
}

// 显示字段
function wpjam_form_fields($fields, $fields_type = 'table', $item_class=''){
	$item_class			= ($item_class)?' class="'.$item_class.'"':''; 

	$new_fields = array();
	foreach($fields as $key => $field){ 

		if(isset($field['show_admin_column']) && ($field['show_admin_column'] === 'only')){
			continue;
		}
		
		$field['key']		= $key;
		$field_html			= wpjam_get_field_html($field);
		$field_title 		= (!empty($field['title']))?($field['type']=='fieldset'?$field['title']:'<label for="'.$key.'">'.$field['title'].'</label>'):'';

		$new_fields[$key]	= array('title'=>$field_title, 'html'=>$field_html, 'type'=>$field['type']);
	}
	?>
	<?php if($fields_type == 'list'){ ?>
	<ul>
	<?php foreach ($new_fields as $key=>$field) { ?>
		<li<?php echo $item_class; ?>><?php echo $field['title']; ?> <?php echo $field['html']; ?> </li>
	<?php } ?>
	</ul>
	<?php } elseif($fields_type == 'table'){ ?>
	<table class="form-table" cellspacing="0">
		<tbody>
		<?php foreach ($new_fields as $key=>$field) { ?>
		<?php if($field['type'] == 'hidden'){ ?>
			<?php echo $field['html']; ?>
		<?php }else{ ?>
			<tr<?php echo $item_class; ?> valign="top" id="tr_<?php echo $key; ?>">
			<?php if($field['title']) { ?>
				<th scope="row"><?php echo $field['title']; ?></th>
				<td><?php echo $field['html']; ?></td>
			<?php } else { ?>
				<th colspan="2"><?php echo $field['html']; ?></th>
			<?php } ?>
			</tr>
		<?php }?>
		<?php } ?>
		</tbody>
	</table>
	<?php } elseif($fields_type == 'tr') { ?>
		<?php foreach ($new_fields as $key=>$field) { ?>
		<?php if($field['type'] == 'hidden'){ ?>
			<?php echo $field['html']; ?>
		<?php }else{?>
			<tr<?php echo $item_class; ?> id="tr_<?php echo $key; ?>">
			<?php if($field['title']) { ?>
				<th scope="row"><?php echo $field['title']; ?></th>
				<td><?php echo $field['html']; ?></td>
			<?php } else { ?>
				<th colspan="2"><?php echo $field['html']; ?></th>
			<?php } ?>
			</tr>
		<?php } ?>
		<?php } ?>
	<?php } elseif($fields_type == 'div') { ?> 
		<?php foreach ($new_fields as $key=>$field) { ?>
		<?php if($field['type'] == 'hidden'){ ?>
			<?php echo $field['html']; ?>
		<?php }else{?>
			<div<?php echo $item_class; ?> id="div_<?php echo $key; ?>">
				<?php echo $field['title']; ?>
				<?php echo $field['html']; ?>
			</div>
		<?php } ?>
		<?php } ?>
	<?php } ?>
	<?php
}

add_action( 'admin_notices', 'wpjam_admin_notices' );
function wpjam_admin_notices() {
	if(!current_user_can('manage_options')){
		return;
	}

	if(!empty($_GET['notice_time']) && !empty($_GET['notice_key'])){
		wpjam_delete_admin_notice($_GET['notice_time'], $_GET['notice_key']);
	}

	$admin_notices	= get_option('admin_notices');

	if(!$admin_notices){
		return;
	}

	krsort($admin_notices);
	foreach ($admin_notices as $time => $admin_notice_list) {

		if(!$admin_notice_list){
			unset($admin_notices[$time]);
			update_option('admin_notices', $admin_notices);
			continue;
		}

		foreach ($admin_notice_list as $key => $admin_notice) {

			extract(wp_parse_args( $admin_notice, array(
				'page'		=> '',
				'type'		=> 'updated',
				'tab'		=> '',
				'link'		=> '',
				'notice'	=> ''
			)));

			if($link && $page){
				$link	= admin_url('admin.php?notice_time='.$time.'&notice_key='.$key.'&page='.$page);
				$link	= ($tab)?$link.'&tab='.$tab:$link;
				$link	= '<a href="'.$link.'">查看详情</a> | ';
			}

			$hide_link	= '<a href="javascript:" class="admin_notice_hide" data-key="'.$key.'" data-time="'.$time.'">我知道了</a>';

			echo '<div id="admin_notice_'.$key.'_'.$time.'" class="'.$type.'"><p><strong>'.$notice.'</strong>'.$link.$hide_link.'</p></div>';
		}	
	}
}


function wpjam_add_admin_notice($admin_notice){
	$admin_notices	= get_option('admin_notices');
	$admin_notices	= ($admin_notices)?$admin_notices:array();

	if(count($admin_notices) > 20){
		array_pop($admin_notices);	// 删除最后一个
	}

	$time	= time();
	$key 	= md5(serialize($admin_notice));

	$admin_notices[$time][$key] = $admin_notice;
	krsort($admin_notices);

	update_option('admin_notices', $admin_notices);
}

function wpjam_delete_admin_notice($time, $key){
	$admin_notices	= get_option('admin_notices');
	if(!$admin_notices || empty($admin_notices[$time]) || empty($admin_notices[$time][$key])){
		return false;
	}

	unset($admin_notices[$time][$key]);
	if(empty($admin_notices[$time])){
		unset($admin_notices[$time]);
	}

	// if($admin_notices){
		update_option('admin_notices', $admin_notices);
	// }else{
		update_option('admin_notices', '');
	// }

	global $wpdb;
}

add_action('wp_ajax_delete_admin_notice', 'wpjam_ajax_delete_admin_notice_action_callback');
function wpjam_ajax_delete_admin_notice_action_callback(){
	check_ajax_referer( "wpjam_setting_nonce" );
	$key	= $_POST['key'];
	$time	= $_POST['time'];
	wpjam_delete_admin_notice($time, $key);
}



// 获取页面来源
function wpjam_get_referer(){
	$referer	= wp_get_original_referer();
	$referer	= ($referer)?$referer:wp_get_referer();

	$removable_query_args	= array_merge( 
		wpjam_get_removable_query_args(),
		array('_wp_http_referer','id','action',	'action2', '_wpnonce')
	);

	return remove_query_arg($removable_query_args, $referer);	
}

add_filter('removable_query_args', 'wpjam_get_removable_query_args');
function wpjam_get_removable_query_args(){
	$removable_query_args = array(
		'message', 'settings-updated', 'saved', 
		'update', 'updated', 'activated', 
		'activate', 'deactivate', 'locked', 
		'deleted', 'trashed', 'untrashed', 
		'enabled', 'disabled', 'skipped', 
		'spammed', 'unspammed', 'added',
		'duplicated', 'approved', 'unapproved',
		'geted', 'created', 'synced',
	);

	return $removable_query_args;
}

// 后台表单 JS
add_action('admin_enqueue_scripts', 'wpjam_upload_image_enqueue_scripts');
function wpjam_upload_image_enqueue_scripts() {
	wp_enqueue_media();
	wp_enqueue_script('wpjam-setting', plugins_url('/wpjam-setting-2.js', __FILE__), array('jquery'));
	wp_localize_script('wpjam-setting', 'wpjam_setting', array(
		'ajax_url'	=> admin_url('admin-ajax.php'),
		'nonce'		=> wp_create_nonce('wpjam_setting_nonce')
	));

	wp_enqueue_style('wpjam-style', plugins_url('/wpjam-style-2.css', __FILE__));
}



// 错误处理
function wpjam_admin_add_error($message='', $type='updated'){
	global $wpjam_errors;
	$wpjam_errors[$type][] = $message; 
}

function wpjam_admin_get_errors(){

	$removable_query_args	= wpjam_get_removable_query_args();

	if($removable_query_args = array_intersect($removable_query_args, array_keys($_GET))){
		foreach ($removable_query_args as $key) {
			if($key != 'message' && $key != 'settings-updated'){
				if($_GET[$key] === 'true' || $_GET[$key] === '1'){
					wpjam_admin_add_error('操作成功');
				}else{
					wpjam_admin_add_error($_GET[$key],'error');
				}
			}
		}
	}

	global $wpjam_errors;
	$msgs = '';
	foreach (array('updated', 'error') as $type) {
		$msg = '';
		if(isset($wpjam_errors[$type])){
			foreach ($wpjam_errors[$type] as $message) {
				if(is_wp_error($message)){
					$message = $message->get_error_code().'-'.$message->get_error_message();
				}
				$msg .= '<p><strong>'.$message.'</strong></p>';
			}
			$msg = '<div class="'.$type.'">'.$msg.'</div>';
		}
		$msgs .= $msg;
	}
	return $msgs;
}

function wpjam_admin_errors(){
	echo wpjam_admin_get_errors();
}

// 获取设置
function wpjam_get_setting($option, $setting_name){
	if(is_string($option)) $option = wpjam_get_option($option);
	return isset($option[$setting_name])?str_replace("\r\n", "\n", $option[$setting_name]):'';
}

// 获取选项
function wpjam_get_option($option_name){
	$defaults	= wpjam_get_default_option( $option_name );
	$option		= ( is_multisite() && is_network_admin() ) ? get_site_option( $option_name ):get_option( $option_name );
	return wp_parse_args( $option, $defaults);
}

// 获取默认选项
function wpjam_get_default_option($option_name){
	$defaults	= apply_filters($option_name.'_defaults', array());

	if(is_multisite() && !is_network_admin()){
		$site_option	= get_site_option( $option_name );
		$defaults		= wp_parse_args( $site_option, $defaults);
	}

	return $defaults;
}

// 获取当前页面 url
function wpjam_get_current_page_url(){
	$ssl		= (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true:false;
	$sp			= strtolower($_SERVER['SERVER_PROTOCOL']);
	$protocol	= substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
	$port		= $_SERVER['SERVER_PORT'];
	$port		= ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
	$host		= isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
	return $protocol . '://' . $host . $port . $_SERVER['REQUEST_URI'];
}


add_action('admin_init', 'wpjam_admin_init',1);
function wpjam_admin_init(){
	global $plugin_page, $current_tab;

	if(!isset($current_tab)){
		$current_tab = isset($_GET['tab'])?$_GET['tab']:'';
	}

	if($plugin_page && wpjam_get_admin_page($plugin_page)){
		$function_prefix = str_replace('-', '_', $plugin_page);
	
		if(function_exists($function_prefix.'_tabs')){
			add_filter($plugin_page.'_tabs', $function_prefix.'_tabs',1);
		}

		if(function_exists($function_prefix.'_fields')){
			add_filter($plugin_page.'_fields', $function_prefix.'_fields',1);
		}

		if(function_exists($function_prefix.'_page_load')){
			add_action($plugin_page.'_page_load', $function_prefix.'_page_load',1);
		}
	}
}

// 打印
function wpjam_print_r($value){
	$capability	= (is_multisite())?'manage_site':'manage_options';
	if(current_user_can($capability)){
		echo '<pre>';
		print_r($value);
		echo '</pre>';
	}
}

function wpjam_var_dump($value){
	$capability	= (is_multisite())?'manage_site':'manage_options';
	if(current_user_can($capability)){
		echo '<pre>';
		var_dump($value);
		echo '</pre>';
	}
}

