<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (strpos($_SERVER['REQUEST_URI'], 'login') == false): ?>
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">
    <?php endif ?>
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'login.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'navbar.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'footer.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'style.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'home.css' ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
    <title>Document</title>
</head>

<body>

    <nav class="navbar">
        <div class="logoNav">
            <img src="assets\front\nav\logo.svg" alt="">
        </div>
        <div>
            <ul class="navList">
                <li><a href="">accueil</a></li>
                <li><a href="">nos escape games</a></li>
                <li><a href="">contact</a></li>
            </ul>
        </div>
        <div>
            <ul class="navLog">
                <li>
                    <a alt="" href="login"><img src="assets\front\nav\user-avatar.svg"> SE CONNECTER</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid gx-0">
        <?= $content ?>
    </div>

    <footer class="container-fluid gx-0">
        <div class="footer_acs">
            <img src="assets\front\footer\logo_transparency.svg" alt="">
            <div class="copyright">
                <p>Copyright © 2022 ACSCAPE</p>
                <span>|</span>
                <p>Tous droits reservés</p>
                <span>|</span>
                <p>Mentions légales</p>
            </div>
        </div>
    </footer>

</body>


</html>