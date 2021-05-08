<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Revalia&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Sistema de Votaciones 2021</title>
</head>
<body>
<?php
require_once("databases/connection.php");//incrustar o vincular un archivo php
session_start();//Inicio una sesion de un valor

if(isset($_POST["tialumno"])){
    $estudiante = $_POST["tialumno"];
}

if(isset($_POST["boton"])){
    $boton = $_POST["boton"];
    switch($boton){
        case "Ingresar";
            if(empty($estudiante)){
                $vacio = "si"; //Declaro variable y asigno la palabra si
                break;
            }
        $sql = "SELECT * FROM `alumnos` WHERE ced_alumno = $estudiante";
        $resultado = mysqli_query($conn,$sql);//Guarda un objeto de datos
        $datos = mysqli_fetch_array($resultado); //Array de un solo registro
        //echo $datos['id_alumno'].' '. $datos['nombre'].' '. $datos['carrera'];
        $cedAlumno = $datos['ced_alumno'];
        $nomAlumno = $datos['nombre'];
        //echo $nomAlumno;
        //$carreraAlumno = $datos['carreras'];
        $votoAlumno = $datos['voto'];

        if($estudiante == $cedAlumno){
            $_SESSION["nombreest"] = $nomAlumno;
            $_SESSION["curso"] = $datos['carrera'];
            $_SESSION["cedulaAlumno"] = $cedAlumno;
        
            if($votoAlumno==0){
                echo "<script>
            window.location = 'pages/menuestudiante.php' 
            </script>";
            }else{
            $acceso = "yavoto";
            }
        }else{
            $acceso="denegado";
        }
        break;
        //case "Cancelar";
        //break;

    }
}

?>
<header>
    <section id="cabecera">
        <div class="container">
        <div class="avatar">
            <img class="imagen" src="img/sociales.jpg">
        </div>
            <div class="titulopagina">
                <h1>SISTEMA DE VOTACIONES ESCOLAR</h1>
                <h3>2021</h3>
            </div>
            <div class="avatar1">
            <img class="logocol" src="img/escudo.png" alt="NUSLA">
            </div>
        </div>
</section>

    </header>
  <hr>
<section id ="central">
<div class="container">
<form action="index.php" role="form" method="post">
  <div class="form-group">
    <label for="tialumno">Escribe tu número de tarjeta de identidad:</label>
    <input type="number" name="tialumno" class="form-control" id="alumno"
           placeholder="alumno">
    
  </div>
    <input type ="submit" class="btn btn-primary" name="boton" Value="Ingresar">
    <input type ="submit" class="btn btn-danger" name="boton" Value="Cancelar">

</form>
<div align="center">
    <?php
    if($acceso=="denegado"){
        echo "<h1 class='alerta'>El  número: ".$estudiante." no se encuentra en el sistema</h1>";
    }
    echo $acceso;
    if($acceso=="yavoto"){
        echo "<h1 class='alerta'>Este estudiante ya realizó el voto...Gracias</h1>";
    }
    ?>

</div>
</div>
</section>


<footer>    
    <p><strong>copyright &copy; 2021</strong></p>
    <p><strong>Diseñado: JHON JAMES CRIOLLO</p>
        <p>WILLIAN AREVALO</strong></p>
</footer>
</body>
</html>