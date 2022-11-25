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
        echo "<a href='/acscape/admin/room/{$room->id}' class='btn btn-primary'>Voir</a>";
        echo "</div>";
        echo "</div>";
}  
    }