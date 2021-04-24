<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Event extends Connection
{
    private $table = 'events';
    private $fillable = array('author', 'responsible', 'contact', 'names', 'events', 'method', 'province', 'place', 'dates', 'schedule', 'descriptions');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function count_curr_event()
    {
        $req = $this->pdo->query("SELECT count(*) FROM `events` WHERE dates =  CURDATE() AND stat = false");
        return $this->fetch_resultSet($req);
    }

    public function curr_event_lists()
    {
        $req = $this->pdo->query("SELECT * FROM `events` WHERE dates =  CURDATE() AND stat = false");
        return $this->fetch_resultSet($req);
    }

    public function comming_pretests()
    {
        $req = $this->pdo->query('SELECT id , names ,dates , schedule ,province  ,responsible FROM events WHERE dates > CURDATE() AND events = \'pretest\' ');
        $rows = $this->fetch_resultSet($req);
        return $rows;
    }

    public function comming_final_test()
    {
        $req = $this->pdo->query('SELECT id , names, dates , schedule , province ,responsible FROM events WHERE dates > CURDATE() AND events = \'final_test\' ');
        $rows = $this->fetch_resultSet($req);
        return $rows;
    }
}
