<?php 
include 'utility.php';
session_start();

sif(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['estado']) ){

    $_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array();

    $estudiantes = $_SESSION['estudiantes'];
    $id = 1;

    if(!empty($estudiantes)){
       $lastElement = getLastElement($estudiantes);
       $id = $lastElement['id'] +1;
    }

    array_push($estudiantes, ['id'=>$id,'nombre'=> $_POST['nombre'], 'apellido'=> $_POST['apellido'], 'carrera'=> $_POST['carrera'], 'estado'=>$_POST['estado'] ]);
       
        $_SESSION['estudiantes'] = $estudiantes;

        header('location: index.php');
        exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<hr>

<h1 class="container bg-primary radius text-white" style="border-radius:3px">Registro de estudiantes ITLA</h1>

<form action="agregarEstudiantes.php" method="post">

    <div class="formu container border jumbotron">

                <label for="nombre">NOMBRE</label>
                <input class="form-group form-text" type="text" style="width:600px" name="nombre" id="nombre">
            
                <label for="apellido">APELLIDO</label>
                <input class="form-group form-text" type="text" style="width:600px" name="apellido" id="nombre">
            
                <label for="carrera">CARRERA</label>
                <select class="form-group form-text" name="carrera" id="carrera">
            <?php 
                    
            foreach($carreras as $id => $nombreCarreras): ?>
                    <option value="<?php echo $id; ?>"> <?php echo $nombreCarreras; ?> </option>
            <?php endforeach; ?>
                </select>
   
        <div>
        <label for="estado">ESTADO</label>
        <input type="radio"  name="estado" value="activo" checked><label for="activo">ACTIVO</label>
        <input type="radio"  name="estado" value="inactivo"><label for="inactivo">INACTIVO</label>
        </div>
        
        <hr>
        <input type="submit" value="GUARDAR" class="btn btn-success">
     
    </div>

        

</form>



</body>
</html>