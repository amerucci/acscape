<?php $object = $params['object'];
$title = "Modifier l'objet {$object->title}";
?>

<div class="container admin_container">
    <h1 class="text-center">editer votre objet</h1>

    <div class="d-flex justify-content-center align-items-center flex-column">
        <form action="/acscape/admin/objects/edit/<?= $object->id ?>" method="post" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column w-75 gap-2">
            <div class="form-group d-flex justify-content-center align-items-center flex-column w-100 form_name">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= $object->title ?>" required>
            </div>
            <div class="form-group d-flex justify-content-center align-items-center flex-column w-100 form_desc">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                    required><?= $object->description ?></textarea>
            </div>
            <div class="form-group d-flex justify-content-center align-items-center flex-column w-100 form_picture">
                <button type="button" class="btn btn-primary" id="addPicture">modifier l'image</button>
                <input type="hidden" name="picture" id="picture" value="<?= $object->picture ?>">
                <img src="/acscape/assets/pictures/objects/<?= $object->picture ?>" alt="image de l'object"
                    width="100px" height="100px" id="picturePreview">
                <img id="picturePreviewTemp">
            </div>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
            <button type="submit" class="btn btn-primary w-100">Editer</button>
        </form>
    </div>
</div>

<script>
    let addPicture = document.getElementById('addPicture');
    let picture = document.getElementById('picture');
    let i = 0;
    addPicture.addEventListener('click', function () {
        let input = document.createElement('input');
        input.type = 'file';
        input.name = 'picture';
        input.id = 'picture';
        input.classList.add('form-control');
        input.classList.add('mt-3');
        input.required = true;
        picture.replaceWith(input);
        picture = input;
        i++;
        if (i > 1) {
            addPicture.style.disabled = true;
        }

        picture.onchange = evt => {
            const [file] = picture.files
            if (file) {
                let picturePreview = document.getElementById('picturePreview');
                picturePreview.remove();
                picturePreviewTemp.src = URL.createObjectURL(file);
                picturePreviewTemp.width = 100;
                picturePreviewTemp.height = 100;
            }
        }
    });
</script>