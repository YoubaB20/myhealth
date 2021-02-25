<?php
    // connexion a la base de donnee my_health 
    try{
        $bdd = new PDO('mysql:host=localhost; dbname=my_health','root','');
     } catch(Exception $e){
        die ('Erreur :'.$e->getmessage());
    }

?>