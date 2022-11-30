<div class="background_login_register"></div>
<div class="imageHeaderTop">
    <img class='imageHeaderTop_img' src="assets/front/login/login_register_top2.png" alt="">
</div>

<div class='login_register'>

    <h1 class='titleLogin'>se connecter<span>&#x25CF;</span></h1>

    <div class="login-box">

        <div class="onglet_login_register">
            <div class="onglet_login_register_item onglet_login_register_item_active" id="onglet_login">Se connecter
            </div>
            <div class="onglet_login_register_item" id="onglet_register">Se créer un compte</div>
        </div>

        <form action="login" method="POST" id="formLogin">
            <div class="user-box">
                <input type="text" name="username" id="username" required="">
                <label>Nom d'utilisateur</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Mot de passe</label>
            </div>
            <button type="submit" class="btn_login_register">Se connecter</button>
        </form>

    </div>
</div>


<script>
    const onglet_login = document.getElementById('onglet_login');
    const onglet_register = document.getElementById('onglet_register');
    const formLogin = document.getElementById('formLogin');
    const btn_login_register = document.getElementsByClassName('btn_login_register');

    onglet_login.addEventListener('click', function () {
        onglet_login.classList.add('onglet_login_register_item_active');
        onglet_register.classList.remove('onglet_login_register_item_active');
        if (onglet_login.classList.contains('onglet_login_register_item_active')) {
            formLogin.action = 'login';
            btn_login_register[0].innerHTML = 'Se connecter';
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
            if (document.querySelectorAll('.user-box').length > 2) {
                document.querySelectorAll('.user-box')[3].remove();
            }
            const inputEmail = document.createElement('div');
            inputEmail.classList.add('user-box');
            inputEmail.innerHTML = `<input type="email" name="email" required="">
                <label>Adresse mail</label>`;
            formLogin.insertBefore(inputEmail, formLogin.childNodes[2]);
        }
    });
</script>