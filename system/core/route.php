<?php
namespace system\core;
class route{
	protected $controller;
	protected $action;
	public function __construct(){
		if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI']){
			$uri_array = explode('/', $_SERVER['REQUEST_URI']);
			// $this->$controller = (isset($uri_array[1])&&$uri_array[1])?$uri_array[1]:'index';
			// $this->$action = (isset($uri_array[2])&&$uri_array[2])?$uri_array[2]:'index';
		}else{
			$this->$controller = 'index';
			$this->$action = 'index';
		}
	}
}
