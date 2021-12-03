<?php

require_once '../services/conection.php';
session_start();
$id_eventso=$_COOKIE["id-event"];
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
$event=$pdo->prepare("SELECT * from tbl_events where id_events=$id_eventso");
                $event->execute();
                $event=$event->fetchAll(PDO::FETCH_ASSOC);
?>
<body class="event-single">
    <div class="region-event-single flex-cv">
    <?php foreach ($event as $event) { ?>


        <div class="foto-event">
            <img
             src="<?php if($event['foto_event']!=null){
                 echo $event['foto_event'];
             }else{
                 echo "../media/img/profile.png";
             }?>" 
             >
        </div>
        <div class="event-data box-event">
            <h2>Datos del evento</h2>
            <form action="../procedures/event/update-data-event.php">
                
                <input aria-required="true" required type="hidden" name="id_events" value="<?php echo $event['id_events']; ?>">
                <label for="nom_events">Nombre del evento</label>
                <input aria-required="true" required type="text" name="nom_events" id="" value="<?php echo $event['nom_events']; ?>">
                <label for="estat_event">Estado del evento</label>
                <select aria-required="true" required name="estat_event" id="" value="<?php echo $event['estado_event']; ?>">
                    <option value="">Selecciona uno</option>
                    <option value="Activo">Activo</option>
                    <option value="Lelno">Lleno</option>
                    
                </select>
                <label for="data_ini_event">Fecha inicio del evento</label>
                <input aria-required="true" required type="date" name="data_ini_event" id="" value="<?php echo $event['data_ini_event']; ?>">
                <label for="data_fi_event">Fecha final del evento</label>
                <input aria-required="true" required type="date" name="data_fi_event" id="" value="<?php echo $event['data_fi_event']; ?>">
                <label for="adre_event">Dirección del evento</label>
                <input aria-required="true" required type="text" name="adre_event" id="adre" value="<?php echo $event['adre_event']; ?>">\
                <label for="capac_event">Capacidad del evento</label>
                <input aria-required="true" required type="number" name="capac_event" readonly id="capac" value="<?php echo $event['capac_event']; ?>">
                <label for="ubi_event">Ubicación del evento</label>
                <input aria-required="true" required type="text" name="ubi_event" id="ubi" value="<?php echo $event['ubi_event']; ?>">
                <input type="submit" value="Actualizar">
            </form>
            <h2>Canviar fotografia</h2>
            <form action="../procedures/event/update-foto-event.php" method="POST" enctype="multipart/form-data">
                <input aria-required="true" required type="hidden" name="id_events" value="<?php echo $event['id_events']; ?>">
                <input aria-required="true" required type="file" name="foto" id="" accept="image/*">
                <input type="submit" value="Canviar img">
            </form>
        </div>


        <?php 
$events=$pdo->prepare("SELECT ev.id_events, ev.nom_events, ev.data_ini_event, ev.data_fi_event, ev.adre_event, ev.ubi_event, ev.capac_event, ev.estat_event, ev.foto_event, usu.id_user, usu.email_user, usu.nom_user, usu.cognom_user, usu.dni_user, usu.data_naix_user, usu.sexe_user, usu.telf_user, usu.foto_user, ins.id_inscri 
                        FROM 
                        tbl_events ev 
                        INNER JOIN 
                        tbl_inscri ins 
                        ON 
                        ev.id_events=ins.id_events 
                        INNER JOIN 
                        tbl_usuari usu 
                        ON 
                        ins.id_user=usu.id_user 
                        WHERE ev.id_events = $id_eventso");
                $events->execute();
                $events=$events->fetchAll(PDO::FETCH_ASSOC);
?>



        <table>
            <thead>
                <tr><form action="./historial.php" method="POST">
                        <th></th>
                        <th><input type="number" id="" name="id_res" placeholder="ID reserva"></th>
                        <th><input type="text" id="" name="nom_events" placeholder="Nom"></th>
                        <th><input type="text" id="" name="nom_events" placeholder="Nom"></th>
                        <th><input type="text" id="" name="nom_events" placeholder="Nom"></th>
                        <th><input type="text" id="" name="adre_event" placeholder="direccio"></th>
                        <th><input type="number" id="" name="capac_event" placeholder="Capacitat"></th>
                        
                    </form>
                </tr>
                <tr>
                    <th>Foto</th>
                    <th>Id user</th>
                    <th>Email User</th>
                    <th>Nombre user</th>
                    <th>Apellido Usaer</th>
                    <th>DNI</th>
                    <th>ID inscri</th>
                    
                    
                </tr>  
            </thead>
            <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td ><img style="width:50px;" src="<?php echo $event['foto_user']; ?>"></td>
                    <td><?php echo $event['id_user']; ?></td>
                    <td><?php echo $event['email_user']; ?></td>
                    <td><?php echo $event['nom_user']; ?></td>
                    <td><?php echo $event['cognom_user']; ?></td>
                    <td><?php echo $event['dni_user']; ?></td>
                    <td><?php echo $event['id_inscri']; ?></td>
                    
                    
                    <td>
                        <form action="../procedures/inscri/eliminar-inscri.php" method="POST">
                            <input type="hidden" value="<?php echo $event['id_inscri']; ?>" name="id_inscri">
                            <input type="submit" name="enviar" value='Eliminar'>
                        </form>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php } ?>

   
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
</body>
</html>

