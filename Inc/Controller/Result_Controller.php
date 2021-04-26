<?php

require_once(dirname(__FILE__) . '/../Model/Result.php');
require_once(dirname(__FILE__) . '/../Model/Candidate.php');
require_once(dirname(__FILE__) . '/../Controller/Event_Controller.php');
class Result_Controller
{
    private $result;
    private $candidate;
    private $event_controller;

    public function __construct()
    {
        $this->result = new Result;
        $this->candidate = new Candidate;
        $this->event_controller = new Event_Controller;
        // 
    }
    public function store($data, $event, $candidate)
    {
        $this->result->_save($data);
        $this->candidate->update_test_candidate_assignment($event, $candidate);
        $event_inf = $this->event_controller->get_event_by_id($event);
        $data[2] && $event_inf[5] == 'pretest' ? $this->candidate->insert_pending_final_test($candidate) : null;
    }

    public function get_results_list($event)
    {
        return $this->result->results_list($event);
    }

    public function get_event_result_stat($event)
    {
        return $this->result->result_sstat($event);
    }
}
