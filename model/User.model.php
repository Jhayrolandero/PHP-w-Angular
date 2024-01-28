<?php
include __DIR__ . "/../Database.php";

class User extends Database
{
    public function addUser($username, $password)
    {
        try {
            $sql = "INSERT INTO users (username, password)
                    VALUES (?, ?)";

            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([$username, $password]);
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getUsers()
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
}
