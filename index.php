<?php
/**
* 入口文件
* 1、定义常量
* 2、加载函数库
* 3、启动框架
*/
define('APPPATH',str_replace('\\','/',realpath(dirname(__FILE__).'/')));//项目所在的根目录
define('SYSTEM', APPPATH.'/system');		//项目的核心文件
define('APP', APPPATH.'/application');	//项目文件
define('DEBUG', TRUE);
if(DEBUG){
	ini_set('display_error','On');
}else{
	ini_set('display_error','Off');
}
include SYSTEM.'/common/function.php';
include SYSTEM.'/fizz.php';
spl_autoload_register('\system\fizz::autoload');
\system\Fizz::run();