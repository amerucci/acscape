<?php $title = "ACScape"; 
$gameTitle = $params["script"][0]->title;
?>

<?php if(!$_SESSION["scriptId"]): ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <h1 class="text-center">Vous n'avez pas accès à cette page</h1>
                <a href="/scripts" class="btn btn-primary">Retour aux scénarios</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>




<div id='loader' class="loadingspinner d-flex flex-column justify-content-center align-items-center">
    <div class="container_square">
        <div id="square1"></div>
        <div id="square2"></div>
        <div id="square3"></div>
        <div id="square4"></div>
        <div id="square5"></div>
    </div>
    <h2>Chargement du jeu</h2>
</div>

<div class="tools d-flex gap-1 flex-column">
    <div class="d-flex gap-3">
        <div class="the_rooms d-flex justify-content-center align-items-center gap-2" data-toggle="modal"
            data-target="#roomsModal">
            <iconify-icon icon="material-symbols:meeting-room-outline"></iconify-icon>
            <p class="m-0 rooms_modal">les salles</p>
        </div>
        <div class="frisk d-flex justify-content-center align-items-center gap-2 frisk_btn" data-toggle=" modal"
            data-target="#friskModal">
            <iconify-icon icon="uil:search-alt"></iconify-icon>
            <p class="m-0 frisk_modal">fouiller</p>
        </div>
    </div>
</div>

<!-- sticky it -->

<!-- <div class="toolbox d-flex flex-column justify-content-center align-items-center">
    <button class="button_toolBox" id="toolBox_btn">Boîte à outils</button>
    <div id="espaceVoid" class="espace"></div>
    <div class="dnone d-flex justify-content-center align-items-center gap-2 flex-column" id="toolbox_content">
        <div class="sticky-form">
            <div>
                <label for="stickytitle" class="dnone">Titre de votre Post-it</label>
                <input type="text" name="stickytitle" id="stickytitle" class="dnone" />
                <label for="stickytext" class="dnone">Ecrire quelque chose</label>
                <textarea name="stickytext" id="stickytext" cols="24" rows="10" class="dnone"></textarea>
            </div>

            <button class="button" id="createstickyOpac">Post it !</button>
        </div>
        <div class="sticky-draw dnone">
            <button class="button m-0 p-0" id="createDraw">Dessin</button>
        </div>
        <div class="wiki d-flex justify-content-center align-items-center gap-2">
            <iconify-icon icon="uil:search-alt"></iconify-icon>
            <p class="m-0 frisk_modal">Wiki</p>
        </div>
    </div>
</div> -->





<!-- Modal rooms-->
<div class="modal fade modal-lg" id="roomsModal" tabindex="-1" role="dialog" aria-labelledby="roomsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" data-bs-backdrop="true">
            <div class="modal-header">
                <div class="modal-title mx-auto d-flex justify-content-center align-items-center gap-2"
                    id="roomsModalLabel">
                    <iconify-icon icon="material-symbols:meeting-room-outline"></iconify-icon>
                    <p class="m-0 rooms_modal">les salles</p>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                        </iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="m-0 rooms_list d-flex justify-content-center align-items-center flex-wrap ">
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
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                        </iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 furniture_list"></div>
            </div>
        </div>
    </div>
</div>

<div class="endgame_win d-flex justify-content-center align-items-center my-auto dnone">
    <div class="endgame_content d-flex justify-content-center align-items-center flex-column">
        <button class="buttonConfetti" onclick="party.confetti(this)"></button>
        <h1 class="endgame_title my-3">Vous avez gagné !</h1>
        <p class="endgame_text my-3">Vous êtes venu à bout de cet Escape Game</p>
        <div class="endgame_buttons d-flex justify-content-center align-items-center gap-5 my-3">
            <a href="/index" class="endgame_button endgame_button-quit">Liste des jeux</a>
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

<div class="sticky-form">
    <div>
        <label for="stickytitle" class="dnone">Titre de votre Post-it</label>
        <input type="text" name="stickytitle" id="stickytitle" class="dnone" />
        <label for="stickytext" class="dnone">Ecrire quelque chose</label>
        <textarea name="stickytext" id="stickytext" cols="24" rows="10" class="dnone"></textarea>
    </div>

    <button class="button" id="createstickyOpac">Post it !</button>
</div>

<div id="stickies-container"></div>