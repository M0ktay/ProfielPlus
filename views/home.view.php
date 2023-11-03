<?php
// Hier word de session gestart
session_start();

?>
<html lang="eng">

<head>
    <title>ProfielPlus</title>
    <link rel="stylesheet" href="/views/style/home.style.css">
</head>
<body>
<?php
//hier word de navbar en de footer opgeroepen
    require 'partials/nav.php';
    require '../controllers/dbconnectie.php';

    // Hier word alles uit de database gehaald van de tabel gebruikers
$query = "SELECT * FROM gebruikers";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikers = $stmt->fetchAll();

?>
<main>
    <br/><br/><br/>
<section class="grid-container">

    <article class="grid-item">
        <h3>Welkom bij ProfielPlus</h3>
        <p>Word lid van onze gemeenschap en deel je portfolio om te verbinden, te inspireren en nieuwe mogelijkheden te ontdekken. Samen bouwen we aan een plek waar talent wordt erkend en gewaardeerd.</p>
    </article>
    <article class="grid-item">
        <img class="pfLogo" src="../views/partials/pf_logo.png">
    </article>
</section>

    <section class="grid-container-groot">

    <article class="grid-item">
        <p class="Hometitel">Wat is ProfielPlus?</p><br>
            <p class="Hometext">ProfielPlus biedt een unieke en veilige manier om jouw persoonlijke informatie en interesses digitaal te bewaren
                en te organiseren zonder dat anderen toegang hebben tot je gegevens.
                Onze toepassing is speciaal ontworpen voor privacybewuste individuen die hun online aanwezigheid willen verbeteren,
                maar tegelijkertijd de volledige controle willen behouden over hun gegevens</p>
        <p class="Hometext">
            Meld je aan bij ProfielPlus en begin met het opzetten van je eigen persoonlijke profiel. Voeg informatie toe over jezelf,
            waaronder je hobby's, werkervaring, opleiding en andere gegevens die je belangrijk vindt.
        </p>
        <p class="Hometext">
            Met ProfielPlus kun je je persoonlijke informatie organiseren en gemakkelijk toegang krijgen tot belangrijke details over jezelf,
            zoals je contactgegevens, professionele ervaring en interesses.
        </p>
    </article>

    </section>

</main>
</body>
<?php
    require 'partials/footer.php';
?>
</html>

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("tabel");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>