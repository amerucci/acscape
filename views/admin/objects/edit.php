<?php $object = $params['object'];
$title = "Modifier l'objet {$object->title}";
?>

<h1>editer votre objet</h1>

<form action="/acscape/admin/objects/edit/<?= $object->id ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="<?= $object->title ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"
            class="form-control"><?= $object->description ?></textarea>
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input type="file" name="picture" id="picture" class="form-control">
    </div>
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
    <button type="submit" class="btn btn-primary">Editer</button>
</form>