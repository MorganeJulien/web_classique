<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Classique</title>
    <link rel="shortcut icon" href="assets/images/logo_couleur.jpg">
    <link rel="stylesheet" type="text/css" href="assets/style.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="container">

    <header id="header">

        <div id="header_text">

            <div class="header_logo"><img src="assets/images/logo_couleur.jpg" alt="Logo"></div>

            <h1>site web de type e-commerce</h1>
        </div>
        <nav id="menu" class="show_menu">
            <ul id="main-menu">
                <ul id="main-menu">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="Compositeur.php">Compositeurs</a></li>
                    <li><a href="Interpretes.php">Interprètes</a></li>
                    <li><a href="ChefOrchestre.php">Chefs d'orchestre</a></li>
                    <li><a href="Orchestres.php">Orchestres</a></li>
                    <li><a href="Album.php">Album</a></li>
                    <li><a href="Apropos.html">A propos</a></li>
                </ul>
            </ul>
        </nav>
        <?php
        session_start();
        echo '<div id="connexion">';
        echo '<ul>';
        if (isset($_SESSION["NOM_USER"])) {
            echo '<li>';
            echo "Bonjour " . $_SESSION["NOM_USER"];
            echo '</li>';
            echo '<li> <a href="panier.php"> Panier <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>';
            echo '</li>';
            echo '<li>';
            echo '<a href="Deconnexion.php"> Deconnexion </a>';
        } else {
            $url = $_SERVER["REQUEST_URI"];
            echo '<li>';
            echo '<a href="connexion.php?url=' . $url . '">Connexion</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
        ?>
    </header>

    <div id="content">
        <div id="recherche">
            <form method="post" action="Compositeur_rep.php">
                <input name="nom" type="text"/>
                <button type="submit"><i class="fa fa-search" aria-hidden="true"> </i></button>
            </form>
        </div>


        <div id="content">

            <?php
            $pdo = new PDO("sqlsrv:Server=INFO-SIMPLET;Database=Classique_Web", "ETD", "ETD");
            $query = "Select *
                      from Musicien
                      INNER JOIN Pays ON Musicien.Code_Pays=Pays.Code_Pays
                      inner join Genre on Musicien.Code_Genre= Genre.Code_genre
                      inner join Instrument on Musicien.Code_Instrument= Instrument.Code_Instrument
                  where Code_Musicien=" . $_GET['Code'];
            foreach ($pdo->query($query) as $row) {
                echo '<b>Nom</b> : ' . $row['Nom_Musicien'] . "<br>";
                echo '<b>Prénom : </b>' . $row[utf8_decode('Prénom_Musicien')] . "<br>";
                echo '<b> Pays : </b> ' . $row['Nom_Pays'] . "<br>";
                echo '<b>Année de Naissance :</b>' . $row[utf8_decode('Année_Naissance')] . '</br>';
                echo '<b>Genre :</b>' . $row[utf8_decode('Libellé_Abrégé')] . '</br>';
                echo '<b>Instrument :</b>' . $row[utf8_decode('Nom_Instrument')] . '</br>';
                echo "<img src='photoMusicien.php?Code=" . $row['Code_Musicien'] . "'> <br>";
            }
            $pdo = null;
            ?>

            <?php
            $pdo = new PDO("sqlsrv:Server=INFO-SIMPLET;Database=Classique_Web", "ETD", "ETD");
            $query = "select distinct Titre_Album, Album.Code_Album  from Album
inner join Disque on Disque.Code_Disque=Album.Code_Album
inner join Composition_Disque on Disque.Code_Disque=Composition_Disque.Code_Disque
inner join  Enregistrement on Enregistrement.Code_Morceau=Composition_Disque.Code_Morceau
inner join Interpréter on Interpréter.Code_Morceau=Enregistrement.Code_Morceau
where Interpréter.Code_Musicien=" . $_GET['Code'];
            foreach ($pdo->query($query) as $row) {
                echo '<b>Nom</b> : ' . $row['Titre_Album'] . "<br>";
                echo "<img src='photoAlbum.php?Code=" . $row['Code_Album'] . "'> <br>";
            }
            $pdo = null;
            ?>

        </div>
    </div>
    <script>
        jQuery(document).ready(function () {
            var duration = 500;
            jQuery(window).scroll(function () {
                if (jQuery(this).scrollTop() > 100) {
                    // Si un défillement de 100 pixels ou plus.
                    // Ajoute le bouton
                    jQuery('.cRetour').fadeIn(duration);
                } else {
                    // Sinon enlève le bouton
                    jQuery('.cRetour').fadeOut(duration);
                }
            });

            jQuery('.cRetour').click(function (event) {
                // Un clic provoque le retour en haut animé.
                event.preventDefault();
                jQuery('html, body').animate({scrollTop: 0}, duration);
                return false;
            })
        });
    </script>
    <div class="cRetour"></div>
</body>
</html>