<?php 

namespace App\Controllers\Admin;

use App\Models\furniture;
use App\Controllers\Controller;

class PadlockController extends Controller {

    public function index()
    {
        $this->isAdmin();
        return $this->view('admin.padlock.index');
    }

    public function show($id)
    {
        $this->isAdmin();
        return $this->view('admin.padlock.show');
    }

    public function create()
    {
        $this->isAdmin();
        return $this->view('admin.padlock.create');
    }

    public function createFurniture()
    {
        $this->isAdmin();  
    }


    public function edit($id)
    {
        $this->isAdmin();
    }

}