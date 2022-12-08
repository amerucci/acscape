<?php $title = "Administration des scénarios"; ?>

<?php 
$scripts = $params['scripts']; ?>


<div class="container admin_container d-flex justify-content-center align-items-center flex-column ">
    <h1 class="text-center">Administration des scénarios</h1>
    <div class="accordion w-50" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    En savoir plus
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body d-flex justify-content-center flex-column">
                    <p class="">Comment créer son jeu ?</p>
                    <p class="m-0">&#x2022; Une fois le scénario créé, vous pouvez l'éditer</p>
                    <p class="m-0">&#x2022; L'édition vous permet d'avoir accès à l'option 'création du jeu' </p>
                    <p class="m-0">&#x2022; 'création du jeu' vous permets de créer des pièces auxquelles vous pouvez
                        y associer des meubles</p>
                </div>
            </div>
        </div>
    </div>
    <a class="create_script my-5" href='script/create'> Ajouter un scénario </a>

    <div class="d-flex flex-wrap w-100 my-3">
        <?php foreach ($scripts as $script) : ?>
        <?php if ($script->user_id == $_SESSION['user_id']): ?>
        <div class="card my-2 d-flex mx-1 ">
            <div class="card-body card_script d-flex justify-content-center align-items-center flex-column">
                <img src="../assets/pictures/scripts/<?= $script->picture ?>" alt="<?= $script->title ?>"
                    class="card-img-top">
                <h5 class="card-title"><?= $script->title ?></h5>
                <p class="card-text"><?= $script->description ?></p>
                <div class="d-flex justify-content-center align-items-center flex-column gap-1">
                    <a href="script/edit/<?= $script->id ?>" class="btn btn-primary w-100">Editer</a>
                    <form action="script/delete/<?= $script->id ?>" method="post">
                        <input type="hidden" name="id" value="<?= $script->id ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>