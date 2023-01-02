<?php

namespace App\Controllers\Admin;

use App\Models\Room;
use App\Models\Furniture;
use App\Controllers\Controller;

class RoomController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $rooms = (new Room($this->getDB()))->all();
        return $this->view('admin.room.index', compact('rooms'));
    }

    public function show(int $id)
    {
        $this->isAdmin();

        $room = (new Room($this->getDB()))->findById($id);
        return $this->view('admin.room.show', compact('room'));
    }
    public function create()
    {
        $this->isAdmin();
        $rooms = (new Room($this->getDB()))->countByRoomScriptID($_SESSION['script_id']);
        $json = json_encode($rooms);
        return $this->view('admin.room.create', compact('json'));
    }

    public function createRoom()
    {
        $this->isAdmin();

        $room = new Room($this->getDB());
        $result = $room->create([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'picture' => time().'_'.$_FILES['picture']['name'],
            'padlock' => $_POST['padlock'],
            'n_room' => $_POST['n_room'],
            'unlock_word' => $_POST['unlock_word'],
            'clue' => (isset($_POST['clue'])) ? $_POST['clue'] : null,
            'clue2' => (isset($_POST['clue2'])) ? $_POST['clue2'] : null,
            'clue3' => (isset($_POST['clue3'])) ? $_POST['clue3'] : null,
            'reward' => (isset($_POST['reward'])) ? $_POST['reward'] : null,
            'user_id' => $_POST['user_id'],
            'script_id' => $_POST['script_id'],

        ]);

        if (is_uploaded_file($_FILES['picture']['tmp_name']) && $result) {
            $picture = $_FILES['picture']['name'];
            $picturePath = $_FILES['picture']['tmp_name'];
            $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
            $pictureName = time() . '_' . pathinfo($picture, PATHINFO_FILENAME) . '.' . $pictureExtension;
            $pictureDestination = '../assets/pictures/rooms/' . $pictureName;
            $pictureExtensionAllowed = ['jpg', 'jpeg', 'png', 'gif'];
            $pictureSize = $_FILES['picture']['size'];
            $isAllowedExtension = in_array($pictureExtension, $pictureExtensionAllowed) ? true : false;
            $isAllowedSize = $pictureSize < 1000000 ? true : false;
          
            if ($isAllowedExtension && $isAllowedSize) {
              move_uploaded_file($picturePath, $pictureDestination);
              header('Location: /acscape/admin/game');
            } else {
              if (!$isAllowedExtension) {
                echo "Votre fichier n'est pas une image";
              } elseif (!$isAllowedSize) {
                echo "Votre fichier est trop volumineux";
              }
            }
            header('Location: /acscape/admin/game');
        }


    }
       
        

    public function edit(int $id)
    {
        $this->isAdmin();

        $room = (new Room($this->getDB()))->findById($id);
        $furnitures = (new Furniture($this->getDB()))->all();

        return $this->view('admin.room.edit', compact('room', 'furnitures'));
      
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $room = new Room($this->getDB());
        $result = $room->update($id, [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'picture' => isset($_FILES['picture']['name']) ? time().'_'.$_FILES['picture']['name'] : $_POST['picture'],
            'padlock' => $_POST['padlock'],
            'n_room' => $_POST['n_room'],
            'unlock_word' => $_POST['unlock_word'],
            'clue' => (isset($_POST['clue'])) ? $_POST['clue'] : null,
            'clue2' => (isset($_POST['clue2'])) ? $_POST['clue2'] : null,
            'clue3' => (isset($_POST['clue3'])) ? $_POST['clue3'] : null,
            'reward' => (isset($_POST['reward'])) ? $_POST['reward'] : null,
            'user_id' => $_POST['user_id'],
            'script_id' => $_POST['script_id'],
        ]);

        if (is_uploaded_file($_FILES['picture']['tmp_name']) && $result) {
            $picture = $_FILES['picture']['name'];
            $picturePath = $_FILES['picture']['tmp_name'];
            $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
            $pictureName = time() . '_' . pathinfo($picture, PATHINFO_FILENAME) . '.' . $pictureExtension;
            $pictureDestination = '../assets/pictures/rooms/' . $pictureName;
            $pictureExtensionAllowed = ['jpg', 'jpeg', 'png', 'gif'];
            $pictureSize = $_FILES['picture']['size'];
            $isAllowedExtension = in_array($pictureExtension, $pictureExtensionAllowed) ? true : false;
            $isAllowedSize = $pictureSize < 1000000 ? true : false;
          
            if ($isAllowedExtension && $isAllowedSize) {
              move_uploaded_file($picturePath, $pictureDestination);
              header('Location: /acscape/admin/game');
            } else {
              if (!$isAllowedExtension) {
                echo "Votre fichier n'est pas une image";
              } elseif (!$isAllowedSize) {
                echo "Votre fichier est trop volumineux";
              }
            }
          }
       
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $room = new Room($this->getDB());
        $result = $room->destroy($id);

        if ($result) {
            header('Location: /acscape/admin/game');
        }

    }

   

}