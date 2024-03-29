<?php $title = "Création du jeu"; ?>
<?php
$rooms = $params['rooms'];
$furnitures = $params['furnitures'];
$objects = $params['objects'];
?>



<div class="container admin_container d-flex justify-content-center align-items-center flex-column gap-5">
    <div class="d-flex justify-content-center align-items-center flex-column w-75">

        <h2>Administration des composants de votre scénario</h2>

        <div class="accordion w-100 my-4" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        En savoir plus
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body d-flex justify-content-center flex-column">
                        <p class="">Ici vous pourrez créer vos salles</p>
                        <p class="m-0">&#x2022; Une fois une salle créée depuis son édition vous aurez accès aux meubles
                            lié à la salle.
                        </p>
                        <p class="m-0">&#x2022; <bold>La première salle sera forcément ouverte</bold>, et sera
                            considérée comme votre salle de départ. </p>
                        <p class="m-0">&#x2022; <bold>Les salles suivantes seront vérouillées</bold>, et vous devrez
                            déterminer un mot, ou un nombre, pour dévérouiller la pièce.</p>
                        <p class="m-0">&#x2022; Les meubles sont des composants qui peuvent être ouverts ou vérouillés
                        </p>
                        <p class="m-0">&#x2022; Si vous choisissez de vérouiller le meuble, vous devrez vous assurez
                            d'avoir laissé.e suffisament d'indices pour le dévérouiller, ou bien par cheminement logique
                            des réponses
                            précédentes</p>
                        <p class="m-0">&#x2022; Une fois dévérouillé votre meuble pourra donner au joueur plusieurs
                            choses, comme
                            un message, un indice pour dévérouiller l'accès à une nouvelle salle etc.</p>
                    </div>
                </div>
            </div>
        </div>

        <h1>Salles</h1>
        <a class="my-2" href="room/create">Créer une salle</a>
        <div class="d-flex justify-content-center align-items-center gap-2 row mb-5">
            <?php foreach ($rooms as $room) : ?>
            <div class="card col-2 mx-2 bgcard card_container ">
                <div class="card-body card_rooms d-flex justify-content-center align-items-center flex-column gap-2">
                    <h5 class="card-title"><?= $room->title ?></h5>
                    <img src="/assets/pictures/rooms/<?= $room->picture ?>" alt="image du script" width="100px"
                        height="100px" id="picturePreview">
                    <p class="card-text"><?= substr($room->description ,  0, 50).'...'; ?></p>
                    <div class="d-flex flex-column align-items-end gap-2 w-100">
                        <a href="room/edit/<?= $room->id ?>" class="btn btn-primary w-100">Editer</a>
                        <form action="room/delete/<?= $room->id ?>" method="post" class="w-100">
                            <input type="hidden" name="id" value="<?= $room->id ?>">
                            <button type="submit" class="btn btn-danger w-100"
                                onclick="deleteRecord()">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php unset($_SESSION['room_id']); ?>