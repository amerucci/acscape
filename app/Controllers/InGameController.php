<?php 

namespace App\Controllers;

use App\models\room;
use App\models\furniture;

class InGameController extends Controller {

    public function index()
    {
        $room = new Room($this->getDB());
        $room = $room->allByScriptId(54);
        $furniture = new Furniture($this->getDB());
        $furniture = $furniture->allByRoomId(54);

        $data =  [
            'room' => $room,
            'furniture' => $furniture];
        $json = json_encode($data);

        return $this->view('ingame.index', compact('room', 'json'));
    }

    public function show()
    {
        return $this->view('ingame.show');
    }

}