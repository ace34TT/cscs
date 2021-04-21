<?php
// 127.0.0.1/cscs_v2.1/Pages/Backend/Candidate/validation.php?validation=657f215c06ebf0a5edd6bbb5bc38fe457ae3e693

require_once('../../../Inc/Controller/Personnal_information_Controller.php');

$inf_controller = new Personnal_information_Controller;

$info = $inf_controller->check_validation($_GET['validation'])

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>
</head>

<body>
    <?php
    if ($info != false) {
        echo $info[0]['id'];
    }
    ?>
</body>

</html>