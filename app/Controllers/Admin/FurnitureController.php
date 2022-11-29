<?php 

namespace App\Controllers\Admin;

use App\Models\Furniture;
use App\Models\Objects;
use App\Controllers\Controller;


class FurnitureController extends Controller {
    
        public function index()
        {
            $this->isAdmin();
    
            $furnitures = (new Furniture($this->getDB()))->all();
            return $this->view('admin.furniture.index', compact('furnitures'));
        }

        public function show(int $id)
        {
            $this->isAdmin();
    
            $furniture = (new Furniture($this->getDB()))->findById($id);
            return $this->view('admin.furniture.show', compact('furniture'));
        }
    
        public function create()
        {
            $this->isAdmin();
            $objects = (new Objects($this->getDB()))->all();
        
            return $this->view('admin.furniture.create', compact('objects'));
        }
    
        public function createFurniture()
        {
            $this->isAdmin();
    
            $furniture = new Furniture($this->getDB());
            $result = $furniture->create([
                'title' => $_POST['title'],
                'picture' => isset($_FILES['picture']['name']) ? time().'_'.$_FILES['picture']['name'] : $_POST['picture'],
                'description' => $_POST['description'],
                'action' => $_POST['action'],
                'clue' => $_POST['clue'],
                'clue2' => (isset($_POST['clue2'])) ? $_POST['clue2'] : null,
                'clue3' => (isset($_POST['clue3'])) ? $_POST['clue3'] : null,
                'padlock' => $_POST['padlock'],
                'user_id' => $_POST['user_id'],
                'script_id' => $_POST['script_id'],
                'room_id' => $_POST['room_id'],
                'object_id' => $_POST['object_id'],
    
            ]);
    
            if ($result) {
                if (!empty($_FILES['picture']['name'])) {
                    $picture = $_FILES['picture']['name'];
                    $picturePath = $_FILES['picture']['tmp_name'];
                    $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
                    $pictureName = pathinfo($picture, PATHINFO_FILENAME);
                    $pictureName = time() . '_' . $pictureName . '.' . $pictureExtension;
                    $pictureDestination = '../assets/pictures/furnitures/' . $pictureName;
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
                if ($_POST['object_id'] == 0){
                    $_POST['object_id'] = null;
                }
                return header('Location: /acscape/admin/game');
            }
        }
    
        public function edit(int $id)
        {
            $this->isAdmin();
    
            $furniture = (new Furniture($this->getDB()))->findById($id);
            $object = (new Objects($this->getDB()))->all();
            return $this->view('admin.furniture.edit', compact('furniture', 'object'));
        }
    
        public function update(int $id)
        {
            $this->isAdmin();
    
            $furniture = new Furniture($this->getDB());
            $result = $furniture->update($id, [
                'title' => $_POST['title'],
                'picture' => isset($_FILES['picture']['name']) ? time().'_'.$_FILES['picture']['name'] : $_POST['picture'],
                'description' => $_POST['description'],
                'action' => $_POST['action'],
                'clue' => $_POST['clue'],
                'clue2' => (isset($_POST['clue2'])) ? $_POST['clue2'] : null,
                'clue3' => (isset($_POST['clue3'])) ? $_POST['clue3'] : null,
                'padlock' => $_POST['padlock'],
                'user_id' => $_POST['user_id'],
                'script_id' => $_POST['script_id'],
                'room_id' => $_POST['room_id'],
                'object_id' => $_POST['object_id'],
            ]);

            if ($result) {

                if (!empty($_FILES['picture']['name'])) {
                    $picture = $_FILES['picture']['name'];
                    $picturePath = $_FILES['picture']['tmp_name'];
                    $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
                    $pictureName = pathinfo($picture, PATHINFO_FILENAME);
                    $pictureName = time() . '_' . $pictureName . '.' . $pictureExtension;
                    $pictureDestination = '../assets/pictures/furnitures/' . $pictureName;
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

        public function destroy(int $id)
        {
            $this->isAdmin();
    
            $furniture = new Furniture($this->getDB());
            $result = $furniture->destroy($id);
    
            if ($result) {
                return header('Location: /acscape/admin/game');
            }
        }


}