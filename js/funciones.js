function escribe(texto){
    document.getElementById('main').innerHTML=texto;
    console.log(texto);
    escribe(texto + 'p' );
    
}
function sumar(n1,n2){
    let resultado = n1+n2;
    return resultado;
    
}