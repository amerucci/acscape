<?php 

namespace App\models;

class PassRecover extends Model {

    protected $table = 'password_recover';

    public function insertToken($token){
            
            $token = bin2hex(random_bytes(32));
    
            $this->query("INSERT INTO {$this->table} (token) VALUES (?, ?)", [$token]);
    
            return $token;
    
    }

    public function getByToken(string $token)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE token = ?", [$token]);
    }

    public function getByTokenUser(string $token_user)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE token_user = ?", [$token_user]);
    }

    public function getByTokenUserAndToken(string $token_user, string $token)
    {

        return $this->query("SELECT * FROM {$this->table} WHERE token_user = ? AND token = ?", [$token_user, $token]);
    }

    public function deleteByToken (string $token)
    {
        return $this->query("DELETE FROM {$this->table} WHERE token = ?", [$token]);
    }

    public function deleteOldTokens(int $hours)
    {
    $this->query("DELETE FROM {$this->table} WHERE created_at < DATE_SUB(NOW(), INTERVAL ? HOUR)", [$hours]);
    }

}