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

        $result = $script->create($_POST);

        if ($result) {
            return header('Location: /admin/scripts');
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