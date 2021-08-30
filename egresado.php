<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: signin.php');
        
    }else{
        if($_SESSION['rol'] != 1){
            header('location: signin.php');
        }
    }

    include_once 'config/database.php';
    include_once 'config/data.php';
    include_once 'config/conexion.php';

    $sesion = $_SESSION['username'];
    $db = new Database();
    
    $objeto = new Conexion();
    $conexion = $objeto->Conectarse();
    
    $consulta2= "SELECT cve_egresado, b.username from egresados as a, users as b where a.cve_usuarios= b.cve_usuarios and username = '$sesion'";
    $consultaauth = $db->connect()->prepare($consulta2);
    $consultaauth ->execute();

    $row = $consultaauth->fetch(PDO::FETCH_NUM);

    // Curriculum
    $consultacurri= "SELECT * from curriculum  where  description = '$sesion'";
    $consultacurr = $db->connect()->prepare($consultacurri);
    $consultacurr ->execute();

    $row2 = $consultacurr->fetch(PDO::FETCH_NUM);
    

    $sql = "SELECT * from curriculum where  description = '$sesion'";
    $statement2 = $conexion->prepare($sql);
    $statement2->execute();
    $curri= $statement2->fetch(PDO::FETCH_OBJ);


    // SQL obtencion de ID
    $sqlid = "SELECT cve_egresado, a.nombrec from egresados as a, users as b where a.cve_usuarios= b.cve_usuarios and username = '$sesion'";
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
                        <a class='btn btn-primary btn-lg px-4 me-sm-3' href='actualizaregresado.php?cve_egresado=<?= $id->cve_egresado;?>' style='background-color:#353854; border-color: #ffffff; '>Actualiza perfil</a>
                        <span style="opacity:0;">S</span>
                        <?php if($row2 == true):?>
                        <a class='btn btn-primary btn-lg px-4 me-sm-3' href='actualizarcurri.php?cve_curriculum=<?= $curri->cve_curriculum;?>' style='background-color:#353854; border-color: #ffffff; font-size: 18px; padding-top:11px;'> Actualizar CV</a>
                        <?php else:?>
                        <a class='btn btn-primary btn-lg px-4 me-sm-3' href='crear.php' style='background-color:#353854; border-color: #ffffff; font-size: 18px; padding-top:11px;'> Crea tu Curriculum</a>
                        <?php endif?>
                        <span style="opacity:0;">S</span>
                        <?php if($row2 == true):?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Sube tu curriculum
                        </button>
                        <?php endif?>
                        <?php endforeach; ?>
                        <?php else:?>
                        <a class='btn btn-primary btn-lg px-4 me-sm-3' href='perfilegresado.php' style='background-color:#353854; border-color: #ffffff; '>Entra ahora</a>
                        <?php endif?>
                     </div>
                  </div>
               </div>
               <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="public/img/icono.png" alt="..." /></div>
            </div>
         </div>
      </header>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Subir curriculum - PDF</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form enctype="multipart/form-data" id="form1">
                     <input name="cve_egresado" id="cve_egresado" type="hidden" value="<?= $id->cve_egresado;?>">
                     <div class="form-group">
                        <label for="title" style="text-align:left;">Nombre egresado</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $id->nombrec;?>" readonly>
                     </div>
                     <div class="form-group">
                        <label for="description" style="text-align:left;">Nombre de usuario</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?= $_SESSION['username']?>" readonly>
                     </div>
                     <div class="form-group">
                        <label for="description" style="text-align:left;">Sube tu curriculum</label>
                        <input type="file" class="form-control" id="file" name="file" style="padding-bottom:35px;">
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary" onclick="onSubmitForm()">Cuardar</button>
               </div>
            </div>
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
      <script>
         function onSubmitForm() {
             var frm = document.getElementById('form1');
             var data = new FormData(frm);
             var xhttp = new XMLHttpRequest();
                 xhttp.onreadystatechange = function () {
                     if (this.readyState == 4) {
                         var msg = xhttp.responseText;
                             if (msg == 'Subido con éxito') {
                                 alert(msg);
                                 $('#exampleModal').modal('hide')
                                 } else {
                                     alert(msg);
                                 }
                             }
                         };
                         xhttp.open("POST", "upload.php", true);
                         xhttp.send(data);
                         $('#form1').trigger('reset');
                     }
                     function openModelPDF(url) {
                         $('#modalPdf').modal('show');
                         $('#iframePDF').attr('src','<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/keepwork/'; ?>'+url);
                     }
      </script>
      <?php include("include/footer.php")?>
      <?php include("include/js.php")?>
   </body>
</html>