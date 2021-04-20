<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Event extends Connection
{
    private $table = 'events';
    private $fillable = array('author', 'responsable', 'contact', 'names', 'events', 'province', 'place', 'date', 'schedule', 'descriptions');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }
}
