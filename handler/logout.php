<?php
    session_start();

 

    if(isset($_SESSION['izdavac_id'])){
        session_destroy();
        echo "Success";
    }else{
        echo 'Failed';
    }

   



?>