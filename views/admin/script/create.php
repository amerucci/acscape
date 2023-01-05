<?php $title = "Creation des scripts"; ?>
<?php unset($_SESSION['script_id']); ?>
<?php if ($_COOKIE['csrf_token'] != $_SESSION['csrf']) {
return header('Location: /login?error=session_expired');
} ?>
<?php if ((int)$params['users'][0]->id != $_SESSION['user_id']) {
return header('Location: /login?error=error');
} ?>


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
                <label for="picture">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="150" viewBox="0 0 20 17">
                        <path
                            d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z">
                        </path>
                    </svg>
                </label>
                <input type="file" class="form-control-file inputfile" name="picture" id="picture">
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
                    <input type="number" class="form-control" name="duration" id="duration" min="10" max="60" required>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <button type="submit" class="btn btn-primary my-4 w-100">Créer</button>
        </form>
    </div>
</div>

<script>
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
            img.width = 400;
            img.height = 400;
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
</script>