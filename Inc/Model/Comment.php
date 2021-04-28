<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Comment extends Connection
{

    private $table = 'comments';

    private $fillable = array('candidate', 'content', 'author', 'events');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function candidate_comments($candidate)
    {
        try {
            $req = $this->pdo->prepare('SELECT * FROM comments WHERE candidate = ? ORDER BY created_date DESC');
            $req->execute(array($candidate));
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return null;
    }
}
