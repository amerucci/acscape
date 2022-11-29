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
        $rooms = (new Room($this->getDB()))->all();    
        return $this->view('admin.room.create', compact('rooms'));
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
            'start' => $_POST['start'],
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
                $pictureExtensionAllowed = ['jpg', 'jpeg', 'png', 'gif'];
                $pictureSize = $_FILES['picture']['size'];
                if (in_array($pictureExtension, $pictureExtensionAllowed)) {
                    if ($pictureSize < 1000000) {
                        move_uploaded_file($picturePath, $pictureDestination);
                    } else {
                        echo "Votre fichier est trop volumineux";
                    }
                } else {
                    echo "Votre fichier n'est pas une image";
                }
            }
            return header('Location: /acscape/admin/game');
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
            'start' => $_POST['start'],
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
                $pictureExtensionAllowed = ['jpg', 'jpeg', 'png', 'gif'];
                $pictureSize = $_FILES['picture']['size'];
                if (in_array($pictureExtension, $pictureExtensionAllowed)) {
                    if ($pictureSize < 1000000) {
                        move_uploaded_file($picturePath, $pictureDestination);
                    } else {
                        echo "Votre fichier est trop volumineux";
                    }
                } else {
                    echo "Votre fichier n'est pas une image";
                }
            } else {
                $picture = $_POST['picture'];
            }
            return header('Location: /acscape/admin/game');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $room = new Room($this->getDB());
        $result = $room->destroy($id);

        if ($result) {
            return header('Location: /acscape/admin/game');
        }
    }

   

}