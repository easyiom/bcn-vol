<?php
    include_once '../../services/conection.php';

    $id=$_REQUEST['id_user'];
    $nombre=$_REQUEST['nom_user'];
    $apellido=$_REQUEST['cognom_user'];
    $sexo=$_REQUEST['sexe_user'];
    $dataNaix=$_REQUEST['data_naix_user'];
    $dni=$_REQUEST['dni_user'];

    $pdo->beginTransaction();
    $stmt=$pdo->prepare("UPDATE tbl_usuari SET nom_user=?, cognom_user=?, dni_user=?, data_naix_user=?, sexe_user=? WHERE id_user=?");
    $stmt->bindParam(1,$nombre);
    $stmt->bindParam(2,$apellido);
    $stmt->bindParam(3,$dni);
    $stmt->bindParam(4,$dataNaix);
    $stmt->bindParam(5,$sexo);
    $stmt->bindParam(6,$id);
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