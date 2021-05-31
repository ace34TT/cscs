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
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Create email headers
        $from = 'notification@cscsmadagascar.com';
        $headers .= 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $to = 'tafinasoa35@gmail.com';
        $subject = "Validation link";

        $message = '<html><body>';
        $message .= '<h1>Hi Jane!</h1>';
        $message .= '<p color:rgb(103, 104, 112); font-size:25px;">We have successfuly received your application </p>';
        $message .= '<p color:rgb(103, 104, 112); font-size:25px;">Here is your <a href="https://cscsmadagascar.mg/Pages/Backend/Candidate/validation.php?validation=bf4fd61f437d34dace97075b412f739d0f9c199f">validation link</a> </p>';
        $message .= '<p color:rgb(103, 104, 112); font-size:25px;">Hope we\'ll see you soon ! </p>';

        $message .= '</body></html>';

        mail($to, $subject, $message, $headers);

        // $from = "noticationf@cscsmadagascar.mg";
        // $to = $email;
        // $subject = "Validation link";
        // $message = "Hi , here is your validation link " . $link;
        // $headers = "De :" . $from;
        // mail($to, $subject, $message, $headers);
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
