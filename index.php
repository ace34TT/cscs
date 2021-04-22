<?php
// index.php
// On charge les modeles et les controleurs

//Avoid document expired
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);


// Enable display errors 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Required files 
require_once(dirname(__FILE__) . '/Inc/Controller/Personnal_information_Controller.php');
require_once(dirname(__FILE__) . '/Inc/Controller/Candidate_Controller.php');
require_once(dirname(__FILE__) . '/Inc/Controller/Admin_Controller.php');
require_once(dirname(__FILE__) . '/Inc/Controller/Event_Controller.php');


$inf_controller = new Personnal_information_Controller;
$admin_controller = new Admin_Controller;
$event_controller = new Event_Controller;
$candidate_controller = new Candidate_Controller;


// gestion des routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = "/cscs_v2.1/";
if ($route == $uri || '/' == $uri) {
    include('Pages/Frontend/index.php');
} else if ($route != $uri) {
    // Applying process
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

        $inf_controller->store($data);

        include('Pages/Frontend/index.php');
    }
    // Admin
    if (isset($_GET['admin'])) {
        session_start();
        // Login process
        if ($_GET['admin'] == 'access') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                if ($admin_controller->login($_POST['email'], $_POST['password']) == true) {
                    include('Pages/Backend/Admin/overview.php');
                } else {
                    include('Pages/Backend/Admin/index.php');
                }
            } else {
                include('Pages/Backend/Admin/index.php');
            }
        }
        // Logged
        else if (isset($_SESSION['admin'])) {
            if ($_GET['admin'] == 'login') {
                include('Pages/Backend/Admin/index.php');
            }
            // Overview (homepage)
            else if ($_GET['admin'] == 'overview') {
                include('Pages/Backend/Admin/overview.php');
            }
            // Event form
            else if ($_GET['admin'] == 'event_form') {
                include('Pages/Backend/Admin/event-form.php');
            }
            // Event upload
            elseif ($_GET['admin'] == 'event_upload') {
                $data[0] = $_POST['author'];
                $data[1] = $_POST['responsible'];
                $data[2] = $_POST['contact'];
                $data[3] = $_POST['name'];
                $data[4] = $_POST['event'];
                $data[5] = $_POST['province'];
                $data[6] = $_POST['place'];
                $data[7] = $_POST['date'];
                $data[8] = $_POST['schedule'];
                $data[9] = $_POST['description'];

                $event_controller->store($data);
                $checker = true;
                include('Pages/Backend/Admin/event-form.php');
            } elseif ($_GET['admin'] == 'organize_test') {
                $coming_pretest = $event_controller->get_comming_pretests();
                $comping_final_test = $event_controller->get_coming_final_test();
                include('Pages/Backend/Admin/coming-event.php');
            }
        } else if ($_GET['admin'] == 'login') {
            include('Pages/Backend/Admin/index.php');
        }
    }
    //Validation candidate
    if (isset($_GET['validation'])) {
        $form[0] = $_POST['email'];
        $form[1] = sha1($_POST['password']);
        $form[2] = $_GET['personnal_information'];
        $resume = $_FILES['resume'];
        $candidate_controller->store($form, $resume);
        header('Location: index.php?candidate=login');
        // header('Location: <ital>http:</ital><ital>//www.commentcamarche.net/forum/</ital>');  
    }
    //Candidate
    if (isset($_GET['candidate'])) {
        if ($_GET['candidate'] == 'login') {
            include('Pages/Backend/Candidate/index.php');
        }
    }
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}
