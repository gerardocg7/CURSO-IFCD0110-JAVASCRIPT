function escribe(texto){
    document.getElementById('main').innerHTML=texto;
    console.log(texto);
    escribe(texto + 'p' );
    
}
