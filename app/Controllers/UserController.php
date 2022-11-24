<?php

namespace App\Controllers;

use App\models\User;
use App\Validation\Validator;

class UserController extends Controller {

    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginPost()
    {

        

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required']
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: login');
            exit;
        }

        $user = (new User($this->getDB()))->getByUsername($_POST['username']);

        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = (int) $user->role;
            return header('Location: admin/posts?success=true');
        } else {
            return header('Location: login?error=error');
        }
    }

    public function logout()
    {
        session_destroy();

        return header('Location: /acscape');
    }

    public function register()
    {
        return $this->view('auth.register');
    }

       public function registerPost()
        {
            $validator = new Validator($_POST);
            $errors = $validator->validate([
                'username' => ['required', 'min:3'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6']
            ]);
    
            if ($errors) {
                $_SESSION['errors'][] = $errors;
                header('Location: register');
                exit;
            }
    
            $user = new User($this->getDB());
            $user->create([
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                'admin' => 1,
                'email' => $_POST['email']
            ]);
    
            return header('Location: login');
        }


}