<?php 

namespace App\Controllers;

use App\Models\Room;
use App\Models\Script;
use App\Models\Furniture;

class InGameController extends Controller {

    public function index($id)
    {
        if (!isset($_SESSION['scriptId'])) {
            session_destroy();
            require VIEWS . 'errors/404.php';
        }
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

        return $this->json('json.data', compact('data'));
       

    }

}