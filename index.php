<?php
require __DIR__ . "/controller/User.controller.php";


$user = new UserController();

header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: tru");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: *");


$userArr = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read the raw POST data
    $postData = file_get_contents("php://input");

    // Parse the JSON data
    $requestData = json_decode($postData, true);

    ["username" => $username, "password" => $password] = $requestData;

    echo $user->addUser($username, $password);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $users = $user->getUsers();

    if (!$users) {
        die();
    }

    foreach ($users as $user) {
        echo json_encode($user);
    }
}
