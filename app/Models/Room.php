<?php 

namespace App\Models;

class Room extends Model {

    protected $table = 'rooms';

    public function getByTitle(string $title): Room
    {
        return $this->query("SELECT * FROM {$this->table} WHERE title = ?", [$title], true);
    }

    public function getExcerpt(): string
    {
        return substr($this->description, 0, 50) . '...';
    }

    public function getByRoomId(int $roomId): Room
    {
        return $this->query("SELECT * FROM {$this->table} WHERE room_id = ?", [$roomId], true);
    }

    public function countByRoomScriptID(int $script_id): Room
    {
        return $this->query("SELECT COUNT(*) FROM {$this->table}  WHERE script_id = ?" , [$script_id], true);
    }
    

}