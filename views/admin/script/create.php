<?php $title = "Creation des scripts"; ?>
<?php unset($_SESSION['script_id']); ?>

<div class="container admin_container">

    <div class="d-flex justify-content-center align-items-center gap-2 flex-column">
        <h1 class="">Création d'un scénario</h1>
    </div>



    <div class="d-flex justify-content-center align-items-center gap-1 flex-column my-4 w-100">
        <form action="create" method="POST" enctype="multipart/form-data" runat="server" class="w-75">
            <div class="form-group d-flex justify-content-center align-items-center flex-column gap-1 form_name">
                <label for="name">Nom du scénario</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div
                class="form-group d-flex justify-content-center align-items-center flex-column gap-1 w-100 my-3 form_desc">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="9" required></textarea>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-5 my-5">
                <div class="form-group d-flex justify-content-center align-items-center flex-column gap-1 form_win">
                    <label for=" content">Message de victoire</label>
                    <textarea class="form-control" name="winner_msg" id="content" rows="6" required></textarea>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center flex-column gap-1 form_lose">
                    <label for="content">Message de défaite</label>
                    <textarea class="form-control" name="lost_msg" id="content" rows="6" required></textarea>
                </div>
            </div>
            <div
                class="form-group d-flex justify-content-center align-items-center flex-column gap-1 my-5 form_picture w-100">
                <label for="picture">Image</label>
                <input type="file" class="form-control-file" name="picture" id="picture">
                <img src="" alt="" id="picturePreview">
                <img src="" alt="" id="picturePreviewTemp">
            </div>
            <div class="d-flex gap-5">
                <div
                    class="form-group d-flex justify-content-center align-items-center flex-column gap-1 w-50 form_difficulty">
                    <label class="d-flex justify-content-center align-items-center gap-1" for="difficulty">Difficulté
                        <iconify-icon icon="ri:lock-line"></iconify-icon> </label>
                    <select class="form-control" name="difficulty" id="difficulty">
                        <option value="1">Très Facile</option>
                        <option value="2">Facile</option>
                        <option value="3">Moyen</option>
                        <option value="4">Difficile</option>
                        <option value="5">Très Difficile</option>
                    </select>
                </div>
                <div
                    class="form-group form_duration d-flex justify-content-center align-items-center flex-column gap-2">
                    <label class="d-flex justify-content-center align-items-center gap-1" for="duration">Durée en
                        minutes <iconify-icon icon="mdi:clock-time-three-outline" style="color: #717171;">
                        </iconify-icon></label>
                    <input type="time" class="form-control" name="duration" id="duration" min="00:10" max="01:00"
                        required>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <button type="submit" class="btn btn-primary my-4 w-100">Créer</button>
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