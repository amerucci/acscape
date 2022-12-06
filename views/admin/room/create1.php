<?php $title = "création de salles"; ?>
<div class="container admin_container">
    <h1>Création d'une salle</h1>

    <form action="create" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="file" name="picture" id="picture" class="form-control" required>
            <img src="" alt="" id="picturePreview">
            <img src="" alt="" id="picturePreviewTemp">
        </div>
        <div class="form-group">
            <label for="padlock">Salle fermée ?</label>
            <select name="padlock" id="padlock" class="form-control">
                <option value="no">Non</option>
                <option value="yes">Oui</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start">Salle de départ <small><i>vous devez avoir au moins une salle de
                        départ</small></i></label>
            <select name="start" id="start" class="form-control">
                <option value="0">Non</option>
                <option value="1">Oui</option>
            </select>
        </div>
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>

<?php var_dump($_SESSION['script_id']); ?>


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
</script>