<?php
include '../dbBroker.php';
include '../model/faktura.php';
include '../model/stavkaFakture.php';

session_start();
if(isset($_POST['broj_fakture'])&&isset($_POST['komitent'])&&isset($_POST['datum_izdavanja'])&&isset($_POST['ukupno'])){
    $id=$_SESSION['izdavac_id'];
    $kupac=substr($_POST['komitent'],0,2);
    $faktura=new Faktura(null,$_POST['broj_fakture'],$_POST['datum_izdavanja'],$_POST['ukupno'],$id,$kupac);
    echo $faktura->ukupan_iznos;
    $status=Faktura::sacuvajFakturu($faktura,$conn);
    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo 'Failed';
    }
}

?>