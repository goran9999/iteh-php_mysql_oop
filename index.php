<?php

include 'model/izdavac.php';
include 'dbBroker.php';

session_start();
if(isset($_POST['username'])&&isset($_POST['password'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $izdavac=new Izdavac(134,null,null,null,$username,$password);
    $odg=Izdavac::ulogujIzdavaca($izdavac,$conn);
    if($odg->num_rows==1){
        echo `<script> console.log("Ulogovali ste se") </script>`;
        echo $izdavac->id;
        while($red=$odg->fetch_array()){
        $_SESSION['izdavac_id']=$red['izdavacId'];
        }
        header('Location: home.php');
        exit();
    }else{
        echo `<script>alert("Neuspesna prijava")</script>`;
    }

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <title>Fakture</title>
</head>
<body>
    <div class="card">

        
        <div class="main-div">
            <h1 class="card-title">Fakture</h1>
            <form action="#" method="POST">
                <div class="container">
                    
                    <input  type="text" id="username" name="username" placeholder="Username">       
                    <br>
                    
                    <input type="password" id="sifra" name="password" placeholder="Password">
                    <br>
                    <button type="submit" name="submit">Prijavi se</button>
                    <br>
                    <a href="registracija.php">Kreiraj nalog</a>
                </div>
            </form>
        </div>

    </div>
</body>
</html>