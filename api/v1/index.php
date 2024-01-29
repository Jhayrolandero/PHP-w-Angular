<?php
require_once "./controller/User.controller.php";

$user = new UserController();
if (isset($_REQUEST["request"])) {
    $request = explode('/', $_REQUEST["request"]);
} else {
    http_response_code(404);
}

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        switch ($request[0]) {
            case "users":
                http_response_code(200);
                $user->getUsers();
                break;
            default:
                http_response_code(403);
                break;
        }
        break;
    case "POST":
        $data = json_decode(file_get_contents("php://input"));
        switch ($request[0]) {
            case "users":
                http_response_code(200);
                break;
            default:
                http_response_code(403);
                break;
        }
        break;
    default:
        http_response_code(403);
        break;
}
