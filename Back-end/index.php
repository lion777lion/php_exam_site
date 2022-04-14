<?php
require "Kernel/Kernel.php";
require "Controller/StudentsController.php";

$connection = (new Kernel())->init();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[3] !== 'student') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$isikucod = null;
if (isset($uri[2])) {
    $isikucod = (int) $uri[2];
}

$request = $_SERVER["REQUEST_METHOD"];

$controller = new StudentsController($connection, $request, $isikucod);
$controller->requestProcessor();