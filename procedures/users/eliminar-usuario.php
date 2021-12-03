<?php
    include '../../services/conection.php';

    //$id = $_REQUEST['id_user'];
    $id = 17;

    $pdo -> beginTransaction();
    $qry =$pdo->prepare("DELETE FROM tbl_inscri where id_user=:id_user");
    $qry->bindParam(':id_user',$id);
    try{
        $qry -> execute();
        $pdo->commit();
        //header("Location:../../view/inicio.php");
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        //header("Location:../../view/inicio.php");
    }

    $stmt = $pdo->prepare("DELETE FROM tbl_usuari WHERE id_user=?");
    $stmt->bindParam(1,$id);
    try{
        $stmt -> execute();
        $pdo->commit();
        //header("Location:../../view/inicio.php");
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBacK();
        //header("Location:../../view/inicio.php");
    }

    
?>