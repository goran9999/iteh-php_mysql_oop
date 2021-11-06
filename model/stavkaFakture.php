<?php

class StavkaFakture{

    public $id;
    public $naziv_proizvoda;
    public $kolicina;
    public $cena;
    public $valuta;
    public $fk_faktura;


    public function __construct($id=null,$naziv_proizvoda,$kolicina,$cena,$valuta,$fk_faktura){
        $this->id=$id;
        $this->naziv_proizvoda=$naziv_proizvoda;
        $this->kolicina=$kolicina;
        $this->cena=$cena;
        $this->valuta=$valuta;
        $this->fk_faktura=$fk_faktura;
    }

    public  function dodajStavku($id,mysqli $conn){
        $query="INSERT INTO stavka fakture(naziv_proizvoda,kolicina,cena,valuta,fk_faktura
        VALUES ('$this->naziv_proizvoda','$this->kolicina','$this->cena','$this->valuta','$id')";
        return $conn->query($query);
    }

    public function izbrisiStavku(mysqli $conn){
        $query="DELETE FROM stavka fakture WHERE id='$this->id'";
        return $conn->query($query);
    }


}








?>