<?php
require '../../system/db/mysql.class.php';
$sql = "select * from wp_users";
$query = DB_mysql::result_array($sql);
echo '<pre>';
print_r($query);
