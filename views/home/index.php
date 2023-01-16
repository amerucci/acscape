<?php $title = "Liste des jeux"; 
$scripts = $params['script'];
?>
<div class="all_games_container d-flex d-flex justify-content-center align-items-center flex-column">

    <div class="index_top d-flex d-flex justify-content-center align-items-center container-fluid">
        <h1 class="m-0">nos escapes games<span>&#x25CF;</span></h1>
    </div>


    <div class="all_games w-100" id="all_games">
        <h3 class="text-center subtitle mb-5 pb-2">Tous nos jeux</h3>

        <div class="d-flex justify-content-center align-items-center gap-5 flex-wrap">

            <?php foreach ($scripts as $game) : ?>
            <div class="game col-10 col-md-3">
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
                            <iconify-icon icon="mdi:clock-time-three-outline" style="color: #717171;"></iconify-icon>
                            <p class="m-0 duration_color"><?= $game->duration?></p>
                        </div>
                    </div>
                    <a class="link_game" href="/show/<?= $game->id ?>"></a>
                </div>
            </div>
            <?php endforeach; ?>



        </div>

        <!-- <div class="pagination d-flex justify-content-center align-items-center my-5">
            <p> pagination </p>
        </div> -->

    </div>

    <script>
        let firstScroll = true;

        window.addEventListener('scroll', function () {
            if (firstScroll) {
                window.location.hash = '#all_games';
                window.history.replaceState({}, document.title, "/" + "index");
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