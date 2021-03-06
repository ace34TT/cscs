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
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * FROM comments WHERE candidate = ? ORDER BY created_date DESC');
            $req->execute(array($candidate));
            return $this->fetch_resultSet($req);
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
        return null;
    }
}
