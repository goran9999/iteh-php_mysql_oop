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
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
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
            //location.reload(true);
        }else{
           alert("Kupac nije dodat!"+res);
            console.log("Kupac nije dodat "+res);
            console.log(res);
            //location.reload();
        }
    });
    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
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
    while(true){
        let n=$('#naziv_'+counter+'').val();
        let c=$('#cena_'+counter+'').val();
        let k=$('#kolicina_'+counter+'').val();
        let v=$('#valuta_'+counter+'').val();
        if(n==undefined){
            break;
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
            location.reload();
        }else{
            alert('Problem u cuvanju fakture'+res);
            //location.reload();
        }
    });
    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
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


