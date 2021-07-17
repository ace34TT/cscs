<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require(dirname(__FILE__) . '/../PHPMailer/src/Exception.php');
require(dirname(__FILE__) . '/../PHPMailer/src/PHPMailer.php');
require(dirname(__FILE__) . '/../PHPMailer/src/SMTP.php');

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
        $this->send_mail($data[9], 'https://cscsmadagascar.mg/Pages/Backend/Candidate/validation.php?validation=' . $data[11], $data[0] . '  ' . $data[1]);
        $this->personnal_information->_save($data);
    }

    function sendmail($objet, $contenu, $destinataire)
    {
        // on crée une nouvelle instance de la classe
        $mail = new PHPMailer(true);
        // puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
        try {
            /* DONNEES SERVEUR */
            #####################
            $mail->setLanguage('fr', 'Inc/PHPMailer/language/');   // pour avoir les messages d'erreur en FR
            $mail->SMTPDebug = 0;            // en production (sinon "2")
            // $mail->SMTPDebug = 2;            // décommenter en mode débug
            $mail->isSMTP();                                                            // envoi avec le SMTP du serveur
            $mail->Host       = 'cscsmadagascar.mg';                            // serveur SMTP
            $mail->SMTPAuth   = true;                                            // le serveur SMTP nécessite une authentification ("false" sinon)
            $mail->Username   = 'notif@cscsmadagascar.mg';                   // login SMTP
            $mail->Password   = 'Qnh69t?8';                                                // Mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
            $mail->Port       = 587;                                                               // port TCP (ou 25, ou 465...)

            /* DONNEES DESTINATAIRES */
            ##########################
            $mail->setFrom('notif@cscsmadagascar.mg', 'No-Reply');  //adresse de l'expéditeur (pas d'accents)
            $mail->addAddress($destinataire, 'Clients de Mon_Domaine');        // Adresse du destinataire (le nom est facultatif)
            // $mail->addReplyTo('moi@mon_domaine.fr', 'son nom');     // réponse à un autre que l'expéditeur (le nom est facultatif)
            // $mail->addCC('cc@example.com');            // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
            // $mail->addBCC('bcc@example.com');          // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)

            /* PIECES JOINTES */
            ##########################
            // $mail->addAttachment('../dossier/fichier.zip');         // Pièces jointes en gardant le nom du fichier sur le serveur
            // $mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip');    // Ou : pièce jointe + nouveau nom

            /* CONTENU DE L'EMAIL*/
            ##########################
            $mail->isHTML(true);                                      // email au format HTML
            $mail->Subject = utf8_decode($objet);      // Objet du message (éviter les accents là, sauf si utf8_encode)
            $mail->Body    = $contenu;          // corps du message en HTML - Mettre des slashes si apostrophes
            $mail->AltBody = 'Contenu au format texte pour les clients e-mails qiui ne le supportent pas'; // ajout facultatif de texte sans balises HTML (format texte)

            $mail->send();
            echo 'Message envoyé.';
        }
        // si le try ne marche pas > exception ici
        catch (Exception $e) {
            echo "Le Message n'a pas été envoyé. Mailer Error: {$mail->ErrorInfo}"; // Affiche l'erreur concernée le cas échéant
        }
    } // fin de la fonction sendmail

    public function send_mail($email, $link, $name)
    {
        $from = 'notification@cscsmadagascar.com';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $to = $email;

        $subject = "Validation link";

        $message = '<html><body>';
        $message .= '<h1>Hi ' . $name . ' !</h1>';
        $message .= '<p color:rgb(103, 104, 112); font-size:25px;">We have successfuly received your application </p>';
        $message .= '<p color:rgb(103, 104, 112); font-size:25px;">Here is your <a href="' . $link . '">validation link</a> </p>';
        $message .= '<p color:rgb(103, 104, 112); font-size:25px;">Hope we\'ll see you soon ! </p>';

        $message .= '<br>';
        $message .= '<br>';

        $message .= '<p> ------------------ </p>';
        $message .= '<p> CSCS Madagascar </p>';
        $message .= '<p> notification@cscsmadagascar.mg </p>';
        $message .= '<p>  +261 34 03 902 97 </p>';
        $message .= '</body></html>';

        $message .= '</body></html>';

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
