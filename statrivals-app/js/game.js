var puntos = 0;

function capitalize(str) {
    return str.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()).join(' ');
  }

console.log("Comprovando Estadistica");
if (!estadistica) {
    console.log("La estadistica no esta configurada");
    var stat = localStorage.getItem("modo");
    if (!stat) {
        recogerModo();
        var estadistica = localStorage.getItem("modo");
    }
    else {
        estadistica = stat;
    }
    console.log("Estadistica: " + estadistica);
}
else {
    localStorage.setItem("modo", estadistica);
}


recuperarEstado();
var estado = localStorage.getItem("estadoUsuario");
if (estado == 1) {
    recogerLISTA();
}


// Lo que se ejecuta al cargar
addEventListener("DOMContentLoaded", function() {
    var configEnviada = localStorage.getItem("configEnviada");
    var enPartida = localStorage.getItem("enPartida");
    console.log("ConfigEnviada -> " + configEnviada);
    console.log("EnPartida -> " + enPartida);
    if (enPartida === "yes") {
        recogerEstado(1);
        if (configEnviada === "yes") {
            localStorage.setItem("configEnviada", "no");
            localStorage.setItem("puntos", 0);
            localStorage.setItem("jugadores", JSON.stringify(jugadores)); // Convierte a JSON antes de guardar
        }
        else {
            if (localStorage.getItem("puntos")) {
                puntos = localStorage.getItem("puntos");
            }
            else {
                localStorage.setItem("puntos", 0);
            }
            var jugadoresJSON = localStorage.getItem("jugadores");
            jugadores = JSON.parse(jugadoresJSON);
        }        
        // Verificar si la variable jugadores está definida y no es nula    
        if (jugadores !== null) {
            // La variable jugadores está definida y no es nula en localStorage
            crearInterfaz(jugadores);
            añadirBotones();
            // Actualizar estado partida bbdd
            // Actualizar estado partida bbdd
            let listaJ = localStorage.getItem("jugadores");
            let puntu = localStorage.getItem("puntos");
            listaJ = JSON.parse(listaJ);
            recogerPartida(puntu, listaJ);
        } else {
            // La variable jugadores no está definida o es nula en localStorage
            console.log("La variable jugadores no está definida o es nula en localStorage");
        }
    }
    else {
        if (enPartida === "no") {
            crearInterfazFinalPartida();
        }
        else {
            var aviso = document.createElement("p");
            var avisoEnlace = document.createElement("a");
            avisoEnlace.setAttribute("href", "index.php");
            avisoEnlace.textContent = "aqui";
            aviso.setAttribute("id", "partidaError");
            aviso.textContent = "No hay ninguna partida configurada, para configurar una ves ";
            aviso.appendChild(avisoEnlace);
            document.body.appendChild(aviso);
        }
    }
});

function añadirExplicacion() {
    var explicacion = document.createElement("p");
    var span = document.createElement("span");
    var span2 = document.createElement("span");
    var span3 = document.createElement("span");
    var span4 = document.createElement("span");
    var span5 = document.createElement("span");
    var span6 = document.createElement("span");
    var span7 = document.createElement("span");
    var span8 = document.createElement("span");
    var span9 = document.createElement("span");
    var span10 = document.createElement("span");
    var span11 = document.createElement("span");
    explicacion.setAttribute("id", "explicacion");

    span.textContent = "Crees que la cantidad de ";
    explicacion.appendChild(span);
    
    span2.textContent = estadistica;
    explicacion.appendChild(span2);

    span3.textContent = " de ";
    explicacion.appendChild(span3);

    span4.textContent = jugadores[1].nombre;
    explicacion.appendChild(span4);

    span5.textContent = " es ";
    explicacion.appendChild(span5);

    span6.textContent = "superior";
    explicacion.appendChild(span6);

    span7.textContent = " o ";
    explicacion.appendChild(span7);

    span8.textContent = "inferior";
    explicacion.appendChild(span8);

    span9.textContent = " que la de ";
    explicacion.appendChild(span9);

    span10.textContent = jugadores[0].nombre;
    explicacion.appendChild(span10);

    span11.textContent = "?";
    explicacion.appendChild(span11);
    
    var j2 = document.getElementById("jugador2");
    j2.appendChild(explicacion);
}


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
    let centralPadre = document.createElement("div"); // Nuevo contenedor padre
    let central = document.createElement("div");
    let inferior = document.createElement("div");
    let jugador1 = document.createElement("div");
    let jugador2 = document.createElement("div");
    let jugador3 = document.createElement("div");

    //OTROS
    let puntuacion = document.createElement("p");

    //IMGs
    var imgJ1 = document.createElement('img');
    var imgJ2 = document.createElement('img');
    var imgJ3 = document.createElement('img');

    imgJ1.src = './img/jugadores/' + j[0].imagen;
    imgJ2.src = './img/jugadores/' + j[1].imagen;
    imgJ3.src = './img/jugadores/' + j[2].imagen;

    // IDs
    principal.setAttribute("id", "principal");
    centralPadre.setAttribute("id", "centralPadre"); // Nuevo contenedor padre
    central.setAttribute("id", "central");
    inferior.setAttribute("id", "inferior");
    jugador1.setAttribute("id", "jugador1");
    jugador2.setAttribute("id", "jugador2");
    jugador3.setAttribute("id", "jugador3");
    puntuacion.setAttribute("id", "puntuacion");

    // Textos
    puntuacion.textContent = "Puntuación: " + puntos;


    // APPEND CHILDS
    jugador1.appendChild(imgJ1);
    jugador2.appendChild(imgJ2);
    jugador3.appendChild(imgJ3);
    central.appendChild(jugador1);
    central.appendChild(jugador2);
    central.appendChild(jugador3);
    mostrarEstadisticaJugador1();
    centralPadre.appendChild(central); // Añadir el contenedor central al contenedor padre
    inferior.appendChild(puntuacion);
    principal.appendChild(centralPadre); // Añadir el contenedor padre al principal
    principal.appendChild(inferior);
    document.body.appendChild(principal);

    añadirExplicacion();
    añadirVersus();
}

function añadirVersus() {
    var versus = document.createElement("p");
    versus.setAttribute("id","versus");
    versus.textContent = "VS";
    document.getElementById("centralPadre").appendChild(versus);
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

    botonSi.textContent = "SUPERIOR";
    botonNo.textContent = "INFERIOR";
    
    botonSi.addEventListener("click", respuestaSi);
    botonNo.addEventListener("click", respuestaNo);

    botones.appendChild(botonSi);
    botones.appendChild(botonNo);
    jugador2.appendChild(botones);
}

function actualizarInterfaz() {
    var j1 = document.getElementById("jugador1");
    var j2 = document.getElementById("jugador2");
    j1.style.border = "none";
    j2.style.border = "none";
    actualizarPartida();
    
    // EliminarEstadistica J1
    eliminarEstadisticaJ1();
    
    let size = window.innerWidth;
    let isHorizontal = size > 700;

    // Mostrar estadistica J2
    mostrarEstadisticaJugador2();


    // Eliminar texto explicativo
    let explicacion = document.getElementById("explicacion");
    explicacion.parentNode.removeChild(explicacion);

    // Eliminar versus
    let versus = document.getElementById("versus");
    versus.parentNode.removeChild(versus); 

    // Eliminar los botones de respuesta
    eliminarBotonesRespuesta();
    
    // Recoger el contenedor
    var central = document.getElementById("central");

    //Añadir transicion
    $("#central").css("transition", "transform 1.5s ease");

    if (isHorizontal) {
        // Mueve el contenedor a la izquierda
        $("#central").css("transform", "translateX(-33.3%)");
    } else {
        // Mueve el contenedor hacia arriba
        $("#central").css("transform", "translateY(-33.3%)");
    }

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
        if (isHorizontal) {
            $("#central").css("transform", "translateX(0%)");
        } else {
            $("#central").css("transform", "translateY(0%)");
        }

        // Actualizar texto explicativo con los jugadores actuales
        añadirExplicacion();

        añadirVersus();

        // Sumar y actualizar puntuación
        puntos = parseInt(localStorage.getItem("puntos")) || 0; // Convertir a número y establecer a 0 si es null
        puntos += 1;
        localStorage.setItem("puntos", puntos);
        document.getElementById("puntuacion").textContent = "Puntuación: " + puntos;

        //Añadir botones de respuesta
        añadirBotones();

    }, {once: true});
}


async function respuestaSi() {
    try {
        let resultado = await compararEstadisticas();
        if (resultado == 2 || resultado == 0) {
            // Eliminar el primer jugador de la matriz de jugadores
            jugadores.shift();
            
            // Actualizar la interfaz con el nuevo jugador
            actualizarInterfaz();

        } else {
            gameOver();
        }
    } catch (error) {
        console.error("Error al obtener la comparación de estadísticas:", error);
    }
}


async function respuestaNo() {
    try {
        let resultado = await compararEstadisticas();
        if (resultado == 1 || resultado == 0) {
            // Eliminar el primer jugador de la matriz de jugadores
            jugadores.shift();

            // Actualizar la interfaz con el nuevo jugador
            actualizarInterfaz();
        } else {
            gameOver();
        }
    } catch (error) {
        console.error("Error al obtener la comparación de estadísticas:", error);
    }
}


function recogerEstadistica(IDJugador, Modo) {
    return new Promise(function(resolve, reject) {
        $.post({
            url: './enviarEstadistica.php',
            data: {ID_Jugador: IDJugador, Nombre_Modo: Modo},
            success: function(dades) {
                resolve(dades); // Resuelve la promesa con los datos de la consulta PHP
            },
            error: function(error) {
                reject(error); // Rechaza la promesa con el error
            },
            dataType: 'html'
        });
    });
}


function resposta(dades){
  
return dades; //resposta consulta php


}


function mostrarEstadisticaJugador1() {
    //Estadistica Jugador 1
    let parrafoEstadisticaJ1 = document.createElement("p");
    let span1 = document.createElement("span");
    let span2 = document.createElement("span");
    parrafoEstadisticaJ1.setAttribute("id", "estadisticaJ1");
    recogerEstadistica(jugadores[0].id, capitalize(estadistica))
    .then(function(stat) {
        // Mostrar los goles en el párrafo
        span1.textContent = capitalize(estadistica) ;
        span2.textContent = stat;
        parrafoEstadisticaJ1.appendChild(span1);
        parrafoEstadisticaJ1.appendChild(span2);        
        document.getElementById("jugador1").appendChild(parrafoEstadisticaJ1);
    })
    .catch(function(error) {
        console.error("Error al recoger las estadísticas:", error);
    });
}

function mostrarEstadisticaJugador2() {
    //Estadistica Jugador 2
    let parrafoEstadisticaJ2 = document.createElement("p");
    let span1 = document.createElement("span");
    let span2 = document.createElement("span");
    parrafoEstadisticaJ2.setAttribute("id", "estadisticaJ1");
    recogerEstadistica(jugadores[0].id, capitalize(estadistica))
    .then(function(stat) {
        // Mostrar los goles en el párrafo
        span1.textContent = capitalize(estadistica) ;
        span2.textContent = stat;
        parrafoEstadisticaJ2.appendChild(span1);
        parrafoEstadisticaJ2.appendChild(span2);        
        document.getElementById("jugador2").appendChild(parrafoEstadisticaJ2);

        // Hacer que el texto explicativo aparezca después de que aparezca la estadística del jugador 2
        setTimeout(function() {
            //document.getElementById("explicacion").style.opacity = 1;
        }, 500); // Espera 500ms antes de cambiar la opacidad del texto explicativo
    })
    .catch(function(error) {
        console.error("Error al recoger las estadísticas:", error);
    });
}

function eliminarEstadisticaJ1() {
    let estadisticaJ1 = document.getElementById("estadisticaJ1");
    if (estadisticaJ1) {
        estadisticaJ1.parentNode.removeChild(estadisticaJ1);
    }

}


async function compararEstadisticas() {
    try {
        let e1 = Number(await recogerEstadistica(jugadores[0].id, capitalize(estadistica)));
        let e2 = Number(await recogerEstadistica(jugadores[1].id, capitalize(estadistica)));
        if (e1 > e2) {
            return 1;
        }
        else if (e2 > e1) {
            return 2;
        }
        else if (e1 == e2) {
            return 0;
        }
    } catch (error) {
        console.error("Error al comparar estadísticas:", error);
        // Puedes decidir qué hacer en caso de error. Por ejemplo, podrías devolver un valor especial:
        return -1;
    }
}



function recogerEstado(Partida){

    $.post({
        url: './Estado.php',
        data: {enPartida: Partida},
        success: resposta,
        dataType: 'text'
    });

    function resposta(dades){
  
       console.log(); //resposta consulta php
        
        
        }
        

}


//Recoger estado Partida
function recogerPartida(Puntuacion,ListaJugadores){
    var listaJugadoresJson = JSON.stringify(ListaJugadores);
    $.post({
        url: './Estado_Partida.php',
        data: {puntuacion: Puntuacion, listaJugadoresJson: listaJugadoresJson},
        success: resposta,
        dataType: 'text',
    });

    function resposta(dades){
        console.log(); //resposta consulta php
    }
}

function actualizarPartida () {
    localStorage.setItem("jugadores", JSON.stringify(jugadores)); // Convierte a JSON antes de guardar
    actualizarEstadoPartida();
}

function gameOver() {
    let puntu= parseInt(localStorage.getItem("puntos")) || 0; // Convertir a número y establecer a 0 si es null

    // GUARDAR DATOS EN LA BBDD 
    recogerRegistro(puntu);
    recogerEstado(0);

    // DESPUES
    localStorage.removeItem("jugadores");
    localStorage.setItem("enPartida", "no");
    location.reload()
}

function crearInterfazFinalPartida() {
    var contenedorFinalPartida = document.createElement("div");
    contenedorFinalPartida.setAttribute("id", "FinalPartida");

    var FinalPartidaTop = document.createElement("div");
    var FinalPartidaBottom = document.createElement("div");

    var FinalPartidaH1 = document.createElement("h1");
    FinalPartidaH1.textContent = "Final de la partida";

    var FinalPartidaP = document.createElement("p");
    var puntosFinales = localStorage.getItem("puntos");
    if (puntosFinales === null) {
        puntosFinales = 0; // Valor predeterminado si puntosFinales es null
    }
    FinalPartidaP.textContent = "Has obtenido " + puntosFinales + " puntos!";
    

    var BotonVolverAJugar = document.createElement("button");
    BotonVolverAJugar.textContent = "Jugar de nuevo";
    BotonVolverAJugar.addEventListener("click", function() {
        localStorage.setItem("enPartida", "yes");
        localStorage.setItem("configEnviada", "yes");
        location.reload();
    });

    var BotonVolver = document.createElement("button");
    BotonVolver.textContent = "Volver";
    BotonVolver.addEventListener("click", function() {
        localStorage.removeItem("modo");
        window.location.href = "index.php";
    });

    FinalPartidaTop.appendChild(FinalPartidaH1);
    FinalPartidaTop.appendChild(FinalPartidaP);
    FinalPartidaBottom.appendChild(BotonVolverAJugar);
    FinalPartidaBottom.appendChild(BotonVolver);
    contenedorFinalPartida.appendChild(FinalPartidaTop);
    contenedorFinalPartida.appendChild(FinalPartidaBottom);
    document.body.appendChild(contenedorFinalPartida);
}

function recogerRegistro(Puntuacion){

    $.post({
        url: './actualizarRegistroPartida.php',
        data: {puntuacion:Puntuacion},
        success: resposta,
        dataType: 'text',
    })

    function resposta(dades){
        console.log(); //resposta consulta php
    }
}

function recogerLISTA(){

    $.post({
        url: './recuperarArray.php',
        success: resposta,
        dataType: 'text',
    })

    function resposta(dades){
        localStorage.setItem("jugadores", dades);
        console.log();
    }

}

function actualizarEstadoPartida() {
    // Actualizar estado partida bbdd
    let listaJ = localStorage.getItem("jugadores");
    puntu= parseInt(localStorage.getItem("puntos")) || 0; // Convertir a número y establecer a 0 si es null

    listaJ = JSON.parse(listaJ);
    recogerPartida(puntu+1, listaJ);
}

function recuperarEstado(){

    $.post({
        url: './recuperarEstado.php',
        success: resposta,
        dataType: 'text',
    })

    function resposta(dades){
        console.log(); //resposta consulta php
        localStorage.setItem("estadoUsuario", dades);
    }

}

// Recoger Modo
function recogerModo(){

    $.post({
        url: './recuperarModo.php',
        success: resposta,
        dataType: 'text',
    })

    function resposta(dades){
        localStorage.setItem("modo", dades);
        console.log();
    }

}


function ajustarTamanioCentralPadre() {
    var central = document.getElementById("central");
    var centralPadre = document.getElementById("centralPadre");

    if (window.innerWidth < 500) {
        var nuevoAncho = central.offsetWidth * 2;
        centralPadre.style.height = nuevoAncho + "px";
        console.log("Ancho de la ventana es menor que 500px. Nuevo ancho de #centralPadre:", nuevoAncho);
    } else {
        // Restablecer el tamaño si la pantalla es igual o mayor a 500px
        centralPadre.style.height = "";
        console.log("Ancho de la ventana es igual o mayor que 500px. Restableciendo el ancho de #centralPadre.");
    }
}

// Llamar a la función al cargar la página y cuando se redimensione la ventana
window.addEventListener("load", ajustarTamanioCentralPadre);
window.addEventListener("resize", ajustarTamanioCentralPadre);