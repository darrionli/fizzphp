<?php
// 定义框架常量
define('DS', DIRECTORY_SEPARATOR);

define("ROOT", getcwd() . DS);

define("APPPATH", ROOT . 'application' . DS);

define("BASEPATH", ROOT . "framework" . DS);

define("STATICPATH", ROOT . "static" . DS);

// 运行框架文件
require(BASEPATH . 'core' . DS . 'Framework.php');
\Framework\core\Framework::run();
