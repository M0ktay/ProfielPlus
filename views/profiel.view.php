<?php
//navbar word toegevoegd
require 'partials/nav.php';
//footer word toegevoegd
require 'partials/footer.php';

//hier word de session gestart
session_start();

//database connectie word aangeroepen
require '../controllers/dbconnectie.php';

// hier word de id uit de session gehaald
if (isset($_SESSION['gebruiker_id'])) {
$user_id = $_SESSION['gebruiker_id'];

// hier word de gebruiker opgehaald uit de database
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

$query = "SELECT * FROM gebruikers where id = $user_id";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikers = $stmt->fetchAll();

//dit is om de hobby's op te halen
$query = "SELECT hobby.naam AS hobby_naam, gebruiker_heeft_hobby.*
FROM hobby
JOIN gebruiker_heeft_hobby ON hobby.id = gebruiker_heeft_hobby.Hobby_id
WHERE gebruiker_heeft_hobby.gebruikers_id = $user_id";

$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikersHobby = $stmt->fetchAll();

//dit is om de scholen, niveau en vakken op te halen
$query = "SELECT scholen.*, gebruiker_heeft_scholen.*, niveau.id, niveau.naam AS niveauNaam
FROM scholen
JOIN gebruiker_heeft_scholen ON scholen.id = gebruiker_heeft_scholen.scholen_id
JOIN niveau ON gebruiker_heeft_scholen.niveau_id = niveau.id
WHERE gebruikers_id = $user_id;";
$stmt = $conn->prepare($query);
$stmt->execute();
$scholen = $stmt->fetchAll();

//dit is om de bedrijven en werk op te halen
$query = "select gebruikers.*, gebruiker_heeft_bedrijf.*, bedrijf.id, bedrijf.naam as bedrijfNaam
from bedrijf
join gebruiker_heeft_bedrijf
on bedrijf.id = gebruiker_heeft_bedrijf.bedrijf_id
join gebruikers on gebruikers.id = gebruiker_heeft_bedrijf.gebruikers_id
WHERE gebruikers_id = $user_id;";
$stmt = $conn->prepare($query);
$stmt->execute();
$bedrijven = $stmt->fetchAll();

//dit is om de vakken op te halen
$query = "SELECT vakken.id AS vakken_id, vakken.naam, gebruiker_heeft_vakken.*
FROM vakken
JOIN gebruiker_heeft_vakken ON vakken.id = gebruiker_heeft_vakken.vakken_id
WHERE gebruiker_heeft_vakken.gebruikers_id = $user_id;";

$stmt = $conn->prepare($query);
$stmt->execute();
$vakken = $stmt->fetchAll();
?>

<html>
<head>
    <link rel="stylesheet" href="../views/style/profiel.style.css">
</head>
<body>
<main>
    <section>
        <article class="profiel">
            <article class="Persoon"></article>
            <article class="grid-container">
            <article class="Persoonsgegevens">
                <div class="tag">Gebruikersnaam:</div><div class="gegevens">
                    <?php
                    //hier word de for each gebruikt om de gebruiker te laten zien op het scherm
                    foreach ($gebruikers as $gebruiker){
                        echo $gebruiker['gebruikersnaam'];
                        if ($user_id== $user_id) {
                            //dit is de account edit knop
                            echo '<a href="../controllers/accountedit.php?id=' . $gebruiker['id'] . '" class="edit">Edit</a>';
                        }
                        echo "<hr class='hrBlue'>" . "<div class='tag'>Voornaam:</div><div class='gegevens'>" . $gebruiker['voornaam'] . "</div>"  . "<hr class='hrBlue'>";
                        echo "<div class='tag'>Achternaam:</div><div class='gegevens'>" . $gebruiker['achternaam'] . "</div>" . "<hr class='hrBlue'>";
                        echo "<div class='tag'>Email:</div><div class='gegevens'>" . $gebruiker['email'] . "</div>" . "<hr class='hrBlue'>";
                    }
                    ?>
                </div>
            </article>
            <article class="schoolPrestaties">
                <div class="Huidige">Huidige
                <hr class='hrBlue'>
                        <?php
                            //hier word de for each gebruikt om de school te laten zien op het scherm
                            foreach ($scholen as $school){
                                if (empty($school['eindDatum'])) {
                                    echo "<div class='tag'>Schoolnaam:</div><div class='gegevens' >" . $school['naam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Niveau:</div><div class='gegevens'>" . $school['niveauNaam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Startdatum:</div><div class='gegevens' >" . $school['startDatum'] . "</div>" . "<div class='edit-container'><?php if($user_id == $user_id){?><a href='../controllers/profielbeheer.php?id=$school[2]&edit=school' class='edit'>Edit</a></div><?php}?>" . "<hr class='hrBlue'>";
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
                                 //hier word de for each gebruikt om de vakken en cijfers te laten zien op het scherm
                                foreach ($vakken as $vakk) {
                                    echo "<tr>";
                                    echo "<td>" . $vakk['naam'] . "</td>";
                                    echo "<td>" . $vakk['cijfer'] . (($user_id == $user_id) ? "<a href='../controllers/profielbeheer.php?id=" . $vakk[0] . "&edit=vak' class='edit'>Edit</a>" : "") . "</td>";
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
                <hr class='hrBlue'>
                        <?php
                         //hier word de for each gebruikt om de scholen te laten zien op het scherm
                            foreach ($scholen as $school) {
                                if (!empty($school['eindDatum'])) {
                                    echo "<div class='tag'>Schoolnaam:</div><div class='gegevens'>" . $school['naam'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Diploma's:</div><div class='gegevens'>" . $school['diploma'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Startdatum:</div><div class='gegevens' >" . $school['startDatum'] . "</div>" . "<hr class='hrBlue'>" . "<div class='tag'>Einddatum:</div><div class='gegevens' >" . $school['eindDatum'] . "</div>" . "<?php if($user_id == $user_id){?><a href='../controllers/profielbeheer.php?id=$school[2]&edit=school' class='edit'>Edit</a></div><?php}?>";
                                }
                        }
                        ?>
                </div>
            </article>
            <article class="hobbys"><b>Hobby's</b>
                <div class="hobbyWrap">
                    <?php
                     //hier word de for each gebruikt om de hobby's te laten zien op het scherm
                    foreach ($gebruikersHobby as $hobby){
                        echo "<hr class='hrBlue'><div class='hobby'>" . $hobby['hobby_naam'] . "</div><div class='beschrijving'>" . $hobby['beschrijving'] . "</div>" . "<hr class='hrBlue'>";
                        
                    }
                    ?>
            </article>
                <article class="werkErvaring">
                    <div class="Huidige">Huidig Werk
                    <hr class='hrBlue'>
                    <?php
                     //hier word de for each gebruikt om de bedrijven te laten zien op het scherm
                    foreach ($bedrijven as $bedrijf) {
                        if (empty($bedrijf['eindDatum'])) {
                            echo "<div class='tag'>Werkplaats:</div>" . $bedrijf['bedrijfNaam'] . "<hr class='hrBlue'>" . "<div class='tag'>Functietitel:</div>" . $bedrijf['functieTitel'] . "<hr class='hrBlue'>" . "<div class='tag'>StartDatum:</div>" . $bedrijf['startDatum'] .  "<?php if($user_id == $user_id){?><a href='../controllers/profielbeheer.php?id=$bedrijf[8]&edit=bedrijf' class='edit'>Edit</a></div><?php}?>" . "<hr class='hrBlue'>";
                        }
                    }
                    ?>
                    </div>
                    <div class="Gestopt">Gestopt Werk
                    <hr class='hrBlue'>
                        <?php
                         //hier word de for each gebruikt om de bedrijven te laten zien op het scherm
                        foreach ($bedrijven as $bedrijf) {
                            if (!empty($bedrijf['eindDatum'])) {
                                echo "<div class='tag'>Werkplaats:</div>" . $bedrijf['bedrijfNaam'] . "<hr class='hrBlue'>" . "<div class='tag'>Functietitel:</div>" . $bedrijf['functieTitel'] . "<hr class='hrBlue'>" . "<div class='tag'>StartDatum:</div>" . $bedrijf['startDatum'] . "<hr class='hrBlue'>" . "<div class='tag'>EindDatum</div>" . $bedrijf['eindDatum'] .  "<?php if($user_id == $user_id){?><a href='../controllers/profielbeheer.php?id=$bedrijf[8]&edit=bedrijf' class='edit'>Edit</a></div><?php}?>" ;
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
    //hier worden de pop up laten zien als je op de knop klikt
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