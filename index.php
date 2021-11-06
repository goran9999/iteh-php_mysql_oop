<?php

include 'model/izdavac.php';
include 'dbBroker.php';

session_start();
if(isset($_POST['username'])&&isset($_POST['password'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $izdavac=new Izdavac(1,null,null,null,$username,$password);
    $odg=Izdavac::ulogujIzdavaca($izdavac,$conn);

    if($odg->num_rows==1){
        echo `<script> console.log("Ulogovali ste se") </script>`;
        $_SESSION['izdavac_id']=$izdavac->id;
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
    <title>Fakture</title>
</head>
<body>
    <div class="card">

        <h1>Fakture</h1>

        <div class="main-div">
            <form action="#" method="POST">
                <div class="container">
                    <label for="username">Korisnicko ime</label>
                    <input type="text" id="username" name="username">
                    <br>
                    <label for="sifra">Sifra</label>
                    <input type="password" id="sifra" name="password">
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