<?php
session_start();
if (isset($_SESSION['email'])){
    include_once '../services/conection.php';
    $email_usu= $_SESSION['email'] ;
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERFIL</title>
    <!-- librerias-->
    <script type="text/javascript" src="../js/jquery.js"></script><!-- jquery-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!-- sweetalert-->
    <script type="text/javascript" src="../js/iconos_g.js"></script><!-- iconos FontAwesome-->
    <script type="text/javascript" src="../js/js.js"></script>
    <link rel="icon" type="image/png" href="../img/icon.png">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/menu.css">
</head>
<?php 

$user=$pdo->prepare("SELECT * from tbl_usuari WHERE email_user='$email_usu'");

                $user->execute();
                $user=$user->fetchAll(PDO::FETCH_ASSOC);
?>
<body class="profile">
    <div class="region-profile flex-cv">
        
        
    <?php foreach ($user as $user) { ?>



        <div class="foto-perfil">
            <img
             src="<?php if($user['foto_user']!=null){
                 echo $user['foto_user'];
             }else{
                 echo "../media/img/profile.png";
             }?>" 
             >
             <form action="../procedures/profile/update-foto.php">
                <input aria-required="true" required type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                <input aria-required="true" required type="file" name="nom_user" id="">
                <input type="submit" value="Canviar img">
            </form>
        </div>
        <div class="personal-data box-profile">
            <h3>Datos personales</h3>
            <form action="../procedures/profile/update-pd-profile.php">
                <input aria-required="true" required type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                <input aria-required="true" required type="text" name="nom_user" id="" value="<?php echo $user['nom_user']; ?>">
                <input aria-required="true" required type="text" name="cognom_user" id="" value="<?php echo $user['cognom_user']; ?>">
                <select aria-required="true" required name="sexe_user" id="" value="<?php echo $user['sexe_user']; ?>">
                    <option value="">Selecciona uno</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro">Otro</option>
                </select>
                <input aria-required="true" required type="date" name="data_naix_user" id="" value="<?php echo $user['data_naix_user']; ?>">
                <input aria-required="true" required type="text" name="dni_user" id="dni" value="<?php echo $user['dni_user']; ?>">
                <input type="submit" value="Actualizar">
            </form>
        </div>
        <div class="contact-data box-profile">
            <h3>Información de contacto</h3>
            <form action="../procedures/profile/update-cd-profile.php">
                <input aria-required="true" required type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">

                <input aria-required="true" required type="telf" name="telf_user" value="<?php echo $user['telf_user']; ?>">
                <input aria-required="true" required type="email" name="email_user" id="" value="<?php echo $user['email_user']; ?>">
                
                <input type="submit" value="Actualizar">
            </form>
        </div>

        <div class="password box-profile">
            <h3>Contraseña</h3>
            <details><summary>Acceder info</summary>
            <form action="../procedures/profile/update-pass-profile.php">
                <input aria-required="true" required type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                <input aria-required="true" required type="password" name="telf_user" value="<?php echo md5($user['pass_user']); ?>">
                
                <input type="submit" value="Actualizar">
            </form>
            </details>
        </div>


   
                    
                    
                    
                    
                    
                    
                    <?php } ?>
    </div>

    



    <div class="leftMenu" id="leftMenu">
    <?php if(!isset($_SESSION['email'])){?>
        <button type="submit" title="Cerrar sesión" class="btn-micromenu color btn-abrirPop btn-abrirPop2"><i class="far fa-sign-out"></i><p>Iniciar sesion</p></button>

    <?php }else{?>
        <button title="Perfil" class="btn-micromenu color" ><a class="a-menu" href='../view/perfil.php'></a><i class="fas fa-user"></i><p>Perfil</p></button>
        <form action="../procedures/logout.proc.php" method="post">
            <button title="Cerrar sesión" class="btn-micromenu color"><i class="far fa-sign-out"></i><p>Logout</p></button>
        </form>
    <?php }?>
    <button title="Inicio" class="btn-micromenu color" ><i class="fas fa-home"></i><a class="a-menu" href='../view/inicio.php'></a><p>Inicio</p></button>
    <?php if(isset($_COOKIE["rol"]) && $_COOKIE["rol"]=="SuperUser"){ ?>
        <button title="Admin" class="btn-micromenu color" ><a class="a-menu" href='../view/tabla-admin.php'></a><i class="fas fa-users-cog"></i><p>admin</p></button>
        <?php } ?>
    <?php if(isset($_COOKIE["rol"]) && ($_COOKIE["rol"]=="Responsable" || $_COOKIE["rol"]=="SuperUser")){ ?>
        <button title="Event managment" class="btn-micromenu color" ><a class="a-menu" href='../view/tabla-responsable.php'></a><i class="fas fa-calendar-alt"></i><p>G.Event</p></button>
        <?php } ?>
</div>
</body>
</html>
<?php
//sesion
}else{
    header("Location:../view/inicio.php");
}?>