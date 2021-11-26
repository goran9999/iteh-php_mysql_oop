<?php

if(isset($_SESSION['korisnik_id'])){
    session_destroy();
    header('Location: index.php');
    echo "Success";
}else{
    echo "Failed";
}


?>