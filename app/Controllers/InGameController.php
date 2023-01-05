<?php 

namespace App\Controllers;

use App\models\room;
use App\Models\Script;
use App\models\furniture;

class InGameController extends Controller {

    public function index()
    {
        $room = new Room($this->getDB());
        $room = $room->allByScriptIdByNroom($_SESSION['scriptId']);
        $furniture = new Furniture($this->getDB());
        $furniture = $furniture->allByFurnitureId($_SESSION['scriptId']);
        $script = new Script($this->getDB());
        $script = $script->allByScriptId($_SESSION['scriptId']);

        $this-> view('ingame.index', compact('room', 'furniture', 'script'));        
    }

    public function show()
    {
        return $this->view('ingame.show');
    }

    public function jsonGame()
    {
        
        $room = new Room($this->getDB());
        $room = $room->allByScriptIdByNroom($_SESSION['scriptId']);
        $furniture = new Furniture($this->getDB());
        $furniture = $furniture->allByFurnitureId($_SESSION['scriptId']);
        $script = new Script($this->getDB());
        $script = $script->allByScriptId($_SESSION['scriptId']);

        $data =  [
            'room' => $room,
            'furniture' => $furniture,
            'script' => $script];

        return $this->json('ingame.data', compact('data'));
       

    }

}