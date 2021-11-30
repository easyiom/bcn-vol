<?php

class Usuario{
    public $id_user;
    public $email_user;
    public $pass_user;
    public $nom_user;
    public $cognom_user;
    public $dni_user;
    public $data_naix_user;
    public $sexe_user;
    public $telf_user;
    public $foto_user;
    public $rol_user;

    public function __construct($id,$email,$password,$nombre,$apellido,$dni,$dataNaix,$sexo,$telf,$foto,$rol){
        $this->id_user=$id;
        $this->email_user=$email;
        $this->pass_user=$password;
        $this->nom_user=$nombre;
        $this->cognom_user=$apellido;
        $this->dni_user=$dni;
        $this->data_naix_user=$dataNaix;
        $this->sexe_user=$sexo;
        $this->telf_user=$telf;
        $this->foto_user=$foto;
        $this->rol_user=$rol;
    }
}
?>