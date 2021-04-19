<?php

require_once(dirname(__FILE__) . '/../Model/Personnal_information.php');

class Personnal_information_Controller
{
    private $personnal_information;

    public function __construct()
    {
        $this->personnal_information = new Personnal_information;
    }
}
