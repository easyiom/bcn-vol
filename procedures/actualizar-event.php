<?php
    include '../services/conection.php';
    //include '../procedures/class/evento.php';

    //Recogemos los datos del formulario
    $nombre=$_REQUEST['nom_events'];
    $dataIni=$_REQUEST['data_ini_event'];
    $dataFi=$_REQUEST['data_fi_event'];
    $adre=$_REQUEST['adre_event'];
    $desc=$_REQUEST['desc_event'];
    $ubi=$_REQUEST['ubi_event'];
    $capac=$_REQUEST['capac_event'];
    $estat=$_REQUEST['estat_event'];
    $foto=$_REQUEST['foto_event'];
    $id=$_REQUEST['id_events'];

    // $id=3;
    // $nombre="Adeu";
    // $dataIni="2021-11-16";
    // $dataFi="2021-11-21";
    // $adre="C. Santa Rosa";
    // $desc="Evento solidario en contra de la diabetes";
    // $ubi="PalauTordera";
    // $capac="150";
    // $estat="Actiu";
    // $foto=NULL;

    //Preparamos la query que ejecutará el update
    $stmt=$pdo->prepare("UPDATE tbl_events SET nom_events=?, data_ini_event=?, data_fi_event=?, adre_event=?, desc_event=?, ubi_event=?, capac_event=?, estat_event=? ,foto_event=? WHERE id_events=?");
    $stmt->bindParam(1,$nombre);
    $stmt->bindParam(2,$dataIni);
    $stmt->bindParam(3,$dataFi);
    $stmt->bindParam(4,$adre);
    $stmt->bindParam(5,$desc);
    $stmt->bindParam(6,$ubi);
    $stmt->bindParam(7,$capac);
    $stmt->bindParam(8,$estat);
    $stmt->bindParam(9,$foto);
    $stmt->bindParam(10,$id);
    $stmt->execute();

    //Al ejecutarse nos envia a inicio
    header("Location:../view/inicio.php");
?>