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
        $req = $this->pdo->query("SELECT count(*) FROM `events` WHERE dates = CURDATE() AND stat = false");
        return $this->fetch_resultSet($req);
    }

    public function curr_event_lists()
    {
        $req = $this->pdo->query("SELECT * FROM `events` WHERE dates =  CURDATE() AND stat = false");
        return $this->fetch_resultSet($req);
    }

    public function coming_pretests()
    {
        $req = $this->pdo->query('  SELECT id , names ,dates , schedule ,province  ,responsible 
                                        FROM events 
                                    WHERE dates >= CURDATE() 
                                    AND events = \'pretest\' ');
        $rows = $this->fetch_resultSet($req);
        return $rows;
    }

    public function comming_final_test()
    {
        $req = $this->pdo->query('SELECT id , names, dates , schedule , province ,responsible FROM events WHERE dates >= CURDATE() AND events = \'final_test\' ');
        $rows = $this->fetch_resultSet($req);
        return $rows;
    }

    public function all_events()
    {
        try {
            $req = $this->pdo->query("SELECT * FROM `events` ORDER BY dates DESC");
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return null;
    }

    public function coming_events_7_days()
    {
        $req = $this->pdo->query('SELECT * FROM events WHERE dates BETWEEN CURRENT_DATE() AND DATE_ADD(CURRENT_DATE, INTERVAL 7  DAY)');
        $rows = $this->fetch_resultSet($req);
        return $rows;
    }

    public function last_7_days()
    {
        $req = $this->pdo->query('SELECT * FROM events WHERE dates BETWEEN  NOW() - INTERVAL 7 day AND CURDATE()');
        $rows = $this->fetch_resultSet($req);
        return $rows;
    }

    public function count_events()
    {
        $req = $this->pdo->query('SELECT COUNT(*) FROM events');
        $rows = $this->fetch_resultSet($req);
        return $rows;
    }
}
