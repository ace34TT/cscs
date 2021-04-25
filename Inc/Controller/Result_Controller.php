<?php

require_once(dirname(__FILE__) . '/../Model/Result.php');
require_once(dirname(__FILE__) . '/../Model/Candidate.php');

class Result_Controller
{
    private $result;
    private $candidate;

    public function __construct()
    {
        $this->result = new Result;
        $this->candidate = new Candidate;
    }
    public function store($data, $event, $candidate)
    {
        $this->result->_save($data);
        $this->candidate->update_test_candidate_assignment($event, $candidate);
    }
}
