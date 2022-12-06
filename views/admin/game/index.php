<?php $title = "Création du jeu"; ?>
<?php
$rooms = $params['rooms'];
$furnitures = $params['furnitures'];
$objects = $params['objects'];
?>


<div class="container admin_container d-flex justify-content-center align-items-center flex-column gap-5">
    <div class="d-flex justify-content-center align-items-center flex-column    ">

        <h1>Pièce</h1>
        <a href="room/create">Créer une salle</a>
        <div class="d-flex justify-content-center align-items-center gap-2 ">
            <?php foreach ($rooms as $room) : ?>
            <div class="card col-2 mx-2">
                <div class="card-body card_rooms d-flex justify-content-center align-items-center flex-column gap-2">
                    <h5 class="card-title"><?= $room->title ?></h5>
                    <img src="/acscape/assets/pictures/rooms/<?= $room->picture ?>" alt="image du script" width="100px"
                        height="100px" id="picturePreview">
                    <p class="card-text"><?= $room->description ?></p>
                    <a href="room/edit/<?= $room->id ?>" class="btn btn-primary">Editer</a>
                    <a href="room/delete/<?= $room->id ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center flex-column">
        <h1 class="my-3">Objets</h1>
        <a href="objects/create">Créer un objet</a>
        <div class="d-flex align-items-center gap-2">
            <?php foreach ($objects as $object) : ?>
            <div class="card col-2 mx-2">
                <div class="card-body card_objects d-flex justify-content-center align-items-center flex-column gap-2">
                    <h5 class="card-title"><?= $object->title ?></h5>
                    <img src="/acscape/assets/pictures/objects/<?= $object->picture ?>" alt="image" width="100px"
                        height="100px" id="picturePreview">
                    <p class="card-text"><?= $object->description ?></p>
                    <a href="objects/edit/<?= $object->id ?>" class="btn btn-primary">Editer</a>
                    <form action="objects/delete/<?= $object->id ?>" method="post">
                        <input type="hidden" name="id" value="<?= $object->id ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php unset($_SESSION['room_id']); ?>

<?php var_dump($_SESSION); ?>