<?php  if (strpos($_SERVER['REQUEST_URI'], 'admin') == true) : ?>
<?php if (!isset($_COOKIE['csrf_token'])) {
return header('Location: /login?error=session_expired');
} ?>

<?php endif; ?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Content-Language" content="fr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description"
        content="Découvrez notre sélection d'escape games uniques et immersifs. Créez votre propre aventure et challengez vos amis ou votre famille.">
    <meta name="Copyright" content="ACS">
    <meta name="Author" content="gamerBike">
    <meta name="Revisit-After" content="15 days">
    <meta name="Robots" content="all">
    <meta name="Rating" content="general">
    <meta name="Distribution" content="global">
    <meta name="Category" content="games">
    <link rel='icon' href='/assets/favico.jpg' />
    <!-- <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'main.min.css' ?>"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" async href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.min.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'login.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'navbar.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'footer.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'style.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'index.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'show.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'ingame.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'admin.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'welcomeRes.css' ?>">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ms-cursor@1.0.1/style.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <!-- custom cursor -> https://github.com/guillaume-rygn/MS-Cursor -->
    <!-- caroussel -> https://splidejs.com/ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script async src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
    <title><?= $title ?></title>
</head>

<body>

    <nav class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-logo">
                <img src="/assets/front/nav/logo.svg" alt="">
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

        <div class="nav-links">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2 w-100 px-3">

                <?php
                 if (strpos($_SERVER['REQUEST_URI'], 'ingame') !== false) : ?>
                <li class="nav-item in_game_nav"><?= $gameTitle ?></li>
                <li class="nav-item in_game_nav room_active"></li>
                <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/">accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index">nos escape games</a>
                </li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        création de jeu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/admin/posts">Créer</a></li>
                        <li><a class="dropdown-item" href="/admin/script">Liste de vos jeux</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                </li>
                <?php endif; ?>
                <!-- </ul> -->
                <li class="navLog">
                    <?php  if (strpos($_SERVER['REQUEST_URI'], 'ingame') !== false) : ?>
                    <div class="countdown_container d-flex gap-3">
                        <div class="penality d-flex align-items-center"></div>
                        <div class="penalityClue d-flex align-items-center"></div>
                        <div class="m-0 d-flex justify-content-center align-items-center" id='countdown'></div>
                    </div>
                    <?php else : ?>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                    <a alt="" href="/login">
                        <?php else : ?>
                        <a alt="" href="/logout">
                            <?php endif ?>
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 5.29688C9.38194 5.29687 8.77775 5.48015 8.26384 5.82353C7.74994 6.16691 7.3494 6.65497 7.11288 7.22599C6.87635 7.79701 6.81447 8.42534 6.93505 9.03153C7.05563 9.63772 7.35325 10.1945 7.79029 10.6316C8.22733 11.0686 8.78415 11.3663 9.39034 11.4868C9.99654 11.6074 10.6249 11.5455 11.1959 11.309C11.7669 11.0725 12.255 10.6719 12.5983 10.158C12.9417 9.64413 13.125 9.03994 13.125 8.42188C13.125 7.59307 12.7958 6.79822 12.2097 6.21217C11.6237 5.62612 10.8288 5.29688 10 5.29688Z"
                                    fill="white" />
                                <path
                                    d="M10 1.54688C8.26942 1.54687 6.57769 2.06005 5.13876 3.02152C3.69983 3.98298 2.57832 5.34954 1.91606 6.9484C1.25379 8.54725 1.08051 10.3066 1.41813 12.0039C1.75575 13.7012 2.58911 15.2603 3.81282 16.4841C5.03653 17.7078 6.59563 18.5411 8.29296 18.8787C9.9903 19.2164 11.7496 19.0431 13.3485 18.3808C14.9473 17.7186 16.3139 16.597 17.2754 15.1581C18.2368 13.7192 18.75 12.0275 18.75 10.2969C18.7474 7.97704 17.8246 5.75298 16.1843 4.11261C14.5439 2.47224 12.3198 1.54952 10 1.54688ZM14.995 15.8756C14.9825 15.0558 14.6485 14.2737 14.0649 13.6979C13.4814 13.122 12.6949 12.7984 11.875 12.7969H8.125C7.30512 12.7984 6.51865 13.122 5.93506 13.6979C5.35147 14.2737 5.01746 15.0558 5.005 15.8756C3.87161 14.8636 3.07234 13.5312 2.71303 12.0548C2.35372 10.5784 2.45132 9.02771 2.9929 7.60804C3.53449 6.18836 4.49452 4.96667 5.74586 4.10473C6.99721 3.24279 8.48084 2.78127 10.0003 2.78127C11.5198 2.78127 13.0034 3.24279 14.2548 4.10473C15.5061 4.96667 16.4661 6.18836 17.0077 7.60804C17.5493 9.02771 17.6469 10.5784 17.2876 12.0548C16.9283 13.5312 16.129 14.8636 14.9956 15.8756H14.995Z"
                                    fill="white" />
                            </svg>
                            <?php if (isset($_SESSION['user_id'])): ?>
                            DECONNEXION
                            <?php else : ?>
                            SE CONNECTER
                            <?php endif ?>
                        </a>
                        <?php endif ?>
                </li>

            </ul>
        </div>
    </nav>




    <div class="container-fluid gx-0 back_dark flex-grow-1 position-relative ingame_container_background">
        <?= $content ?>
    </div>

    <footer class="container-fluid gx-0 mt-3">
        <div class="footer_acs d-flex justify-content-center flex-column align-items-center py-2">
            <svg class="my-1" width="161" height="42" viewBox="0 0 161 42" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M48.62 26L54.74 12H59.38L65.5 26H60.62L56.1 14.24H57.94L53.42 26H48.62ZM52.26 23.56L53.46 20.16H59.9L61.1 23.56H52.26ZM74.698 26.32C73.578 26.32 72.538 26.1467 71.578 25.8C70.6313 25.44 69.8046 24.9333 69.098 24.28C68.4046 23.6267 67.8646 22.8533 67.478 21.96C67.0913 21.0667 66.898 20.08 66.898 19C66.898 17.92 67.0913 16.9333 67.478 16.04C67.8646 15.1467 68.4046 14.3733 69.098 13.72C69.8046 13.0667 70.6313 12.5667 71.578 12.22C72.538 11.86 73.578 11.68 74.698 11.68C76.0713 11.68 77.2846 11.92 78.338 12.4C79.4046 12.88 80.2846 13.5733 80.978 14.48L77.998 17.14C77.5846 16.62 77.1246 16.22 76.618 15.94C76.1246 15.6467 75.5646 15.5 74.938 15.5C74.4446 15.5 73.998 15.58 73.598 15.74C73.198 15.9 72.8513 16.1333 72.558 16.44C72.278 16.7467 72.058 17.12 71.898 17.56C71.738 17.9867 71.658 18.4667 71.658 19C71.658 19.5333 71.738 20.02 71.898 20.46C72.058 20.8867 72.278 21.2533 72.558 21.56C72.8513 21.8667 73.198 22.1 73.598 22.26C73.998 22.42 74.4446 22.5 74.938 22.5C75.5646 22.5 76.1246 22.36 76.618 22.08C77.1246 21.7867 77.5846 21.38 77.998 20.86L80.978 23.52C80.2846 24.4133 79.4046 25.1067 78.338 25.6C77.2846 26.08 76.0713 26.32 74.698 26.32ZM88.7655 26.32C87.5921 26.32 86.4588 26.1867 85.3655 25.92C84.2721 25.6533 83.3721 25.3067 82.6655 24.88L84.1855 21.44C84.8521 21.8267 85.5921 22.14 86.4055 22.38C87.2321 22.6067 88.0321 22.72 88.8055 22.72C89.2588 22.72 89.6121 22.6933 89.8655 22.64C90.1321 22.5733 90.3255 22.4867 90.4455 22.38C90.5655 22.26 90.6255 22.12 90.6255 21.96C90.6255 21.7067 90.4855 21.5067 90.2055 21.36C89.9255 21.2133 89.5521 21.0933 89.0855 21C88.6321 20.8933 88.1321 20.7867 87.5855 20.68C87.0388 20.56 86.4855 20.4067 85.9255 20.22C85.3788 20.0333 84.8721 19.7867 84.4055 19.48C83.9521 19.1733 83.5855 18.7733 83.3055 18.28C83.0255 17.7733 82.8855 17.1467 82.8855 16.4C82.8855 15.5333 83.1255 14.7467 83.6055 14.04C84.0988 13.32 84.8255 12.7467 85.7855 12.32C86.7588 11.8933 87.9655 11.68 89.4055 11.68C90.3521 11.68 91.2855 11.78 92.2055 11.98C93.1255 12.18 93.9521 12.4867 94.6855 12.9L93.2655 16.32C92.5721 15.9733 91.8988 15.7133 91.2455 15.54C90.6055 15.3667 89.9788 15.28 89.3655 15.28C88.9121 15.28 88.5521 15.32 88.2855 15.4C88.0188 15.48 87.8255 15.5867 87.7055 15.72C87.5988 15.8533 87.5455 16 87.5455 16.16C87.5455 16.4 87.6855 16.5933 87.9655 16.74C88.2455 16.8733 88.6121 16.9867 89.0655 17.08C89.5321 17.1733 90.0388 17.2733 90.5855 17.38C91.1455 17.4867 91.6988 17.6333 92.2455 17.82C92.7921 18.0067 93.2921 18.2533 93.7455 18.56C94.2121 18.8667 94.5855 19.2667 94.8655 19.76C95.1455 20.2533 95.2855 20.8667 95.2855 21.6C95.2855 22.4533 95.0388 23.24 94.5455 23.96C94.0655 24.6667 93.3455 25.24 92.3855 25.68C91.4255 26.1067 90.2188 26.32 88.7655 26.32ZM105.33 26.32C104.21 26.32 103.17 26.1467 102.21 25.8C101.263 25.44 100.437 24.9333 99.73 24.28C99.0367 23.6267 98.4967 22.8533 98.11 21.96C97.7233 21.0667 97.53 20.08 97.53 19C97.53 17.92 97.7233 16.9333 98.11 16.04C98.4967 15.1467 99.0367 14.3733 99.73 13.72C100.437 13.0667 101.263 12.5667 102.21 12.22C103.17 11.86 104.21 11.68 105.33 11.68C106.703 11.68 107.917 11.92 108.97 12.4C110.037 12.88 110.917 13.5733 111.61 14.48L108.63 17.14C108.217 16.62 107.757 16.22 107.25 15.94C106.757 15.6467 106.197 15.5 105.57 15.5C105.077 15.5 104.63 15.58 104.23 15.74C103.83 15.9 103.483 16.1333 103.19 16.44C102.91 16.7467 102.69 17.12 102.53 17.56C102.37 17.9867 102.29 18.4667 102.29 19C102.29 19.5333 102.37 20.02 102.53 20.46C102.69 20.8867 102.91 21.2533 103.19 21.56C103.483 21.8667 103.83 22.1 104.23 22.26C104.63 22.42 105.077 22.5 105.57 22.5C106.197 22.5 106.757 22.36 107.25 22.08C107.757 21.7867 108.217 21.38 108.63 20.86L111.61 23.52C110.917 24.4133 110.037 25.1067 108.97 25.6C107.917 26.08 106.703 26.32 105.33 26.32ZM112.657 26L118.777 12H123.417L129.537 26H124.657L120.137 14.24H121.977L117.457 26H112.657ZM116.297 23.56L117.497 20.16H123.937L125.137 23.56H116.297ZM131.691 26V12H138.431C139.737 12 140.864 12.2133 141.811 12.64C142.771 13.0667 143.511 13.68 144.031 14.48C144.551 15.2667 144.811 16.2 144.811 17.28C144.811 18.36 144.551 19.2933 144.031 20.08C143.511 20.8667 142.771 21.48 141.811 21.92C140.864 22.3467 139.737 22.56 138.431 22.56H134.311L136.411 20.54V26H131.691ZM136.411 21.06L134.311 18.92H138.131C138.784 18.92 139.264 18.7733 139.571 18.48C139.891 18.1867 140.051 17.7867 140.051 17.28C140.051 16.7733 139.891 16.3733 139.571 16.08C139.264 15.7867 138.784 15.64 138.131 15.64H134.311L136.411 13.5V21.06ZM152.079 17.2H158.319V20.6H152.079V17.2ZM152.399 22.44H159.399V26H147.759V12H159.139V15.56H152.399V22.44Z"
                    fill="white" />
                <rect x="7" y="2" width="30" height="34" stroke="white" stroke-width="4" />
                <circle cx="22" cy="16" r="5" fill="white" />
                <rect x="20" y="19" width="4" height="9" fill="white" />
            </svg>
            <div
                class="copyright d-flex flex-column text-center w-100 gap-1 my-3 py-3 flex-lg-row justify-content-center">
                <p class='m-0 class="text-center"'>Copyright © 2022 ACSCAPE</p>
                <span class="text-center"> |</span>
                <p class='m-0 class="text-center"'>Tous droits reservés</p>
                <span class="text-center">|</span>
                <p class='m-0 legals_mentions class="text-center"'>Mentions légales</p>
            </div>
        </div>
    </footer>
    </div>

    <?php  if (strpos($_SERVER['REQUEST_URI'], 'ingame') == false) : ?>
    <iconify-icon class="toTop" icon="iconoir:fast-top-circle"></iconify-icon>
    <?php endif; ?>

</body>

<script async src="\public\app\app.js"></script>
<?php  if (strpos($_SERVER['REQUEST_URI'], 'ingame') !== false) : ?>
<script src="\public\app\inGame.js"></script>
<script src="https://cdn.jsdelivr.net/npm/party-js@latest/bundle/party.min.js"></script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>

<?php  if (strpos($_SERVER['REQUEST_URI'], 'ingame') == false) : ?>
<script src="\public\app\splide.min.js"></script>
<?php endif; ?>



<!-- <script src='https://cdn.jsdelivr.net/npm/ms-cursor@1.0.1/index.min.js'></script> -->


</html>