<?php
session_start();

$nomEstudiante = $_SESSION["nombreest"];
$cursoEstudiante = $_SESSION["curso"];
$cedulaAlumno = $_SESSION["cedulaAlumno"];
require_once("../databases/connection.php");
//echo "Bienvenido estudiante: " .$nomEstudiante." del curso: " .$cursoEstudiante;

$vacio = isset($_POST['variable']) ? $_POST['variable']:null;
$acceso = isset($_POST['variable']) ? $_POST['variable']:null;

if(empty($acceso)){
  //echo "El dato es vacío";
}

if(isset($_POST["candidato"])){
    //echo "Llega candidato";
  $codigofcandidato=$_POST["candidato"];
  $codigohcandidato=$_POST["candidatoC"];
  
}else{
    $codigofcandidato="";
    $codigohcandidato="";
  }

if(isset($_POST['boton'])){
    //echo "Llega el boton";
  $boton = $_POST['boton'];
  switch($boton){
    case "Votar":
          $sql="UPDATE alumnos SET voto='1', cod_candidato='$codigofcandidato', cod_candidatoC='$codigohcandidato' 
          WHERE ced_alumno='$cedulaAlumno'";
          
          $resultado = mysqli_query($conn, $sql);
          ?>
          <script>
            alert("Gracias por Votar!");
            window.location="../index.php";
          </script>
          <?php
    break;
    case "Cancelar":
        echo "<script> alert('Usted no ha votado, vuelva luego');
          window.location='../index.php';
        </script>";
    break;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Revalia&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style1.css">
    <title>Selección de Candidatos</title>

</head>
<body>
<header>
    <section id="cabecera">
        <div class="container">
            <div class="avatar">
            <img class="imagen" src="../img/sociales.jpg">
            </div>
        </div>
            <div class="titulopagina">
            <h1>SISTEMA DE VOTACIONES</h1>
            <h3>2021</h3>
            </div>
            <div class="avatar1">
            <img class="logocol" src="../img/escudo.png" alt="NUSLA">
            </div>
            <div class="avatar2">
            <img class="logousuario" src="../img/login.jpeg" alt="NUSLA">
            </div>
        </section>

        <div class = 'container-fluid'>
  <div class = 'row'>
    <div class = 'col-md-6 col-md-offset-3'>
   <!-- <h1 class = 'text-center'>Sistema De Votaciones</h1>-->
     </div>
  </div>
  <hr>
</div>
      <div class="container">
        <div class="center-block col-md-12 col-xs-8">
          <?php echo "Bienvenido estudiante: " .$nomEstudiante." del curso: " .$cursoEstudiante;?>
        </div><br><br>
        <form name="acceso" action="menuestudiante.php" role="form" method='POST'>
        <div class="md-12">
          <fieldset>
              <legend><en><strong>Candidatos a personero</strong></en></legend>
              <?php
                $sql="SELECT * FROM candidatos";
                $resultado = mysqli_query($conn, $sql);
                $num_reg = mysqli_num_rows($resultado); //Se usa cuando usas select
              ?>
              <table border="1">
                <tr>  
                  <?php 
                    for($i=0; $i<$num_reg;$i++){
                      $candidato = mysqli_fetch_array($resultado);
                      $codcandidato = $candidato["cod_candidato"];
                      $nomcandidato = $candidato["nombre"];
                  ?>
                  <td bgcolor="$c3c3c3">
                      <img src="../img/candidatos/<?php echo $codcandidato.".jpg"?>" alt="<?php echo $nomcandidato ?>" width="80px" height="120px"/>
                      <input type="radio" name="candidato" value="<?php echo $codcandidato ?>"/> <br/>
                      <strong>(<?php echo "0".$codcandidato; ?>) <?php echo $nomcandidato; ?> </strong>
                  </td>
                  <?php
                    }
                  ?>
                </tr>
              </table>
              </fieldset>

</section>
<br><br>
<div class="md-12">
          <fieldset>
              <legend><en><strong>Candidatos a Contralor</strong></en></legend>
              <?php
                $sql="SELECT * FROM candidatosc";
                $resultado = mysqli_query($conn, $sql);
                $num_reg = mysqli_num_rows($resultado); //Se usa cuando usas select
              ?>
              <table border="1">
                <tr>  
                  <?php 
                    for($i=0; $i<$num_reg;$i++){
                      $candidatoC = mysqli_fetch_array($resultado);
                      $codcandidato = $candidatoC["cod_candidatoC"];
                      $nomcandidato = $candidatoC["nombre"];
                  ?>
                  <td bgcolor="$c3c3c3">
                      <img src="../img/contralor/<?php echo $codcandidato.".jpg"?>" alt="<?php echo $nomcandidato ?>" width="80px" height="120px"/>
                      <input type="radio" name="candidatoC" value="<?php echo $codcandidato ?>"/> <br/>
                      <strong>(<?php echo "0".$codcandidato; ?>) <?php echo $nomcandidato; ?> </strong>
                  </td>
                  <?php
                    }
                  ?>
                </tr>
              </table>
              </fieldset>
              <br><br>
</div>
<br><br>
              <input type="submit" class="btn btn-primary" name="boton" value="Votar">
              <input type="submit" class="btn btn-danger" name="boton" value="Cancelar">
        </div>
        </form>
    </header>
  <hr>
<footer>    
    <p><strong>copyright &copy; 2021+</strong></p>
    <p><strong>Diseñado: JHON JAMES CRIOLLO</p>
        <p>WILLIAN AREVALO</strong></p>
</footer>
</body>
</html>




