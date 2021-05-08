<?php
session_start();
require_once("../../databases/connection.php");

$insertar=false;

if(isset($_POST["calumno"])&& isset($_POST["tialumno"]) && isset($_POST["nalumno"])
&& $_POST["calumno"]<>"" && $_POST["tialumno"]<>"" && $_POST["nalumno"]<>""){
    //echo "Llega candidato";
  $curso=$_POST["calumno"];
  $tarjetaidentidad=$_POST["tialumno"];
  $nombre=$_POST["nalumno"];
  $insertar=true;
}

if(isset($_POST['boton'])){
    //echo "Llega el boton";
  $boton = $_POST['boton'];
  switch($boton){
    case "Ingresar":
            echo "$insertar";
            
            if($insertar==true){
                $sql="INSERT INTO alumnos (ced_alumno,nombre,carrera,cod_candidato,cod_candidatoC,voto)
                VALUES ($tarjetaidentidad,'$nombre','$curso',0,0,0)";
          
                $resultado = mysqli_query($conn, $sql);
                ?>
            <script>
                alert("Estudiante registrado con exito!");
                window.location='menuadmin.php';
            </script>
            <?php
            }else{
                ?>
                <script>
                alert("Por favor llene todos los campos del formulario!");
                </script>
                <?php
            }    
    break;
    case "Cancelar":
        echo "<script> alert('Usted no ha ingresado alumnos, vuelva luego');
          window.location='menuadmin.php';
        </script>";
    break;
  }
}
?>
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
    <link rel="stylesheet" href="../../css/style.css">
    
    <title>Menú de Administración</title>
</head>
<body>
<header>
    <section id="cabecera">
        <div class="container">
        <div class="avatar">
            <img class="imagen" src="../../img/sociales.jpg">
        </div>
            <div class="titulopagina">
                <h1>SISTEMA DE VOTACIONES ESCOLAR</h1>
                <h3>2021</h3>
            </div>
            <div class="avatar1">
            <img class="logocol" src="../../img/escudo.png" alt="NUSLA">
            </div>
        </div>
</section>

<br><br>
  <div class="title" align="center">
    <h1>Ingrese Un Nuevo Alumno</h1>
  </div>
</header>
<section id ="central">
<form action="cargar_alumnos.php" role="form" method="post">
  <div class="form-group">
  <?php
                $sql="SELECT * FROM carreras";
                $resultadocarreras = mysqli_query($conn, $sql);
                $num_reg = mysqli_num_rows($resultadocarreras); //Se usa cuando usas select
              ?>
    <label for="calumno">Curso</label>
    <select name="calumno" id="calumno" class="form-control" value="">
    <?php 
                    for($i=0; $i<$num_reg;$i++){
                      $carreras = mysqli_fetch_array($resultadocarreras);
                      $nomcarrera = $carreras["carrera"];
                  ?>
                  <option value="<?php echo $nomcarrera ?>"> <?php echo $nomcarrera ?></option>
                  <?php
                    }
                  ?>
    </select>
    <label for="tialumno">Escribe tu número de tarjeta de identidad:</label>
    <input type="number" name="tialumno" class="form-control" id="tialumno"
           placeholder="Tarjeta de identidad">
    <label for="nalumno">Nombres y apellidos:</label>
    <input type="text" name="nalumno" class="form-control" id="nalumno"
           placeholder="Nombres y apellidos">
    
  </div>
    <input type ="submit" class="btn btn-primary" name="boton" Value="Ingresar">
    <input type ="submit" class="btn btn-danger" name="boton" Value="Cancelar">

</form>
</section>
<footer>    
    <p><strong>copyright &copy; 2021</strong></p>
    <p><strong>Diseñado: JHON JAMES CRIOLLO</p>
        <p>WILLIAN AREVALO</strong></p>
</footer>
</body>
</html>