<?php
//Dit zorgt ervoor dat de sessie eindigt wanneer je op uitloggen klikt
    session_start();
    session_destroy();
    header('location:../index.php'); 
?>