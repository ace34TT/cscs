<?php

require_once(dirname(__FILE__) . '/../Model/Candidate.php');

class Candidate_Controller
{
    private $candidate;

    public function __construct()
    {
        $this->candidate = new Candidate;
    }

    public function store($data, $file, $url)
    {
        if ($this->file_checker($file) == "file can be uploaded") {
            $this->store_file($file, $data[0]);
            $this->candidate->_save($data);
            $this->candidate->update_personnal_information($data[0]);
            $this->candidate->insert_pending_pretest($data[0]);
            return;
        } else {
            header('Location: ' . $url . '&error=' . $this->file_checker($file));
            return;
        }
    }

    public function file_checker($file)
    {
        $target_dir = "Assets/Resumes/";
        $target_file = $target_dir . basename($file["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $status = "file can be uploaded";

        // Check if file already exists
        if (file_exists($target_file)) {
            $status = "Sorry, file already exists.";
        }

        // Check file size
        if ($file["size"] > 1000000) {
            $status = "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if ($file_type != "pdf") {
            $status = "Sorry, only PDF files are allowed.";
        }

        return $status;
    }

    private function store_file($file, $name)
    {
        $target_dir = "Assets/Resumes/";
        $target_file = $target_dir . basename($file["name"]);
        // Check if $uploadOk is set to 0 by an error

        $target_file = $target_dir . $name . '.pdf';
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    public function login($email, $password)
    {
        if ($this->admin->login($email, sha1($password)) == true) {
            return true;
        }
        return false;
    }

    public function get_pretest_pending_candidate()
    {
        return $this->candidate->pretest_pending_candidate();
    }

    public function prestest_assignement($candidates, $event)
    {
        $candidates = str_replace(' ', '', $candidates);
        $candidates = explode(',', $candidates);
        unset($candidates[count($candidates) - 1]);
        foreach ($candidates as $candidate) {
            $this->candidate->assign_pretest_candidate($candidate, $event);
            $this->candidate->update_stat_pending_pretest($candidate);
        }
    }

    public function get_candidate_by_assigned_event($event)
    {
        return $this->candidate->active_candidate_by_event($event);
    }

    public function unasign_candidate_from_prestest_event($candidate)
    {
        $this->candidate->unassign_candidate_pretest($candidate);
        $this->candidate->reset_stat_from_pending_pretest($candidate);
    }

    public function notify_pretest_candidate($candidates, $event)
    {
        $candidates = str_replace(' ', '', $candidates);
        $candidates = explode(',', $candidates);
        unset($candidates[count($candidates) - 1]);

        foreach ($candidates as $id_candidate) {
            $email = $this->candidate->get_email($id_candidate)[0]['email'];
            $this->send_pretest_email($email, $event, $candidates);
            $this->candidate->update_notif_pretest_event($id_candidate);
        }
    }

    public function send_pretest_email($email, $event, $id)
    {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers 
        $from = 'notif@cscsmadagascar.mg';
        $headers .= 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $to = $email;
        $subject = "Pretest schedule";

        $message = '<html><body>';
        $message .= ' <p>Hello ,</p>';

        $message .= '<br>';
        $message .= '<br>';
        $message .= '<br>';

        $message .= '<p font-size:25px;">We inform you that you\'ll pass your preselection test soon .</p>';
        $message .= ' <p>Here are the informations of your schedule</p>';
        $message .= '<p> Event informations </p>';
        $message .= '<p> Date   : ' . $event['dates'] . ' </p>';
        $message .= '<p> Time   : ' . $event['schedule'] . ' </p>';
        $message .= '<p> Method : ' . $event['method'] . ' </p>';
        $message .= '<p> Place  : ' . $event['place'] . ' </p>';
        $message .= '<p> Respensible  : ' . $event['responsible'] . ' </p>';
        $message .= '<p> Contact  : ' . $event['contact'] . ' </p>';

        $message .= '<p> Your id is : ' . $id . ' </p>';

        $message .= '<p> Cordialy </p>';

        $message .= '<br>';
        $message .= '<br>';

        $message .= '<p> ------------------ </p>';
        $message .= '<p> CSCS Madagascar </p>';
        $message .= '<p> notification@cscsmadagascar.mg </p>';
        $message .= '<p>  +261 34 03 902 97 </p>';
        $message .= '</body></html>';

        echo '<pre>', var_dump(mail($to, $subject, $message, $headers)), '</pre>';
    }

    public function get_candidate_by_id($id_candidate)
    {
        return $this->candidate->identified_by_id($id_candidate)[0];
    }

    public function get_final_test_pending_candidate()
    {
        return $this->candidate->final_test_pending_candidate();
    }

    public function final_test_assignement($candidates, $event)
    {
        $candidates = str_replace(' ', '', $candidates);
        $candidates = explode(',', $candidates);
        unset($candidates[count($candidates) - 1]);
        foreach ($candidates as $candidate) {
            $this->candidate->assign_final_test_candidate($candidate, $event);
            $this->candidate->update_stat_pending_final_test($candidate);
        }
    }

    public function unasign_candidate_from_final_test_event($candidate)
    {
        $this->candidate->unassign_candidate_final_test($candidate);
        $this->candidate->reset_stat_from_pending_final_test($candidate);
    }

    public function notify_final_test_candidate($candidates)
    {
        $candidates = str_replace(' ', '', $candidates);
        $candidates = explode(',', $candidates);
        unset($candidates[count($candidates) - 1]);

        foreach ($candidates as $id_candidate) {
            $email = $this->candidate->get_email($id_candidate)[0]['email'];
            // $this->send_pretest_email($email);
            $this->candidate->update_notif_final_test_event($id_candidate);
        }
    }

    public function get_pretest_declined_candidates()
    {
        return $this->candidate->declined_pretest_candidates();
    }

    public function insert_into_pretest_pending($email)
    {
        $this->candidate->insert_pending_pretest($email);
    }

    public function get_final_test_declined_candidates()
    {
        return $this->candidate->declined_final_test_candidates();
    }

    public function isnert_into_final_test_pending($candidate)
    {
        $this->candidate->insert_pending_final_test($candidate);
    }

    public function get_received_candidate()
    {
        return $this->candidate->get_received_candidate();
    }

    public function total_candidate()
    {
        return $this->candidate->count_candidate()[0];
    }

    public function received_candidate()
    {
        return $this->candidate->count_received_candidate()[0];
    }
}
