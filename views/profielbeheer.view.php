<?php
//sessie word gestart
session_start();
?>
<html lang="eng">
<head>
    <link rel="stylesheet" href="/views/style/profielaanmaken.style.css">
</head>
<body>
<?php
//navbar word toegevoegd
require 'partials/nav.php';

//hier word de database connectie gelinkt
require '../controllers/dbconnectie.php';


//Hier word alle data van scholen opgehaald
$query = "SELECT * FROM scholen";
$stmt = $conn->prepare($query);
$stmt->execute();
$scholen = $stmt->fetchAll();

//Hier word alle data van niveau opgehaald
$query = "SELECT * FROM niveau";
$stmt = $conn->prepare($query);
$stmt->execute();
$niveaus = $stmt->fetchAll();

//Hier word alle data van hobby opgehaald
$query = "SELECT * FROM hobby";
$stmt = $conn->prepare($query);
$stmt->execute();
$hobbys = $stmt->fetchAll();

//Hier word alle data van bedrijf opgehaald
$query = "SELECT * FROM bedrijf";
$stmt = $conn->prepare($query);
$stmt->execute();
$bedrijven = $stmt->fetchAll();

//Hier word alle data van vakken opgehaald
$query = "SELECT * FROM vakken";
$stmt = $conn->prepare($query);
$stmt->execute();
$vakken = $stmt->fetchAll();

//Hier word gecheckt of de gebruiker id in de sessie zit oftewel, of er is ingelogd
if(isset($_SESSION['gebruiker_id'])){
    $gebruikers_id = $_SESSION['gebruiker_id'];
}else {
    header("location: ../controllers/inloggen.php");
}
//hier word de id uit de get gehaald
$id = $_GET["id"];
//Als de id niet in de get zit dan word je weggeleid
if($id == 0){
    header("location: ../controllers/inloggen.php");
}

//Hier word er in een variable gezet wat er geupdate wilt worden
$edit = $_GET["edit"];

//Hier word gecheckt of er op de submit knop van school is geklikt en of de get overeen komt
if(isset($_POST["schoolSubmit"]) && $edit == "school") {
    //    Hier worden de ingevoerde waardes omgezet naar variables
    $schoolnaam = $_POST["school"];
    $niveauschool = $_POST["niveau"];
    $diploma = isset($_POST['is_active']) ? 1 : 0;
    $startDatumschool = $_POST["startdatumschool"];
    $eindDatumschool = $_POST["einddatumschool"];

//    Hier worden de nieuwe waardes geupdate in de database
    $query = "UPDATE gebruiker_heeft_scholen SET scholen_id = '$schoolnaam', niveau_id = '$niveauschool', diploma = '$diploma', startDatum = '$startDatumschool', eindDatum = '$eindDatumschool' WHERE gebruikers_id = $gebruikers_id AND id = $id;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}
//Hier word gecheckt of er op de submit knop van hobby is geklikt en of de get overeen komt
if(isset($_POST["hobbySubmit"]) && $edit == "hobby") {
    //    Hier worden de ingevoerde waardes omgezet naar variables
    $hobbyid = $_POST["hobby"];
    $foto = $_POST["foto"];
    $beschrijving = $_POST["beschrijving"];
//    Hier worden de nieuwe waardes geupdate in de database
    $query = "UPDATE gebruiker_heeft_hobby SET hobby_id = '$hobbyid', afbeelding = '$foto', beschrijving = '$beschrijving' WHERE gebruiker_id = $gebruikers_id AND id = $id;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}
//Hier word gecheckt of er op de submit knop van bedrijf is geklikt en of de get overeen komt
if(isset($_POST["werkSubmit"]) && $edit == "bedrijf") {
    //    Hier worden de ingevoerde waardes omgezet naar variables
    $bedrijfid = $_POST["bedrijf"];
    $locatie = $_POST["locatie"];
    $functietitel = $_POST['functietitel'];
    $startDatumwerk = $_POST["startdatumwerk"];
    $eindDatumwerk = $_POST["einddatumwerk"];

//    Hier worden de nieuwe waardes geupdate in de database
    $query = "UPDATE gebruiker_heeft_bedrijf SET bedrijf_id = '$bedrijfid', startDatum = '$startDatumwerk', eindDatum = '$eindDatumwerk', functieTitel = '$functietitel', locatie = '$locatie' WHERE gebruikers_id = $gebruikers_id AND id = $id;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}

//Hier word gecheckt of er op de submit knop van vakken is geklikt en of de get overeen komt
if(isset($_POST["vakSubmit"]) && $edit == "vak") {
//    Hier worden de ingevoerde waardes omgezet naar variables
    $schoolVak = $_POST["vak"];
    $cijfer = $_POST["cijfer"];

    //    Hier worden de nieuwe waardes geupdate in de database
    $query = "UPDATE  gebruiker_heeft_vakken SET vakken_id = '$schoolVak', cijfer = '$cijfer' WHERE gebruikers_id = $gebruikers_id AND id = $id;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}

?>
<main>
    <article class="grid-container">
    <section id="box">
        <h2>School</h2>
        <hr>
<!--        Formulier voor school-->
        <form method="POST" href="../controllers/profielbeheer.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="school" id="school" required>
                <option value="" disabled selected>School</option>
                <?php
//Hier word geloopd door alle scholen heen en de al eerder ingevoerde waarde als eerste laten zien
                    foreach ($scholen as $school) {
                        if ($gebruikerScholen['scholen_id'] == $school['id']) {
                            echo "<option value='" . $school['id'] . "' selected>";
                            echo $school['naam'] . "</option>";
                        } else {
                            echo "<option value='" . $school['id'] . "'>";
                            echo $school['naam'] . "</option>";
                        }
                    }

                ?>
            </select>
            <br/>
            <!--            Als je school er niet tussenstaat dan kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=School">School toevoegen</a>
            <br/><br/>
            <!--Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <!--Misschien niveau een apparte tabel maken in de db of ergens anders dan bij scholen??-->
            <select name="niveau" id="niveau" required>
                <option value="" disabled selected>Niveau</option>

                <?php
                //Hier word geloopd door alle niveau heen en de al eerder ingevoerde waarde als eerste laten zien
                foreach($niveaus as $niveau){
                    if ($gebruikerScholen['niveau_id'] == $niveau['id']){
                        echo "<option value='$niveau[0]' selected>";
                        echo $niveau['naam'] . "</option>";
                    }
                    echo "<option value='$niveau[0]'>";
                    echo $niveau['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
<!--            Als je school er niet tussenstaat dan kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=Niveau">Niveau toevoegen</a><br/><br/>
            <input type="checkbox" id="diploma" name="diploma" >
            <label for="diploma">Diploma?</label><br><br/>
            <input type="text" name="startdatumschool" placeholder="Startdatum"
                   onfocus="(this.type='date')" required> <br/><br/>
            <input type="text" name="einddatumschool" placeholder="Einddatum"
                   onfocus="(this.type='date')" required> <br/><br/>
            <input type="submit" name="schoolSubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h1>Hobby's</h1>
        <hr>
        <!--        Formulier voor hobby-->
        <form method="POST" href="../controllers/profielbeheer.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="hobby" id="hobby" required>
                <option value="" disabled selected>Hobby</option>
                <?php
                //Hier word geloopd door alle hobbys heen en de al eerder ingevoerde waarde als eerste laten zien
                foreach($hobbys as $hobby){
                    echo "<option value='$hobby[0]'>";
                    echo $hobby['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
            <!--            Als je school er niet tussenstaat dan kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=Hobby">Hobby toevoegen</a><br/><br/>
            <input type="file" name="foto" placeholder="Foto"><br/><br/>
            <input type="text" name="beschrijving" placeholder="Beschrijving" maxlength="100"><br/><br/>
            <input type="submit" name="hobbySubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h2>Werk</h2>
        <hr>
        <!--        Formulier voor werk-->
        <form method="POST" href="../controllers/profielbeheer.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="bedrijf" id="bedrijf" required>
                <option value="" disabled selected>Bedrijf</option>
                <?php
                //Hier word geloopd door alle bedrijven heen en de al eerder ingevoerde waarde als eerste laten zien
                foreach($bedrijven as $bedrijf){
                    echo "<option value='$bedrijf[0]'>";
                    echo $bedrijf['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
            <!--            Als je school er niet tussenstaat dan kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=Bedrijf">Bedrijf toevoegen</a>
            <br/><br/>
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <!--Misschien locatie een apparte tabel maken in de db of ergens anders dan bij bedrijf??-->
            <input type="text" name="locatie" placeholder="Locatie" required><br/><br/>
            <input type="text" name="functietitel" placeholder="Functietitel" required><br/><br/>
            <input type="text" name="startdatumwerk" placeholder="Startdatum"
                   onfocus="(this.type='date')" required> <br/><br/>
            <input type="text" name="einddatumwerk" placeholder="Einddatum"
                   onfocus="(this.type='date')" required> <br/><br/>
            <input type="submit" name="werkSubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h2>Vak</h2>
        <hr>
        <!--        Formulier voor vakken-->
        <form method="POST" href="../controllers/profielbeheer.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="vak" id="vak" required>
                <option value="" disabled selected>Vak</option>
                <?php
                //Hier word geloopd door alle vakken heen en de al eerder ingevoerde waarde als eerste laten zien
                foreach($vakken as $vak){
                    echo "<option value='$vak[0]'>";
                    echo $vak['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
            <!--            Als je school er niet tussenstaat dan kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=Vak">Vak toevoegen</a>
            <br/><br/>
            <input name="cijfer" type="number" step="0.01" inputmode="numeric" ><br/><br/>
            <input type="submit" name="vakSubmit" value="Toepassen">
        </form>
    </section>
    </article>
</main>
<?php

//Hier word de footer toegevoegd
require 'partials/footer.php';
?>
</body>
</html>
