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
}
