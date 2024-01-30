<?php

require_once __DIR__ . "/../model/User.model.php";

class UserController extends User
{
    public function getUsers()
    {
        echo json_encode(parent::getUsers());
    }

    public function addUser($data)
    {
        echo json_encode(parent::addUser($data));
    }
}
