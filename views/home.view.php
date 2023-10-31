<?php
?>
<html lang="eng">

<head>
    <title>ProfielPlus</title>
    <link rel="stylesheet" href="/views/style/home.style.css">
</head>
<body>
<?php
    require 'partials/nav.php';
    require '../controllers/dbconnectie.php';

$query = "SELECT * FROM gebruikers";
$stmt = $conn->prepare($query);
$stmt->execute();
$gebruikers = $stmt->fetchAll();

?>
<main>
<section class="grid-container">

    <article class="grid-item">
        <h3>Info ProfielPlus</h3>
        <p>LLALLALLALALALALALALALLA Tekst en zo beetje type beetje tekst en this is spontainius in the engels bro WATAFAK</p>
    </article>
    <article class="grid-item">
        <h3>Tekst</h3>
        <p>Nog meer tekst</p>
    </article>
</section>

    <section class="grid-container-groot">

    <article class="grid-item">
        <h3>Profielen</h3>
        <div>Zoekbalk</div>
        <div>
            <table>
                <thead>
                <tr>
                    <td>Voornaam</td>
                    <td>Achternaam</td>
                    <td>School</td>
                    <td>Werk</td>
                </tr>
                </thead>
                <tbody>
            <?php
            foreach($gebruikers as $gebruiker){
                echo "<tr>";
                echo "<td>";
                echo $gebruiker['voornaam'];
                echo "</td>";
                echo "<td>";
                echo $gebruiker['achternaam'];
                echo "</td>";
                echo "</tr>";
            }

            ?>
                </tbody>
            </table>
        </div>
    </article>

    </section>

</main>
</body>
<?php
    require 'partials/footer.php';
?>
</html>

<!--<script>-->
<!--    window.onscroll = function() {myFunction()};-->
<!---->
<!--    var navbar = document.getElementById("navbar");-->
<!--    var sticky = navbar.offsetTop;-->
<!---->
<!--    function myFunction() {-->
<!--        if (window.pageYOffset >= sticky) {-->
<!--            navbar.classList.add("sticky")-->
<!--        } else {-->
<!--            navbar.classList.remove("sticky");-->
<!--        }-->
<!--    }-->
<!--</script>-->