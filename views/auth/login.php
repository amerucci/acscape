<?php $title = "Se connecter"; ?>

<?php $_SESSION['csrf'] = $params["csrf_token"]; ?>




<span class="void"></span>
<div class="container-fluid d-flex flex-column justify-content-center align-items-center">
    <div class="background_login_register"></div>

    <div class='login_register w-100'>

        <h1 class='titleLogin'>se connecter<span>&#x25CF;</span></h1>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'error'): ?>
        <div class="alert alert-danger">
            <li>Le mot de passe ou le pseudo est incorrect</li>
        </div>
        <?php endif ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'session_expired'): ?>
        <div class="alert alert-danger">
            <li>La session a expirée</li>
        </div>
        <?php endif ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'email'): ?>
        <div class="alert alert-danger">
            <li>Cet email existe déjà</li>
        </div>
        <?php endif ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'username'): ?>
        <div class="alert alert-danger">
            <li>Ce nom d'utilisateur existe déjà</li>
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
        <div class="login-box w-100">


            <div class="onglet_login_register">
                <div class="onglet_login_register_item onglet_login_register_item_active" id="onglet_login">Se connecter
                </div>
                <div class="onglet_login_register_item" id="onglet_register">Se créer un compte</div>
            </div>

            <form action="login" method="POST" id="formLogin" autocomplete="off">
                <div class="user-box">
                    <input type="text" name="username" id="username" required="" autocomplete="off"
                        class="no-autofill-bkg">
                    <label>Nom d'utilisateur</label>
                </div>
                <div class="user-box position-relative">
                    <input type="password" name="password" required="" autocomplete="off" class="password">
                    <label>Mot de passe</label>
                    <iconify-icon class="pass_to_text" icon="mdi:form-textbox-password" width="30" height="30">
                    </iconify-icon>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $params["csrf_token"]?>">
                <div class="d-flex flex-column gap-5 boutonSendAndForgot">
                    <button type="submit" class="btn_login_register">Se connecter</button>
                    <a class="forgot" href="/forgot">mot de passe oublié</a>
                </div>
            </form>

        </div>
    </div>
</div>




<script>
    // document.querySelector('.navbar').classList.add("navbarLogin")


    const onglet_login = document.getElementById('onglet_login');
    const onglet_register = document.getElementById('onglet_register');
    const formLogin = document.getElementById('formLogin');
    const btn_login_register = document.getElementsByClassName('btn_login_register');
    const titleLogin = document.getElementsByClassName('titleLogin');
    const forgot = document.querySelector('.forgot');
    let passwordRegist = document.querySelector('.password');
    let passwordRegister;
    const labelpassword = document.querySelector('.password').nextElementSibling;
    const pass_to_text = document.querySelector('.pass_to_text');

    pass_to_text.addEventListener('click', function () {
        if (passwordRegist.getAttribute('type') === 'password') {
            passwordRegist.setAttribute('type', 'text');
            pass_to_text.setAttribute('icon', 'mdi:form-textbox');
        } else {
            passwordRegist.setAttribute('type', 'password');
            pass_to_text.setAttribute('icon', 'mdi:form-textbox-password');
        }
    });


    onglet_login.addEventListener('click', function () {
        labelpassword.textContent = "Mot de passe";
        labelpassword.style.color = "rgba(108, 108, 108, 1)";
        onglet_login.classList.add('onglet_login_register_item_active');
        onglet_register.classList.remove('onglet_login_register_item_active');
        passwordRegist.classList.remove('passwordRegister');
        if (onglet_login.classList.contains('onglet_login_register_item_active')) {
            passwordRegist.setAttribute('data-action', 'passwordLogin');
            forgot.style.display = 'block';
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
            passwordRegist.setAttribute('data-action', 'passwordRegister');
            forgot.style.display = 'none';
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

    const alerteDanger = document.querySelectorAll('.alert-danger');
    const crossClose =
        `<iconify-icon class="closeAlert" icon="maki:cross" style="color: #d31e44;" width="30" height="30"></iconify-icon>`;
    for (let i = 0; i < alerteDanger.length; i++) {
        alerteDanger[i].innerHTML += crossClose;
    }
    const closeAlert = document.querySelector('.closeAlert');
    closeAlert.addEventListener('click', function () {
        alerteDanger[0].remove();
        window.history.replaceState({}, document.title, "/" + "login");
    });

    document.querySelector('.password').addEventListener('keyup', function () {
        if (passwordRegist.getAttribute('data-action') === 'passwordRegister') {
            const password = this.value;
            let errors = [];

            labelpassword.textContent = 'le mot de passe doit contenir:';
            if (password.length < 8) {
                errors.push('au moins 8 caractères');
            }
            if (!/[A-Z]/.test(password)) {
                errors.push('au moins une majuscule');
            }
            if (!/[a-z]/.test(password)) {
                errors.push('au moins une minuscule');
            }
            if (!/[0-9]/.test(password)) {
                errors.push('au moins un chiffre');
            }
            if (errors.length === 0) {
                labelpassword.textContent = 'Mot de passe valide';
                labelpassword.style.color = "rgba(108, 108, 108, 1)";
                btn_login_register[0].disabled = false;
            } else {
                labelpassword.textContent += " " + errors.join(', ');
                labelpassword.style.color = 'red';
                btn_login_register[0].disabled = true;
            }
        }
    });
</script>