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
require_once(dirname(__FILE__) . '/Inc/Controller/Post_Controller.php');
$inf_controller = new Personnal_information_Controller;
$admin_controller = new Admin_Controller;
$event_controller = new Event_Controller;
$candidate_controller = new Candidate_Controller;
$result_controller = new Result_Controller;
$comment_controller = new Commnet_controller;
$post_controller = new Post_Controller;



// gestion des routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = "/cscs_v2.1/";
if ($route == $uri || '/' == $uri) {
    $all_post = $post_controller->all();
    $events = $event_controller->count_events();
    $total = ($candidate_controller->total_candidate()['COUNT(*)']) + 1239;
    $received = ($candidate_controller->received_candidate()['COUNT(*)']) + 461;
    include('Pages/Frontend/index.php');
    return;
} else if ($route != $uri) {
    // Applying process
    if (isset($_GET['apply'])) {
        $data[0] = $_POST['firstname'];
        $data[1] = $_POST['lastname'];
        $data[2] = $_POST['gender'];
        $data[3] = $_POST['date_of_birth'];
        $data[4] = $_POST['height'];
        $data[5] = $_POST['weight'];
        $data[6] = $_POST['province'];
        $data[7] = $_POST['address'];
        $data[8] = $_POST['phone'];
        $data[9] = $_POST['email'];
        $data[10] = $_POST['post'];

        $inf_controller->store($data);

        header("Location: index.php");
        return;
    }
    //Validation candidate
    if (isset($_GET['validation'])) {
        $form[0] = $_POST['email'];
        $form[1] = sha1($_POST['password']);
        $form[2] = $_GET['personnal_information'];
        $resume = $_FILES['resume'];
        $candidate_controller->store($form, $resume);
        //header('Location: index.php');
        return;
        // header('Location: <ital>http:</ital><ital>//www.commentcamarche.net/forum/</ital>');  
    }
    // Admin
    if (isset($_GET['admin'])) {
        session_start();
        // Logged
        if (isset($_SESSION['admin'])) {

            if ($_GET['admin'] == 'logout') {
                session_destroy();
                header("Location: index.php?admin=login");
                return;
            }
            // -----------------------------------HOME-----------------------------------
            // Overview (homepage)
            if ($_GET['admin'] == 'overview') {
                $curr_event = $event_controller->count_cuurr_event();
                $total_candidates = $candidate_controller->total_candidate();
                $total_received = $candidate_controller->received_candidate();
                include('Pages/Backend/Admin/overview.php');
                return;
            }
            // -----------------------------------EVENT AND TEST-----------------------------------
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
                header("Location: index.php?admin=event_form&amp;checker");
                return;
            }
            // current event
            if ($_GET['admin'] == 'current_event') {
                $current_events = $event_controller->get_cuurr_event();
                include('Pages/Backend/Admin/current-event.php');
                return;
            }
            //  pretest overview
            if ($_GET['admin'] == 'pretest_overview') {
                $event = $event_controller->get_event_by_id($_GET['event']);
                $assignet_curr_event = $candidate_controller->get_candidate_by_assigned_event($_GET['event']);
                $result = $result_controller->get_results_list($_GET['event']);
                $success = $result_controller->get_event_result_success($_GET['event']);
                $fail = $result_controller->get_event_result_fail($_GET['event']);
                $total = $result_controller->count_candidate($_GET['event']);
                include('Pages/Backend/Admin/pretest-overview.php');
                return;
            }
            //  test form
            if ($_GET['admin'] == 'test_form') {
                $all_post = $post_controller->all();
                $comments = $comment_controller->get_canidate_comments($_GET['candidate']);
                $candidate = $_GET['candidate'];
                $candidate = $candidate_controller->get_candidate_by_id($candidate);
                $event = $_GET['event'];
                include('Pages/Backend/Admin/test-form.php');
                return;
            }
            //  upload result
            if ($_GET['admin'] == 'upload_result') {
                $event = $_GET['event'];
                $candidate = $_GET['candidate'];
                $note = $_POST['note'];
                $test_result =  $_POST['result'] == 'success' ? 1 : 0;
                $assigne_post = $_POST['post'];

                $result[0] = $event;
                $result[1] = $candidate;
                $result[2] = $note;
                $result[3] = $test_result;

                $comment_value = $_POST['comment'];
                $comment[0] = $candidate;
                $comment[1] = $comment_value;
                $comment[2] =  $_SESSION['admin']['names'];
                $comment[3] =  $event;

                // $result_controller->store($result, $event, $candidate, $assigne_post);
                !empty($comment_value) ? $comment_controller->store($comment) : null;
                // header("Location: index.php?admin=pretest_overview&event=" . $event);
                return;
            }

            // organize test
            // show coming event list
            if ($_GET['admin'] == 'organize_test') {
                $coming_pretest = $event_controller->get_coming_pretests();
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
            // notifying candidates pretest
            if ($_GET['admin'] == 'notify_candidate') {
                $candidates = $_POST['unotified_candidates'];
                $candidate_controller->notify_pretest_candidate($candidates);
                header("Location: index.php?admin=pretest_assignement&event=" . $_GET['event']);
                return;
            }
            // final test over view 
            if ($_GET['admin'] == 'final_test_overview') {
                $event = $event_controller->get_event_by_id($_GET['event']);
                $assignet_curr_event = $candidate_controller->get_candidate_by_assigned_event($_GET['event']);
                $result = $result_controller->get_results_list($_GET['event']);
                $success = $result_controller->get_event_result_success($_GET['event']);
                $fail = $result_controller->get_event_result_fail($_GET['event']);
                $total = $result_controller->count_candidate($_GET['event']);
                include('Pages/Backend/Admin/final-test-overview.php');
                return;
            }
            // final test assignement 
            if ($_GET['admin'] == 'final_test_assignment') {
                $event = $event_controller->get_event_by_id($_GET['event']);
                $assignet_curr_event = $candidate_controller->get_candidate_by_assigned_event($_GET['event']);
                $pending_cnadidates = $candidate_controller->get_final_test_pending_candidate();
                include('Pages/Backend/Admin/final-test-assignment.php');
                return;
            }
            //assign final_test event to a candidtes
            if ($_GET['admin'] == 'final_test_assignement_validation') {
                $ids = $_POST['selected_candidates'];
                $event = $_GET['event'];
                $candidate_controller->final_test_assignement($ids, $event);
                header("Location: index.php?admin=final_test_assignment&event=" . $_GET['event']);
                return;
            }
            // unassign final_test
            if ($_GET['admin'] == 'unassign_final_test') {
                $candidate = $_GET['candidate'];
                $candidate_controller->unasign_candidate_from_final_test_event($candidate);
                header("Location: index.php?admin=final_test_assignment&event=" . $_GET['event']);
                return;
            }
            // notifying candidate for final test
            if ($_GET['admin'] == 'notify_candidate_final_test') {
                $candidates = $_POST['unotified_candidates'];
                $candidate_controller->notify_final_test_candidate($candidates);
                header("Location: index.php?admin=final_test_assignment&event=" . $_GET['event']);
                return;
            }
            // candidate card
            if ($_GET['admin'] == 'candidate_card') {
                $comments = $comment_controller->get_canidate_comments($_GET['candidate']);
                $candidate = $_GET['candidate'];
                $candidate = $candidate_controller->get_candidate_by_id($candidate);
                include('Pages/Backend/Admin/candidate-card.php');
                return;
            }

            // all events ;
            if ($_GET['admin'] == 'all_events') {
                $events = $event_controller->get_all_events();
                include('Pages/Backend/Admin/all-event.php');
                return;
            }
            // -----------------------------------POST-----------------------------------
            if ($_GET['admin'] == 'post_form') {
                include('Pages/Backend/Admin/post-form.php');
                return;
            }
            if ($_GET['admin'] == 'post_upload') {
                $name = $_POST['name'];
                $category = $_POST['category'];
                $quota = $_POST['quota'];

                $data[0] = $name;
                $data[1] = $category;
                $data[2] = $quota;

                $post_controller->store($data);

                header("Location: index.php?admin=post_form&amp;checker");
                return;
            }
            if ($_GET['admin'] == 'manage_post') {
                $posts = $post_controller->all();
                include('Pages/Backend/Admin/post-managing.php');
                return;
            }

            if ($_GET['admin'] == 'delete_post') {
                $post_controller->delete($_GET['post']);
                header("Location: index.php?admin=manage_post");
                return;
            }


            // -----------------------------------CANDIDATE-----------------------------------
            if ($_GET['admin'] == 'pretest_candidate_overview') {
                $pretest_pending_candidates = $candidate_controller->get_pretest_pending_candidate();
                $declined_candidates = $candidate_controller->get_pretest_declined_candidates();
                include('Pages/Backend/Admin/pretest-candidate-overview.php');
                return;
            }

            if ($_GET['admin'] == 'insert_pretest') {
                $result_controller->update_result_stat($_GET['result']);
                $candidate_controller->insert_into_pretest_pending(($_GET['email']));
                header("Location: index.php?admin=pretest_candidate_overview");
                return;
            }

            if ($_GET['admin'] == 'final_test_candidate_overview') {
                $final_test_pending_candidates = $candidate_controller->get_final_test_pending_candidate();
                $declined_candidates = $candidate_controller->get_final_test_declined_candidates();
                $received_candidate = $candidate_controller->get_received_candidate();
                include('Pages/Backend/Admin/final-test-candidate-overview.php');
                return;
            }

            if ($_GET['admin'] == 'insert_final_test') {
                $result_controller->update_result_stat($_GET['result']);
                $candidate_controller->isnert_into_final_test_pending($_GET['candidate']);

                header("Location: index.php?admin=final_test_candidate_overview");
                return;
            }

            // -----------------------------------HOME-----------------------------------
            header("Location: index.php?admin=overview");
        } else if ($_GET['admin'] == 'login') {
            include('Pages/Backend/Admin/index.php');
            return;
        } else if ($_GET['admin'] == 'access') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                if ($admin_controller->login($_POST['email'], $_POST['password']) == true) {
                    header("Location: index.php?admin=overview");
                    return;
                } else {
                    $error = 'please , verify your login address';
                    include('Pages/Backend/Admin/index.php');
                    return;
                }
            } else {
                include('Pages/Backend/Admin/index.php');
                return;
            }
        }
    }
    // candidate
    if (isset($_GET['candidate'])) {
        if ($_GET['candidate'] == 'events') {
            $current_event = $event_controller->get_cuurr_event();
            $coming_events = $event_controller->get_coming_events_7_days();
            $last_events = $event_controller->get_last_7_days_events();
            include('Pages/Backend/Candidate/index.php');
            return;
        }
        if ($_GET['candidate'] == 'event_card') {
            $event = $event_controller->get_event_by_id($_GET['event']);
            $assignet_curr_event = $candidate_controller->get_candidate_by_assigned_event($_GET['event']);
            $result = $result_controller->get_results_list($_GET['event']);
            $success = $result_controller->get_event_result_success($_GET['event']);
            $fail = $result_controller->get_event_result_fail($_GET['event']);
            $total = $result_controller->count_candidate($_GET['event']);
            include('Pages/Backend/Candidate/event-card.php');
            return;
        }
    }
    //Candidate
    if (isset($_GET['candidate'])) {
        if ($_GET['candidate'] == 'login') {
            header("Location: index.php");
            return;
        }
    }
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
    return;
}
// echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
include('Pages/Frontend/index.php');
