<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Votre panier</title>
</head>
<body>
<form method="post" action="panier.php">
    <table style="width: 400px">
        <tr>
            <td colspan="4">Votre panier</td>
        </tr>
        <tr>
            <td>Libellé</td>
            <td>Prix Unitaire</td>
            <td>Action</td>
        </tr>
        <?php
        $nbArticles = count($_SESSION['panier']['Code_Album']);
        if ($nbArticles <= 0)
            echo "<tr><td>Votre panier est vide </ td></tr>";
        else {
            for ($i = 0; $i < $nbArticles; $i++) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($_SESSION['panier']['Code_Album'][$i]) . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</form>
</body>
</html>