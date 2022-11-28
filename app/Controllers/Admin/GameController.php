<?php 

namespace App\Controllers\Admin;

use App\Models\Objects;
use App\Models\Room;
use App\Models\Furniture;
use App\Controllers\Controller;

class GameController extends Controller {

        public function index()
        {
            $this->isAdmin();            
        //   $_SESSION['script_id'] = $script->id;
            $room = new Room( $this->getDB());
            $rooms = $room->allById($_SESSION['script_id']);
            $furniture = new Furniture( $this->getDB());
            $furnitures = $furniture->allById($_SESSION['script_id']);
            $object = new Objects( $this->getDB());
            $objects = $object->allById($_SESSION['script_id']);
            $this->view('admin.game.index', compact('rooms', 'furnitures', 'objects'));
        }


}