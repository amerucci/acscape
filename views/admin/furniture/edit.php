<?php $furniture = $params['furniture'];
$title = "Modification du meuble"; ?>

<h1>Modification du meuble</h1>

<form action="/acscape/admin/furniture/edit/<?= $furniture->id ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $furniture->title ?>">
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary" id="addPicture">modifier l'image</button>
        <input type="hidden" name="picture" id="picture" value="<?= $furniture->picture ?>">
        <img src="/acscape/assets/pictures/furnitures/<?= $furniture->picture ?>" alt="image du script" width="100px"
            height="100px" id="picturePreview">
        <img id="picturePreviewTemp">
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

    <div class="form-group">
        <label for="object">Objet</label>
        <select name="object_id" id="object" class="form-control">
            <option value="0">Aucun</option>
            <?php foreach ($params['object'] as $object) : ?>
            <?php if ($object->user_id == $_SESSION['user_id'] && $object->script_id == $_SESSION['script_id']) : ?>
            <option value="<?= $object->id ?>" <?= $furniture->object_id == $object->id ? 'selected' : '' ?>>
                <?= $object->title ?></option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
    <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
    <input type="hidden" name="room_id" value="<?= $_SESSION['room_id'] ?>">

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>




<h2 class="mt-5">objet lié à ce meuble</h2>
<div class="d-flex mx-2">
    <?php foreach ($params['object'] as $object) : ?>
    <?php if ($furniture->object_id == $object->id) : ?>
    <div class="card" style="width: 18rem;">
        <img src="/acscape/assets/pictures/objects/<?= $object->picture ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $object->title ?></h5>
            <p class="card-text"><?= $object->description ?></p>
            <a href="/acscape/admin/objects/edit/<?= $object->id ?>" class="btn btn-primary">Modifier</a>
            <form action="/acscape/admin/objects/destroy/<?= $object->id ?>" method="post">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
</div>





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

    let addPicture = document.getElementById('addPicture');
    let picture = document.getElementById('picture');
    let j = 0;
    addPicture.addEventListener('click', function () {
        let input = document.createElement('input');
        input.type = 'file';
        input.name = 'picture';
        input.id = 'picture';
        input.classList.add('form-control');
        input.classList.add('mt-3');
        input.required = true;
        picture.replaceWith(input);
        picture = input;
        j++;
        if (j > 1) {
            addPicture.style.disabled = true;
        }

        picture.onchange = evt => {
            const [file] = picture.files
            if (file) {
                let picturePreview = document.getElementById('picturePreview');
                picturePreview.remove();
                picturePreviewTemp.src = URL.createObjectURL(file)
            }
        }

    });
</script>