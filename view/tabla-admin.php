<?php
session_start();
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
    <link rel="stylesheet" href="../css/menu.css">

</head>
<?php 
$usu=$pdo->prepare("SELECT * from tbl_usuari");
                $usu->execute();
                $usu=$usu->fetchAll(PDO::FETCH_ASSOC);
?>
<body class="tabla-responsable">
    <div class="region-responsable flex-cv">
        <table>
            <thead>
                <!-- <tr><form action="./historial.php" method="POST">
                        <th></th>
                        <th><input type="number" id="" name="id_res" placeholder="ID reserva"></th>
                        <th><input type="text" id="" name="nom_events" placeholder="Nom"></th>
                        <th><input type="date" id="" name="horaini" placeholder="Inicio"></th>
                        <th><input type="date" id="" value="" name="horafi" placeholder="Final"></th>
                        
                        <th>
                            <select name="estat" id="">
                                <option value=""></option>
                                <option value="Activo">Activo</option>
                                <option value="Lleno">Lleno</option>
                            </select>
                        </th>
                    </form>
                </tr> -->
                <tr>
                    <th>Foto</th>
                    <th>Id</th>
                    <th>Nom event</th>
                    <th>Inici</th>
                    <th>Fi</th>
                    <th>Direcci??</th>
                    
                    <th class='btn-abrirPop btn-abrirPop3'>+</th>
                </tr>  
            </thead>
            <tbody>
            <?php foreach ($usu as $usu) { ?>
                <tr>
                <td ><img style="width:50px;" src="<?php echo $usu['foto_user']; ?>"></td>
                    <td><?php echo $usu['id_user']; ?></td>
                    <td><?php echo $usu['email_user']; ?></td>
                    <td><?php echo $usu['nom_user']; ?></td>
                    <td><?php echo $usu['cognom_user']; ?></td>
                    <td><?php echo $usu['dni_user']; ?></td>
                    

                    <td>
                        <form action="../procedures/cookies/admin-cookie.php" method="POST">
                            <input type="hidden" value="<?php echo $usu['id_user']; ?>" name="id_user">
                            <input type="submit" name="enviar" value='ver'>
                        </form>
                        
                    </td>
                    <td>
                        <form action="../procedures/users/eliminar-usuario.php" method="POST">
                            <input type="hidden" value="<?php echo $usu['id_user']; ?>" name="id_user">
                            <input type="submit" name="enviar" value='-'>
                        </form>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <div class="leftMenu" id="leftMenu">
        <?php if(!isset($_SESSION['email'])){?>
            <button type="submit" title="Cerrar sesi??n" class="btn-micromenu color btn-abrirPop btn-abrirPop2"><i class="far fa-sign-out"></i><p>Iniciar sesion</p></button>

        <?php }else{?>
            <button title="Perfil" class="btn-micromenu color" ><a class="a-menu" href='../view/perfil.php'></a><i class="fas fa-user"></i><p>Perfil</p></button>
            <form action="../procedures/logout.proc.php" method="post">
                <button title="Cerrar sesi??n" class="btn-micromenu color"><i class="far fa-sign-out"></i><p>Logout</p></button>
            </form>
        <?php }?>
        <button title="Inicio" class="btn-micromenu color" ><i class="fas fa-home"></i><a class="a-menu" href='../view/inicio.php'></a><p>Inicio</p></button>
        <?php if(isset($_COOKIE["rol"]) && $_COOKIE["rol"]=="SuperUser"){ ?>
            <button title="Admin" class="btn-micromenu color" ><a class="a-menu" href='../view/tabla-admin.php'></a><i class="fas fa-users-cog"></i><p>admin</p></button>
            <?php } ?>
        <?php if(isset($_COOKIE["rol"]) && ($_COOKIE["rol"]=="Responsable" || $_COOKIE["rol"]=="SuperUser")){ ?>
            <button title="Event managment" class="btn-micromenu color" ><a class="a-menu" href='../view/tabla-responsable.php'></a><i class="fas fa-calendar-alt"></i><p>G.Event</p></button>
            <?php } ?>
    </div>




    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
            <div class="contenedor-popup cont-3">
                <div class="form-body">
                    <h3>Crear usuario</h3>
                    <form class="crear-inscri" id="apunt-event" action="../procedures/users/crear-usuario.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id-event" class='id-event'>
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre">
                            <label for="apellido">Apellidos</label>
                            <input type="text" name="apellido">
                            <label for="edad">Fecha de nacimiento</label>
                            <input type="date" name="edad">
                            <label for="sexe">Sexo</label>
                            <div>
                                <!-- se podria cojer de la base de datos -->
                                <label>Hombre</label>
                                <input type="radio" name="sexe" value="Hombre">
                                <label>Mujer</label>
                                <input type="radio" name="sexe" value="Mujer">
                                <label>Otro</label>
                                <input type="radio" name="sexe" value="Otro">
                            </div>
                            <label for="dni">DNI</label>
                            <input type="text" size="10" name="dni">
                            <label for="telf">Tel??fono</label>
                            <input type="number" name="telf">
                            <label for="email">Email</label>
                            <input type="email" name="email">
                            <select name="rol" id="rol_user">
                                <option value="1">SuperUser</option>
                                <option value="2">Responsable</option>
                                <option selected value="3">Usuario</option>
                            </select>
                            <label for="foto">Foto (opcional)</label>
                            <input type="file" name="foto" id="file" accept="image/*">
                            <label for="contrasenya">Quieres crearte una cuenta?</label>
                            <input class='contrasenha' type="checkbox" name="contrasenya">
                            <div class="content-password" style='display: none'>
                                <label for="password">Contrase??a</label>
                                <input type="password" name="password">
                            </div>
                            <input type="submit">
                        </form>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>

