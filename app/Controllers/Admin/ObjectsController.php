<?php

namespace App\Controllers\Admin;

use App\Models\Objects;
use App\Controllers\Controller;

class ObjectsController extends Controller {
        
            public function index()
            {
                $this->isAdmin();
    
                $objects = (new Objects($this->getDB()))->all();
                return $this->view('admin.objects.index', compact('objects'));
            }

            public function show($id)
            {
                $this->isAdmin();
        
                $object = (new Objects($this->getDB()))->findById($id);
                return $this->view('admin.objects.show', compact('object'));
            }
        
            public function create()
            {
                $this->isAdmin();
            
                return $this->view('admin.objects.create');
            }
        
            public function createObject()
            {
                $this->isAdmin();
    
                $object = new Objects($this->getDB());
                $result = $object->create([
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'picture' => $_FILES['picture']['name'],
                    'user_id' => $_POST['user_id'],
                    'script_id' => $_POST['script_id'],
    
                ]);
    
                if ($result) {
                    if (!empty($_FILES['picture']['name'])) {
                        $picture = $_FILES['picture']['name'];
                        $picturePath = $_FILES['picture']['tmp_name'];
                        $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
                        $pictureName = pathinfo($picture, PATHINFO_FILENAME);
                        $pictureName = $pictureName . "." . $pictureExtension;
                        $pictureDestination = '../assets/pictures/objects/' . $pictureName;
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
        
            public function edit($id)
            {
                $this->isAdmin();
        
                $object = (new Objects($this->getDB()))->findById($id);
                return $this->view('admin.objects.edit', compact('object'));
            }
        
            public function update($id)
            {
                $this->isAdmin();
        
                $object = new Objects($this->getDB());
                $result = $object->update($id, [
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'picture' => $_FILES['picture']['name'],
                    'user_id' => $_POST['user_id'],
                    'script_id' => $_POST['script_id'],
                ]);

                if ($result) {
                    if (!empty($_FILES['picture']['name'])) {
                        $picture = $_FILES['picture']['name'];
                        $picturePath = $_FILES['picture']['tmp_name'];
                        $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
                        $pictureName = pathinfo($picture, PATHINFO_FILENAME);
                        $pictureName = $pictureName . "." . $pictureExtension;
                        $pictureDestination = '../assets/pictures/objects/' . $pictureName;
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
}