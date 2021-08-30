<?php
   include_once 'config/database.php';
   include_once 'config/data.php';
   
    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: signin.php');
        
    }else{
        if($_SESSION['rol'] != 1){
            header('location: signin.php');
        }
    }
    
    $objeto = new Conexion();
    $conexion = $objeto->Conectarse();
    $usuarion = $_SESSION['username'];

    // SQL Para las marcas de las marcas
    $sqlesta = 'SELECT * FROM estados';
    $statement = $conexion->prepare($sqlesta);
    $statement->execute();
    $estados= $statement->fetchAll(PDO::FETCH_OBJ);

    // SQL obtencion de ID
    $sqlid = "SELECT cve_usuarios FROM users where username = '$usuarion'";
    $statementid = $conexion->prepare($sqlid);
    $statementid->execute();
    $idusuario= $statementid->fetchAll(PDO::FETCH_OBJ);

    
    if(isset($_POST['cve_usuario']) && isset($_POST['nombrec']) && isset($_POST['genero']) && isset($_POST['estadociv']) && isset($_POST['pais']) && isset($_POST['estado']) && isset($_POST['ciudad']) && isset($_POST['nacionalidad']) && isset($_POST['disca'])){
        $cveusuraio = $_POST['cve_usuario'];
        $estado = $_POST['estado'];
        $nombrec = $_POST['nombrec'];
        $estadoci = $_POST['estadociv'];
        $pais = $_POST['pais'];
        $genero = $_POST['genero'];
        $ciudad = $_POST['ciudad'];
        $nacionalidad = $_POST['nacionalidad'];
        $discapacidad = $_POST['disca'];
        
        $db = new Database();

        $consulta2= "SELECT cve_usuarios FROM egresados WHERE cve_usuarios = :cve_usuario";
        $consultaauth = $db->connect()->prepare($consulta2);
        $consultaauth ->execute(['cve_usuario'=> $cveusuraio]);
    
        $consulta = "INSERT into egresados (cve_usuarios, cve_estados, nombrec, genero, estado_ci, pais, ciudad, nacionalidad, discapacidad) VALUES(:usuario , :estado, :nombrec, :genero, :estadoci, :pais, :ciudad, :nacionalidad, :discapacidad)";
        $query = $db->connect()->prepare($consulta);

        $row = $consultaauth->fetch(PDO::FETCH_NUM);
        if($row == false){
        if( $query->execute(['usuario' => $cveusuraio, 'estado' => $estado, 'nombrec' => $nombrec, 'genero' => $genero, 'estadoci' => $estadoci, 'pais' => $pais, 'ciudad'=>$ciudad, 'nacionalidad' => $nacionalidad, 'discapacidad' => $discapacidad])){
           
           $authr = "<div class='alert alert-success' role='alert' style='width:410px;'>Registro completado <a href='crear.php' style='text-decoration:none;'>Crear Curriculum</a></div>";
           header("location: egresado.php"); 
          
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
      <h1>Perfil egresado</h1>
      <h3>Completa tu perfil</h3>
      <form method="POST" action="">
      <?php foreach($idusuario as $id): ?>
        <input name="cve_usuario" type="hidden" value="<?= $id->cve_usuarios; ?>">
        <?php endforeach; ?>
            <label for="nombre" class="colocar_nombre">Nombre completo *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="nombrec" id="username" placeholder="Escribe tu nombre completo" required>

            <label for="nombre" class="colocar_nombre">Género *
            <span class="obligatorio">*</span>
            </label>
            <select name="genero" class="seleccionar">
            <option value="Hombre">Hombre</option>
            <option value="Mujer">Mujer</option>
            </select>
            
            <label for="nombre" class="colocar_nombre">Estado civil *
            <span class="obligatorio">*</span>
            </label>
            <select name="estadociv" class="seleccionar">
            <option value="Estado civil">Estado civil</option>
            <option value="Soltero(a)">Soltero(a)</option>
            <option value="Casado(a)">Casado(a)</option>
            <option value="Separado(a)/Divorciado(a">Separado(a)/Divorciado(a)</option>
            <option value="Viudo(a)a">Viudo(a)a</option>
            </select>

            <label for="nombre" class="colocar_nombre">País *
            <span class="obligatorio">*</span>
            </label>
            <select name="pais" class="seleccionar">
            <option value="México">México</option>
            </select>
        
            <label for="nombre" class="colocar_nombre">Estado *
            <span class="obligatorio">*</span>
            </label>
            <select name="estado" class="seleccionar">
            <option value="0">Selecciona un estado</option>
            <?php foreach($estados as $esta): ?>
				<option value="<?= $esta->cve_estado; ?>"><?= $esta->estado; ?></option>
			   <?php endforeach; ?>
            </select>

            <label for="nombre" class="colocar_nombre">Ciudad *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="ciudad" id="username" placeholder="Nombre de la ciudad" required>

            <label for="nombre" class="colocar_nombre">Nacionalidad*
            <span class="obligatorio">*</span>
            </label>
            <select name="nacionalidad" class="seleccionar">
            <option value="0">Selecciona un Nacionalidad</option>
            <option value="Mexicana">Mexicana</option>
            <option value="Extranjera">Extranjera</option>
            </select>

            <label for="nombre" class="colocar_nombre">Discapacidad*
            <span class="obligatorio">*</span>
            </label>
            <select name="disca" class="seleccionar">
            <option value="0">Selecciona una opción</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
            </select>

         <button type="submit" name="enviar_formulario"  id="enviar">
            <p>Completar perfil</p>
         </button>
      </form>
   </div>
</div>
<?php include("include/footer.php")?>
<?php include("include/js.php")?>
</body>
</html>