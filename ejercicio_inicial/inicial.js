async function insertar() {
    let header = await fetch('header.html');
    let html_H = await header.text();
    document.getElementById("header").innerHTML = html_H;

    let footer = await fetch('footer.html');
    let html_F = await footer.text();
    document.getElementById("footer").innerHTML = html_F;
  }
  window.onload=function(){
    insertar();
  }