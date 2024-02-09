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

    public function index()
    {
        $user = new User();
        echo json_encode(parent::findAll($user->table, null));
    }

    public function store() {
        
    }
}
