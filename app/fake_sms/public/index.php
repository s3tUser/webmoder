<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

try {
    if ($_SERVER["REQUEST_METHOD"] !== 'GET' || $uri[1] !== 'codes') {
        throw new LogicException('Path not allowed');
    }

    if (!file_exists('../codes.log')) {
        exit();
    }

    echo file_get_contents('../codes.log');
} catch (\Exception $e) {
    header("HTTP/1.1 404 Not Found");
    exit($e->getMessage());
}