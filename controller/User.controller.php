<?php

include __DIR__ . "/../model/User.model.php";

class UserController
{

    private $model;
    function __construct()
    {
        $this->model = new User();
    }


    function addUser($username, $password)
    {
        try {
            $res = $this->model->addUser($username, $password);

            if ($res) {
                echo "Added User!";
            } else {
                echo "Something went wrong";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    function getUsers()
    {
        try {
            $res = $this->model->getUsers();

            if ($res) {
                return $res;
            } else {
                echo "No users";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}
