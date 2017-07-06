<?php
// require '../../system/db/mysql.class.php';
require '../../system/lib/page.class.php';
$page = new Page(30, 1, 2, '/service/set');
echo $page->showPage();

// $sql = "select * from wp_users";
// $query = DB_mysql::row_array($sql);
// echo '<pre>';
// print_r($query);
