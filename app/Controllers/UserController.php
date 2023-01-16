<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;
use App\Models\PassRecover;

class UserController extends Controller {

    public function login()
    {
        $csrf_token = $this->generateCsrfToken();
        setcookie('csrf_token', $csrf_token, [
            'expires' => time() + 7200,
            'samesite' => 'strict',
            // 'secure' => true
            ]);
        return $this->view('auth.login',compact('csrf_token'));
    }

    public function loginPost()
    {

        if (!$this->validateCsrfToken($_POST['csrf_token'])) {
            return header('Location: /login?error=invalid_csrf_token');
        }

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required']
        
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }

        $user = (new User($this->getDB()))->getByUsername($_POST['username']);

        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = (int) $user->role;
            $_SESSION['user_id'] = (int) $user->id;
            $_SESSION['token'] = $user->token;
            return header('Location: index');
        } else {
            return header('Location: /login?error=error');
        }
    }

    public function logout()
    {
        session_destroy();

        return header('Location: /');
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
    
            $user = new User ($this->getDB());
            $email = $user->getByUserMail($_POST['email']);
            $username = $user->isExistUsername($_POST['username']);
            if ($email) {
                $_SESSION['errorMail'][] = 'Cet email est déjà utilisé';
                header('Location: login?error=email');
                exit;
            }
            if ($username) {
                $_SESSION['errorUsername'][] = 'Ce nom d\'utilisateur est déjà utilisé';
                header('Location: login?error=username');
                exit;
            }

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
            $token_user = $user[0]->token;
            $recover = new PassRecover($this->getDB());
            $recover->create([
                'token_user' => $token_user,
                'token' => $token
            ]);
            $link = "http://localhost/reset?token=".$token."&u=".$token_user;
            $to = $_POST['email'];
            $subject = "Réinitialisation de votre mot de passe";
            $message = "Bonjour, vous avez demandé à réinitialiser votre mot de passe. Pour ce faire, veuillez cliquer sur le lien suivant : ".$link;
            $headers = "From: ACScape";
            // mail($to, $subject, $message, $headers);
            echo "<a href='$link'>Cliquez ici pour réinitialiser votre mot de passe</a>";
            // return header('Location: login?success=success');
            $recover->deleteOldTokens(1); // Supprime les anciens tokens après 1h
        } else {
            return header('Location: forgot?error=error');
        }
    }

    public function reset()
    {
        $token = $_GET['token'];
        $recover = (new PassRecover($this->getDB()))->getByToken($token);
        if ($recover) {
            return $this->view('auth.reset');
        } else {
            return header('Location: login?error=error');
        }

        return $this->view('auth.reset');
    }

    public function resetPost()
    {
        // Vérifiez si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return header('Location: reset?error=error');
        }
    
        // Validez les champs du formulaire
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'password' => ['required', 'min:6', 'max:255'],
            'password_confirmation' => ['required', 'matches:password'],
        ]);
    
        // Si des erreurs sont détectées, redirigez vers la page de réinitialisation du mot de passe
        // et affichez les erreurs
        if ($errors) {
            $_SESSION['errors'][] = $errors;
            return header('Location: reset?error=error');
        }
        // Récupérez les données du formulaire
        $password = $_POST['password'];

        $token = $_GET['token'];
        $token_user = $_GET['u'];
    
        // Vérifiez que le token de réinitialisation de mot de passe est valide
        $recover = (new PassRecover($this->getDB()))->getByToken($token);
        if (!$recover) {
            return header('Location: login?error=error');
        }
        // Réinitialisez le mot de passe de l'utilisateur
        $user = new User($this->getDB());
        $user->updatePassword($token_user, $password);
    
        
        // Supprimez le token de réinitialisation de mot de passe
        $deleteToken = new PassRecover($this->getDB());
        $deleteToken->deleteByToken($recover[0]->token);
        // Redirigez l'utilisateur vers la page de connexion avec un message de succès
        return header('Location: login?success=success');
    }
}