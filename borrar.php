<?php

include 'utility.php';
include 'estudiante.php';
include 'IServiceBase.php';
include 'EstudianteServiceCookies.php';

$service = new EstudianteServiceCookie();

$isContainId = isset($_GET['id']);


if($isContainId){
    $estudianteId = $_GET['id'];

    $service->Delete($estudianteId);
}

header("location:index.php");
exit();
?>