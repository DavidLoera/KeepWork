<?php

$servidor = "421aa90e079fa326b6494f812ad13e79";
$nombredb = "ed751827152fe0c0bbe4c83432b3add1";
$user = "63a9f0ea7bb98050796b649e85481845";
$password = "a7dfb2a9d77e269b2b22052211a71542";

$con = new mysqli('localhost', 'root', 'Vale', 'keepwork');
if ($con->connect_errno) {
    die('fail');
}

function file_name($string) {

    // Tranformamos todo a minusculas

    $string = strtolower($string);

    //Rememplazamos caracteres especiales latinos

    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

    $repl = array('a', 'e', 'i', 'o', 'u', 'n');

    $string = str_replace($find, $repl, $string);

    // Añadimos los guiones

    $find = array(' ', '&', '\r\n', '\n', '+');
    $string = str_replace($find, '-', $string);

    // Eliminamos y Reemplazamos otros carácteres especiales

    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

    $repl = array('', '-', '');

    $string = preg_replace($find, $repl, $string);

    return $string;
}
