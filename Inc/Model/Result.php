<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Result extends Connection
{

    private $table = 'results';

    private $fillable = array('event', 'candidate', 'result');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }
}
