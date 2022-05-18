<?php
require "Controller/StudentsController.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);


$isikucod = null;
if (isset($uri[3])) {
    $isikucod = (int) $uri[3];
}

$request = $_SERVER["REQUEST_METHOD"];

$controller = new StudentsController($request, $isikucod);
$controller->requestProcessor();