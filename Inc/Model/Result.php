<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Result extends Connection
{

    private $table = 'results';

    private $fillable = array('events', 'candidate', 'note', 'result');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function results_list($event)
    {
        try {
            $req = $this->pdo->prepare('SELECT * FROM results_view WHERE events = ? AND stat = 0');
            $req->execute(array($event));
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function result_success($event)
    {
        try {
            $req = $this->pdo->prepare('SELECT result , COUNT(*) FROM results_view WHERE events = ? AND result = 1');
            $req->execute(array($event));
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
    public function result_fail($event)
    {
        try {
            $req = $this->pdo->prepare('SELECT result , COUNT(*) FROM results_view WHERE events = ? AND result = 0');
            $req->execute(array($event));
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }


    public function total_candidate_per_event($event)
    {
        try {
            $req = $this->pdo->prepare('SELECT COUNT(*) FROM test_candidate_assignment WHERE events = ?');
            $req->execute(array($event));
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function update_stat($id)
    {
        try {
            $req = $this->pdo->prepare('UPDATE results  SET stat = 1 WHERE id = :id');
            $req->execute(array(
                'id' => $id
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
}
