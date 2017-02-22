<?php
global $wpdb;
$wpdb->ips	= $wpdb->base_prefix . 'ips';

wp_cache_add_global_groups(array('wpjam-ip'));

// 根据 IP 地址获取地区
function wpjam_get_ipdata($ip=''){
	if(!$ip) $ip = wpjam_get_ip();

	if($ip == 'unknown'){
		return false;
	}

	$mon_ipdata	= wpjam_get_17mon_ipdata($ip);

	$ipdata			= array(
		'ip'		=> $ip,
		'country'	=> isset($mon_ipdata['0'])?$mon_ipdata['0']:'',
		'region'	=> isset($mon_ipdata['1'])?$mon_ipdata['1']:'',
		'city'		=> isset($mon_ipdata['2'])?$mon_ipdata['2']:'',
		'isp'		=> '',
		'last_update'=> current_time('timestamp') 
	);

	return $ipdata;
}

function wpjam_get_ip(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //check ip from share internet
		return $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		return $_SERVER['REMOTE_ADDR'];
	}
	return '';
}

function wpjam_get_17mon_ipdata($ip){
	if(!class_exists('IP')){
		include(WPJAM_BASIC_PLUGIN_DIR.'include/ip.php');
	}
	return IP::find($ip);
}

function wpjam_get_taobao_ipdata($ip){
	$url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;

	$response = wpjam_remote_request($url, array(), array('errcode'=>'code', 'errmsg'=>'data'));

	if(is_wp_error($response)){
		return $response;
	}

	return $response['data'];
}

function wpjam_get_baidu_ipdata($ip){

	$url		= 'http://apis.baidu.com/apistore/iplookupservice/iplookup?ip='.$ip;
	$response	= wpjam_baidu_api_remote_request($url);

	if(is_wp_error($response)){
		return $response;
	}

	return $response['retData'];
}

// 根据 User Agent 获取手机系统和型号
function wpjam_get_ua_data($ua=''){
	if(!$ua) $ua = wpjam_get_ua();
	$ua = $ua.' ';	// 为了特殊情况好匹配

	$os	= $os_ver = $device	= $build = $weixin_ver = $net_type = '';

	if(preg_match('/MicroMessenger\/(.*?)\s/', $ua, $matches)){
		$weixin_ver = $matches[1];
	}

	if(preg_match('/NetType\/(.*?)\s/', $ua, $matches)){
		$net_type = $matches[1];
	}

	if(stripos($ua, 'iPod')){
		$device = 'iPod';
		$os 	= 'iOS';
		$os_ver	= wpjam_get_ios_version($ua);
		//$build	= wpjam_get_ios_build($ua);
	}elseif(stripos($ua, 'iPad')){
		$device = 'iPad';
		$os 	= 'iOS';
		$os_ver	= wpjam_get_ios_version($ua);
		//$build	= wpjam_get_ios_build($ua);
	}elseif(stripos($ua, 'iPhone')){
		$device = 'iPhone';
		$os 	= 'iOS';
		$os_ver	= wpjam_get_ios_version($ua);
		//wo$build	= wpjam_get_ios_build($ua);
	}elseif(stripos($ua, 'Android')){
		$os		= 'Android';

		if(preg_match('/Android ([0-9\.]{1,}?); (.*?) Build\/(.*?)[\)\s;]{1}/i', $ua, $matches)){
			if(!empty($matches[1]) && !empty($matches[2])){
				$os_ver	= trim($matches[1]);
				$device	= $matches[2];
				if(strpos($device,';')!==false){
					$device	= substr($device, strpos($device,';')+1, strlen($device)-strpos($device,';'));
				}
				$device	= trim($device);
				$build	= trim($matches[3]);
			}
		}
		// $regex_lang = '/Android (.*?); (.*?); (.*?)\/(.*?)[\)\s]{1}/i';
		// $regex 		= '/Android (.*?); (.*?)\/(.*?)[\)\s]{1}/i';
		// if(preg_match($regex_lang, $ua, $matches)) {
		// 	$os_ver		= trim($matches[1]);
		// 	//$language	= $matches[2];
		// 	$device		= trim(str_replace('Build', '', $matches[3]));
		// 	$build		= trim($matches[4]);
		// }elseif(preg_match($regex, $ua, $matches)) {
		// 	$os_ver		= trim($matches[1]);
		// 	$device		= trim(str_replace('Build', '', $matches[2]));
		// 	$build		= trim($matches[3]);
		// }
	}elseif(stripos($ua, 'Windows NT')){
		$os		= 'Windows';
	}elseif(stripos($ua, 'Macintosh')){
		$os		= 'Macintosh';
	}elseif(stripos($ua, 'Windows Phone')){
		$os		= 'Windows Phone';
	}elseif(stripos($ua, 'BlackBerry') || stripos($ua, 'BB10')){
		$os		= 'BlackBerry';
	}elseif(stripos($ua, 'Symbian')){
		$os		= 'Symbian';
	}else{
		$os		= 'unknown';
	}

	return compact("os", "os_ver", "device", "build", "weixin_ver", "net_type");
}

function wpjam_get_ua(){
	return isset( $_SERVER['HTTP_USER_AGENT'] ) ? substr( $_SERVER['HTTP_USER_AGENT'], 0, 254 ) : '';
}

// 获取 iOS 版本
function wpjam_get_ios_version($ua){
	if(preg_match('/OS (.*?) like Mac OS X[\)]{1}/i', $ua, $matches)){
		return trim($matches[1]);
	} 
}

function wpjam_get_ios_build($ua){
	if(preg_match('/Mobile\/(.*?)\s/i', $ua, $matches)){
		return trim($matches[1]);
	}
}

// 获取所有移动设备
function wpjam_get_devices($return = ''){
	$devices	= wp_cache_get('all','wpjam_device');
	if($devices === false){
		global $wpdb;
		$devices	= $wpdb->get_results("SELECT * FROM {$wpdb->devices}", ARRAY_A);
		wp_cache_set('all', $devices, 'wpjam-device', 30);
	}

	if($return == 'all'){
		return $devices;
	}else{
		$new_devices = array();
		foreach ($devices as $device) {
			$device_key = strtoupper($device['device']);
			$new_devices[$device_key] = $device['name'];
		}
		return $new_devices;
	}
}

function wpjam_get_apple_devices(){
	$devices	= wp_cache_get('apple','wpjam-device');
	if($devices === false){
		global $wpdb;
		$devices	= $wpdb->get_results("SELECT device,name FROM {$wpdb->devices} WHERE brand='Apple'", OBJECT_K);
		wp_cache_set('apple', $devices, 'wpjam-device', 3600);
	}

	return $devices;
}

// 获取具体某款设备的信息
function wpjam_get_device($device = ''){
	$device_array = wp_cache_get($device, 'wpjam-device');

	if($device_array === false){
		global $wpdb;
		$device_array = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->devices} WHERE device = %s",$device), ARRAY_A);
		wp_cache_set($device, $device_array, 'wpjam-device', 36000);
	}
	
	return $device_array;
}


add_action("wp_head","wpjam_stats");
function wpjam_stats(){ 
if(is_preview())return;
$remove_query_args = array('from','isappinstalled','weixin_user_id','weixin_refer');
if(function_exists('weixin_robot_get_user_query_key')){
	$remove_query_args[] = weixin_robot_get_user_query_key();
}
$stats_page_url = remove_query_arg($remove_query_args,$_SERVER["REQUEST_URI"]);
$stats_page_url	= (is_404())?'/404.'.$stats_page_url:$stats_page_url;
$stats_page_url = apply_filters('wpjam_stats_page_url', $stats_page_url);
?>
<?php if($google_analytics_id = wpjam_basic_get_setting('google_analytics_id')){ ?>
<!-- Google Analytics Begin-->
<?php if(wpjam_basic_get_setting('google_universal')){ ?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', '<?php echo $google_analytics_id;?>', 'auto');
ga('require', 'displayfeatures');
ga('send', 'pageview', '<?php echo $stats_page_url; ?>');
<?php if(!empty($_GET['from']) && isset($_GET['isappinstalled'])){ ?>
ga('send', 'event', 'weixin', 'from', '<?php echo $_GET['from'];?>');
<?php } ?>
</script>
<?php } else { ?>
<script type="text/javascript">
var _gaq = _gaq || [];
var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
_gaq.push(['_require', 'inpage_linkid', pluginUrl]);
_gaq.push(['_setAccount', '<?php echo $google_analytics_id;?>']);
_gaq.push(['_trackPageview', '<?php echo $stats_page_url; ?>']);
_gaq.push(['_trackPageLoadTime']);
(function() {
	var ga = document.createElement('script');
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	ga.setAttribute('async', 'true');
	document.getElementsByTagName('head')[0].appendChild(ga);
})();
</script>
<?php } ?>
<!-- Google Analytics End -->
<?php } ?>

<?php if($baidu_tongji_id = wpjam_basic_get_setting('baidu_tongji_id')){ ?>
<!-- Baidu Tongji Start -->
<script type="text/javascript">
var _hmt = _hmt || [];
_hmt.push(['_setAutoPageview', false]);
_hmt.push(['_trackPageview', '<?php echo $stats_page_url; ?>']);
<?php if(!empty($_GET['from']) && isset($_GET['isappinstalled'])){ ?>
_hmt.push(['_trackEvent', 'weixin', 'from', '<?php echo $_GET['from'];?>']);
<?php } ?>
(function() {
var hm = document.createElement("script");
hm.src = "//hm.baidu.com/hm.js?<?php echo $baidu_tongji_id;?>";
hm.setAttribute('async', 'true');
document.getElementsByTagName('head')[0].appendChild(hm);
})();
</script>
<!-- Baidu Tongji  End -->
<?php } ?>

<?php }