<?php
    include_once '../../services/conection.php';

    $id=$_REQUEST['id_user'];
    $name=$_FILES['foto']['tmp_name'];
    $date=date('Y-m-d-H-i-s');
    $path="../../public/profile/{$date}_{$_FILES['foto']['name']}";
    if (move_uploaded_file($name, $path)){
        try{
            $query="UPDATE tbl_usuari SET foto_user=? WHERE id_user=?";
            $pdo->beginTransaction();
            $stmt=$pdo->prepare($query);
            $path="../public/profile/{$date}_{$_FILES['foto']['name']}";
            $stmt->bindParam(1,$path);
            $stmt->bindParam(2,$id);
            $stmt->execute();
            $pdo->commit();
        }catch(PDOException $e){
            echo $e->getMessage();
            // header("Location:../../view/inicio.php");
            unlink($path);
            $pdo->rollBack();
        }
    }//header("Location:../../view/inicio.php");
?>