<?php $title = "Administration des meubles"; ?>
<?php if ($_COOKIE['csrf_token'] != $_SESSION['csrf']) {
return header('Location: /login?error=session_expired');
} ?>
<div class="container admin_container">
    <a href="furniture/create">Créer un meuble</a>


    <?php if (count($params['furnitures']) == 0) : ?>
    <p>vous n'avez pas encore de meuble</p>))
    <?php else : ?>
    <?php foreach ($params['furnitures'] as $furniture) : ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $furniture->title ?></h5>
            <p class="card-text"><?= $furniture->getExcerpt() ?></p>
            <img src="/assets/pictures/furnitures/<?= $furniture->picture ?>" alt="image du meuble" width="100px"
                height="100px">
            <a href="/admin/furniture/show/<?= $furniture->id ?>" class="btn btn-primary">Voir</a>
            <a href="/admin/furniture/edit/<?= $furniture->id ?>" class="btn btn-primary mx-3">editer</a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>