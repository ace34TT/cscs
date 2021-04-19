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
        session_start();
        $req = $this->pdo->prepare('SELECT * FROM admins WHERE email = ? AND passwords = ?');
        $req->execute(array($_GET['possesseur']));
        if ($req) {
            $row = $this->fetch_resultSet($req);
            var_dump($row);
            // if ($row != null) {
            //     $_SESSION["user"] = $row;
            //     return true;
            // }
            // return false;
        }
    }
}
