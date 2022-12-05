<?php

include('./includes/functions.php');

$scripts = getAllScripts();
var_dump($scripts);


//RECUPERATION RAPIDE DE LA LISTE DES SCRIPTS
if(!isset($_GET['script'])){
    echo "<ul>";
    foreach ($scripts as $script) {
        echo '<li><a href="?script='.$script["id"].'">'.$script["title"].'</a></li>';
    }
    echo "</ul>";
}
else{
    $script = getScriptsInfo($_GET['script']);
    echo'
    <div class="tite">'.$script["title"].'</div>
    ';
}


