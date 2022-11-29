<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'login.css' ?>">
    <title>Document</title>
</head>

<body>

    <nav class="navbar">
        <div class="logoNav">
            <img src="assets\front\nav\logo.svg" alt="">
        </div>
        <div>
            <ul class="navList">
                <li><a href="">Accueil</a></li>
                <li><a href="">nos escape games</a></li>
                <li><a href="">contact</a></li>
            </ul>
        </div>
        <div>
            <ul class="navLog">
                <li>
                    <a alt="" href=""><img src="assets\front\nav\user-avatar.svg"> SE CONNECTER</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?= $content ?>
    </div>

    <footer>

    </footer>

</body>

</html>