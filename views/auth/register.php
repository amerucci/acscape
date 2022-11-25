<?= $title = "S'enregistrer"; ?>
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

<?php session_destroy(); ?>

<h1>créér un compte</h1>

<form action="register" method="POST">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">S'enregistrer</button>
</form>