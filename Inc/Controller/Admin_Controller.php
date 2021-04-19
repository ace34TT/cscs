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
        $this->admin->login($email, $password);
    }
}
