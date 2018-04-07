<?php
// php实现一致性hash分布
class FlexiHash
{
	// 服务器列表
	public $serverList = [];

	// 记录服务器列表是否已经排过序
	private $isSorted = false;

	// 实现一个Hash
	private function mHash($key)
	{
		$md5 = substr(md5($key), 0, 8);
		$seed = 31;
		$hash = 0;

		for ($i=0; $i < 8; $i++) { 
			$hash = $hash*$seed + ord($md5[$i]);
			$i++;
		}
		return $hash & 0x7FFFFFFF;
	}

	// 添加服务器到列表
	public function addServer($server)
	{
		$hash = $this->mHash($server);
		if(!isset($this->serverList[$hash])){
			$this->serverList[$hash] = $server;
		}

		$this->isSorted = false;
		return true;
	}

	// 移除一个服务器
	public function removeServer($server)
	{
		$hash = $this->mHash($server);
		if(isset($this->serverList[$hash])){
			unset($this->serverList[$hash]);
		}
		
		$this->isSorted = false;
		return true;
	}

	// 在当前服务器列表中找到合适的服务器存放数据
	public function lookup($key)
	{
		$hash = $this->mHash($key);
		if(!$this->isSorted){
			ksort($this->serverList, SORT_NUMERIC);
			$this->isSorted = true;
		}

		foreach ($this->serverList as $key => $value) {
			if($hash >= $key){
				return $value;
			}
		}
		return end($this->serverList);
	}
}

// 测试
$hash = new FlexiHash();
$hash->addServer('192.168.1.1');
$hash->addServer('192.168.1.3');
$hash->addServer('192.168.1.4');

$server = $hash->lookup('key22');
var_dump($server);
