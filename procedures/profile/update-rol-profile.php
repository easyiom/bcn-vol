<?php
    include_once '../../services/conection.php';

    $id=$_REQUEST['id_user'];
    $rol=$_REQUEST['rol_user'];
    
    $pdo->beginTransaction();
    $stmt=$pdo->prepare("UPDATE tbl_usuari SET rol_user=? WHERE id_user=?");
    $stmt->bindParam(1,$rol);
    $stmt->bindParam(2,$id);
    try{
        $stmt->execute();
        $pdo->commit();
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        header("Location:../../view/inicio.php");
    }
    header("Location:../../view/inicio.php");
?>