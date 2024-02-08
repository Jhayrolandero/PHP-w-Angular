<?php

// Set default Timezone
date_default_timezone_set("Asia/Manila");

// Set timelimit on request
set_time_limit(120);
class Database
{

    private $host = "mysql-penacony.alwaysdata.net";
    private $user = "penacony_guest";
    private $pass = "honkaistarrail";
    private $dbname = "penacony_db";

    protected function connect()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . "; charset=utf8mb4";
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}
