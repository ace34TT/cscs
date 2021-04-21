<?php

require_once(dirname(__FILE__) . '/../Model/Personnal_information.php');

class Personnal_information_Controller
{
    private $personnal_information;

    public function __construct()
    {
        $this->personnal_information = new Personnal_information;
    }
    public function store($data)
    {
        $data[9] = $data[7] . 'pdf';
        $data[10] = sha1($this->generate_validation_code());
        $data[11] = 'unused';
        $this->send_mail();
        $this->personnal_information->_save($data);
        //$this->store_file($file, $data[7]);
    }

    public function send_mail()
    {
        mail(
            "tafinasoa@gmail.com",
            "Thank you for registering!",
            "Hello Homer, thank you for registering!",
            "From: ian@example.com"
        );
    }

    private function generate_validation_code()
    {
        $permitted_chars = '0123456789';
        return substr(str_shuffle($permitted_chars), 0, 6);
    }



    public function check_validation($code)
    {
        $info = $this->personnal_information->check_validation($code);
        return $info;
    }
}
