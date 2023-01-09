<?php
$title = "modifier le scénario " . $params['script']->title;
 $script = $params['script'] ?>

<?php if ((int)$params['script']->user_id != $_SESSION['user_id']) {
return header('Location: /login?error=session_expired');
} ?>

<div class="container admin_container my-5">
    <div class="d-flex justify-content-center align-items-center gap-2 flex-column">
        <a href='/admin/game' class='btn btn-primary create_game_script my-3'>création du jeu</a>
        <h1 class="modif_script">Modifier le scénario</h1>
    </div>

    <div class="d-flex justify-content-center align-items-center gap-1 flex-column my-4">
        <form action=<?= $script->id,'upload' ?> method="POST" enctype="multipart/form-data" runat="server"
            class="w-75">
            <div class="form-group d-flex justify-content-center align-items-center flex-column gap-1 form_name">
                <label for="name">Nom du scénario</label>
                <input type="text" class="form-control" name="title" id="title"
                    value="<?= htmlspecialchars($script->title) ?>" required>
            </div>
            <div class="edit_plus dnone">
                <div
                    class="form-group d-flex justify-content-center align-items-center flex-column gap-1 w-100 my-3 form_desc">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="6"
                        required><?= htmlspecialchars($script->description) ?></textarea>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-5 my-5">
                    <div class="form-group d-flex justify-content-center align-items-center flex-column gap-1 form_win">
                        <label for=" content">Message de victoire</label>
                        <textarea class="form-control" name="winner_msg" id="content" rows="3"
                            required><?= htmlspecialchars($script->winner_msg) ?></textarea>
                    </div>
                    <div
                        class="form-group d-flex justify-content-center align-items-center flex-column gap-1 form_lose">
                        <label for="content">Message de défaite</label>
                        <textarea class="form-control" name="lost_msg" id="content" rows="3"
                            required><?= htmlspecialchars($script->lost_msg) ?></textarea>
                    </div>
                </div>
                <div
                    class="form-group d-flex justify-content-center align-items-center flex-column gap-1 my-5 form_picture w-100">
                    <button type="button" class="btn btn-primary" id="addPicture">modifier l'image</button>
                    <input type="hidden" name="picture" id="picture" value="<?= $script->picture ?>">
                    <img src="/assets/pictures/scripts/<?= $script->picture ?>" alt="image du script" width="100px"
                        height="100px" id="picturePreview">
                    <img id="picturePreviewTemp">
                </div>
                <div class="d-flex gap-5">
                    <div
                        class="form-group d-flex justify-content-center align-items-center flex-column gap-1 w-50 form_difficulty">
                        <label class="d-flex justify-content-center align-items-center gap-1"
                            for="difficulty">Difficulté
                            <iconify-icon icon="ri:lock-line"></iconify-icon> </label>
                        <select class="form-control" name="difficulty" id="difficulty">
                            <option value="1" <?= $script->difficulty == 1 ? 'selected' : '' ?>>Très Facile</option>
                            <option value="2" <?= $script->difficulty == 2 ? 'selected' : '' ?>>Facile</option>
                            <option value="3" <?= $script->difficulty == 3 ? 'selected' : '' ?>>Moyen</option>
                            <option value="4" <?= $script->difficulty == 4 ? 'selected' : '' ?>>Difficile</option>
                            <option value="5" <?= $script->difficulty == 5 ? 'selected' : '' ?>>Très Difficile</option>
                        </select>
                    </div>
                    <div
                        class="form-group form_duration d-flex justify-content-center align-items-center flex-column gap-2">
                        <label class="d-flex justify-content-center align-items-center gap-1" for="duration">Durée en
                            minutes <iconify-icon icon="mdi:clock-time-three-outline" style="color: #717171;">
                            </iconify-icon></label>
                        <input type="number" class="form-control" name="duration" id="duration" min="10" max="60"
                            value="<?= $script->duration ?>">
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="id" value="<?= $script->id ?>">
            <p class="btn btn-primary w-100 editPlus">Editer les autres paramètres du scénario</p>
            <button type="submit" class="btn btn-primary my-4 w-100">Modifier</button>
        </form>
    </div>
</div>
<?php $_SESSION['script_id'] = $script->id ?>


<script>
    let addPicture = document.getElementById('addPicture');
    let picture = document.getElementById('picture');
    let i = 0;
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
        i++;
        if (i > 1) {
            addPicture.style.disabled = true;
        }

        picture.onchange = evt => {
            // Récupérez le fichier sélectionné
            const [file] = picture.files;
            if (file) {
                // Récupérez l'élément img existant, ou créez-en un nouveau s'il n'existe pas
                let img = document.getElementById('picturePreview');
                if (!img) {
                    img = document.createElement('img');
                    img.id = 'picturePreview';
                }
                // Configurez l'attribut src de l'élément img avec l'URL de l'objet File
                img.src = URL.createObjectURL(file);
                // Configurez l'attribut width et height de l'élément img
                img.width = 100;
                img.height = 100;
                // Récupérez l'élément parent de la miniature
                const parent = img.parentNode;
                // Ajoutez l'élément img à l'élément parent, ou remplacez-le s'il existe déjà
                if (!parent) {
                    parent.appendChild(img);
                } else {
                    parent.replaceChild(img, img);
                }
            }
        }



    });



    const edit_plus = document.querySelector('.edit_plus');
    const editPlus = document.querySelector('.editPlus');

    editPlus.addEventListener('click', function () {
        edit_plus.classList.remove('dnone');
        editPlus.classList.add('dnone');
    });
</script>

<!-- https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded -->