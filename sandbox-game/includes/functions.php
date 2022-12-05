<?php

function connect() //fonction de connextion à la base
 {
     try
     {
         $bdd = new PDO('mysql:host=localhost;dbname=acscape;port=3306;charset=utf8', 'root', 'root');
        return $bdd; 
      
     }
     catch(Exception $e)
     {
         die('Erreur : '.$e->getMessage());
     }
 }


function getAllScripts(){
    $scripts = connect()->prepare('SELECT * FROM scripts');
    $scripts->execute();
    return $scripts->fetchAll();
}

function getScriptsInfo($id){
    $scripts = connect()->prepare('SELECT * FROM scripts where id=?');
    $scripts->execute([$id]);
    return $scripts->fetch();
}


?>

