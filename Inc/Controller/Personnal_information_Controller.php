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
        $data[11] = sha1($this->generate_validation_code());
        $data[12] = 'unused';
        $this->send_mail($data[9], 'https://cscsmadagascar.mg/Pages/Backend/Candidate/validation.php?validation=' . $data[11]);
        $this->personnal_information->_save($data);
    }

    public function send_mail($email, $link)
    {

        $from = "notif@cscsmadagascar.mg";
        $to = $email;
        $subject = "Essai de PHP Mail";
        $message = "Hi , here is your validation link " . $link;
        $headers = "De :" . $from;
        mail($to, $subject, $message, $headers);
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
