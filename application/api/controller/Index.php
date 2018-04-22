<?php
/**
 * Created by PhpStorm.
 * User: lidi0
 * Date: 2018/4/21
 * Time: 23:41
 */
namespace app\api\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $data['error'] = '123';
        return $data;
    }
}