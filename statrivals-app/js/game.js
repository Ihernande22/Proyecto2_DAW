var puntos = 0;

addEventListener("DOMContentLoaded", function() {
    // Verificar si la variable jugadores está definida y no es nula    
    if (typeof jugadores !== 'undefined' && jugadores !== null) {
        // La variable jugadores está definida y no es nula
        crearInterficie(jugadores);
    } else {
        // La variable jugadores no está definida o es nula
        console.log("La variable jugadores no está definida o es nula");
    }
});


function crearInterficie(j) {
    // Verificar si los jugadores están definidos y no son nulos
    if (!Array.isArray(j) || j.length < 2 || !j[0] || !j[1]) {
        console.log("Error: El array de jugadores no está correctamente definido.");
        return;
    }

    // Verificar si las imágenes de los jugadores están definidas
    if (!j[0].imagen || !j[1].imagen || j[0].imagen === "" || j[1].imagen === "") {
        console.log("Error: Las imágenes de los jugadores no están definidas.");
        return;
    }

    //CONTENEDORES
    let principal = document.createElement("div");
    let jugadores = document.createElement("div");
    let jugador1 = document.createElement("div");
    let jugador2 = document.createElement("div");
    let estadisticas = document.createElement("div");

    //OTROS
    let puntuacion = document.createElement("p");
    let textoExplicativo = document.createElement("p");
    let estadisticaJ1 = document.createElement("p");
    let estadisticaJ2 = document.createElement("p");
    

    //IMGs
    // Crea dos elementos img
    var imgJ1 = document.createElement('img');
    var imgJ2 = document.createElement('img');

    // Establece la ruta de las imágenes
    imgJ1.src = './img/jugadores/' + j[0].imagen;
    imgJ2.src = './img/jugadores/' + j[1].imagen;

    //IDs
    principal.setAttribute("id", "principal");
    jugadores.setAttribute("id", "jugadores");
    jugador1.setAttribute("id", "jugador1");
    jugador2.setAttribute("id", "jugador2");
    estadisticas.setAttribute("id", "estadisticas");
    puntuacion.setAttribute("id", "puntuacion");
    textoExplicativo.setAttribute("id", "explicacion");
    estadisticaJ1.setAttribute("id", "estadisticaJ1");
    estadisticaJ2.setAttribute("id", "estadisticaJ2");

    //Textos
    puntuacion.textContent = "Puntuación: " + puntos;
    textoExplicativo.textContent = "Crees que " + j[0].nombre + " tiene más " + estadistica +" que " + j[1].nombre + "?";
    switch (estadistica) {
        case "goles":
            estadisticaJ1.textContent = j[0].goles + " " + estadistica;
            break;
        case "asistencias":
            estadisticaJ1.textContent = j[0].asistencias + " " + estadistica;
            break;
        case "valor":
            estadisticaJ1.textContent = j[0].valor + " " + estadistica;
            break;
        case "partidos":
            estadisticaJ1.textContent = j[0].partidos + " " + estadistica;
            break;
        default:
            estadisticaJ1.textContent = "No se ha encontrado pero es " + estadistica;
    }
    estadisticaJ2.textContent = "? " + estadistica;

    //APPEND CHILDS
    jugador1.appendChild(imgJ1);
    jugador2.appendChild(imgJ2);
    jugadores.appendChild(textoExplicativo);
    jugador1.appendChild(estadisticaJ1);
    jugador2.appendChild(estadisticaJ2);
    jugadores.appendChild(jugador1);
    jugadores.appendChild(jugador2);
    principal.appendChild(jugadores);
    estadisticas.appendChild(puntuacion);
    principal.appendChild(estadisticas);
    document.body.appendChild(principal);
}
