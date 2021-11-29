<?php
class Evento{
    public $id_events;
    public $nom_events;
    public $data_ini_event;
    public $data_fi_event;
    public $adre_event;
    public $desc_event;
    public $ubi_event;
    public $capac_event;
    public $estat_event;
    public $foto_event;
    
    public function __construct($id,$nombre,$dataIni,$dataFi,$adre,$desc,$ubi,$capac,$estat,$foto){
        $this->id_events=$id;
        $this->nom_events=$nombre;
        $this->data_ini_event=$dataIni;
        $this->data_fi_event=$dataFi;
        $this->adre_event=$adre;
        $this->desc_event=$desc;
        $this->ubi_event=$ubi;
        $this->capac_event=$capac;
        $this->estat_event=$estat;
        $this->foto_event=$foto;
    }
}
?>