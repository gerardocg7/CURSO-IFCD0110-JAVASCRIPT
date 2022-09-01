let nota;

nota = prompt('Introduce tu nota');
/*
if(Number(nota) == nota){
    if(nota<5)
    {
        alert('Eres un borrico y tienes que estudiar mas');
        window.location.href="https:\\w3schools.com";
    }

document.getElementById('main').innerHTML = 
`<h2>Enhorabuena! Has aprobado </h2>
<h1>${nota}</h1>`;
}

else{
    alert('Debes escribir una nota correcta');
    window.location.reload();
}*/

switch(Number(nota)){
    case 0 :
    nota = " MD ";       
    case 1 :
    nota = " MD ";
    break;

    case 2 :
    nota = " D ";
    case 3 :
    nota = " D ";
    break;

    case 4 :
    nota = " I ";
    break;

    case 5 :
    nota = " S ";
    break;

    case 6 :
    nota = " B ";
    break;

    case 7 :
    nota = " N ";
    case 8 :
    nota = " N ";
    break;
    
    case 9 :
    nota = " SS ";
    case 10 :
    nota =" SS "
    break;    
}
document.getElementById('main').innerHTML = 
`<h2>Tu nota es: </h2>
<h1>${nota}</h1>`;



