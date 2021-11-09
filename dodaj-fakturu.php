<?php
include 'dbBroker.php';
include 'model/komitent.php';
include 'model/faktura.php';
session_start();
if(!isset($_SESSION['izdavac_id'])){
    header('Location: index.php');
    exit();
}
$komitenti=Komitent::vratiSveKomitente($_SESSION['izdavac_id'],$conn);
if(!$komitenti){
    echo "Problem u ucitavanju kupaca.";
    die();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj fakturu</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body><nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:10rem;">
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
    <form action="#" method="post" id="dodajFakturu" style="width:50%;margin-left:auto;margin-right:auto;">

    <div class="row">
        <div class="col">
            <label for="">Broj fakture</label>
            <input type="text" name="broj_fakture" class="form-control" aria-label="Broj fakture">
        </div>
        <div class="col">
        <label for="">Kupac</label>
        <?php
        if($komitenti->num_rows==0){
        ?>
        <select class="form-select" aria-label="Default select example">
            <option selected>Nemate sacuvanih kupaca.Prvo dodajte kupca.</option>
        </select>
        <?php }else{  
        ?>
            <select class="form-select" name="komitent" aria-label="Default select example" style="height:35px;width:23rem;">
            <option selected></option>
        <?php 
            while($red=$komitenti->fetch_array()):
        ?>
            <option value=<?php echo $red['komitentId']?>><?php echo $red['komitentId'] . '-' .$red['naziv']?></option>
        <?php
        endwhile;
    }
        ?>
        </select>
        </div>
    </div>
    <div class="row">
  <div class="col">
    <label for="">Datum izdavanja</label>
    <input type="date" name="datum_izdavanja" class="form-control" placeholder="First name" aria-label="First name">
  </div>
  <div class="col">
      <label for="">Rok placanja</label>
    <input type="date" name="rok_placanja" class="form-control" placeholder="" aria-label="Last name"?>
  </div>
</div>
    
    <div>
    <table class="table table-striped" style="width:100%;margin-left:auto;margin-right:auto;text-align:center;margin-top:2.5rem;">
            <thead class="thead-dark">
                <th>#</th>
                <th>Naziv proizvoda</th>
                <th>Kolicina</th>
                <th>Cena</th>
                <th>Valuta</th>
                <th>  <button id="dodajStavku" type="button" class="btn btn-primary" data-toggle="stavkaModal" data-target="#stavkaModal">+</button></th>
            </thead>
            <tbody id="stavke">

            </tbody>
    </table>
  
     
     <table class="table" style="width:22rem;font-size:12px;text-align:center;float:right;">
  <thead>
    <tr>
      <th scope="col" style="font-size:12px;">Ukupno(bez PDV)</th>
      <th scope="col">PDV(%)</th>
      <th scope="col">Ukupno(sa PDV)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th id="ukupno"></th>
      <th id="pdv"></th>
      <th  name="ukupan_iznos"><input type="text" name="ukupno" id="ukupnoSaPdv" style="border:none;text-align:center;font-weight:bold;"></th>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th><button class="btn btn-success" id="btn-sacuvaj-fakturu">Sacuvaj fakturu</button></th>
    </tr>
  </tbody>
  <tfoot>
    
  </tfoot>
</table>

</form>
             

    
  <div class="modal" tabindex="-1" id="stavkaModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Dodaj stavku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="#" method="post">
       <div class="row" style="margin-bottom:20px;">
            <div class="col">
                <input type="text" id="naziv-proizvoda" name="naziv-proizvoda" class="form-control" placeholder="Naziv proizvoda" aria-label="First name">
            </div>
            <div class="col">
                <input type="number" id="kolicina" name="kolicina" step=1 class="form-control" placeholder="Kolicina" aria-label="Last name">
            </div>
        </div>
        <div class="row" style="margin-bottom:20px;">
            <div class="col">
                <input type="number" id="cena" name="cena" class="form-control" placeholder="Cena" aria-label="First name">
            </div>
            <div class="col">
            <select class="form-select" id="valuta" name="valuta" aria-label="Default select example" style="height:37px;width:13rem;">
                <option value="RSD">RSD</option>
                <option value="EUR">EUR</option>
                <option value="USD">USD</option>
            </select>
            </div>
        </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btn-sacuvaj-stavku" type="button" class="btn btn-primary" onclick="dodajStavkuFakture()">Sacuvaj stavku</button>
      </div>
    </div>
  </div>
</div>
    </div>
   
</body>
<script src="js/main.js"></script>
</html>

<script>
    let number="1";
    let ukupan_zbir=0;
    function dodajStavkuFakture(){
        const naziv=document.getElementById('naziv-proizvoda').value;
        const cena=document.getElementById('cena').value;
        const kolicina=document.getElementById('kolicina').value;
        const valuta=document.getElementById('valuta').value;

        const th_naziv=document.createElement('th');
        const th_cena=document.createElement('th');
        const th_kolicina=document.createElement('th');
        const th_valuta=document.createElement('th');
        const th_broj=document.createElement('th');
        const th_empty=document.createElement('th');

        th_broj.innerHTML=number;
        th_naziv.innerHTML=naziv;
        th_cena.innerHTML=cena;
        th_kolicina.innerHTML=kolicina;
        th_valuta.innerHTML=valuta;

        const tr=document.createElement('tr');
        tr.appendChild(th_broj);
        tr.appendChild(th_naziv);
        tr.appendChild(th_kolicina);
        tr.appendChild(th_cena);
        tr.appendChild(th_valuta);
        tr.appendChild(th_empty);

        ukupan_zbir+=(+cena)*(+kolicina);
        console.log(ukupno);

        document.getElementById('ukupno').innerHTML=ukupan_zbir;
        document.getElementById('pdv').innerHTML="20";
        document.getElementById('ukupnoSaPdv').value=ukupan_zbir+ukupan_zbir*(20/100);

        const tabela=document.getElementById('stavke');
        tabela.appendChild(tr);

        number++;
        document.getElementById('naziv-proizvoda').value="";
        document.getElementById('cena').value="";
        document.getElementById('kolicina').value="";
        document.getElementById('valuta').value="";





    }

</script>