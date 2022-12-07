<?php 

namespace App\Controllers;

use App\models\room;

class InGameController extends Controller {

    public function index()
    {
        $room = new Room($this->getDB());
        $room = $room->all();

        return $this->view('ingame.index', compact('room'));
    }

    public function show()
    {
        return $this->view('ingame.show');
    }

}