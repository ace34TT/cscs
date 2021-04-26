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
}
