<?php
    session_start();
    session_destroy();
    setcookie("rol", "", time() - 3153600000, "/");
    header('Location: ../view/inicio.php')
?>