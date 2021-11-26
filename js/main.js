$('#registrujForm').submit(function(){

    event.preventDefault();
    console.log("Dodavanje");
    const $form =$(this);
    const $input=$form.find('input, button');

    const serijalizovanaForma = $form.serialize();
    console.log(serijalizovanaForma);

    $input.prop('disabled',true);

    req = $.ajax({
        url: 'handler/register.php',
        type:'post',
        data: serijalizovanaForma
    });

    req.done(function(res,textStatus,jqXHR){
        if(res.trim()=="Success"){
            alert('Korisnik je registrovan!');
            console.log("Dodat korisnik");
            //location.reload(true);
        }else{
            alert("Korisnik nije dodat!")
            console.log("Korisnik nije dodat "+res);
            console.log(res);
        }
    });
    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila'+textStatus, errorThrown)
    });
});

// $('#btn-obrisi-kupca').click(function(){
//     console.log('Brisanje kupca.');

//     const idKupca= $(this).attr('name');
//     console.log(idKupca);
//     req = $.ajax({
//         url:'handler/delete-customer.php',
//         type:'post',
//         data:{'id':idKupca}
//     })
//     req.done(function(res,textStatuss,jqXHR){
//         if(res=="Success"){
//             console.log("Deleted");
//             alert("Kupac sa id-em"+idKupca+"je izbrisan");
//             location.reload();
//         }else{
//             console.log('Kupac nije izbrisan'+res);
//         }
//     })
// });

$('#dodajKupca').submit(function(){
    event.preventDefault();
    console.log('Dodavanje kupca');
    const $form=$(this);
    const $input=$form.find('input','button');
    const serijalizovanaForma=$form.serialize();
    console.log(serijalizovanaForma);
    $input.prop('disabled',true);

    req=$.ajax({
        url:'handler/save-customer.php',
        type:'post',
        data:serijalizovanaForma
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Success"){
            alert('Kupac je dodat!');
           console.log("Dodat kupac");
            location.reload(true);
        }else{
           alert("Kupac nije dodat!"+res);
            console.log("Kupac nije dodat "+res);
            console.log(res);
            location.reload();
        }
    });
    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila'+textStatus, errorThrown)
    });
})

$('#dodajFakturu').submit(function(){
    event.preventDefault();
    console.log('Dodavanje fakture');
    const $form=$(this);
    const $input=$form.find('table','input','button','select','tr','th');
    const serijalizovanaForma=$form.serialize();
    console.log(serijalizovanaForma);
    $input.prop('disabled',true);
    let stavke=[];
    let counter=1;
    let rowCount = $('table#mojaTabela tr:last').index() + 1;
    let lastId=$('#mojaTabela tr:last').attr('id');
    console.log("Broj redova je:"+rowCount);
    console.log("Poslednji id je:"+lastId);
    while(counter<=lastId){
        let n=$('#naziv_'+counter+'').val();
        let c=$('#cena_'+counter+'').val();
        let k=$('#kolicina_'+counter+'').val();
        let v=$('#valuta_'+counter+'').val();
        console.log(n);
        if(n==undefined){
            counter++;
            continue;
        }
        let obj={
            naziv:n,
            cena:c,
            kolicina:k,
            valuta:v
        }
        counter++;
        stavke.push(obj);
    }
    req=$.ajax({
        url:'handler/add-invoice.php',
        type:'post',
        data:{'forma':serijalizovanaForma,'stavke':stavke}
    });
    req.done(function(res,textStatus,jqXHR){
        if(res.trim()=='Success'){
            console.log('Dodata faktura');
            alert('Faktura uspesno sacuvana');
            //location.reload();
            history.replaceState({},'',"home.php");
        }else{
            alert('Problem u cuvanju fakture'+res);
            //location.reload();
        }
    });
    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila'+textStatus, errorThrown)
    });
})

$('#detaljnaFaktura').submit(function(){
    event.preventDefault();
    const $form=$(this);
    console.log("Azuriranje faktureeee");
    const serijalizovanaForma=$form.serialize();
    const $input=$form.find('input');
    let nove_stavke=[];
    let nazivi=$('th[name^="naziv_"]').text().split(" ");
    let cene=$('th[name^="cena_"]').text().split(" ");
    let kolicine=$('th[name^="kolicina_"]').text().split(" ");
    let valute=$('th[name^="valuta_"]').text().split(" ");
    console.log(cene);
    for(i=0;i<nazivi.length-1;i++){
        let obj={
            naziv:nazivi[i],
            cena:cene[i],
            kolicina:kolicine[i],
            valuta:valute[i]
        }
        nove_stavke.push(obj);
    }
    console.log(serijalizovanaForma);
    $input.prop('disabled',true);
    let counter=1;
    let lastId=$('#stavke tr:last').attr('id');
    while(counter<=lastId){
        let n=$('#naziv_nova_'+counter+'').val();
        let c=$('#cena_nova_'+counter+'').val();
        let k=$('#kolicina_nova_'+counter+'').val();
        let v=$('#valuta_nova_'+counter+'').val();
       
        if(n==undefined){
            counter++;
            continue;
        }
        let obj={
            naziv:n,
            cena:c,
            kolicina:k,
            valuta:v
        }
        counter++;
        nove_stavke.push(obj);
    }
    console.log("Nove stavke:"+nove_stavke);
    const fakturaId=$('#red').attr('name');
    console.log(serijalizovanaForma);
    console.log(fakturaId);

    req=$.ajax({
        url:'../handler/update-invoice.php',
        type:'post',
        data:{'id':fakturaId,'ukupno':serijalizovanaForma,'stavke':nove_stavke}
    });
    req.done(function(res,textStatus,jqXHR){
        if(res.trim()=="Success"){
            console.log("Azurirana faktura:"+res);
            //window.location.replace('index.php');
        }else{
            console.log("Problem u azuriranju:"+res);
            //window.location.replace('index.php');
        }
    });
    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila'+textStatus, errorThrown)
    });
})

$('#btn-dodaj-kupca').click(function(){
    console.log('Otvaranje modala');
    $('#myModal').toggle();
   
})

$('#btn-odustani').click(function(){
    $('#myModal').toggle();
    location.reload();
})
$('#dodajStavku').click(function(){
    $('#stavkaModal').toggle();
})
$('#btn-sacuvaj-stavku').click(function(){
    $('#stavkaModal').toggle();
})

$('#btn-otvori-modal').click(function(){
    console.log('AAA');
    $('#stavkaModalDetalji').toggle();
})
$('#btn-sacuvaj-detalji').click(function(){
    $('#stavkaModalDetalji').toggle();
});
$('#btn-zatvori').click(function(){
    $('#stavkaModalDetalji').toggle();
});
$('#btn-sacuvaj-fakturu').click(function(){
    header('Location: home.php');
})
$('#btn-odjava').click(function(){
    console.log("Odjavljivanje korisnika!");
    alert('aaa');
})

// $('#odjaviSe').click(function(){
//     console.log("Odjava korisnika");
//     // req=$.ajax({
//     //     url:'handler/logout.php',
//     //     type:'get'
//     // })
//     // req.done(function(res,textStatus,jqXHR){
//     //     if(res=="Success"){
//     //         location.reload();
//     //     }else{
//     //         alert(res);
//     //     }
//     // })
// });
