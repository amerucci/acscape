<?php 

namespace App\Models;

class Furniture extends Model {

    protected $table = 'furnitures';

    public function getByTitle(string $title): Furniture
    {
        return $this->query("SELECT * FROM {$this->table} WHERE title = ?", [$title], true);
    }

    public function getExcerpt(): string
    {
        return substr($this->description, 0, 50) . '...';
    }

    
}