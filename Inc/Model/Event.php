<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Event extends Connection
{
    private $table = 'events';
    private $fillable = array('author', 'responsible', 'contact', 'names', 'events', 'province', 'place', 'dates', 'schedule', 'descriptions');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
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
