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
        $this-> view('ingame.index', compact('json'));        
    }

    public function show()
    {
        return $this->view('ingame.show');
    }

    public function jsonGame()
    {
        
        $room = new Room($this->getDB());
        $room = $room->allByScriptId($_SESSION['test']);
        $furniture = new Furniture($this->getDB());
        $furniture = $furniture->allByRoomId(54);

        $data =  [
            'room' => $room,
            'furniture' => $furniture];

        return $this->json('ingame.data', compact('data'));
       

    }

}