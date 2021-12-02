<?php

require_once '../services/conection.php';
session_start();
$id_evento=$_COOKIE["id-event"];
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
$event=$pdo->prepare("SELECT * from tbl_events where id_events=$id_evento");
                $event->execute();
                $event=$event->fetchAll(PDO::FETCH_ASSOC);
?>
<body class="menu">
    <div class="region-inicio flex-cv">
    <?php foreach ($event as $event) { ?>
    <p><?php echo $event['foto_event']; ?></p>
                    <p><?php echo $event['id_events']; ?></p>
                    <p><?php echo $event['nom_events']; ?></p>
                    <p><?php echo $event['data_ini_event']; ?></p>
                    <p><?php echo $event['data_fi_event']; ?></p>
                    <p><?php echo $event['adre_event']; ?></p>
                    <p><?php echo $event['capac_event']; ?></p>
                    <p><?php echo $event['estat_event']; ?></p>
                    <p><?php echo $_SESSION['email'];?><p>
                    <?php } ?>
    </div>

    



    
</body>
</html>

