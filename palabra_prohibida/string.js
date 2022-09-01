//función string(manipular caracteres)
const palabra_prohibida = 'mierda';
let cadena_de_texto = prompt('escribe tu mensaje');
let cadena_a_minuscula = cadena_de_texto.toLowerCase();

function escribe(cadena,id){
    let element = document.getElementById(id);
    element.innerHTML = cadena;
    element.style.fontSize = '30px';              
    }

    if  (cadena_a_minuscula.replace(palabra_prohibida.toUpperCase())!==cadena_a_minuscula){
        cadena_de_texto == cadena_de_texto.replace(text,'chocolate');
    }  
    let texto_descompuesto = cadena_de_texto.split(' ');
    let primera_palabra = texto_descompuesto[0];
    let segunda_palabra = texto_descompuesto[1];
    let tercera_palabra = texto_descompuesto[2];
    let texto_en_vertical = texto_descompuesto[0]+ '<br>' + texto_descompuesto[1] + '<br>' + texto_descompuesto[2];

    //console.log(texto_descompuesto[0]);
    escribe(texto_en_vertical, 'main');
    
    