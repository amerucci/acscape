<?php $title = "Administration des objets"; ?>
<div class="container admin_container">
    <a href="create">Créer un objet</a>

    <?php if (count($params['objects']) == 0) : ?>
    <p>vous n'avez pas encore d'objet</p>
    <?php else : ?>
    <?php foreach ($params['objects'] as $object) : ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $object->title ?></h5>
            <p class="card-text"><?= $object->getExcerpt() ?></p>
            <img src="/acscape/assets/pictures/objects/<?= $object->picture ?>" alt="image de l'objet" width="100px"
                height="100px">
            <a href="/acscape/admin/objects/show/<?= $object->id ?>" class="btn btn-primary">Voir</a>
            <a href="/acscape/admin/objects/edit/<?= $object->id ?>" class="btn btn-primary mx-3">editer</a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>