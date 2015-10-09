<?php
/*
Plugin Name: Qiniu
Plugin URI: https://github.com/qiniu/php-sdk
Description: Qiniu Resource (Cloud) Storage SDK for PHP.
Author: qiniu
Version: 7.0.4
Author URI: http://www.qiniu.com/
*/

require __DIR__ . '/Auth.php';
require __DIR__ . '/Config.php';
require __DIR__ . '/functions.php';

use Qiniu\Auth;

function qiniu_get_real_download_url($path){
	$auth = new Auth(get_option('qiniu_access_key'), get_option('qiniu_secret_key'));
	return $auth->privateDownloadUrl(get_option('qiniu_host') . trim($path), 30);
}

