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
require __DIR__ . '/Processing/PersistentFop.php';
require __DIR__ . '/Http/Client.php';
require __DIR__ . '/Http/Request.php';
require __DIR__ . '/Http/Response.php';

use Qiniu\Auth;

function qiniu_get_real_download_url($path, $expires = 60){
	$auth = new Auth(get_option('qiniu_access_key'), get_option('qiniu_secret_key'));
	return $auth->privateDownloadUrl(get_option('qiniu_host') . trim($path), $expires);
}

function qiniu_concat_video($paths){
	$auth = new Auth(get_option('qiniu_access_key'), get_option('qiniu_secret_key'));
	$process = new \Qiniu\Processing\PersistentFop($auth, 'henried');

	$arg = 'avconcat/2/format/mp4';

	foreach(array_slice($paths, 1) as $path)
	{
		$arg .= '/' . \Qiniu\base64_urlSafeEncode(qiniu_get_real_download_url(trim($path), 7200));
	}

	return $process->execute($paths[0], $arg);
}

function qiniu_get_pfop_status($id){
	return \Qiniu\Processing\PersistentFop::status($id);
}

