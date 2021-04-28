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
    public function store($data, $event, $candidate, $post)
    {
        $this->result->_save($data);
        $this->candidate->update_post($post, $candidate);
        $this->candidate->update_test_candidate_assignment($event, $candidate);
        $event_inf = $this->event_controller->get_event_by_id($event);
        $data[2] && $event_inf[5] == 'pretest' ? $this->candidate->insert_pending_final_test($candidate) : null;
    }

    public function get_results_list($event)
    {
        return $this->result->results_list($event);
    }

    public function get_event_result_success($event)
    {
        return $this->result->result_success($event)[0];
    }

    public function get_event_result_fail($event)
    {
        return $this->result->result_fail($event)[0];
    }

    public function count_candidate($event)
    {
        return $this->result->total_candidate_per_event($event)[0];
    }

    public function update_result_stat($result)
    {
        $this->result ->update_stat($result);
    }
}
