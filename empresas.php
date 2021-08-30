<?php

include_once 'config/data.php';

$objeto = new Conexion();
$conexion = $objeto->Conectarse();
//$usuarion = $_SESSION['username'];

$id = $_GET['cve_empresa'];

$sql = 'SELECT * from empresas';
$statement2 = $conexion->prepare($sql);
$statement2->execute();
$empresa= $statement2->fetchAll(PDO::FETCH_OBJ);

$row = $statement2->fetch(PDO::FETCH_NUM);


?>


<!DOCTYPE html>
<html lang="es">
<?php include("include/head.php")?>
<body>
<?php include("include/header.php")?>
         <!-- Blog preview section-->
         <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                                <h2 class="fw-bolder">Empresas ligadas</h2>
                                <p class="lead fw-normal text-muted mb-5">Estas son unas de las empresas que se han registrado con nosotros, es hora de buscar un empleo</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row gx-5">
                   
                    <?php foreach($empresa as $empre): ?>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="public/img/image1.jpg" alt="..." />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">Nuevo</div>
                                    <a class="text-decoration-none link-dark stretched-link" <?php if($empre->sitioweb == true):?>href="<?=$empre->sitioweb;?>"target="_blank" <?php else:?> href="#"  <?php endif?>><h5 class="card-title mb-3"><?= $empre->nombreempresa?></h5></a>
                                    <p class="card-text mb-0"> <a style="font-weight: bold;"> <?= $empre->giro;?> </a> <br><br> <?= $empre->descripcion; ?> <br><br> <a style="font-weight: bold;"><?= $empre->ciudad; ?></a> <br><br> <?php if($empre->sitioweb == true):?><a href="<?= $empre->sitioweb;?>">Sitio Web</a> <?php endif?></p>
                                </div>
                                <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle me-3" src="public/img/2.png" alt="..." /><span style="opacity:0;">S</span>
                                            <div class="small">
                                                <div class="fw-bold">Fecha alta</div>
                                                <div class="text-muted"><?= $empre->fecha_alta ?> &middot; </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>

                    </div>

            </section>
        </main><br>

    <?php include("include/js.php")?>
</body>
</html>