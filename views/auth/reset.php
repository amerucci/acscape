<?php $title = "Mot de passe oublié";
$token = $_GET['token']; ?>

<div class="background_login_register">
    <img class='imageHeaderTop_img' src="assets/front/login/login_register_top2.png" alt="">
</div>

<div class='login_register'>

    <h1 class='titleLogin'>Nouveau mot de passe<span>&#x25CF;</span></h1>

    <div class="forgot-box">

        <form action="" method="POST" id="formForgot" autocomplete="off"
            class="d-flex flex-column justify-content-center align-items-center">
            <legend>Mot de passe</legend>
            <input type="text" name="password" id="paswword" required="" autocomplete="off" class="no-autofill-bkg">
            <input type="hidden" name="token" value="<?= ($_GET['u']) ?>" />
            <input type="hidden" name="token" value="<?= ($_GET['token']) ?>" />
            <button type="submit" class="btn">Envoyer</button>

        </form>

    </div>
</div>