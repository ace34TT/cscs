<?php
// lance les classes de PHPMailer

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);


// Enable display errors 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

ini_set("mail.log", "/tmp/mail.log");
ini_set("mail.add_x_header", TRUE);
error_reporting(E_ALL);

// path du dossier PHPMailer % fichier d'envoi du mail
require(dirname(__FILE__) . '/Inc/PHPMailer/src/Exception.php');
require(dirname(__FILE__) . '/Inc/PHPMailer/src/PHPMailer.php');
require(dirname(__FILE__) . '/Inc/PHPMailer/src/SMTP.php');

require_once(dirname(__FILE__) . '/Inc/Controller/Personnal_information_Controller.php');
$inf_controller = new Personnal_information_Controller;

function init_connection()
{
    try {
        $pdo = new PDO('mysql:host=81.19.215.12;dbname=cscsmada_v2;charset=utf8', 'cscsmada', '40%YTPIfyg@8c8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function fetch_resultSet($reponse)
{
    $i = 0;
    while ($donnees = $reponse->fetch()) {
        $data[$i] = $donnees;
        $i++;
    }
    if (isset($data)) {
        return $data;
    }
    return null;
}

function getEmail()
{
    try {
        $pdo = init_connection();
        $req = $pdo->query('SELECT id ,email , firstname , lastname , validation_code
                                    FROM personnal_informations 
                                    WHERE code_status = \'unused\'
                                    ORDER BY id DESC
                                    ');
        $rows = fetch_resultSet($req);
        return $rows;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

$emails = getEmail();

for ($i = 0; $i < 75; $i++) {
    $link = 'https://cscsmadagascar.mg/Pages/Backend/Candidate/validation.php?validation=' . $emails[$i]['validation_code'];
    $inf_controller->init_mail($emails[$i]['id'], $link, "hey");
}
