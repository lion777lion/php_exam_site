<?php
require "Controller/StudentsController.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


//получаем урл по которому к нам обратились
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

//проверяем есть ли в юрл исикукод для запросов
$isikucod = null;
if (isset($uri[3])) {
    $isikucod = (int) $uri[3];
}
//получаем метод запроса
$request = $_SERVER["REQUEST_METHOD"];

//создаем наш контроллер которому передаем метод запроса и код
$controller = new StudentsController($request, $isikucod);
$controller->requestProcessor();