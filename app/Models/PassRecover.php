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


}