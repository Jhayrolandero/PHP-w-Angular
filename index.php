<?php

require "./router/Router.php";


if (isset($_REQUEST["request"])) {
    $request = explode('/', $_REQUEST["request"]);
} else {
    http_response_code(404);
}
$router = new Router($_SERVER["REQUEST_METHOD"], $request[0]);

// ("path", "callback")
$router->get("user", "UserController@index");
$router->get("user/{id}/order/{id}", "UserController@index");
$router->post("user", "UserController@store");

$router->run();



//     case "POST":
//         $data = json_decode(file_get_contents("php://input"));
