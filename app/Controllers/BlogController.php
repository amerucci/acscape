<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Script;


class BlogController extends Controller {

    public function welcome()
    {
        $script = new Script($this->getDB());
        $script = $script->all();
        return $this->view('home.welcome' , compact('script'));
    }

    public function index()
    {
        $script = new Script($this->getDB());
        $script = $script->all();
        return $this->view('home.index', compact('script'));
    }

    public function show(int $id)
    {
        $script = new Script($this->getDB());
        $script = $script->findById($id);
        $scriptAll = $script->all();
        return $this->view('home.show', compact('script', 'scriptAll'));
    }

}