<?php

require_once __DIR__ . "/../model/User.model.php";

class UserController extends User
{
    public function getUsers()
    {
        echo $this->users();
    }
}
