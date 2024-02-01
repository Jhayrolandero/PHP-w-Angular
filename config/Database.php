<?php
class Database
{

    private $host = "sql6.freesqldatabase.com";
    private $user = "sql6681253";
    private $pass = "QCSiBBnunC";
    private $dbname = "sql6681253";

    protected function connect()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}
