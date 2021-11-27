<?php
include 'dbBroker.php';
include 'model/faktura.php';
include 'model/stavkaFakture.php';
session_start();
$param_array=explode('/',$_SERVER['REQUEST_URI']);
$param=end($param_array);

$faktura=Faktura::vratiFakturuPoId($param,$conn);

if(!$faktura){
    echo "Problem u ucitavanju fakture";
    die();
}else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
   
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:10rem;">
  <div class="container-fluid"  style="float:rigt;">
    <div>
    <img class="shape" src="https://s3.us-east-2.amazonaws.com/ui.glass/shape.svg" alt="" style="width:50px;">
    <h3 style="float:right;margin-top:10px;margin-left:20px;">Fakture</h3>
    </div>
    <div>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/iteh/iteh_domaci_1/home.php">Fakture</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="dodaj-fakturu.php">Dodaj fakturu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/iteh/iteh_domaci_1/komitenti.php">Kupci</a>
        </li>
        <li>
            <button id="btn-odjavas" style="border:none;margin-top:7px;background-color:inherit;">Odjava</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div style="margin-top:10rem;">
    <form action="#" method="post" id="detaljnaFaktura" style="width:50%;margin-left:auto;margin-right:auto;">
    <?php 
      $iznos=0;
      while($red=$faktura->fetch_array()):
      
      $iznos=$red['ukupan_iznos'];
    ?>
    <div class="row" id="red" name=<?php echo $param?>>
        <div class="col">
        <label for="">Broj fakture</label>
        <input type="text" name="broj_fakture_" value=<?php echo $red['broj']?> disabled class="form-control" placeholder="Broj fakture">
        </div>
        <div class="col">
        <label for="">Kupac</label>
        <input type="text" name="kupac" value=<?php echo $red['naziv']?> disabled class="form-control" placeholder="Kupac">
        </div>
    </div>
    <div class="row" style="margin-top:1.5rem;">
        <div class="col">
        <label for="" >Datum izdavanja</label>
        <input name="datum_izdavanja" value=<?php echo $red['datum']?> disabled type="date" class="form-control" placeholder="Datum izdavanja">
        </div>
        <div class="col">
        <label for="">Ukupan iznos</label>
        <input name="ukupan_iznos" value=<?php echo $red['ukupan_iznos']?> disabled type="text" class="form-control" placeholder="Kupac">
        </div>
    </div>
    
    <?php endwhile;?>
    
    <table id="stavke" class="table" style="width:100%;margin-left:auto;margin-right:auto;text-align:center;margin-top:2.5rem;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Naziv proizvoda</th>
      <th scope="col">Kolicina</th>
      <th scope="col">Cena</th>
      <th scope="col">Valuta</th>
      <th><button style="height:2rem;padding:0.2rem;width:40px;" id="btn-otvori-modal" type="button" class="btn btn-primary" data-toggle="stavkaModal" data-target="#stavkaModal">+</button></th>
    </tr>
  </thead>
  <tbody id="stavke_body">
      <?php
      $stavke=StavkaFakture::vratiStavkeFakture($param,$conn);
      $counter=0;
      while($red=$stavke->fetch_array()):
        $counter++;
      ?>
    <tr id=<?php echo $red['stavkaId']?>>
      <th name="naziv_<?php echo $counter?>"><?php echo $red['naziv_proizvoda'] . " "?></th>
      <th name="kolicina_<?php echo $counter?>" id="kolicina_<?php echo $red['stavkaId']?>" ><?php echo $red['kolicina'] . " "?></th>
      <th name="cena_<?php echo $counter?>" id="cena_<?php echo $red['stavkaId']?>"><?php echo $red['cena'] . " "?></th>
      <th name="valuta_<?php echo $counter?>"><?php echo $red['valuta'] . " "?></th>
      <th><button name=<?php echo $red['stavkaId']?> onclick="izbrisiStavku(this.name)" 
      style="font-size:13px;" class="btn btn-danger"><i class="fas fa-trash-alt"></button></a></th>
    </tr>
    <?php endwhile;?>
    <?php }?>
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
      <th><input id="ukupna_cena" value=<?php echo $iznos/1.2;?> type="text" style="border:none;text-align:center;font-weight:bold;"></th>
      <th id="pdv">20</th>
      <th  name="ukupan_iznos"><input 
      value=<?php echo $iznos?> type="text" name="ukupno" 
      id="ukupnoSaPdv" style="border:none;text-align:center;font-weight:bold;"></th>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th><button class="btn btn-success" id="btn-sacuvaj-fakturu">Azuriraj fakturu</button></th>
    </tr>
  </tbody>
  <tfoot>
  </tfoot>
</table>
</form>

<div class="modal" tabindex="-1" id="stavkaModalDetalji">
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
        <button type="button" id="btn-zatvori" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btn-sacuvaj-detalji" type="button" class="btn btn-primary" onclick="dodajStavkuFakture()">Sacuvaj stavku</button>
      </div>



</div>
</body>
<script src="../js/main.js" type="text/javascript"></script>

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

        const in_naziv=document.createElement('input');
        const in_cena=document.createElement('input');
        const in_kolicina=document.createElement('input');
        const in_valuta=document.createElement('input');
        
        const style="text-align:center;border:none;font-weight:bold;background-color:inherit;"

        in_naziv.style=style;
        in_cena.style=style;
        in_kolicina.style=style;
        in_valuta.style=style;

        in_naziv.disabled=true;
        in_cena.disabled=true;
        in_kolicina.disabled=true;
        in_valuta.disabled=true;

        in_naziv.name="naziv[]";
        in_kolicina.name="kolicina[]";
        in_cena.name="cena[]";
        in_valuta.name="valuta[]";

        in_naziv.id="naziv_nova_"+number;
        in_cena.id="cena_nova_"+number;
        in_kolicina.id="kolicina_nova_"+number;
        in_valuta.id="valuta_nova_"+number;




        in_naziv.size=naziv.length;
        in_cena.size=cena.length;
        in_kolicina.size=kolicina.length;
        in_valuta.size=valuta.length;


        in_naziv.value=naziv;
        in_cena.value=cena;
        in_kolicina.value=kolicina;
        in_valuta.value=valuta;

        th_naziv.appendChild(in_naziv);
        th_cena.appendChild(in_cena);
        th_kolicina.appendChild(in_kolicina);
        th_valuta.appendChild(in_valuta);

        const th_btn=document.createElement('button');
        th_btn.setAttribute('name',number);
        th_btn.setAttribute('class','btn btn-danger');
        th_btn.innerHTML = '<i class="fas fa-trash-alt">';
        th_btn.style="font-size:13px;margin-top:5px;";
        th_btn.type='button';
        th_btn.setAttribute('onclick',"izbrisiDodatuStavku(this.name)");

        const tr=document.createElement('tr');
        tr.appendChild(th_naziv);
        tr.appendChild(th_kolicina);
        tr.appendChild(th_cena);
        tr.appendChild(th_valuta);
        tr.appendChild(th_btn);

        ukupan_zbir+=(+cena)*(+kolicina);
        
        tr.id=number;

        const ukupna_cena=document.getElementById('ukupna_cena').value;
        document.getElementById('ukupna_cena').value=+ukupna_cena+(+ukupan_zbir);
        const ukupan_iznos=document.getElementById('ukupna_cena').value;
        document.getElementById('ukupnoSaPdv').value=+ukupan_iznos+(+ukupan_iznos)*(20/100);

        const tabela=document.getElementById('stavke_body');
        tabela.appendChild(tr);

        number++;
        document.getElementById('naziv-proizvoda').value="";
        document.getElementById('cena').value="";
        document.getElementById('kolicina').value="";
        document.getElementById('valuta').value="";
    }

    function izbrisiStavku(stavkaId){
      event.preventDefault();
      const table_row=document.getElementById(stavkaId);
      const cena=document.getElementById("cena_"+stavkaId).innerHTML;
      const kolicina=document.getElementById('kolicina_'+stavkaId).innerHTML;
      const ukupna_cena=document.getElementById('ukupna_cena').value;
      console.log(+ukupna_cena-(+cena)*(+kolicina));
       const ukupan_iznos=document.getElementById('ukupnoSaPdv');
       document.getElementById('ukupna_cena').value=(+ukupna_cena)-(+cena)*(+kolicina);
       const nova_cena=document.getElementById('ukupna_cena').value;
      ukupan_iznos.value=+nova_cena+(+nova_cena)*0.2;
      table_row.remove();
    }

    function izbrisiDodatuStavku(number){
      const table_row=document.getElementById(number);
      const cena=document.getElementById("cena_nova"+number).value;
      const kolicina=document.getElementById('kolicina_nova'+number).value;
      const ukupna_cena=document.getElementById('ukupna_cena').value;
      console.log(+ukupna_cena-(+cena)*(+kolicina));
       const ukupan_iznos=document.getElementById('ukupnoSaPdv');
       document.getElementById('ukupna_cena').value=(+ukupna_cena)-(+cena)*(+kolicina);
       const nova_cena=document.getElementById('ukupna_cena').value;
      ukupan_iznos.value=+nova_cena+(+nova_cena)*0.2;
      table_row.remove();
    }
</script>

</html>