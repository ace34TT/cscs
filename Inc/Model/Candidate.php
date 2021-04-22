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
        var_dump($row);
        $req = $this->pdo->prepare('INSERT INTO pending_pretests (candidate)  VALUES(:candidate)');
        $req->execute(array('candidate' => $row[0]['id']));
    }
}
