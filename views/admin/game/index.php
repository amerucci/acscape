<?php $title = "Création du jeu"; ?>
<?php
$rooms = $params['rooms'];
$furnitures = $params['furnitures'];
$objects = $params['objects'];
?>



<h1>Pièce</h1>
<a href="room/create">Créer une salle</a>
<div class="d-flex">
    <?php foreach ($rooms as $room) : ?>
    <div class="card col-2 mx-2">
        <div class="card-body">
            <h5 class="card-title"><?= $room->title ?></h5>
            <p class="card-text"><?= $room->description ?></p>
            <a href="room/edit/<?= $room->id ?>" class="btn btn-primary">Editer</a>
            <a href="room/delete/<?= $room->id ?>" class="btn btn-danger">Supprimer</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<h1>Objets</h1>
<a href="objects/create">Créer un objet</a>
<div class="d-flex">
    <?php foreach ($objects as $object) : ?>
    <div class="card col-2 mx-2">
        <div class="card-body">
            <h5 class="card-title
                "><?= $object->title ?></h5>
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

<?php unset($_SESSION['room_id']); ?>

<?php var_dump($_SESSION); ?>