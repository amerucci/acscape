<?= $title = "Se connecter"; ?>





<?php session_destroy(); ?>


<div class="background_login_register"></div>
<div class="imageHeaderTop">
    <img class='imageHeaderTop_img' src="assets/front/login/login_register_top2.png" alt="">
</div>

<div class='login_register'>

    <h1 class='titleLogin'>se connecter<span>&#x25CF;</span></h1>

    <div class="login-box">

        <?php if (isset($_GET['error']) && $_GET['error'] === 'error'): ?>
        <div class="alert alert-danger">
            <li>Le mot de passe ou le pseudo est incorrect</li>
        </div>
        <?php endif ?>

        <?php if (isset($_SESSION['errors'])): ?>

        <?php foreach($_SESSION['errors'] as $errorsArray): ?>
        <?php foreach($errorsArray as $errors): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
            <li><?= $error ?></li>
            <?php endforeach ?>
        </div>
        <?php endforeach ?>
        <?php endforeach ?>

        <?php endif ?>

        <div class="onglet_login_register">
            <div class="onglet_login_register_item onglet_login_register_item_active" id="onglet_login">Se connecter
            </div>
            <div class="onglet_login_register_item" id="onglet_register">Se créer un compte</div>
        </div>

        <form action="login" method="POST" id="formLogin" autocomplete="off">
            <div class="user-box">
                <input type="text" name="username" id="username" required="" autocomplete="off" class="no-autofill-bkg">
                <label>Nom d'utilisateur</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="" autocomplete="off">
                <label>Mot de passe</label>
            </div>
            <button type="submit" class="btn_login_register">Se connecter</button>
        </form>

    </div>
</div>

<!-- https://learn.microsoft.com/en-us/answers/questions/974921/edge-bug-autocomplete34off34-still-displays-previo.html -->
<!-- https://www-anoopcnair-com.translate.goog/disable-enable-edge-browser-autofill-inputs/?_x_tr_sl=en&_x_tr_tl=fr&_x_tr_hl=fr -->


<script>
    const onglet_login = document.getElementById('onglet_login');
    const onglet_register = document.getElementById('onglet_register');
    const formLogin = document.getElementById('formLogin');
    const btn_login_register = document.getElementsByClassName('btn_login_register');
    const titleLogin = document.getElementsByClassName('titleLogin');


    onglet_login.addEventListener('click', function () {
        onglet_login.classList.add('onglet_login_register_item_active');
        onglet_register.classList.remove('onglet_login_register_item_active');
        if (onglet_login.classList.contains('onglet_login_register_item_active')) {
            formLogin.action = 'login';
            formLogin.style.padding = "8% 8%";
            btn_login_register[0].style.marginTop = "15px"
            btn_login_register[0].innerHTML = 'Se connecter';
            titleLogin[0].innerHTML = 'se connecter<span>&#x25CF;</span>';
            if (document.querySelectorAll('.user-box').length > 2) {
                document.querySelectorAll('.user-box')[1].remove();
            }
        }

    });

    onglet_register.addEventListener('click', function () {
        onglet_register.classList.add('onglet_login_register_item_active');
        onglet_login.classList.remove('onglet_login_register_item_active');
        formLogin.action = 'register';
        if (onglet_register.classList.contains('onglet_login_register_item_active')) {
            btn_login_register[0].innerHTML = 'S\'inscrire';
            titleLogin[0].innerHTML = 's\'inscrire<span>&#x25CF;</span>';
            formLogin.style.padding = "4% 8%";
            btn_login_register[0].style.marginTop = "0px"
            if (document.querySelectorAll('.user-box').length > 2) {
                document.querySelectorAll('.user-box')[3].remove();
            }
            const inputEmail = document.createElement('div');
            inputEmail.classList.add('user-box');
            inputEmail.innerHTML = `<input type="text" name="email" id="email" required="">
                <label class="focus_on">Adresse mail</label>`;
            formLogin.insertBefore(inputEmail, formLogin.childNodes[2]);
        }
    });

    setTimeout(function () {
        const alerteDanger = document.querySelectorAll('.alert-danger');
        for (let i = 0; i < alerteDanger.length; i++) {
            alerteDanger[i].remove();
            window.history.replaceState({}, document.title, "/" + "acscape/login");
        }
    }, 2000);


    // regex password
    const password = document.querySelectorAll('input[type="password"]');
    for (let i = 0; i < password.length; i++) {
        password[i].addEventListener('keyup', function () {
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if (regex.test(password[i].value)) {
                password[i].style.borderBottom = "2px solid #00ff00";
            } else {
                password[i].style.borderBottom = "2px solid #ff0000";
            }
        });
    }
</script>