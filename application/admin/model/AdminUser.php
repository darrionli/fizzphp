<?php
/**
 * Created by PhpStorm.
 * User: lidi0
 * Date: 2018/4/21
 * Time: 15:37
 */
namespace app\admin\model;
use think\Model;
class AdminUser extends Model
{
    public function add($data)
    {
        if(!is_array($data)){
            exception("数据不合法");
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }
}