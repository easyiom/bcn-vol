<?php

include '../services/conection.php';
include '../procedures/class/usuario.php';

//Recogemos variables del Formulario
$email = $_REQUEST['email'];
if(isset($_REQUEST['contrasenya'])){
    $password = $_REQUEST['contrasenya'];
}
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$dni = $_REQUEST['dni'];
$dataNaix = $_REQUEST['edad'];
$sexo = $_REQUEST['sexe'];
$telf = $_REQUEST['telf'];
if(isset($_REQUEST['foto'])){
    $foto =  $_REQUEST['foto'];
}
$rol = 3;
//$id_evento = $_REQUEST['id_events'];
$id_evento = 3;
$id=null;

//Empieza El Proceso

$stmt=$pdo->prepare("SELECT * FROM tbl_usuari WHERE email_user LIKE '%$email%' and dni_user LIKE '%$dni%'; ");
$stmt -> execute();
$result = $stmt -> fetch(PDO::FETCH_ASSOC);
if(empty($result)){
    $usuario = new Usuario($id,$email,$password,$nombre,$apellido,$dni,$dataNaix,$sexo,$telf,$foto,$rol);
    $pdo -> beginTransaction();
    $stmt=$pdo->prepare("INSERT INTO tbl_usuari(id_user, email_user, pass_user, nom_user, cognom_user, dni_user, data_naix_user, sexe_user, telf_user, foto_user, rol_user) VALUES(:id_user, :email_user, :pass_user, :nom_user, :cognom_user, :dni_user, :data_naix_user, :sexe_user, :telf_user, :foto_user, :rol_user)");
    try{
        if($stmt->execute((array) $usuario)){
            $id=$pdo-> lastInsertId();
            $sql=$pdo->prepare("INSERT INTO tbl_inscri(id_user, id_events) VALUES(?,?)");
            $sql->bindParam(1,$id);
            $sql->bindParam(2,$id_evento);
            $sql->execute();
            $pdo->commit();
        }
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        header("Location:../view/inicio.php");
    }
}else{
    header("Location:../view/inicio.php");
}