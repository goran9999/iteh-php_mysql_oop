<?php
include '../dbBroker.php';
include '../model/faktura.php';
include '../model/stavkaFakture.php';

session_start();



$arr=explode('&',$_POST['forma']);
$keys=array();
$values=array();
for($i=0;$i<5;$i++){
    $v=explode('=',$arr[$i]);
    $keys[]=$v[0];
    $values[]=$v[1];
}
$forma=array_combine($keys,$values);






if($forma['broj_fakture']&&$forma['komitent']&&$forma['datum_izdavanja']&&$forma['ukupno']){
    $id=$_SESSION['izdavac_id'];
    $faktura=new Faktura(null,$forma['broj_fakture'],$forma['datum_izdavanja'],$forma['ukupno'],$id,$forma['komitent']);
    $status=Faktura::sacuvajFakturu($faktura,$conn);
    $poslednji_id=$conn->insert_id;
    for($i=0;$i<count($_POST['stavke']);$i++){
        $stavka=new StavkaFakture(null,$_POST['stavke'][$i]['naziv'],$_POST['stavke'][$i]['kolicina'],$_POST['stavke'][$i]['cena'],
        $_POST['stavke'][$i]['valuta'],$poslednji_id);
        $odg=StavkaFakture::dodajStavku($stavka,$conn);
    }
        if($status){
        echo 'Success';
    }else{
        echo $status;
        echo 'Failed';
    }
}

?>