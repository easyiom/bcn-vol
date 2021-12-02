<?php
    include '../services/conection.php';

    // $email = $_REQUEST['email_user'];
    // if(isset($_REQUEST['pass_user'])){
    //     $password = $_REQUEST['pass_user'];
    // }
    // $nombre = $_REQUEST['nom_user'];
    // $apellido = $_REQUEST['apellido_user'];
    // $dni = $_REQUEST['dni_user'];
    // $dataNaix = $_REQUEST['data_naix_user'];
    // $sexo = $_REQUEST['sexe_user'];
    // $telf = $_REQUEST['telf_user'];
    // if(isset($_REQUEST['foto_user'])){
    //     $foto =  $_REQUEST['foto_user'];
    // }
    //$id_evento = $_REQUEST['id_events'];
    // $id_evento = 3;

    $id = 17;
    $email = "prueba21@fje.edu";
    $password = "1234";
    $nombre = "Prueba21";
    $apellido = "Prueba21";
    $dni = "47219139E";
    $dataNaix = "0000-00-00";
    $sexo = "Hombre";
    $telf = "123456789";
    if(isset( $_FILES["foto"] ) && !empty( $_FILES["foto"]["name"] )){
        $nameimg=$_FILES['foto']['tmp_name'];
        $dateimg=date('Y-m-d-H-i-s');
        $path="../public/profile/{$dateimg}_{$_FILES['foto']['name']}";
        move_uploaded_file($nameimg, $path);
    }else{
        $path = null;
    }

    $pdo -> beginTransaction();
    $stmt=$pdo->prepare("UPDATE tbl_usuari SET email_user=?, pass_user=?, nom_user=?, cognom_user=?, dni_user=?, data_naix_user=?, sexe_user=?, telf_user=?, foto_user=? WHERE id_user=?");
    $stmt->bindParam(1,$email);
    $stmt->bindParam(2,$password);
    $stmt->bindParam(3,$nombre);
    $stmt->bindParam(4,$apellido);
    $stmt->bindParam(5,$dni);
    $stmt->bindParam(6,$dataNaix);
    $stmt->bindParam(7,$sexo);
    $stmt->bindParam(8,$telf);
    $stmt->bindParam(9,$path);
    $stmt->bindParam(10,$id);
    try{
        $stmt->execute();
        $pdo->commit();
        header("Location:../view/inicio.php");
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        header("Location:../view/inicio.php");
    }
    header("Location:../view/inicio.php");
    
?>