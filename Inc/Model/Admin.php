<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Admin extends Connection
{
    private $table = 'admins';
    private $fillable = array('passwords');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    function login($email, $password)
    {
        $req = $this->pdo->prepare('SELECT id , names ,email FROM admins WHERE email = ? AND passwords = ?');
        $req->execute(array($email, $password));
        $row = $this->fetch_resultSet($req);
        if ($row != null) {
            $_SESSION['admin'] = $row;
            return true;
        } else {
            return false;
        }
    }
}
