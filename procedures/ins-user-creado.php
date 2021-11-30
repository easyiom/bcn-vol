<?php

    include '../services/conection.php';

    $email=$_REQUEST['email_user'];
    $password=$_REQUEST['pass_user'];
    //$id_evento=$_REQUEST['id_events'];

    $id_evento=3;

    $stmt=$pdo->prepare("SELECT id_user FROM tbl_usuari WHERE email_user LIKE '%$email%'");
    $stmt -> execute();
    $result= $stmt -> fetch(PDO::FETCH_ASSOC);
    $id = $result['id_user'];
    try{
        $pdo -> beginTransaction();
        $sql=$pdo->prepare("INSERT INTO tbl_inscri(id_user, id_events) VALUES(?,?)");
        $sql->bindParam(1,$id);
        $sql->bindParam(2,$id_evento);
        $sql->execute();
        $pdo->commit();
        echo $id;
        echo "<br>";
        echo $id_evento;
        echo "<br>";
        print_r($sql);
        //header("Location:../view/inicio.php");
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        //header("Location:../view/inicio.php");
    }
    //header("Location:../view/inicio.php");
?>