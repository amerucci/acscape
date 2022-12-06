<?php $title = "Administration des scénarios"; ?>

<?php 
$scripts = $params['scripts']; ?>


<div class="container admin_container">
    <a class="create_script my-5" href='script/create'>Créer un scénario</a>

    <div class="d-flex flex-wrap">
        <?php foreach ($scripts as $script) : ?>
        <?php if ($script->user_id == $_SESSION['user_id']): ?>
        <div class="card col-2 mx-2">
            <div class="card-body d-flex justify-content-center align-items-center flex-column gap-1 card_script">
                <img src="../assets/pictures/scripts/<?= $script->picture ?>" alt="<?= $script->title ?>"
                    class="card-img-top">
                <h5 class="card-title"><?= $script->title ?></h5>
                <p class="card-text"><?= $script->description ?></p>
                <a href="script/edit/<?= $script->id ?>" class="btn btn-primary">Editer</a>
                <form action="script/delete/<?= $script->id ?>" method="post">
                    <input type="hidden" name="id" value="<?= $script->id ?>">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>