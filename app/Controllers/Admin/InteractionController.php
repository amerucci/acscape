<?php 

namespace App\Controllers\Admin;

use App\Models\Interaction;
use App\Models\Furniture;
use App\Controllers\Controller;

class InteractionController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $interactions = (new Interaction($this->getDB()))->all();
        return $this->view('admin.interaction.index', compact('interactions'));
    }

    public function show(int $id)
    {
        $this->isAdmin();

        $interaction = (new Interaction($this->getDB()))->findById($id);
        return $this->view('admin.interaction.show', compact('interaction'));
    }

    public function create()
    {
        $this->isAdmin();
        $interactions = (new Interaction($this->getDB()))->all();    
        return $this->view('admin.interaction.create', compact('interactions'));
    }

    public function createInteraction()
    {
        $this->isAdmin();

       
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $interaction = (new Interaction($this->getDB()))->findById($id);
        return $this->view('admin.interaction.edit', compact('interaction'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

      
    }

    public function delete(int $id)
    {
     
    }
    

  

}