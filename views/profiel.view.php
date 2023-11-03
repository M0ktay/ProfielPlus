<?php

require 'C:\Users\Meriç\Desktop\School\ProfielPlus\controllers\dbconnectie.php';

$query = "SELECT * FROM gebruikers where id = 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikers = $stmt->fetchAll();
//die(var_dump($gebruikers));

$query = "select hobby.*, gebruiker_heeft_hobby.*
from hobby
join gebruiker_heeft_hobby
on hobby.id = gebruiker_heeft_hobby.gebruikers_id WHERE gebruikers_id = 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikersHobby = $stmt->fetchAll();
//die(var_dump($gebruikersHobby));


$query = "SELECT scholen.*, gebruiker_heeft_scholen.*, niveau.id, niveau.naam AS niveauNaam
FROM scholen
JOIN gebruiker_heeft_scholen ON scholen.id = gebruiker_heeft_scholen.scholen_id
JOIN niveau ON gebruiker_heeft_scholen.niveau_id = niveau.id
WHERE gebruikers_id = 1;";
$stmt = $conn->prepare($query);
$stmt->execute();
$scholen = $stmt->fetchAll();
//die(var_dump($scholen));

$query = "select gebruikers.*, gebruiker_heeft_bedrijf.*, bedrijf.id, bedrijf.naam as bedrijfNaam
from bedrijf
join gebruiker_heeft_bedrijf
on bedrijf.id = gebruiker_heeft_bedrijf.bedrijf_id
join gebruikers on gebruikers.id = gebruiker_heeft_bedrijf.gebruikers_id
WHERE gebruikers_id = 1;";
$stmt = $conn->prepare($query);
$stmt->execute();
$bedrijven = $stmt->fetchAll();
//die(var_dump($bedrijven));
?>

<html>
<head>
    <link rel="stylesheet" href="./style/profiel.style.css">
</head>
<body>
<main>
    <section>
        <article class="profiel">
            <article class="Persoon"><p>Profiel<p></article>
            <article class="grid-container">
            <article class="Persoonsgegevens">
                <div class="tag">Gebruikersnaam:</div><div class="gegevens">
                    <?php
                    foreach ($gebruikers as $gebruiker){
                        echo $gebruiker['gebruikersnaam'];
                        echo "<hr class='hrBlue'>" . "<div class='tag'>Voornaam:</div><div class='gegevens'>" . $gebruiker['voornaam'] . "</div>" . "<hr class='hrBlue'>";
                        echo "<div class='tag'>Achternaam:</div><div class='gegevens'>" . $gebruiker['achternaam'] . "</div>" . "<hr class='hrBlue'>";
                        echo "<div class='tag'>Email:</div><div class='gegevens'>" . $gebruiker['email'] . "</div>" . "<hr class='hrBlue'>";
                    }
                    ?>
                </div>
            </article>
            <article class="schoolPrestaties">
                <div class="Huidige">Huidige
                        <?php
                            foreach ($scholen as $school){
                                if (empty($school['eindDatum'])) {
                                    echo "<div class='tag'>Schoolnaam:</div><div class='gegevens' >" . $school['naam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Niveau:</div><div class='gegevens'>" . $school['niveauNaam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Startdatum:</div><div class='gegevens' >" . $school['startDatum'] . "</div>" . "<hr class='hrBlue'>";
                                }
                            }
                        ?>
                </div>
                    <!--link naar pagina met alle vakken en cijfers-->
                    <a href="#">vakken</a>
                <div class="Afgerond">Afgerond
                        <?php
                            foreach ($scholen as $school) {
                                if (!empty($school['eindDatum'])) {
                                    echo "<div class='tag'>Schoolnaam:</div><div class='gegevens'>" . $school['naam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Diploma's:</div><div class='gegevens'>" . $school['diploma'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Startdatum:</div><div class='gegevens' >" . $school['startDatum'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Einddatum:</div><div class='gegevens' >" . $school['eindDatum'] . "</div>" . "<hr class='hrBlue'>";
                                }
                        }
                        ?>
                </div>
            </article>
            <article class="hobbys"><b>Hobby's</b>
                <div class="hobbyWrap">
                    <?php
                    foreach ($gebruikersHobby as $hobby){
                        echo "<div class='hobby'>" . $hobby['naam'] . "</div>" . "<div class='beschrijving'>" . $hobby['beschrijving'] . "<img class='hobbyImg' src='hobby_temp_img.jpg'>" . "</div>" . "<hr class='hrBlue'>";
                    }
                    ?>
            </article>
                <article class="werkErvaring">
                    <div class="Huidige">Huidig Werk
                    <?php
                    foreach ($bedrijven as $bedrijf) {
                        if (empty($bedrijf['eindDatum'])) {
                            echo "<div class='tag'>Werkplaats:</div>" . $bedrijf['bedrijfNaam'] . "<hr class='hrBlue'>" . "<div class='tag'>Functietitel:</div>" . $bedrijf['functieTitel'] . "<hr class='hrBlue'>" . "<div class='tag'>StartDatum:</div>" . $bedrijf['startDatum'] . "<hr class='hrBlue'>";
                        }
                    }
                    ?>
                    </div>
                    <div class="Gestopt">Gestopt Werk
                        <?php
                        foreach ($bedrijven as $bedrijf) {
                            if (!empty($bedrijf['eindDatum'])) {
                                echo "<div class='tag'>Werkplaats:</div>" . $bedrijf['bedrijfNaam'] . "<hr class='hrBlue'>" . "<div class='tag'>Functietitel:</div>" . $bedrijf['functieTitel'] . "<hr class='hrBlue'>" . "<div class='tag'>StartDatum:</div>" . $bedrijf['startDatum'] . "<hr class='hrBlue'>" . "<div class='tag'>EindDatum</div>" . $bedrijf['eindDatum'] . "<hr class='hrBlue'>";
                            }
                        }
                        ?>
                    </div>
                </article>
    </section>
</main>
</body>
<footer>
</footer>
</html>