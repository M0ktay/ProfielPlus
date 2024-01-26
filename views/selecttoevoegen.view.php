<?php
//sessie word gestart
session_start();

//Nav word toegevoegd
require 'partials/nav.php';

//database word geconnect
require '../controllers/dbconnectie.php';

//Hier word uit de get gehaald wat er gewends word toegevoegd te worden
$toevoegen = $_GET["toevoegen"];

//Hier word gecheckt wat er gewends word toegevoegd te worden en dan word de variable gevuld zodat er maar 1 sql query nodig is
if($toevoegen == "School"){
    $dbWaarde = "scholen";
}elseif($toevoegen == "Niveau"){
    $dbWaarde = "niveau";
}elseif($toevoegen == "Hobby"){
    $dbWaarde = "hobby";
}elseif($toevoegen == "Bedrijf"){
    $dbWaarde = "bedrijf";
}elseif($toevoegen == "Vak"){
    $dbWaarde = "vakken";
}else{
//    Als er niet een valliede waarde in de get staat word je teruggeleid
    header("location: ../controllers/profielaanmaken.php");
}

//Hier word gecheckt of er op de submit knop is gedrukt
if(isset($_POST["submit"])){
//    Hier word de ingevoerde waarde in een variable gezet
    $ingevoerdeWaarde = $_POST["waarde"];

//    dit is een select query voor de gewendste tabel
    $query = "SELECT naam FROM $dbWaarde WHERE naam = :waarde ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':waarde', $ingevoerdeWaarde);
    $stmt->execute();

//    Hier word gecheckt of de waarde er niet al in staat
    if($stmt->rowCount() > 0) {
//        Als die er al tussen staat word er een alert gegeven
        $bericht = "Deze staat al tussen de opties";
        echo "<script type='text/javascript'>alert('$bericht');</script>";
    }else{
//        Als de waarde er nog niet in staat dan word die toegevoegd aan de gewendse tabel
        $query = "INSERT INTO $dbWaarde (naam) 
        VALUES('$ingevoerdeWaarde');";
        $stmt = $conn->prepare($query);
        $stmt->execute();
//na het toevoegen word je terug geleid
        header("location: ../controllers/profielaanmaken.php");
    }
}
?>
<html lang="eng">
<head>
    <link rel="stylesheet" href="/views/style/style.css">
</head>
<body>
<main>
    <br/><br/><br/><br/>
    <section class="box">
        <h2><?php echo $toevoegen; ?></h2>
        <hr>
<!--        formulier voor het toevoegen in een gewendste tabel-->
        <form method="POST" >
            <input type="text" name="waarde" placeholder="<?php echo $toevoegen; ?>"><br/><br/>
            <input type="submit" name="submit" value="Toepassen">
        </form>
    </section>

</body>
<?php
//hier word de footer toegevoegd
require 'partials/footer.php';
?>