<?php
    include '../services/conection.php';

    // $id = $_REQUEST[''];
    $id = 20;

    // $pdo -> beginTransaction();
    $stmt = $pdo->prepare("DELETE FROM tbl_usuari WHERE id_user=?");
    $stmt->bindParam(1,$id);
    $stmt -> execute();
    // $pdo->commit();
    // $pdo->rollBack();
    header("Location:../view/inicio.php");
?>