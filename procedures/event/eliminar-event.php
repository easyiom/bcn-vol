<?php
    include_once '../../services/conection.php';

    $id=$_REQUEST['id_events'];

    $pdo->beginTransaction();
    $qry =$pdo->prepare("DELETE FROM tbl_inscri where id_events=:id_events");
    $qry->bindParam(':id_events',$id);
    try{
        $stmt -> execute();
        $pdo->commit();
        header("Location:../view/inicio.php");
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        header("Location:../view/inicio.php");
    }

    $stmt = $pdo->prepare("DELETE FROM tbl_events WHERE id_events=:id_events");
    $stmt->bindParam(':id_events',$id);
    try{
        $stmt -> execute();
        $pdo->commit();
        header("Location:../../view/inicio.php");
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        header("Location:../../view/inicio.php");
    }
?>