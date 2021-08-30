<?php

/*Clase para la conexión a la base de datos*/ 

 class Conexion{

     public static function Conectarse(){

        $servidor = "421aa90e079fa326b6494f812ad13e79";
        $nombredb = "ed751827152fe0c0bbe4c83432b3add1";
        $user = "63a9f0ea7bb98050796b649e85481845";
        $password = "a7dfb2a9d77e269b2b22052211a71542";

         define('servidor','localhost');

         define('nombre_bd','keepwork');

         define('usuario','root');
         
         define('password','Vale');
         
         $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
         
         try{
            $conexion = new PDO("mysql:host=".servidor.";dbname=".nombre_bd, usuario, password, $opciones);             
            return $conexion; 
         }catch (Exception $e){
             die("El error de Conexión es :".$e->getMessage());
         }         
     }
     
 }
?>