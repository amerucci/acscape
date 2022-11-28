<?php $furniture = $params['furniture'];
$title = "Modification du meuble"; ?>

<h1>Modification du meuble</h1>

<form action="/acscape/admin/furniture/edit/<?= $furniture->id ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $furniture->title ?>">
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input type="file" class="form-control-file" id="picture" name="picture">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"
            rows="3"><?= $furniture->description ?></textarea>
    </div>
    <div class="form-group">
        <label for="action">Action</label>
        <input type="text" class="form-control" id="action" name="action" value="<?= $furniture->action ?>">
    </div>

    <div class="form-group">
        <label for="clue">Indice</label>
        <input type="text" class="form-control" id="clue" name="clue" value="<?= $furniture->clue ?>">
        <?php if (!$furniture->clue2): ?>
        <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
        <?php endif; ?>
    </div>
    <?php if ($furniture->clue2) : ?>
    <div class="form-group">
        <label for="clue2">Indice 2</label>
        <input type="text" class="form-control" id="clue2" name="clue2" value="<?= $furniture->clue2 ?>">
        <?php if (!$furniture->clue3): ?>
        <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php if ($furniture->clue3) : ?>
    <div class="form-group">
        <label for="clue3">Indice 3</label>
        <input type="text" class="form-control" id="clue3" name="clue3" value="<?= $furniture->clue3 ?>">
    </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="padlock">Serrure</label>
        <select name="padlock" id="padlock" class="form-control">
            <option value="no" <?= $furniture->padlock == 'no' ? 'selected' : '' ?>>Non</option>
            <option value="yes" <?= $furniture->padlock == 'yes' ? 'selected' : '' ?>>Oui</option>
        </select>
    </div>
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
    <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
    <input type="hidden" name="room_id" value="<?= $_SESSION['room_id'] ?>">

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

<script>
    let i = 1;
    document.getElementById('addClue').addEventListener('click', function () {
        if (i < 3) {
            i++;
            let newClue = document.createElement('textarea');
            newClue.setAttribute('name', 'clue' + i);
            newClue.setAttribute('id', 'clue' + i);
            newClue.setAttribute('class', 'form-control mt-2');
            document.getElementById('clue').parentNode.insertBefore(newClue, document.getElementById(
                'addClue'));
        }
        if (i === 3) {
            document.getElementById('addClue').setAttribute('disabled', 'disabled');
            document.getElementById('addClue').style.cursor = 'not-allowed';
        }
    });
</script>