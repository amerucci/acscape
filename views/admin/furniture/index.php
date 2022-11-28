<?php $title = "Administration des meubles"; ?>
<a href="furniture/create">Créer un meuble</a>

<?php

if (count($params['furnitures']) == 0) {
    echo "<p>vous n'avez pas encore de meuble</p>";
} else {
    foreach ($params['furnitures'] as $furniture) {
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>{$furniture->title}</h5>";
        echo "<p class='card-text'>{$furniture->getExcerpt()}</p>";
        echo "image : <img src='/acscape/assets/pictures/furnitures/{$furniture->picture}' alt='image du meuble' width='100px' height='100px'>";
        echo "<a href='/acscape/admin/furniture/show/{$furniture->id}' class='btn btn-primary'>Voir</a>";
        echo "<a href='/acscape/admin/furniture/edit/{$furniture->id}' class='btn btn-primary mx-3'>editer</a>";
        echo "</div>";
        echo "</div>";
    }
}

?>