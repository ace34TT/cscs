<?php
// index.php
// On charge les modeles et les controleurs

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/Inc/Controller/Personnal_information_Controller.php');

$inf_controller = new Personnal_information_Controller;

// gestion des routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = "/cscs_v2.1/";


if ($route == $uri) {
    include('Pages/Frontend/index.php');
} else if ($route != $uri) {
    if (isset($_GET['apply'])) {
        $data[0] = $_POST['firstname'];
        $data[1] = $_POST['lastname'];
        $data[2] = $_POST['gender'];
        $data[3] = $_POST['date_of_birth'];
        $data[4] = $_POST['province'];
        $data[5] = $_POST['address'];
        $data[6] = $_POST['phone'];
        $data[7] = $_POST['email'];
        $data[8] = $_POST['post'];

        $inf_controller->store($data, $_FILES['resume']);

        //include('Pages/Frontend/index.php');
    }
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}
