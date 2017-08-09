<?php
/**
 * 单例模式
 * 通常通过实现一个静态方法getInstance来实现，这个方法只返回唯一的实例，常用在数据库、日志系统
 * 构造和克隆方法被定位私有，为了防止new或者clone错误的创建第二个实例
 */
class Db{
	private static $dbObj = NULL;
	private function __construct(){}
	private function __clone(){}
	public static function getInstance()
	{
		if(self::$dbObj === NULL){
			self::$dbObj = new DB();
		}
		return self::$dbObj;
	}
	public function getName(){
		echo 'this is a singleton pattern';
	}
}

Db::getInstance()->getName();
