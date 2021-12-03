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
$event=$pdo->prepare("SELECT * from tbl_events");
                $event->execute();
                $event=$event->fetchAll(PDO::FETCH_ASSOC);
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
                        <th><input type="text" id="" name="adre_event" placeholder="direccio"></th>
                        <th><input type="number" id="" name="capac_event" placeholder="Capacitat"></th>
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
                    <th>Direcció</th>
                    <th>Capacitat</th>
                    <th>Estat</th>
                    <th class='btn-abrirPop btn-abrirPop3'>+</th>
                </tr>  
            </thead>
            <tbody>
            <?php foreach ($event as $event) { ?>
                <tr>
                    <td ><img style="width:50px;" src="<?php echo $event['foto_event']; ?>"></td>
                    <td><?php echo $event['id_events']; ?></td>
                    <td><?php echo $event['nom_events']; ?></td>
                    <td><?php echo $event['data_ini_event']; ?></td>
                    <td><?php echo $event['data_fi_event']; ?></td>
                    <td><?php echo $event['adre_event']; ?></td>
                    <td><?php echo $event['capac_event']; ?></td>
                    <td><?php echo $event['estat_event']; ?></td>
                    

                    <td>
                        <form action="../procedures/cookies/resp-cookie-event.php" method="POST">
                            <input type="hidden" value="<?php echo $event['id_events']; ?>" name="id_events">
                            <input type="submit" name="enviar" value='ver'>
                        </form>
                        
                    </td>
                    <td>
                        <form action="../procedures/event/eliminar-event.php" method="POST">
                            <input type="hidden" value="<?php echo $event['id_events']; ?>" name="id_events">
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
            <button type="submit" title="Cerrar sesión" class="btn-micromenu color btn-abrirPop btn-abrirPop2"><i class="far fa-sign-out"></i><p>Iniciar sesion</p></button>

        <?php }else{?>
            <button title="Perfil" class="btn-micromenu color" ><a class="a-menu" href='../view/perfil.php'></a><i class="fas fa-user"></i><p>Perfil</p></button>
            <form action="../procedures/logout.proc.php" method="post">
                <button title="Cerrar sesión" class="btn-micromenu color"><i class="far fa-sign-out"></i><p>Logout</p></button>
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
                    <h3>Crear evento</h3>
                    <form class="" id="crear-event" action="../procedures/event/crear-event.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="id" name="id">
                        <label for="nom">Nombre</label>
                        <input type="text" class="nom" name="nom">
                        <label for="ini">Inici</label>
                        <input type="date" class="ini" name="ini">
                        <label for="fi">Final</label>
                        <input type="date" class="fi" name="fi">
                        <label for="adre">Dirección</label>
                        <input type="text" class="adre" name="adre">
                        <label for="desc">Descripción</label>
                        <input type="texarea" class="desc"  name="desc">
                        <label for="ubi">Ubicación</label>
                        <input type="texarea" class="ubi" name="ubi">
                        <label for="cap">Capacidad</label>
                        <input type="number" class="cap" name="cap">
                        <label for="foto">Foto</label>
                        <input type="file" class="foto" name="foto">
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>

