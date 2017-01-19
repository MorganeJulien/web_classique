<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Votre Panier</title>
		<link rel="shortcut icon" href="assets/images/logo_couleur.jpg">
		<link rel="stylesheet" type="text/css" href="assets/style.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
					session_start();
					echo '<div id="connexion">';
					echo '<ul>';
					if (isset($_SESSION["NOM_USER"])) 
					{
						echo '<li>';
						echo "Bonjour " . $_SESSION["NOM_USER"];
						echo '</li>';
						echo '<li> <a href="panier.php"> Panier <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>';
						echo '</li>';
						echo '<li>';
						echo '<a href="Deconnexion.php"> Deconnexion </a>';
					} 
					else 
					{
						$url = $_SERVER["REQUEST_URI"];
						echo '<li>';
						echo '<a href="connexion.php?url=' . $url . '">Connexion</a>';
						echo '</li>';
					}
					echo '</ul>';
					echo '</div>';
					$nbArticles = count($_SESSION['panier']['Code_Album']);
					if ($nbArticles <= 0)
					echo "<tr><td>Votre panier est vide </ td></tr>";
					else {
					for ($i = 0; $i < $nbArticles; $i++) 
					{
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
