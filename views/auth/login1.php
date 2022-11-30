<!-- <?= $title = "Se connecter"; ?> -->
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

<?php if (isset($_GET['error']) && $_GET['error'] === 'error'): ?>
<div class="alert alert-danger">
    <li>Le mot de passe ou le pseudo est incorrect</li>
</div>
<?php endif ?>

<?php session_destroy(); ?>


<div class="greyBack"></div>
<div class="imageHeaderTop">
    <img src="assets/front/login/login_register_top.png" alt="">
</div>

<div class='login_register'>

    <h1 class='titleLogin'>se connecter<span>&#x25CF;</span></h1>

    <div>


        <form action="login" method="POST" class="loginForm">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
            <a href="register">S'enregistrer</a>
        </form>

    </div>
</div>