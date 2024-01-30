<?php

require_once __DIR__ . "/../../../config/Database.php";

class User extends Database
{

    private $username;
    private $password;
    protected function getUsers()
    {
        try {
            $sql = "SELECT * FROM users";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }

    protected function addUser($data)
    {
        try {

            // Data object Destructuring
            $this->username = $data->username;
            $this->password = $data->password;

            $sql = "INSERT INTO users (username, password)
                    VALUES (?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->username, $this->password]);

            return "User added successfully!";
        } catch (PDOException $e) {
            return $e;
        }
    }
}
