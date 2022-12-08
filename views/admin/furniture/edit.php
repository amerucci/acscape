<?php $furniture = $params['furniture'];
$title = "Modification du meuble"; ?>

<div class="container admin_container">
    <h1 class="text-center">Modification du meuble</h1>

    <div class="d-flex justify-content-center align-items-center flex-column gap-5 w-100">
        <form action="/acscape/admin/furniture/edit/<?= $furniture->id ?>" method="post" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column gap-3 w-50">
            <div class="form-group form_name w-100 d-flex justify-content-center align-items-center flex-column">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="<?= htmlspecialchars($furniture->title) ?>" required>
            </div>
            <div class="form-group form_picture w-100 d-flex justify-content-center align-items-center flex-column">
                <button type="button" class="btn btn-primary" id="addPicture">modifier l'image</button>
                <input type="hidden" name="picture" id="picture" value="<?= $furniture->picture ?>">
                <img src="/acscape/assets/pictures/furnitures/<?= $furniture->picture ?>" alt="image du script"
                    width="100px" height="100px" id="picturePreview">
                <img id="picturePreviewTemp">
            </div>
            <div class="form-group form_desc w-100 d-flex justify-content-center align-items-center flex-column">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="6"
                    required><?=htmlspecialchars($furniture->description) ?></textarea>
            </div>
            <div class="d-flex gap-5">
                <div class="form-group form_action d-flex justify-content-center align-items-center flex-column">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" id="action" name="action"
                        value="<?= htmlspecialchars($furniture->action) ?>">
                </div>
                <div class="form-group form_padlock d-flex justify-content-center align-items-center flex-column">
                    <label for="padlock">Serrure</label>
                    <select name="padlock" id="padlock" class="form-control">
                        <option value="no" <?= $furniture->padlock == 'no' ? 'selected' : '' ?>>Non</option>
                        <option value="yes" <?= $furniture->padlock == 'yes' ? 'selected' : '' ?>>Oui</option>
                    </select>
                    <!-- <a class="dnone padlock_params" href="/acscape/admin/padlock">Paramètre de la serrure</a> -->
                </div>
            </div>

            <div class="dnone padlock_params d-flex justify-content-center align-items-center flex-column w-100 gap-3">
                <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="title">Solution pour le dévérouillage</label>
                    <input type="text" name="unlock_word" id="unlock_word" class="form-control"
                        placeholder="inscrivez ici le mot ou le nombre qui dévérrouillera cette pièce" required
                        value="<?= htmlspecialchars($furniture->unlock_word) ?>">
                </div>
                <div class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="clue">Indice</label>
                    <textarea type="textarea" class="form-control" id="clue"
                        name="clue"><?= htmlspecialchars($furniture->clue) ?></textarea>
                    <?php if (!$furniture->clue2): ?>
                    <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                    <?php endif; ?>
                </div>
                <?php if ($furniture->clue2) : ?>
                <div class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="clue2">Indice 2</label>
                    <textarea type="textarea" class="form-control" id="clue2"
                        name="clue2"><?= htmlspecialchars($furniture->clue2)?></textarea>
                    <?php if (!$furniture->clue3): ?>
                    <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if ($furniture->clue3) : ?>
                <div class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="clue3">Indice 3</label>
                    <textarea type="textarea" class="form-control" id="clue3"
                        name="clue3"><?= htmlspecialchars($furniture->clue3) ?></textarea>
                </div>
                <?php endif; ?>
                <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="title">Récompense du dévérouillage</label>
                    <input type="text" name="reward" id="reward" class="form-control"
                        placeholder="Indiquer ici une aide pour dévérrouiller d'autres pièces ou meubles"
                        value="<?= htmlspecialchars($furniture->reward) ?>" required>
                </div>
            </div>


            <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" id="script_id" value="<?= $_SESSION['script_id'] ?>">
            <input type="hidden" name="room_id" id="room_id" value="<?= $_SESSION['room_id'] ?>">
            <button type="submit" class="btn btn-primary w-100 mb-5">Modifier</button>
        </form>
    </div>



    <!-- <div class="d-flex justify-content-center align-items-center flex-column mb-5">

        <h2 class="mt-5">objet lié à ce meuble</h2>
        <a href="/acscape/admin/objects/create" class="btn btn-primary my-2">Créer un objet</a>
        <div class="d-flex mx-2 justify-content-center align-items-center flex-column gap-2">
            <?php foreach ($params['object'] as $object) : ?>
            <?php if ($furniture->object_id == $object->id) : ?>
            <div class="card" style="width: 12rem;">
                <div class="card-body card_objects d-flex justify-content-center align-items-center flex-column">
                    <img src="/acscape/assets/pictures/objects/<?= $object->picture ?>" class="card-img-top" alt="...">
                    <h5 class="card-title"><?= $object->title ?></h5>
                    <p class="card-text"><?= $object->description ?></p>
                    <div class="d-flex justify-content-center align-items-center flex-column gap-2">
                        <a href="/acscape/admin/objects/edit/<?= $object->id ?>" class="btn btn-primary">Modifier</a>
                        <form action="/acscape/admin/objects/destroy/<?= $object->id ?>" method="post">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div> -->
</div>


<script>
    let i = 1;
    document.getElementById('addClue').addEventListener('click', function () {
        if (i < 3) {
            i++;
            let newClue = document.createElement('textarea');
            newClue.setAttribute('name', 'clue' + i);
            newClue.setAttribute('id', 'clue' + i);
            newClue.setAttribute('placeholder', 'Indice ' + i);
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
                picturePreviewTemp.width = 100;
                picturePreviewTemp.height = 100;
            }
        }

    });

    let padlock = document.getElementById('padlock');
    let padlockParams = document.querySelector('.padlock_params');
    if (padlock.value === 'yes') {
        padlockParams.classList.remove('dnone');
    }

    padlock.addEventListener('change', function () {
        if (padlock.value === 'yes') {
            padlockParams.classList.remove('dnone');
        } else {
            padlockParams.classList.add('dnone');
        }
    });
</script>