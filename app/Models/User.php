<?php

namespace App\models;

class User extends Model {

    protected $table = 'users';

    public function getByUsername(string $username): User
    {
        if ($this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true)) {
            return $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
        } else {
            return header('Location: login?error=error');
        }
    }

    public function getByUserId(int $id): User
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }
}