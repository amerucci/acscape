<?php $title = "création d'un objet" ?>

<h1>Création d'un objet</h1>

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
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
    <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
    <button type="submit" class="btn btn-primary">Créer</button>
</form>


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