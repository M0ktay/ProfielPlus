
<html>
<head>
    <style>

        h1 {
            font-family: Arial, Helvetica, sans-serif;
        }

        input[type="submit"] {
            background-color: #DAC0A3;
            border: 0;
            border-radius: 3%;
            padding: 10px 20px;
            cursor: pointer;
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
<?php
require 'partials/nav.php';
?>
<main>
    <form method="post">
    <br/><br/><br/><br/>
    <section id='box'>
        <h1>Inloggen</h1>
        <input type='text' placeholder="gebruikersnaam" name='gebruikersnaam'><br><br>
        <input type='password' placeholder="wachtwoord" name="wachtwoord"><br><br>
        <input type="submit" value="Inloggen" >
    </section>
    </form>
</main>
<?php
require 'partials/footer.php';
?>
</body>
</html>