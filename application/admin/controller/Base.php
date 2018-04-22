<?php
/**	
* 后台控制器基类
**/
namespace app\admin\controller;

use app\common\lib\IAuth;
use think\Controller;

class Base extends Controller
{
	public function _initialize()
	{
		$is_login = IAuth::verifyLoginAuth();
		if(!$is_login){
		    $this->redirect('login/index');
		    exit();
        }
	}
}