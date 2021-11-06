<?php
class Izdavac{

   public $id;
   public $naziv;
   public $pib;
   public $adresa;
   public $username;
   public $sifra;

   public function __construct($id=null,$naziv=null,$pib=null,$adresa=null,$username=null,$sifra=null){
       $this->id=$id;
       $this->naziv=$naziv;
       $this->pib=$pib;
       $this->adresa=$adresa;
       $this->username=$username;
       $this->sifra=$sifra;
   }

   public static function ulogujIzdavaca($usr, mysqli $conn){
        $query = "SELECT * FROM izdavac WHERE username='$usr->username'
        AND sifra='$usr->sifra'";
        return $conn->query($query);
   }

   public static function registrujIzdavaca(Izdavac $usr,mysqli $conn){
       $query= "INSERT INTO izdavac(naziv, pib, adresa, username, sifra) VALUES('$usr->naziv','$usr->pib','$usr->adresa','$usr->username','$usr->sifra')";
       echo $query;
       return $conn->query($query);
   }

}












?>