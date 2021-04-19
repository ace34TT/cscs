<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Personnal_information extends Connection
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
        $email_ = $email;
        $password_ = sha1($password);
        $sql = "SELECT * FROM admin WHERE _mail = '%s' AND _password = '%s' ";
        $sql = sprintf($sql, $email_, $password_);
        $result = mysqli_query($this->db, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row != null) {
                $_SESSION["user"] = $row;
                return true;
            }
            return false;
        }
    }
}
