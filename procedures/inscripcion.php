<?php

include '../services/conection.php';
include '../procedures/class/usuario.php';

//Recogemos variables del Formulario
$email = $_REQUEST['email'];
if(isset($_REQUEST['password'])){
    $password = $_REQUEST['password'];
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
//este if sirve para ver si hay un archivo 
if(isset( $_FILES["foto"] ) && !empty( $_FILES["foto"]["name"] )){
    $nameimg=$_FILES['foto']['tmp_name'];
    $dateimg=date('Y-m-d-H-i-s');
    $path="../public/users/{$dateimg}_{$_FILES['foto']['name']}";
    move_uploaded_file($nameimg, $path);
}else{
    $path = null;
}
print_r($path);
$rol = 3;

$id_evento = $_REQUEST['id-event'];

$id=null;

//Empieza El Proceso

$stmt=$pdo->prepare("SELECT * FROM tbl_usuari WHERE email_user LIKE '%$email%' or dni_user LIKE '%$dni%'; ");
$stmt -> execute();
$result = $stmt -> fetch(PDO::FETCH_ASSOC);
function pft($foto){
    if($foto!=null){
        //se tiene que canviar si o si la foto
        return true;
    }else{
        //no canviar la password
        return false;
    }
    
}
function pss($pass){
    if($pass!=null){
        //se tiene que canviar si o si la foto
        return true;
    }else{
        //no canviar la password
        return false;
    }
    
}

if(empty($result)){
    $usuario = new Usuario($id,$email,$password,$nombre,$apellido,$dni,$dataNaix,$sexo,$telf,$path,$rol);
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
        $error=true;
        unlink($path);
        //header("Location:../view/inicio.php");
    }
}elseif(!empty($result)){
    $idusu= $result['id_user'];
    $pdo -> beginTransaction();
    if(pft($path)==false && pss($password)==false){//00
        $stmt=$pdo->prepare("UPDATE tbl_usuari SET email_user=?, nom_user=?, cognom_user=?, dni_user=?, data_naix_user=?, sexe_user=?, telf_user=? WHERE id_user= $idusu");
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$nombre);
        $stmt->bindParam(3,$apellido);
        $stmt->bindParam(4,$dni);
        $stmt->bindParam(5,$dataNaix);
        $stmt->bindParam(6,$sexo);
        $stmt->bindParam(7,$telf);

    }elseif(pft($path)==false && pss($password)==true){//01
        $stmt=$pdo->prepare("UPDATE tbl_usuari SET email_user=?, pass_user=?, nom_user=?, cognom_user=?, dni_user=?, data_naix_user=?, sexe_user=?, telf_user=? WHERE id_user= $idusu");
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$password);
        $stmt->bindParam(3,$nombre);
        $stmt->bindParam(4,$apellido);
        $stmt->bindParam(5,$dni);
        $stmt->bindParam(6,$dataNaix);
        $stmt->bindParam(7,$sexo);
        $stmt->bindParam(8,$telf);
        
    }
    elseif(pft($path)==true && pss($password)==false){//10
        $stmt=$pdo->prepare("UPDATE tbl_usuari SET email_user=?, nom_user=?, cognom_user=?, dni_user=?, data_naix_user=?, sexe_user=?, telf_user=?, foto_user=? WHERE id_user= $idusu");
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$nombre);
        $stmt->bindParam(3,$apellido);
        $stmt->bindParam(4,$dni);
        $stmt->bindParam(5,$dataNaix);
        $stmt->bindParam(6,$sexo);
        $stmt->bindParam(7,$telf);
        $stmt->bindParam(8,$path);
        
    }
    elseif(pft($path)==true && pss($password)==true){//11
        $stmt=$pdo->prepare("UPDATE tbl_usuari SET email_user=?, pass_user=?, nom_user=?, cognom_user=?, dni_user=?, data_naix_user=?, sexe_user=?, telf_user=?, foto_user=? WHERE id_user= $idusu");
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$password);
        $stmt->bindParam(3,$nombre);
        $stmt->bindParam(4,$apellido);
        $stmt->bindParam(5,$dni);
        $stmt->bindParam(6,$dataNaix);
        $stmt->bindParam(7,$sexo);
        $stmt->bindParam(8,$telf);
        $stmt->bindParam(9,$path);
    }
    
    
    try{
        $stmt->execute();
        $sql=$pdo->prepare("INSERT INTO tbl_inscri(id_user, id_events) VALUES(?,?)");
            $sql->bindParam(1,$idusu);
            $sql->bindParam(2,$id_evento);
            $sql->execute();
            $pdo->commit();
    }catch(PDOException $e){
        echo $e->getMessage();
        $error=true;
        $pdo->rollBack();
        unlink($path);
        //header("Location:../view/inicio.php");
    }
    // if ($error){
    //     header("Location:../view/inicio.php?error=1");
    // }else{
    //     header("Location:../view/inicio.php");

    // }

}
else{
   // header("Location:../view/inicio.php");
}