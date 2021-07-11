<?php
// lance les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);


// Enable display errors 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

ini_set("mail.log", "/tmp/mail.log");
ini_set("mail.add_x_header", TRUE);
error_reporting(E_ALL);

// path du dossier PHPMailer % fichier d'envoi du mail
require '/Inc/PHPMailer/src/Exception.php';
require '/Inc/PHPMailer/src/PHPMailer.php';
require '/Inc/PHPMailer/src/SMTP.php';

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
        $req = $pdo->query('SELECT email , firstname , lastname , validation_code
                                    FROM personnal_informations 
                                    WHERE code_status = \'unused\' 
                                    ');
        $rows = fetch_resultSet($req);
        return $rows;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

$emails = getEmail();

foreach ($emails as $email) {
    echo ($email[0] . ' ' . $email[1] . '<br>');
    $link = 'https://cscsmadagascar.mg/Pages/Backend/Candidate/validation.php?validation=' . $email[3];
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Create email headers
    $from = 'notification@cscsmadagascar.com';
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $to = $email[0];
    $subject = "Validation link";

    $message = '<html><body>';
    $message .= '<h1>Hi ' . $email[1] . ' ' . $email[2] . '  !</h1>';
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

    echo '<pre>', var_dump(mail($to, $subject, $message, $headers)), '</pre>';
}

$dest = "tafinasoa35@gmail.com";
$objet = "[Association] Nouveau message de moi ";
$contenu = "<br />'hello world'";
$contenu .= "<br /><br />Date du message : " . date("d/m/Y");

sendmail($objet, $contenu, $dest);

function sendmail($objet, $contenu, $destinataire)
{
    // on crée une nouvelle instance de la classe
    $mail = new PHPMailer(true);
    // puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
    try {
        /* DONNEES SERVEUR */
        #####################
        $mail->setLanguage('fr', '../PHPMailer/language/');   // pour avoir les messages d'erreur en FR
        $mail->SMTPDebug = 0;            // en production (sinon "2")
        // $mail->SMTPDebug = 2;            // décommenter en mode débug
        $mail->isSMTP();                                                            // envoi avec le SMTP du serveur
        $mail->Host       = 'smtp du serveur';                            // serveur SMTP
        $mail->SMTPAuth   = true;                                            // le serveur SMTP nécessite une authentification ("false" sinon)
        $mail->Username   = 'ne-pas-repondre@mon_domaine.fr';     // login SMTP
        $mail->Password   = '**********';                                                // Mot de passe SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
        $mail->Port       = 587;                                                               // port TCP (ou 25, ou 465...)

        /* DONNEES DESTINATAIRES */
        ##########################
        $mail->setFrom('ne-pas-repondre@mon_domaine.fr', 'No-Reply');  //adresse de l'expéditeur (pas d'accents)
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
