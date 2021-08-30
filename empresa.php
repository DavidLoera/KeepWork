<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: signin.php');
        
    }else{
        if($_SESSION['rol'] != 2){
            header('location: signin.php');
        }
    }

    include_once 'config/database.php';
    include_once 'config/data.php';
    $sesion = $_SESSION['username'];
    $db = new Database();
    
    $objeto = new Conexion();
    $conexion = $objeto->Conectarse();
    
    $consulta2= "SELECT cve_empresa, b.username from empresas as a, users as b where a.cve_usuarios= b.cve_usuarios and username = '$sesion'";
    $consultaauth = $db->connect()->prepare($consulta2);
    $consultaauth ->execute();

    $row = $consultaauth->fetch(PDO::FETCH_NUM);

    // SQL obtencion de ID
    $sqlid = "SELECT cve_empresa from empresas as a, users as b where a.cve_usuarios= b.cve_usuarios and username = '$sesion'";
    $statementid = $conexion->prepare($sqlid);
    $statementid->execute();
    $idusuario= $statementid->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">
<?php include("include/head.php")?>
<body>
<?php include("include/header.php")?>
<header class="bg-dark py-5">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2" style="text-align: justify;">Bienvenido, <?php echo $_SESSION['username'];?> </h1>
                                <p class="lead fw-normal text-white-50 mb-4" style="text-align: justify;">Muchas gracias por confiar en nosotros, estas a un solo paso de comenzar la aventura, solo te falta completar tu perfil, completalo para proceder a rellenar tu Curriculum Vitae </p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <?php if($row == true):?>
                                    <?php foreach($idusuario as $id): ?>
                                    <a class='btn btn-primary btn-lg px-4 me-sm-3' href='actualizarempresa.php?cve_empresa=<?= $id->cve_empresa;?>' style='background-color:#353854; border-color: #ffffff; '>Actualiza perfil</a>
                                    <span style="opacity:0;">S</span>
                                    <a class='btn btn-primary btn-lg px-4 me-sm-3' href='buscar.php' style='background-color:#353854; border-color: #ffffff; font-size: 18.5px; padding-top:11px;'> Buscar egresados</a>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <a class='btn btn-primary btn-lg px-4 me-sm-3' href='perfilempresa.php' style='background-color:#353854; border-color: #ffffff;'>Entra ahora</a>
                                    <?php endif?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="public/img/icono.png" alt="..." /></div>
                    </div>
                </div>
            </header>
<?php include("include/footer.php")?>
<?php include("include/js.php")?>
</body>
</html>