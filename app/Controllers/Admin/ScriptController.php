<?php 

namespace App\Controllers\Admin;

use App\models\User;
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
        $users = (new User($this->getDB()))->getByUserId($_SESSION['user_id']);    
        return $this->view('admin.script.create', compact('users'));
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
            // 'picture' => time().'_'.$_FILES['picture']['name'],
            'picture' => isset($_FILES['picture']['name']) ? time().'_'.$_FILES['picture']['name'] : $_POST['picture'],
            'duration' => $_POST['duration'],
            'user_id' => $_POST['user_id'],
        ]);

       
            
                if ($result) {
                    if (!empty($_FILES['picture']['name']))  {
                        $picture = $_FILES['picture']['name'];
                        $picturePath = $_FILES['picture']['tmp_name'];
                        $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
                        if ($pictureExtension == 'jpg' || $pictureExtension == 'jpeg' || $pictureExtension == 'png' || $pictureExtension == 'gif' || $pictureExtension == 'svg' || $pictureExtension == 'webp') {
                        $pictureName = pathinfo($picture, PATHINFO_FILENAME);
                        $pictureName = time() . '_' . $pictureName . '.' . $pictureExtension;
                        $pictureDestination = '../assets/pictures/scripts/' . $pictureName;
                        $pictureExtensionAllowed = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
                        $pictureSize = $_FILES['picture']['size'];
                    }
                        if (in_array($pictureExtension, $pictureExtensionAllowed)) {
                            if ($pictureSize < 2000000) {
                                move_uploaded_file($picturePath, $pictureDestination);
                            } else {
                                echo "Votre fichier est trop volumineux";
                            }
                        } else {
                            echo "Votre fichier n'est pas une image";
                        }
                    }
                    $_SESSION['script_id'] = $script->lastInsertId();
            return header('Location: /admin/game');
                }
        
            
           
            
            // $_SESSION['script_id'] = $script->lastInsertId();
            // return header('Location: /admin/game');
        
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

        $result = $script->update($id, [
            'title' => $_POST['title'],
            'difficulty' => $_POST['difficulty'],
            'description' => $_POST['description'],
            'winner_msg' => $_POST['winner_msg'],
            'lost_msg' => $_POST['lost_msg'],
            'picture' => isset($_FILES['picture']['name']) ? time().'_'.$_FILES['picture']['name'] : $_POST['picture'],
            'duration' => $_POST['duration'],
            'user_id' => $_POST['user_id'],
        ]);

        // if ($result) {
        //     if (!empty($_FILES['picture']['name']))  {
        //         $picture = $_FILES['picture']['name'];
        //         $picturePath = $_FILES['picture']['tmp_name'];
        //         $pictureExtension = pathinfo($picture, PATHINFO_EXTENSION);
        //         if ($pictureExtension == 'jpg' || $pictureExtension == 'jpeg' || $pictureExtension == 'png' || $pictureExtension == 'gif' || $pictureExtension == 'svg' || $pictureExtension == 'webp') {
        //         $pictureName = pathinfo($picture, PATHINFO_FILENAME);
        //         $pictureName = time() . '_' . $pictureName . '.' . $pictureExtension;
        //         $pictureDestination = '../assets/pictures/scripts/' . $pictureName;
        //         $pictureExtensionAllowed = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
        //         $pictureSize = $_FILES['picture']['size'];
        //     }
        //         if (in_array($pictureExtension, $pictureExtensionAllowed)) {
        //             if ($pictureSize < 2000000) {
        //                 move_uploaded_file($picturePath, $pictureDestination);
        //             } else {
        //                 echo "Votre fichier est trop volumineux";
        //             }
        //         } else {
        //             echo "Votre fichier n'est pas une image";
        //         }
        //     }
        //     return header('Location: /admin/game');
        // }

        if ($result){
            if(!empty($_FILES['picture'])){
                $nameFile = $_FILES['picture']['name'];
                $typeFile = $_FILES['picture']['type'];
                $sizeFile = $_FILES['picture']['size'];
                $tmpFile = $_FILES['picture']['tmp_name'];
                $errorFile = $_FILES['picture']['error'];
                $extensionFile = pathinfo($nameFile, PATHINFO_EXTENSION);
                $extensionFile = strtolower($extensionFile);
                $extensionAllowed = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
                $regex = '/^\s*1672995121_\s*$/';
                if(in_array($extensionFile, $extensionAllowed)){
                    if($errorFile === 0){
                        if($sizeFile < 2000000){
                            $nameFile = time().'_'.$nameFile;
                            $destination = '../assets/pictures/scripts/'.$nameFile;
                            move_uploaded_file($tmpFile, $destination);
                            if(preg_match($regex, $nameFile)){
                                unlink('../assets/pictures/scripts/'.$_POST['picture']);
                                $script->update($id, [
                                    'picture' => $nameFile
                                ]);
                            }
                        } else {
                            echo "Votre fichier est trop volumineux";
                        }
                    } else {
                        echo "Une erreur est survenue";
                    }
                } else {
                    echo "Votre fichier n'est pas une image";
                }
            }
            return header('Location: /admin/game');
        }

    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $script = new Script($this->getDB());

        $result = $script->destroy($id);

        if ($result) {
            return header('Location: /admin/script');
        }
    }


}