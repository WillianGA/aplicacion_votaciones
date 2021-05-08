<?php
session_start();
require_once("../../databases/connection.php");

$insertar=false;

if(isset($_POST["tipoCandidato"]) && isset ($_POST["cedcandidato"]) && isset($_POST["ncandidato"]) && isset($_POST["codcandidato"])
&& $_POST["tipoCandidato"]<>"" && $_POST["cedcandidato"]<>"" && $_POST["ncandidato"]<>"" && $_POST["codcandidato"]<>""){
    //echo "Llega candidato";
  $tipocandidato=$_POST["tipoCandidato"];
  $documentoidentidad=$_POST["cedcandidato"];
  $nombre=$_POST["ncandidato"];
  $codigocandidato=$_POST["codcandidato"];
  $insertar=true;
}

if(isset($_POST['boton'])){
    //echo "Llega el boton";
  $boton = $_POST['boton'];
  switch($boton){
    case "Ingresar":
            echo "$insertar";
            
            if($insertar==true){
                if($tipocandidato=="1"){
                  $sql="INSERT INTO candidatos (ced_canditato,nombre,cod_candidato)
                  VALUES ($documentoidentidad,'$nombre',$codigocandidato)";
                }else{
                  $sql="INSERT INTO candidatosc (ced_canditatoC,nombre,cod_candidatoC)
                  VALUES ($documentoidentidad,'$nombre',$codigocandidato)";
                }
                
          
                $resultado = mysqli_query($conn, $sql);
                ?>
            <script>
                alert("Candidato registrado con exito!");
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
        echo "<script> alert('Usted no ha ingresado candidatos, vuelva luego');
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
    
    <title>Menú de Administración de Votaciones</title>
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
    <h1>Ingrese Un Nuevo Candidato</h1>
  </div>
</header>
<section id ="central">
<form action="cargar_candidato.php" role="form" method="post">
  <div class="form-group">
  <label for="tipoCandidato">Tipo de Candidato:</label>
    <select name="tipoCandidato" class="form-control" id="tipoCandidato" >
    <option value="1">Personero</option>
    <option value="2">Contralor</option>
    </select>
    <label for="tialumno">Documento de identidad:</label>
    <input type="number" name="cedcandidato" class="form-control" id="cedcandidato"
           placeholder="Tarjeta de identidad">
    <label for="nalumno">Nombres y apellidos:</label>
    <input type="text" name="ncandidato" class="form-control" id="ncandidato"
           placeholder="Nombres y apellidos">
           <label for="calumno">Codigo del Candidato</label>
    <input type="number" name="codcandidato" class="form-control" id="codcandidato"
           placeholder="Codigo del candidato">
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