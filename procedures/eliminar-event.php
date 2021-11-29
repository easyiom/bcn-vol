<?php
    include '../services/conection.php';
    //include '../procedures/class/evento.php';

    //$id=$_REQUEST['id_events'];
    $id=5;
    $stmt = $pdo->prepare("DELETE FROM tbl_events WHERE id_events=:id_events");
    $stmt->bindParam(':id_events',$id);
    $stmt -> execute();
    header("Location:../view/inicio.php");
?>