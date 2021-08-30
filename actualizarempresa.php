<?php
   include_once 'config/database.php';
   include_once 'config/data.php';
   
    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: signin.php');
        
    }else{
        if($_SESSION['rol'] != 2){
            header('location: signin.php');
        }
    }
    
    $objeto = new Conexion();
    $conexion = $objeto->Conectarse();
    //$usuarion = $_SESSION['username'];
    
    $id = $_GET['cve_empresa'];

    $sql = 'SELECT * from empresas where cve_empresa =:cve_empresa';
    $statement2 = $conexion->prepare($sql);
    $statement2->execute([':cve_empresa' => $id ]);
    $empresa= $statement2->fetch(PDO::FETCH_OBJ);

    //SQL Para las categorias de los productos

   if (isset($_POST['cve_usuario']) && isset($_POST['nombree']) && isset($_POST['giro']) && isset($_POST['ciudad']) && isset($_POST['pais']) && isset($_POST['descripcion'])) {
   
    $cveusuraio = $_POST['cve_usuario'];
    $empresa = $_POST['nombree'];
    $giro = $_POST['giro'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $decripcion = $_POST['descripcion'];
    $sitio = $_POST['sitioweb'];

   $sql3 = 'UPDATE empresas SET cve_empresa =:cve_empresa, nombreempresa =:nombree, giro =:giro, ciudad =:ciudad, pais =:pais, descripcion =:descripcion, sitioweb=:sitioweb WHERE cve_empresa =:cve_empresa';
   $statement3 = $conexion->prepare($sql3);
   if( $statement3->execute([':nombree' => $empresa, ':giro' => $giro, ':ciudad' => $ciudad, ':pais' => $pais, ':descripcion'=>$decripcion, ':sitioweb' =>$sitio,':cve_empresa' => $id])){
        header('location: empresa.php');  
    $authr = "<div class='alert alert-success' role='alert' style='width:410px;'>Registro actualizado, <a href='buscar.php' style='text-decoration:none;'>Buscar egresados</a></div>";
   }else{
      $authr = "<div class='alert alert-danger' role='alert' style='width:410px;'>Error al completar el registro</div>";
   }
 
 
 }
 
?>

<!DOCTYPE html>
<html lang="es">
<?php include("include/head.php")?>
<body>
<?php include("include/header.php")?>

<div class="contact_form">
   <div class="formulario">
   <?php echo $authr;  ?>
   <h1>Actualizar perfil empresa</h1>
      <h3>Completa tu perfil</h3>
      <form method="POST" action="">

      <input name="cve_usuario" type="hidden" value="<?= $empresa->cve_usuarios; ?>">

            <label for="nombre" class="colocar_nombre">Nombre de la empresa *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="nombree" id="username" value="<?= $empresa->nombreempresa; ?>" required>

            <label for="nombre" class="colocar_nombre">Giro de la empresa *
            <span class="obligatorio">*</span>
            </label>
            <select name="giro" class="seleccionar">
            <option value="<?= $empresa->giro;?>">Seleccionada: <?= $empresa->giro;?></option>
            <option value="Empresa de giro industrial">Empresa de giro industrial</option>
            <option value="Empresa de giro de servicios">Empresa de giro de servicios</option>
            <option value="Empresa de giro comercial">Empresa de giro comercial</option>
            </select>
            
            <label for="nombre" class="colocar_nombre">Ciudad *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="ciudad" id="username" value="<?= $empresa->ciudad; ?>" required>


            <label for="nombre" class="colocar_nombre">País *
            <span class="obligatorio">*</span>
            </label>
            <select name="pais" class="seleccionar">
            <option value="México">México</option>
            </select>

            <?php if($empresa->sitioweb == false):?>

            <label for="nombre" class="colocar_nombre">Sitio Web*
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="sitioweb" id="username" placeholder="Ingrese su Sitio Web (opcional)">
            <?php else:?>

            <label for="nombre" class="colocar_nombre">Sitio Web*
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="sitioweb" id="username" value="<?= $empresa->sitioweb ?>">
            <?php endif?>

            <label for="nombre" class="colocar_nombre">Descripción de la empresa *
            <span class="obligatorio">*</span>
            </label>
            <textarea name="descripcion" rows="10" cols="48" style="border-color: #f3cf47;" ><?= $empresa->descripcion; ?></textarea>

            

         <button type="submit" name="enviar_formulario"  id="enviar">
            <p>Actualizar perfil empresarial</p>
         </button>
      </form>
   </div>
</div>
<?php include("include/footer.php")?>
<?php include("include/js.php")?>
</body>
</html>