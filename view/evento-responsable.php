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
            <img style="max-height: 10vh;"
             src="<?php if($event['foto_event']!=null){
                 echo $event['foto_event'];
             }else{
                 echo "../media/img/profile.png";
             }?>" 
             >
             <form action="../procedures/event/update-foto.php">
                <input aria-required="true" required type="hidden" name="id_events" value="<?php echo $event['id_events']; ?>">
                <input aria-required="true" required type="file" name="foto_event" id="">
                <input type="submit" value="Canviar img">
            </form>
        </div>
        <div class="event-data box-profile">
            <h3>Datos personales</h3>
            <form action="../procedures/event/update-pd-profile.php">
                <input aria-required="true" required type="hidden" name="id_events" value="<?php echo $event['id_events']; ?>">
                <input aria-required="true" required type="text" name="nom_events" id="" value="<?php echo $event['nom_events']; ?>">
                
                <select aria-required="true" required name="sexe_event" id="" value="<?php echo $event['estado_event']; ?>">
                    <option value="">Selecciona uno</option>
                    <option value="Activo">Activo</option>
                    <option value="Lelno">Lleno</option>
                    
                </select>
                <input aria-required="true" required type="date" name="data_ini_event" id="" value="<?php echo $event['data_ini_event']; ?>">
                <input aria-required="true" required type="date" name="data_fi_event" id="" value="<?php echo $event['data_fi_event']; ?>">
                <input aria-required="true" required type="text" name="adre_event" id="adre" value="<?php echo $event['adre_event']; ?>">
                <input aria-required="true" required type="number" name="capac_event" id="capac" value="<?php echo $event['capac_event']; ?>">
                <input aria-required="true" required type="text" name="ubi_event" id="ubi" value="<?php echo $event['ubi_event']; ?>">
                <input type="submit" value="Actualizar">
            </form>
        </div>

        <?php } ?>

   
    </div>

    



    
</body>
</html>

