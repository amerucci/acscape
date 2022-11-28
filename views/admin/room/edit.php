<?php $room = $params['room'];
$title = "Modifier la salle {$room->title}";
?>

<h1>editer votre salle</h1>

<form action="/acscape/admin/room/edit/<?= $room->id ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="<?= $room->title ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"
            class="form-control"><?= $room->description ?></textarea>
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input type="file" name="picture" id="picture" class="form-control">
    </div>
    <div class="form-group">
        <label for="padlock">Code</label>
        <input type="text" name="padlock" id="padlock" class="form-control" value="<?= $room->padlock ?>">
    </div>
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
    <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
    <button type="submit" class="btn btn-primary">Editer</button>
</form>

<?php var_dump($params['room']->id); ?>
<?php $_SESSION['room_id'] = $params['room']->id; ?>
<?php var_dump($_SESSION); ?>

<a href="/acscape/admin/furniture/create" class="btn btn-primary">Créer un meuble</a>

<!-- afficher furnitures si room_id = $_SESSION room_id -->
<?php foreach ($params['furnitures'] as $furniture) : ?>
<?php if ($furniture->room_id == $_SESSION['room_id']) : ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= $furniture->title ?></h5>
        <p class="card-text"><?= $furniture->description ?></p>
        <a href="/acscape/admin/furniture/edit/<?= $furniture->id ?>" class="btn btn-primary">Editer</a>
        <a href="/acscape/admin/furniture/delete/<?= $furniture->id ?>" class="btn btn-danger">Supprimer</a>
    </div>
</div>
<?php endif; ?>
<?php endforeach; ?>