<?php
    include_once '../../services/conection.php';

    $id=$_REQUEST['id_user'];
    $password=$_REQUEST['pass_user'];
    $passMD5=md5($password);
    $pdo->beginTransaction();
    $stmt=$pdo->prepare("UPDATE tbl_usuari SET pass_user=? WHERE id_user=?");
    $stmt->bindParam(1,$passMD5);
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