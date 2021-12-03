<?php
    include '../../services/conection.php';
    include '../class/usuario.php';

    $email = $_REQUEST['email'];
if(isset($_REQUEST['password'])){
    $password = md5($_REQUEST['password']);
}else{
    $password=null;
}
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$dni = $_REQUEST['dni'];
$dataNaix = $_REQUEST['edad'];
$sexo = $_REQUEST['sexe'];
$telf = $_REQUEST['telf'];


$error = false;
    
    $rol = $_REQUEST['rol'];
    $id = null;
    // $email = "prueba20@fje.edu";
    // $password = "1234";
    // $nombre = "Prueba20";
    // $apellido = "Prueba20";
    // $dni = "47219139E";
    // $dataNaix = "2001-05-05";
    // $sexo = "Hombre";
    // $telf = "123456789";
    if(isset( $_FILES["foto"] ) && !empty( $_FILES["foto"]["name"] )){
        $nameimg=$_FILES['foto']['tmp_name'];
        $dateimg=date('Y-m-d-H-i-s');
        $path="../public/users/{$dateimg}_{$_FILES['foto']['name']}";
        $newpath="../../public/users/{$dateimg}_{$_FILES['foto']['name']}";
        move_uploaded_file($nameimg, $newpath);
    }else{
        $path = null;
    }
   

    $usuario = new Usuario($id,$email,$password,$nombre,$apellido,$dni,$dataNaix,$sexo,$telf,$path,$rol);
    $pdo -> beginTransaction();
    $stmt=$pdo->prepare("INSERT INTO tbl_usuari(id_user, email_user, pass_user, nom_user, cognom_user, dni_user, data_naix_user, sexe_user, telf_user, foto_user, rol_user) VALUES(:id_user, :email_user, :pass_user, :nom_user, :cognom_user, :dni_user, :data_naix_user, :sexe_user, :telf_user, :foto_user, :rol_user)");
    
        try{
            if($stmt->execute((array) $usuario)){
            $pdo->commit();
            header("Location:../../view/tabla-admin.php");
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            unlink($nameimg);
            $pdo->rollBack();
            header("Location:../../view/tabla-admin.php");
        }
    


