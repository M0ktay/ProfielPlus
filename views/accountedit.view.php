<?php
//sessie word hier gestart
    session_start();

    //hier word de database aangeroepen
    require '../controllers/dbconnectie.php';

//Dit PHP-script controleert of een gebruiker is ingelogd
// en haalt vervolgens gebruikersgegevens op uit de database op basis van het 'gebruiker_id'
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

    
//Dit PHP-script behandelt het verwerken van een formulier voor het aanpassen van gebruikersgegevens,
// inclusief validatie en database-updates, en geeft feedback aan de gebruiker.

    if(isset($_POST['aanpassen'])){
        if($_POST['voornaam'] != "" || $_POST['achternaam'] != "" || $_POST['email'] != "" || $_POST['gebruikersnaam'] != "" ){
            try{
                $voornaam = $_POST['voornaam'];
                $achternaam = $_POST['achternaam'];
                $email = $_POST['email'];
                $gebruikersnaam = $_POST['gebruikersnaam'];

                // Replace 'gebruiker_id_column_name' with the correct column name for the user ID
                $stmt = $conn->prepare("UPDATE gebruikers SET voornaam = ?, achternaam = ?, email = ?, gebruikersnaam = ? WHERE id = ?");
                $stmt->bindValue(1, $voornaam);
                $stmt->bindValue(2, $achternaam);
                $stmt->bindValue(3, $email);
                $stmt->bindValue(4, $gebruikersnaam);
                $stmt->bindValue(5, $user_id);
                $stmt->execute();

                $_SESSION['message'] = array("text" => "Gebruiker aangepast", "alert" => "info");
                header("Location: ../index.php");
                exit(); 
            } catch (PDOException $e) {
                echo $e->getMessage(); 
            }
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
//hier worden de nav en footer aangeroepen
require 'partials/nav.php';
require 'partials/footer.php';
?>
<main>
    <form method="post">
    <br/><br/><br/><br/>
    <div id="container">
    <section id='box'>
        <h1>Account aanpassen</h1><hr><br>
<!--        in deze input velden word van te voren alle gegevens uit de database laten zien zodat je kunt zien wat je aanpast en wat er al stond-->
        <input type='text' placeholder="voornaam" value="<?php echo isset($voornaam) ? $voornaam : ''; ?>" name='voornaam'><br><br>
        <input type='text' placeholder="achternaam" value="<?php echo isset($achternaam) ? $achternaam : ''; ?>" name='achternaam'><br><br>
        <input type='email' placeholder="email" value="<?php echo isset($email) ? $email : ''; ?>" name='email'><br><br>
        <input type='text' placeholder="gebruikersnaam" value="<?php echo isset($gebruikersnaam) ? $gebruikersnaam : ''; ?>" name='gebruikersnaam'><br><br>

        <input type="submit" name="aanpassen" value="Aanpassen" >
    </section>
    </form>
    </container>
</main>

</body>
</html>