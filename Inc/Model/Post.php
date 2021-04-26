<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Post extends Connection
{

    private $table = 'posts';

    private $fillable = array('name', 'category', 'quota');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }
}
