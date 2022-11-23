<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon super site</title>
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'style.css' ?>">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/oop">ACEscape</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/oop">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Les derniers jeux</a>
                </li>
                <?php if (isset($_SESSION['auth'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/oop/admin/posts">Administration</a>
                </li>
                <?php endif; ?>

            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- <a href="login">se connecter</a> -->
                <?php if (isset($_SESSION['auth'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/oop/logout">Se déconnecter</a>
                </li>
                <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="login">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register">S'enregistrer</a>
                    <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?= $content ?>
    </div>
</body>

</html>