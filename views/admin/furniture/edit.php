<?php $furniture = $params['furniture'];
$title = "Modification du meuble"; ?>
<?php if ($_SESSION['user_id'] != (int) $params['furniture']->user_id) {
return header('Location: /login?error=session_expired');
} ?>

<div class="container admin_container">
    <h1 class="text-center">Modification du meuble</h1>

    <div class="d-flex justify-content-center align-items-center flex-column gap-5 w-100">
        <form action="/admin/furniture/edit/<?= $furniture->id ?>" method="post" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column gap-3 w-50">
            <div class="form-group form_name w-100 d-flex justify-content-center align-items-center flex-column">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="<?= htmlspecialchars($furniture->title) ?>" required>
            </div>
            <div class="form-group form_picture w-100 d-flex justify-content-center align-items-center flex-column">
                <button type="button" class="btn btn-primary" id="addPicture">modifier l'image</button>
                <input type="hidden" name="picture" id="picture" value="<?= $furniture->picture ?>">
                <img src="/assets/pictures/furnitures/<?= $furniture->picture ?>" alt="image du script" width="100px"
                    height="100px" id="picturePreview">
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
                        placeholder="inscrivez ici le mot ou le nombre qui dévérrouillera cette pièce"
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
                    <textarea type="text" name="reward" id="reward" class="form-control" rows="5"
                        placeholder="Indiquer ici une aide pour dévérrouiller d'autres pièces ou meubles"><?= htmlspecialchars($furniture->reward) ?></textarea>
                </div>
            </div>


            <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" id="script_id" value="<?= $_SESSION['script_id'] ?>">
            <input type="hidden" name="room_id" id="room_id" value="<?= $_SESSION['room_id'] ?>">
            <button type="submit" class="btn btn-primary w-100 mb-5">Modifier</button>
        </form>
    </div>

</div>


<script>
    let c = 1;
    if (document.getElementById('addClue') != null) {
        document.getElementById('addClue').addEventListener('click', function () {
            if (c < 3) {
                c++;
                let newClue = document.createElement('textarea');
                newClue.setAttribute('name', 'clue' + c);
                newClue.setAttribute('id', 'clue' + c);
                newClue.setAttribute('placeholder', 'Indice ' + c);
                newClue.setAttribute('class', 'form-control mt-2');
                document.getElementById('clue').parentNode.insertBefore(newClue, document
                    .getElementById(
                        'addClue'));
            }
            if (c === 3) {
                document.getElementById('addClue').setAttribute('disabled', 'disabled');
                document.getElementById('addClue').style.cursor = 'not-allowed';
            }
        });
    }

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

    document.addEventListener('DOMContentLoaded', () => {
        const description = document.getElementById('description');
        const reward = document.getElementById('reward');
        const clue = document.getElementById('clue');
        const unlock_word = document.getElementById('unlock_word');
    });

    function padlock() {

        let padlock = document.getElementById('padlock');
        let padlockParams = document.querySelector('.padlock_params');
        if (padlock.value === 'yes') {
            padlockParams.classList.remove('dnone');
            reward.setAttribute('required', 'required');
            clue.setAttribute('required', 'required');
            unlock_word.setAttribute('required', 'required');
        } else {
            reward.value = description.value
        }

        padlock.addEventListener('change', function () {
            if (padlock.value === 'yes') {
                padlockParams.classList.remove('dnone');
                reward.value = '';
                reward.setAttribute('required', 'required');
                clue.setAttribute('required', 'required');
                unlock_word.setAttribute('required', 'required');
            } else {
                padlockParams.classList.add('dnone');
                reward.removeAttribute('required');
                clue.removeAttribute('required');
                unlock_word.removeAttribute('required');
            }
        });
    };
    padlock();
</script>