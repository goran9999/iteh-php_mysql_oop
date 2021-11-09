<?php
require 'dbBroker.php';
require 'model/faktura.php';

session_start();
if(!isset($_SESSION['izdavac_id'])){
    header('Location: index.php');
    exit();
}
$fakture=Faktura::vratiFaktureIzdavaca($_SESSION['izdavac_id'],$conn);
if(!$fakture){
    echo 'Nastala je greska prilikom ucitavanja faktura.';
    die();
}
// if($fakture->num_rows==0){
//     echo 'Nemate sacuvanih faktura.';
//     die();
 //}
 else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style=" font-family: 'Inter', sans-serif;">
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:10rem;">
  <div class="container-fluid"  style="float:rigt;">
    <div>
    <img class="shape" src="https://s3.us-east-2.amazonaws.com/ui.glass/shape.svg" alt="" style="width:50px;">
    <h3 style="float:right;margin-top:10px;margin-left:20px;">Fakture</h3>
    </div>
    <div>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Fakture</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="dodaj-fakturu.php">Dodaj fakturu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="komitenti.php">Kupci</a>
        </li>
        <li>
            <button style="border:none;margin-top:7px;background-color:inherit;">Odjava</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div>
        <table class="table table-striped" style="width:50%;margin-left:auto;margin-right:auto;text-align:center;">
            <thead class="thead-dark">
                <th>Broj fakture</th>
                <th>Kupac</th>
                <th>Datum</th>
                <th>Ukupno</th>
                <th><button class="btn btn-dark">Sortiraj</button></th>
                <th></th>
            </thead>
            <tbody>
                <?php
                if($fakture->num_rows==0){
                ?>
                <tr><p style="text-align:center;">Nemate sacuvanih faktura!</p></tr>
                <?php
                }else{
                while($red=$fakture->fetch_array()):
                ?>
                <tr>
                    <td><?php echo $red['broj']?></td>
                    <td><?php echo $red['naziv']?></td>
                    <td><?php echo $red['datum']?></td>
                    <td style="margin-left:50px;"><?php echo $red['ukupan_iznos']?></td>
                    <td><button name=<?php echo $red['fakturaId']?> class="btn btn-primary">Izmeni</button></td>
                    <td><button name=<?php echo $red['fakturaId']?> class="btn btn-danger">Obrisi</button></td>
                </tr>
                <?php
                endwhile;
                 }
            }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>