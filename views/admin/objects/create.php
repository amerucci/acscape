<?php $title = "création d'un objet" ?>

<div class="container admin_container">
    <h1 class="text-center">Création d'un objet</h1>
    <div class="d-flex justify-content-center align-items-center flex-column gap-2 w-75 mx-auto">

        <form action="create" method="POST" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column gap-2 w-75 my-5">
            <div class="form-group d-flex justify-content-center align-items-center flex-column form_name w-100">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group d-flex justify-content-center align-items-center flex-column form_desc w-100">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="6" required></textarea>
            </div>
            <div class="form-group d-flex justify-content-center align-items-center flex-column form_picture w-100">
                <label for="picture">Image</label>
                <input type="file" name="picture" id="picture" class="form-control">
                <img src="" alt="" id="picturePreview">
                <img src="" alt="" id="picturePreviewTemp">
            </div>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
            <button type="submit" class="btn btn-primary w-100">Créer</button>
        </form>
    </div>
</div>


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