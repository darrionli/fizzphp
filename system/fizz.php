<?php
namespace system;
class Fizz{
	public static $classObj = array();
	public function __construct(){}

	public static function run(){
		new \system\core\route();
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
