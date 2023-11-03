<?php
session_start();

//require 'partials/nav.php';
require '../controllers/dbconnectie.php';

$toevoegen = $_GET["toevoegen"];

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
    header("location: ../controllers/profielaanmaken.php");
}

if(isset($_POST["submit"])){
    $ingevoerdeWaarde = $_POST["waarde"];

    $query = "SELECT naam FROM $dbWaarde WHERE naam = :waarde ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':waarde', $ingevoerdeWaarde);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $bericht = "Deze staat al tussen de opties";
        echo "<script type='text/javascript'>alert('$bericht');</script>";
    }else{
        $query = "INSERT INTO $dbWaarde (naam) 
        VALUES('$ingevoerdeWaarde');";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        header("location: ../controllers/profielaanmaken.php");
    }
}
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
<main>
    <br/><br/><br/><br/>
    <section id="box">
        <h2><?php echo $toevoegen; ?></h2>
        <hr>
        <form method="POST" >
            <input type="text" name="waarde" placeholder="<?php echo $toevoegen; ?>"><br/><br/>
            <input type="submit" name="submit" value="Toepassen">
        </form>
    </section>

</body>
<?php
require 'partials/footer.php';
?>