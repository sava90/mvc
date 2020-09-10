<?php
ini_set('display_errors', 0);
error_reporting(0);
require '../vendor/autoload.php';
require '../app/routing.php';
require '../app/Router.php';
$router = new Router($routing);
$router->handleRequest();