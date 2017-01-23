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
                        <li><a href="Compositeur.php#menu">Compositeurs</a></li>
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
        if (isset($_SESSION["NOM_USER"]))
        {
            echo '<li>';
            echo "Bonjour ".$_SESSION["NOM_USER"];
            echo'</li>';
            echo '<li> <a href="panier.php"> Panier <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>';
            echo '</li>';
            echo '<li>';
            echo '<a href="Deconnexion.php"> Deconnexion </a>';
        }
        else{
            $url = $_SERVER["REQUEST_URI"];
            echo '<li>';
            echo '<a href="connexion.php?url='.$url.'">Connexion</a>';
            echo '</li>';
            echo '<li>';
            echo '<a href="Inscription.php?url=' . $url . '"> Inscription </a>';
            echo '</li>' ;
        }
        echo '</ul>';
        echo '</div>';
        ?>
    </header>

    <div id="content">
        <div id="recherche">
            <form method="post" action="Compositeur_rep.php">
                <input name="nom" type="text"/>
                <button type="submit"> <i class="fa fa-search" aria-hidden="true"> </i> </button>
            </form>
        </div>



    <div id="content">


        <?php
        // Paramètres de connexion
        $driver = 'sqlsrv';
        $host = 'INFO-SIMPLET';
        $nomDb = 'Classique_Web';
        $user = 'ETD';
        $password = 'ETD';
        // Chaîne de connexion
        $pdodsn = "$driver:Server=$host;Database=$nomDb";
        $pdo = new PDO($pdodsn, $user, $password);
        $query = "Select Distinct Nom_Musicien, Prénom_Musicien, Musicien.Code_Musicien , Pays.Nom_Pays
                  from Musicien
                  INNER JOIN Pays ON Musicien.Code_Pays=Pays.Code_Pays
                  INNER JOIN Composer ON Musicien.Code_Musicien=Composer.Code_Musicien
                  order by Nom_Musicien  ";
        foreach($pdo->query($query) as $row){
            echo'<div class="musicien">';
            echo '<b>Nom</b> : '.$row['Nom_Musicien'].' '.$row[utf8_decode('Prénom_Musicien')]. "<br>";
            echo '<b>Pays :</b>'.$row['Nom_Pays'].'</br>';
            echo '<a href="Detail.php?Code='.$row['Code_Musicien'].'"> <img src="photoMusicien.php?Code='.$row['Code_Musicien'].'"> </a> <br>';
            echo '</div>';
        }
        $pdo=null;
        ?>
    </div>
</div>
    </div>
<script>
    jQuery(document).ready(function() {
        var duration = 500;
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > 100) {
                // Si un défillement de 100 pixels ou plus.
                // Ajoute le bouton
                jQuery('.cRetour').fadeIn(duration);
            } else {
                // Sinon enlève le bouton
                jQuery('.cRetour').fadeOut(duration);
            }
        });

        jQuery('.cRetour').click(function(event) {
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
