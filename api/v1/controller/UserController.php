<?php


require_once __DIR__ . "/./Controller.php";
require_once __DIR__ . "/../model/User.model.php";

/**
 * 
 * User Controller Class
 * 
 * Used for communicating with user model
 */
class UserController extends Controller
{

    private $user;
    function __construct()
    {
        $this->user = new User;
    }

    public function index()
    {
        echo json_encode(parent::findAll($this->user->table, null));
    }

    public function store($data)
    {
        echo json_encode($data);
    }
}
