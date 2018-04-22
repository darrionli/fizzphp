<?php
namespace app\admin\controller;

use app\common\lib\IAuth;
use think\Controller;
use think\Cookie;
use think\Session;

class Login extends Controller
{
    /**
     * 登录页面
     * @return mixed
     */
	public function index()
	{
	    $is_login = IAuth::verifyLoginAuth();
	    if($is_login){
	        $this->redirect('index/index');
	        exit();
        }
		return $this->fetch('index');
	}

    /**
     * 登录
     */
	public function auth()
    {
        if(request()->isPost()){
            $ret = input('post.');
            if(!captcha_check($ret['code'])){
                $this->error('验证码输入失败');
            }

            try{
                $response = model('AdminUser')->get(['username'=>$ret['username']]);
                if(!$response){
                    $this->error('该用户不存在');
                }

                if($response['password'] != IAuth::setPass($ret['password'])){
                    $this->error('密码输入有误');
                }

                // 免密登录
                if(isset($ret['online']) && $ret['online'] == 1){
                    $identify = IAuth::setLoginIdentify($ret['username']);
                    if($identify){
                        $token = md5(uniqid(rand(), TRUE));
                        $timeout = time() + 60 * 60 * 24 * 7;
                        $data['identify'] = $identify;
                        $data['token'] = $token;
                        $data['timeout'] = $timeout;
                        Cookie::set('authFlag', $identify . ':' . $token, $timeout);
                    }
                }
                $data['last_login_time'] = time();
                $data['last_login_ip'] = request()->ip();
                model('AdminUser')->save($data, ['id'=>$response['id']]);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            Session::set('id',$response['id']);
            Session::set('username', $response['username']);
            $this->success('登录成功','admin/index/index');
        }else{
            $this->error('请求不合法');
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Cookie::set('authFlag', '', -1);
        Session::clear();
        $this->redirect('login/index');
    }
}