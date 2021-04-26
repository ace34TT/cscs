<?php

require_once(dirname(__FILE__) . '/../Model/Post.php');

class Post_Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new Post;
    }

    public function store($data)
    {
        $this->post->_save($data);
    }

    public function all()
    {
        return $this->post->_all();
    }
}
