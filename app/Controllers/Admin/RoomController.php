<?php

namespace App\Controllers\Admin;

use App\Models\Room;
use App\models\User;
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
        $users = (new User($this->getDB()))->getByUserId($_SESSION['user_id']);
        return $this->view('admin.room.create', compact('json', 'users'));
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

        if ($result) {
          if (!empty($_FILES['picture']['name'])) {
              $picture = $_FILES['picture']['name'];
              $picturePath = $_FILES['picture']['tmp_name'];
              $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
              $pictureName = pathinfo($picture, PATHINFO_FILENAME);
              $pictureName = time() . '_' . $pictureName . '.' . $pictureExtension;
              $pictureDestination = '../assets/pictures/rooms/' . $pictureName;
              $pictureExtensionAllowed = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
              $pictureSize = $_FILES['picture']['size'];
              if (in_array($pictureExtension, $pictureExtensionAllowed)) {
                  if ($pictureSize < 5000000) {
                      move_uploaded_file($picturePath, $pictureDestination);
                  } else {
                      echo "Votre fichier est trop volumineux";
                  }
              } else {
                  echo "Votre fichier n'est pas une image";
              }
          }
          return header('Location: /admin/game');
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

        if ($result) {
          if (!empty($_FILES['picture']['name'])) {
              $picture = $_FILES['picture']['name'];
              $picturePath = $_FILES['picture']['tmp_name'];
              $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
              $pictureName = pathinfo($picture, PATHINFO_FILENAME);
              $pictureName = time() . '_' . $pictureName . '.' . $pictureExtension;
              $pictureDestination = '../assets/pictures/rooms/' . $pictureName;
              $pictureExtensionAllowed = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
              $pictureSize = $_FILES['picture']['size'];
              if (in_array($pictureExtension, $pictureExtensionAllowed)) {
                  if ($pictureSize < 5000000) {
                      move_uploaded_file($picturePath, $pictureDestination);
                  } else {
                      echo "Votre fichier est trop volumineux";
                  }
              } else {
                  echo "Votre fichier n'est pas une image";
              }
          }
          if ($_POST['object_id'] == 0){
              $_POST['object_id'] = null;
          }
          return header('Location: /admin/game');
      }
  

    }
       
    

    public function destroy(int $id)
    {
        $this->isAdmin();

        $room = new Room($this->getDB());
        $result = $room->destroy($id);

        if ($result) {
            header('Location: /admin/game');
        }

    }

   

}