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
    let centralPadre = document.createElement("div"); // Nuevo contenedor padre
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
    centralPadre.setAttribute("id", "centralPadre"); // Nuevo contenedor padre
    central.setAttribute("id", "central");
    inferior.setAttribute("id", "inferior");
    jugador1.setAttribute("id", "jugador1");
    jugador2.setAttribute("id", "jugador2");
    jugador3.setAttribute("id", "jugador3");
    puntuacion.setAttribute("id", "puntuacion");
    textoExplicativo.setAttribute("id", "explicacion");

    // Textos
    puntuacion.textContent = "Puntuación: " + puntos;
    textoExplicativo.textContent = "Crees que " + j[1].nombre + " tiene más " + estadistica + " que " + j[0].nombre + "?";

    // APPEND CHILDS
    jugador1.appendChild(imgJ1);
    jugador2.appendChild(imgJ2);
    jugador3.appendChild(imgJ3);
    central.appendChild(jugador1);
    central.appendChild(jugador2);
    central.appendChild(jugador3);
    centralPadre.appendChild(central); // Añadir el contenedor central al contenedor padre
    superior.appendChild(textoExplicativo);
    inferior.appendChild(puntuacion);
    principal.appendChild(superior);
    principal.appendChild(centralPadre); // Añadir el contenedor padre al principal
    principal.appendChild(inferior);
    document.body.appendChild(principal);
}

function eliminarBotonesRespuesta() {
    let botonesRespuesta = document.getElementById("botonesRespuesta");
    if (botonesRespuesta) {
        botonesRespuesta.parentNode.removeChild(botonesRespuesta);
    }
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

function actualizarInterfaz() {
    // Eliminar texto explicativo
    let explicacion = document.getElementById("explicacion");
    explicacion.textContent = "";

    // Eliminar los botones de respuesta
    eliminarBotonesRespuesta();

    // Recoger el contenedor
    var central = document.getElementById("central");

    //Añadir transicion
    $("#central").css("transition", "transform 3s ease");

    // Mueve el contenedor a la izquierda
    $("#central").css("transform", "translateX(-33.3%)");

    //Recoge el jugador 1 para que no haya conflictos con el ID            
    var jugador1 = document.getElementById('jugador1');

    // Escucha el evento transitionend para detectar el final de la transición
    central.addEventListener('transitionend', function() {

        // Elimina el jugador del principio
        jugador1.parentNode.removeChild(jugador1);

        // Cambia los IDs
        document.getElementById('jugador2').id = 'jugador1';
        document.getElementById('jugador3').id = 'jugador2';

        // Añade el nuevo jugador
        var nuevoJugador = document.createElement('div');
        nuevoJugador.id = 'jugador3';
        var imgNuevoJugador = document.createElement('img');
        imgNuevoJugador.src = './img/jugadores/' + jugadores[2].imagen;
        nuevoJugador.appendChild(imgNuevoJugador);
        central.appendChild(nuevoJugador);
    
        // Eliminar transicion
        $("#central").css("transition", "");

        // Reestablece la posicion del contenedor
        $("#central").css("transform", "translateX(0%)");

        // Actualizar texto explicativo con los jugadores actuales
        explicacion.textContent = "Crees que " + jugadores[0].nombre + " tiene más " + estadistica + " que " + jugadores[1].nombre + "?";
        
        // Sumar y actualizar puntuación
        puntos += 1;
        document.getElementById("puntuacion").textContent = "Puntuación: " + puntos;

        // Añadir botones de respuesta
        añadirBotones();

    }, {once: true});
}

function actualizarInterfazVertical() {
    // Eliminar texto explicativo
    let explicacion = document.getElementById("explicacion");
    explicacion.textContent = "";

    // Eliminar los botones de respuesta
    eliminarBotonesRespuesta();
    
    // Recoger el contenedor
    var central = document.getElementById("central");

    //Añadir transicion
    $("#central").css("transition", "transform 3s ease");

    // Mueve el contenedor a la izquierda
    $("#central").css("transform", "translateY(-33.3%)");

    //Recoge el jugador 1 para que no haya conflictos con el ID            
    var jugador1 = document.getElementById('jugador1');

    // Escucha el evento transitionend para detectar el final de la transición
    central.addEventListener('transitionend', function() {

        // Elimina el jugador del principio
        jugador1.parentNode.removeChild(jugador1);

        // Cambia los IDs
        document.getElementById('jugador2').id = 'jugador1';
        document.getElementById('jugador3').id = 'jugador2';

        // Añade el nuevo jugador
        var nuevoJugador = document.createElement('div');
        nuevoJugador.id = 'jugador3';
        var imgNuevoJugador = document.createElement('img');
        imgNuevoJugador.src = './img/jugadores/' + jugadores[2].imagen;
        nuevoJugador.appendChild(imgNuevoJugador);
        central.appendChild(nuevoJugador);
    
        //Eliminar transicion
        $("#central").css("transition", "");

        // Reestablece la posicion del contenedor
        $("#central").css("transform", "translateY(0%)");

        // Actualizar texto explicativo con los jugadores actuales
        explicacion.textContent = "Crees que " + jugadores[0].nombre + " tiene más " + estadistica + " que " + jugadores[1].nombre + "?";

        // Sumar y actualizar puntuación
        puntos += 1;
        document.getElementById("puntuacion").textContent = "Puntuación: " + puntos;

        //Añadir botones de respuesta
        añadirBotones();

    }, {once: true});
}


function recogerEstadistica(IDJugador, Modo) {

}

function respuestaSi() {
    /*estadisticaJ1 = recogerEstadistica(jugadores[0].getId(), estadistica);
    estadisticaJ2 = recogerEstadistica(jugadores[1].getId(), estadistica);
    if (estadisticaJ1 <= estadisticaJ2) {*/
        // Eliminar el primer jugador de la matriz de jugadores
        jugadores.shift();
        
        if (window.innerWidth > 700) {
            // Actualizar la interfaz con el nuevo jugador
            actualizarInterfaz();
        } else {
            // Actualizar la interfaz vertical con el nuevo jugador
            actualizarInterfazVertical();
        }
    /*}
    else {
        gameOver();
    }*/
}

function respuestaNo() {
    /*estadisticaJ1 = recogerEstadistica(jugadores[0].getId(), estadistica);
    estadisticaJ2 = recogerEstadistica(jugadores[1].getId(), estadistica);
    if (estadisticaJ1 >= estadisticaJ2) {*/
        // Eliminar el primer jugador de la matriz de jugadores
        jugadores.shift();
        
        if (window.innerWidth > 700) {
            // Actualizar la interfaz con el nuevo jugador
            actualizarInterfaz();
        } else {
            // Actualizar la interfaz vertical con el nuevo jugador
            actualizarInterfazVertical();
        }
    /*}
    else {
        gameOver();
    }*/
}

function gameOver() {
    console.log("Has perdido");
}