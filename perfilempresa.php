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
    $usuarion = $_SESSION['username'];


    // SQL obtencion de ID
    $sqlid = "SELECT cve_usuarios FROM users where username = '$usuarion'";
    $statementid = $conexion->prepare($sqlid);
    $statementid->execute();
    $idusuario= $statementid->fetchAll(PDO::FETCH_OBJ);

    
    if(isset($_POST['cve_usuario']) && isset($_POST['nombree']) && isset($_POST['giro']) && isset($_POST['ciudad']) && isset($_POST['pais']) && isset($_POST['descripcion'])){
        $cveusuraio = $_POST['cve_usuario'];
        $empresa = $_POST['nombree'];
        $giro = $_POST['giro'];
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        $decripcion = $_POST['descripcion'];
        $sitio = $_POST['sitioweb'];

        $db = new Database();

        $consulta2= "SELECT cve_usuarios FROM empresas WHERE cve_usuarios = :cve_usuario";
        $consultaauth = $db->connect()->prepare($consulta2);
        $consultaauth ->execute(['cve_usuario'=> $cveusuraio]);
    
        $consulta = "INSERT into empresas (cve_usuarios, nombreempresa, giro, ciudad, pais, descripcion, sitioweb) VALUES(:usuario , :nombree, :giro, :ciudad, :pais, :descripcion, :sitioweb)";
        $query = $db->connect()->prepare($consulta);

        $row = $consultaauth->fetch(PDO::FETCH_NUM);
        if($row == false){
        if( $query->execute(['usuario' => $cveusuraio, 'nombree' => $empresa, 'giro' => $giro, 'ciudad' => $ciudad, 'pais' => $pais, 'descripcion'=>$decripcion, 'sitioweb' =>$sitio])){
           
           $authr = "<div class='alert alert-success' role='alert' style='width:410px;'>Registro completado <a href='buscar.php' style='text-decoration:none;'>Buscar egresados</a></div>";
          
        }else{
           $authr = "<div class='alert alert-danger' role='alert' style='width:410px;'>Error al completar el registro</div>";
        }
        }else{
            $authr = "<div class='alert alert-danger' role='alert' style='width:410px;'>Ya completaste tu registro</div>";
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
      <h1>Perfil empresa</h1>
      <h3>Completa tu perfil</h3>
      <form method="POST" action="">
      <?php foreach($idusuario as $id): ?>
        <input name="cve_usuario" type="hidden" value="<?= $id->cve_usuarios; ?>">
        <?php endforeach; ?>
            <label for="nombre" class="colocar_nombre">Nombre de la empresa *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="nombree" id="username" placeholder="Escribe el nombre de la empresa" required>

            <label for="nombre" class="colocar_nombre">Giro de la empresa *
            <span class="obligatorio">*</span>
            </label>
            <select name="giro" class="seleccionar">
            <option value="Empresa de giro industrial">Empresa de giro industrial</option>
            <option value="Empresa de giro de servicios">Empresa de giro de servicios</option>
            <option value="Empresa de giro comercial">Empresa de giro comercial</option>
            </select>
            
            <label for="nombre" class="colocar_nombre">Ciudad *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="ciudad" id="username" placeholder="Nombre de la ciudad donde se ubica" required>

            <label for="nombre" class="colocar_nombre">País *
            <span class="obligatorio">*</span>
            </label>
            <select name="pais" class="seleccionar">
            <option value="México">México</option>
            </select>

            <label for="nombre" class="colocar_nombre">Sitio Web*
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="sitioweb" id="username" placeholder="Ingrese su Sitio Web (opcional)">

            <label for="nombre" class="colocar_nombre">Descripción de la empresa *
            <span class="obligatorio">*</span>
            </label>
            <textarea name="descripcion" rows="10" cols="48" style="border-color: #f3cf47;" placeholder="Breve descripción de la empresa"></textarea>

            

         <button type="submit" name="enviar_formulario"  id="enviar">
            <p>Completar perfil empresarial</p>
         </button>
      </form>
   </div>
</div>
<?php include("include/footer.php")?>
<?php include("include/js.php")?>
</body>
</html>