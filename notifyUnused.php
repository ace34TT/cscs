<?php
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

testMail();

function testMail()
{
    $to = "tafinasoa35@gmail.com";
    $subject = "test";
    $message = "hello ";

    $headers = array(
        "From: notification@cscsmadagascar.mg",
        "Reply-To: tafinasoa35@gmail.com",
        "X-Mailer: PHP/" . PHP_VERSION
    );
    $headers = implode("\r\n", $headers);
    echo '<pre>', var_dump(mail($to, $subject, $message, $headers)), '</pre>';
}
