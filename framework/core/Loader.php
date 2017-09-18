<?php
namespace Framework\core;

use Framework\App;
use Framework\Exceptions\CoreHttpException;

class Loader
{
	// 类名映射
	public static $map = [];

	// 类名空间映射
	public static $namespaceMap = [];

	// 启动注册
	public static function register($app)
	{
		self::$namespaceMap = [
            'Framework' => $app->rootPath
        ];
        // 注册框架加载函数　不使用composer加载机制加载框架　自己实现
        spl_autoload_register(['Framework\core\Loader', 'autoload']);
        // 引入composer自加载文件
        require($app->rootPath . '/vendor/autoload.php');
	}

	/**
	 * 自动加载函数
	 * @return [type] [description]
	 */
	public function autoload($class)
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
