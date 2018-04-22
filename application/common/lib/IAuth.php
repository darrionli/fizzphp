<?php
/**
 * Created by PhpStorm.
 * User: lidi0
 * Date: 2018/4/21
 * Time: 17:01
 */
namespace app\common\lib;

use think\Cookie;
use think\Db;
use think\Session;

class IAuth
{
    /**
     * @param $data返回一个登录密码
     */
    public static function setPass($data)
    {
        return md5($data . config('admin.pass_salt'));
    }

    /**
     * 检查是否登录
     */
    public static function verifyLoginAuth()
    {
        $sign = Cookie::get('authFlag');
        if(!$sign){
            if(Session::get('id') && Session::get('username')){
                return true;
            }
            return false;
        }
        $clean = [];
        list($identify, $token) = explode(':', $sign);
        if(ctype_alnum($identify) && ctype_alnum($token)){
            $clean['identify'] = $identify;
            $clean['token'] = $token;
        }else{
            return false;
        }

        $result = Db::table('admin_user')->where('identify', $clean['identify'])->find();
        if(!$result){
            return false;
        }
        if($result['token'] != $clean['token']){
            return false;
        }
        if(time() > $result['timeout']){
            return false;
        }
        if($clean['identify'] != self::setLoginIdentify($result['username'])){
            return false;
        }
        return true;
    }

    /**
     * 根据用户名获取一个cookie标识
     */
    public static function setLoginIdentify($username)
    {
        $identify = '';
        if(empty($username)){
            return $identify;
        }
        $salt = Config('admin.login_sign');
        $identify = md5($salt . md5($username . $salt));
        return $identify;
    }

}