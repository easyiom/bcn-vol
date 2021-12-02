<?php
    include_once '../../services/conection.php';

    $id=$_REQUEST['id_events'];
    $nombre=$_REQUEST['nom_events'];
    $estado=$_REQUEST['estat_event'];
    $dataIni=$_REQUEST['data_ini_event'];
    $dataFi=$_REQUEST['data_fi_event'];
    $adre=$_REQUEST['adre_event'];
    $ubi=$_REQUEST['ubi_event'];

    
    $pdo->beginTransaction();
    $stmt=$pdo->prepare("UPDATE tbl_events SET nom_events=?, data_ini_event=?, data_fi_event=?, adre_event=?, ubi_event=?, estat_event=? WHERE id_events=?");
    $stmt->bindParam(1,$nombre);
    $stmt->bindParam(2,$dataIni);
    $stmt->bindParam(3,$dataFi);
    $stmt->bindParam(4,$adre);
    $stmt->bindParam(5,$ubi);
    $stmt->bindParam(6,$estado);
    $stmt->bindParam(7,$id);
    try{
        $stmt->execute();
        $pdo->commit();
    }catch(PDOException $e){
        echo $e->getMessage();
        $pdo->rollBack();
        header("Location:../../view/inicio.php");
    }
    header("Location:../../view/inicio.php");
?>