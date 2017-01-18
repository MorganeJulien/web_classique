<?php
session_start();
$Password = $_REQUEST["Password"];
$Login=$_REQUEST["Login"];
$url=$_REQUEST["url"];
// recherche si l'utilisateur est enregistré et possède le bon mot de passe
$pdo = new PDO("sqlsrv:Server=INFO-SIMPLET;Database=Classique_Web", "ETD", "ETD");
$sql = "Select Login, Password from Abonné where Login ='".$Login."' and Password ='".$Password."'";

$reponse = $pdo->query($sql);
$donnees= $reponse -> fetch();

if (isset ($donnees['Login']) && isset($donnees['Password'])){
    $_SESSION['NOM_USER']=$Login;
    header("Location: ".$url);
}
else
{//Mot de passe (et/ou login) incorrect : rejet de l'utilisateur
    header("Location: Connexion.php?url=".$url);
   // header("Location: Index.html");

}
?>

