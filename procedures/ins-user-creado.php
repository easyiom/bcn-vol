<?php

    include '../services/conection.php';

    // $email=$_REQUEST['email_user'];
    // $password=$_REQUEST['pass_user'];
    //$id_evento=$_REQUEST['id_events'];
    $email="isaac@fje.edu";
    $password=md5("1234");
    
    $id_evento=2;
    //s'ha de posar que ho pilli pel hidden

    $stmt=$pdo->prepare("SELECT id_user FROM tbl_usuari WHERE email_user LIKE '%$email%'");
    $stmt -> execute();
    $result= $stmt -> fetch(PDO::FETCH_ASSOC);

    $id = $result['id_user'];
    print_r($id);
    try{
        $pdo -> beginTransaction();
        $sql=$pdo->prepare("INSERT INTO tbl_inscri(id_user, id_events) VALUES(?,?);");
        $sql->bindParam(1,$id);
        $sql->bindParam(2,$id_evento);
        $sql->execute();
        $pdo->commit();
        echo $id;

        echo $id_evento;

        print_r($sql);
        header("Location:../view/inicio.php");
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        header("Location:../view/inicio.php");
    }
    header("Location:../view/inicio.php");
?>