<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller {

    protected $db;

    public function __construct(DBConnection $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = $db;
    }

    public function generateCsrfToken() {
        $random_id = bin2hex(random_bytes(32));
        $csrf_token = hash_hmac('sha256', $random_id, 'secret_key');
        return $csrf_token;
    }

    public function validateCsrfToken($csrf_token) {
        $stored_token = $_COOKIE['csrf_token'];
        if ($csrf_token === $stored_token) {
            return true;
        } else {
          return false;
        }
    }   

  

    protected function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    protected function json(string $path, array $data)
    {
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        header('Content-Type: application/json');
        echo json_encode( $data );
        exit();
   }

    protected function getDB()
    {
        return $this->db;
    }

    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1) {
            return true;
        } else {
            return header('Location: login');
        }
        if ($_COOKIE['csrf_token'] != $_SESSION['csrf']) {
            return header('Location: /login?error=session_expired');
            } 

    }

}