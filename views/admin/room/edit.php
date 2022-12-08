<?php $room = $params['room'];
$title = "Modifier la salle {$room->title}";
?>

<div class="container admin_container">
    <h1 class="text-center">editer votre salle</h1>

    <div class="d-flex justify-content-center align-items-center flex-column my-3">
        <form action="/acscape/admin/room/edit/<?= $room->id ?>" method="post" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column gap-2 w-50">
            <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= $room->title ?>" required>
            </div>
            <div class="dnone edit_plus d-flex justify-content-center align-items-center flex-column gap-3">
                <div class="form-group form_desc d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        required><?= $room->description ?></textarea>
                </div>
                <div class="form-group form_picture d-flex justify-content-center align-items-center flex-column w-100">
                    <button type="button" class="btn btn-primary" id="addPicture">modifier l'image</button>
                    <input type="hidden" name="picture" id="picture" value="<?= $room->picture ?>">
                    <img src="/acscape/assets/pictures/rooms/<?= $room->picture ?>" alt="image du script" width="100px"
                        height="100px" id="picturePreview">
                    <img id="picturePreviewTemp">
                </div>
                <div class="d-flex justify-content-center align-items-center gap-5">
                    <div class="form-group form_padlock d-flex justify-content-center align-items-center flex-column">
                        <label for="padlock">Serrure</label>
                        <select name="padlock" id="padlock" class="form-control">
                            <option value="no" <?= $room->padlock == 'no' ? 'selected' : '' ?>>Non</option>
                            <option value="yes" <?= $room->padlock == 'yes' ? 'selected' : '' ?>>Oui</option>
                        </select>
                    </div>
                    <div
                        class="form-group form_room_start d-flex justify-content-center align-items-center flex-column">
                        <label for="start">Salle de départ</label>
                        <select name="start" id="start" class="form-control">
                            <option value="0" <?= $room->start == 0 ? 'selected' : '' ?>>Non</option>
                            <option value="1" <?= $room->start == 1 ? 'selected' : '' ?>>Oui</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form_name d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="title">Solution pour le dévérouillage</label>
                    <input type="text" name="unlock_word" id="unlock_word" class="form-control"
                        placeholder="inscrivez ici le mot ou le nombre qui dévérrouillera cette pièce" required
                        value="<?= $room->unlock_word ?>">
                </div>
                <div class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="clue">Indice</label>
                    <input type="text" class="form-control" id="clue" name="clue" value="<?= $room->clue ?>">
                    <?php if (!$room->clue2): ?>
                    <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                    <?php endif; ?>
                </div>
                <?php if ($room->clue2) : ?>
                <div class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="clue2">Indice 2</label>
                    <input type="text" class="form-control" id="clue2" name="clue2" value="<?= $room->clue2 ?>">
                    <?php if (!$room->clue3): ?>
                    <button type="button" class="btn btn-primary mt-1" id="addClue">Ajouter un indice</button>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if ($room->clue3) : ?>
                <div class="form-group form_clue d-flex justify-content-center align-items-center flex-column w-100">
                    <label for="clue3">Indice 3</label>
                    <input type="text" class="form-control" id="clue3" name="clue3" value="<?= $room->clue3 ?>">
                </div>
                <?php endif; ?>

            </div>
            <p class="btn btn-primary w-100 editPlus">Editer les autres paramètres de la salle</p>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="script_id" value="<?= $_SESSION['script_id'] ?>">
            <button type="submit" class="btn btn-primary my-1 w-100">Editer</button>
        </form>


        <?php $_SESSION['room_id'] = $params['room']->id; ?>


        <p>---------------------------</p>
        <h3 class="m-0">Liste des meubles</h3>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <a href="/acscape/admin/furniture/create" class="btn btn-primary my-2">Ajouter un meuble</a>
            <div class="d-flex">
                <?php foreach ($params['furnitures'] as $furniture) : ?>
                <?php if ($furniture->room_id == $_SESSION['room_id']) : ?>
                <div class="card mx-2 card_furniture">
                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                        <h5 class="card-title"><?= $furniture->title ?></h5>
                        <p class="card-text"><?= $furniture->description ?></p>
                        <a href="/acscape/admin/furniture/edit/<?= $furniture->id ?>"
                            class="btn btn-primary my-1">Editer</a>
                        <form action="/acscape/admin/furniture/delete/<?= $furniture->id ?>" method="post">
                            <input type="hidden" name="id" value="<?= $furniture->id ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
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


    let c = 1;
    document.getElementById('addClue').addEventListener('click', function () {
        if (c < 3) {
            c++;
            let newClue = document.createElement('textarea');
            newClue.setAttribute('name', 'clue' + c);
            newClue.setAttribute('id', 'clue' + c);
            newClue.setAttribute('placeholder', 'Indice ' + c);
            newClue.setAttribute('class', 'form-control mt-2');
            document.getElementById('clue').parentNode.insertBefore(newClue, document.getElementById(
                'addClue'));
        }
        if (c === 3) {
            document.getElementById('addClue').setAttribute('disabled', 'disabled');
            document.getElementById('addClue').style.cursor = 'not-allowed';
        }
    });

    const edit_plus = document.querySelector('.edit_plus');
    const editPlus = document.querySelector('.editPlus');

    editPlus.addEventListener('click', function () {
        edit_plus.classList.remove('dnone');
        editPlus.classList.add('dnone');
    });
</script>