<?php $title = "jeu"; 
$script = $params["script"];
$games = $params["scriptAll"];
$_SESSION['scriptId'] = $script->id;
?>

<div class="show_container d-flex align-items-center flex-column">
    <div class="show_img_top d-flex align-items-center flex-column justify-content-center">
        <!-- <h3><?= $script->title ?></h3> -->
    </div>



    <div class="content_one_game d-flex justify-content-center align-items-center my-5 py-5">
        <div id="description" class='d-flex align-items-center justify-content-center flex-column flex-md-row'>
            <div class="description_one_game">
                <h3 class="my-3 py-3 light show_title"><?= $script->title ?></h3>
                <p><?= $script->description ?></p>
            </div>
            <div
                class="caracteristique_one_game d-flex align-items-center flex-md-column flex-row-reverse flex-wrap justify-content-center gap-5">
                <div class="diffuclty difficulty_one_game" data-difficulty="<?= $script->difficulty ?>">
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                    <p class="m-0">difficulté</p>
                </div>
                <div class="duration_one_game">
                    <p class="m-0"><?= $script->duration?></p>
                    <p class="m-0">MINUTES</p>
                </div>
                <div class="play_now button_game ">
                    <a class="d-flex justify-content-center align-items-center" href="/ingame">JOUER MAINTENANT</a>
                </div>
            </div>
        </div>
    </div>
    <div class="other_games my-5 container">
        <h3 class="my-5">Nos autres escape games</h3>
        <section class="splide mx-auto slide_game_index" aria-label="slide_game">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php foreach ($games as $game) : ?>
                    <?php if ($game->id != $_SESSION['scriptId']) : ?>
                    <li class="game splide__slide">
                        <!-- <img src="/assets/pictures/scripts/<?= $game->picture ?>" alt="">
                        <div class="card_game_content">
                            <div class="title_game">
                                <p class="m-0"><?= $game->title?></p>
                            </div>
                            <div class="parameters_game d-flex  align-items-center">
                                <div class="diffuclty difficulty_one_game" data-difficulty="<?= $game->difficulty ?>">
                                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                                    <iconify-icon icon="ri:lock-line"></iconify-icon>
                                </div>
                                <div class="time_game d-flex justify-content-center align-items-center gap-3">
                                    <img src="/assets/front/icons/clock.svg" alt="">
                                    <p class="m-0">60</p>
                                </div>
                            </div>
                            <a class="link_game" href="/show/<?= $game->id ?>"></a>
                        </div> -->
                        <img src="/assets/pictures/scripts/<?= $game->picture ?>" alt="">
                        <span class="filter"></span>
                        <div class="card_game_content d-flex">
                            <div class="d-flex align-items-end h-100 justify-content-between p7">
                                <div class="d-flex flex-column ">
                                    <div class="title_game_index">
                                        <p class="m-0"><?= $game->title ?></p>
                                    </div>
                                    <div class="diffuclty" data-difficulty="<?= $game->difficulty ?>">
                                        <iconify-icon data-id="<?= $game->id ?>" icon="ri:lock-line"></iconify-icon>
                                        <iconify-icon data-id="<?= $game->id ?>" icon="ri:lock-line"></iconify-icon>
                                        <iconify-icon data-id="<?= $game->id ?>" icon="ri:lock-line"></iconify-icon>
                                        <iconify-icon data-id="<?= $game->id ?>" icon="ri:lock-line"></iconify-icon>
                                        <iconify-icon data-id="<?= $game->id ?>" icon="ri:lock-line"></iconify-icon>
                                    </div>
                                </div>
                                <div class="time_game d-flex justify-content-center align-items-center gap-3">
                                    <iconify-icon icon="mdi:clock-time-three-outline" style="color: #717171;">
                                    </iconify-icon>
                                    <p class="m-0 duration_color"><?= $game->duration?></p>
                                </div>
                            </div>
                            <a class="link_game" href="/show/<?= $game->id ?>"></a>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    </div>



</div>
<?= "<div class='dnone background_script_show'>$script->picture</div>"; ?>

<script>
    const background = document.querySelector('.background_script_show').innerText;
    document.querySelector('.show_img_top').style.backgroundImage =
        `linear-gradient(180deg, rgba(27, 27, 27, 0) 0%, #1B1B1B 100%),url(/assets/pictures/scripts/${background})`;


    document.addEventListener('DOMContentLoaded', function () {
        var splide = new Splide('.splide', {
            type: "loop",
            perPage: 1,
            gap: "1rem",
        });
        splide.mount();
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