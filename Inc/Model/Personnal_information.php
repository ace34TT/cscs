<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Personnal_information extends Connection
{
    private $table = 'personnal_informations';
    private $fillable = array('firstname', 'lastname', 'gender', 'date_of_birth', 'province', 'addresses', 'phone', 'email', 'post', 'resumes', 'validation_code');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function check_validation($code)
    {
        $req = $this->pdo->prepare('SELECT * FROM personnal_informations WHERE validation_code = ?');
        $req->execute(array($code));
        $row = $this->fetch_resultSet($req);
        if ($row != null) {
            return $row;
        } else {
            return false;
        }
    }
}
