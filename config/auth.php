<?php

//Autentificador de sesion

session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}

?>
