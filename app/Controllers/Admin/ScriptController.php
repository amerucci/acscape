<?php 

namespace App\Controllers\Admin;

use App\Models\Script;
use App\Controllers\Controller;

class ScriptController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $scripts = (new Script($this->getDB()))->all();
        return $this->view('admin.script.index', compact('scripts'));
    }

    public function show(int $id)
    {
        $this->isAdmin();

        $script = (new Script($this->getDB()))->findById($id);

        return $this->view('admin.script.show', compact('script'));
    }

    public function create()
    {
        $this->isAdmin();
    
        return $this->view('admin.script.create');
    }

    public function createScript()
    {
        $this->isAdmin();

        $script = new Script($this->getDB());
       
        $result = $script->create([
            'title' => $_POST['title'],
            'difficulty' => $_POST['difficulty'],
            'description' => $_POST['description'],
            'winner_msg' => $_POST['winner_msg'],
            'lost_msg' => $_POST['lost_msg'],
            'picture' => $_FILES['picture']['name'],
            'duration' => $_POST['duration'],
            'user_id' => $_POST['user_id'],
        ]);

        if ($result) {
            if (!empty($_FILES['picture']['name'])) {
                $picture = $_FILES['picture']['name'];
                $picturePath = $_FILES['picture']['tmp_name'];
                $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
                $pictureName = pathinfo($picture, PATHINFO_FILENAME);
                $pictureName = $pictureName . "." . $pictureExtension;
                $pictureDestination = '../assets/pictures/scripts/' . $pictureName;
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
            return header('Location: /acscape/admin/script');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $script = (new Script($this->getDB()))->findById($id);

        return $this->view('admin.script.edit', compact('script'));
    }

    public function update($id)
    {
        $this->isAdmin();

        $script = new Script($this->getDB());

        $result = $script->update($id, $_POST);

        if ($result) {
            return header('Location: /acscape/admin/script');
        }

    }


}