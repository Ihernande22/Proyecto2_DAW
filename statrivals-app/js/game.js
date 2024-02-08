var puntos = 0;

addEventListener("DOMContentLoaded", function() {
    // Verificar si la variable jugadores está definida y no es nula    
    if (typeof jugadores !== 'undefined' && jugadores !== null) {
        // La variable jugadores está definida y no es nula
        crearInterfaz(jugadores);
        añadirBotones();
    } else {
        // La variable jugadores no está definida o es nula
        console.log("La variable jugadores no está definida o es nula");
    }
});

function crearInterfaz(j) {
    // Verificar si los jugadores están definidos y no son nulos
    if (!Array.isArray(j) || j.length < 3 || !j[0] || !j[1] || !j[2]) {
        console.log("Error: El array de jugadores no está correctamente definido.");
        return;
    }

    // Verificar si las imágenes de los jugadores están definidas
    if (!j[0].imagen || !j[1].imagen || !j[2].imagen || j[0].imagen === "" || j[1].imagen === "" || j[2].imagen === "") {
        console.log("Error: Las imágenes de los jugadores no están definidas.");
        return;
    }

    //CONTENEDORES
    let principal = document.createElement("div");
    let superior = document.createElement("div");
    let central = document.createElement("div");
    let inferior = document.createElement("div");
    let jugador1 = document.createElement("div");
    let jugador2 = document.createElement("div");
    let jugador3 = document.createElement("div");

    //OTROS
    let puntuacion = document.createElement("p");
    let textoExplicativo = document.createElement("p");

    //IMGs
    var imgJ1 = document.createElement('img');
    var imgJ2 = document.createElement('img');
    var imgJ3 = document.createElement('img');

    imgJ1.src = './img/jugadores/' + j[0].imagen;
    imgJ2.src = './img/jugadores/' + j[1].imagen;
    imgJ3.src = './img/jugadores/' + j[2].imagen;

    // IDs
    principal.setAttribute("id", "principal");
    superior.setAttribute("id", "superior");
    central.setAttribute("id", "central");
    inferior.setAttribute("id", "inferior");
    jugador1.setAttribute("id", "jugador1");
    jugador2.setAttribute("id", "jugador2");
    jugador3.setAttribute("id", "jugador3");
    puntuacion.setAttribute("id", "puntuacion");
    textoExplicativo.setAttribute("id", "explicacion");

    // Textos
    puntuacion.textContent = "Puntuación: " + puntos;
    textoExplicativo.textContent = "Crees que " + j[0].nombre + " tiene más " + estadistica + " que " + j[1].nombre + "?";

    // APPEND CHILDS
    jugador1.appendChild(imgJ1);
    jugador2.appendChild(imgJ2);
    jugador3.appendChild(imgJ3);
    central.appendChild(jugador1);
    central.appendChild(jugador2);
    central.appendChild(jugador3);
    superior.appendChild(textoExplicativo);
    inferior.appendChild(puntuacion);
    principal.appendChild(superior);
    principal.appendChild(central);
    principal.appendChild(inferior);
    document.body.appendChild(principal);
}

function añadirBotones() {
    let jugador2 = document.getElementById("jugador2");
    let botones = document.createElement("div");
    let botonSi = document.createElement("button");
    let botonNo = document.createElement("button");

    botones.setAttribute("id", "botonesRespuesta");
    botonSi.setAttribute("id", "respuestaSi");
    botonNo.setAttribute("id", "respuestaNo");

    botonSi.textContent = "SI";
    botonNo.textContent = "NO";
    
    botonSi.addEventListener("click", respuestaSi);
    botonNo.addEventListener("click", respuestaNo);

    botones.appendChild(botonSi);
    botones.appendChild(botonNo);
    jugador2.appendChild(botones);
}

function respuestaSi() {
    // Eliminar el primer jugador de la matriz de jugadores
    jugadores.shift();
    
    // Actualizar la interfaz con el nuevo jugador
    actualizarInterfaz();
}

function respuestaNo() {
    console.log("Ha pulsado no");
}

function actualizarInterfaz() {
    // Eliminar el contenedor "eliminarJugador"
    var central = document.getElementById("central");

    central.style.marginLeft = "-50%";

    var jugador1 = document.getElementById('jugador1');

    document.getElementById('jugador2').id = 'jugador1';
    document.getElementById('jugador3').id = 'jugador2';

    var nuevoJugador = document.createElement('div');
    nuevoJugador.id = 'jugador3';

    var imgNuevoJugador = document.createElement('img');
    imgNuevoJugador.src = './img/jugadores/' + jugadores[2].imagen;

    nuevoJugador.appendChild(imgNuevoJugador);
    central.appendChild(nuevoJugador);

    jugador1.parentNode.removeChild(jugador1);
    central.style.marginLeft = "0%";

}
