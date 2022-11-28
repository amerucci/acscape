<?php $title = "Creation d'un meuble"; ?>

<h1>Création d'un meuble</h1>

<form action="create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input type="file" name="picture" id="picture" class="form-control">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="action">Action</label>
        <input type="text" name="action" id="action" class="form-control">
    </div>
    <div class="form-group">
        <label for="clue">Indice</label>
        <input type="text" name="clue" id="clue" class="form-control">
        <!-- button for a new clue -->
        <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
        <p class="max"></p>
    </div>
    <div class="form-group">
        <label for="padlock">Verrouillé</label>
        <select name="padlock" id="padlock" class="form-control">
            <option value="yes">Oui</option>
            <option value="no">Non</option>
        </select>
    </div>
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
    <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
    <input type="hidden" name="room_id" value="<?= $_SESSION['room_id'] ?>">
    <button type="submit" class="btn btn-primary">Créer</button>

</form>

<script>
    let i = 1;
    document.getElementById('addClue').addEventListener('click', function () {
        if (i < 3) {
            i++;
            let newClue = document.createElement('input');
            newClue.setAttribute('type', 'text');
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

<?php var_dump($_SESSION);