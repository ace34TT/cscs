<?php

require_once(dirname(__FILE__) . '/../Model/Result.php');

class Result_Controller
{
    private $result;

    public function __construct()
    {
        $this->result = new Result;
    }
    public function store($data)
    {
        $this->comment->_save($data);
    }
}
