<?php
session_start();
if (isset($_SESSION['email']))
{
    if(isset($_COOKIE["rol"]) && $_COOKIE["rol"]=="SuperUser"){
        if(isset($_POST["enviar"])){
            $iduser = $_POST['id_user'];
            
            setcookie("id-person", "", time() - 3153600000, "/");
            setCookie('id-person', "$iduser", time()+30000, "/");
          
            header("Location:../../view/admin-usuario.php");
        }else{
            header("Location:../../view/tabla-admin.php");
        }
    }
}else
{
    header("Location:../../view/inicio.php");
}
?>
