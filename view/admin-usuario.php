<?php
session_start();
if (isset($_SESSION['email'])){
    include_once '../services/conection.php';
    
    $idusu=$_COOKIE["id-person"];
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

$user=$pdo->prepare("SELECT * from tbl_usuari WHERE id_user=$idusu");

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
             <form action="../procedures/profile/update-foto.php" method="POST" enctype="multipart/form-data">
                <input aria-required="true" required type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                <input aria-required="true" required type="file" name="foto" id="" accept="image/*">
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
                <input aria-required="true" required type="password" name="pass_user" value="<?php echo md5($user['pass_user']); ?>">
                
                <input type="submit" value="Actualizar">
            </form>
            </details>
        </div>


   
                    
                    
        
                    
                    
                    
                    <?php 
                } ?>

                    <?php 
$events=$pdo->prepare("SELECT 
ev.id_events, ev.nom_events, ev.data_ini_event, ev.data_fi_event, ev.adre_event, ev.ubi_event, ev.capac_event,     ev.estat_event, ev.foto_event, usu.id_user, usu.email_user, usu.nom_user, usu.cognom_user, usu.dni_user, usu.data_naix_user, usu.sexe_user, usu.telf_user, usu.foto_user, ins.id_inscri 
FROM 
tbl_events ev 
INNER JOIN 
tbl_inscri ins 
ON 
ev.id_events=ins.id_events 
INNER JOIN 
tbl_usuari usu 
ON 
ins.id_user=usu.id_user 
WHERE usu.id_user = $idusu");
                $events->execute();
                $events=$events->fetchAll(PDO::FETCH_ASSOC);
?>
                    <table>
            <thead>
                <tr><form action="./historial.php" method="POST">
                        <th></th>
                        <th><input type="number" id="" name="id_res" placeholder="ID reserva"></th>
                        <th><input type="text" id="" name="nom_events" placeholder="Nom"></th>
                        <th><input type="date" id="" name="horaini" placeholder="Inicio"></th>
                        <th><input type="date" id="" value="" name="horafi" placeholder="Final"></th>
                        <th><input type="text" id="" name="adre_event" placeholder="direccio"></th>
                        <th><input type="number" id="" name="capac_event" placeholder="Capacitat"></th>
                        <th>
                            <select name="estat" id="">
                                <option value=""></option>
                                <option value="Activo">Activo</option>
                                <option value="Lleno">Lleno</option>
                            </select>
                        </th>
                    </form>
                </tr>
                <tr>
                    <th>Foto</th>
                    <th>Id</th>
                    <th>Nom event</th>
                    <th>Inici</th>
                    <th>Fi</th>
                    <th>Direcció</th>
                    <th>Capacitat</th>
                    <th>Estat</th>
                    <th class='btn-abrirPop btn-abrirPop3'>+</th>
                </tr>  
            </thead>
            <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td ><img style="width:50px;" src="<?php echo $event['foto_event']; ?>"></td>
                    <td><?php echo $event['id_events']; ?></td>
                    <td><?php echo $event['nom_events']; ?></td>
                    <td><?php echo $event['data_ini_event']; ?></td>
                    <td><?php echo $event['data_fi_event']; ?></td>
                    <td><?php echo $event['adre_event']; ?></td>
                    <td><?php echo $event['capac_event']; ?></td>
                    <td><?php echo $event['estat_event']; ?></td>
                    

                    <td>
                        <form action="../procedures/inscri/eliminar-inscri.php" method="POST">
                            <input type="hidden" value="<?php echo $event['id_inscri']; ?>" name="id_inscri">
                            <input type="submit" name="enviar" value='Eliminar'>
                        </form>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>




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