<?php 

namespace App\Controllers\Admin;

use App\Models\Furniture;
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
        
            return $this->view('admin.furniture.create');
        }
    
        public function createFurniture()
        {
            $this->isAdmin();
    
            $furniture = new Furniture($this->getDB());
            $result = $furniture->create([
                'title' => $_POST['title'],
                'picture' => $_FILES['picture']['name'],
                'description' => $_POST['description'],
                'action' => $_POST['action'],
                'clue' => $_POST['clue'],
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
                return header('Location: /acscape/admin/furniture');
            }
        }
    
        public function edit(int $id)
        {
            $this->isAdmin();
    
            $furniture = (new Furniture($this->getDB()))->findById($id);
            return $this->view('admin.furniture.edit', compact('furniture'));
        }
    
        public function update(int $id)
        {
            $this->isAdmin();
    
            $furniture = new Furniture($this->getDB());
            $result = $furniture->update($id, [
                'title' => $_POST['title'],
                'picture' => $_FILES['picture']['name'],
                'description' => $_POST['description'],
                'action' => $_POST['action'],
                'clue' => $_POST['clue'],
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
                return header('Location: /acscape/admin/furniture');
            }

        }
}