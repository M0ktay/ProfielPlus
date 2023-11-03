<?php
session_start();
?>
<html lang="eng">
<head>
    <link rel="stylesheet" href="../views/style/profielaanmaken.style.css">
</head>
<body>
<?php
require 'partials/nav.php';
require '../controllers/dbconnectie.php';

//hier worden de scholen opgehaald
$query = "SELECT * FROM scholen";
$stmt = $conn->prepare($query);
$stmt->execute();
$scholen = $stmt->fetchAll();

//hier worden de niveaus opgehaald
$query = "SELECT * FROM niveau";
$stmt = $conn->prepare($query);
$stmt->execute();
$niveaus = $stmt->fetchAll();

//hier worden de hobby's opgehaald
$query = "SELECT * FROM hobby";
$stmt = $conn->prepare($query);
$stmt->execute();
$hobbys = $stmt->fetchAll();

//hier worden de bedrijven opgehaald
$query = "SELECT * FROM bedrijf";
$stmt = $conn->prepare($query);
$stmt->execute();
$bedrijven = $stmt->fetchAll();

//hier worden de vakken opgehaald
$query = "SELECT * FROM vakken";
$stmt = $conn->prepare($query);
$stmt->execute();
$vakken = $stmt->fetchAll();

//hier worden de id opgehaald
if(isset($_SESSION['gebruiker_id'])){
    $gebruikers_id = $_SESSION['gebruiker_id'];
}else {
    header("location: ../controllers/inloggen.php");
}

// dit check of er submit is gedaan in de post
if(isset($_POST["schoolSubmit"])) {
    $schoolnaam = $_POST["school"];
    $niveauschool = $_POST["niveau"];
    $diploma = isset($_POST['is_active']) ? 1 : 0;
    $startDatumschool = $_POST["startdatumschool"];
    $eindDatumschool = $_POST["einddatumschool"];

    $query = "INSERT INTO gebruiker_heeft_scholen (gebruikers_id, scholen_id, niveau_id, diploma, startDatum, eindDatum) 
VALUES('$gebruikers_id','$schoolnaam', '$niveauschool', '$diploma', '$startDatumschool', '$eindDatumschool');";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}
$foto = "";
$beschrijving = "";
if(isset($_POST["hobbySubmit"])) {
    $hobbyid = $_POST["hobby"];
    $foto = $_POST["foto"];
    $beschrijving = $_POST["beschrijving"];

    $query = "INSERT INTO gebruiker_heeft_hobby (hobby_id, gebruikers_id, afbeelding, beschrijving) 
VALUES('$hobbyid', '$gebruikers_id', '$foto', '$beschrijving');";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}

if(isset($_POST["werkSubmit"])) {
    $bedrijfid = $_POST["bedrijf"];
    $locatie = $_POST["locatie"];
    $functietitel = $_POST['functietitel'];
    $startDatumwerk = $_POST["startdatumwerk"];
    $eindDatumwerk = $_POST["einddatumwerk"];

    $query = "INSERT INTO gebruiker_heeft_bedrijf (gebruikers_id, bedrijf_id, startDatum, eindDatum, functieTitel, locatie ) 
VALUES('$gebruikers_id', '$bedrijfid', '$startDatumwerk', '$eindDatumwerk', '$functietitel', '$locatie');";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}


if(isset($_POST["vakSubmit"])) {
    $schoolVak = $_POST["vak"];
    $cijfer = $_POST["cijfer"];

    $query = "INSERT INTO gebruiker_heeft_vakken (gebruikers_id, vakken_id, cijfer) 
VALUES('$gebruikers_id', '$schoolVak', '$cijfer');";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}

?>
<main>
 
    <article class="grid-container">
    <section id="box">
        <h2>School</h2>
        <hr>
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
<!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
        <select name="school" id="school" required>
            <option value="" disabled selected>School</option>
        <?php
            foreach($scholen as $school){
                    echo "<option value='$school[0]'>";
                    echo $school['naam'] . "</option>";
            }
        ?>
        </select>
            <br/>
            <a href="selecttoevoegen.php?toevoegen=School">School toevoegen</a>
            <br/><br/>
            <!--Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
<!--Misschien niveau een apparte tabel maken in de db of ergens anders dan bij scholen??-->
            <select name="niveau" id="niveau" required>
            <option value="" disabled selected>Niveau</option>
                <?php
                foreach($niveaus as $niveau){
                    echo "<option value='$niveau[0]'>";
                    echo $niveau['naam'] . "</option>";
                    }
                    ?>
        </select>
            <br/>
            <a href="selecttoevoegen.php?toevoegen=Niveau">Niveau toevoegen</a><br/><br/>
            <input type="checkbox" id="diploma" name="diploma" value="1">
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
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="hobby" id="hobby" required>
                <option value="" disabled selected>Hobby</option>
                <?php
                foreach($hobbys as $hobby){
                    echo "<option value='$hobby[0]'>";
                    echo $hobby['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
            <a href="selecttoevoegen.php?toevoegen=Hobby">Hobby toevoegen</a><br/><br/>
            <input type="file" name="foto" placeholder="Foto"><br/><br/>
            <input type="text" name="beschrijving" placeholder="Beschrijving" maxlength="100"><br/><br/>
            <input type="submit" name="hobbySubmit" value="Toepassen">
        </form>
    </section>

    <section id="box">
        <h2>Werk</h2>
        <hr>
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="bedrijf" id="bedrijf" required>
                <option value="" disabled selected>Bedrijf</option>
                <?php
                foreach($bedrijven as $bedrijf){
                    echo "<option value='$bedrijf[0]'>";
                    echo $bedrijf['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
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
        <form method="POST" href="../controllers/profielaanmaken.php">
            <input type="hidden" name="id" value="id uit get">
            <!--            Als die er niet tussen staat moet er een toevoeg mogelijkheid komen-->
            <select name="vak" id="vak" required>
                <option value="" disabled selected>Vak</option>
                <?php
                foreach($vakken as $vak){
                    echo "<option value='$vak[0]'>";
                    echo $vak['naam'] . "</option>";
                }
                ?>
            </select>
            <br/>
            <a href="selecttoevoegen.php?toevoegen=Vak">Vak toevoegen</a>
            <br/><br/>
            <input name="cijfer" type="number" step="0.01" inputmode="numeric" placeholder="Cijfer" required><br/><br/>
            <input type="submit" name="vakSubmit" value="Toepassen">
        </form>
    </section>
    </article>
</main>
<?php
require 'partials/footer.php';
?>
</body>
</html>
