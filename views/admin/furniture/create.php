<?php $title = "Creation d'un meuble"; ?>

<div class="container admin_container">
    <div class="d-flex justify-content-center align-items-center flex-column w-100 my-5">
        <h1>Création d'un meuble</h1>
        <form action="create" method="post" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column gap-2 w-75">
            <div class="form-group d-flex justify-content-center align-items-center flex-column form_name w-100">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group d-flex justify-content-center align-items-center flex-column form_picture w-100">
                <label for="picture">Image</label>
                <input type="file" name="picture" id="picture" class="form-control">
            </div>
            <div class="form-group d-flex justify-content-center align-items-center flex-column form_desc w-100">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="6" required></textarea>
            </div>
            <div class="d-flex justify-content-center align-items-center w-100 gap-3">
                <div class="form-group d-flex justify-content-center align-items-center flex-column form_action">
                    <label for="action">Action</label>
                    <input type="text" name="action" id="action" class="form-control" required>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center flex-column form_padlock">
                    <label for="padlock">Verrouillé</label>
                    <select name="padlock" id="padlock" class="form-control">
                        <option value="yes">Oui</option>
                        <option value="no">Non</option>
                    </select>
                </div>
            </div>
            <div class="dnone padlock_params d-flex justify-content-center align-items-center flex-column w-100 gap-3">
                <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="title">Solution pour le dévérouillage</label>
                    <input type="text" name="unlock_word" id="unlock_word" class="form-control"
                        placeholder="inscrivez ici le mot ou le nombre qui dévérrouillera cette pièce" required>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center flex-column form_clue w-100">
                    <label for="clue">Indice</label>
                    <textarea type="text" name="clue" id="clue" class="form-control" placeholder="indice 1"></textarea>
                    <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                    <p class="max"></p>
                </div>
                <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="title">Récompense du dévérouillage</label>
                    <textarea type="text" name="reward" id="reward" class="form-control"
                        placeholder="Indiquer ici une aide pour dévérrouiller d'autres pièces ou meubles"
                        rows="6"></textarea>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
            <input type="hidden" name="room_id" value="<?= $_SESSION['room_id'] ?>">
            <button type="submit" class="btn btn-primary mx-auto w-100">Créer</button>
        </form>
    </div>
</div>
</div>

<script>
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

    function padlock() {

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
    }
    padlock();
</script>