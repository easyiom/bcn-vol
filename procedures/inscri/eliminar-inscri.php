<?php
    include_once '../../services/conection.php';
    $id=$_REQUEST['id_inscri'];

    $pdo -> beginTransaction();

    $stmt = $pdo->prepare("DELETE FROM tbl_inscri WHERE id_inscri= $id ");
    print_r($stmt);
    try{
        $stmt -> execute();
        $pdo->commit();
        if($_COOKIE["rol"]=="Usuario"){
            header("Location:../../view/perfil.php");
        }else{
        header("Location:../../view/evento-responsable.php");}
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        if($_COOKIE["rol"]=="Usuario"){
            header("Location:../../view/perfil.php");
        }else{
        header("Location:../../view/evento-responsable.php");}
    }

    ?>
