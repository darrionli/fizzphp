<?php
namespace app\admin\controller;

class Role extends Base
{
	public function index()
	{
		return $this->fetch('index');
	}
}