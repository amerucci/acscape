<?php $title = "Administration des objets"; ?>
<a href="create">Créer un objet</a>

<?php

if (count($params['objects']) == 0) {
    echo "<p>vous n'avez pas encore d'objet</p>";
} else {
    foreach ($params['objects'] as $object) {
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>{$object->title}</h5>";
        echo "<p class='card-text'>{$object->getExcerpt()}</p>";
        echo "image : <img src='/acscape/assets/pictures/objects/{$object->picture}' alt='image de l'objet' width='100px' height='100px'>";
        echo "<a href='/acscape/admin/objects/show/{$object->id}' class='btn btn-primary'>Voir</a>";
        echo "<a href='/acscape/admin/objects/edit/{$object->id}' class='btn btn-primary mx-3'>editer</a>";
        echo "</div>";
        echo "</div>";
    }
}