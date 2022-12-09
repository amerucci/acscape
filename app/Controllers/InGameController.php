<?php 

namespace App\Controllers;

use App\models\room;
use App\models\furniture;

class InGameController extends Controller {

    public function index()
    {
        $room = new Room($this->getDB());
        $room = $room->allByScriptIdByNroom(54);
        $furniture = new Furniture($this->getDB());
        $furniture = $furniture->allByFurnitureId(54);

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
        $room = $room->allByScriptIdByNroom(54);
        $furniture = new Furniture($this->getDB());
        $furniture = $furniture->allByFurnitureId(54);

        $data =  [
            'room' => $room,
            'furniture' => $furniture];

        return $this->json('ingame.data', compact('data'));
       

    }

}