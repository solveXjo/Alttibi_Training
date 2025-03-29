<?php
session_start();
require 'models/user.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User(require_once "Database.php");
    }



       
}
