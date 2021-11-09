<?php

require '../dbBroker.php';
require '../model/komitent.php';

if(isset($_POST['id'])){
    $komitent=new Komitent($_POST['id']);
    $status=$komitent->izbrisiPoId($conn);
    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}

?>