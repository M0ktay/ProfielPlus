<?php
//sessie word gestart
session_start();
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

    input[type="number"] {
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
//navbar word toegevoegd
require 'partials/nav.php';

//database connectie word aangeroepen
require '../controllers/dbconnectie.php';

//alle data van scholen word opgehaald
$query = "SELECT * FROM scholen";
$stmt = $conn->prepare($query);
$stmt->execute();
$scholen = $stmt->fetchAll();

//alle data van niveau word opgehaald
$query = "SELECT * FROM niveau";
$stmt = $conn->prepare($query);
$stmt->execute();
$niveaus = $stmt->fetchAll();

//alle data van hobby word opgehaald
$query = "SELECT * FROM hobby";
$stmt = $conn->prepare($query);
$stmt->execute();
$hobbys = $stmt->fetchAll();

//alle data van bedrijf word opgehaald
$query = "SELECT * FROM bedrijf";
$stmt = $conn->prepare($query);
$stmt->execute();
$bedrijven = $stmt->fetchAll();

//alle data van vakken word opgehaald
$query = "SELECT * FROM vakken";
$stmt = $conn->prepare($query);
$stmt->execute();
$vakken = $stmt->fetchAll();

//Hier word gecheckt of de id van de gebruiker in de sessie staat, oftewel of er is ingelogd
if(isset($_SESSION['gebruiker_id'])){
    $gebruikers_id = $_SESSION['gebruiker_id'];
}else {
    header("location: ../controllers/inloggen.php");
}

//Hier word gecheckt of de submit knop van het form voor school is ingedrukt
if(isset($_POST["schoolSubmit"])) {
//    Hier worden alle ingevulde velden omgezet naar variables
    $schoolnaam = $_POST["school"];
    $niveauschool = $_POST["niveau"];
    $diploma = isset($_POST['is_active']) ? 1 : 0;
    $startDatumschool = $_POST["startdatumschool"];
    $eindDatumschool = $_POST["einddatumschool"];

//    Hier worden de ingevoerde waardes in de database gezet
    $query = "INSERT INTO gebruiker_heeft_scholen (gebruikers_id, scholen_id, niveau_id, diploma, startDatum, eindDatum) 
VALUES('$gebruikers_id','$schoolnaam', '$niveauschool', '$diploma', '$startDatumschool', '$eindDatumschool');";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}
// hier word gezorgd dat de foto en de beschrijving leeg kunnen blijven
$foto = "";
$beschrijving = "";
//Hier word gecheckt of de submit knop van het form voor hobby's is ingedrukt
if(isset($_POST["hobbySubmit"])) {
    //    Hier worden alle ingevulde velden omgezet naar variables
    $hobbyid = $_POST["hobby"];
    $foto = $_POST["foto"];
    $beschrijving = $_POST["beschrijving"];
//    Hier worden de ingevoerde waardes in de database gezet
    $query = "INSERT INTO gebruiker_heeft_hobby (hobby_id, gebruikers_id, afbeelding, beschrijving) 
VALUES('$hobbyid', '$gebruikers_id', '$foto', '$beschrijving');";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}
//Hier word gecheckt of de submit knop van het form voor werk is ingedrukt
if(isset($_POST["werkSubmit"])) {
    //    Hier worden alle ingevulde velden omgezet naar variables
    $bedrijfid = $_POST["bedrijf"];
    $locatie = $_POST["locatie"];
    $functietitel = $_POST['functietitel'];
    $startDatumwerk = $_POST["startdatumwerk"];
    $eindDatumwerk = $_POST["einddatumwerk"];
//    Hier worden de ingevoerde waardes in de database gezet
    $query = "INSERT INTO gebruiker_heeft_bedrijf (gebruikers_id, bedrijf_id, startDatum, eindDatum, functieTitel, locatie ) 
VALUES('$gebruikers_id', '$bedrijfid', '$startDatumwerk', '$eindDatumwerk', '$functietitel', '$locatie');";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}

//Hier word gecheckt of de submit knop van het form voor vakken is ingedrukt
if(isset($_POST["vakSubmit"])) {
    //    Hier worden alle ingevulde velden omgezet naar variables
    $schoolVak = $_POST["vak"];
    $cijfer = $_POST["cijfer"];
//    Hier worden de ingevoerde waardes in de database gezet
    $query = "INSERT INTO gebruiker_heeft_vakken (gebruikers_id, vakken_id, cijfer) 
VALUES('$gebruikers_id', '$schoolVak', '$cijfer');";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}

?>
<main>
    <br/><br/><br/><br/>
    <section id="box">
        <h2>School</h2>
        <hr>
<!--        Hier is het formulier voor school-->
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">

        <select name="school" id="school" required>
            <option value="" disabled selected>School</option>
<!--            Hier word door alle scholen geloopt-->
        <?php
            foreach($scholen as $school){
                    echo "<option value='$school[0]'>";
                    echo $school['naam'] . "</option>";
            }
        ?>
        </select>
            <br/>
<!--            Als je school er niet tussen staat kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=School">School toevoegen</a>
            <br/><br/>

            <select name="niveau" id="niveau" required>
            <option value="" disabled selected>Niveau</option>
                <?php
//                 Hier word door alle niveaus geloopt
                foreach($niveaus as $niveau){
                    echo "<option value='$niveau[0]'>";
                    echo $niveau['naam'] . "</option>";
                    }
                    ?>
        </select>
            <br/>
            <!--            Als je niveau er niet tussen staat kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=Niveau">Niveau toevoegen</a><br/><br/>
<!--            de checkbox voor of je je diploma ervoor heb gehaald ja of nee-->
            <input type="checkbox" id="diploma" name="diploma" value="1">
            <label for="diploma">Diploma?</label><br><br/>
<!--            Invulveld voor startdatum en als je er opklikt word het een datum invoerveld-->
        <input type="text" name="startdatumschool" placeholder="Startdatum"
               onfocus="(this.type='date')" required> <br/><br/>
            <!--            Invulveld voor einddatum en als je er opklikt word het een datum invoerveld-->
        <input type="text" name="einddatumschool" placeholder="Einddatum"
               onfocus="(this.type='date')" required> <br/><br/>
        <input type="submit" name="schoolSubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h1>Hobby's</h1>
        <hr>
<!--        formulier voor hobby's-->
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="hobby" id="hobby" required>
                <option value="" disabled selected>Hobby</option>
                <?php
//                hier word door alle hobbys geloopd
                foreach($hobbys as $hobby){
                    echo "<option value='$hobby[0]'>";
                    echo $hobby['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
<!--            Als je hobby er niet tussenstaat kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=Hobby">Hobby toevoegen</a><br/><br/>
<!--            invoerveld voor je eventuele foto van je hobby-->
            <input type="file" name="foto" placeholder="Foto"><br/><br/>
<!--            invoerveld voor een eventuele beschrijving-->
            <input type="text" name="beschrijving" placeholder="Beschrijving" maxlength="100"><br/><br/>
            <input type="submit" name="hobbySubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h2>Werk</h2>
        <hr>
<!--        formulier voor werk-->
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="bedrijf" id="bedrijf" required>
                <option value="" disabled selected>Bedrijf</option>
<!--                Hier word door alle bedrijven heen geloopd-->
                <?php
                foreach($bedrijven as $bedrijf){
                    echo "<option value='$bedrijf[0]'>";
                    echo $bedrijf['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
<!--            Als je bedrijf er niet tussenstaat kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=Bedrijf">Bedrijf toevoegen</a>
            <br/><br/>

            <input type="text" name="locatie" placeholder="Locatie" required><br/><br/>
            <input type="text" name="functietitel" placeholder="Functietitel" required><br/><br/>
            <!--            Invulveld voor startdatum en als je er opklikt word het een datum invoerveld-->
            <input type="text" name="startdatumwerk" placeholder="Startdatum"
                   onfocus="(this.type='date')" required> <br/><br/>
            <!--            Invulveld voor einddatum en als je er opklikt word het een datum invoerveld-->
            <input type="text" name="einddatumwerk" placeholder="Einddatum"
                   onfocus="(this.type='date')" required> <br/><br/>
            <input type="submit" name="werkSubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h2>Vak</h2>
        <hr>
<!--        formulier voor vakken-->
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="vak" id="vak" required>
                <option value="" disabled selected>Vak</option>
<!--                Hier word door alle vakken heen geloopd-->
                <?php
                foreach($vakken as $vak){
                    echo "<option value='$vak[0]'>";
                    echo $vak['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
<!--            Als je vak er niet tussenstaat kun je hem zelf toevoegen via deze link-->
            <a href="selecttoevoegen.php?toevoegen=Vak">Vak toevoegen</a>
            <br/><br/>
            <input name="cijfer" type="number" step="0.01" inputmode="numeric" placeholder="Cijfer" required><br/><br/>
            <input type="submit" name="vakSubmit" value="Toepassen">
        </form>
    </section>
</main>
<?php
//hier word de footer toegevoegd
require 'partials/footer.php';
?>
</body>
</html>
