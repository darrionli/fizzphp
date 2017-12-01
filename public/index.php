
<?php
define('PUBLIC_PATH', __DIR__);

define('BASE_PATH', basename(PUBLIC_PATH));

define('VIEW_PATH', BASE_PATH . '/app/views/');

require BASE_PATH . '/vendor/autoload.php';

$app = require_once BASE_PATH . '/bootstrap/app.php';
