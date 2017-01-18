<?php
session_start();
if (isset($_SESSION["NOM_USER"]))
{
    if ( !isset($_SESSION['panier']) )
    {
        $_SESSION['panier']=array();
        $_SESSION['panier']['Code_Album'] = array();
    }
    array_push( $_SESSION['panier']['Code_Album'],$_GET['Code']);
    header("Location: Panier.php");
}
else
{
    $url = $_SERVER["REQUEST_URI"];
    header("Location: Connexion.php?url=".$url);
}
?>