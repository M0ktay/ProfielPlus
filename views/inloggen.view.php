<?php

session_start();

require '../controllers/dbconnectie.php';

if (isset($_POST["login"])) {
    if (empty($_POST["gebruikersnaam"]) || empty($_POST["wachtwoord"])) {
        $message = '<label> Alle velden zijn vereist</label>';
    } else {
        $query = "SELECT id FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord";
        $stmt = $conn->prepare($query);
        $stmt->execute(
            array(
                'gebruikersnaam' => $_POST["gebruikersnaam"],
                'wachtwoord' => hash('sha256', $_POST["wachtwoord"])
            )
        );

        $user = $stmt->fetch(); 
        if ($user) {
            $_SESSION['gebruiker_id'] = $user['id']; 
            header('location:../index.php'); 
        } else {
            $message = '<label>FOUT</label>';
        }
    }
}

?>

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

        input[type="text"] {
            background-color: white;
            border: solid black 5px;
            border: 0;
            padding: 10px 10px;
            border-radius: 3%;
        }

        input[type="password"] {
            background-color: white;
            border: solid black 5px;
            border: 0;
            padding: 10px 10px;
            border-radius: 3%;
        }

        #container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 75vh;
            margin: 0;
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

        label {
            color:red;
        }

    </style>
</head>
<body>
<?php
 require 'partials/nav.php';

 if($_POST){
    var_dump($_SESSION);
 }
?>
<main>
    <form method="post">
        
    <br/><br/><br/><br/>
    <container id="container">
    <section id='box'>
        <h1>Inloggen</h1><hr><br>
        <input type='text' placeholder="gebruikersnaam" required name='gebruikersnaam'><br><br>
        <input type='password' placeholder="wachtwoord" required name="wachtwoord"><br><br>
        <input type="submit" name="login" value="Inloggen" ><br><br>
        <?php 
            if(isset($message))
            {
                echo '<label class ="text-danger"><b>' .$message.' </b></label>';
            }
        ?>
    </section>
    </form>
    </container>
</main>
<?php
require 'partials/footer.php';
?>
</body>
</html>