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
            if (isset($_SESSION['script_id'])) {
                $room = new Room( $this->getDB());
                $rooms = $room->allByScriptId($_SESSION['script_id']);
                $furniture = new Furniture( $this->getDB());
                $furnitures = $furniture->allByScriptId($_SESSION['script_id']);
                $object = new Objects( $this->getDB());
                $objects = $object->allByScriptId($_SESSION['script_id']);
                $this->view('admin.game.index', compact('rooms', 'furnitures', 'objects'));            
            } else {
                return header('Location: /acscape');
            }        

        }
            







}