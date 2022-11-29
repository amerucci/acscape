<?php

namespace App\Models;

class Interaction extends Model {

    protected $table = 'interactions';

    public function getByTitle(string $title): Object
    {
        return $this->query("SELECT * FROM {$this->table} WHERE title = ?", [$title], true);
    }
    
    
}