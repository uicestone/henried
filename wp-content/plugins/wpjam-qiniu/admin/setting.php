<?php
add_filter('wpjam_settings', 'wpjam_qiniutek_settings');
function wpjam_qiniutek_settings($wpjam_settings){
	$wpjam_settings['wpjam-qiniutek']['sections'] = array( 
		'qiniutek'	=> array(
			'title'		=>'七牛设置',		
			'fields'	=>array(
				'host'		=> array('title'=>'七牛域名',		'type'=>'url',	'description'=>'设置为七牛提供的测试域名或者在七牛绑定的域名。<strong>注意要域名前面要加上 http://</strong>。<br />如果博客安装的是在子目录下，比如 http://www.xxx.com/blog，这里也需要带上子目录 /blog '),
				'bucket'	=> array('title'=>'七牛空间名',	'type'=>'text',	'description'=>'设置为你在七牛提供的空间名。'),
				'access'	=> array('title'=>'ACCESS KEY',	'type'=>'text'),
				'secret'	=> array('title'=>'SECRET KEY',	'type'=>'text'),
			),
			'summary'	=>'<p><strong">* 使用上有任何问题，请点击查看：<a href="'.admin_url('admin.php?page=wpjam-topics&action=reply&id=4').'">七牛镜像云存储WordPress插件常见问题</a></strong>。<br />* 充值可以使用WordPress插件用户专属的优惠码：“<span style="color:red; font-weight:bold;">d706b222</span>”，点击查看<a title="如何使用七牛云存储的优惠码" class="thickbox" href="'.admin_url('admin.php?page=wpjam-qiniutek-coupon').'&amp;TB_iframe=true&amp;width=420&amp;height=480">详细使用指南</a>。</p>'
		),
		'local'		=> array(
			'title'		=>'本地设置',		
			'fields'	=>array(		
				'exts'		=> array('title'=>'扩展名',		'type'=>'text',	'description'=>'设置要缓存静态文件的扩展名，请使用 | 分隔开，|前后都不要留空格。'),
				'dirs'		=> array('title'=>'目录',		'type'=>'text',	'description'=>'设置要缓存静态文件所在的目录，请使用 | 分隔开，|前后都不要留空格。'),
				'local'		=> array('title'=>'本地域名',		'type'=>'url',	'description'=>'如果图片等静态文件存储的域名和网站不同，可通过该字段设置。<br />使用该字段设置静态文件所在的域名之后，请确保 JS 和 CSS 等文件也在该域名下，否则将不会加速。'),
				'jquery'	=> array('title'=>'使用 jQuery 2.0',	'type'=>'checkbox',	'description'=>'jQuery 2.0 不再支持 IE 6/7/8，如果你的网站是面向移动或者不再向低端 IE 用户提供服务，可以勾选该选项。'),
				'useso'		=> array('title'=>'使用 360 公共库',	'type'=>'checkbox',	'description'=>'使用 360 网站卫士常用前端公共库 CDN 服务替换 Google 前端公共库和字体库。'),
				'emoji'		=> array('title'=>'屏蔽 Emoji',	'type'=>'checkbox',	'description'=>'屏蔽 Emoji 功能，防止因为加载 Emoji 图片而拖慢访问速度！'),
			)	
		),
		'thumb'		=> array(
			'title'		=>'缩略图设置',	
			'fields'	=>array(
				'advanced'	=> array('title'=>'高级缩略图',	'type'=>'checkbox',	'description'=>'启用高级缩略图，可以设置分类和标签缩略图。'),
				'default'	=> array('title'=>'默认缩略图',	'type'=>'image',	'description'=>'如果日志没有特色图片，没有第一张图片，也没用高级缩略图的情况下所用的缩略图。可以填本地或者七牛的地址！'),
				'width'		=> array('title'=>'图片最大宽度',	'type'=>'number',	'description'=>'设置博客文章内容中图片的最大宽度，插件会使用将图片缩放到对应宽度，节约流量和加快网站速度加载。'),
				//'new_smileys'=> array('title'=>'使用高清表情',	'type'=>'checkbox',	'description'=>''),
			),	
			'summary'	=>'<p>*启动高级缩略图功能之后，文章获取缩略图的顺序为：<br />特色图片 > 标签缩略图 > 第一张图片 > 分类缩略图 > 默认缩略图。</p>'
		),
		'remote'	=> array(
			'title'		=>'远程图片设置',	
			'fields'	=>array(
				'remote'	=> array('title'=>'保存远程图片',	'type'=>'checkbox',	'description'=>'自动将远程图片镜像到七牛。'),
				'exceptions'=> array('title'=>'例外',		'type'=>'textarea',	'class'=>'regular-text',	'description'=>'如果远程图片的链接中包含以上字符串或者域名，就不会被保存并镜像到七牛。'),
			),	
			'summary'	=>'<p>*自动将远程图片镜像到七牛需要你的博客支持固定链接。<br />*如果前面设置的静态文件域名和博客域名不一致，该功能也可能出问题。<br />*远程 GIF 图片保存到七牛将失去动画效果，所以目前不支持 GIF 图片。</p>'
		),
		'watermark'	=> array(
			'title'		=>'水印设置',		
			'fields'	=>array(
				'watermark'	=> array('title'=>'水印图片',		'type'=>'image',	'description'=>'水印图片'),
				'disslove'	=> array('title'=>'透明度',		'type'=>'number',	'description'=>'透明度，取值范围1-100，缺省值为100（完全不透明）','min'=>1,	'max'=>100),
				'gravity'	=> array('title'=>'水印位置',		'type'=>'select',	'description'=>'',	'options'=>array('SouthEast' => '右下角', 'SouthWest'	=> '左下角', 'NorthEast'	=> '右上角', 'NorthWest' => '左上角', 'Center' => '正中间', 'West' => '左中间', 'East' => '右中间','North' => '上中间', 'South' => '下中间')),
				'dx'		=> array('title'=>'横轴边距',		'type'=>'number',	'description'=>'横轴边距，单位:像素(px)，缺省值为10'),
				'dy'		=> array('title'=>'纵轴边距',		'type'=>'number',	'description'=>'纵轴边距，单位:像素(px)，缺省值为10'),
			),	
		),
		// 'related'	=> array(
		// 	'title'		=>'相关日志',		
		// 	'fields'	=>array(
		// 		'related'	=> array('title'=>'自动插入',		'type'=>'checkbox',	'description'=>'在文章底部自动插入相关日志'),
		// 		'rp-width'	=> array('title'=>'缩略图宽度',	'type'=>'number',	'description'=>'不填则相关日志不使用缩略图'),
		// 		'rp-height'	=> array('title'=>'缩略图高度',	'type'=>'number',	'description'=>''),
		// 	),	
		// )
	);
	return $wpjam_settings;
}

add_filter('wpjam-qiniutek_field_validate','wpjam_qiniutek_field_validate');
function wpjam_qiniutek_field_validate( $wpjam_qiniutek ) {
	flush_rewrite_rules();
	return $wpjam_qiniutek;
}

add_action('wpjam-qiniutek_option_page', 'wpjam_qiniutek_option_page');
function wpjam_qiniutek_option_page(){
	add_thickbox();
}

