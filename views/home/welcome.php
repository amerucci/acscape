<?php $title = "ACScape Accueil"; 
$script = $params['script'];
?>

<section class="container-fluid homepageTop d-flex align-items-center">
    <div class="hook container">
        <div class="title d-flex flex-column mb-3">
            <p class="m-0">L'Horloge </p>
            <div class="d-flex">
                <p class="m-0">Tourne</p>
                <div class="d-flex align-items-end little_red_circle">
                    <span>&#x25CF;</span><span>&#x25CF;</span><span>&#x25CF;</span>
                </div>
            </div>
        </div>
        <div class="line_text d-flex align-items-center gap-5">
            <span class="line"></span>
            <a href="/index">
                voir nos escapes games
            </a>
        </div>

    </div>
</section>


<section class="enigmes container d-flex flex-column gap-5 justify-content-evenly my-5" id='first_section'>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <span class="mini_line"></span>
        <h3 class="text-center subtitle">Nos Escape Games</h3>
    </div>

    <div class="first_game d-flex flex-column flex-lg-row justify-content-center my-3">
        <div class="content_game col-lg-4 flex-lg-column d-lg-flex justify-content-evenly">


            <div class="diffuclty my-2" data-difficulty="<?= $script[0]->difficulty ?>">
                <iconify-icon icon="ri:lock-line"></iconify-icon>
                <iconify-icon icon="ri:lock-line"></iconify-icon>
                <iconify-icon icon="ri:lock-line"></iconify-icon>
                <iconify-icon icon="ri:lock-line"></iconify-icon>
                <iconify-icon icon="ri:lock-line"></iconify-icon>
            </div>


            <div class="title_game">
                <h3><?= $script[0]->title ?></h3>
            </div>

            <div class="time_game d-flex gap-2 align-items-center mb-3 mt-2">
                <iconify-icon icon="mdi:clock-time-three-outline" style="color: #717171;"></iconify-icon>
                <p class="m-0 duration_color"><?= $script[0]->duration ?></p>
            </div>

            <div class="description_game">
                <p><?= substr($script[0]->description, 0, 200) . '...'?></p>
            </div>
            <div class="button_game mt-5 pt-3 mb-3">
                <a class='d-flex justify-content-center align-items-center' href="/show/<?= $script[0]->id?>">Jouer</a>
            </div>
        </div>
        <div class="img_game my-auto col-lg-8 row">
            <img src="\assets\pictures\scripts\<?= $script[0]->picture ?>" class="img-fluid" alt="" width="510"
                height="534">
            <a class='d-flex justify-content-center align-items-center' href="/show/<?= $script[0]->id?>">Jouer</a>
        </div>
    </div>

    <div class="second_game d-flex flex-column-reverse flex-lg-row justify-content-center my-3">
        <div class="img_game my-auto col-lg-8 row">
            <img src="\assets\pictures\scripts\<?= $script[1]->picture ?>" class="img-fluid" alt="" width="510"
                height="534">
            <a class='d-flex justify-content-center align-items-center' href="/show/<?= $script[1]->id?>"> </a>
        </div>
        <div class="content_game col-lg-4 flex-lg-column d-lg-flex justify-content-evenly">



            <div class="diffuclty my-2" data-difficulty="<?= $script[1]->difficulty ?>">
                <iconify-icon icon="ri:lock-line"></iconify-icon>
                <iconify-icon icon="ri:lock-line"></iconify-icon>
                <iconify-icon icon="ri:lock-line"></iconify-icon>
                <iconify-icon icon="ri:lock-line"></iconify-icon>
                <iconify-icon icon="ri:lock-line"></iconify-icon>
            </div>


            <div class="title_game">
                <h3><?= $script[1]->title ?></h3>
            </div>

            <div class="time_game d-flex gap-2 align-items-center mb-3 mt-2">
                <iconify-icon icon="mdi:clock-time-three-outline" style="color: #717171;"></iconify-icon>
                <p class="m-0 duration_color"><?= $script[0]->duration ?></p>
            </div>

            <div class="description_game">
                <p><?= substr($script[1]->description, 0, 200) . '...'?></p>
            </div>
            <div class="button_game mt-5 pt-3 mb-3">
                <a class='d-flex justify-content-center align-items-center' href="/show/<?= $script[1]->id?>">Jouer</a>
            </div>
        </div>

    </div>

    <a class="discover_all_game px-3 my-5 d-flex justify-content-center align-items-center mx-auto"
        href="/index">Découvrir Tous Nos Escape Games</a>

</section>

<section class="rules container-fluid p-3">
    <div class="rules_content container">
        <div
            class="rules_home_content d-lg-flex justify-content-evenly align-items-center flex-column gap-4 my-3 py-3 my-lg-5 py-lg-5">

            <div class="d-flex justify-content-center align-items-center flex-column gap-4 mb-5">
                <span class="mini_line"></span>
                <h2 class="title_rules text-center">Comment ça Marche ?</h2>
            </div>

            <div class="circle_rules d-lg-flex justify-content-center align-items-center gap-5">
                <div
                    class="card_rule d-flex justify-content-center align-items-center flex-column mx-auto gap-4 my-lg-0 my-5">
                    <img src="assets/front/icons/circle_padlock.svg" class="img" alt="...">
                    <div class="card-body d-flex  align-items-center flex-column gap-3">
                        <h3 class="title-card my-2">Vous êtes Enfermé</h3>
                        <p class="text-card">Une escape room remplie d'objets utiles et parfois sans intérêt.
                            Saurez-vous trouver les solutions pour vous échapper?</p>
                    </div>
                </div>
                <div
                    class="card_rule d-flex justify-content-center align-items-center flex-column mx-auto gap-4 my-lg-0 my-5">
                    <img src="assets/front/icons/circle_clock.svg" class="img" alt="...">
                    <div class="card-body d-flex  align-items-center flex-column gap-3">
                        <h3 class="title-card my-2">L'horloge Tourne...</h3>
                        <p class="text-card">Pourrez-vous résoude les énigmes qui vous font face en 60 minutes ?</p>
                    </div>
                </div>
                <div
                    class="card_rule d-flex justify-content-center align-items-center flex-column mx-auto my-lg-0 my-5 gap-4">
                    <img src="assets/front/icons/circle_heart.svg" class="img" alt="...">
                    <div class="card-body d-flex align-items-center flex-column gap-3">
                        <h3 class="title-card my-2">Ressentez L'ambiance</h3>
                        <p class="text-card">Des énigmes conçues avec une atmosphère amusante et une attention
                            particulière aux détails.</p>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>

<section class="who_play_container d-flex container-fluid">
    <div class="who_play_content d-flex flex-column flex-lg-row container">
        <div
            class="rotate_who_play_game d-flex justify-content-center align-items-center gap-3 flex-column flex-lg-row my-5 my-lg-0 ">
            <span class="big_line"></span>
            <p>QUI PEUT JOUER ?</p>
        </div>

        <div class="details_who_play d-flex justify-content-center align-items-center flex-column gap-5 me-auto">
            <div class="first_detail d-flex justify-content-center align-items-center gap-5">
                <img src="assets/front/icons/person_group.svg" alt="">
                <p class="m-0">seul ou entre amis</p>
            </div>
            <div class="second_detail d-flex justify-content-center align-items-center gap-5">
                <img class="pe-1" src="assets/front/icons/work_valise.svg" alt="">
                <p class="m-0">avec vos collègues</p>
            </div>
            <div class="third_detail d-flex justify-content-center align-items-center gap-5">
                <img class="ps-1" src="assets/front/icons/gamepad.svg" alt="">
                <p class="m-0">les amateurs de jeux</p>
            </div>
        </div>

    </div>
</section>

<script>
    let firstScroll = true;

    window.addEventListener('scroll', function () {
        if (firstScroll) {
            window.location.hash = '#first_section';
            window.history.replaceState({}, document.title, "/");
            firstScroll = false;
        }
    });

    const difficultyDivs = document.querySelectorAll('.diffuclty');

    for (const difficultyDiv of difficultyDivs) {
        const icons = difficultyDiv.querySelectorAll('iconify-icon');
        const difficulty = difficultyDiv.getAttribute('data-difficulty');
        for (let i = 0; i < difficulty; i++) {
            icons[i].classList.add('red');
        }
        for (let i = difficulty; i < icons.length; i++) {
            icons[i].classList.add('white');
        }
    }
</script>