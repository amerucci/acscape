<?php $title = "création de salles"; ?>
<?php if ($_SESSION['user_id'] != (int)$params['users'][0]->id) {
return header('Location: /login?error=session_expired');
} ?>

<div class="container admin_container">

    <h1 class="text-center">Créer votre salle</h1>

    <div class="d-flex justify-content-center align-items-center flex-column my-3">
        <form action="create" method="post" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column gap-2 w-50">
            <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group form_desc d-flex justify-content-center align-items-center flex-column w-100">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                    required></textarea>
            </div>
            <div class="form-group form_picture d-flex justify-content-center align-items-center flex-column w-100">
                <label for="picture">Image</label>
                <input type="file" name="picture" id="picture" class="form-control">
                <img src="" alt="" id="picturePreview">
                <img src="" alt="" id="picturePreviewTemp">
            </div>
            <div class="d-flex justify-content-center align-items-center gap-5">
                <div class="form-group form_padlock d-flex justify-content-center align-items-center flex-column">
                    <label for="padlock">Serrure</label>
                    <select name="padlock" id="padlock" class="form-control">
                        <option value="yes">Oui</option>
                        <option value="no">Non</option>
                    </select>
                </div>
                <div
                    class="form-group form_room_start d-flex justify-content-center align-items-center flex-column dnone">
                    <label for="n-room">Numéro de salle</label>
                    <input type="number" name="n_room" id="n-room" class="form-control" min="1" value="1">
                </div>
            </div>
            <div class="dnone padlock_params d-flex justify-content-center align-items-center flex-column w-100 gap-3">
                <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="title">Solution pour le dévérouillage</label>
                    <input type="text" name="unlock_word" id="unlock_word" class="form-control"
                        placeholder="inscrivez ici le mot ou le nombre qui dévérrouillera cette pièce">
                </div>
                <div class="form-group d-flex justify-content-center align-items-center flex-column form_clue w-100">
                    <label for="clue">Indice</label>
                    <textarea type="text" name="clue" id="clue" class="form-control" placeholder="indice 1"
                        rows="6"></textarea>
                    <!-- button for a new clue -->
                    <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                    <p class="max"></p>
                </div>
                <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="title">Récompense du dévérouillage</label>
                    <textarea type="text" name="reward" id="reward" class="form-control"
                        placeholder="Indiquer ici une aide pour dévérrouiller d'autres pièces ou meubles. Vous pouvez laisser ce champ vide."
                        rows="6"></textarea>
                </div>
            </div>

            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
            <button type="submit" class="btn btn-primary my-1 w-100">Créer</button>
        </form>

        <!-- <?php if ($roomsNb->script_id == $_SESSION['script_id']) :?>
        <div class="d-flex justify-content-center align-items-center flex-column w-50">
            <h2 class="text-center">Liste des salles</h2>
            <div class="d-flex justify-content-center align-items-center flex-column w-100">
                <?php foreach ($roomsNb as $room) : ?>
                <div class="d-flex justify-content-center align-items-center flex-column w-100">
                    <div class="d-flex justify-content-center align-items-center flex-column w-100">
                        <h3 class="text-center"><?= $room->title ?></h3>
                        <p class="text-center"><?= $room->description ?></p>
                        <img src="<?= $room->picture ?>" alt="" class="img-fluid">
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column w-100">
                        <a href="edit/<?= $room->id ?>" class="btn btn-primary my-1 w-100">Modifier</a>
                        <a href="delete/<?= $room->id ?>" class="btn btn-danger my-1 w-100">Supprimer</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?> -->

        <?php $rooms = $params['json']; echo '<script>const rooms = ' . $rooms . '</script>'; ?>

        <script>
            let padLock = document.getElementById('padlock');
            const nbrooms = Object.values(rooms)[0];
            if (nbrooms < 1) {
                padlock.value = 'no';
                document.querySelector('.form_padlock').classList.add('dnone');
            } else {
                document.querySelector('.form_padlock').classList.remove('dnone');
                padlock();
            }
            const numeRoom = document.getElementById('n-room');
            const nbroomsNumber = parseInt(nbrooms);
            numeRoom.min = nbroomsNumber + 1;
            numeRoom.value = nbroomsNumber + 1;





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
            };


            let i = 1;
            document.getElementById('addClue').addEventListener('click', function () {
                if (i < 3) {
                    i++;
                    let newClue = document.createElement('textarea');
                    newClue.setAttribute('type', 'text');
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

            const description = document.getElementById('description');
            const reward = document.getElementById('reward');
            const clue = document.getElementById('clue');
            const unlock_word = document.getElementById('unlock_word');

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
            }
            padlock();
        </script>