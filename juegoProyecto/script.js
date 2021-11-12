//** GAME LOOP *//
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

//** JUEGO **//
let sueloY = 22;
let velY = 0;
let impulso = 900;
let gravedad = 2500;

let playerPosX = 0;
let playerPosY = sueloY;

let sueloX = 0;
let velEscenario = 1280 / 3;
let gameVel = 1;
let score = 0;

let parado = false;
let saltando = false;

let tiempoHastaObstaculo = 2;
let minTiempoObstaculo = 0.7;
let maxTiempoObstaclo = 1.8;
let obstaculoPosY = 16;
let obstaculos = [];

let tiempoHastaNube = 0.5;
let tiempoNubeMin = 0.7;
let tiempoNubeMax = 2.7;
let maxNubeY = 270;
let minNubeY = 100;
let nubes = [];
let velNube = 0.5;

let contenedor;
let player;
let textoScore;
let suelo;
let gameOver;

function start() {
    gameOver = document.querySelector(".game-over");
    suelo = document.querySelector(".suelo");
    contenedor = document.querySelector(".contenedor");
    textoScore = document.querySelector(".score");
    player = document.querySelector(".player");
    document.addEventListener("keydown", HandleKeyDown);
}

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

function update() {
    if (parado) return;
    moverSuelo();
    moverPlayer();
    decidirCrearObstaculos();
    decidirCrearNubes();
    moverObstaculos();
    moverNubes();
    detectarColision();

    velY -= gravedad * deltaTime;
}

function moverSuelo() {
    sueloX += calcularDesplazamiento();
    suelo.style.left = -(sueloX % contenedor.clientWidth) + "px";
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

function decidirCrearObstaculos() {
    tiempoHastaObstaculo -= deltaTime;
    if (tiempoHastaObstaculo <= 0) {
        crearObstaculo();
    }
}

function crearObstaculo() {
    let obstaculo = document.createElement("div");
    contenedor.appendChild(obstaculo);
    obstaculo.classList.add("cactus");
    obstaculo.posX = contenedor.clientWidth;
    obstaculo.style.left = contenedor.clientWidth + "px";
    obstaculos.push(obstaculo);
    tiempoHastaObstaculo = minTiempoObstaculo + Math.random() * (maxTiempoObstaclo - minTiempoObstaculo) / gameVel;
}

function moverObstaculos() {
    for (let i = obstaculos.length - 1; i >= 0; i--) {
        if (obstaculos[i].posX < -obstaculos[i].clientWidth) {
            obstaculos[i].parentNode.removeChild(obstaculos[i]);
            obstaculos.splice(i, 1);
            ganarPuntos();
        } else {
            obstaculos[i].posX -= calcularDesplazamiento();
            obstaculos[i].style.left = obstaculos[i].posX + "px";
        }
    }
}

function ganarPuntos() {
    score++;
    textoScore.innerText = score;
}

function detectarColision() {
    for (let i = 0; i < obstaculos.length; i++) {
        if (colision(player, obstaculos[i], 10, 30, 15, 20)) {
            finJuego();
        }
    }
}


function colision(a, b, paddingTop, paddingRight, paddingBottom, paddingLeft) {
    let aRect = a.getBoundingClientRect();
    let bRect = b.getBoundingClientRect();

    return !(
        ((aRect.top + aRect.height - paddingBottom) < (bRect.top)) ||
        (aRect.top + paddingTop > (bRect.top + bRect.heigth)) ||
        ((aRect.left + aRect.width - paddingRight) < bRect.left) ||
        (aRect.left + paddingLeft > (bRect.left + bRect.width))
    );
}

function estrellarse() {
    player.classList.remove("player-run");
    document.body.classList.add('active');
    player.classList.add("player-hit");
    parado = true;
    startQuiz();
}

function finJuego() {
    estrellarse();
    gameOver.style.display = "block";
}

function decidirCrearNubes() {
    tiempoHastaNube -= deltaTime;
    if (tiempoHastaNube <= 0) {
        crearNube();
    }
}

function crearNube() {
    let nube = document.createElement("div");
    contenedor.appendChild(nube);
    nube.classList.add("nube");
    nube.posX = contenedor.clientWidth;
    nube.style.left = contenedor.clientWidth + "px";
    nube.style.bottom = minNubeY + Math.random() * (maxNubeY - minNubeY) + "px";

    nubes.push(nube);
    tiempoHastaNube = tiempoNubeMin + Math.random() * (tiempoNubeMax - tiempoNubeMin) / gameVel;
}

function moverNubes() {
    for (let i = nubes.length - 1; i >= 0; i--) {
        if (nubes[i].posX < -nubes[i].clientWidth) {
            nubes[i].parentNode.removeChild(nubes[i]);
            nubes.splice(i, 1);
        } else {
            nubes[i].posX -= calcularDesplazamiento() * velNube;
            nubes[i].style.left = nubes[i].posX + "px";
        }
    }
}

function decidirCrearNubes() {
    tiempoHastaNube -= deltaTime;
    if (tiempoHastaNube <= 0) {
        crearNube();
    }
}

/*************************************** 
 * *************************************
 * *************************************
*/

//**ELEMENTOS** */
const start2 = document.getElementById("start2");
const quiz = document.getElementById("quiz");
const question = document.getElementById("question");
const qImg = document.getElementById("qImg");
const choiceA = document.getElementById("A");
const choiceB = document.getElementById("B");
const choiceC = document.getElementById("C");
const counter = document.getElementById("counter");
const timeMedidor = document.getElementById("timeMedidor");
const progress = document.getElementById("progress");
const scoreDiv = document.getElementById("scoreContainer");

//**PREGUNTAS** */
let questions = [{
    question: "Pregunta 1",
    imgSrc: "/img/html.png",
    choiceA: "Correcta",
    choiceB: "Mal",
    choiceC: "Mal",
    correct: "A"
}, {
    question: "Pregunta 2",
    imgSrc: "/img/css.png",
    choiceA: "Mal",
    choiceB: "Correcta",
    choiceC: "Mal",
    correct: "B"
}, {
    question: "Pregunta 3",
    imgSrc: "/img/js.png",
    choiceA: "Mal",
    choiceB: "Mal",
    choiceC: "Correcta",
    correct: "C"
}];

//**VARIABLES** */
const lastQuestion = questions.length - 1; //
let runningQuestion = 0; //posición del array
let count = 10; //tiempo Inicial
const questionTime = 10; // 10s para responder
const medidorWidth = 150; // 150px
const medidorUnit = medidorWidth / questionTime; //relleno del medidor
let TIMER;
let puntos = 0;


//**MOSTRAR PREGUNTAS** */
function renderQuestion() {
    let q = questions[runningQuestion];

    question.innerHTML = "<p>" + q.question + "</p>";
    qImg.innerHTML = "<img src=" + q.imgSrc + ">";
    choiceA.innerHTML = q.choiceA;
    choiceB.innerHTML = q.choiceB;
    choiceC.innerHTML = q.choiceC;
}


//**COMENZAR QUIZ** */
function startQuiz() {
    renderQuestion();
    quiz.style.display = "block";
    renderProgress();
    renderCounter();
    TIMER = setInterval(renderCounter, 1000); // 1000ms = 1s
}

//**MOSTRAR PROGRESO** */
function renderProgress() {
    for (let qIndex = 0; qIndex <= lastQuestion; qIndex++) {
        progress.innerHTML += "<div class='prog' id=" + qIndex + "></div>";
    }
}

//**CONTADOR** */
function renderCounter() {
    if (count <= questionTime && count >=0) {
        counter.innerHTML = count;
        timeMedidor.style.width = count * medidorUnit + "px";
        count--
    } else {
        count = 10;
        // marcamos la respuesta como errónea
        answerIsWrong();
        if (runningQuestion < lastQuestion) {
            runningQuestion++;
            renderQuestion();
        } else {
            // termina la partida y muestra los puntos
            clearInterval(TIMER);
            scoreRender();
        }
    }
}

//**RESPUESTAS** */
function checkAnswer(answer) {
    if (answer == questions[runningQuestion].correct) {
        // Respuesta correcta
        puntos++;
        // marcamos la respuesta como correcta
        answerIsCorrect();
    } else {
        // Respuesta Incorrecta
        // marcamos la respuesta como errónea
        answerIsWrong();
    }
    count = 10;
    if (runningQuestion < lastQuestion) {
        runningQuestion++;
        renderQuestion();
    } else {
        // Fin de la partida + Puntos
        clearInterval(TIMER);
        scoreRender();
    }
}

// CORRECTA
function answerIsCorrect() {
    document.getElementById(runningQuestion).style.backgroundColor = "#0f0";
}

// INCORRECTA
function answerIsWrong() {
    document.getElementById(runningQuestion).style.backgroundColor = "#f00";
}

//**PUNTUACIÓN** */
function scoreRender() {
    scoreDiv.style.display = "block"; //pasamos de none a block

    // calcular los puntos
    const scorePerCent = Math.round(100 * score / questions.length);

    // escoger emoji según puntuación
    let img = (scorePerCent >= 80) ? "/img/5.png" :
        (scorePerCent >= 60) ? "/img/4.png" :
        (scorePerCent >= 40) ? "/img/3.png" :
        (scorePerCent >= 20) ? "/img/2.png" :
        "/img/1.png";

    //mostramos resultados
    scoreDiv.innerHTML = "<img src=" + img + ">";
    scoreDiv.innerHTML += "<p> Tu puntuación es: "+ scorePerCent + "%</p>";
}
