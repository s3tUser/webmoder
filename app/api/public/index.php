<?php

require "../RequestController.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

try {
    if ($uri[1] !== 'user') {
        throw new LogicException('Path not allowed');
    }

    $controller = new RequestController($_SERVER["REQUEST_METHOD"], $uri[2]);
    $controller->processRequest();
} catch (\Exception $e) {
    header("HTTP/1.1 404 Not Found");
    exit($e->getMessage());
}
