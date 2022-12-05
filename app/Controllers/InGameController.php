<?php 

namespace App\Controllers;

class InGameController extends Controller {

    public function index()
    {
        return $this->view('ingame.index');
    }

    public function show()
    {
        return $this->view('ingame.show');
    }

}