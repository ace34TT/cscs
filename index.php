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
require_once(dirname(__FILE__) . '/Inc/Controller/Result_Controller.php');
require_once(dirname(__FILE__) . '/Inc/Controller/Comment_Controller.php');
$inf_controller = new Personnal_information_Controller;
$admin_controller = new Admin_Controller;
$event_controller = new Event_Controller;
$candidate_controller = new Candidate_Controller;
$result_controller = new Result_Controller;
$comment_controller = new Commnet_controller;

// gestion des routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = "/cscs_v2.1/";
if ($route == $uri || '/' == $uri) {
    include('Pages/Frontend/index.php');
    return;
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
        header("Location: index.php");
        return;
    }
    // Admin
    if (isset($_GET['admin'])) {

        session_start();
        // Logged
        if (isset($_SESSION['admin'])) {

            //---------------------------------- 
            // if ($_GET['admin'] == 'login') {
            //     include('Pages/Backend/Admin/index.php');
            // }
            //------------Home
            // Overview (homepage)
            if ($_GET['admin'] == 'overview') {
                $curr_event = $event_controller->count_cuurr_event();
                include('Pages/Backend/Admin/overview.php');
                return;
            }
            // ------------Event
            // -----------------create event
            // Event form
            if ($_GET['admin'] == 'event_form') {
                include('Pages/Backend/Admin/event-form.php');
                return;
            }

            // Event upload
            if ($_GET['admin'] == 'event_upload') {
                $data[0] = $_POST['author'];
                $data[1] = $_POST['responsible'];
                $data[2] = $_POST['contact'];
                $data[3] = $_POST['name'];
                $data[4] = $_POST['event'];
                $data[5] = $_POST['method'];
                $data[6] = $_POST['province'];
                $data[7] = $_POST['place'];
                $data[8] = $_POST['date'];
                $data[9] = $_POST['schedule'];
                $data[10] = $_POST['description'];

                $event_controller->store($data);
                $checker = true;
                header("Location: index.php?admin=event_form");
                return;
            }
            // -----------------current event
            if ($_GET['admin'] == 'current_event') {
                $current_events = $event_controller->get_cuurr_event();
                include('Pages/Backend/Admin/current-event.php');
                return;
            }

            if ($_GET['admin'] == 'pretest_overview') {
                $event = $event_controller->get_event_by_id($_GET['event']);
                $assignet_curr_event = $candidate_controller->get_candidate_by_assigned_event($_GET['event']);
                // $pending_cnadidates = $candidate_controller->get_pretest_pending_candidate();
                include('Pages/Backend/Admin/pretest-overview.php');
                return;
            }

            if ($_GET['admin'] == 'pretest_form') {
                $comment = '';
                $candidate = $_GET['candidate'];
                $candidate = $candidate_controller->get_candidate_by_id($candidate);
                $event = $_GET['event'];

                include('Pages/Backend/Admin/pretest-form.php');
                return;
            }

            if ($_GET['admin'] == 'upload_pretest_result') {
                // insert into result
                // if commnet , insert 
                // update candidate state 
                $event = $_GET['event'];
                $candidate = $_GET['candidate'];
                $test_result =  $_POST['result'] == 'success' ? true : false;
                $result[0] = $event;
                $result[1] = $candidate;
                $result[2] = $test_result;

                $comment_value = $_POST['comment'];
                $comment[0] = $candidate;
                $comment[1] = $comment_value;
                $comment[2] =  $_SESSION['admin']['names'];

                // echo ($_SESSION['admin']['names']);
                //$result_controller->store($result, $event, $candidate);
                $comment != '' ? $comment_controller->store($comment) : null;
                // echo ($_GET['candidate'] . ' ' . $_GET['event'] . '<br>');
                // echo ($_POST['result'] . ' ' . $_POST['comment'] . ' ' . $_POST['post']);
                return;
                # code...
            }

            // -----------------organize test
            // show coming event list
            if ($_GET['admin'] == 'organize_test') {
                $coming_pretest = $event_controller->get_comming_pretests();
                $comping_final_test = $event_controller->get_coming_final_test();
                include('Pages/Backend/Admin/coming-event.php');
                return;
            }
            // candidate event assignment list
            if ($_GET['admin'] == 'pretest_assignement') {
                $event = $event_controller->get_event_by_id($_GET['event']);
                $assignet_curr_event = $candidate_controller->get_candidate_by_assigned_event($_GET['event']);
                $pending_cnadidates = $candidate_controller->get_pretest_pending_candidate();
                include('Pages/Backend/Admin/pretest-assignement.php');
                return;
            }
            // assigning candidate
            if ($_GET['admin'] == 'pretest_assignement_validation') {
                $ids = $_POST['selected_candidates'];
                $event = $_GET['event'];
                $candidate_controller->prestest_assignement($ids, $event);
                header("Location: index.php?admin=pretest_assignement&event=" . $_GET['event']);
                return;
            }
            // unasigning candidate
            if ($_GET['admin'] == 'unassign_pretest') {
                $candidate = $_GET['candidate'];
                $candidate_controller->unasign_candidate_from_prestest_event($candidate);
                header("Location: index.php?admin=pretest_assignement&event=" . $_GET['event']);
                return;
            }
            // notifying candidates
            if ($_GET['admin'] == 'notify_candidate') {
                $candidates = $_POST['unotified_candidates'];
                $candidate_controller->notify_candidate($candidates);
                header("Location: index.php?admin=pretest_assignement&event=" . $_GET['event']);
                return;
            }

            //--
            // candidate card
            if ($_GET['admin'] == 'candidate_card') {
                echo $_GET['candidate'];
                return;
            }
            header("Location: index.php?admin=overview");
        } else if ($_GET['admin'] == 'login') {
            include('Pages/Backend/Admin/index.php');
        } else if ($_GET['admin'] == 'access') {
            echo ('here');
            if (isset($_POST['email']) && isset($_POST['password'])) {
                if ($admin_controller->login($_POST['email'], $_POST['password']) == true) {
                    header("Location: index.php?admin=overview");
                } else {
                    include('Pages/Backend/Admin/index.php');
                }
            } else {
                include('Pages/Backend/Admin/index.php');
            }
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
