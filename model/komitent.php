<?php

class Komitent{

    public $id;
    public $naziv;
    public $pib;
    public $adresa;
    public $fk_izdavac;

    public function __construct($id=null,$naziv=null,$pib=null,$adresa=null,$fk_izdavac=null){
        $this->id=$id;
        $this->naziv=$naziv;
        $this->pib=$pib;
        $this->adresa=$adresa;
        $this->fk_izdavac=$fk_izdavac;
    }

     public static function dodajKomitenta($komitent, mysqli $conn){
         $query="INSERT INTO komitent(naziv,pib,adresa,fk_izdavac) VALUES('$komitent->naziv','$komitent->pib',
         '$komitent->adresa','$komitent->fk_izdavac')";
         return $conn->query($query);
     }
     
     public function izbrisiPoId(mysqli $conn){
         $query="DELETE FROM komitent WHERE komitentId='$this->id'";
         return $conn->query($query);
     }

     public static function vratiSveKomitente($id,mysqli $conn){
         $query= "SELECT * FROM komitent WHERE fk_izdavac='$id'";
         return $conn->query($query);
     }

     public static function vratiKomitentaPoId($id, mysqli $conn){
         $query="SELECT * FROM komitent WHERE id='$id'";
         return $conn->query($query);
     }

}












?>