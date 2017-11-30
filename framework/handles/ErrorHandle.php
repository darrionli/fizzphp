<?php
namespace Framework\Handles;

use Framework\App;
use Framework\Handles\Handle;
use Framework\Exceptions\CoreHttpException;

class ErrorHandle implements Handle
{
	public function __construct(){

	}

	public function register(App $app)
	{
		set_error_handler([$this, 'errorHandler']);
		register_shutdown_function([$this, 'shutdown']);
	}

	/**
     * 错误捕获
     *
     * @param  int    $errorNumber  错误码
     * @param  int    $errorMessage 错误信息
     * @param  string $errorFile    错误文件
     * @param  string $errorLine    错误行
     * @param  string $errorContext 错误文本
     * @return mixed               　
     */
	public function errorHandler($errorNumber, $errorMessage, $errorFile, $errorLine, $errorContext)
	{
		$errorInfo = [
            'type'    => $errorNumber,
            'message' => $errorMessage,
            'file'    => $errorFile,
            'line'    => $errorLine,
            'context' => $errorContext,
        ];

        CoreHttpException::reponseErr($errorInfo);
	}

	// 脚本结束
	public function shutdown()
	{
		$error = error_get_last();
        if (empty($error)) {
            return;
        }
        $errorInfo = [
            'type'    => $error['type'],
            'message' => $error['message'],
            'file'    => $error['file'],
            'line'    => $error['line'],
        ];

        CoreHttpException::reponseErr($errorInfo);
	}
}
