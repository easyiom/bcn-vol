<?php
    include '../services/conection.php';

    // $email = $_REQUEST[''];
    // if(isset($_REQUEST[''])){
    //     $password = $_REQUEST[''];
    // }
    // $nombre = $_REQUEST[''];
    // $apellido = $_REQUEST[''];
    // $dni = $_REQUEST[''];
    // $dataNaix = $_REQUEST[''];
    // $sexo = $_REQUEST[''];
    // $telf = $_REQUEST[''];
    // if(isset($_REQUEST[''])){
    //     $foto =  $_REQUEST[''];
    // }
    // $id = $_REQUEST[''];

    $id = 20;
    $email = "prueba21@fje.edu";
    $password = "1234";
    $nombre = "Prueba21";
    $apellido = "Prueba21";
    $dni = "47219139E";
    $dataNaix = "2001-21-21";
    $sexo = "Hombre";
    $telf = "123456789";
    $foto = NULL;

    // $pdo -> beginTransaction();
    $stmt=$pdo->prepare("UPDATE tbl_usuari SET email_user=?, pass_user=?, nom_user=?, cognom_user=?, dni_user=?, data_naix_user=?, sexe_user=?, telf_user=?, foto_user=? WHERE id_user=?");
    $stmt->bindParam(1,$email);
    $stmt->bindParam(2,$password);
    $stmt->bindParam(3,$nombre);
    $stmt->bindParam(4,$apellido);
    $stmt->bindParam(5,$dni);
    $stmt->bindParam(6,$dataNaix);
    $stmt->bindParam(7,$sexo);
    $stmt->bindParam(8,$telf);
    $stmt->bindParam(9,$foto);
    $stmt->bindParam(10,$id);
    $stmt->execute();
    // $pdo->commit();
    // $pdo->rollBack();
    header("Location:../view/inicio.php");
?>