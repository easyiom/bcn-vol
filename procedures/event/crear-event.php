<?php
    include_once '../../services/conection.php';
    include_once '../../procedures/class/evento.php';

    //Recogemos los datos del formulario
    $nombre=$_REQUEST['nom'];
    $dataIni=$_REQUEST['ini'];
    $dataFi=$_REQUEST['fi'];
    $adre=$_REQUEST['adre'];
    $desc=$_REQUEST['desc'];
    $ubi=$_REQUEST['ubi'];
    $capac=$_REQUEST['cap'];
    $estat= 'Activo';
    // $foto=$_REQUEST['foto'];
    $name=$_FILES['foto']['tmp_name'];
    $date=date('Y-m-d-H-i-s');
    $path="../public/event/{$date}_{$_FILES['foto']['name']}";
    $newpath="../../public/event/{$date}_{$_FILES['foto']['name']}";



    $id=null;
    //  $nombre="Hola";
    //  $dataIni="2021-11-24";
    //  $dataFi="2021-11-27";
    //  $adre="C. Esteve Cardelus";
    //  $desc="Evento solidario en contra de las enfermedades respiratorias";
    //  $ubi="Sant Celoni";
    //  $capac="100";
    //  $estat="Actiu";
    //  $foto=NULL;

    //Añadimos un nuevo elemento a la clase Evento
    $evento=new Evento($id,$nombre,$dataIni,$dataFi,$adre,$desc,$ubi,$capac,$estat,$path);

    //Preparamos la query
    $stmt=$pdo->prepare("INSERT INTO tbl_events(id_events,nom_events, data_ini_event, data_fi_event, adre_event, desc_event, ubi_event, capac_event, estat_event, foto_event) VALUES (:id_events, :nom_events, :data_ini_event, :data_fi_event, :adre_event, :desc_event, :ubi_event, :capac_event, :estat_event, :foto_event)");
    if (move_uploaded_file($name, $newpath)){
    try{
        if($stmt->execute((array) $evento)){
            header("Location:../../view/inicio.php");
        }
    }catch(PDOException $e){
        echo $e->getMessage();
        header("Location:../../view/inicio.php");
        unlink($path);
    }
}
?>