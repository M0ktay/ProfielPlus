<?php
include 'database.php';

$query = "SELECT * FROM gebruikers where id = 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikers = $stmt->fetchAll();
//die(var_dump($gebruikers));

$query = "SELECT * FROM gebruiker_heeft_hobby WHERE gebruikers_id = 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikersHobby = $stmt->fetchAll();
//die(var_dump($gebruikersHobby));

$query = "SELECT * FROM hobby WHERE id = 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$Hobbys = $stmt->fetchAll();
//die(var_dump($Hobbys));
?>

<html>
<head>
    <link rel="stylesheet" href="profiel.style.css">
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
                        echo $gebruikers['gebruikersnaam'];
                    ?></div>
                <hr class="hrBlue">
                <div class="tag">Voornaam:</div><div class="gegevens"></div>
                <hr class="hrBlue">
                <div class="tag">Achternaam:</div><div class="gegevens">Oktay</div>
                <hr class="hrBlue">
                <div class="tag">Email:</div><div class="gegevens">meric@live.nl</div>
                <hr class="hrBlue">
            </article>
            <article class="schoolPrestaties">
                <div class="Huidige">Huidige
                    <div class="tag">Schoolnaam:</div><div class="gegevens">ICT Campus</div>
                    <hr class="hrBlue">
                    <div class="tag">Niveau:</div><div class="gegevens">MBO niveau 4</div>
                    <hr class="hrBlue">
                    <!--link naar pagina met alle vakken en cijfers-->
                    <a href="#">vakken</a>
                </div>
                <div class="Afgerond">Afgerond
                    <div class="tag">Schoolnaam:</div><div class="gegevens">ICT Campus</div>
                    <hr class="hrBlue">
                    <div class="tag">Diploma's:</div><div class="gegevens">MBO diploma, Mavo diploma</div>
                    <hr class="hrBlue">
                </div>
            </article>
            <article class="hobbys"><b>Hobby's</b>
                <div class="hobbyWrap">
                    <div class="hobby"><?php echo $Hobbys["naam"]; ?></div><div class="beschrijving">

                        <?php
                        foreach ($gebruikersHobby as $gebruikerhobby) {
                            echo $gebruikerhobby["beschrijving"] . "<img class='hobbyImg' src='hobby_temp_img.jpg'>" . "<hr class='hrBlue'>" ."<br>";
                        }
                        ?></div>
                </div>
            </article>
                <article class="werkErvaring">
                    <div class="Huidige">Huidig Werk
                        <div class="tag">Werkplaats:</div><div class="gegevens">Albert Heijn</div>
                        <hr class="hrBlue">
                        <div class="tag">Functietitel:</div><div class="gegevens">Vakkenvuller</div>
                        <hr class="hrBlue">
                        <div class="tag">StartDatum:</div><div class="gegevens">18-11-2018</div>
                        <hr class="hrBlue">
                    </div>
                    <div class="Gestopt">Gestopt Werk
                        <div class="tag">Werkplaats:</div><div class="gegevens">Albert Heijn</div>
                        <hr class="hrBlue">
                        <div class="tag">Functietitel:</div><div class="gegevens">Vakkenvuller</div>
                        <hr class="hrBlue">
                        <div class="tag">StartDatum:</div><div class="gegevens">18-11-2018</div>
                        <hr class="hrBlue">
                        <div class="tag">EindDatum:</div><div class="gegevens">18-11-2023</div>
                        <hr class="hrBlue">
                        <div class="tag">Werkplaats:</div><div class="gegevens">Albert Heijn</div>
                        <hr class="hrBlue">
                        <div class="tag">Functietitel:</div><div class="gegevens">Vakkenvuller</div>
                        <hr class="hrBlue">
                        <div class="tag">StartDatum:</div><div class="gegevens">18-11-2018</div>
                        <hr class="hrBlue">
                        <div class="tag">EindDatum:</div><div class="gegevens">18-11-2023</div>
                        <hr class="hrBlue">
                    </div>
                </article>
    </section>
</main>
</body>
<footer>

</footer>
</html>