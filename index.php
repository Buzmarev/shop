<?php

define('ROOT', dirname(__FILE__));

session_start();

include_once(ROOT. '/components/Autoload.php');

$router = new Router;
$router -> run();
