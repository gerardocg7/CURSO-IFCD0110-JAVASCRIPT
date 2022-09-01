// Vamos a realizar una entrada de datos
// y darle salida por pantalla con un "alert();"
let edad;

edad = prompt('Introduce tu edad');

if(Number(edad) == edad){
    if(edad<18)
    {
        alert('Eres menor de edad y no puedes entrar');
        window.location.href="https:\\elpais.com";
    }

document.getElementById('main').innerHTML = 
`<h2>Enhorabuena! Tu edad es </h2>
<h1>${edad}</h1>`;
}

else{
    alert('Debes introducir un número');
    window.location.reload();
}

