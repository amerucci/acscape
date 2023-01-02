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

    public function getByUserMail(string $email)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$email]);
    }

    public function getTokenUserByMail()
    {
        return $this->query("SELECT token FROM {$this->table} WHERE email = ?", [$_POST['email']]);
    }

    public function getByEmailAndTokenUser(string $email, string $token)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE email = ? AND token = ?", [$email, $token]);
    }

    public function getByToken(string $token)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE token = ?", [$token]);
    }

    public function updatePassword($token_user, $password){
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $this->query("UPDATE {$this->table} SET password = ? WHERE token = ?", [$password, $_GET['u']]);
    }
}