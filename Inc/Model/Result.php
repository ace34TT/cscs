<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Result extends Connection
{

    private $table = 'results';

    private $fillable = array('events', 'candidate', 'result');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function results_list($event)
    {
        try {
            $req = $this->pdo->prepare('SELECT * FROM results_view WHERE events = ?');
            $req->execute(array($event));
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function result_sstat($event)
    {
        try {
            $req = $this->pdo->prepare('SELECT result , COUNT(*) FROM results_view WHERE events = ?  GROUP BY result ');
            $req->execute(array($event));
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
