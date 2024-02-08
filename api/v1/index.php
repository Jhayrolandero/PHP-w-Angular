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
        echo json_encode($user->index());
        break;

    case "POST":
        $data = json_decode(file_get_contents("php://input"));

    default:
        http_response_code(404);
        break;
}
