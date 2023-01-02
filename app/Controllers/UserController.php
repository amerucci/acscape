<?php

namespace App\Controllers;

use App\models\User;
use App\Validation\Validator;
use App\models\PassRecover;

class UserController extends Controller {

    public function login()
    {
        $csrf_token = $this->generateCsrfToken();
        setcookie('csrf_token', $csrf_token, time() + 7200 );
        return $this->view('auth.login',compact('csrf_token'));
       
    }

    public function loginPost()
    {

        // if (!isset($_COOKIE['csrf_token'])) {
        //     // Si le jeton CSRF n'est pas présent, cela signifie que le cookie a expiré
        //     return header('Location: /acscape/login?error=session_expired');
        // }

        if (!$this->validateCsrfToken($_POST['csrf_token'])) {
            return header('Location: login?error=invalid_csrf_token');
        }

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required']
        
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: acscape/login');
            exit;
        }

        $user = (new User($this->getDB()))->getByUsername($_POST['username']);

        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = (int) $user->role;
            $_SESSION['user_id'] = (int) $user->id;
            $_SESSION['token'] = $user->token;
            return header('Location: /acscape/index');
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

        $token = bin2hex(random_bytes(32));

        $validator = new Validator($_POST);
        $errors = $validator->validate([
        'username' => ['required', 'min:3'],
        'email' => ['required', 'email'],
        'password' => ['required', 'min:6'],
        ]);
    
        if ($errors) {
         $_SESSION['errors'][] = $errors;
         header('Location: login');
         exit;
            }
    
        $user = new User($this->getDB());
        $user->create([
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'role' => 1,
        'email' => $_POST['email'],
        'token' => $token
                
            ]);
    
        return header('Location: login');
    }

    public function forgot()
    {
        return $this->view('auth.forgot');
    }

    public function forgotPost()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'email'],
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: forgot');
            exit;
        }

        $user = (new User($this->getDB()))->getTokenUserByMail();
        
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $recover = new PassRecover($this->getDB());
            $recover->create([
                'token_user' => $user[0]->token,
                'token' => $token
            ]);
            $to = $_POST['email'];
            $subject = "Réinitialisation de votre mot de passe";
            $message = "Bonjour, vous avez demandé à réinitialiser votre mot de passe. Pour ce faire, veuillez cliquer sur le lien suivant : http://localhost/acscape/reset?token=$token";
            $headers = "From: ACScape";
            mail($to, $subject, $message, $headers);
            return header('Location: login?success=success');
        } else {
            return header('Location: forgot?error=error');
        }
    }

    public function reset()
    {
        // $token = $_GET['token'];
        // $recover = (new PassRecover($this->getDB()))->getByToken($token);
        // if ($recover) {
        //     return $this->view('auth.reset');
        // } else {
        //     return header('Location: login?error=error');
        // }

        return $this->view('auth.reset');
    }

    public function resetPost()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'password' => ['required', 'min:6'],
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: reset?token='.$_POST['token']);
            exit;
        }

        $recover = (new PassRecover($this->getDB()))->getByToken($_POST['token']);
        $user = (new User($this->getDB()))->getByToken($recover->token_user);
        $user->update([
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ]);
        $recover->delete();
        return header('Location: login?success=success');
    }
}