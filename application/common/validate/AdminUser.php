<?php
/**
 * Created by PhpStorm.
 * User: lidi0
 * Date: 2018/4/21
 * Time: 15:16
 */
namespace app\common\validate;

use think\Validate;
class AdminUser extends Validate
{
    protected $rule = [
        'username'=>'require|max:20',
        'password'=>'require|max:20',
        'email'=>'email'
    ];
}