<?php $title = "Administration des scénarios"; ?>

<?php 

// var_dump(count($params['scripts']));
echo "<a href='script/create'>Créer un scénario</a>";

if (count($params['scripts']) == 0) {
    echo "<p>vous n'avez pas encore de scénario</p>";
} else {
//    présenter sous forme de cards
echo "<div class='d-flex gap-2'>";
    foreach ($params['scripts'] as $script) {
        echo "<div class='card' style='width: 18rem;'>";
        echo "<img src='../assets/pictures/scripts/" . $script->picture . "' class='card-img-top' alt='...'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $script->title . "</h5>";
        echo "<p class='card-text'>" . $script->description . "</p>";
        echo "<a href='script/edit/" . $script->id . "' class='btn btn-primary'>Paramètre du scénario</a>";
        echo "<a href='script/delete/" . $script->id . "' class='btn btn-danger'>Supprimer</a>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
}

var_dump($_SESSION);
unset($_SESSION['script_id']);