<?php $room = $params['room'];
$title = "Modifier la salle {$room->title}";
?>
<?php if ((int) $params['room']->user_id != $_SESSION['user_id']) {
return header('Location: /login?error=session_expired');
} ?>




<div class="container admin_container">
    <h1 class="text-center">editer votre salle</h1>

    <div class="d-flex justify-content-center align-items-center flex-column my-3">
        <form action="/admin/room/edit/<?= $room->id ?>" method="post" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column gap-2 w-75">
            <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="<?=htmlspecialchars($room->title) ?>" required>
            </div>
            <div class="dnone edit_plus d-flex justify-content-center align-items-center flex-column gap-3 w-100">
                <div class="form-group form_desc d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        required><?=htmlspecialchars($room->description) ?></textarea>
                </div>
                <div class="form-group form_picture d-flex justify-content-center align-items-center flex-column w-100">
                    <button type="button" class="btn btn-primary" id="addPicture">modifier l'image</button>
                    <input type="hidden" name="picture" id="picture" value="<?= $room->picture ?>">
                    <img src="/assets/pictures/rooms/<?= $room->picture ?>" alt="image du script" width="100px"
                        height="100px" id="picturePreview">
                    <img id="picturePreviewTemp">
                </div>
                <div class="d-flex justify-content-center align-items-center gap-5">
                    <div class="form-group form_padlock d-flex justify-content-center align-items-center flex-column">
                        <label for="padlock">Serrure</label>
                        <select name="padlock" id="padlock" class="form-control">
                            <option value="no" <?= $room->padlock == 'no' ? 'selected' : '' ?>>Non</option>
                            <option value="yes" <?= $room->padlock == 'yes' ? 'selected' : '' ?>>Oui</option>
                        </select>
                    </div>
                    <div
                        class="form-group form_room_start d-flex justify-content-center align-items-center flex-column dnone">
                        <label for="n_room">numéro de salle</label>
                        <input type="number" id="n_room" class="form-control" name="n_room"
                            value="<?= $room->n_room ?>">
                    </div>
                </div>
                <div
                    class="dnone padlock_params d-flex justify-content-center align-items-center flex-column w-100 gap-3">
                    <div
                        class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                        <label for="title">Solution pour le dévérouillage</label>
                        <input type="text" name="unlock_word" id="unlock_word" class="form-control"
                            placeholder="inscrivez ici le mot ou le nombre qui dévérrouillera cette pièce"
                            value="<?=htmlspecialchars($room->unlock_word) ?>">
                    </div>
                    <div
                        class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                        <label for="clue">Indice</label>
                        <textarea type="textarea" class="form-control" id="clue"
                            name="clue"><?= htmlspecialchars($room->clue) ?></textarea>
                        <?php if (!$room->clue2): ?>
                        <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                        <?php endif; ?>
                    </div>
                    <?php if ($room->clue2) : ?>
                    <div
                        class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                        <label for="clue2">Indice 2</label>
                        <textarea type="textarea" class="form-control" id="clue2"
                            name="clue2"><?= htmlspecialchars($room->clue2)?></textarea>
                        <?php if (!$room->clue3): ?>
                        <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($room->clue3) : ?>
                    <div
                        class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                        <label for="clue3">Indice 3</label>
                        <textarea type="textarea" class="form-control" id="clue3"
                            name="clue3"><?= htmlspecialchars($room->clue3) ?></textarea>
                    </div>
                    <?php endif; ?>
                    <div
                        class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                        <label for="title">Récompense du dévérouillage</label>
                        <textarea type="text" name="reward" id="reward" class="form-control" rows="5"
                            placeholder="Indiquer ici une aide pour dévérrouiller d'autres pièces ou meubles"><?= htmlspecialchars($room->reward) ?></textarea>
                    </div>
                </div>

            </div>
            <p class="btn btn-primary w-100 editPlus">Editer les autres paramètres de la salle</p>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
            <button type="submit" class="btn btn-primary my-1 w-100">Editer</button>
        </form>


        <?php $_SESSION['room_id'] = $params['room']->id; ?>


        <p>---------------------------</p>
        <h3 class="m-0">Liste des meubles</h3>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <a href="/admin/furniture/create" class="btn btn-primary my-3">Ajouter un meuble</a>
            <div class="d-flex flex-column flex-md-row flex-wrap justify-content-center align-items-center gap-3">
                <?php foreach ($params['furnitures'] as $furniture) : ?>
                <?php if ($furniture->room_id == $_SESSION['room_id']) : ?>
                <div class="card mx-2 card_furniture">
                    <div class="card-body d-flex justify-content-center align-items-center flex-column gap-1">
                        <img src="/assets/pictures/furnitures/<?= $furniture->picture ?>" alt="<?= $furniture->title ?>"
                            class="card-img-top object-fit-contain" width="100" height="100">
                        <h5 class="card-title"><?= $furniture->title ?></h5>
                        <p class="card-text"><?=  substr($furniture->description,  0, 50).'...' ?></p>
                        <div class="d-flex flex-column w-100">
                            <a href="/admin/furniture/edit/<?= $furniture->id ?>"
                                class="btn btn-primary my-1 w-100">Editer</a>
                            <form action="/admin/furniture/delete/<?= $furniture->id ?>" method="post" class="w-100">
                                <input type="hidden" name="id" value="<?= $furniture->id ?>">
                                <button type="submit" class="btn btn-danger w-100"
                                    onclick="deleteRecord()">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>

<?php $n_room = json_encode($params['room']->n_room); ?>
<?php echo '<script>const Nrooms = ' . json_decode($n_room). '</script>'; ?>

<script>
    let padlockContainer = document.querySelector('.form_padlock');
    if (Nrooms == 1) {
        console.log('ok');
        padlockContainer.classList.add('dnone')
    }


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

    const edit_plus = document.querySelector('.edit_plus');
    const editPlus = document.querySelector('.editPlus');

    editPlus.addEventListener('click', function () {
        edit_plus.classList.remove('dnone');
        editPlus.classList.add('dnone');
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