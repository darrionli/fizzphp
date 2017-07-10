<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
header("content-type:text/html;charset=utf-8");
// require '../../system/db/mysql.class.php';
require '../../system/lib/page.class.php';
$cpage = isset($_GET['page'])?(int)$_GET['page']:1;
$page = new Page(30, $cpage, 2, 8, '/application/rbac/index.php?page={page}');
echo $page->showPage(1);
