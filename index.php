<?php
require_once "./src/router/router.php";

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$uri = Router::clean_uri($uri);
$receivedData = file_get_contents("php://input");
$body_fields = json_decode($receivedData)??(object)[];
$get_fields = (object)$_GET;
$header_fields = (object)getallheaders();
$response = Router::redirect($uri, $method, $body_fields, $get_fields, $header_fields);
http_response_code($response->http_response_code);
echo json_encode($response->http_response);