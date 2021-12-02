<?php
    include '../services/conection.php';

    $id = $_REQUEST['id_user'];
    //$id = 20;

    $pdo -> beginTransaction();
    $stmt = $pdo->prepare("DELETE FROM tbl_usuari WHERE id_user=?");
    $stmt->bindParam(1,$id);
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