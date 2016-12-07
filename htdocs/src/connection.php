<?php
try
{ // création de la connection à la bd
    $Cnn = new PDO( 'mysql:host=localhost;dbname=loveydovey', 'root', '');
    // envoie des erreurs de warning
    $Cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $erreur)
 {        
    echo 'Erreur : '.$erreur->getMessage();
 }
?>