<?php
// index.php
// On charge les modeles et les controleurs

$from = "notif@cscsmadagascar.mg";
$to = "tafinasoa35@gmail.com";
$subject = "Validation link";
$message = '<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
    <style>
        /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
        /*All the styling goes here*/
        
        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%;
        }
        
        body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        
        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%;
        }
        
        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top;
        }
        /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */
        
        .body {
            background-color: #f6f6f6;
            width: 100%;
        }
        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        
        .container {
            display: block;
            margin: 0 auto !important;
            /* makes it centered */
            max-width: 580px;
            padding: 10px;
            width: 580px;
        }
        /* This should also be a block element, so that it will fill 100% of the .container */
        
        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px;
        }
        /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
        
        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%;
        }
        
        .wrapper {
            box-sizing: border-box;
            padding: 20px;
        }
        
        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }
        
        .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }
        
        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #999999;
            font-size: 12px;
            text-align: center;
        }
        /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
        
        h1,
        h2,
        h3,
        h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px;
        }
        
        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize;
        }
        
        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
        }
        
        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px;
        }
        
        a {
            color: #3498db;
            text-decoration: underline;
        }
        /* -------------------------------------
          BUTTONS
      ------------------------------------- */
        
        .btn {
            box-sizing: border-box;
            width: 100%;
        }
        
        .btn>tbody>tr>td {
            padding-bottom: 15px;
        }
        
        .btn table {
            width: auto;
        }
        
        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
        }
        
        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 5px;
            box-sizing: border-box;
            color: #3498db;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize;
        }
        
        .btn-primary table td {
            background-color: #3498db;
        }
        
        .btn-primary a {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff;
        }
        /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
        
        .last {
            margin-bottom: 0;
        }
        
        .first {
            margin-top: 0;
        }
        
        .align-center {
            text-align: center;
        }
        
        .align-right {
            text-align: right;
        }
        
        .align-left {
            text-align: left;
        }
        
        .clear {
            clear: both;
        }
        
        .mt0 {
            margin-top: 0;
        }
        
        .mb0 {
            margin-bottom: 0;
        }
        
        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }
        
        .powered-by a {
            text-decoration: none;
        }
        
        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            margin: 20px 0;
        }
        /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
        
        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }
            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }
            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }
            table[class=body] .content {
                padding: 0 !important;
            }
            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }
            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }
            table[class=body] .btn table {
                width: 100% !important;
            }
            table[class=body] .btn a {
                width: 100% !important;
            }
            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }
        /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
        
        @media all {
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }
            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }
            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }
            .btn-primary table td:hover {
                background-color: #34495e !important;
            }
            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }
    </style>
</head>

<body class="">
    <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <p>Hi there,</p>
                                            <p>Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                                <tbody>
                                                    <tr>
                                                        <td align="left">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td> <a href="http://htmlemail.io" target="_blank">Call To Action</a> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p>This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>
                                            <p>Good luck! Hope it works.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->

                    <!-- START FOOTER -->
                    <div class="footer">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-block">
                                    <span class="apple-link">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                                    <br> Don\'t like these emails? <a href="http://i.imgur.com/CScmqnj.gif">Unsubscribe</a>.
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block powered-by">
                                    Powered by <a href="http://htmlemail.io">HTMLemail</a>.
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- END FOOTER -->

                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>';
$headers = "De :" . $from;
mail($to, $subject, $message, $headers);

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

$all_post = $post_controller->all();
$events = $event_controller->count_events();
$total = ($candidate_controller->total_candidate()['COUNT(*)']) + 1239;
$received = ($candidate_controller->received_candidate()['COUNT(*)']) + 461;

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
                $comment_value = str_replace("'", "\'", $comment_value);
                $comment[0] = $candidate;
                $comment[1] = $comment_value;
                $comment[2] =  $_SESSION['admin']['names'];
                $comment[3] =  $event;

                $result_controller->store($result, $event, $candidate, $assigne_post);
                !empty($comment_value) ? $comment_controller->store($comment) : null;
                header("Location: index.php?admin=pretest_overview&event=" . $event);
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
