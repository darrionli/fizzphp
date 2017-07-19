<?php
/**
* 框架入口文件
*/

// 错误调试模式
define('ERRORDEBUG', TRUE);
if(ERRORDEBUG){
	ini_set('display_errors', 0);
	if (version_compare(PHP_VERSION, '5.3', '>='))
	{
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
	}
	else
	{
		error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
	}
}else{
	error_reporting(-1);
	ini_set('display_errors', 1);
}

// 框架核心文件
$system_path = 'system';

// 应用文件
$app_folder = '../../application';

// 视图层文件
$view_folder = '';

if(($_temp = realpath($system_path)) !== FALSE){
	$system_path = $_temp.DIRECTORY_SEPARATOR;
}else{
	$system_path = strtr(
			rtrim($system_path, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		).DIRECTORY_SEPARATOR;
}

if (!is_dir($system_path))
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
	exit;
}

// 项目所在的根目录
define('ROOTPATH',str_replace('\\',DIRECTORY_SEPARATOR,realpath(dirname(__FILE__).'/')));
// 核心文件夹路径
define('SYSTEMPATH', $system_path);
// 应用目录
define('APPPATH', ROOTPATH.DIRECTORY_SEPARATOR.'application');
// 视图层目录
define('VIEWPATH', ROOTPATH.DIRECTORY_SEPARATOR.'view');

include SYSTEMPATH.'common'.DIRECTORY_SEPARATOR.'function.php';
include SYSTEMPATH.'fizz.php';

spl_autoload_register('\system\fizz::autoload');
\system\Fizz::run();
