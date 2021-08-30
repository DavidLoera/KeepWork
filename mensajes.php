<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: signin.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: signin.php');
        }
    }


?>

<!DOCTYPE html>
<html lang="es">
<?php include("include/head.php")?>
<body>
<?php include("include/header.php")?><br><br><br>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>Nombre de la empresa</th>
            <th>Chat activos</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Coca-Cola S.A de C.V</td>
            <td><a href="#">Ver chat</a></td>

        </tr>
        <tr>
            <td>Empresa de prueba</td>
            <td><a href="#">Ver chat</a></td>

        </tr>
        
        <tbody>
    </table>
</div>

<?php include("include/js.php")?>
</body>
</html>