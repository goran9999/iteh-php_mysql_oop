<?php
class Izdavac{

   public $id;
   public $naziv;
   public $pib;
   public $adresa;
   public $username;
   public $password;

   public function __construct($id=null,$naziv,$pib,$adresa,$username,$password){
       $this->id=$id;
       $this->naziv=$naziv;
       $this->pib=$pib;
       $this->adresa=$adresa;
       $this->username=$username;
       $this->password=$password;
   }

   public static function ulogujIzdavaca($usr, mysqli $conn){
        $query = "SELECT * FROM izdavac WHERE username='$usr->username'
        AND password='$usr->password'";
        return $conn->query($query);
   }

   public static function registrujIzdavaca($usr,mysqli $conn){
       $query= "INSERT INTO izdavac(naziv,pib,adresa,username,password) VALUES('$usr->$naziv','$usr->pib','$usr->adresa','$usr->username',$usr->password')";
       return $conn->query($query);
   }

}












?>