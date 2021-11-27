<?php
require 'dbBroker.php';
require 'model/faktura.php';
require 'model/komitent.php';

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
else{
   $komitenti=Komitent::vratiSveKomitente($_SESSION['izdavac_id'],$conn);
   $faktura_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style=" font-family: 'Inter', sans-serif;background: linear-gradient(90deg, #edc0bf 0,#c4caef 58%);">
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
            <button id="btn-odjava" style="cursor:pointer;border:none;margin-top:7px;background-color:inherit;">Odjava</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div>
        <table id="myTable" class="table table-striped" style="width:50%;margin-left:auto;margin-right:auto;text-align:center;background-color:white;border-radius:5px;">
            <thead class="thead-dark" style="border-radius:5px;">
                <th>Broj fakture</th>
                <th>Kupac</th>
                <th>Datum</th>
                <th>Ukupno</th>
                <th><button class="btn btn-dark" onclick="sortirajPoDatumima();">Sortiraj</button></th>
                <th></th>
            </thead>
            <tbody style="border-radius:5px;">
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
                    <td><button onclick="detaljnaFaktura(this.name)" id="btn-detalji-fak" name=<?php echo $red['fakturaId']?>  class="btn btn-primary">Detalji</button></td>
                    <td><button onclick="obrisiFakturu(this.name)" name=<?php echo $red['fakturaId']?> class="btn btn-danger" id="btn-obrisi-fakturu">Obrisi</button></td>
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
<script src="js/main.js"></script>
<script src="js/logout.js"></script>

<script>


  function detaljnaFaktura(e){
    
    window.location.replace('detaljna-faktura.php/'+e);
  }

  function sortirajPoDatumima() {
            console.log("Sortiranje tabele!");
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("myTable");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[2];
                    console.log(x);
                    y = rows[i + 1].getElementsByTagName("TD")[2];
                    console.log(y);
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }


  function obrisiFakturu(e){
    console.log("Brisanje fakture");
    req=$.ajax({
      url:'handler/delete-invoice.php',
      type:'post',
      data:{'id_izbrisi':e}
    })
    req.done(function(res,textStatus,jqXHR){
      if(res=="Success"){
        alert("Faktura uspesno izbrisana "+res);
        location.reload();
      }else{
        alert("Problem u brisanju fakture "+res);
        location.reload();
      }
    })
  }

  

</script>
</html>