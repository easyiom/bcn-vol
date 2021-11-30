<?php

require_once '../services/conection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <!-- librerias-->
    <script type="text/javascript" src="../js/jquery.js"></script><!-- jquery-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!-- sweetalert-->
    <script type="text/javascript" src="../js/iconos_g.js"></script><!-- iconos FontAwesome-->
    <script type="text/javascript" src="../js/js.js"></script>
    <link rel="icon" type="image/png" href="../img/icon.png">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="menu">
    <div class="region-inicio flex-cv">
        <table>
            <thead>
                <tr><form action="./historial.php" method="POST">
                        <th><input type="number" id="" name="id_res" placeholder="ID reserva"></th>
                        <th><input type="date" id="" name="horaini" placeholder="Inicio"></th>
                        <th><input type="date" id="" value="" name="horafi" placeholder="Final"></th>
                        <th><input type="text" id="" name="datos_res" placeholder="Nombre reserva"></th>
                    </form>
                </tr>
                <tr>
                    <th>Id</th>
                    <th>Nom event</th>
                    <th>Inici</th>
                    <th>Fi</th>
                    <th>Direcció</th>
                </tr>  
            </thead>
            <tbody>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
                <td><button class="btn-abrirPop">Abrir Popup</button></td>
            </tbody>
        </table>
    </div>

    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
            
            <div class="contenedor-popup">
                <div class="form-body">
                <h3>Apuntarse a evento <span class="numeroEj"></span></h3>
    
            <form class="" id="apunt-event" action="../procedures/inscripcion.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_events" value="<?php echo $id_evento; ?>">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre">
                <label for="apellido">Apellidos</label>
                <input type="text" name="apellido">
                <label for="edad">Fecha de nacimiento</label>
                <input type="date" name="edad">
                <label for="sexe">Sexo</label>
                <div>
                    <!-- se podria cojer de la base de datos -->
                    <input type="radio" name="sexe" value="Hombre">
                    <input type="radio" name="sexe" value="Mujer">
                    <input type="radio" name="sexe" value="Otro">
                </div>
                <label for="dni">DNI</label>
                <input type="text" size="10" name="dni">
                <label for="telf">Teléfono</label>
                <input type="number" name="telf">
                <label for="email">Email</label>
                <input type="email" name="email">
                <label for="foto">Foto (opcional)</label>
                <input type="file" name="foto">
                <label for="contrasenya">Quieres crearte una cuenta?</label>
                <input type="checkbox" name="contrasenya">
                <div class="login"></div>
                <input type="submit">
            </form>
            <div class="login">
                <form action="../procedures/ins-user-creado.php" method="POST">
                    <input type="email" name="email_user" id="email_user">
                    <input type="password" name="pass_user" id="pass_user">
                    <input type="submit">
                </form>
            </div>

                </div>
            </div>
        </div>
    </div>


    <div class="burger-menu" id="burger-menu">
        <input type="checkbox" href="#"  class="menu-open" name="menu-open" id="menu-open"/>
        <label class="menu-open-button" for="menu-open">
            <span class="hamburger hamburger-1"></span>
            <span class="hamburger hamburger-2"></span>
            <span class="hamburger hamburger-3"></span>
        </label>
    </div>
    
</body>
</html>

