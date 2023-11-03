<?php

session_start();
require '../controllers/dbconnectie.php';

$id = $_GET['id'];

if (isset($_SESSION['gebruiker_id'])) {
$user_id = $_SESSION['gebruiker_id'];

    $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE id = ?");
    $stmt->execute([$user_id]);
    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($gebruiker) {
        $voornaam = $gebruiker['voornaam'];
        $achternaam = $gebruiker['achternaam'];
        $email = $gebruiker['email'];
        $gebruikersnaam = $gebruiker['gebruikersnaam'];

    }
}

$query = "SELECT * FROM gebruikers where id = $id";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikers = $stmt->fetchAll();
//die(var_dump($gebruikers));

$query = "select hobby.*, gebruiker_heeft_hobby.*
from hobby
join gebruiker_heeft_hobby
on hobby.id = gebruiker_heeft_hobby.gebruikers_id WHERE gebruikers_id = $id";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikersHobby = $stmt->fetchAll();
//die(var_dump($gebruikersHobby));


$query = "SELECT scholen.*, gebruiker_heeft_scholen.*, niveau.id, niveau.naam AS niveauNaam
FROM scholen
JOIN gebruiker_heeft_scholen ON scholen.id = gebruiker_heeft_scholen.scholen_id
JOIN niveau ON gebruiker_heeft_scholen.niveau_id = niveau.id
WHERE gebruikers_id = $id;";
$stmt = $conn->prepare($query);
$stmt->execute();
$scholen = $stmt->fetchAll();
//die(var_dump($scholen));

$query = "select gebruikers.*, gebruiker_heeft_bedrijf.*, bedrijf.id, bedrijf.naam as bedrijfNaam
from bedrijf
join gebruiker_heeft_bedrijf
on bedrijf.id = gebruiker_heeft_bedrijf.bedrijf_id
join gebruikers on gebruikers.id = gebruiker_heeft_bedrijf.gebruikers_id
WHERE gebruikers_id = $id;";
$stmt = $conn->prepare($query);
$stmt->execute();
$bedrijven = $stmt->fetchAll();
//die(var_dump($bedrijven));

$query = "select vakken.id as vakken_id , vakken.naam, gebruiker_heeft_vakken.*
from vakken
join gebruiker_heeft_vakken
on vakken.id = gebruiker_heeft_vakken.id
where gebruikers_id = $id;";
$stmt = $conn->prepare($query);
$stmt->execute();
$vakken = $stmt->fetchAll();
//die(var_dump($vakken));
?>

<html>
<head>
    <link rel="stylesheet" href="../views/style/profiel.style.css">
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
                        echo $gebruiker['gebruikersnaam'] . "<div class='edit-container'><?php if($id == $user_id){?><a href='../controllers/accountedit.php?id=$gebruiker[0]?edit=school' class='edit'>Edit</a></div><?php}?>";
                        echo "<hr class='hrBlue'>" . "<div class='tag'>Voornaam:</div><div class='gegevens'>" . $gebruiker['voornaam'] . "</div>"  . "<hr class='hrBlue'>";
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
                                    echo "<div class='tag'>Schoolnaam:</div><div class='gegevens' >" . $school['naam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Niveau:</div><div class='gegevens'>" . $school['niveauNaam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Startdatum:</div><div class='gegevens' >" . $school['startDatum'] . "</div>" . "<div class='edit-container'><?php if($id == $user_id){?><a href='../controllers/profielbeheer.php?id=$school[0]?edit=school' class='edit'>Edit</a></div><?php}?>" . "<hr class='hrBlue'>";
                                }
                            }
                        ?>
                </div>
                    <!--Popup met alle vakken en cijfers-->
                    <button id="myButton" class="lijst">Vakkenlijst</button>
                    <div id="myPopup" class="popup">
                        <div class="popup-content">
                            <h1 style="color:#0F2C59; ">
                                Vakken en cijferlijst.
                            </h1>
                            <p>
                            <table>
                                <tr>
                                    <th>Vak</th>
                                    <th>Cijfer</th>
                                </tr>
                                <?php
                                foreach ($vakken as $vakk) {
                                    echo "<tr>";
                                    echo "<td>" . $vakk['naam'] . "</td>";
                                    echo "<td>" . $vakk['cijfer'] . "<?php if($id == $user_id){?><a href='../controllers/profielbeheer.php?id=$school[0]?edit=vak' class='edit'>Edit</a></div><?php}?>" . "</td>";
                                    echo "</tr>";
                                }
                                echo "";
                                ?>
                            </table>
                            </p>
                            <button id="closePopup">
                                Close
                            </button>
                        </div>
                    </div>
                <div class="Afgerond">Afgerond
                        <?php
                            foreach ($scholen as $school) {
                                if (!empty($school['eindDatum'])) {
                                    echo "<div class='tag'>Schoolnaam:</div><div class='gegevens'>" . $school['naam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Diploma's:</div><div class='gegevens'>" . $school['diploma'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Startdatum:</div><div class='gegevens' >" . $school['startDatum'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Einddatum:</div><div class='gegevens' >" . $school['eindDatum'] . "</div>" . "<?php if($id == $user_id){?><a href='../controllers/profielbeheer.php?id=$school[0]?edit=school' class='edit'>Edit</a></div><?php}?>" . "<hr class='hrBlue'>";
                                }
                        }
                        ?>
                </div>
            </article>
            <article class="hobbys"><b>Hobby's</b>
                <div class="hobbyWrap">
                    <?php
                    foreach ($gebruikersHobby as $hobby){
                        echo "<div class='hobby'>" . $hobby['naam'] . "</div>" . "<div class='beschrijving'>" . $hobby['beschrijving'] . "</div>" .  "<?php if($id == $user_id){?><a href='../controllers/profielbeheer.php?id=$hobby[0]?edit=hobby' class='edit'>Edit</a></div><?php}?>" . "<hr class='hrBlue'>";
                    }
                    ?>
            </article>
                <article class="werkErvaring">
                    <div class="Huidige">Huidig Werk
                    <?php
                    foreach ($bedrijven as $bedrijf) {
                        if (empty($bedrijf['eindDatum'])) {
                            echo "<div class='tag'>Werkplaats:</div>" . $bedrijf['bedrijfNaam'] . "<hr class='hrBlue'>" . "<div class='tag'>Functietitel:</div>" . $bedrijf['functieTitel'] . "<hr class='hrBlue'>" . "<div class='tag'>StartDatum:</div>" . $bedrijf['startDatum'] .  "<?php if($id == $user_id){?><a href='../controllers/profielbeheer.php?id=$bedrijf[0]?edit=bedrijf' class='edit'>Edit</a></div><?php}?>" . "<hr class='hrBlue'>";
                        }
                    }
                    ?>
                    </div>
                    <div class="Gestopt">Gestopt Werk
                        <?php
                        foreach ($bedrijven as $bedrijf) {
                            if (!empty($bedrijf['eindDatum'])) {
                                echo "<div class='tag'>Werkplaats:</div>" . $bedrijf['bedrijfNaam'] . "<hr class='hrBlue'>" . "<div class='tag'>Functietitel:</div>" . $bedrijf['functieTitel'] . "<hr class='hrBlue'>" . "<div class='tag'>StartDatum:</div>" . $bedrijf['startDatum'] . "<hr class='hrBlue'>" . "<div class='tag'>EindDatum</div>" . $bedrijf['eindDatum'] .  "<?php if($id == $user_id){?><a href='../controllers/profielbeheer.php?id=$bedrijf[0]?edit=bedrijf' class='edit'>Edit</a></div><?php}?>" . "<hr class='hrBlue'>";
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
<script>
        myButton.addEventListener("click", function () {
        myPopup.classList.add("show");
    });
        closePopup.addEventListener("click", function () {
        myPopup.classList.remove("show");
    });
        window.addEventListener("click", function (event) {
        if (event.target == myPopup) {
        myPopup.classList.remove("show");
    }
    });
</script>