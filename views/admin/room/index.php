<?php $title = "Administration des salles"; ?>


<div class="container admin_container">
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
            echo "image : <img src='/assets/pictures/rooms/{$room->picture}' alt='image de la salle' width='100px' height='100px'>";
            echo "<a href='/admin/room/show/{$room->id}' class='btn btn-primary'>Voir</a>";
            echo "<a href='/admin/room/edit/{$room->id}' class='btn btn-primary mx-3'>editer</a>";
            echo "</div>";
            echo "</div>";
    }
        }
    
    ?>
</div>