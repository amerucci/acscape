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
        <label for="padlock">Serrure</label>
        <select name="padlock" id="padlock" class="form-control">
            <option value="no" <?= $room->padlock == 'no' ? 'selected' : '' ?>>Non</option>
            <option value="yes" <?= $room->padlock == 'yes' ? 'selected' : '' ?>>Oui</option>
        </select>
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
        <button type="submit" class="btn btn-primary my-1">Editer</button>
</form>

<?php $_SESSION['room_id'] = $params['room']->id; ?>


<p>---------------------------</p>

<div>
    <a href="/acscape/admin/furniture/create" class="btn btn-primary my-2">Ajouter un meuble</a>
    <div class="d-flex">
        <?php foreach ($params['furnitures'] as $furniture) : ?>
        <?php if ($furniture->room_id == $_SESSION['room_id']) : ?>
        <div class="card mx-2">
            <div class="card-body">
                <h5 class="card-title"><?= $furniture->title ?></h5>
                <p class="card-text"><?= $furniture->description ?></p>
                <a href="/acscape/admin/furniture/edit/<?= $furniture->id ?>" class="btn btn-primary">Editer</a>
                <!--form for destroy -->
                <form action="/acscape/admin/furniture/delete/<?= $furniture->id ?>" method="post">
                    <input type="hidden" name="id" value="<?= $furniture->id ?>">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>