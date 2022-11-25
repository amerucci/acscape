<?php

namespace App\Models;

class Objects extends Model {

    protected $table = 'objects';

    public function getByTitle(string $title): Object
    {
        return $this->query("SELECT * FROM {$this->table} WHERE title = ?", [$title], true);
    }

    public function getExcerpt(): string
    {
        return substr($this->description, 0, 50) . '...';
    }

    
}