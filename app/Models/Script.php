<?php 

namespace App\Models;

class Script extends Model {

    protected $table = 'scripts';

    public function getByTitle(string $title): Script
    {
        return $this->query("SELECT * FROM {$this->table} WHERE title = ?", [$title], true);
    }

}