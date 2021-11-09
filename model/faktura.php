<?php

class Faktura{

    public $id;
    public $broj;
    public $datum;
    public $ukupan_iznos;
    public $fk_izdavac;
    public $fk_komitent;


    public function __construct($id=null,$broj,$datum,$ukupan_iznos,$fk_izdavac,$fk_komitent){
        $this->id=$id;
        $this->broj=$broj;
        $this->datum=$datum;
        $this->ukupan_iznos=$ukupan_iznos;
        $this->fk_izdavac=$fk_izdavac;
        $this->fk_komitent=$fk_komitent;
    }

    public static function sacuvajFakturu($faktura,mysqli $conn){
        $query="INSERT INTO faktura(broj,datum,ukupan_iznos,fk_izdavac,fk_komitent)
        VALUES ('$faktura->broj','$faktura->datum','$faktura->ukupan_iznos','$faktura->fk_izdavac','$faktura->fk_komitent')";

        return $conn->query($query);
    }

    public static function vratiFaktureIzdavaca($fk_izdavac,mysqli $conn){
        $query="SELECT F.fakturaId,F.broj,F.datum,F.ukupan_iznos,K.naziv 
        from faktura F LEFT JOIN komitent K ON F.fk_komitent=K.komitentId WHERE F.fk_izdavac='$fk_izdavac'";
        return $conn->query($query);
    }

    public function izbrisiPoId(mysqli $conn){
        $query="DELETE FROM faktura WHERE id='$this->id'";
        return $conn->query($query);
    }

    public function vratiFakturuPoId(mysqli $conn){
        $query="SELECT * FROM faktura WHERE id='$this->id'";
        return $conn->query($query);
    }

    public function izmeniFakturu($id,mysqli $conn){
        $query="UPDATE faktura set broj='$this->broj',datum='$this->datum',ukupan_izos='$this->ukupan_iznos'
        fk_izdavac='$this->fk_izdavac',fk_komitent='$this->fk_komitent' WHERE id='$id' ";
         return $conn->query($query);
    }

    public static function vratiNajveciId(mysqli $conn){
        $query="SELECT MAX(fakturaId) from faktura";
        return $conn->query($query);
    }

}









?>