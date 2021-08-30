<?php

    session_start();

    include_once 'config/database.php';
    include_once 'config/data.php';

    if(!isset($_SESSION['rol'])){
        header('location: signin.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: signin.php');
        }
    }

    $usuarion = $_SESSION['username'];
    $objeto = new Conexion();
    $conexion = $objeto->Conectarse();

    $db = new Database();

        $cve_curri = $_GET['cve_curriculum'];
         // SQL obtencion de ID
        $sqlid = "SELECT cve_egresado, b.cve_usuarios, b.username, nombrec FROM egresados as a,users as b WHERE b.username =:usuario";
        $statementid = $conexion->prepare($sqlid);
        $statementid->execute([':usuario' => $usuarion]);
        $row = $statementid->fetch(PDO::FETCH_NUM);

        $sql = "SELECT cve_egresado, b.cve_usuarios, b.username, nombrec, genero, estado_ci, pais, ciudad FROM egresados as a,users as b WHERE b.username =:usuario";
        $statement2 = $conexion->prepare($sql);
        $statement2->execute([':usuario' => $usuarion]);
        $egresado = $statement2->fetch(PDO::FETCH_OBJ);

        $sqluser = 'SELECT telefono, email FROM users where username =:username';
        $statementuser = $conexion->prepare($sqluser);
        $statementuser->execute([':username' => $usuarion]);
        $usuarios= $statementuser->fetch(PDO::FETCH_OBJ);

        // Obtener todos los curriculum
        $sqlcurr = 'SELECT * FROM curriculum where cve_curriculum =:curriculum';
        $statementcurri = $conexion->prepare($sqlcurr);
        $statementcurri->execute([':curriculum' => $cve_curri]);
        $curriculum= $statementcurri->fetch(PDO::FETCH_OBJ);

        if(isset($_POST['cve_egresado']) ){
         
         $egresado = $_POST['cve_egresado'];
         $nombrec = $_POST['nombrec'];
         $genero = $_POST['genero'];
         $telefono = $_POST['telefono'];
         $email = $_POST['email'];
         $pais = $_POST['pais'];
         $domicilio = $_POST['domicilio'];
         $ciudad = $_POST['ciudad'];
         $universidad = $_POST['universidad'];
         $carrera = $_POST['carrera'];
         $perfilpro = $_POST['perfilpro'];
         $description = $_POST['description'];

         $consulta = "UPDATE curriculum SET cve_egresado =:cve_egresado, nombreegresado =:nombreegresado, genero = :genero, telefono=:telefono, email=:email, pais=:pais, domicilio=:domicilio, ciudad=:ciudad, nombreuniver=:nombreuniver, carrera=:carrera, perfilpro=:perfilpro, description=:description Where cve_curriculum = :cve_curriculum";
         $query = $db->connect()->prepare($consulta);

         if( $query->execute(['cve_egresado' => $egresado, 'nombreegresado' => $nombrec, 'genero' => $genero, 'telefono' => $telefono, 'email' => $email, 'pais' => $pais,'domicilio' => $domicilio, 'ciudad'=>$ciudad, 'nombreuniver' => $universidad, 'carrera' => $carrera, 'perfilpro' => $perfilpro, 'description' => $description , 'cve_curriculum' => $cve_curri])){
           
            $authr = "<div class='alert alert-success' role='alert' style='width:410px;'>Registro completado <a href='crear.php' style='text-decoration:none;'>Crear Curriculum</a></div>";
            header("location: egresado.php"); 
           
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


<?php if($row == true): ?>
   
<div class="contact_form">
   <div class="formulario">
   <?php echo $authr;  ?>
      <h1>Actualizar Curriculum</h1>
      <h3>Completa tu perfil <p style="padding-top:15px;"> *Puedes editar tu información en tu, <a href="egresado.php" style="text-decoration: none;">perfil de egresado</a>* </p></h3>
      <form method="POST" action="">
       <input name="description" type="hidden" value="<?= $usuarion ?>">
        <input name="cve_egresado" type="hidden" value="<?= $egresado->cve_egresado; ?>">

            <label for="nombre" class="colocar_nombre">Nombre completo *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="nombrec" id="username" value="<?= $egresado->nombrec; ?>"  readonly>

            <label for="nombre" class="colocar_nombre">Género *
            <span class="obligatorio">*</span>
            </label>
            <select name="genero" class="seleccionar" >
            <option value="<?= $egresado->genero; ?>"><?= $egresado->genero; ?></option>
            </select>
            
            <label for="nombre" class="colocar_nombre">Telefono *
            <span class="obligatorio">*</span>
            </label>
            <input type="number" name="telefono" id="username" value="<?= $usuarios->telefono; ?>"  readonly>

            <label for="nombre" class="colocar_nombre">Email *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="email" id="username" value="<?= $usuarios->email; ?>"  readonly>

            <label for="nombre" class="colocar_nombre">País *
            <span class="obligatorio">*</span>
            </label>
            <select name="pais" class="seleccionar" >
            <option value="<?= $egresado->pais; ?>"><?= $egresado->pais; ?></option>
            </select>
        
            <label for="nombre" class="colocar_nombre">Domicilio*
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="domicilio" id="username" value="<?= $curriculum->domicilio?>"  require>

            <label for="nombre" class="colocar_nombre">Ciudad *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="ciudad" id="username" value="<?= $egresado->ciudad; ?>" required>

            <label for="nombre" class="colocar_nombre">Nombre de la universidad *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="universidad" id="username" value="<?= $curriculum->nombreuniver?>" required>

            <label for="nombre" class="colocar_nombre">Carrera *
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="carrera" id="username" value="<?= $curriculum->carrera?>" required>

            <label for="nombre" class="colocar_nombre">Perfil profesional *
            <span class="obligatorio">*</span>
            </label>
            <textarea name="perfilpro" rows="10" cols="48" style="border-color: #f3cf47;" ><?= $curriculum->perfilpro?></textarea>


         <button type="submit" name="enviar_formulario"  id="enviar">
            <p>Completar Curriculum</p>
         </button>
      </form>
   </div>
</div>

<?php else:?>
   <div class="contact_form">
   <div class="formulario">
      <h1>Crear Curriculum Vitae</h1>
      <h3>Oh, oh, esto no debería estar aquí :(</h3>
      <h3 style="color:gray; text-align: justify; padding-right:32px;">Al parecer aún no has completado tu perfil de egresado, hazlo ahora para poder crear tu Curriculum, vamos intentalo, te queda un ultimo paso :D</h3>
      <form action="perfilegresado.php">
         <button type="submit" name="enviar_formulario"  id="enviar">
            <p>Completa tu perfil</p>
         </button>
      </form>
   </div>
</div>
<?php endif?>
<?php include("include/js.php")?>
</body>
</html>