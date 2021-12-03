<?php
    include '../../services/conection.php';
    include '../procedures/class/usuario.php';

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
    // $rol = 3;
    //$id_evento = $_REQUEST['id_events'];
    // $id_evento = 3;

    $id = null;
    $email = "prueba20@fje.edu";
    $password = "1234";
    $nombre = "Prueba20";
    $apellido = "Prueba20";
    $dni = "47219139E";
    $dataNaix = "2001-05-05";
    $sexo = "Hombre";
    $telf = "123456789";
    if(isset( $_FILES["foto"] ) && !empty( $_FILES["foto"]["name"] )){
        $nameimg=$_FILES['foto']['tmp_name'];
        $dateimg=date('Y-m-d-H-i-s');
        $path="../public/users/{$dateimg}_{$_FILES['foto']['name']}";
        move_uploaded_file($nameimg, $path);
    }else{
        $path = null;
    }
    $rol = 3;

    $usuario = new Usuario($id,$email,$password,$nombre,$apellido,$dni,$dataNaix,$sexo,$telf,$path,$rol);
    $pdo -> beginTransaction();
    $stmt=$pdo->prepare("INSERT INTO tbl_usuari(id_user, email_user, pass_user, nom_user, cognom_user, dni_user, data_naix_user, sexe_user, telf_user, foto_user, rol_user) VALUES(:id_user, :email_user, :pass_user, :nom_user, :cognom_user, :dni_user, :data_naix_user, :sexe_user, :telf_user, :foto_user, :rol_user)");
    if (move_uploaded_file($name,$path)) {
        try{
            if($stmt->execute((array) $usuario)){
            $pdo->commit();
            header("Location:../../view/inicio.php");
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            unlink($name);
            $pdo->rollBack();
            header("Location:../../view/inicio.php");
        }
    }
?>