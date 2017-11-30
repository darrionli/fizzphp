<?php
namespace Framework\core;

class Framework
{
	/*类名映射*/
	public static $map = [];

	/*类命名空间映射*/
	public static $namespaceMap = [];

	// 启动注册
	public static function register(app $app)
	{
		self::$namespaceMap = ['Framework'=>$app->rootPath];
		spl_autoload_register(['Framework\core', 'autoload']);
	}

	// 自动加载函数
	private static function autoload($class)
	{
		$classOrigin = $class;
        $classInfo   = explode('\\', $class);
        $className   = array_pop($classInfo);
        foreach ($classInfo as &$v) {
            $v = strtolower($v);
        }
        unset($v);
        array_push($classInfo, $className);
        $class       = implode('\\', $classInfo);
        $path        = self::$namespaceMap['Framework'];
        $classPath   = $path . '/'.str_replace('\\', '/', $class) . '.php';
        if (!file_exists($classPath)) {
            // 框架级别加载文件不存在　composer加载
            return;
            throw new CoreHttpException(404, "$classPath Not Found");
        }
        self::$map[$classOrigin] = $classPath;
        require $classPath;
	}
}
