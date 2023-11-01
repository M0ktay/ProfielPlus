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
    <br/><br/><br/>
<section class="grid-container">

    <article class="grid-item">
        <h3>Info ProfielPlus</h3>
        <p>LLALLALLALALLALALALLA Tekst en zo beetje type beetje tekst en this is spontainius in the engels bro WATAFAK</p>
    </article>
    <article class="grid-item">
        <h3>Tekst</h3>
        <p>Nog meer tekst</p>
    </article>
</section>

    <section class="grid-container-groot">

    <article class="grid-item">
        <h3>Profielen</h3>
        <div>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoek op voornaam">
            <br/><br/>
            <table id="tabel">
                <thead>
                <tr>
                    <td>Voornaam</td>
                    <td>Achternaam</td>
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