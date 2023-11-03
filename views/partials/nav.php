<?php

session_start();

?>
<html lang="eng">
<head>
    <style>
        body{
    background-color: #F8F0E5;
}

nav {
    z-index: 2;
}
        #navbar {
            overflow: hidden;
            background-color: #0F2C59;
            width: 100%;
            position: fixed;
            left: 0;
            top: 0;
            

        }
 
        #navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        #navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        #navbar a.active {
            background-color: #0F2C59;
            color: white;
        }

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

        .sticky + .content {
            padding-top: 60px;
        }

        .logo{
            height: 40px;
        }
    </style>
</head>
<body>

<header>
    <nav id="navbar">
        <!-- Hier word de afbeelding opgeroepen en als je op de afbeelding klikt dan ga je naar de home page -->
        <a class="active" href="../controllers/home.php"><img src="../views/partials/pf_logo.png" class="logo"></a>

        <?php 
        // Hier word gekeken of je ingelogd bent, als je dat bent zie je profiel en profiel aanmaken
        if (isset($_SESSION['gebruiker_id'])) { $id = $_SESSION['gebruiker_id'] ?>
            <a href="../controllers/profiel.php">Profiel</a>
            <a href="../controllers/profielaanmaken.php">Profiel aanmaken</a>
            <?php  ?>
            <a href="../controllers/uitloggen.php">Uitloggen</a>
            <!-- Als je niet ingelogd ben dan zie je inloggen en registreren en deze else zorgt daarvoor -->
        <?php } else { ?>
          
            <a href="../controllers/inloggen.php">Inloggen</a>
            <a href="../controllers/registreer.php">Registreren</a>
        <?php } ?>
    </nav>
</header>
</html>
</body>