<?php
namespace Framework\core;

class Controller
{
	protected $loader;

	public function __construct()
	{
		$this->loader = new Loader();
	}

	public function redirect($url, $message, $wait=0)
	{
		if($wait == 0){
			header("Location:$url");
		} else {

		}
		exit();
	}
}
