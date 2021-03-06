<?php
    include_once '../../services/conection.php';

    $id=$_REQUEST['id_events'];
    $name=$_FILES['foto']['tmp_name'];
    $date=date('Y-m-d-H-i-s');
    $path="../public/profile/{$date}_{$_FILES['foto']['name']}";
    $newpath="../../public/profile/{$date}_{$_FILES['foto']['name']}";
    if (move_uploaded_file($name, $newpath)){
        try{
            $query="UPDATE tbl_events SET foto_event=? WHERE id_events=?";
            $pdo->beginTransaction();
            $stmt=$pdo->prepare($query);
            $path="../public/profile/{$date}_{$_FILES['foto']['name']}";
            $stmt->bindParam(1,$path);
            $stmt->bindParam(2,$id);
            $stmt->execute();
            $pdo->commit();
        }catch(PDOException $e){
            echo $e->getMessage();
            header("Location:../../view/evento-responsable.php");
            unlink($path);
            $pdo->rollBack();
        }
    }header("Location:../../view/evento-responsable.php");
?>