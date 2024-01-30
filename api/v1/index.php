<?php
require_once "./controller/User.controller.php";
// Allow all origins
header("Access-Control-Allow-Origin: *");

// Allow specific headers and methods
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");


// I dunno why the headers above doesn't work like this function when doing POST request with Angular
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Handle preflight request
    handlePreflightRequest();
}
function handlePreflightRequest()
{
    // Set appropriate CORS headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    // Respond with a 200 OK status code
    http_response_code(200);
    exit(); // Terminate script execution
}


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
                $user->addUser($data);
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
