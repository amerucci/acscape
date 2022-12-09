<?php $_SESSION['test'] = '54'; ?>

<div class="tools d-flex gap-5">
    <div class="the_rooms d-flex justify-content-center align-items-center gap-2" data-toggle="modal"
        data-target="#roomsModal">
        <iconify-icon icon="material-symbols:meeting-room-outline"></iconify-icon>
        <p class="m-0 rooms_modal">les salles</p>
    </div>

    <div class="frisk d-flex justify-content-center align-items-center gap-2" data-toggle=" modal"
        data-target="#friskModal">
        <iconify-icon icon="uil:search-alt"></iconify-icon>
        <p class="m-0 frisk_modal">fouiller</p>
    </div>
</div>

<!-- Modal rooms-->
<div class="modal fade modal-lg" id="roomsModal" tabindex="-1" role="dialog" aria-labelledby="roomsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="roomsModalLabel">Les salles disponibles</h5>



                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                        </iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="m-0 rooms_list  ">
                    <!-- injection en js des salles -->
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal frisk -->
<div class="modal fade modal-lg" id="friskModal" tabindex="-1" role="dialog" aria-labelledby="friskModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="friskModalLabel">Fouiller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                        </iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body">

                <div class="frisk_content_container d-flex justify-content-center align-items-center flex-wrap gap-3">

                    <div class="furnitures d-flex justify-content-center align-items-center flex-column flex-wrap">
                        <img src="assets/front/ingame/furnitures.png" alt="">
                        <div class="frisk_content">
                            <p class="frisk_title m-0">Fouiller</p>
                        </div>
                    </div>
                    <div class="furnitures d-flex justify-content-center align-items-center flex-column flex-wrap"
                        data-toggle="modal" data-target="#furnitureModal">
                        <img src="assets/front/ingame/furnitures.png" alt="">
                        <div class="frisk_content">
                            <p class="frisk_title m-0 furniture_modal w-100 text-center">Ouvrir</p>
                        </div>
                    </div>
                    <div class="furnitures d-flex justify-content-center align-items-center flex-column flex-wrap">
                        <img src="assets/front/ingame/furnitures.png" alt="">
                        <div class="frisk_content">
                            <p class="frisk_title m-0">Fouiller</p>
                        </div>
                    </div>
                    <div class="furnitures d-flex justify-content-center align-items-center flex-column flex-wrap">
                        <img src="assets/front/ingame/furnitures.png" alt="">
                        <div class="frisk_content">
                            <p class="frisk_title m-0">Fouiller</p>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

<!-- Modal inventories -->
<!-- <div class="modal fade modal-lg" id="inventoriesModal" tabindex="-1" role="dialog"
    aria-labelledby="inventoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="inventoriesModalLabel">Votre inventaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                        </iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div> -->


<!-- Modal furniture -->
<div class="modal fade modal-lg" id="furnitureModal" tabindex="-1" role="dialog" aria-labelledby="furnitureModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="furnitureModalLabel">Téléphone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                        </iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <p class="m-0 furniture_desc">Ce téléphone est étrange, mais j'ai du mal à voir ce que c'est, peut-être
                    devrais-je essayer
                    d'appuyer sur cette touche.
                </p>

                <p class="furniture_desc_action my-5">Appuyer</p>

            </div>
        </div>
    </div>
</div>
</div>


<div class="endgame_win d-flex justify-content-center align-items-center my-auto dnone">
    <div class="endgame_content d-flex justify-content-center align-items-center flex-column">
        <h1 class="endgame_title my-3">Vous avez gagné !</h1>
        <p class="endgame_text my-3">Vous êtes venu à bout de cet Escape Game</p>
        <div class="endgame_buttons d-flex justify-content-center align-items-center gap-5 my-3">
            <a href="" class="endgame_button endgame_button-quit">Liste des jeux</a>
        </div>
    </div>
</div>

<div class="endgame_lose d-flex justify-content-center align-items-center dnone">
    <div class="endgame_content d-flex justify-content-center align-items-center flex-column">
        <h1 class="endgame_title my-3">Temps écoulé</h1>
        <p class="endgame_text my-3">Malheureusement, vous n'avez pas réussi à sortir à temps. Vous pouvez choisir
            d'arrêter
            la partie ici ou continuer.</p>
        <div class="endgame_buttons d-flex justify-content-center align-items-center gap-5 my-3">
            <a href="" class="endgame_button endgame_button-continue">Continuer</a>
            <a href="" class="endgame_button endgame_button-quit">Abandonner</a>
        </div>
    </div>
</div>

<script src="public\app\inGame.js"></script>