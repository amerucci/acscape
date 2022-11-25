<?php

namespace App\Controllers\Admin;

use App\Models\Room;
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
    
        return $this->view('admin.room.create');
    }

    public function createRoom()
    {
        $this->isAdmin();

        $room = new Room($this->getDB());
        $result = $room->create([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'picture' => $_FILES['picture']['name'],
            'padlock' => $_POST['padlock'],
            'user_id' => $_POST['user_id'],
            'picture' => $_FILES['picture']['name'],

        ]);

        if ($result) {
            if (!empty($_FILES['picture']['name'])) {
                $picture = $_FILES['picture']['name'];
                $picturePath = $_FILES['picture']['tmp_name'];
                $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
                $pictureName = pathinfo($picture, PATHINFO_FILENAME);
                $pictureName = $pictureName . "." . $pictureExtension;
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
            return header('Location: /acscape/admin/room');
        }


    }
       
        

    public function edit(int $id)
    {
        $this->isAdmin();

        $room = (new Room($this->getDB()))->findById($id);
        return $this->view('admin.room.edit', compact('room'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $room = new Room($this->getDB());
        $result = $room->update($id, [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'picture' => $_FILES['picture']['name'],
            'padlock' => $_POST['padlock'],
            'user_id' => $_POST['user_id'],
        ]);

        if ($result) {
            if (!empty($_FILES['picture']['name'])) {
                $picture = $_FILES['picture']['name'];
                $picturePath = $_FILES['picture']['tmp_name'];
                $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
                $pictureName = pathinfo($picture, PATHINFO_FILENAME);
                $pictureName = $pictureName . "." . $pictureExtension;
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
            return header('Location: /acscape/admin/room');
        }
    }

   

}