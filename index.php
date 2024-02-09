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





// switch ($_SERVER["REQUEST_METHOD"]) {

//     case "GET":
//         switch ($request[0]) {
//             case "user":
//                 echo json_encode($user->index());
//                 break;
//         }

//     case "POST":
//         $data = json_decode(file_get_contents("php://input"));

//     default:
//         http_response_code(404);
//         break;
// }
