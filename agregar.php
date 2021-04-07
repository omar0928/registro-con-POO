<?php 

include 'utility.php';
include 'estudiante.php';
include 'IServiceBase.php';
include 'EstudianteServiceCookies.php';

$service = new EstudianteServiceCookie();
$utilities = new Utilities();



if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['estado']) && isset($_FILES['profilePhoto'])){
  
    $newEstudiante = new Estudiante();

    $newEstudiante->InicializeData(0,$_POST['nombre'],$_POST['apellido'],$_POST['carrera'],$_POST['estado']);
   
    $service->Add($newEstudiante);       
     
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>add</title>
</head>
<body>
<hr>

<h1 class="container bg-danger radius text-white" style="border-radius:3px">Registro de estudiantes ITLA</h1>

<form enctype="multipart/form-data" action="agregar.php" method="post">

    <div class="form container border ridge">

                <label for="nombre">Nombre</label>
                <input class="form-group form-text" type="text" style="width:600px" name="nombre" id="nombre">
            
                <label for="apellido">ApellidoO</label>
                <input class="form-group form-text" type="text" style="width:600px" name="apellido" id="nombre">
            
                <label for="carrera">Carrera</label>
                <select class="form-group form-text" name="carrera" id="carrera">
            <?php 
                    
            foreach($utilities->carreras as $id => $nombreCarreras): ?>
                    <option value="<?php echo $id; ?>"> <?php echo $nombreCarreras; ?> </option>
            <?php endforeach; ?>
                </select>
   
        <div>
        <label for="estado">Estado</label>
        <input type="radio"  name="estado" value="activo" checked><label for="activo">Activo</label>
        <input type="radio"  name="estado" value="inactivo"><label for="inactivo">Inactivo</label>
        </div>
        
        <label for="foto" class="mt-3">Foto de Perfil:</label>
        <input class="form-control" type="file" name="profilePhoto" id="foto">

        <hr>
        <input type="submit" value="GUARDAR" class="btn btn-danger">
     
    </div>

        

</form>



</body>
</html>