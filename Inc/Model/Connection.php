<?php

class Connection
{
    public $pdo;
    private $table;
    private $fillable;

    public function init_connection($table, $fillable)
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=cscs_v2;charset=utf8', 'root', 'root');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->table = $table;
            $this->fillable = $fillable;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function _save($data)
    {
        $fillable_query = '';
        $data_query = '';

        for ($i = 0; $i < count($this->fillable); $i++) {
            if ($i < count($this->fillable) - 1) {
                $fillable_query .= $this->fillable[$i] . ',';
                $data_query .= "'" . $data[$i] . "',";
            } else {
                $fillable_query .= $this->fillable[$i];
                $data_query .= "'" . $data[$i] . "'";
            }
        }

        $query = 'INSERT INTO ' . $this->table . '(' . $fillable_query . ') VALUES (' . $data_query . ')';
        try {
            $this->pdo->exec($query);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function _all()
    {
        try {
            $query = 'SELECT * FROM ' . $this->table;
            $resultSet = $this->pdo->query($query);
            $data = $this->fetch_resultSet($resultSet);
            $resultSet->closeCursor();
            return $data;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return null;
    }

    public function fetch_resultSet($reponse)
    {
        $i = 0;
        while ($donnees = $reponse->fetch()) {
            $data[$i] = $donnees;
            $i++;
        }
        if (isset($data)) {
            return $data;
        }
        return null;
    }
}
