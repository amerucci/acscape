<?php $title = "jeu"; ?>
<div class="show_container d-flex align-items-center flex-column">
    <div class="show_img_top d-flex align-items-center flex-column justify-content-center">
        <h3>Le développeur perdu</h3>
    </div>

    <div class="content_one_game container" id="description">
        <div class='d-flex align-items-center justify-content-center flex-column flex-md-row'>
            <div class="description_one_game">
                <h3 class="my-3 py-3 light">Le développeur perdu</h3>
                <p> C'est l'histoire d'un étudiant en programmation qui se retrouve perdu dans un labyrinthe de code. Il
                    doit trouver la sortie pour pouvoir sortir de ce labyrinthe et pouvoir finir son projet. Mais
                    attention,
                    il ne doit pas se perdre dans le labyrinthe et ne pas oublier de faire des sauvegardes de son code.
                    Si
                    jamais il ne respecte pas cette règle fondamentale, il sera perdu à tout jamais dans le labyrinthe
                    de
                    code.</p>
                <p>Aider le à sortir de ce labyrinthe de code et à finir son projet.</p>
                <p>Bonne chance !</p>
            </div>
            <div
                class="caracteristique_one_game d-flex align-items-center flex-md-column flex-row-reverse flex-wrap justify-content-center gap-5">
                <div class="difficulty_one_game">
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <p class="m-0">difficulté</p>
                </div>
                <div class="duration_one_game">
                    <p class="m-0">60</p>
                    <p class="m-0">MINUTES</p>
                </div>
                <div class="play_now">
                    <a href="/acscape/ingame">JOUER MAINTENANT</a>
                </div>
            </div>
        </div>
    </div>

    <div class="other_games my-5 container">
        <h3 class="my-5 text-center">Nos autres escape games</h3>




        <section class="splide mx-auto slide_game_index" aria-label="slide_game">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="game splide__slide">
                        <img src="assets\front\index\figure.jpg" alt="">
                        <div class="card_game_content">
                            <div class="title_game">
                                <p class="m-0">Le Développeur Perdu</p>
                            </div>
                            <div class="parameters_game d-flex  align-items-center">
                                <div class="diffuclty">
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                </div>
                                <div class="time_game d-flex justify-content-center align-items-center gap-3">
                                    <img src="assets/front/icons/clock.svg" alt="">
                                    <p class="m-0">60</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="game splide__slide">
                        <img src="assets\front\index\figure-1.jpg" alt="">
                        <div class="card_game_content">
                            <div class="title_game">
                                <p class="m-0">Le Développeur Perdu</p>
                            </div>
                            <div class="parameters_game d-flex  align-items-center">
                                <div class="diffuclty">
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                </div>
                                <div class="time_game d-flex justify-content-center align-items-center gap-3">
                                    <img src="assets/front/icons/clock.svg" alt="">
                                    <p class="m-0">60</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="game splide__slide">
                        <img src="assets\front\index\figure-2.jpg" alt="">
                        <div class="card_game_content">
                            <div class="title_game">
                                <p class="m-0">Le Développeur Perdu</p>
                            </div>
                            <div class="parameters_game d-flex  align-items-center">
                                <div class="diffuclty">
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                    <iconify-icon icon="uil:padlock"></iconify-icon>
                                </div>
                                <div class="time_game d-flex justify-content-center align-items-center gap-3">
                                    <img src="assets/front/icons/clock.svg" alt="">
                                    <p class="m-0">60</p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

    </div>


</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var splide = new Splide('.splide', {
            type: "loop",
            perPage: 1,
            gap: "1rem",
        });
        splide.mount();
    });

    let firstScroll = true;

    window.addEventListener('scroll', function () {
        if (firstScroll) {
            window.location.hash = '#description';
            window.history.replaceState({}, document.title, "/" + "acscape/show");
            firstScroll = false;
        }
    });
</script>