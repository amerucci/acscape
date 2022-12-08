<?php $title = "création de salles"; ?>
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
                <input type="file" name="picture" id="picture" class="form-control" required>
                <img src="" alt="" id="picturePreview">
                <img src="" alt="" id="picturePreviewTemp">
            </div>
            <div class="d-flex justify-content-center align-items-center gap-5">
                <div class="form-group form_padlock d-flex justify-content-center align-items-center flex-column">
                    <label for="padlock">Serrure</label>
                    <select name="padlock" id="padlock" class="form-control">
                        <option value="no">Non</option>
                        <option value="yes">Oui</option>
                    </select>
                </div>
                <div class="form-group form_room_start d-flex justify-content-center align-items-center flex-column">
                    <label for="start">Salle de départ</label>
                    <select name="start" id="start" class="form-control">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>
            </div>
            <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                <label for="title">Solution pour le dévérouillage</label>
                <input type="text" name="unlock_word" id="unlock_word" class="form-control"
                    placeholder="inscrivez ici le mot ou le nombre qui dévérrouillera cette pièce" required>
            </div>
            <div class="form-group d-flex justify-content-center align-items-center flex-column form_clue w-100">
                <label for="clue">Indice</label>
                <input type="text" name="clue" id="clue" class="form-control" placeholder="indice 1">
                <!-- button for a new clue -->
                <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                <p class="max"></p>
            </div>

            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
            <button type="submit" class="btn btn-primary my-1 w-100">Créer</button>
        </form>

        <!-- <?= var_dump($params) ?> -->


        <script>
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
            let i = 1;
            document.getElementById('addClue').addEventListener('click', function () {
                if (i < 3) {
                    i++;
                    let newClue = document.createElement('input');
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
        </script>