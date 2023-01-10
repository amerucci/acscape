<?php $title = "Mot de passe oublié"; ?>

<div class="background_login_register">
    <!-- <img class='imageHeaderTop_img' src="assets/front/login/login_register_top2.png" alt=""> -->
</div>

<div class='login_register'>

    <h1 class='titleLogin'>Mot de passe oublié<span>&#x25CF;</span></h1>

    <div class="forgot-box">
        <?php if (isset($_GET['error']) && $_GET['error'] === 'error'): ?>
        <div class="alert alert-danger">
            <li>Cet adresse mail n'existe pas</li>
        </div>
        <?php endif ?>

        <form action="forgot" method="POST" id="formForgot" autocomplete="off"
            class="d-flex flex-column justify-content-center align-items-center">
            <legend>Adresse mail</legend>
            <input type="email" name="email" id="email" required="" autocomplete="off" class="no-autofill-bkg">


            <button type="submit" class="btn my-2 btn-send-forgot">Envoyer</button>

        </form>


    </div>
</div>

<script>
    setTimeout(function () {
        const alerteDanger = document.querySelectorAll('.alert-danger');
        for (let i = 0; i < alerteDanger.length; i++) {
            alerteDanger[i].remove();
        }
    }, 2000);
</script>