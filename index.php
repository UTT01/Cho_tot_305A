<?php
session_start();
define('ROOT_PATH', __DIR__);
include_once 'MVC/bridge.php';
$myapp = new app();
?>