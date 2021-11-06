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