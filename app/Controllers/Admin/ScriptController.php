<?php 

namespace App\Controllers\Admin;

use App\Models\Script;
use App\models\User;
use App\Controllers\Controller;

class ScriptController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $scripts = (new Script($this->getDB()))->all();
        return $this->view('admin.script.index', compact('scripts'));
        // return $this->view('admin.script.index');
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
       
        // $result = $script->create([
        //     'title' => $_POST['title'],
        //     'difficulty' => $_POST['difficulty'],
        //     'description' => $_POST['description'],
        //     'winner_msg' => $_POST['winner_msg'],
        //     'lost_msg' => $_POST['lost_msg'],
        //     'picture' => $_POST['picture'],
        //     'duration' => $_POST['duration'],
        //     'user_id' => $_SESSION['auth']->$user->id
        // ]);

        $result = $script->create($_POST);

        if ($result) {
            return header('Location: /acscape/admin/script');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $script = (new Script($this->getDB()))->findById($id);

        return $this->view('admin.script.form', compact('script'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $script = new Script($this->getDB());

        $result = $script->update($id, $_POST);

        if ($result) {
            return header('Location: /admin/scripts');
        }
    }

}