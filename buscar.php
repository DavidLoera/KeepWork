<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: signin.php');
    }else{
        if($_SESSION['rol'] != 2){
            header('location: signin.php');
        }
    }

    include_once 'config/conexion.php';
    include_once 'config/data.php';

    $objeto = new Conexion();
    $conexion = $objeto->Conectarse();
    $usuarion = $_SESSION['username'];
    
    $id = $_GET['cve_empresa'];
    
    $sql = 'SELECT * from curriculum';
    $statement2 = $conexion->prepare($sql);
    $statement2->execute();
    $empresa= $statement2->fetchAll(PDO::FETCH_OBJ);


    
?>

<!DOCTYPE html>
<html lang="es">
<?php include("include/head.php")?>
<body>
<?php include("include/header.php")?><br><br><br>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>Nombre del egresado</th>
            <th>Genero</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Pais</th>
            <th>Domicilio</th>
            <th>Nombre universidad</th>
            <th>Carrera</th>
            <th>Perfil profesional</th>
            <th>CV</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($empresa as $empre): ?>
        <tr>
        
            <td><?= $empre->nombreegresado;?></td>
            <td><?= $empre->genero;?></td>
            <td><?= $empre->telefono;?></td>
            <td><?= $empre->email;?></td>
            <td><?= $empre->pais;?></td>
            <td><?= $empre->domicilio;?></td>
            <td><?= $empre->nombreuniver;?></td>
            <td><?= $empre->carrera;?></td>
            <td><?= $empre->perfilpro;?></td>
            <?php if($empre->url == true): ?>
            <td>
            <button onclick="openModelPDF('<?php echo $empre->url ?>')" class="btn btn-primary" type="button">Ver</button>
            <a class="btn btn-primary" target="_black" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/keepwork/' . $empre->url; ?>" >Ver Archivo pagina</a>
            </td>
            <?php else: ?>
            <td>
                No CV
            </td>
            <?php endif ?>
        </tr>
        <?php endforeach ?>
        <tbody>
    </table>
</div>

    



<div class="modal fade" id="modalPdf" tabindex="-1" aria-labelledby="modalPdf" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Curriculum </td></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="iframePDF" frameborder="0" scrolling="no" width="100%" height="600px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>


        <script>
                function openModelPDF(url) {
                    $('#modalPdf').modal('show');
                    $('#iframePDF').attr('src','<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/keepwork/'; ?>'+url);
                }
        </script>

<?php include("include/js.php")?>
</body>
</html>