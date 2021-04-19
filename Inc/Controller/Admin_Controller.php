<?php

require_once(dirname(__FILE__) . '/../Model/Admin.php');

class Admin_Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = new Admin;
    }

    public function login($email, $password)
    {
        if ($this->admin->login($email, sha1($password)) == true) {
            return true;
        }
        return false;
    }
}
