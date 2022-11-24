<?php 

// var_dump(count($params['scripts']));

if (count($params['scripts']) == 0); {
    echo "<p>vous n'avez pas encore de scénario</p>";
    echo "<a href='script/create'>Créer un scénario</a>";
};

var_dump($params['scripts']);