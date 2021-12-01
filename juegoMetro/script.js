//** VARIABLES **//
let sueloY = 22;
let velY = 0;
let impulso = 900;
let gravedad = 2500;

let playerPosX = 0;
let playerPosY = sueloY; //sprite del player sobre el suelo

let fondoX = 0;
let sueloX = 0;
let rotuloX = 0;
let velEscenario = 1280 / 3;
let gameVel = 1;
let score = 0;

let parado = false;
let saltando = false;
let finishGame = false;

let tiempoHastaObstaculo = 2;
let minTiempoObstaculo = 0.7;
let maxTiempoObstaclo = 1.8;
let obstaculoPosY = 16;
let obstaculos = [];

let letra;
let tiempoHastaLetra = 15;
let tiempoLetraMin = 9;
let tiempoLetraMax = 15;
let maxLetraY = 240;
let minLetraY = 100;
let letras = [];
let velLetra = 0.5;

let contenedor;
let player;
let textoScore;
let suelo;
let gameOver;
let contadorLetras = 0;

let fondo;
let rotulo;
let continuar; //true activa el evento QUIZ
let obstaculo;

// ---- reloj 
let parpadeoContador;
let min = 1;
let sec = 1;
let ejectuarCronometro = setInterval(iniciarCrono, 1000);
let perder = false;

let metro = document.querySelector(".metro")
let metroX = -2085;

let vida1
let vida2
let vida3

let vidas = 3

//*************
//*   LOOP    *
//* DEL JUEGO *
//*************

let time = new Date();
let deltaTime = 0;

if (document.readyState === "complete" || document.readyState === "interactive") {
    setTimeout(init, 1);
} else {
    document.addEventListener("DOMContentLoaded", init);
}

function init() {
    time = new Date();
    start();
    loop();
}

function loop() {
    deltaTime = (new Date() - time) / 1000;
    time = new Date();
    update();
    requestAnimationFrame(loop)
}


function start() {
    gameOver = document.querySelector(".game-over");
    suelo = document.querySelector(".suelo");
    contenedor = document.querySelector(".contenedor");
    textoScore = document.querySelector(".score");
    player = document.querySelector(".player");
    document.addEventListener("keydown", HandleKeyDown);
    rotulo = document.querySelector(".rotulo");
    fondo = document.querySelector(".fondo")
    vida1 = document.getElementById("vida1");
    vida2 = document.getElementById("vida2");
    vida3 = document.getElementById("vida3");
}

function update() {

    if (perder == true) {
        GameOver();
        return;
    }

    moverSuelo();
    moverPlayer();
    moverRotulo();
    moverFondo();
    moverMetro();
    decidirCrearObstaculos();
    moverObstaculos();
    detectarColision();
    //CREANDO LETRAS FRASE
    if (contadorLetras < 5) {
        decidirCrearLetra();
    }
    detectarColisionLetra();
    moverLetra();
    velY -= gravedad * deltaTime;
    comprobarVidas();
}

//***********
//* SALTAR *
//***********

function HandleKeyDown(ev) {
    if (ev.keyCode == 32) {
        saltar();
    }
}

function saltar() {
    if (playerPosY === sueloY) {
        saltando = true;
        velY = impulso;
        player.classList.remove("player-run");
    }
}

function ganarPuntos() {
    score++;
    textoScore.innerText = score;
}


//*************
//*  EVENTOS  *
//* DEL JUEGO *
//*************
function eventoQuiz() {
    velEscenario = 0;
    document.body.classList.add('active'); //ESTO ACTIVA EL WRAPPER DEL QUIZ
    removeElementsByClass("obstaculo")
    removeElementsByClass('nube')
    letras = []
    tiempoHastaLetra = 50;
    setTimeout(quitarQuiz, 4000)
    setTimeout(reset, 4000)
}

function quitarQuiz() {
    //removeElementsByClass('wrapper');
    document.body.classList.remove('active')
}

function removeElementsByClass(className) {
    let elements = document.getElementsByClassName(className);
    while (elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
    }
}

//***************
//* ANIMACIONES *
//*  DEL JUEGO  *
//***************

//* SUELO
function moverSuelo() {
    sueloX += calcularDesplazamiento();
    suelo.style.left = -(sueloX % contenedor.clientWidth) + "px";
}

function moverRotulo() {
    rotuloX += calcularDesplazamiento();
    rotulo.style.left = -(rotuloX % contenedor.clientWidth) + "px";
}

function moverFondo() {
    fondoX += calcularDesplazamiento();
    fondo.style.left = -(fondoX % contenedor.clientWidth) + "px";
}

function calcularDesplazamiento() {
    return velEscenario * deltaTime * gameVel;
}

function moverPlayer() {
    playerPosY += velY * deltaTime;
    if (playerPosY < sueloY) {
        tocarSuelo();
    }
    player.style.bottom = playerPosY + "px";
}

function tocarSuelo() {
    playerPosY = sueloY;
    velY = 0;
    if (saltando) {
        player.classList.add("player-run");
    }
    saltando = false;
}


//* OBSTÁCULOS
function decidirCrearObstaculos() {
    tiempoHastaObstaculo -= deltaTime;
    if (tiempoHastaObstaculo <= 0) {
        crearObstaculo();
    }
}

function crearObstaculo() {
    let randomNum = Math.floor(Math.random() * 10) + 1;
    obstaculo = document.createElement("div");
    contenedor.appendChild(obstaculo);

    if (randomNum == 4) {
        obstaculo.classList.add("obstaculoYaya");
        obstaculo.posX = contenedor.clientWidth;
    } else if (randomNum == 3) {
        obstaculo.classList.add("obstaculoProsegur");
        obstaculo.posX = contenedor.clientWidth;
    } else if (randomNum == 2) {
        obstaculo.classList.add("obstaculoCable");
        obstaculo.posX = contenedor.clientWidth;
    } else if (randomNum == 5) {
        obstaculo.classList.add("obstaculoCaco");
        obstaculo.posX = contenedor.clientWidth;
    } else {
        obstaculo.classList.add("obstaculoYaya");
        obstaculo.posX = contenedor.clientWidth;
    }

    obstaculo.style.left = contenedor.clientWidth + "px";
    obstaculos.push(obstaculo);
    tiempoHastaObstaculo = minTiempoObstaculo + Math.random() * (maxTiempoObstaclo - minTiempoObstaculo) / gameVel;
}

function moverObstaculos() {
    for (let i = obstaculos.length - 1; i >= 0; i--) {
        if (obstaculos[i].posX < -obstaculos[i].clientWidth) {
            obstaculos[i].parentNode.removeChild(obstaculos[i]);
            obstaculos.splice(i, 1);
            velEscenario += 7;
            ganarPuntos();

        } else {
            obstaculos[i].posX -= calcularDesplazamiento();
            obstaculos[i].style.left = obstaculos[i].posX + "px";
        }
    }
}

//* LETRAS
function decidirCrearLetra() {
    tiempoHastaLetra -= deltaTime;
    if (tiempoHastaLetra <= 0) {
        crearLetra();
    }
}

function crearLetra() {
    letra = document.createElement("div");
    contenedor.appendChild(letra);
    letra.classList.add("letra");

    if (contadorLetras == 1) {
        letra.style.background = "url(img/R.png)"
    } else if (contadorLetras == 2) {
        letra.style.background = "url(img/A.png)"
    } else if (contadorLetras == 3) {
        letra.style.background = "url(img/S.png)"
    } else if (contadorLetras == 4) {
        letra.style.background = "url(img/E.png)"
    }

    letra.posX = contenedor.clientWidth;
    letra.style.left = contenedor.clientWidth + "px";
    letra.style.bottom = minLetraY + Math.random() * (maxLetraY - minLetraY) + "px";
    letras.push(letra)
    contadorLetras++;
    tiempoHastaLetra = tiempoLetraMin + Math.random() * (tiempoLetraMax - tiempoLetraMin) / gameVel;
}

function moverLetra() {
    for (let i = letras.length - 1; i >= 0; i--) {
        if (letras[i].posX < -letras[i].clientWidth) {
            letras[i].parentNode.removeChild(letras[i]);
            letras.splice(i, 1);
        } else {
            letras[i].posX -= calcularDesplazamiento();
            letras[i].style.left = letras[i].posX + "px";
        }
    }
}

//METRO

function moverMetro() {

    if (metroX > contenedor.clientWidth) {
        setTimeout(function () {
            metroX = -3000
        }, 10000)
    }
    metroX += calcularDesplazamiento();
    metro.style.left = metroX + "px";
}

//***************
//* COLISIONES  *
//***************

function detectarColisionLetra() {
    for (let i = 0; i < letras.length; i++) {
        if (colision(player, letras[i], 10, 25, 10, 20)) {
            if (letras[i].classList.contains("letra")) {
                score += 1000;
                velEscenario += 30;
                textoScore.innerText = score;
                letras[i].parentNode.removeChild(letras[i]);
                letras.splice(i, 1);
            }
        }
    }
}

function detectarColision() {
    for (let i = 0; i < obstaculos.length; i++) {
        if (colision(player, obstaculos[i], 10, 30, 15, 20)) {
            estrellarse();
        }
    }
}

function estrellarse() {
    player.classList.remove("player-run");
    player.classList.add("player-hit");
    velEscenario -= 100;
    setTimeout(rebote, 1000);
    setTimeout(normalidad, 1000);
    tiempoHastaObstaculo = 3
}


function rebote() {
    velEscenario += 100;
}

function normalidad() {
    if (player.classList == "player player-hit") {
        vidas--
    }
    player.classList.remove("player-hit");
    player.classList.add("player-run")
}

function comprobarVidas() {
    if (vidas === 2) {
        vida3.style.display = "none";

    } else if (vidas === 1) {
        vida2.style.display = "none";

    } else if (vidas === 0) {
        vida1.style.display = "none";
        perder = true;
    }
}


function colision(a, b, paddingTop, paddingRight, paddingBottom, paddingLeft) {
    var aRect = a.getBoundingClientRect();
    var bRect = b.getBoundingClientRect();

    return !(
        ((aRect.top + aRect.height - paddingBottom) < (bRect.top)) ||
        (aRect.top + paddingTop > (bRect.top + bRect.height)) ||
        ((aRect.left + aRect.width - paddingRight) < bRect.left) ||
        (aRect.left + paddingLeft > (bRect.left + bRect.width))
    );
}

function GameOver() {
    clearInterval(ejectuarCronometro);
    player.classList.remove("player-run");
    player.classList.add("player-hit");
    player.style.animation = "none";
    gameOver.style.display = "block";

}

//MENÚ
let btnPlay = document.getElementById("btn-play");
let btnRanking = document.getElementById("btn-ranking");
let btnCredits = document.getElementById("btn-credits");



//CRONO

function iniciarCrono() { // creo una cuenta atras, cuando llega a 0 el jugador pierde 

    if (min != 0 || sec != 0) {
        sec = sec - 1;
        if (sec == -1) {
            sec = 59;
            min = min - 1;
            if (min <= 9) {
                document.getElementById('mostrarContador').innerHTML = '0' + min + ':' + sec;
            } else {
                document.getElementById('mostrarContador').innerHTML = min + ':' + sec;
            }
        } else if (sec <= 9 && min <= 9) {
            document.getElementById('mostrarContador').innerHTML = '0' + min + ':0' + sec;
        } else if (sec <= 9) {
            document.getElementById('mostrarContador').innerHTML = min + ':0' + sec;
        } else if (min <= 9) {
            document.getElementById('mostrarContador').innerHTML = '0' + min + ':' + sec;
        } else {
            document.getElementById('mostrarContador').innerHTML = min + ':' + sec;
        }
    } else if (min == 0 && sec <= 0) {
        if (parpadeoContador == true) {
            document.getElementById('mostrarContador').innerHTML = '0' + min + ':0' + sec;
            parpadeoContador = false;
        } else {
            document.getElementById('mostrarContador').innerHTML = '';
            parpadeoContador = true;
        }
        perder = true;
    }
}