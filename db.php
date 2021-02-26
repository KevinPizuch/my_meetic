<?php
try
{
   $bdd = new PDO('mysql:host=localhost;dbname=my_meetic;charset=utf8', 'root', 'root'); // connexion base de données
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
