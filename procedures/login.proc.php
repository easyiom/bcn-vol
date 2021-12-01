<?php
include_once '../services/conection.php';
$username = $_POST['username'];
$password = $_POST['password'];

$password = md5($password);

$stmt=$pdo->prepare("SELECT * FROM `tbl_usuari` WHERE pass_user=? and email_user=?");
$stmt->bindParam(1, $password);
$stmt->bindParam(2, $username);


$stmt->execute();

$num2=$stmt->fetchAll(PDO::FETCH_ASSOC);
$num=count($num2);

try {
    if ($num==1)
    {
        session_start();
        $_SESSION['email']=$username;

        foreach ($num2 as $num2) {
            if ($num2['rol_user']== 2){
                setcookie("rol", "", time() - 3153600000, "/");
                setCookie('rol', "Responsable", time()+30000, "/");
                echo $_COOKIE["rol"];
                header("Location:../view/tabla-responsable.php");
            }elseif ($num2['rol_user']== 1){
                setcookie("rol", "", time() - 3153600000, "/");
                setCookie('rol', "SuperUser", time()+30000, "/");
                echo $_COOKIE["rol"];
                header("Location:../view/tabla-admin.php");
            }elseif ($num2['rol_user']== 3){
                setcookie("rol", "", time() - 3153600000, "/");
                setCookie('rol', "Usuari", time()+30000, "/");
                echo $_COOKIE["rol"];
                header("Location:../view/inicio.php");
            }else{
                setcookie("rol", "", time() - 3153600000, "/");
            }
        }
        header("Location:../view/inicio.php");
    }
    else {
        header("Location:../view/inicio.php");
    }
}catch(PDOException $e){
    header("Location:../view/inicio.php");
 }