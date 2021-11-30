<?php
    include '../services/conection.php';
    include '../procedures/class/evento.php';

    //Recogemos los datos del formulario
    // $nombre=$_REQUEST['nom_events'];
    // $dataIni=$_REQUEST['data_ini_event'];
    // $dataFi=$_REQUEST['data_fi_event'];
    // $adre=$_REQUEST['adre_event'];
    // $desc=$_REQUEST['desc_event'];
    // $ubi=$_REQUEST['ubi_event'];
    // $capac=$_REQUEST['capac_event'];
    // $estat=$_REQUEST['estat_event'];
    // $foto=$_REQUEST['foto_event'];


     $id=null;
     $nombre="Hola";
     $dataIni="2021-11-24";
     $dataFi="2021-11-27";
     $adre="C. Esteve Cardelus";
     $desc="Evento solidario en contra de las enfermedades respiratorias";
     $ubi="Sant Celoni";
     $capac="100";
     $estat="Actiu";
     $foto=NULL;

    //Añadimos un nuevo elemento a la clase Evento
    $evento=new Evento($id,$nombre,$dataIni,$dataFi,$adre,$desc,$ubi,$capac,$estat,$foto);

    //Preparamos la query
    $stmt=$pdo->prepare("INSERT INTO tbl_events(id_events,nom_events, data_ini_event, data_fi_event, adre_event, desc_event, ubi_event, capac_event, estat_event, foto_event) VALUES (:id_events, :nom_events, :data_ini_event, :data_fi_event, :adre_event, :desc_event, :ubi_event, :capac_event, :estat_event, :foto_event)");

    try{
        if($stmt->execute((array) $evento)){
             header("Location:../view/inicio.php");
        }
    }catch(PDOException $e){
         echo $e->getMessage();
         header("Location:../view/inicio.php");
    }
?>