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
        <div id="header_content">
            <div id="header_text">

                <div class="header_logo"><img src="assets/images/logo_couleur.jpg" alt="Logo"></div>

                <h1>site web de type e-commerce</h1>
            </div>
            <nav id="menu" class="show_menu">
                <ul id="main-menu">
                    <li><a href="index.html#menu">Accueil</a></li>
                    <li><a href="">Compositeurs</a></li>
                    <li><a href="">Interprètes</a></li>
                    <li><a href="">Chefs d'orchestre</a></li>
                    <li><a href="">Orchestres</a></li>
                    <li><a href="">Album</a></li>
                    <li><a href="Apropos.html">A propos</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div id="recherche">
        <form method="post" action="Compositeur_rep.php">
            <input name="nom" type="text">
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
        $query = "Select Nom_Musicien, Prénom_Musicien, Code_Musicien from Musicien where Nom_Musicien LIKE 'B%' order by Nom_Musicien ";
        foreach($pdo->query($query) as $row){
            echo '<b>Nom</b> : '.$row['Nom_Musicien'].' '.$row[utf8_decode('Prénom_Musicien')]. "<br>";
            echo "<img src='photoMusicien.php?Code=".$row['Code_Musicien']."'> <br>";
        }
        $pdo=null;
        ?>
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