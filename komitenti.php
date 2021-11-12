<?php

require 'dbBroker.php';
require 'model/komitent.php';

session_start();
if(!isset($_SESSION['izdavac_id'])){
    header('Location: index.php');
    exit();
}

$komitenti = Komitent::vratiSveKomitente($_SESSION['izdavac_id'],$conn);
if(!$komitenti){
  echo 'Problem u ucitavanju vasih kupaca!';
  die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
          <a class="nav-link active" href="#">Dodaj fakturu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Kupci</a>
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
                <th>#</th>
                <th>Naziv</th>
                <th>PIB</th>
                <th>Adresa</th>
                <th>Brisanje</th>
            </thead>
  <tbody>
    <?php
       if($komitenti->num_rows==0){
         echo "<p style='text-align:center;'>Nemate unesenih kupaca</p>";
       }else{
          while($red=$komitenti->fetch_array()):
    ?>
        <tr>
          <td><?php echo $red['komitentId']?></td>
          <td><?php echo $red['naziv']?></td>
          <td><?php echo $red['pib']?></td>
          <td><?php echo $red['adresa']?></td>
          <td><button onclick="obrisiKupca(this.name)" formmethod="post" class="btn btn-danger" id="btn-obrisi-kupca" name=<?php echo $red['komitentId']?> style="height:2rem;padding:0 10px;">Obrisi</button></td>
        </tr>
        <?php
        endwhile;
      }
        ?>
  </tbody>
  </table>
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" datatarget="#myModal" style="float:right;margin-right:24rem;" id="btn-dodaj-kupca">Dodaj kupca</button>

<div class="modal" tabindex="-1" role="dialog" id="myModal" style="margin-top:10rem;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Dodaj kupca</h5>
        <button type="button" class="close" data-dismiss="modal" id="btn-odustani" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="post" id="dodajKupca">
      <div class="modal-body">
      <div class="row">
        <div class="col">
          <input type="text" name="naziv" class="form-control" placeholder="Naziv" aria-label="Naziv">
        </div>
        <div class="col">
          <input type="text" name="pib" class="form-control" placeholder="PIB" aria-label="PIB">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <input type="text" name="adresa" class="form-control" placeholder="Adresa" aria-label="Adresa">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Telefon" type="number" aria-label="Telefon">
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn-sacuvaj-komitenta">Sacuvaj</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-odustani">Odustani</button>
      </div>
    </div>
  </div>
</div>
</div>
</form>
</body>

<script src="js/main.js"></script>

<script>

    function obrisiKupca(e){
      console.log("Brisanje kupca");
      req = $.ajax({
        url:'handler/delete-customer.php',
        type:'post',
        data:{'id':e}
    })
    req.done(function(res,textStatuss,jqXHR){
        if(res=="Success"){
            console.log("Deleted");
            alert("Kupac sa id-em"+e+"je izbrisan");
            location.reload();
        }else{
            console.log('Kupac nije izbrisan'+res);
        }
    })
    }

</script>
</html>