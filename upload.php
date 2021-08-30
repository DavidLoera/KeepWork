<?php

include('config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $con->real_escape_string(htmlentities($_POST['title']));
    $description = $con->real_escape_string(htmlentities($_POST['description']));
    $egresado = $con->real_escape_string(htmlentities($_POST['cve_egresado']));

    $file_name = $_FILES['file']['name'];

    $new_name_file = null;

    if ($file_name != '' || $file_name != null) {
        $file_type = $_FILES['file']['type'];
        list($type, $extension) = explode('/', $file_type);
        if ($extension == 'pdf') {
            $dir = 'files/';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $file_tmp_name = $_FILES['file']['tmp_name'];
            //$new_name_file = 'files/' . date('Ymdhis') . '.' . $extension;
            $new_name_file = $dir . file_name($file_name) . '.' . $extension;
            if (copy($file_tmp_name, $new_name_file)) {
                
            }
        }
    }
    // UPDATE curriculum SET title = '$title', description= '$description', url = '$new_name_file' WHERE cve_egresado = $egresado
    $ins = $con->query("UPDATE curriculum SET title = '$title', description= '$description', url = '$new_name_file' WHERE cve_egresado = $egresado");

    if ($ins) {
        echo 'Curriculum Subido sastifactoriamente';
    } else {
        echo 'Erro al subir el archivo';
    }
} else {
    echo 'Fallido - Error en el servidor';
}
