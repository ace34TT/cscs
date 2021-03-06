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
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * FROM candidates WHERE email = ? AND passwords = ?');
            $req->execute(array($email, $password));
            $row = $this->fetch_resultSet($req);
            if ($row != null) {
                $_SESSION['candidate'] = $row;
                $this->pdo->commit();
                return true;
            } else {
                $this->pdo->commit();
                return false;
            }
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit();
        }
    }

    public function update_personnal_information($email)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE personnal_informations SET code_status = :status WHERE email = :email');
            $req->execute(array(
                'status' => 'used',
                'email' => $email
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit();
        }
    }

    public function insert_pending_pretest($email)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT id FROM candidates WHERE email = ?');
            $req->execute(array($email));
            $row = $this->fetch_resultSet($req);
            $req = $this->pdo->prepare('INSERT INTO pendings (candidate,test)  VALUES(:candidate,0)');
            $req->execute(array('candidate' => $row[0]['id']));
            $this->pdo->commit();
        } catch (\Throwable $th) {
            $this->pdo->rollback();
            die('Erreur : ' . $th->getMessage());
            exit();
        }
    }

    public function pretest_pending_candidate()
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->query('SELECT *
                                    FROM users
                                        INNER JOIN pendings ON users.users = pendings.candidate
                                    WHERE pendings.stat = false 
                                    AND pendings.test = 0');
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit();
        }
    }

    public function assign_pretest_candidate($candidate, $event)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('INSERT INTO test_candidate_assignment (events ,candidate)  VALUES(:events , :candidate)');
            $req->execute(array(
                'events' => $event,
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function update_stat_pending_pretest($candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE pendings SET stat = 1 WHERE candidate = :candidate AND test = 0');
            $req->execute(array(
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function active_candidate_by_event($event)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * , test_candidate_assignment.notified
                                        FROM users
                                            INNER JOIN test_candidate_assignment ON users.users = test_candidate_assignment.candidate
                                        WHERE test_candidate_assignment.stat = false AND events = ?');
            $req->execute(array($event));
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function unassign_candidate_pretest($candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('DELETE test_candidate_assignment FROM test_candidate_assignment
                                            INNER JOIN events
                                                ON events.id = test_candidate_assignment.events
                                        WHERE candidate = :candidate 
                                        AND events.events = \'pretest\'
            ');
            $req->execute(array(
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function reset_stat_from_pending_pretest($candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE pendings SET stat = 0 WHERE candidate = :candidate AND test = 0 ');
            $req->execute(array(
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function get_email($id_candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT email FROM users WHERE users =?');
            $req->execute(array($id_candidate));
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function update_notif_pretest_event($id_candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE test_candidate_assignment 
                                            INNER JOIN events 
                                            ON events.id = test_candidate_assignment.events 
                                        SET notified = true 
                                        WHERE candidate = :candidate
                                        AND events.events =\'pretest\' ');
            $req->execute(array(
                'candidate' => $id_candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function identified_by_id($id_candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * FROM users WHERE users =?');
            $req->execute(array($id_candidate));
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function update_test_candidate_assignment($event, $candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE test_candidate_assignment 
                                        SET stat = true 
                                        WHERE events = :events
                                        AND candidate = :candidate    
                                    ');
            $req->execute(array(
                'events' => $event,
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function insert_pending_final_test($candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('INSERT INTO pendings (candidate,test)  VALUES(:candidate,1)');
            $req->execute(array('candidate' => $candidate));
            $this->pdo->commit();
        } catch (\Throwable $th) {
            $this->pdo->rollback();
            exit;
        }
    }

    public function final_test_pending_candidate()
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->query('SELECT *
                                    FROM users
                                        INNER JOIN pendings ON users.users = pendings.candidate
                                    WHERE pendings.stat = false 
                                    AND pendings.test = 1');
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function update_stat_pending_final_test($candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE pendings SET stat = 1 WHERE candidate = :candidate AND test = 1');
            $req->execute(array(
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function assign_final_test_candidate($candidate, $event)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('INSERT INTO test_candidate_assignment (events ,candidate)  VALUES(:events , :candidate)');
            $req->execute(array(
                'events' => $event,
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
    public function unassign_candidate_final_test($candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('DELETE test_candidate_assignment FROM test_candidate_assignment
                                            INNER JOIN events
                                                ON events.id = test_candidate_assignment.events
                                        WHERE candidate = :candidate 
                                        AND events.events = \'final_test\'
            ');
            $req->execute(array(
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
    public function reset_stat_from_pending_final_test($candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE pendings SET stat = 0 WHERE candidate = :candidate AND test = 1');
            $req->execute(array(
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            echo 'here <br>';
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function update_notif_final_test_event($id_candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE test_candidate_assignment 
                                            INNER JOIN events 
                                            ON events.id = test_candidate_assignment.events 
                                        SET notified = true 
                                        WHERE candidate = :candidate
                                        AND events.events =\'final_test\' ');
            $req->execute(array(
                'candidate' => $id_candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function update_post($post, $candidate)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE personnal_informations INNER JOIN candidates ON personnal_informations.id = candidates.personnal_information SET post = :post WHERE candidates.id = :candidate');
            $req->execute(array(
                'post' => $post,
                'candidate' => $candidate
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            echo 'here <br>';
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
    public function declined_pretest_candidates()
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->query("SELECT results.id AS verdict , users.*
                                        FROM users
                                            INNER JOIN results ON users.users = results.candidate
                                            INNER JOIN events ON results.events = events.id
                                        WHERE events.events = 'pretest'
                                            AND results.result = 0
                                            AND results.stat = 0");
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
    public function declined_final_test_candidates()
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->query("SELECT results.id AS verdict , users.*
                                        FROM users
                                            INNER JOIN results ON users.users = results.candidate
                                            INNER JOIN events ON results.events = events.id
                                        WHERE events.events = 'final_test'
                                            AND results.result = 0
                                            AND results.stat = 0");
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function get_received_candidate()
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->query("SELECT *
                                        FROM users
                                            INNER JOIN results ON users.users = results.candidate
                                            INNER JOIN events ON results.events = events.id
                                        WHERE events.events = 'final_test'
                                            AND results.result = 1
                                            AND results.stat = 0");
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function count_candidate()
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->query("SELECT COUNT(*)
                                        FROM candidates ");
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit();
        }
    }

    public function count_received_candidate()
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->query("SELECT COUNT(*)
                                        FROM users
                                            INNER JOIN results ON users.users = results.candidate
                                            INNER JOIN events ON results.events = events.id
                                        WHERE events.events = 'final_test'
                                            AND results.result = 1
                                            AND results.stat = 0");
            $this->pdo->commit();
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
}
