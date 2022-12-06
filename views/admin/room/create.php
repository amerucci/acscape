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
                        <option value="0">Non</option>
                        <option value="1">Oui</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
            <button type="submit" class="btn btn-primary my-1 w-100">Créer</button>
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