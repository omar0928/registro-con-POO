<?php 

include 'utility.php';
include 'estudiante.php';
include 'IServiceBase.php';
include 'EstudianteServiceCookies.php';

$service = new EstudianteServiceCookie();
$utilities = new Utilities();

if(isset($_GET['id'])){
    $estudianteID = $_GET['id'];

    $elemento = $service->GetById($estudianteID);

    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['estado']) ){
    
        $updateEstudiante = new Estudiante();

        $updateEstudiante->InicializeData($estudianteID,$_POST['nombre'],$_POST['apellido'],$_POST['carrera'],$_POST['estado']);

        $service->Update($estudianteID,$updateEstudiante);

            header('location: index.php');
            exit();
    }


}else{

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

<h1 class="container bg-danger radius text-white" style="border-radius:3px">Editar datos Estudiantes ITLA</h1>

<form action="editar.php?id=<?php echo $elemento->id; ?>" method="post">

    <div class="form container border">

                    <label for="nombre">Nombre</label>
                    <input class="form-group form-text" value="<?php echo $elemento->nombre; ?>" type="text" style="width:300px"style="padding: 12px 20px;" name="nombre" id="nombre">
                
                    <label for="apellido">Apellido</label>
                    <input class="form-group form-text" value="<?php echo $elemento->apellido; ?>" type="text" style="width:300px" name="apellido" id="apellido">
                
                    <label for="carrera">Carrera</label>
                    <select class="form-group form-text" name="carrera" id="carrera">
                <?php 
                        
                foreach($utilities->carreras as $id => $nombreCarreras): ?>

                    <?php if($id == $elemento->carreras): ?> 
                        <option selected value="<?php echo $id; ?>"> <?php echo $nombreCarreras; ?> </option>
                    <?php else: ?> 
                        <option  value="<?php echo $id; ?>"> <?php echo $nombreCarreras; ?> </option>
                    <?php endif; ?> 

                <?php endforeach; ?>
                    </select>
    
         <div>
         <label for="estado">Estado</label>
            <input type="radio"  name="estado" value="activo" checked><label for="activo">Activo</label>
            <input type="radio"  name="estado" value="inactivo"><label for="inactivo">Inactivo</label>
            </div>
            
            <hr>
            <input type="submit" value="GUARDAR" class="btn btn-primary">
            <a href="index.php"><input type="submit" value="ATRAS" class="btn btn-danger"></a>
        
         </div>
    </div>

        

</form>



</body>
</html>