<?php $title = "Administration des salles"; ?>
<a href="room/create">Créer une salle</a>

<?php 

if (count($params['rooms']) == 0) {
    echo "<p>vous n'avez pas encore de salle</p>";
} else {
    foreach ($params['rooms'] as $room) {
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>{$room->title}</h5>";
        echo "<p class='card-text'>{$room->getExcerpt()}</p>";
        echo "image : <img src='/acscape/assets/pictures/rooms/{$room->picture}' alt='image de la salle' width='100px' height='100px'>";
        echo "<a href='/acscape/admin/room/show/{$room->id}' class='btn btn-primary'>Voir</a>";
        echo "<a href='/acscape/admin/room/edit/{$room->id}' class='btn btn-primary mx-3'>editer</a>";
        echo "</div>";
        echo "</div>";
}  
    }

?>