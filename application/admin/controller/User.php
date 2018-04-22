<?php
namespace app\admin\controller;
use app\common\lib\IAuth;

class User extends Base
{
	public function index()
	{
		return $this->fetch('index');
	}

    /**
     * 添加用户
     * @return mixed
     */
	public function add()
    {
        return $this->fetch('add');
    }

    /**
     * 处理添加用户
     */
    public function doadd()
    {
        if(request()->isPost()){
            $res = input('post.');
            $validate = validate('AdminUser');
            if(!$validate->check($res)){
                $this->error($validate->getError());
            }
            if($res['password'] != $res['password2']){
                $this->error('两次密码输入不一致');
            }

            $data = [];
            $data['username'] = $res['username'];
            $data['password'] = IAuth::setPass($res['password']);
            $data['create_time'] = time();
            $ret = model('AdminUser')->add($data);
            if($ret){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }

        }else{

        }
    }
}