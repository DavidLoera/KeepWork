<?php 

include_once 'config/database.php';

session_start();

if(isset($_GET['cerrar_sesion'])){
    session_unset(); 

    // destroy the session 
    session_destroy(); 
}

if(isset($_POST['username']) && isset($_POST['pass'])){
   $username = $_POST['username'];
   $password = $_POST['pass'];

   $pass = md5($password);

   $db = new Database();

   $consulta= "SELECT username FROM users WHERE username = :username";
   $consultusu = $db->connect()->prepare($consulta);
   $consultusu ->execute(['username'=> $username]);
   $row2 = $consultusu->fetch(PDO::FETCH_NUM);

   $consulta1= "SELECT cve_usuarios FROM users WHERE username = :username";
   $consultaauth = $db->connect()->prepare($consulta1);
   $consultaauth ->execute(['username'=> $username]);
   $usuario = $consultaauth->fetchAll(PDO::FETCH_OBJ);

   $query = $db->connect()->prepare('SELECT *FROM users WHERE username = :username AND pass = :pass');
   $query->execute(['username' => $username, 'pass' => $pass]);

   $row = $query->fetch(PDO::FETCH_NUM);
   if($row2 == true){
   if($row == true){
       $rol = $row[1];
       
       $_SESSION['rol'] = $rol;
       
       switch($rol){
           case 1:
                foreach($usuario as $usu){
                    $ida = $usu->cve_usuarios;
                }
                $_SESSION['username'] = $username ;
                header("location: egresado.php?cve_usuarios='$ida'");
              
           break;

           case 2:
            foreach($usuario as $usu){
                $_SESSION['username'] = $username ;
                $ida = $usu->cve_usuarios;
                header("location: empresa.php?cve_usuarios='$ida'");
            }
          
           break;

           default:
       }
   }else{
       $error = "<div class='alert alert-danger' role='alert' style='width:410px;'>Nombre de usuario o contraseña incorrectos</div>";
   }
}else{
    $error = "<div class='alert alert-danger' role='alert' style='width:410px;'>El usuario no existe, <a href='signup.php' style='text-decoration:none;'>Registralo ahora</a></div>";
}
}


?>

<!DOCTYPE html>
<html lang="es">
<?php include("include/head.php")?>
<body>
<?php include("include/header.php")?>

<?php

//Verificacion si el usuario sigue conectado a la aplicacion

session_start();
if($_SESSION["rol"] == null):

?>
<br><br>
<div align="center"><div class="circulo"><div class="iniciar"><img src="public/img/icono.png" alt="GameWar"></div></div></div>
<div class="contact_form">
<?php echo $error; ?>
   <div class="formulario">
      <h1>Inicia sesión</h1>
      <h3>Es hora de buscar empleos</h3>
      <form method="POST" action="">
            <label for="nombre" class="colocar_nombre">Nombre de usuario
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="username"" placeholder="Escribe tu Username">

            <label for="nombre" class="colocar_nombre">Contraseña
            <span class="obligatorio">*</span>
            </label>
            <input type="password" name="pass"  placeholder="Escribe tu clave">
         
            <button type="submit" name="enviar_formulario"  id="enviar">
            <p>Iniciar sesión</p>
         </button>
      </form>
   </div>
</div><br><br><br><br>

<?php else: 
	
	session_start();

	?>
<br><br><br>
<div align="center"><div class="circulo"><div class="iniciar"><img src="public/img/icono.png" alt="Keep Work"></div></div></div><br>
<div class="contact_form">
    <div class="formulario">      
      <h1>Inicia sesión</h1>
        <h3>Usted ya está dentro😄</h3>
          <form method="">       
                <div class="auth">
                <?php
                       if($_SESSION['rol'] == 1){
                           echo "<a href='egresado.php' style='color: #f3cf47;'><p>Entrar ahora</p></a>";
                       }elseif($_SESSION['rol'] == 2){
                           echo "<a href='empresa.php'><p>Entrar ahora</p></a>";
                       }
                ?>
                </div>
                <div align="center"><p>ó</p></div>
                <div class="auth">
                <a href="config/logout.php"><p>Cierra sesión</p></a>
                </div> 
          </form>
    </div>  
  </div><br><br><br><br><br><br>

  <?php endif ?>
<?php include("include/footer.php")?>
<?php include("include/js.php")?>
</body>
</html>