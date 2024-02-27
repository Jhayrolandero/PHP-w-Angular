<?php

require "./router/Router.php";

$router = new Router();

if (isset($_REQUEST["request"])) {
    $request = explode('/', $_REQUEST["request"]);
} else {
    http_response_code(404);
}

// ("path", "callback")
$router->get("user", "UserController@index");


$router->run($_SERVER["REQUEST_METHOD"], $request[0]);
