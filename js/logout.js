$('#btn-odjava').click(function(){
    req=$.ajax({
        url:'handler/logout.php',
        type:'post'
    })
    req.done(function(res,textStatus,jqXHR){
        if(res=='Success'){
            console.log(res)
            window.location.replace('index.php')
        }else{
           alert(res)
        }
    })
})