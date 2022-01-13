let botonStart = document.getElementById("boton-start");

botonStart.addEventListener('click', ()=>{
alert("Ha sido pulsado el botón Start");
});

document.addEventListener('keydown', (event) => {
    const keyName = event.key;
    alert('Has pulsado la tecla espacio!');
  });
