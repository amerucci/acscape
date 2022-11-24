<?php 

var_dump(count($params['scripts']));
echo "<a href='script/create'>Créer un scénario</a>";

if (count($params['scripts']) == 0) {
    echo "<p>vous n'avez pas encore de scénario</p>";
} else {
    echo "<table class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>Nom</th>";
    echo "<th scope='col'>Difficulté</th>";
    echo "<th scope='col'>description</th>";
    echo "<th scope='col'>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($params['scripts'] as $script) {
        echo "<tr>";
        echo "<td>" . $script->title . "</td>";
        echo "<td>" . $script->difficulty . "</td>";
        echo "<td>" . $script->getExcerpt() . "</td>";
        echo "<td>";
        echo "<a href='script/edit/" . $script->id . "' class='btn btn-primary'>Modifier</a>";
        echo "<a href='script/delete/" . $script->id . "' class='btn btn-danger'>Supprimer</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

// var_dump($params['scripts']);