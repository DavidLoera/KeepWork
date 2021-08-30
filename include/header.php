<?php

//Verificacion si el usuario sigue conectado a la aplicacion

session_start();
if($_SESSION["rol"] == null):

?>

<header>
   <nav class="navbar navbar-expand-lg navbar-light bg-light ">
      <a href="index.php" >
      <span class="navbar-brand mb-0 h1"><img src="public/img/kw-logo.png" alt="Keep Work - Logo" style="width: 190px; ; padding-left: 20px;"></span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ml-auto">
         <li class="nav-item active">
            <a class="nav-link" href="Index.php"><span style="opacity:0;">S</span>Inicio<span style="opacity:0;">S</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="crear.php"><span style="opacity:0;">S</span><span style="color: #3498DB; ">Crear tu Curriculum Vitae</span><span style="opacity:0;">S</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="empresas.php"><span style="opacity:0;">S</span>Empresas<span style="opacity:0;">S</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="signup.php"><span style="opacity:0;">S</span>Registrarse<span style="opacity:0;">S</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="signin.php"><span style="opacity:0;">S</span>Iniciar sesión<span style="opacity:0;">S</span></a>
         </li>
      </div>
   </nav>
</header>

<?php else: 
	
	session_start();

?>

<header>
   <nav class="navbar navbar-expand-lg navbar-light bg-light ">
      <a href="index.php" >
      <span class="navbar-brand mb-0 h1"><img src="public/img/kw-logo.png" alt="Keep Work - Logo" style="width: 190px; ; padding-left: 20px;"></span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ml-auto">

         <li class="nav-item active">
                <?php
                       if($_SESSION['rol'] == 1){
                        echo "<a class='nav-link' href='crear.php'><span style='opacity:0;'>S</span><span style='color: #3498DB; '>Crear tu Curriculum Vitae</span><span style='opacity:0;'>S</span></a>";
                       }elseif($_SESSION['rol'] == 2){
                        echo "<a class='nav-link' href='buscar.php'><span style='opacity:0;'>S</span><span style='color: #3498DB; '>Buscar egresados</span><span style='opacity:0;'>S</span></a>";
                       }
                ?>
         </li>
         <li class="nav-item active">
                <?php
                       if($_SESSION['rol'] == 1){
                        echo "<a class='nav-link' href='mensajes.php'><span style='opacity:0;'>S</span><span style='color: #3498DB; '>Mis mensajes</span><span style='opacity:0;'>S</span></a>";
                       }
                ?>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="empresas.php"><span style="opacity:0;">S</span>Empresas<span style="opacity:0;">S</span></a>
         </li>
         <li class="nav-item active">
                <?php      
                       if($_SESSION['rol'] == 1){
                          echo "<a class='nav-link' href='egresado.php'><span style='opacity:0;'>S</span>  Perfil egresado <span style='opacity:0;'>S</span></a>";
                       }elseif($_SESSION['rol'] == 2){
                          echo " <a class='nav-link' href='empresa.php'><span style='opacity:0;'>S</span>Perfil empresa <span style='opacity:0;'>S</span></a>";
                       }
                ?>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="config/logout.php"><span style="opacity:0;">S</span>Cerrar sesión<span style="opacity:0;">S</span></a>
         </li>
         
      </div>
   </nav>
</header>

<?php endif ?>