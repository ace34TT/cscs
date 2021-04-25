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
        $req = $this->pdo->prepare('INSERT INTO pendings (candidate,test)  VALUES(:candidate,0)');
        $req->execute(array('candidate' => $row[0]['id']));
    }

    public function pretest_pending_candidate()
    {
        try {
            $req = $this->pdo->query('SELECT *
                                    FROM users
                                        INNER JOIN pendings ON users.users = pendings.candidate
                                    WHERE pendings.stat = false 
                                    AND pendings.test = 0');
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function assign_pretest_candidate($candidate, $event)
    {
        try {
            $req = $this->pdo->prepare('INSERT INTO test_candidate_assignment (events ,candidate)  VALUES(:events , :candidate)');
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
            $req = $this->pdo->prepare('UPDATE pendings SET stat = 1 WHERE candidate = :candidate');
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
            $req = $this->pdo->prepare('SELECT * , test_candidate_assignment.notified
                                        FROM users
                                            INNER JOIN test_candidate_assignment ON users.users = test_candidate_assignment.candidate
                                        WHERE test_candidate_assignment.stat = false AND events = ?');
            $req->execute(array($event));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function unassign_candidate_pretest($candidate)
    {
        try {
            $req = $this->pdo->prepare('DELETE test_candidate_assignment FROM test_candidate_assignment
                                            INNER JOIN events
                                                ON events.id = test_candidate_assignment.events
                                        WHERE candidate = :candidate 
                                        AND events.events = \'pretest\'
            ');
            $req->execute(array(
                'candidate' => $candidate
            ));
        } catch (Exception $e) {

            die('Erreur : ' . $e->getMessage());
        }
    }

    public function reset_stat_from_pending_pretest($candidate)
    {
        try {
            $req = $this->pdo->prepare('UPDATE pendings SET stat = 0 WHERE candidate = :candidate AND test = 0 ');
            $req->execute(array(
                'candidate' => $candidate
            ));
        } catch (Exception $e) {
            echo 'here <br>';
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function get_email_pretest_notifications($id_candidate)
    {
        try {
            $req = $this->pdo->prepare('SELECT email FROM users WHERE users =?');
            $req->execute(array($id_candidate));
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function update_notif_pretest_event($id_candidate)
    {
        try {
            $req = $this->pdo->prepare('UPDATE test_candidate_assignment 
                                            INNER JOIN events 
                                            ON events.id = test_candidate_assignment.events 
                                        SET notified = true 
                                        WHERE candidate = :candidate
                                        AND events.events =\'pretest\' ');
            $req->execute(array(
                'candidate' => $id_candidate
            ));
        } catch (Exception $e) {

            die('Erreur : ' . $e->getMessage());
        }
    }

    public function identified_by_id($id_candidate)
    {
        try {
            $req = $this->pdo->prepare('SELECT * FROM users WHERE users =?');
            $req->execute(array($id_candidate));
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function update_test_candidate_assignment($event, $candidate)
    {
        try {
            $req = $this->pdo->prepare('UPDATE test_candidate_assignment 
                                        SET stat = true 
                                        WHERE candidate = :candidate
                                        AND events = :events');
            $req->execute(array(
                'candidate' => $candidate,
                'event' => $event
            ));
        } catch (Exception $e) {

            die('Erreur : ' . $e->getMessage());
        }
    }
}
