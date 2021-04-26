<?php

require_once(dirname(__FILE__) . '/../Model/Event.php');

class Event_Controller
{
    private $event;

    public function __construct()
    {
        $this->event = new Event;
    }

    public function store($data)
    {
        $this->event->_save($data);
    }

    public function count_cuurr_event()
    {
        return $this->event->count_curr_event()[0]['count(*)'];
    }
    public function get_cuurr_event()
    {
        return $this->event->curr_event_lists();
    }

    public function get_coming_pretests()
    {
        return $this->event->coming_pretests();
    }

    public function get_coming_final_test()
    {
        return $this->event->comming_final_test();
    }

    public function get_event_by_id($id)
    {
        return $this->event->_id($id)[0];
    }
}
