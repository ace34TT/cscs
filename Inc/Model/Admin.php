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
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT id , names ,email FROM admins WHERE email = ? AND passwords = ?');
            $req->execute(array($email, $password));
            $row = $this->fetch_resultSet($req);
            if ($row != null) {
                $_SESSION['admin'] = $row[0];
                $this->pdo->commit();
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
            $this->pdo->rollback();
            exit();
        }
    }
}
