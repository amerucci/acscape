<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller {

    public function welcome()
    {
        return $this->view('blog.welcome');
    }
    public function welcome2()
    {
        return $this->view('blog.welcomeresponsive');
    }

    public function index()
    {
        // $post = new Post($this->getDB());
        // $posts = $post->all();
        // return $this->view('blog.index', compact('posts'));
        return $this->view('blog.index');
    }

    // public function show(int $id)
    public function show()
    {
        // $post = new Post($this->getDB());
        // $post = $post->findById($id);
        // return $this->view('blog.show', compact('post'));
        return $this->view('blog.show');
    }

    public function tag(int $id)
    {
        $tag = (new Tag($this->getDB()))->findById($id);

        return $this->view('blog.tag', compact('tag'));
    }
}