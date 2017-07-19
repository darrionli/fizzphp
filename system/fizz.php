<?php
namespace system;
class Fizz{
	public static $classObj = array();
	public function __construct(){}

	public static function run(){
		$route = new \system\core\route();
		$controller = $route->controller;
		$action = $route->action;
		$includefile = APPPATH.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.$controller.'.php';
		if(is_file($includefile)){
			// include $includefile;
			// $control = new $controller;
			// $control->$action();
		}else{
			throw new \Exception("没有找到".$controller.'.php文件');
		}
	}

	//类的自动加载
	public static function autoload($class){
		$class = str_replace('\\','/',$class);
		$file = ROOTPATH.'/'.$class.'.php';
		if(isset(self::$classObj[$class])){
			return true;
		}else{
			if(is_file($file)){
				include $file;
				self::$classObj[$class] = $class;
			}else{
				return false;
			}
		}
	}
}
