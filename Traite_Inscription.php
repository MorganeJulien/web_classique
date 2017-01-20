<?php
session_start();
$Prenom = $_REQUEST["Prenom"];
$Nom = $_REQUEST["Nom"];
$Password = $_REQUEST["Password"];
$Login=$_REQUEST["Login"];
$url=$_REQUEST["url"];

$pdo = new PDO("sqlsrv:Server=INFO-SIMPLET;Database=Classique_Web", "ETD", "ETD");
$sql = "Insert INTO Abonné (Prénom_Abonné, Nom_Abonné, Login, Password) VALUES ('".$Prenom."', '".$Nom."', '".$Login."' , ".$Password."')";

$_SESSION['NOM_USER']=$Login;
header("Location: ".$url);

?>
