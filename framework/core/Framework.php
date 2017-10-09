<?php
namespace Framework\core;

class Framework
{
	public static function run()
	{
		self::init();
		self::autoload();
		self::dispatch();
	}

	private static function init()
	{
	    session_start();
	}

	/**
	 * 自动加载
	 */
	private static function autoload()
	{
		spl_autoload_register(array(__CLASS__, 'load'));
	}

	/**
	 * 自动加载的具体实现
	 */
	private static function load($classname)
	{
		echo $classname;
		$classFile = APPPATH . 'controllers' . $classname . '.php';
		if(file_exists($classFile)){
			require $classFile;
		}else{
			throw new Exception("$classname Not Found", 1);
		}
	}


	/**
	 * 路由与分发
	 */
	private static function dispatch()
	{
		$controller_name = CONTROLLER . "Controller";

	    $action_name = ACTION . "Action";

	    $controller = new $controller_name;

	    $controller->$action_name();
	}
}
