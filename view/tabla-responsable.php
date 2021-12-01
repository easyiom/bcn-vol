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
<?php 
$event=$pdo->prepare("SELECT * from tbl_events");
                $event->execute();
                $event=$event->fetchAll(PDO::FETCH_ASSOC);
?>
<body class="tabla-responsable">
    <div class="region-responsable flex-cv">
        <table>
            <thead>
                <tr><form action="./historial.php" method="POST">
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
                </tr>
                <tr>
                    <th>Foto</th>
                    <th>Id</th>
                    <th>Nom event</th>
                    <th>Inici</th>
                    <th>Fi</th>
                    <th>Direcció</th>
                    <th>Capacitat</th>
                    <th>Estat</th>
                </tr>  
            </thead>
            <tbody>
            <?php foreach ($event as $event) { ?>
                <tr>
                    <td><?php echo $event['foto_event']; ?></td>
                    <td><?php echo $event['id_events']; ?></td>
                    <td><?php echo $event['nom_events']; ?></td>
                    <td><?php echo $event['data_ini_event']; ?></td>
                    <td><?php echo $event['data_fi_event']; ?></td>
                    <td><?php echo $event['adre_event']; ?></td>
                    <td><?php echo $event['capac_event']; ?></td>
                    <td><?php echo $event['estat_event']; ?></td>
                    

                    <td><button class="btn-abrirPop"><i class="fas fa-edit"></i></button></td>
                    <td>
                        <form action="resp-cookie-event.php" method="POST">
                            <input type="hidden" value="<?php echo $event['id_events']; ?>" name="id_events">
                            <input type="submit" name="enviar" value='ver'>
                        </form>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
            <div class="contenedor-popup">
                <div class="form-body">
                    <h3>Crear evento</h3>
                    <form class="" id="crear-event" action="../procedures/crear-event.php" method="POST" enctype="multipart/form-data">
                        <label for="nom">Nombre</label>
                        <input type="text" name="nom">
                        <label for="ini">Inici</label>
                        <input type="date" name="ini">
                        <label for="fi">Final</label>
                        <input type="date" name="fi">
                        <label for="adre">Dirección</label>
                        <input type="text" name="adre">
                        <label for="desc">Descripción</label>
                        <input type="texarea" size="250" name="desc">
                        <label for="ubi">Ubicación</label>
                        <input type="texarea" size="250" name="ubi">
                        <label for="cap">Capacidad</label>
                        <input type="number" name="cap">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto">
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>

