<?php $title = "Mot de passe oublié"; ?>

<div class="background_login_register">
    <img class='imageHeaderTop_img' src="assets/front/login/login_register_top2.png" alt="">
</div>

<div class='login_register'>

    <h1 class='titleLogin'>Mot de passe oublié<span>&#x25CF;</span></h1>

    <div class="forgot-box">

        <form action="forgot" method="POST" id="formForgot" autocomplete="off">

            <input type="email" name="email" id="email" required="" autocomplete="off" class="no-autofill-bkg">
            <label>Adresse mail</label>

            <button type="submit" class="btn_login_register">Envoyer</button>

        </form>


    </div>

    <?= var_dump($params) ?>