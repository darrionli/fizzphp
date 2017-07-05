<?php
require '../../system/db/mysql.class.php';
$sql = "select * from wp_users";
$query = DB_mysql::row_array($sql);
echo '<pre>';
print_r($query);
