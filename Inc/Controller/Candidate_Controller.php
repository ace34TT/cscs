<?php

require_once(dirname(__FILE__) . '/../Model/Candidate.php');

class Candidate_Controller
{
    private $candidate;

    public function __construct()
    {
        $this->candidate = new Candidate;
    }

    public function store($data, $file)
    {
        $this->candidate->_save($data);
        $this->candidate->update_personnal_information($data[0]);
        $this->candidate->insert_pending_pretest($data[0]);
        $this->store_file($file, $data[0]);
    }

    private function store_file($file, $name)
    {
        $target_dir = "Assets/Resumes/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($file["size"] > 1000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($file_type != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $target_file = $target_dir . $name . '.pdf';
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
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

    public function notify_pretest_candidate($candidates)
    {
        $candidates = str_replace(' ', '', $candidates);
        $candidates = explode(',', $candidates);
        unset($candidates[count($candidates) - 1]);

        foreach ($candidates as $id_candidate) {
            $email = $this->candidate->get_email($id_candidate)[0]['email'];
            // $this->send_pretest_email($email);
            $this->candidate->update_notif_pretest_event($id_candidate);
        }
    }

    public function send_pretest_email($email)
    {
        $to_email = $email;
        $subject = 'Testing PHP Mail';
        $message = 'This mail is sent using the PHP mail function';
        $headers = 'From: notification@cscsmadagascar.mg';
        mail($to_email, $subject, $message, $headers);
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
