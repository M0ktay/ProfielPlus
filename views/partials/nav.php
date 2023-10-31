<?php
?>
<html lang="eng">
<head>
    <style>
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
        <a class="active" href="../controllers/home.php"><img src="../views/partials/pf_logo.png" class="logo"></a>
<!--        alleen als je bent ingelogd-->
        <a href="../controllers/profiel.php">Profiel</a>
        <!--        Als je nog niks van je profiel heb ingevuld (school,werk of hobbys) dan moet dit er staan, anders niet-->
        <a href="../controllers/profielaanmaken.php">Profiel aanmaken</a>
<!--        Als je niet bent ingelogd = inloggen/registreren, als je bent ingelogd = uitloggen-->
        <a href="../controllers/inloggen.php">Uitloggen/Inloggen/Registreren</a>

    </nav>
</header>
</html>
</body>