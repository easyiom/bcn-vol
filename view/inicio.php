<?php

require_once '../services/conection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
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

$event=$pdo->prepare("SELECT * from tbl_events");
                $event->execute();
                $event=$event->fetchAll(PDO::FETCH_ASSOC);
?>
<body class="menu">
    <div class="region-inicio">
    <ul class="cards">
<?php foreach ($event as $event) { ?>

    <li>
            <!-- meter id con php  en el data id -->
            <div data-id="<?php echo $event['id_events']; ?>" class="card btn-abrirPop btn-abrirPop1">
                <!-- la foto -->
                <img src="../media/img/focsartificials.jpg" class="header-image" alt="" />
                <div class="c-overlay">
                    <div class="c-header">
                        <svg class="arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
                        
                        <div class="h-text">
                            <!-- titulo del evento -->
                            <h3 class="title"><?php echo $event['nom_events']; ?></h3> 
                            <!-- direccion -->
                            <span class="tagline"><?php echo $event['adre_event']; ?></span>  
                            <!-- fecha ini y fecha final-->
                            <span class="status"><?php echo $event['data_ini_event']; ?> a <?php echo $event['data_fi_event']; ?></span>
                        </div>
                    </div>
                    <div class="description">
                        <!-- descripcion 250 caracteres -->
                        <p><?php echo $event['desc_event']; ?></p>
                    </div>
                </div>
            </div>
        </li>

    <?php } ?>
       
    </ul>
        
    </div>


<div class="leftMenu" id="leftMenu">
    <!-- que aparezca uno u otro dependiendo si hay sesion o no -->
    
    <button type="submit" title="Cerrar sesión" class="btn-micromenu color btn-abrirPop btn-abrirPop2"><i class="far fa-sign-out"></i><p>Iniciar sesion</p></button>
    <form action="../procedures/logout.proc.php" method="post">
        <button title="Cerrar sesión" class="btn-micromenu color"><i class="far fa-sign-out"></i><p>Logout</p></button>
    </form>
    
    <button title="Perfil" class="btn-micromenu color" ><i class="fas fa-user"></i><p>Perfil</p></button>
    <!-- que aparezca dependiendo si hay sesion o no -->
    <button title="Inicio" class="btn-micromenu color" ><i class="fas fa-home"></i><p>Inicio</p></button>
    <!-- que aparezca uno o otro dependiendo ROLES -->
    <?php if(isset($_COOKIE["rol"]) && $_COOKIE["rol"]=="SuperUser"){ ?>
        <button title="Inicio" class="btn-micromenu color" ><i class="fas fa-users-cog"></i><p>admin</p></button>
    <?php }else{} ?>
    <?php if(isset($_COOKIE["rol"]) && ($_COOKIE["rol"]=="Responsable" || $_COOKIE["rol"]=="SuperUser")){ ?>
        <button title="Inicio" class="btn-micromenu color" ><i class="fas fa-calendar-alt"></i><p>G.Event</p></button>
    <?php }else{} ?>
</div>
       



<div class="btn-burger">
    <div class="burger-menu" id="burger-menu">
        <input type="checkbox" href="#"  class="menu-open" name="menu-open" id="menu-open"/>
        <label class="menu-open-button" for="menu-open">
            <span class="hamburger hamburger-1"></span>
            <span class="hamburger hamburger-2"></span>
            <span class="hamburger hamburger-3"></span>
        </label>
    </div>
</div>
<aside class="bottomMenu" id="bottomMenu">
    <div class="bot-screen">
        <button title="Perfil" class="btn-rowscreen color" ><i class="fas fa-user"></i><p>Perfil</p></button>
        <button title="Inicio" class="btn-rowscreen color" ><i class="fas fa-home"></i><p>Inicio</p></button>
        <?php if(isset($_COOKIE["rol"]) && $_COOKIE["rol"]=="SuperUser"){ ?>
            <button title="Inicio" class="btn-rowscreen color" ><i class="fas fa-users-cog"></i><p>admin</p></button>
        <?php }else{} ?>
        <button title="Inicio" class="btn-rowscreen color" ><i class="fas fa-calendar-alt"></i><p>G.Event</p></button>
    </div>
    <div class="bot-tool" id="bot-tool">
        <div><button class="btn-rowtool color" onclick="deleter()"><i class="far fa-minus-hexagon" aria-hidden="true"></i></button></div>
        <div><button class="btn-rowtool color" id="btn-crear2"><i class="far fa-plus-hexagon" aria-hidden="true"></i></button></div>
        <div><button class="btn-rowtool color" ><i class="fal fa-file-csv" aria-hidden="true"></i></button></div>
    </div>
</aside>
    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
            
            <div class="contenedor-popup cont-1">
                <div class="form-body">
                    <h3>Apuntarse a evento </h3>
                    <details>
                        <summary>No tengo cuenta</summary>
                        <form class="crear-inscri" id="apunt-event" action="../procedures/" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id-event" class='id-event'>
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre">
                            <label for="apellido">Apellidos</label>
                            <input type="text" name="apellido">
                            <label for="edad">Fecha de nacimiento</label>
                            <input type="date" name="edad">
                            <label for="sexe">Sexo</label>
                            <div>
                                <!-- se podria cojer de la base de datos -->
                                <input type="radio" name="sexe" value="Hombre">
                                <input type="radio" name="sexe" value="Mujer">
                                <input type="radio" name="sexe" value="Otro">
                            </div>
                            <label for="dni">DNI</label>
                            <input type="text" size="10" name="dni">
                            <label for="telf">Teléfono</label>
                            <input type="number" name="telf">
                            <label for="email">Email</label>
                            <input type="email" name="email">
                            <label for="foto">Foto (opcional)</label>
                            <input type="file" name="foto">
                            <label for="contrasenya">Quieres crearte una cuenta?</label>
                            <input class='contrasenha' type="checkbox" name="contrasenya">
                            <div class="content-password" style='display: none'>
                                <label for="password">Contraseña</label>
                                <input type="password" name="password">
                            </div>
                            <input type="submit">
                        </form>
                    </details>
                    <details>
                        <summary>Tengo cuenta</summary>
                        <div class="login">
                            <form class='crear-inscri' action="">
                                <label for="email">Email</label>
                                <input type="email" name='email'>
                                <label for="password">Contraseña</label>
                                <input type="password" name='password'>
                                <input type="submit">
                            </form>
                        </div>
                    </details>
            

                </div>
            </div>
            <div class="contenedor-popup cont-2">
            <h3>Iniciar sesion</h3>
                <div class="form-body">
                    <form class='' action="../procedures/login.proc.php" method="post">
                        <label for="username">Email</label>
                        <input type="email" name='username'>
                        <label for="password">Contraseña</label>
                        <input type="password" name='password'>
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>


    
    
</body>
</html>

