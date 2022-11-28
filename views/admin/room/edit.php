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