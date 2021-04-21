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
}
