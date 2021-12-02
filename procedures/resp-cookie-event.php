<?php
session_start();
if (isset($_SESSION['email']))
{
    if(isset($_COOKIE["rol"]) && ($_COOKIE["rol"]=="Responsable" || $_COOKIE["rol"]=="SuperUser")){
        if(isset($_POST["enviar"])){
            $idevent = $_POST['id_events'];
            
            setcookie("id-event", "", time() - 3153600000, "/");
            setCookie('id-event', "$idevent", time()+30000, "/");
          
            header("Location:../view/evento-responsable.php");
        }else{
            header("Location:../view/tabla-responsable.php");
        }
    }
}else
{
    header("Location:../view/inicio.php");
}
?>

