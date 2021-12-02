<?php
    include_once '../../services/conection.php';

    $id=$_REQUEST['id_user'];
    $telf=$_REQUEST['telf_user'];
    $email=$_REQUEST['email_user'];

    $pdo->beginTransaction();
    $stmt=$pdo->prepare("UPDATE tbl_usuari SET email_user=?, telf_user=? WHERE id_user=?");
    $stmt->bindParam(1,$email);
    $stmt->bindParam(2,$telf);
    $stmt->bindParam(3,$id);
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