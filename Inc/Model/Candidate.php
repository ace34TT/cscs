<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Candidate extends Connection
{
    private $table = 'candidates';
    private $fillable = array('email', 'passwords', 'personnal_information');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function login($email, $password)
    {
        $req = $this->pdo->prepare('SELECT * FROM candidates WHERE email = ? AND passwords = ?');
        $req->execute(array($email, $password));
        $row = $this->fetch_resultSet($req);
        if ($row != null) {
            $_SESSION['candidate'] = $row;
            return true;
        } else {
            return false;
        }
    }

    public function update_personnal_information($email)
    {
        $req = $this->pdo->prepare('UPDATE personnal_informations SET code_status = :status WHERE email = :email');
        $req->execute(array(
            'status' => 'used',
            'email' => $email
        ));
    }

    public function insert_pending_pretest($email)
    {
        $req = $this->pdo->prepare('SELECT id FROM candidates WHERE email = ?');
        $req->execute(array($email));
        $row = $this->fetch_resultSet($req);
        $req = $this->pdo->prepare('INSERT INTO pending_pretests (candidate)  VALUES(:candidate)');
        $req->execute(array('candidate' => $row[0]['id']));
    }

    public function pretest_pending_candidate()
    {
        try {
            $req = $this->pdo->query('SELECT *
                                    FROM users
                                        INNER JOIN pending_pretests ON users.users = pending_pretests.candidate
                                    WHERE pending_pretests.stat = false');
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function assign_pretest_candidate($candidate, $event)
    {
        try {
            $req = $this->pdo->prepare('INSERT INTO pretest_candidate_assignment (events ,candidate)  VALUES(:events , :candidate)');
            $req->execute(array(
                'events' => $event,
                'candidate' => $candidate
            ));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function update_stat_pending_pretest($candidate)
    {
        try {
            $req = $this->pdo->prepare('UPDATE pending_pretests SET stat = 1 WHERE candidate = :candidate');
            $req->execute(array(
                'candidate' => $candidate
            ));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function active_candidate_by_event($event)
    {
        try {
            $req = $this->pdo->prepare('SELECT * , pretest_candidate_assignment.notified
                                    FROM users
                                        INNER JOIN pretest_candidate_assignment ON users.users = pretest_candidate_assignment.candidate
                                    WHERE pretest_candidate_assignment.stat = false AND events = ?');
            $req->execute(array($event));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
