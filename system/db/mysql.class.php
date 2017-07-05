<?php
class DB_mysql
{
	private static $link = null; //数据库连接
	private function __construct(){}
	private function __clone(){}
	/**
	 * 连接数据库
	 * @return obj mysql资源对象
	 */
	private static function conn(){
		if(self::$link === null){
			require '../../config/database.php';
			self::$link = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database'], $config['port']);
			if(!self::$link){
				die('the database connect failed!');
			}
			// 设置字符集
			self::query("set names ".$config['charset']);
		}
		return self::$link;
	}

	/**
	 * 执行一条sql语句
	 * @return 结果对象
	 */
	public static function query($sql){
		return self::conn()->query($sql);
	}

	/**
	 * [result_array 获取多行数据]
	 * @return [array]
	 */
	public static function result_array($sql){
		$data = array();
		$query = self::query($sql);
		while (($row = $query->fetch_assoc()) != FALSE)
        {
            $data[] = $row;
        }
        return $data;
	}

	/**
	 * [row_array 从结果集中抓取一行并以枚举数组的形式返回它]
	 * @return [type]      [description]
	 */
	public static function row_array($sql){
		$query = self::query($sql);
		$data = $query->fetch_assoc();
		return $data;
	}

	/**
	 * [insert 插入]
	 * @return [type]      [description]
	 */
	public static function insert($sql){
		$query = self::query($sql);
		$result = $query->insert_id();
		return $query;
	}

	/**
	 * [update 更新]
	 * @return [type]      [description]
	 */
	public static function update($sql){
		$query = self::query($sql);
		$result = $query->affected_rows();
		return $result;
	}

	// 关闭数据库链接
	public static function close(){
		return self::conn()->close();
	}
}
