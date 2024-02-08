<?php

require_once __DIR__ . "/Model.php";

class User
{
    public $table = "users";

    public $columns = ["username", "password"];
}
