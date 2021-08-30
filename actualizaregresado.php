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
    
    $id = $_GET['cve_egresado'];
    // SQL Para los estados
    $sqlesta = 'SELECT * FROM estados';
    $statement = $conexion->prepare($sqlesta);
    $statement->execute();
    $estados= $statement->fetchAll(PDO::FETCH_OBJ);

    
    $sql = 'SELECT cve_egresado, cve_usuarios, a.cve_estados, nombrec, genero, estado_ci, pais, ciudad, nacionalidad, discapacidad, b.estado from egresados as a, estados as b where a.cve_estados = b.cve_estado and cve_egresado =:cve_egresado';
    $statement2 = $conexion->prepare($sql);
    $statement2->execute([':cve_egresado' => $id ]);
    $egresados= $statement2->fetch(PDO::FETCH_OBJ);

    $sqluser = 'SELECT telefono, email FROM users where username =:username';
    $statementuser = $conexion->prepare($sqluser);
    $statementuser->execute([':username' => $usuarion]);
    $usuarios= $statementuser->fetch(PDO::FETCH_OBJ);

    //SQL Para las categorias de los productos

   if (isset ($_POST['cve_usuario']) && isset($_POST['nombrec']) && isset($_POST['genero']) && isset($_POST['estadociv']) && isset($_POST['pais']) && isset($_POST['estado']) && isset($_POST['ciudad']) && isset($_POST['nacionalidad']) && isset($_POST['disca'])) {
   
   $cve_usuario = $_POST['cve_usuario'];
   $nombrec = $_POST['nombrec'];
   $genero = $_POST['genero'];
   $estadociv = $_POST['estadociv'];
   $pais = $_POST['pais'];
   $estado = $_POST['estado'];
   $ciudad = $_POST['ciudad'];
   $nacionalidad = $_POST['nacionalidad'];
   $discapacidad = $_POST['disca'];
   $telefono = $_POST['telefono'];
   $email = $_POST['email'];
   
   $sql3 = 'UPDATE egresados SET cve_egresado =:cve_egresado, cve_estados =:estado, nombrec =:nombrec, genero =:genero, estado_ci =:estadoci, pais =:pais, ciudad =:ciudad, nacionalidad =:nacionalidad, discapacidad =:discapacidad WHERE cve_egresado =:cve_egresado';
   $statement3 = $conexion->prepare($sql3);
   if( $statement3->execute([':estado' => $estado, ':nombrec' => $nombrec, ':genero' => $genero, ':estadoci' => $estadociv, ':pais' => $pais, ':ciudad'=>$ciudad, ':nacionalidad' => $nacionalidad, ':discapacidad' => $discapacidad, ':cve_egresado' => $id])){
      
      $sqlupdate = "UPDATE users SET email =:email, telefono =:telefono Where username =:username";
      $statementupdate = $conexion->prepare($sqlupdate);
      $statementupdate->execute([':email' =>$email, ':telefono' => $telefono, ':username' => $usuarion]);
      $authr = "<div class='alert alert-success' role='alert' style='width:410px;'>Registro actualizado <a href='crear.php' style='text-decoration:none;'>Crear Curriculum</a></div>";
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
      <h1>Actualizar Perfil egresado</h1>
      <h3>Completa tu perfil</h3>
      <form method="POST" action="">
            <input name="cve_usuario" type="hidden" value="<?= $egresados->cve_usuarios; ?>">

            <label for="nombre" class="colocar_nombre">Nombre completo *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="nombrec" id="username" value="<?= $egresados->nombrec;?>" required>

            <label for="nombre" class="colocar_nombre">Género *
            <span class="obligatorio">*</span>
            </label>
            <select name="genero" class="seleccionar">
            <option value="<?= $egresados->genero;?>">Seleccionada: <?= $egresados->genero;?></option>
            <option value="Hombre">Hombre</option>
            <option value="Mujer">Mujer</option>
            </select>
            
            <label for="nombre" class="colocar_nombre">Estado civil *
            <span class="obligatorio">*</span>
            </label>
            <select name="estadociv" class="seleccionar" required>
            <option value="<?= $egresados->estado_ci;?>">Seleccionada: <?= $egresados->estado_ci;?></option>
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
            <option value="<?= $egresados->cve_estados;?>">Seleccionada: <?= $egresados-> estado;?></option>
            <?php foreach($estados as $esta): ?>
				<option value="<?= $esta->cve_estado; ?>"><?= $esta->estado; ?></option>
			   <?php endforeach; ?>
            </select>

            <label for="nombre" class="colocar_nombre">Ciudad *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="ciudad" id="username" value="<?= $egresados->ciudad;?>" required>

            <label for="nombre" class="colocar_nombre">Nacionalidad *
            <span class="obligatorio">*</span>
            </label>
            <select name="nacionalidad" class="seleccionar">
            <option value="<?= $egresados->nacionalidad;?>">Seleccionada: <?= $egresados-> nacionalidad;?></option>
            <option value="Mexicana">Mexicana</option>
            <option value="Extranjera">Extranjera</option>
            </select>

            <label for="nombre" class="colocar_nombre">Discapacidad *
            <span class="obligatorio">*</span>
            </label>
            <select name="disca" class="seleccionar">
            <option value="<?= $egresados->discapacidad;?>">Seleccionada: <?= $egresados-> discapacidad;?></option>
            <option value="Si">Si</option>
            <option value="No">No</option>
            </select>

            <label for="nombre" class="colocar_nombre">Telefono *
            <span class="obligatorio">*</span>
            </label>
            <input type="num" name="telefono" id="username" value="<?= $usuarios->telefono;?>" required>

            <label for="nombre" class="colocar_nombre">Email*
            <span class="obligatorio">*</span>
            </label>
            <input type="email" name="email" id="username" value="<?= $usuarios->email;?>" required>

         <button type="submit" name="enviar_formulario"  id="enviar">
            <p>Actualizar perfil</p>
         </button>
      </form>
   </div>
</div>
<?php include("include/footer.php")?>
<?php include("include/js.php")?>
</body>
</html>