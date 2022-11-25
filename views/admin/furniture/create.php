<?php $title = "Creation d'un meuble"; ?>

<h1>Création d'un meuble</h1>

<form action="create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input type="file" name="picture" id="picture" class="form-control">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="action">Action</label>
        <textarea name="action" id="action" class="form-control"></textarea>
    </div>
    <!-- clue is a json -->
    <div class="form-group">
        <label for="clue">Indice</label>
        <textarea name="clue" id="clue" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="padlock">Verrouillé</label>
        <select name="padlock" id="padlock" class="form-control">
            <option value="yes">Oui</option>
            <option value="no">Non</option>
        </select>
    </div>
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
    <button type="submit" class="btn btn-primary">Créer</button>

</form>