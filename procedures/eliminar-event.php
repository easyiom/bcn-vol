<?php
    include '../services/conection.php';

    $id=$_REQUEST['id_events'];

    $pdo->beginTransaction();
    $stmt = $pdo->prepare("DELETE FROM tbl_events WHERE id_events=:id_events");
    $stmt->bindParam(':id_events',$id);
    try{
        $stmt -> execute();
        $pdo->commit();
        header("Location:../view/inicio.php");
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        header("Location:../view/inicio.php");
    }
?>