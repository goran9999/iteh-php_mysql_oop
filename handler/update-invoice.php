<?php
include '../dbBroker.php';
include '../model/faktura.php';
include '../model/stavkaFakture.php';
if(isset($_POST['ukupno'])&&isset($_POST['id'])&&$_POST['stavke']){


    $ukupno=explode('=',$_POST['ukupno']);
    $ukupan_iznos=end($ukupno);
    $status=Faktura::azurirajFakturu($_POST['id'],$ukupan_iznos,$conn);
    
    StavkaFakture::izbrisiSveStavke($_POST['id'],$conn);
   
    for($i=0;$i<count($_POST['stavke']);$i++){
        $stavka=new StavkaFakture(null,$_POST['stavke'][$i]['naziv'],$_POST['stavke'][$i]['cena'],
        $_POST['stavke'][$i]['kolicina'],$_POST['stavke'][$i]['valuta'],$_POST['id']);
        $odg=StavkaFakture::dodajStavku($stavka,$conn);
    }
    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}

?>