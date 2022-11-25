<?php
$title = "modifier le scénario " . $params['script']->title;
 $script = $params['script'] ?>

<h1>Modifier un script</h1>

<form action=<?= $script->id,'upload' ?> method="POST" enctype="multipart/form-data">


    <div class="form-group">
        <label for="name">Nom du scénario</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $script->title ?>" required>
    </div>
    <div class="form-group">
        <label for="difficulty">Difficulté</label>
        <select class="form-control" name="difficulty" id="difficulty">
            <option value="1" <?= $script->difficulty == 1 ? 'selected' : '' ?>>Très Facile</option>
            <option value="2" <?= $script->difficulty == 2 ? 'selected' : '' ?>>Facile</option>
            <option value="3" <?= $script->difficulty == 3 ? 'selected' : '' ?>>Moyen</option>
            <option value="4" <?= $script->difficulty == 4 ? 'selected' : '' ?>>Difficile</option>
            <option value="5" <?= $script->difficulty == 5 ? 'selected' : '' ?>>Très Difficile</option>
        </select>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"
                required><?= $script->description ?></textarea>
        </div>
        <div class="form-group
            <label for=" content">Message de victoire</label>
            <textarea class="form-control" name="winner_msg" id="content" rows="3"
                required><?= $script->winner_msg ?></textarea>
        </div>
        <div class="form-group">
            <label for="content">Message de défaite</label>
            <textarea class="form-control" name="lost_msg" id="content" rows="3"
                required><?= $script->lost_msg ?></textarea>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="file" class="form-control-file" name="picture" id="picture">
        </div>
        <div class="form-group">
            <label for="duration">Durée</label>
            <input type="time" class="form-control" name="duration" id="duration" min="00:10" max="01:00"
                value="<?= $script->duration ?>">
        </div>
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <input type="hidden" name="id" value="<?= $script->id ?>">
        <button type="submit" class="btn btn-primary">Modifier</button>
</form>