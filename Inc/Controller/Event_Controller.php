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
}
