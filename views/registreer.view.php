<?php
    session_start();
    require '../controllers/dbconnectie.php';

    if(isset($_POST['registreren'])){
        if($_POST['voornaam'] != "" || $_POST['achternaam'] != "" || $_POST['email'] != "" || $_POST['gebruikersnaam'] != "" || $_POST['wachtwoord'] != "" ){
            try{
                $voornaam = $_POST['voornaam'];
                $achternaam = $_POST['achternaam'];
                $email = $_POST['email'];
                $gebruikersnaam = $_POST['gebruikersnaam'];
                $wachtwoord = hash('sha256', $_POST['wachtwoord']);
                $beheerder = isset($_POST['is_beheerder']) ? 1 : 0;

                $stmt = $conn->prepare("INSERT INTO `profileapp`.`gebruikers` (`voornaam`, `achternaam`, `wachtwoord`, `email`, `gebruikersnaam`, `beheerder`) VALUES (?, ?, ?, ?, ?, ?);");
                $stmt->bindValue(1, $voornaam);
                $stmt->bindValue(2, $achternaam);
                $stmt->bindValue(3, $wachtwoord);
                $stmt->bindValue(4, $email);
                $stmt->bindValue(5, $gebruikersnaam);
                $stmt->bindValue(6, $beheerder);
                $stmt->execute();

        
               

                // $sql = ("INSERT INTO gebruikers (voornaam, achternaam, email, gebruikersnaam, wachtwoord) VALUES (?,?,?,?,?);");  
                $conn->exec($stmt);
                }catch(PDOException $e) {
                    echo $e->getMessage();
                }
                $_SESSION['message']=array("text"=>"Gebruiker aangemaakt", "alert" => "info");
                $conn = null;
                // header("location:../index.php");
        } else {
            echo "<script>alert('Vul graag alle velden in')</script>";
        }
    }



?>
<html>
<head>
    <style>

        h1 {
            font-family: Arial, Helvetica, sans-serif;
        }

        label {
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

        input[type="email"] {
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

        #checkboxText {
            font-size: 15px;
        }

    </style>
</head>
<body>
<?php
// require 'partials/nav.php';
?>
<main>
    <form method="post">
    <br/><br/><br/><br/>
    <div id="container">
    <section id='box'>
        <h1>Registreren</h1><hr><br>
        <input type='text' placeholder="voornaam" name='voornaam'><br><br>
        <input type='text' placeholder="achternaam" name='achternaam'><br><br>
        <input type='email' placeholder="email" name="email"><br><br>
        <input type='text' placeholder="gebruikersnaam" name="gebruikersnaam"><br><br>
        <input type='password' placeholder="wachtwoord" name="wachtwoord"><br><br>
        <label id="checkboxText">Is beheerder?</label>
        <input type='checkbox' name="is_beheerder"> <br><br>
        <!-- Dit hoord alleen een beheerder te kunnen zien -->
        <input type="submit" name="registreren" value="Registreren" >
    </section>
    </form>
    </container>
</main>
<?php
require 'partials/footer.php';
?>
</body>
</html>