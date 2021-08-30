<?php 

include_once 'config/database.php';

session_start();

if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['num']) && isset($_POST['email']) && isset($_POST['tipod'])){
   $username = $_POST['username'];
   $password = $_POST['pass'];
   $numero = $_POST['num'];
   $email = $_POST['email'];
   $tipode = $_POST['tipod'];

   $pass = md5($password);

   $db = new Database();
   $consulta2= "SELECT username FROM users WHERE username = :username";
   $consultaauth = $db->connect()->prepare($consulta2);
   $consultaauth ->execute(['username'=> $username]);
   
   $consulta = "INSERT into users (cve_cargo, username, pass, email, telefono) VALUES(:tipode, :username, :pass, :email, :num)";
   $query = $db->connect()->prepare($consulta);

   $row = $consultaauth->fetch(PDO::FETCH_NUM);
   if($row == false){
   if( $query->execute(['username' => $username, 'pass' => $pass, 'email' => $email, 'tipode' => $tipode, 'num' => $numero])){
      $authr = "<div class='alert alert-success' role='alert' style='width:410px;'>Añadido con exito, <a href='signin.php' style='text-decoration:none;'>Ingrese ahora</a></div>";
   }else{
      $authr = "<div class='alert alert-danger' role='alert' style='width:410px;'>Error al añadir usuario</div>";
   }
   }else{
      $authr = "<div class='alert alert-danger' role='alert' style='width:410px;'>Usuario existente</div>";
   }
}


?>

<!DOCTYPE html>
<html lang="es">
<?php include("include/head.php")?>
<body>
<?php include("include/header.php")?>
<br><br>
<div align="center"><div class="circulo"><div class="iniciar"><img src="public/img/icono.png" alt="GameWar"></div></div></div>
<div class="contact_form">
   <div class="formulario">
   <?php echo $authr;  ?>
      <h1>Registrarse</h1>
      <h3>Busca tu primer empleo</h3>
      <form method="POST" action="">
            <label for="nombre" class="colocar_nombre">Nombre de usuario
            <span class="obligatorio">*</span>
            </label>
            <input type="text" name="username" id="username" placeholder="Escribe tu Username" required>
            
            <label for="nombre" class="colocar_nombre">Contraseña
            <span class="obligatorio">*</span>
            </label>
            <input type="password" name="pass" id="pass" placeholder="Escribe tu clave" required>
        
            <label for="nombre" class="colocar_nombre">Telefono
            <span class="obligatorio">*</span>
            </label>
            <input type="number" name="num" id="num" placeholder="Escribe tu telefono" required>   
            
            <label for="nombre" class="colocar_nombre">Correo electronico
            <span class="obligatorio">*</span>
            </label>
            <input type="email" name="email" id="email" placeholder="Escribe tu correo electronico" required>

            <label for="nombre" class="colocar_nombre">Tipo de Usuario
            <span class="obligatorio">*</span>
            </label>
            <select name="tipod" class="seleccionar">
            <option value="1">Estudiante o egresado</option>
            <option value="2">Empresa</option>
            </select>

         <button type="submit" name="enviar_formulario"  id="enviar">
            <p>Registrarse</p>
         </button>
      </form>
   </div>
</div>
<?php include("include/footer.php")?>
<?php include("include/js.php")?>
</body>
</html>