<?php
?>
<html lang="eng">
<head>
    <style>
        h2 {
            font-family: Arial, Helvetica, sans-serif;
        }

        input[type="submit"] {
            background-color: #DAC0A3;
            border: 0;
            border-radius: 3%;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="text"] {
            background-color: white;
            border: solid black 5px;
            border: 0;
            padding: 10px 10px;
            border-radius: 3%;
        }

        input[type="date"] {
            background-color: white;
            border: solid black 5px;
            border: 0;
            padding: 10px 10px;
            border-radius: 3%;
        }

        select{
            background-color: white;
            border: solid black 5px;
            border: 0;
            padding: 10px 10px;
            border-radius: 3%;
        }
        #box {
            background-color: #EADBC8;
            padding: 50px;
            width: 16%;
            border-radius: 3%;
            border: black solid 3px;
            text-align: center;
        }

        .footer{
            position: fixed;
            left: 0;
            bottom: 0;
        }
    </style>
</head>
<body>
<?php
require 'partials/nav.php';
?>
<main>
    <br/><br/><br/><br/>
    <section id="box">
        <h2>School</h2>
        <hr>
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
<!--            Selecteer de mogelijk al eerder ingevoerde waarde uit de db-->
            <select name="school" id="school">
                <option value="" disabled selected>School</option>
                <option value="Windesheim">Windesheim</option>
                <option value="ICT Campus">ICT Campus</option>
                <option value="ROC">ROC</option>
            </select><br/><br/>
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <!--Misschien niveau een apparte tabel maken in de db of ergens anders dan bij scholen??-->
            <!--            Selecteer de mogelijk al eerder ingevoerde waarde uit de db-->

            <select name="niveau" id="niveau">
                <option value="" disabled selected>Niveau</option>
                <option value="Mavo">Mavo</option>
                <option value="Havo">Havo</option>
                <option value="VWO">VWO</option>
            </select><br/><br/>
            <input type="text" name="diploma" value=""><br/><br/>
            <input type="date" name="startdatum" value=""> <br/><br/>
            <input type="date" name="einddatum" value=""> <br/><br/>
            <input type="submit" name="schoolSubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h1>Hobby's</h1>
        <hr>
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <!--            Selecteer de mogelijk al eerder ingevoerde waarde uit de db-->
            <select name="hobby" id="hobby">
                <option value="" disabled selected>Hobby</option>
                <option value="Voetballen">Voetballen</option>
                <option value="Schaken">Schaken</option>
                <option value="Gamen">Gamen</option>
            </select><br/><br/>
            <input type="file" name="foto"><br/><br/>
            <input type="text" name="beschrijving" value="" maxlength="100"><br/><br/>
            <input type="submit" name="hobbySubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h2>Werk</h2>
        <hr>
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <!--            Selecteer de mogelijk al eerder ingevoerde waarde uit de db-->
            <select name="bedrijf" id="bedrijf">
                <option value="" disabled selected>Bedrijf</option>
                <option value="@AllArt">@AllArt</option>
                <option value="ING">ING</option>
                <option value="The Koole Company">The Koole Company</option>
            </select><br/><br/>
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <!--Misschien locatie een apparte tabel maken in de db of ergens anders dan bij bedrijf??-->
            <!--            Selecteer de mogelijk al eerder ingevoerde waarde uit de db-->
            <select name="locatie" id="locatie">
                <option value="" disabled selected>Locatie</option>
                <option value="Naarden">Naarden</option>
                <option value="Hilversum">Hilversum</option>
                <option value="Nederhorst den Berg">Nederhorst den Berg</option>
            </select><br/><br/>
            <input type="text" name="functietitel" value=""><br/><br/>
            <input type="date" name="startdatum" value=""> <br/><br/>
            <input type="date" name="startdatum" value=""> <br/><br/>
            <input type="submit" name="schoolSubmit" value="Toepassen">
        </form>
    </section>
</main>
<?php
require 'partials/footer.php';
?>
</body>
</html>
