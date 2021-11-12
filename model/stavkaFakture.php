<?php

class StavkaFakture{

    public $id;
    public $naziv_proizvoda;
    public $kolicina;
    public $cena;
    public $valuta;
    public $fk_faktura;


    public function __construct($id=null,$naziv_proizvoda,$cena,$kolicina,$valuta,$fk_faktura){
        $this->id=$id;
        $this->naziv_proizvoda=$naziv_proizvoda;
        $this->kolicina=$kolicina;
        $this->cena=$cena;
        $this->valuta=$valuta;
        $this->fk_faktura=$fk_faktura;
    }

    public static function dodajStavku($stavka,mysqli $conn){
        $query="INSERT INTO stavkafakture(naziv_proizvoda,cena,kolicina,valuta,fk_faktura)
        VALUES ('$stavka->naziv_proizvoda','$stavka->cena','$stavka->kolicina','$stavka->valuta','$stavka->fk_faktura')";
        return $conn->query($query);
    }

    public function izbrisiStavku(mysqli $conn){
        $query="DELETE FROM stavkafakture WHERE id='$this->id'";
        return $conn->query($query);
    }

    public static function vratiStavkeFakture($id_fakture,$conn){
        $query="SELECT * FROM stavkafakture WHERE fk_faktura='$id_fakture'";
        return $conn->query($query);
    }

    public static function izbrisiSveStavke($id,$conn){
        $query="DELETE FROM stavkaFakture WHERE fk_faktura='$id'";
        return $conn->query($query);
    }

    public function __toString(){
        $str=$this->naziv_proizvoda . $this->kolicina . $this->valuta . $this->fk_faktura;
        return $str;
    }


}








?>