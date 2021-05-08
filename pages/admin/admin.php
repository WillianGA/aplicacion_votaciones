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
    
    <title>Sistema de Votaciones 2021</title>
</head>
<body>
<?php
require_once("../../databases/connection.php");
$vacio = isset($_POST['variable']) ? $_POST['variable']:null;
$acceso = isset($_POST['variable']) ? $_POST['variable']:null;

session_start();
if(empty($acceso)){
    //echo "El acceso no se pudo completar";

}
if(isset($_POST['usuario'])){
    $verusuario = $_POST['usuario'];
}
if(isset($_POST['clave'])){
    $verclave = $_POST['clave'];
}
if(isset($_POST['acceder'])){
    if(empty($verusuario) && empty($verclave)){
        $vacio = true;
    }
    else{
        $sql = "SELECT * FROM usuarios WHERE usuario='$verusuario' and clave='$verclave'";
        $resultado = mysqli_query($conn, $sql);
        $datos = mysqli_fetch_array($resultado);
        $BDusuario = $datos['usuario'];
        $BDclave = $datos['clave'];

        if(isset($BDusuario) && isset($BDclave)){
            $acceso=true;
            //echo $BDusuario.' '.$BDclave;
            //echo "Si accede correctamente";

        }else{
            $acceso=false;
        }

        
    }
}

?>
<header>
    <section id="cabecera">
        <div class="container">
            <div class="avatar">
            <img class="imagen" src="../../img/sociales.jpg">
            </div>
        </div>
        <div class="titulopagina">
      <h1>Sistema de Votación</h1>
      <h4>2021</h4>
    </div>
    <div class="avatar1">
            <img class="logocol" src="../../img/escudo.png" alt="NUSLA">
            </div>
            <div class="avatar2">
            <!--<img class="logousuario" src="../../img/login.jpeg" alt="NUSLA">-->
            </div>
        </section>
 
<section id ="central">
<div class="container">
 <div class="center-block col-md-4 col-xs-8">
    
<form action="admin.php" role="form" method="post">
  <div class="form-group">
    <label for="Usuario">Usuario</label>
    <input type="text" name="usuario" class="form-control" id="usuario"
           placeholder="Usuario">
  </div>
  <div class="form-group">
    <label for="ejemplo_password_1">Contraseña</label>
    <input type="password" name="clave" class="form-control" id="ejemplo_password_1" 
           placeholder="Contraseña">
  </div>


   <input type ="submit" class="btn btn-primary" name="acceder" Value="Ingresar">
</form>
</header>
</div>
</div>
<div align="center">
    <?php
        if($vacio){
            echo "<h1>Los campor están vacíos... Llenar usuario y contraseña</h1>";
        }
        if($acceso){
            echo"<script>alert('Bienvenido al sistema');
                window.location = 'menuadmin.php';</script>
            ";
        }else{
            echo"<h1>Acceso denegado...Usuario y contraseña erronea</h1>";
        }
    ?>
</div>
</section>
<footer>    
    <p><strong>copyright &copy; 2021</strong></p>
    <p><strong>Diseñado: JHON JAMES CRIOLLO</p>
        <p>WILLIAN AREVALO</strong></p>
</footer>
</body>
</html>